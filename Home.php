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
    <link rel="stylesheet" href="home.css">
    <script src="home.js" defer></script>
</head>

<body>
    <div class="header">
        <div class="navbar">
            <button class="nav-button" onclick="location.href='Newsletter.php'">NEWSLETTER</button>
            <button class="nav-button" onclick="location.href='Inventory.php'">INVENTORY</button>
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
                <img src="assets/bg_bot.png" height="720" width="1280" alt="Background Bottom" style="top: 590px;">
                <img src="assets/bed.png" height="720" width="1280" alt="Background Middle" style="top: 540px;">
                <img src="assets/bgcorals.gif" height="720" width="1280" alt="Background Top">
                <div class="logo">
                    <img src="assets/Logo.png" height="720" width="1453" alt="Background Title">
                </div>
                <img src="assets/light.png" height="1080" width="2180" alt="Background lightings" style="top: 80px;">
                <img src="assets/chest.png" height="720" width="1453" alt="Background final item">
            </div>

            <div class="main_container"></div>
        </div>

        <div class="friends_bar" id="friendsBar">
            <p>This side is still under construction</p>
        </div>
</body>

</html>
