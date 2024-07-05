<?php


include("Deck.php");
include("Effects.php");
include("Hand.php");

session_start();

$userDeck = new Deck();
$enemyDeck = new Deck();

function userPreBattle()
{
    $userDeck = $_SESSION["UserDeck"];
    $userDeck->shuffle();
    $card = [];
    for ($i = 0; $i < 5; $i++) {
        $yow = $userDeck->draw();
        $card[$i] = $yow;
    }
    return $card;
}

function enemyPreBattle()
{
    $enemyDeck = $_SESSION["EnemyDeck"];
    $enemyDeck->shuffle();
    $card = [];
    for ($i = 0; $i < 5; $i++) {
        $yow = $enemyDeck->draw();
        $card[$i] = $yow;
    }
    return $card;
}

$userHand = new Hand(userPreBattle());
$enemyHand = new Hand(enemyPreBattle());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukaan</title>
    <link rel="stylesheet" href="battle.css" />
    <script>
        function showDescription(cardElement) {

            document.getElementById('description').innerText = '';

            const descriptionData = JSON.parse(cardElement.dataset.description);
            const description = descriptionData.desc;

            document.getElementById('description').innerText = description;
            document.getElementsByClassName('description_container')[0].style.display = 'flex';

            const imageData = JSON.parse(cardElement.dataset.image);
            const imageUrl = imageData.desc;
            document.getElementById('cardImage').src = imageUrl;

            const nameData = JSON.parse(cardElement.dataset.name);
            const name = nameData.desc;
            console.log(name);
            document.getElementById('cardName').innerText = name;

            const atkData = JSON.parse(cardElement.dataset.attack);
            const atk = atkData.desc;
            console.log(atk);
            document.getElementById('atkCard').innerHTML = "<img src='assets/SWORD.png' width='30px' height='30px' style='vertical-align: middle;'> " + atk;

            const defData = JSON.parse(cardElement.dataset.defense);
            const def = defData.desc;
            document.getElementById('defCard').innerHTML = "<img src='assets/SHIELD.png' width='30px' height='30px' style='vertical-align: middle;'> " + def;

            <?php
            //$activeCard = $userDeck->fetchActiveCard(name)
            ?>

        }

        function hideDescription() {
            document.getElementsByClassName('description_container')[0].style.display = 'none';
        }

        function summonCard(cardElement) {
            console.log("i pressed" + cardElement.dataset.name)
            const nameData = JSON.parse(cardElement.dataset.name);
            const name = nameData.desc;
            document.getElementById('summonCard').innerText = name;
            document.getElementsByClassName('summon_container')[0].style.display = 'flex';
        }

        function hideSummonContainer() {
            document.getElementsByClassName('summon_container')[0].style.display = 'none';
        }

        function placeCard(cardElement){
            const divId = cardElement.dataset.id
            console.log(divId);
        }




    </script>
</head>

<body>
    <div class="description_container">
        <div class="desc_title">
            <p id="cardName"></p>
        </div>

        <div class="desc_card">
            <div class="desc_image">
                <img id="cardImage" src="" alt="Card Image" width="160" height="240">
            </div>
            <div class="desc_stats">

                <p id="atkCard"></p>
                <p id="defCard"></p>
            </div>
        </div>
        <div class="desc_gap">
            <p>&nbsp;</p>
        </div>
        <div class="desc_text">
            <p id="description"></p>
        </div>
    </div>

    <div class="summon_container">
        <div class="summon_message">
            <p>Do you want to summon: </p>
            <p id="summonCard"></p>
        </div>
        <div class="summon_buttons">
            <button onclick="hideSummonContainer()">Summon</button>
            <button onclick="hideSummonContainer()">Set</button>
            <button onclick="hideSummonContainer()">Cancel</button>
        </div>
    </div>


    <div class="container">
        <div class="enemy_hand">
            <?php
            $enemyHand->displayEnemyCard();
            ?>
        </div>
        <div class="user_hand">
            <?php
            $userHand->displayCards();
            ?>
        </div>


        <div class="enemy_battlefield">
            <div class="card">Card 1</div>
            <div class="card">Card 2</div>
            <div class="card">Card 2</div>
            <div class="card">Card 2</div>
            <div class="card">Card 2</div>
            <div class="card">Card 2</div>
            <div class="card">Card 5</div>
            <div class="card">Card 2</div>
            <div class="card">Card 5</div>
            <div class="card">Card 2</div>

        </div>
        <div class="battlefield">
            <div class="card" data-id=1 onclick="placeCard(this)">Card 1</div>
            <div class="card" data-card-id=2>Card 2</div>
            <div class="card" data-card-id=3>Card 2</div>
            <div class="card" data-card-id=4>Card 2</div>
            <div class="card" data-card-id=5>Card 2</div>
            <div class="card" data-card-id=6>Card 2</div>
            <div class="card" data-card-id=7>Card 5</div>
            <div class="card" data-card-id=8>Card 2</div>
            <div class="card" data-card-id=9>Card 5</div>
            <div class="card" data-card-id=10>Card 2</div>
        </div>

    </div>

</body>

</html>