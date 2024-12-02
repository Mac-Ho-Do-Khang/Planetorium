<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="content/img/fevv.png" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/queries.css" />
    <link rel="stylesheet" href="css/login.css" />
    <script
        defer
        src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
    <!-- <script defer src="script.js"></script> -->
    <title>Plenetorium - Login</title>
</head>

<body>
    <header class="header">
        <a href="index.php?page=home"><img src="content/img/app/logobc.png" class="logo" /></a>
        <nav class="header-nav">
            <ul class="header-nav-list">
                <li><a class="header-nav-link" href="index.php?page=home">Home</a></li>
                <div class="dropdown">
                    <li><a class="header-nav-link" href="index.php?page=products">Products &#9660;</a></li>
                    <div class="dropdown-content">
                        <a href="#">Earth-like</a>
                        <a href="#">Watery</a>
                        <a href="#">Ring</a>
                    </div>
                </div>
                <li><a class="header-nav-link" href="index.php?page=contacts">Contacts</a></li>
                <li>
                    <a href="index.php?page=register" class="header-nav-link call-to-action">Sign up</a>
                </li>
            </ul>
        </nav>
        <button class="mobile-btn">
            <ion-icon class="mobile-icon" name="menu"></ion-icon>
            <ion-icon class="mobile-icon" name="close"></ion-icon>
        </button>
    </header>
    <section class="hero-section">
        <div class="hero">
            <div class="hero-img-box">
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <div class="tile"></div>
                <!-- <div class="shadow"></div> -->
            </div>

            <!--------------- Login processing without AJAX ------------------>
            <!-------------- display messages handled by PHP ----------------->
            <!-- <form action="login_processing_without_AJAX.php" method="post">
                <div class="container login">
                    <label for="uname"><b>Username</b></label>
                    <input class="email" id="email"
                        type="text" placeholder="Enter Email" name="email" required>

                    <label for="psw"><b>Password</b></label>
                    <input class="password" id="password"
                        type="password" placeholder="Enter Password" name="password" required>

                    <button class="btn btn-outline login-btn" type="submit">Login</button>
                    <div class="below-login-btn">
                        <label>
                            <input type="checkbox" checked="checked" name="remember"> Remember me
                        </label>
                        <div class="login-notify">
                            <?php
                            // if (isset($_SESSION['login_message'])) {
                            //     echo $_SESSION['login_message'];
                            //     unset($_SESSION['login_message']);  // Clear the message after displaying it
                            // }
                            ?>
                        </div>
                    </div>
                </div>
            </form> -->

            <!------------------- Login processing with AJAX ------------------------>
            <!-------------- display messages handled by JavaScript ----------------->
            <form>
                <div class="container login">
                    <label for="uname"><b>Username</b></label>
                    <input class="email" id="email" type="text" placeholder="Enter Email" name="email" required>

                    <label for="psw"><b>Password</b></label>
                    <input class="password" id="password" type="password" placeholder="Enter Password" name="password" required>

                    <button class="btn btn-outline login-btn" type="submit">Login</button>
                    <div class="below-login-btn">
                        <label>
                            <input type="checkbox" checked="checked" name="remember"> Remember me
                        </label>
                        <div class="login-notify"></div>
                    </div>
                </div>
            </form>
        </div>

    </section>

    <script src="javascript/login_processing.js"></script>
</body>

</html>