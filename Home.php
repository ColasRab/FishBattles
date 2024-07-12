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
    <script src="home.js"></script>
</head>

<body>

    <div class="preloader_video">

    </div>
    <div class="main_body">
        <audio src="assets/soundtrack.mp3" autoplay loop></audio>
        <div class="bg_image">
            <img src="assets/bg_bot.png" height="720" width="1280" alt="Background Bottom" style="top: 590px;">
            <img src="assets/bed.png" height="720" width="1280" alt="Background Middle" style="top: 540px;">
            <img src="assets/bgcorals.gif" height="720" width="1280" alt="Background Top">
            <div class="logo">
                <img src="assets/Logo.png" height="720" width="1453" alt="Background Title" style=>
            </div>
            <img src="assets/light.png" height="1080" width="2180" alt="Background lightings" style="top: 80px;">
            <img src="assets/chest.png" height="720" width="1453" alt="Background final item">

        </div>
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>

        <div id="main">
            <div class="header">
                <button class="openbtn" onclick="openNav()">☰</button>
                <span> Home </span>
                <div class="profile_header">
                    <div class="text_profile">
                        <div class="username">
                            <?php echo " " . $username; ?>
                        </div>
                        <div class="status_container">
                            <div id="status-circle" class="status-circle offline"></div>
                            <span class="status-text" id="status-text">Offline</span>
                        </div>
                    </div>
                    <img src="assets/profile_pic.gif" height="60" width="60" alt="Profile Picture">
                </div>
            </div>
            <div class="main_container">
            </div>
        </div>
</body>

</html>