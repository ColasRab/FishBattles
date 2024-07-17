<?php
include("Deck.php");
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
$user_deck = new Deck();
$username = $_SESSION['username'];
$isNew = $_SESSION['isNewUser'];

if ($isNew) {   
    include('SQLConnect.php');
    $cards = ['F0001', 'F0002', 'F0004', 'F0006', 'F0009', 'F0011', 'F0014', 'F0016', 'F0017'];
    $cards_string = implode(",", $cards);
    $deck_name = "Starter Deck";
    $deck_description = "A deck of cards given to all new players";
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO decks (user_id, cards, name, description) VALUES ('$user_id', '$cards_string', '$deck_name', '$deck_description')";
    $res = mysqli_query($con, $sql);


    if ($res) {
        $placeholders = implode(',', array_fill(0, count($cards), '?'));
        $sql = "SELECT id, name, type, description, image_url, rarity, attack_points AS atk, def_points AS def, tributes_req 
                FROM cards 
                WHERE id IN ($placeholders)";
        $stmt = $con->prepare($sql);

        // Create an array of types for the bind_param call (all 's' for string)
        $types = str_repeat('s', count($cards));
        $stmt->bind_param($types, ...$cards);
        $stmt->execute();
        $result = $stmt->get_result();

        $cardData = [];
        while ($row = $result->fetch_assoc()) {
            $cardData[] = [
                "id" => $row['id'],
                "name" => $row['name'],
                "type" => $row['type'],
                "description" => $row['description'],
                "image_url" => $row['image_url'],
                "rarity" => $row['rarity'],
                "atk" => $row['atk'],
                "def" => $row['def'],
                "tribute_req" => $row['tributes_req']
            ];
        }

        $user_deck = new Deck();
        $user_deck->addDeck($cardData);
        $_SESSION['user_deck'] = $user_deck;
    } else {
        echo "Error inserting data into decks table: " . $con->error;
    }

    mysqli_close($con);
} else {
    include('SQLConnect.php');
    $sql = "SELECT cards FROM decks WHERE user_id = (SELECT id FROM users WHERE username = '$username')";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    $cards = explode(',', $row['cards']);

    $placeholders = implode(',', array_fill(0, count($cards), '?'));
    $sql = "SELECT id, name, type, description, image_url, rarity, attack_points AS atk, def_points AS def, tributes_req 
            FROM cards 
            WHERE id IN ($placeholders)";
    $stmt = $con->prepare($sql);

    // Create an array of types for the bind_param call (all 's' for string)
    $types = str_repeat('s', count($cards));
    $stmt->bind_param($types, ...$cards);
    $stmt->execute();
    $result = $stmt->get_result();

    $cardData = [];
    while ($row = $result->fetch_assoc()) {
        $cardData[] = [
            "id" => $row['id'],
            "name" => $row['name'],
            "type" => $row['type'],
            "description" => $row['description'],
            "image_url" => $row['image_url'],
            "rarity" => $row['rarity'],
            "atk" => $row['atk'],
            "def" => $row['def'],
            "tribute_req" => $row['tributes_req']
        ];
    }

    $user_deck = new Deck();
    $user_deck->addDeck($cardData);
    $_SESSION['user_deck'] = $user_deck;

}

$_SESSION['user_deck'] = $user_deck;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Battles</title>
    <link rel="stylesheet" href="home.css">
    <script src="home.js" defer></script>
</head>

<body>
    <div class="header">
        <div class="navbar">
            <button class="nav-button" onclick="location.href='Newsletter.php'">NEWSLETTER</button>
            <button class="nav-button" onclick="location.href='Team.php'">DEVS</button>
            <button class="play-button" onclick="location.href='#'">HOME</button>
            <button class="nav-button" onclick="location.href='Editor.php'">DECK EDITOR</button>
            <button class="nav-button" onclick="location.href='Gacha.php'">GACHA</button>
        </div>

        <div class="profile_header">
            <div class="username">
                <div class="name">
                    <?php echo " " . $username; ?>
                </div>
                <div class="status_container">
                    <div id="status-circle" class="status-circle"></div>
                    <span class="status-text" id="status-text"></span>
                </div>
            </div>
            <img src="assets/profile_pic.gif" height="50" width="50" alt="Profile Picture">
        </div>
    </div>

    <div class="hover-area"></div>

    <div class="main_body">
        <audio src="assets/soundtrack.mp3" autoplay loop></audio>

        <div id="main">
            <div class="bg_image">
                <img src="assets/bg_bot.png" height="640" width="1160" alt="Background Bottom" style="top: 500px;">
                <img src="assets/bed.png" height="640" width="1160" alt="Background Middle" style="top: 430px;">
                <img src="assets/bgcorals.gif" height="640" width="1160" alt="Background Top">
                <div class="logo">
                    <img src="assets/Logo.png" height="600" width="1223" alt="Background Title">
                </div>
                <img src="assets/light.png" height="1080" width="2180" alt="Background lightings" style="top: 80px;">
                <img src="assets/chest.png" height="640" width="1160" alt="Background final item">
            </div>

            <div class="main_container">
                <a href="battle.php">
                    <img src="assets/STARTBUTTON.png" width="360px" height="90px" alt="Start Button">
                </a>
            </div>

            <div class="friends_bar" id="friendsBar">
                <p>This side is still under construction</p>
            </div>
</body>

</html>