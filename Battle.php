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
        let isSummon = false;
        let cardEvent

        function initialize(){
            if (document.getElementById('summon1').src == null){
                document.getElementById('summon1').style.display = none;
            }
            if (document.getElementById('summon2').src == null){
                document.getElementById('summon2').style.display = none;
            }
            if (document.getElementById('summon3').src == null){
                document.getElementById('summon3').style.display = none;
            }
        }

        

        function showDescription(event) {

            cardEvent = event;

            document.getElementById('description').innerText = '';

            const descriptionData = JSON.parse(event.dataset.description);
            const description = descriptionData.desc;

            document.getElementById('description').innerText = description;
            document.getElementsByClassName('description_container')[0].style.display = 'flex';

            const imageData = JSON.parse(event.dataset.image);
            const imageUrl = imageData.desc;
            document.getElementById('cardImage').src = imageUrl;

            const nameData = JSON.parse(event.dataset.name);
            const name = nameData.desc;
            console.log(name);
            document.getElementById('cardName').innerText = name;

            const atkData = JSON.parse(event.dataset.attack);
            const atk = atkData.desc;
            console.log(atk);
            document.getElementById('atkCard').innerHTML = "<img src='assets/SWORD.png' width='30px' height='30px' style='vertical-align: middle;'> " + atk;

            const defData = JSON.parse(event.dataset.defense);
            const def = defData.desc;
            document.getElementById('defCard').innerHTML = "<img src='assets/SHIELD.png' width='30px' height='30px' style='vertical-align: middle;'> " + def;
            <?php
            //$activeCard = $userDeck->fetchActiveCard(name)
            ?>

        }

        function hideDescription() {
            document.getElementsByClassName('description_container')[0].style.display = 'none';
        }

        function summonCard(event) {
            console.log("i pressed" + event.dataset.name)
            const nameData = JSON.parse(event.dataset.name);
            const name = nameData.desc;
            document.getElementById('summonCard').innerText = name;
            document.getElementsByClassName('summon_container')[0].style.display = 'flex';
        }

        function hideSummonContainer() {
            document.getElementsByClassName('summon_container')[0].style.display = 'none';
            isSummon = false;
        }

        function summonCondition() {
            document.getElementsByClassName('summon_container')[0].style.display = 'none';
            isSummon = true;
        }

        function placeCard(event) {
            console.log(isSummon)
            if (isSummon) {

                divId = event.dataset.id
                const nameData = JSON.parse(cardEvent.dataset.name);
                const name = nameData.desc;
                console.log(name);


                const imgData = JSON.parse(cardEvent.dataset.image);
                const img = imgData.desc;
                console.log(divId);
                isSummon = false;

                switch(divId){
                    case '1': 
                        document.getElementById('summon1').style.display = 'block';
                        document.getElementById('summon1').src = img;
                        document.getElementById('card_slot_1').innerHTML = atk + "<img src='assets/SWORD.png' width='10px' height='10px' style='vertical-align: middle;'> " + def + "<img src='assets/SHIELD.png' width='10px' height='10px' style='vertical-align: middle;'> ";
                        break;
                    case '2':
                        document.getElementById('summon2').style.display = 'block'; 
                        document.getElementById('summon2').src = img;
                        document.getElementById('card_slot_2').innerHTML = atk + "<img src='assets/SWORD.png' width='20px' height='20px' style='vertical-align: middle;'> " + def + "<img src='assets/SHIELD.png' width='30px' height='30px' style='vertical-align: middle;'> ";
                        
                        break;
                    case '3':
                        document.getElementById('summon3').src = img;
                        break;
                    case '4': 
                        document.getElementById('summon4').src = img;
                        break;
                    default:
                        console.log("nevaaaa");
                        break;
                }   
            }
        }
    </script>
</head>

<body>
    <script>initialize()</script>
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
            <button onclick="summonCondition()">Summon</button>
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
            <div class="card" data-id=1 onclick="placeCard(this)">
                <img id="summon1" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_1"></p>
            </div>
            <div class="card" data-id=2 onclick="placeCard(this)">
                <img id="summon2" src="" alt="Card 2" width="120" height="160" style=display:none;>
                <p id="card_slot_2"></p>
            </div>
            <div class="card" data-id=3 onclick="placeCard(this)">Card 2</div> 
            <div class="card" data-id=4 onclick="placeCard(this)">Card 2</div>
            <div class="card" data-id=5 onclick="placeCard(this)">Card 2</div>
            <div class="card" data-id=6>Card 2</div>
            <div class="card" data-id=7>Card 5</div>
            <div class="card" data-id=8>Card 2</div>
            <div class="card" data-id=9>Card 5</div>
            <div class="card" data-id=10>Card 2</div>
        </div>

    </div>

</body>

</html>