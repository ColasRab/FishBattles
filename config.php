<?php
session_start();
include("Deck.php");
/*$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "fish_battle";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno()) {
    echo "Gateway to server: Connected";
    mysqli_connect_error();
    exit();
}*/


$cardData = [
    [
        "id" => "F0001",
        "name" => "Amanieshrimp",
        "type" => "Fish",
        "description" => "When this card is tributed to summon another fish, add 500 to the attack damage of that fish.",
        "image_url" => "assets/cards/AMANIESHRIMP.png",
        "rarity" => "Common",
        "atk" => 400,
        "def" => 600

        //okay
    ],
    [
        "id" => "F0003",
        "name" => "Xīxuè the Chinese Algae Eater",
        "type" => "Fish",
        "description" => "Gain 1 Effect counter every standby phase. After getting 3 effect counters, you can attack the opponent’s life points directly.",
        "image_url" => "assets/cards/XIXUE.png",
        "rarity" => "Common",
        "atk" => 900,
        "def" => 500,

        //okay
    ],
    [
        "id" => "F0004",
        "name" => "Betta",
        "type" => "Fish",
        "description" => "During attack phase, add half of defense into its attack point. This effect can be used only once per attacking phase.",
        "image_url" => "assets/cards/ANGRYBETTA.png",
        "rarity" => "Common", "atk" => 1500,
        "def" => 1000,

        //okay
    ],
    [
        "id" => "F0005",
        "name" => "Giga Apple",
        "type" => "Fish",
        "description" => "When this card is on the field in defense position, gain 200 defense points every standby phase.",
        "image_url" => "assets/cards/GIGA.png",
        "rarity" => "Common",
        "atk" => 200,
        "def" => 1900,

        //okay
    ],
    [
        "id" => "F0006",
        "name" => "Cardinal",
        "type" => "Fish",
        "description" => "When this card is destroyed by battle, gain 1000 life points.",
        "image_url" => "assets/cards/CARDINAL.png",
        "rarity" => "Common",
        "atk" => 300,
        "def" => 1900,

        //okay
    ],
    [
        "id" => "F0025",
        "name" => "Pyro Goby-kun",
        "type" => "Fish",
        "description" => "Shoots Flames that deal 30% of defeated fish's attack to opponent's life force",
        "image_url" => "assets/cards/PYRO.png",
        "rarity" => "Common",
        "atk" => 1900,
        "def" => 400,
    ],
    [
        "id" => "F0026",
        "name" => "Dia Goby-kun",
        "type" => "Fish",
        "description" => "Dia Goby likes cute things :3",
        "image_url" => "assets/cards/DIA.png",
        "rarity" => "Common",
        "atk" => 0,
        "def" => 2000,
    ],
    [
        "id" => "F0027",
        "name" => "Ice Goby-kun",
        "type" => "Fish Card",
        "description" => "During attack phase, return an Opponent's Card to the Hand",
        "image_url" => "assets/cards/GUPPY.png",
        "rarity" => "Uncommon",
        "atk" => 1800,
        "def" => 1000,
    ],
];

$userDeck = new Deck();
$userDeck->addDeck($cardData);
$enemyDeck = new Deck();
$enemyDeck->addDeck($cardData);

if(isset($_POST['draw'])){
    $_SESSION['UserDeck'] = $userDeck;
    $_SESSION['EnemyDeck'] = $enemyDeck;

    header('Location: Battle.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Battle</title>
</head>
<body>
    <?php
    // Assuming you have a function to draw a card from the deck
    $drawnCard = $userDeck->draw(); // You need to implement this logic

    if ($drawnCard) {
        echo "<h2>Drawn Card:</h2>";
        echo "<p>Name: " . $drawnCard->getCardName() . "</p>";
        echo "<p>Type: " . $drawnCard->getCardType() . "</p>";
        echo "<p>Description: " . $drawnCard->getCardDesc() . "</p>";
        // Add other card properties as needed
    } else {
        echo "<p>No cards left in the deck.</p>";
    }
    ?>

    <form method="post">
        <button type="submit" name="draw">Draw</button>
    </form>
</body>
</html>
