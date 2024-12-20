<?php
session_start();
include("database.php");

// Check if the request is made via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the AJAX request
    $planetImage = $_POST['image'];
    $planetName = $_POST['name'];
    $userName = $_POST['user'];
    $query_success = true;

    // insert the products into database only when logged in
    if (isset($_SESSION['user'])) {
        // Check if the planet already exists
        $check_sql = "SELECT quantity FROM $tb_name_selected_products WHERE user = '$userName' AND planet = '$planetName'";
        $result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($result) > 0) // Planet exists 
        {
            $update_sql = "UPDATE $tb_name_selected_products SET quantity = quantity + 1 WHERE user = '$userName' AND planet = '$planetName'";
            $query_success = mysqli_query($conn, $update_sql);
        } else // Planet does not exist
        {
            $insert_sql = "INSERT INTO $tb_name_selected_products (user, planet, quantity) VALUES ('$userName', '$planetName', 1)";
            $query_success = mysqli_query($conn, $insert_sql);
        }
    }

    // Send XML response based on the success of the query
    header("Content-Type: text/xml");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<response>';

    if ($query_success) {
        echo '<status>success</status>';
        echo "<message>{$planetName} added to cart!</message>";
    } else {
        echo '<status>error</status>';
        echo '<message>Error adding product: ' . mysqli_error($conn) . '</message>';
    }

    echo '</response>';

    // Close the database connection
    mysqli_close($conn);
}
