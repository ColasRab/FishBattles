<?php
session_start();

$usernameErr = "";
$passwordErr = "";
$check_passwordErr = "";
$emailErr = "";
$termsErr = "";
$ageErr = "";

$error = ['uname' => false, 'password' => false, 'email' => false, 'check_password' => false, 'terms' => false, 'age' => false];

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
        $email = test_input($_POST['email']);
        $check_password = test_input($_POST['check_password']);
        $isLegal = isset($_POST['isLegal']);
        $terms_conditions = isset($_POST['terms_conditions']);

        // Username validation
        if (empty($username)) {
            $usernameErr = "Username is required";
            $error['uname'] = true;
        } else {
            $error['uname'] = false;
        }

        // Password validation
        if (empty($password)) {
            $passwordErr = "Password is required";
            $error['password'] = true;
        } else {
            $error['password'] = false;
        }

        // Email validation
        if (empty($email)) {
            $emailErr = "Email is required";
            $error['email'] = true;
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $error['email'] = true;
            } else {
                $error['email'] = false;
            }
        }

        // Confirm password validation
        if (empty($check_password)) {
            $check_passwordErr = "Confirm Password is required";
            $error['check_password'] = true;
        } else if ($check_password != $password) {
            $check_passwordErr = "Passwords do not match";
            $error['check_password'] = true;
        } else {
            $error['check_password'] = false;
        }

        // Age validation
        if (!$isLegal) {
            $ageErr = "You must be over the age of 13";
            $error['age'] = true;
        } else {
            $error['age'] = false;
        }

        // Terms and conditions validation
        if (!$terms_conditions) {
            $termsErr = "You must agree to the terms and conditions";
            $error['terms'] = true;
        } else {
            $error['terms'] = false;
        }

        // Check if there are no errors
        if (!in_array(true, $error)) {
            include('SQLConnect.php');

            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, pass) VALUES ('$username', '$email', '$hashed_password')";
            $res = mysqli_query($con, $sql);


            if ($res) {
                echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let fadeElement = document.createElement("div");
                            fadeElement.style.position = "fixed";
                            fadeElement.style.top = "0";
                            fadeElement.style.left = "0";
                            fadeElement.style.width = "100%";
                            fadeElement.style.height = "100%";
                            fadeElement.style.backgroundColor = "black";
                            fadeElement.style.opacity = "0";
                            fadeElement.style.transition = "opacity 1s";
                            document.body.appendChild(fadeElement);
                            
                            setTimeout(function() {
                                fadeElement.style.opacity = "1";
                            }, 0);
    
                            setTimeout(function() {
                                window.location.href = "Home.php";
                            }, 3000);
                        });
                    </script>';
                exit;
            } else {
                echo "Error: " . mysqli_error($con);
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
                    <div class="text-input">
                        <i class="ri-lock-fill">
                            <input type="email" name="email" id="email" placeholder="Input Email" value="<?php $email ?>">
                        </i>
                    </div>
                    <span class="error"> <?php echo $emailErr; ?></span>
                    <div class="text-input">
                        <i class="ri-user-fill">
                            <input type="text" name="uname" id="uname" placeholder="Input Username" value="<?php $username ?>">
                        </i>
                    </div>
                    <span class="error"> <?php echo $usernameErr; ?></span>
                    <div class="text-input">
                        <i class="ri-user-fill">
                            <input type="password" name="password" id="password" placeholder="Input Password" value="<?php $username ?>">
                        </i>
                    </div>
                    <span class="error"> <?php echo $passwordErr; ?></span>
                    <div class="text-input">
                        <i class="ri-lock-fill">
                            <input type="password" name="check_password" id="password" placeholder="Confirm Password" value="<?php $password ?>">
                        </i>
                    </div>
                    <span class="error"> <?php echo $check_passwordErr; ?></span>
                    <br />
                    <input type="checkbox" name="isLegal"> <span class="text">Check the Box if you are over the age of 13 </span>
                    <br />
                    <br />
                    <input type="checkbox" name="terms_conditions"> <span class="text">Do You agree with the <a href="TandC.html">Terms and Conditions</a></span>
                    <button type="submit" name="btn-submit" class="login-btn">Sign Up</button>
                </form>
            </div>
        </div>
        <div class="img_bg">
            <img src="assets/corals.gif" width=1920>
        </div>
    </div>

</body>

</html>