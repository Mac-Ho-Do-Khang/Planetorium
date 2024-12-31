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
    <script
        defer
        src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
    <!-- <script defer src="script.js"></script> -->
    <title>Plenetorium - Register</title>
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
                    <a class="header-nav-link call-to-action" href="index.php?page=login">Login</a>
                </li>
            </ul>
        </nav>
        <button class="mobile-btn">
            <ion-icon class="mobile-icon" name="menu"></ion-icon>
            <ion-icon class="mobile-icon" name="close"></ion-icon>
        </button>
    </header>
    <section class="call-to-action" id="register">
        <div class="container">
            <div class="cta grid-container" style="--column: 2">
                <div class="cta-box">
                    <h2 class="subheading">
                        Enjoy your first interstellar journey for free!
                    </h2>
                    <p class="cta-text">
                        Discover your next world with our free interstellar tour. The
                        first visit is on us — no strings attached. Pause or cancel
                        anytime!
                    </p>

                    <form class="cta-form" name="form" method="post">
                        <div
                            class="grid-container"
                            style="--column: 2; --c-gap: 3.2rem; --r-gap: 2.4rem">
                            <div>
                                <label for="email"> Email:</label>
                                <input
                                    name="mail"
                                    type="email"
                                    id="email"
                                    placeholder="dokhang@example.com"
                                    required />
                            </div>
                            <div>
                                <label for="password"> Password:</label>
                                <input
                                    name="password"
                                    type="password"
                                    id="password"
                                    required
                                    pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[A-Z]).{8,}$"
                                    title="Password must be at least 8 characters long, contain at least one number, one uppercase and one lowercase letter.">
                            </div>
                            <div>
                                <label for="name"> Full name:</label>
                                <input name="name" type="text" id="name"
                                    placeholder="XiTrumbumbum" required />
                            </div>
                            <div>
                                <label for="where">Where did you hear from us?</label>
                                <select name="select" id="where" required>
                                    <option value="">Choose one</option>
                                    <option value="1">Family and friends</option>
                                    <option value="2">Social media</option>
                                    <option value="3">YouTube</option>
                                    <option value="4">Others</option>
                                </select>
                            </div>
                            <button class="btn btn-full">Sign up</button>
                            <div class="register-notify"><?php
                                                            include("database.php");
                                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                                $fullname = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);

                                                                $email = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_SPECIAL_CHARS);
                                                                // Check if email already exists in database
                                                                $sql = "select * from $tb_name where email = '$email'";
                                                                if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
                                                                    echo "Email already used.";
                                                                }

                                                                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
                                                                // Check if password meets the requirement
                                                                if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[A-Z]).{8,}$/", $password)) {
                                                                    echo "Password must be at least 8 characters long, contain at least one number, one uppercase and one lowercase letter.";
                                                                }

                                                                $hearfrom = filter_input(INPUT_POST, "select", FILTER_SANITIZE_SPECIAL_CHARS);
                                                                switch ($hearfrom) {
                                                                    case '1':
                                                                        $hearfrom = 'Family and friends';
                                                                        break;
                                                                    case '2':
                                                                        $hearfrom = 'Social media';
                                                                        break;
                                                                    case '3':
                                                                        $hearfrom = 'YouTube';
                                                                        break;
                                                                    case '4':
                                                                        $hearfrom = 'Others';
                                                                        break;
                                                                    default:
                                                                        $hearfrom = '';
                                                                }
                                                                $password_hashed = password_hash($password, PASSWORD_BCRYPT);
                                                                // Inserting data into the database
                                                                $sql = "INSERT INTO $tb_name (fullname, email, pw, hearfrom, registerdate) 
                                VALUES ('$fullname', '$email', '$password_hashed','$hearfrom', NOW())";
                                                                $success = TRUE;
                                                                try {
                                                                    mysqli_query($conn, $sql);
                                                                } catch (mysqli_sql_exception) {
                                                                    $success = FALSE;
                                                                }
                                                                if ($success) echo "Sign up successfully. You can now login.";
                                                            }
                                                            mysqli_close($conn);
                                                            ?></div>
                        </div>
                    </form>

                </div>
                <div class="cta-img"></div>
            </div>
        </div>
    </section>

</body>

</html>