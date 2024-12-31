<?php
include("database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    $sql = "SELECT * FROM $tb_name WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['pw'];
        $name = $row['fullname'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $email;
            $_SESSION['name'] = $name;
            setcookie('user_email', $email, time() + (86400 * 30), "/"); // 30 days expiration
            echo "success";
        } else {
            echo "Invalid login credentials.";
        }
    } else {
        echo "Email not found.";
    }

    mysqli_close($conn);
}
