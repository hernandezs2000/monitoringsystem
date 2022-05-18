<?php

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body class="login">
        <div class="container">
            <div class="cover">
                <div class="front">
                    <img src="images/students.jpg" alt="">
                    <div class="text">
                    <span class="text-1">BE INFORMED</span><br>
                    <span class="text-2">BE PREPARED</span><br>
                    <span class="text-3">BE SMART</span><br>
                    <span class="text-4">BE SAFE</span>
                    </div>
                </div>
            </div>
            <form action="main/home.php" class="loginForm" method="post">
                <div class="form-content">
                    <div class="login-form">
                        <div class="title">Login</div>
                        <div class="input-boxes">
                            <div class="input-box">
                                <img src="images/mail.png">
                                <input type="text" name="username" placeholder="Enter your username">

                            </div>
                            <div class="password-box">
                                <img src="images/password.png">
                                <input type="password" name="password" placeholder="Enter your password">
                                <span class="error-message"></span>
                            </div>
                            <div class="buttoninput-box1">
                               <!-- <img src="images/password.png"> -->
                                <input type="submit" id="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
