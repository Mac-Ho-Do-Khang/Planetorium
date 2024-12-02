<?php
// index.php

// Set 'home' as the default page if no 'page' parameter is provided
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Use a switch statement to load the appropriate view based on the 'page' parameter
switch ($page) {
    case 'home':
        include './home.php';
        break;

    case 'products':
        include './products.php';
        break;

    case 'contacts':
        include './location.php';
        break;

    case 'user':
        include './homeuser.php';
        break;

    case 'login':
        include './login.php';
        break;

    case 'register':
        include './register.php';
        break;

    default:
        include './404.php';  // 404 error page if no valid page is found
        break;
}
