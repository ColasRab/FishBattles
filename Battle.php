<?php
include_once("Deck.php");
include_once("Effects.php");

session_start();

$userDeck = $_SESSION["UserDeck"];
$enemyDeck = $_SESSION["EnemyDeck"];

$userDeckJson = $userDeck->getCardsJson();
$enemyDeckJson = $enemyDeck->getCardsJson();

$userDeckJson = $userDeck->getCardsJson();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukaan</title>
    <link rel="stylesheet" href="battle.css" />
    <script type="module" defer>
        import Game from './Game.js';

        window.onload = function() {
            const userDeck = JSON.parse(<?php echo json_encode($userDeckJson); ?>);
            const enemyDeck = JSON.parse(<?php echo json_encode($enemyDeckJson); ?>);

            const session = new Game(userDeck, enemyDeck);
            session.mainGame();

            for (let i = 1; i <= 10; i++) {
                if (document.getElementById(`summon${i}`).src == null) {
                    document.getElementById(`summon${i}`).style.display = none;
                }
            }
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
            <button id="summonButton">Summon</button>
            <button id="setButton">Set</button>
            <button id="cancelButton">Cancel</button>
        </div>
    </div>

    <div class="container">
        <div class="enemy_hand">
        </div>
        <div class="user_hand">
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

            <div class="card" id=1>
                <img id="summon1" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_1" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=2>
                <img id="summon2" src="" alt="Card 2" width="120" height="160" style=display:none;>
                <p id="card_slot_2" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=3>
                <img id="summon3" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_3" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=4>
                <img id="summon4" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_4" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=5>
                <img id="summon5" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_5" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=6>
                <img id="summon6" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_6" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=7>
                <img id="summon7" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_7" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=8>
                <img id="summon8" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_8" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=9>
                <img id="summon9" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_9" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
            <div class="card" id=10>
                <img id="summon10" src="" alt="Card 1" width="120" height="160" style=display:none;>
                <p id="card_slot_10" style="font-weight: 600; font-size: 25px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
            </div>
        </div>

    </div>
<div class="summoned_card_animation"></div>
</body>

</html>