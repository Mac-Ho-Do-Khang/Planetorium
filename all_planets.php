<?php
include 'database.php';

header("Content-Type: text/xml; charset=UTF-8");

$query = "SELECT pname FROM $tb_name_product";
$result = mysqli_query($conn, $query);

echo "<products>";

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<product><pname>" . htmlspecialchars($row['pname']) . "</pname></product>";
    }
}

echo "</products>";
