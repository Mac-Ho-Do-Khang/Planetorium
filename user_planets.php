<?php
include 'database.php';
session_start();

header("Content-Type: text/xml; charset=UTF-8");
$user_name = $_SESSION['user'];        // retrieve user directly from session
// $user_name = $_GET['current_user']; // retrieve user passed from js
$query = "SELECT * FROM $tb_name_selected_products where user = '$user_name'";
$query_result = mysqli_query($conn, $query);

echo "<products>";

if ($query_result) {
    while ($row = mysqli_fetch_assoc($query_result)) {
        echo "<product>";
        echo "<pname>" . $row['planet'] . "</pname>";
        echo "<quantity>" . $row['quantity'] . "</quantity>";
        $this_planet_name = $row['planet'];
        $reference = "SELECT * FROM $tb_name_product where pname = '$this_planet_name'";
        $reference_result = mysqli_query($conn, $reference);
        echo "<image_source>" . mysqli_fetch_assoc($reference_result)['image'] . "</image_source>";
        echo "</product>";
    }
}

echo "</products>";
