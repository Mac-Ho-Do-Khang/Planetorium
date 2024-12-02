<?php
session_start();
include("database.php");

// Check if the request is made via GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get data from the AJAX request
    $product = $_GET['product'];


    // Check if the planet already exists
    $check_sql = "SELECT * FROM $tb_name_product WHERE pname = '$product'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) // Planet exists 
    {
        $query_success = true;
    } else // Planet does not exist
    {
        $query_success = false;
    }

    // Send XML response based on the success of the query
    header("Content-Type: text/xml");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<response>';

    if ($query_success) {
        echo '<status>found</status>';
        echo "<message>{$product} found!</message>";
    } else {
        echo '<status>not found</status>';
        echo "<message>Cannot find {$product}!</message>";
    }

    echo '</response>';

    // Close the database connection
    mysqli_close($conn);
}
