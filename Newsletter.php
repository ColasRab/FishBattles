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
            <button class="nav-button" onclick="location.href='#'">NEWSLETTER</button>
            <button class="nav-button" onclick="location.href='Team.php'">DEVS</button>
            <button class="play-button" onclick="location.href='Home.php'">HOME</button>
            <button class="nav-button" onclick="location.href='Editor.php'">DECK VIEWER</button>
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
                <img src="assets/light.png" height="1080" width="2180" alt="Background lightings" style="top: 80px;">
                <img src="assets/chest.png" height="720" width="1453" alt="Background final item">
            </div>

            <div class="main_container">
                
                <div class="poster">
                    <div class="card1">
                        <div class="text">Spoilers for Patch 1.3 Notes and Easter Eggs</div>
                    </div>

                </div>
                <div class="news1">
                    <H1> Spoilers for Patch 1.3 Notes and Easter Eggs </H1>

                    <H3>
                        Things have been good with the fishes. The fishes find shelter in the player's hands as a new wave of excitement washes over the underwater realm of Fish Battles. Players worldwide are diving into the depths to discover a stunning array of gobies, each bringing unique abilities and strategies to the game.
                        <br />
                        <br />
                        Firstly, the Dwarf Goby has made a splash with its diminutive size but formidable presence. This tiny but tenacious goby boosts the defensive capabilities of its fellow fish cards, making it a valuable asset in strategies focused on endurance and resilience.
                        <br />
                        <br />
                        Meanwhile, the Banded Goby has captivated players with its striking coloration and swift movements. Known for its agility, this goby allows players to draw extra cards during their turn, enabling faster deck cycling and enhancing the chance for strategic plays.
                        <br />
                        <br />
                        Not to be outdone, the Mandarin Goby brings a touch of elegance to the game with its vibrant hues and mystical aura. This goby enhances the player's resource-gathering capabilities, ensuring a steady flow of cards and resources to fuel their strategies over the course of the game.
                        <br />
                        <br />
                        In addition to these new gobies, we have some legendary fish cards that will add a unique twist to your gameplay:
                        <br />
                        <br />
                        - **Jellyfish**: This card cannot be summoned with Normal, Tribute, or Flip Summon. During the standby phase, target one opponent card and shift it to your playing field. After one turn, destroy that fish. This card is not affected by card effects or monster effects.
                        <br />
                        <br />
                        - **Gawr Gura**: With a formidable 5000 attack and defense, this card cannot be summoned with Normal, Tribute, or Flip Summon. It is not affected by card effects or monster effects.
                        <br />
                        <br />
                        - **Goby King**: Another powerful card with 5000 attack and defense, it cannot be summoned with Normal, Tribute, or Flip Summon and is not affected by card effects or monster effects.
                        <br />
                        <br />
                        These legendary cards can be obtained from the Gacha Store, adding an element of excitement and chance to your deck-building experience.
                        <br />
                        <br />
                        Get ready for an exciting update in Fish Card Games 1.3! As we await its release, anticipation mounts as new fish species prepare to emerge, offering unique abilities and strategies that will enhance gameplay. Whether you're a seasoned player or new to the game, prepare for a wave of fresh challenges and thrilling adventures. Stay tuned for more updates as version 1.3 rolls out, promising an enhanced and dynamic experience in this beloved underwater strategy game.
                    </H3>
                    <H5>Message from ISDA STUDIOS <br> Sir ipasa mo na kami pls :((</H5>
                </div>
                <div class="news2">

                </div>
            </div>
        </div>

        <div class="friends_bar" id="friendsBar">
            <p>This side is still under construction</p>
        </div>
</body>


</body>

</html>