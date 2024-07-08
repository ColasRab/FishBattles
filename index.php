<?php
session_start();

$usernameErr = "";
$passwordErr = "";
$loginErr = "";

$error = ['uname' => false, 'password' => false];

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btn-submit'])) {
        $username = test_input($_POST['uname']);
        $password = test_input($_POST['password']);

        if (empty($username)) {
            $usernameErr = "Username is required";
            $error['uname'] = true;
        }

        if (empty($password)) {
            $passwordErr = "Password is required";
            $error['password'] = true;
        }

        if (!$error['uname'] && !$error['password']) {
            include('SQLConnect.php');
            $username = mysqli_real_escape_string($con, $username);
            $password = mysqli_real_escape_string($con, $password);
            $sql = "SELECT * FROM users WHERE username = '$username' AND pass = '$password'";
            $res = mysqli_query($con, $sql);

            if ($res && mysqli_num_rows($res) > 0) {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header("Location: ProfileDashboard.php");
                exit;
            } else {
                $loginErr = "Invalid Username/Password";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Battles</title>
    <link rel="stylesheet" href="member.css">
</head>

<body>
    <audio src="assets/login.mp3" autoplay loop></audio>
    <div id="page" class="site">

        <div class="container">
            <div class="login">

                <div class="img_title">

                    <img src="assets/Logo.png" width=1080px height=520px>
                </div>
                <form method="post">
                <span class="error"> <?php echo $loginErr; ?></span>
                    <div class="text-input">
                        
                        <i class="ri-user-fill">

                            <input type="text" name="uname" id="uname" placeholder="Username" value="<?php $username?>">

                        </i>
                        
                    </div>
                    <span class="error"> <?php echo $usernameErr; ?></span>
                    <div class="text-input">
                        <i class="ri-lock-fill">
                            <input type="password" name="password" id="password" placeholder="Password" value="<?php $password?>">

                        </i>
                        
                    </div>
                    <span class="error"> <?php echo $passwordErr; ?></span>
                    <button type="submit" name="btn-submit" class="login-btn">LOGIN</button>
                </form>
                <br/>
                <a href="member.php"> Not a member? Register </a>
            </div>
        </div>
        <div class="img_bg">
            <img src="assets/corals.gif" width=1920>
        </div>
    </div>

</body>

</html>