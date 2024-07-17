<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Battles</title>
    <link rel="stylesheet" href="gacha.css">
    <script src="gacha.js" defer></script>
</head>

<body>
    <div class="header">
        <div class="back_to_menu">
            <button id="back" onclick="window.location.href = 'Home.php';">←
                Back to Menu
            </button>
        </div>
        <div class="title">
            <p>Welcome to Gacha-Card</p>
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

    <div class="main_body">
        <div id="main">
            <div class="bg_image">
                <img src="assets/bg_bot.png" height="810" width="1440" alt="Background Bottom" style="top: 590px;">
                <img src="assets/bed.png" height="810" width="1440" alt="Background Middle" style="top: 540px;">
                <img src="assets/bgcorals.gif" height="810" width="1440" alt="Background Top">
                <img src="assets/light.png" height="1080" width="2180" alt="Background lightings" style="top: 80px;">
                <img src="assets/chest.png" height="720" width="1453" alt="Background final item">
            </div>
            <div class="main_container">
                <div class="gacha_container">
                    <div class="pack_image">
                        <img src="assets/GACHAIMG.png" alt="Selection Pack">
                        <div class="pack_title">
                            <p>
                                <span1>goby's</span1><br />sanctuary
                            </p>
                        </div>
                        <div class="pack_details">
                            <p>Get a chance to win a <spaning> Legendary Card</spaning>
                            </p>
                        </div>
                        <div class="promote_card">
                            <img src="assets/cards/GOBYKING.png" alt="Promote Card">
                        </div>
                    </div>
                </div>
                <div class="gacha_button" onclick="gacha()">
                    <img src="assets/GACHABUTTON.png" width="360px" height="90px">
                </div>
            </div>
        </div>
    </div>
</body>

</html>