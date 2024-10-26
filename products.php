<?php
session_start();
include("planets.php");
$isLoggedIn = isset($_SESSION['user']);
?>
<script>
    // Pass the login status to JavaScript
    const isLoggedIn = <?= json_encode($isLoggedIn) ?>;
</script>

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
    <link rel="stylesheet" href="css/style_products.css" />
    <link rel="stylesheet" href="css/queries.css" />
    <script
        defer
        src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
    <script defer src="javascript/script_products.js"></script>
    <script
        type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script
        nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Plenetorium - Products</title>
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

                <!-- Show cart and profile icon if logged in -->
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="shoping-list">
                        <ion-icon name="cart" class="shoping-list-cart"></ion-icon>
                        <form class="shoping-items" method="post" action="purchase.php"></form>
                    </div>
                    <div class=" user-info">
                        <ion-icon class="user-icon" name="person-circle"></ion-icon>
                        <div class="info">
                            <p><?php echo $_SESSION['user']; ?></p>
                            <p><?php echo "(" . $_SESSION['name'] . ")"; ?></p>
                            <!-- Log out button -->
                            <form action="logout.php" method="post" style="display: inline;">
                                <input type="submit" value="Log out" class="logout-btn" />
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    echo "AAAAAAAAAAA";
                                    session_unset();
                                    session_destroy();
                                    header('Location: index.php?page=login');
                                    exit();
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Show login and register links if not logged in -->
                    <li><a class=" header-nav-link" href="index.php?page=login">Login</a></li>
                    <li>
                        <a href="index.php?page=register" class="header-nav-link call-to-action">Sign up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <button class="mobile-btn">
            <ion-icon class="mobile-icon" name="menu"></ion-icon>
            <ion-icon class="mobile-icon" name="close"></ion-icon>
        </button>
    </header>

    <section class="planets tabcontent" id="products">
        <div
            class="container grid-container"
            style="
            --column: 4;
            --r-gap: 9.6rem;
            --c-gap: 5rem;
            --m-bottom: 4.8rem;
          ">
            <!-- <div class="planet">
                <div class="planet-img">
                    <img src="content/img/planets/planet1.png" />
                    <div class="overlay">
                        <ion-icon name="cart" class="cart-icon"></ion-icon>
                    </div>
                </div>
                <div class="planet-content">
                    <div class="tag-area">
                        <span class="tag earthy">Earth-like</span>
                    </div>

                    <p class="name">Terra Nova</p>
                    <ul class="planet-attributes">
                        <li>
                            <ion-icon name="thermometer"></ion-icon><span>Temperate climate</span>
                        </li>
                        <li>
                            <ion-icon name="accessibility"></ion-icon><span>Gravity <strong>1.0</strong>g</span>
                        </li>
                        <li>
                            <ion-icon name="happy"></ion-icon><span>Oxygen-rich atmosphere</span>
                        </li>
                        <li>
                            <ion-icon name="star"></ion-icon><span><strong>4.9</strong> rating (523 reviews)</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="planet">
                <div class="planet-img">
                    <img src="content/img/planets/planet2.png" />
                    <div class="overlay">
                        <ion-icon name="cart" class="cart-icon"></ion-icon>
                    </div>
                </div>
                <div class="planet-content">
                    <div class="tag-area">
                        <span class="tag watery">Watery</span>
                        <span class="tag ring">Ring</span>
                    </div>

                    <p class="name">Aquamaris</p>
                    <ul class="planet-attributes">
                        <li>
                            <ion-icon name="thermometer"></ion-icon><span>Subtropical ocean climate</span>
                        </li>
                        <li>
                            <ion-icon name="accessibility"></ion-icon><span>Gravity <strong>0.8</strong>g</span>
                        </li>
                        <li>
                            <ion-icon name="happy"></ion-icon><span>All water</span>
                        </li>
                        <li>
                            <ion-icon name="star"></ion-icon><span><strong>4.8</strong> rating (617 reviews)</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="planet">
                <div class="planet-img">
                    <img src="content/img/planets/pla8.png" />
                    <div class="overlay">
                        <ion-icon name="cart" class="cart-icon"></ion-icon>
                    </div>
                </div>
                <div class="planet-content">
                    <div class="tag-area">
                        <span class="tag watery">Watery</span>
                    </div>

                    <p class="name">Forseti</p>
                    <ul class="planet-attributes">
                        <li>
                            <ion-icon name="thermometer"></ion-icon><span>Continental climate</span>
                        </li>
                        <li>
                            <ion-icon name="accessibility"></ion-icon><span>Gravity <strong>0.5</strong>g</span>
                        </li>
                        <li>
                            <ion-icon name="happy"></ion-icon><span>Warm water</span>
                        </li>
                        <li>
                            <ion-icon name="star"></ion-icon><span><strong>4.7</strong> rating (399 reviews)</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="planet">
                <div class="planet-img">
                    <img src="content/img/planets/pla9.png" />
                    <div class="overlay">
                        <ion-icon name="cart" class="cart-icon"></ion-icon>
                    </div>
                </div>
                <div class="planet-content">
                    <div class="tag-area">
                        <span class="tag earthy">Earth-like</span>
                    </div>

                    <p class="name">Esmeralda</p>
                    <ul class="planet-attributes">
                        <li>
                            <ion-icon name="thermometer"></ion-icon><span>Tropical climate</span>
                        </li>
                        <li>
                            <ion-icon name="accessibility"></ion-icon><span>Gravity <strong>1.1</strong>g</span>
                        </li>
                        <li>
                            <ion-icon name="happy"></ion-icon><span>Nutrition-rich soil</span>
                        </li>
                        <li>
                            <ion-icon name="star"></ion-icon><span><strong>4.8</strong> rating (450 reviews)</span>
                        </li>
                    </ul>
                </div>
            </div> -->

            <?php foreach ($planets as $planet): ?>
                <div class="planet">
                    <div class="planet-img">
                        <img src="<?= $planet['image'] ?>" />
                        <div class="overlay">
                            <ion-icon name="cart" class="cart-icon"
                                data-image="<?= $planet['image'] ?>"
                                data-planetname="<?= $planet['name'] ?>"></ion-icon>
                        </div>
                    </div>
                    <div class="planet-content">
                        <div class="tag-area">
                            <?php foreach ($planet['tags'] as $tag): ?>
                                <span class="tag <?= $tag ?>"><?= $tag ?></span>
                            <?php endforeach; ?>
                        </div>

                        <p class="name"><?= $planet['name'] ?></p>
                        <ul class="planet-attributes">
                            <?php foreach ($planet['attributes'] as $attribute): ?>
                                <li>
                                    <ion-icon name="<?= $attribute['icon'] ?>"></ion-icon>
                                    <span><?= $attribute['text'] ?>
                                        <?php if (isset($attribute['value'])): ?>
                                            <strong><?= $attribute['value'] ?></strong>
                                        <?php endif; ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </section>
</body>

</html>