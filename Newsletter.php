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
    <link rel="stylesheet" href="newsletter.css">
    <script src="home.js" defer></script>
</head>

<body>
    <div class="header">
        <div class="navbar">
            <button class="nav-button" onclick="location.href='Newsletter.php'">NEWSLETTER</button>
            <button class="nav-button" onclick="location.href='Inventory.php'">INVENTORY</button>
            <button class="play-button" onclick="location.href='Home.php'">HOME</button>
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


    <H1 style="text-align: center"> NEWS AND UPDATES </H1>

    <H3> Things had been good with the fishes. The fishes find shelter in the player's hands as a new wave of excitement
        washes over the underwater realm of Fish Battles. Players worldwide are diving into the depths to discover a stunning array of gobies,
        each bringing unique abilities and strategies to the game.
    </H3>
    <H3>Firstly, the Dwarf Goby has made a splash with its diminutive size but formidable presence. This tiny but tenacious goby boosts the
        defensive capabilities of its fellow fish cards, making it a valuable asset in strategies focused on endurance and resilience.
    </H3>
    <H3> Meanwhile, the Banded Goby has captivated players with its striking coloration and swift movements. Known for its agility, this goby
        allows players to draw extra cards during their turn, enabling faster deck cycling and enhancing the chance for strategic plays.
    </H3>
    <H3> Not to be outdone, the Mandarin Goby brings a touch of elegance to the game with its vibrant hues and mystical aura. This goby enhances the
        player's resource-gathering capabilities, ensuring a steady flow of cards and resources to fuel their strategies over the course of the game.
    </H3>
    <H3> Get ready for an exciting update in Fish Card Games 1.3! As we await its release, anticipation mounts as new fish species prepare to emerge,
        offering unique abilities and strategies that will enhance gameplay. Whether you're a seasoned player or new to the game, prepare for a wave
        of fresh challenges and thrilling adventures. Stay tuned for more updates as version 1.3 rolls out, promising an enhanced and dynamic
        experience in this beloved underwater strategy game.
    </H3>
    <H5> Message from ISDA STUDIOS <br> Sir ipasa mo na kami pls :((</H5>


</body>

</html>