<?php
include_once("Deck.php");
include_once("Effects.php");

session_start();

$userDeck = $_SESSION['user_deck'];
$enemyDeck = $_SESSION['user_deck'];

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

            // Bind the nextPhase method to the button click event
            document.querySelector('.next_phase_button').onclick = function() {
                session.nextPhase();
            };
        };
    </script>

</head>

<body>
    <div class="game_frame">
        <div class="header">
            <div class="back_to_menu">
                <button id="back" onclick="window.location.href = 'Home.php';">←
                    Back to Menu
                </button>
            </div>
        </div>
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
                <div class="card" id=11>
                    <img id="summon11" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_11" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=12>
                    <img id="summon12" src="" alt="Card 12" width="90" height="120" style=display:none;>
                    <p id="card_slot_12" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=13>
                    <img id="summon13" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_13" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=14>
                    <img id="summon14" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_14" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=15>
                    <img id="summon15" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_15" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=16>
                    <img id="summon16" src="" alt="Card 1" width="90" height="1120" style=display:none;>
                    <p id="card_slot_16" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=17>
                    <img id="summon17" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_17" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=18>
                    <img id="summon18" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_18" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=19>
                    <img id="summon19" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_19" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=20>
                    <img id="summon20" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_20" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>

            </div>
            <div class="battlefield">

                <div class="card" id=1>
                    <img id="summon1" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_1" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=2>
                    <img id="summon2" src="" alt="Card 2" width="90" height="120" style=display:none;>
                    <p id="card_slot_2" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=3>
                    <img id="summon3" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_3" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=4>
                    <img id="summon4" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_4" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=5>
                    <img id="summon5" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_5" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=6>
                    <img id="summon6" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_6" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=7>
                    <img id="summon7" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_7" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=8>
                    <img id="summon8" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_8" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=9>
                    <img id="summon9" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_9" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
                <div class="card" id=10>
                    <img id="summon10" src="" alt="Card 1" width="90" height="120" style=display:none;>
                    <p id="card_slot_10" style="font-weight: 600; font-size: 15px; color:aliceblue; -webkit-filter: drop-shadow(1px 1px 5px #000); filter: drop-shadow(1px 1px 5px #000); "></p>
                </div>
            </div>

            <div class="next_phase_button">
                <img src="assets/NEXTPHASE.png" width="360px" height="90px" alt="next">
            </div>

            <div id="phaseDisplay"></div>
            <div id="userLifePoints"></div>
            <div id="enemyLifePoints"></div>
        </div>
        <div class="summoned_card_animation"></div>
    </div>
</body>

</html>