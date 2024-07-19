<?php
session_start();

include('SQLConnect.php');

$user_id = $_SESSION['user_id'];
$user_coins = isset($_SESSION['coins']) ? $_SESSION['coins'] : 0;

function gacha($con, $user_id, $user_coins)
{
    $cards = fetchCards($con);
    if ($cards) {
        $selectedCard = selectRandomCard($cards);
        $selectedCardId = $selectedCard['id']; // Extract the card ID
        $new_coins = $user_coins - 100;

        $con->begin_transaction();

        try {
            // Update the user's coins
            $sql = "UPDATE currency SET coins = ? WHERE user_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ii", $new_coins, $user_id);
            if (!$stmt->execute()) {
                throw new Exception("Failed to update coins");
            }

            // Fetch current cards from the deck
            $sql = "SELECT cards FROM decks WHERE user_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $currentCards = $row['cards'];

            // Append the new card ID to the existing cards string
            if (!empty($currentCards)) {
                $newCards = $currentCards . ',' . $selectedCardId;
            } else {
                $newCards = $selectedCardId;
            }

            // Update the cards in the deck
            $sql = "UPDATE decks SET cards = ? WHERE user_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("si", $newCards, $user_id);
            if (!$stmt->execute()) {
                throw new Exception("Failed to update user cards");
            }

            $con->commit();

            $_SESSION['coins'] = $new_coins;
            $_SESSION['cardResult'] = $selectedCard;

            echo "<script>console.log('You got a {" . $_SESSION['cardResult']['name'] . " " . $_SESSION['cardResult']['rarity'] . "}')</script>";
            return ["status" => "success", "coins" => $new_coins, "card" => $selectedCard];
        } catch (Exception $e) {
            $con->rollback();
            return ["status" => "error", "message" => $e->getMessage()];
        }

        $stmt->close();
    } else {
        return ["status" => "error", "message" => "Failed to fetch cards"];
    }
}

function fetchCards($con)
{
    $sql = "SELECT * FROM cards";
    $result = $con->query($sql);

    $cards = [];
    while ($row = $result->fetch_assoc()) {
        $cards[] = $row;
    }
    return $cards;
}

function selectRandomCard($cards)
{
    $totalWeight = 0;
    $cumulativeWeights = [];

    foreach ($cards as $card) {
        $totalWeight += getCardWeight($card['rarity']);
        $cumulativeWeights[] = $totalWeight;
    }

    $randomWeight = rand(0, $totalWeight - 1);

    foreach ($cards as $index => $card) {
        if ($randomWeight < $cumulativeWeights[$index]) {
            return $card;
        }
    }

    return $cards[array_rand($cards)];
}

function getCardWeight($rarity)
{
    switch ($rarity) {
        case 'Legendary':
            return 1;
        case 'Epic':
            return 5;
        case 'Rare':
            return 20;
        case 'Common':
            return 74;
        default:
            return 1;
    }
}

gacha($con, $user_id, $user_coins);

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Battles</title>
    <link rel="stylesheet" href="gacharesult.css">
    <script src="gacharesult.js"></script>
</head>

<body>
    <div class="preloader" id="preloader">
        <video src="assets/BLUE.mp4" autoplay></video>
    </div>

    <div class="header">
        <button id="back" onclick="window.location.href = 'Home.php';">← Back to Menu</button>
        <p>Welcome to Gacha-Card</p>
        <div class="currency">
            <div class="coins">
                <p id="coins"><?php echo $_SESSION['coins']; ?></p>
                <img src="assets/COINSCURRENCY.png" width="211.90" height="60" alt="Coins">
            </div>
            <div class="pearls">
                <p id="pearls"><?php echo $_SESSION['pearls']; ?></p>
                <img src="assets/PEARLSCURRENCY.png" width="211.90" height="60" alt="Pearls">
            </div>
        </div>
    </div>

    <div class="main_body">
        <div id="resultModal" class="modal" style="<?php echo isset($_SESSION['cardResult']) ? 'display:block;' : 'display:none;'; ?>">
            <div class="modal-content">
                <span class="close-button" onclick="closeModal()">&times;</span>
                <h2 id="resultTitle">Congratulations!</h2>
                <img id="resultImage" src="<?php echo isset($_SESSION['cardResult']) ? $_SESSION['cardResult']['image_url'] : ''; ?>" alt="Card Image">
                <p id="resultText"><?php echo isset($_SESSION['cardResult']) ? "You got a {$_SESSION['cardResult']['name']}! ({$_SESSION['cardResult']['rarity']})" : ''; ?></p>
            </div>
        </div>
    </div>

</body>

</html>
