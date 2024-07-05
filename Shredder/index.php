<?php
session_start();

include("Deck.php");

$cardData = [
    [
        "id" => "F0001",
        "name" => "Amanieshrimp",
        "type" => "Fish",
        "description" => "When this card is tributed to summon another fish, add 500 to the attack damage of that fish.",
        "image_url" => null,
        "rarity" => "Common",
        "atk" => 400,
        "def" => 600
    ],
    [
        "id" => "F0003",
        "name" => "Xīxuè the Chinese Algae Eater",
        "type" => "Fish",
        "description" => "Gain 1 Effect counter every standby phase. After getting 3 effect counters, you can attack the opponent’s life points directly.",
        "image_url" => null,
        "rarity" => "Common",
        "atk" => 900,
        "def" => 500,
    ],
    [
        "id" => "F0004",
        "name" => "Betta",
        "type" => "Fish",
        "description" => "During attack phase, add half of defense into its attack point. This effect can be used only once per attacking phase.",
        "image_url" => null,
        "rarity" => "Common", "atk" => 1500,
        "def" => 1000,
    ],
    [
        "id" => "F0005",
        "name" => "Giga Apple",
        "type" => "Fish",
        "description" => "When this card is on the field in defense position, gain 200 defense points every standby phase.",
        "image_url" => null,
        "rarity" => "Common",
        "atk" => 200,
        "def" => 1900,
    ],
    [
        "id" => "F0006",
        "name" => "Cardinal",
        "type" => "Fish",
        "description" => "When this card is destroyed by battle, gain 1000 life points.",
        "image_url" => null,
        "rarity" => "Common",
        "atk" => 300,
        "def" => 1900,
    ],
];

$userDeck = new Deck($cardData);

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
    $userDeck ->shuffle();
    $drawnCard = $userDeck->draw();

    if ($drawnCard) {
        echo "<h2>Drawn Card:</h2>";
        echo "<p>Name: " . $drawnCard->getCardName() . "</p>";
        echo "<p>Type: " . $drawnCard->getCardType() . "</p>";
        echo "<p>Description: " . $drawnCard->getCardDesc() . "</p>";
    } else {
        echo "<p>No cards left in the deck.</p>";
    }
    ?>
</body>
</html>
