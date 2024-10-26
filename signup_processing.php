<?php
include("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);

    $email = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_SPECIAL_CHARS);
    // Check if email already exists in database
    $sql = "select * from $tb_name where email = '$email'";
    if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
        echo "Email already used.";
        header("Location: index.php?page=register");
        exit();
    }

    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    // Check if password meets the requirement
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[A-Z]).{8,}$/", $password)) {
        echo "Password must be at least 8 characters long, contain at least one number, one uppercase and one lowercase letter.";
        exit();
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

    // Inserting data into the database
    $sql = "INSERT INTO $tb_name (fullname, email, pw, hearfrom, registerdate) 
                      VALUES ('$fullname', '$email', '$password','$hearfrom', NOW())";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
