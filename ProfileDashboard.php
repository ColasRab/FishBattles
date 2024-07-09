<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Battles - Profile Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(assets/BODYBATTLE.png);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Preloader styles */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9;
        }

        .preloader video {
            max-width: 100%;
            max-height: 100%;
        }

        .sidebar {
            width: 250px;
            background-image: url(assets/2.png);
            padding: 20px;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
        }

        .inside_sidebar {
            padding-top: 10px;
            padding-left: 20px;
            width: 230px;
            height: 95vh;
            border-radius: 10px;
            background-color: #1a1a1a;
        }

        .sidebar h2 {
            color: #fff;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: #ccc;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar ul li a:hover {
            background-color: #0A5D76;
        }

        .sidebar ul li a img {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
            display: none; /* Hide by default */
        }

        .profile-header {
            display: flex;
            align-items: center;
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .profile-header img {
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-header .user-info h1 {
            margin: 0;
        }

        .profile-header .user-info p {
            margin: 5px 0;
            color: #aaa;
        }

        .main-actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .main-actions .action {
            background-color: #444;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            color: #fff;
            text-decoration: none;
            width: 50%;
            margin: 0 1%;
            box-sizing: border-box;
        }

        .main-actions .action img {
            display: block;
            margin: 0 auto 10px;
        }

        .ad-section {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        .completed-games {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .completed-games table {
            width: 100%;
            border-collapse: collapse;
        }

        .completed-games th,
        .completed-games td {
            padding: 10px;
            border: 1px solid #444;
            text-align: center;
        }

        .completed-games th {
            background-color: #555;
        }

        .live-section,
        .puzzle-section {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="preloader" id="preloader">
        <video src="assets/intro.mp4" autoplay></video>
    </div>
    <div class="sidebar">
        <div class="inside_sidebar">
            <h2>Fish Battles</h2>
            <ul>
                <li><a href="config.php"><img src="https://via.placeholder.com/20" alt="Play icon"> Play</a></li>
                <li><a href="#"><img src="https://via.placeholder.com/20" alt="Play Computer icon"> Deck Editor</a></li>
                <li><a href="#"><img src="https://via.placeholder.com/20" alt="Tournaments icon"> Tournaments</a></li>
                <li><a href="#"><img src="https://via.placeholder.com/20" alt="4 Player icon"> Newsletters</a></li>
                <li><a href="#"><img src="https://via.placeholder.com/20" alt="Leaderboard icon"> Leaderboard</a></li>
            </ul>
            <div style="margin-top: auto;">
                <div style="margin-top: 20px; display: flex; justify-content: space-between; color: #ccc;">
                    <a href="#" style="color: #ccc;">Light UI</a>
                    <a href="#" style="color: #ccc;">Collapse</a>
                </div>
                <div style="margin-top: 20px;">
                    <a href="#" style="color: #ccc;">Settings</a><br>
                    <a href="#" style="color: #ccc;">Help</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content" id="main-content">
        <div class="profile-header">
            <img src="https://via.placeholder.com/100" alt="User profile picture">
            <div class="user-info">
                <h1>Username</h1>
                <p>Rating: 1500</p>
                <p>Member since: January 2024</p>
            </div>
        </div>
        <div class="main-actions">
            <a href="#" class="action">
                <img src="https://via.placeholder.com/50" alt="New Game icon">
                Find Match
            </a>

            <a href="#" class="action">
                <img src="https://via.placeholder.com/50" alt="Friend icon">
                Deck Editor
            </a>

        </div>
        <div class="ad-section">
            <p>Want to remove ads? Upgrade to Fish Battles Premium!</p>
            <a href="#" class="action">Go Premium</a>
        </div>
        <div class="completed-games">
            <h2>Completed Games</h2>
            <table>
                <thead>
                    <tr>
                        <th>Players</th>
                        <th>Result</th>
                        <th>Accuracy</th>
                        <th>Moves</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>rb_nimitz (770) vs giladc (735)</td>
                        <td>1-0</td>
                        <td>90%</td>
                        <td>21</td>
                        <td>Jul 2, 2024</td>
                    </tr>
                    <tr>
                        <td>ChoritoMuerto (762) vs rb_nimitz (762)</td>
                        <td>0-1</td>
                        <td>85%</td>
                        <td>8</td>
                        <td>Jul 2, 2024</td>
                    </tr>
                    <tr>
                        <td>rb_nimitz (794) vs igatsky (794)</td>
                        <td>1-1</td>
                        <td>88%</td>
                        <td>22</td>
                        <td>Jul 1, 2024</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="live-section">
            <h2>Live on FishTV</h2>
            <img src="https://via.placeholder.com/300x200" alt="Live stream">
        </div>
        <div class="puzzle-section">
            <h2>Daily Puzzle</h2>
            <img src="https://via.placeholder.com/300x200" alt="Daily puzzle">
        </div>
    </div>

    <script>
        const preloader = document.getElementById('preloader');
        const mainContent = document.getElementById('main-content');
        const video = preloader.querySelector('video');

        video.addEventListener('ended', function() {
            preloader.style.display = 'none';
            mainContent.style.display = 'block';
        });
    </script>
</body>

</html>
