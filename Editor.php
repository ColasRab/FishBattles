<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$username = $_SESSION['username'];
include('SQLConnect.php');

$sql = "SELECT cards FROM decks WHERE user_id = (SELECT id FROM users WHERE username = ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$deck = explode(',', $row['cards']);

$cardData = [];
if (count($deck) > 0) {
    $placeholders = implode(',', array_fill(0, count($deck), '?'));
    $sql = "SELECT id, name, description, image_url, rarity, attack_points AS atk, def_points AS def, tributes_req 
            FROM cards 
            WHERE id IN ($placeholders)";
    $stmt = $con->prepare($sql);

    $types = str_repeat('i', count($deck));
    $stmt->bind_param($types, ...$deck);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cardData[$row['id']] = [
                "id" => $row['id'],
                "name" => $row['name'],
                "description" => $row['description'],
                "image_url" => $row['image_url'],
                "rarity" => $row['rarity'],
                "atk" => $row['atk'],
                "def" => $row['def'],
                "tribute_req" => $row['tributes_req']
            ];
        }
    }
}
$cardDataJson = json_encode(array_values($cardData));
$deckDataJson = json_encode(array_map(function ($id) use ($cardData) {
    return $cardData[$id];
}, $deck));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deck Editor</title>
    <link rel="stylesheet" href="editor.css">
</head>
<body>
    <div class="header">
        <div class="back_to_menu">
            <button id="back" onclick="window.location.href = 'Home.php';">← Back to Menu</button>
        </div>
        <div class="currency">
            <div class="coins">
                <p id="coins">0</p>
                <img src="assets/COINSCURRENCY.png" width="211.90" height="60" alt="Coins">
            </div>
            <div class="pearls">
                <p id="pearls">0</p>
                <img src="assets/PEARLSCURRENCY.png" width="211.90" height="60" alt="Pearls">
            </div>
        </div>
    </div>
    <div class="container"> 
        <div class="deck_editor">
            <h1>Deck Viewer</h1>
            <div class="card-list" id="deck-list"></div>
        </div>
        <div class="card_inventory">
            <h1>Card List</h1>
            <div class="card-list" id="card-inventory"></div>
        </div>
    </div>
    <script>
        const cardData = <?php echo $cardDataJson; ?>;
        const deckData = <?php echo $deckDataJson; ?>;

        console.log(cardData);
        console.log(deckData);

        const cardInventory = document.getElementById('card-inventory');
        cardData.forEach(card => {
            if (!deckData.some(deckCard => deckCard && deckCard.id === card.id)) {
                const cardDiv = document.createElement('div');
                cardDiv.className = 'card';
                cardDiv.id = card.id;
                cardDiv.innerHTML = `<img src="${card.image_url}" alt="${card.name}" width="100" height="140">`;
                cardInventory.appendChild(cardDiv);
            }
        });

        const deckList = document.getElementById('deck-list');
        for (let i = 0; i < 40; i++) {
            const cardDiv = document.createElement('div');
            cardDiv.className = 'card';
            cardDiv.id = `deck_${i + 1}`;
            const card = deckData[i];
            if (card) {
                cardDiv.innerHTML = `
                    <img src="${card.image_url}" alt="${card.name}" width="100" height="140">
                    <button class="delete-btn" data-card-id="${card.id}">Delete</button>`;
            } else {
                cardDiv.innerHTML = `<img src="" alt="Empty Slot" width="100" height="140" style="display:none;"><p>Empty Slot</p>`;
            }
            deckList.appendChild(cardDiv);
        }

        // Add event listener to delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cardId = this.getAttribute('data-card-id');
                deleteCardFromDeck(cardId);
            });
        });

        function deleteCardFromDeck(cardId) {
            fetch('delete_card.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ card_id: cardId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    const cardDiv = document.querySelector(`.delete-btn[data-card-id="${cardId}"]`).parentElement;
                    cardDiv.parentNode.removeChild(cardDiv);
                    alert('Card deleted successfully!');
                } else {
                    alert('Failed to delete card.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>