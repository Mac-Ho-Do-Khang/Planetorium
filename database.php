<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "planetorium";
$tb_name = "users";
$tb_name_attributes = "icons";
$tb_name_product = "products";
$tb_name_selected_products = "selected";
$conn = "";

try {
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
} catch (mysqli_sql_exception) {
    echo "Could not connect to database";
}
//  if ($conn) echo "Connected to database";
