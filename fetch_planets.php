<?php
include 'database.php'; // Include your database connection

$search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

if (!empty($search_query)) {
    $get_planets = "SELECT * FROM $tb_name_product WHERE pname = '$search_query'";
    unset($_GET['search']);
} else {
    $get_planets = "SELECT * FROM $tb_name_product";
}

$all_planets = mysqli_query($conn, $get_planets);

if (mysqli_num_rows($all_planets) > 0) {
    while ($planet = mysqli_fetch_assoc($all_planets)) {
        // Echo HTML structure for each planet
?>
        <div class="planet">
            <form class="planet-img" method="post">
                <img src="<?= $planet['image'] ?>" />
                <div class="overlay">
                    <button type="button" class="cart-icon-container"
                        data-username="<?= isset($_SESSION['user']) ? $_SESSION['user'] : '' ?>">
                        <ion-icon name="cart" class="cart-icon"
                            data-image="<?= $planet['image'] ?>"
                            data-planetname="<?= $planet['pname'] ?>">
                        </ion-icon>
                    </button>
                </div>
            </form>
            <div class="planet-content">
                <div class="tag-area">
                    <?php
                    $get_planet = "select * from $tb_name_product where pname = '{$planet['pname']}'";
                    $get_planet_result = mysqli_query($conn, $get_planet);
                    if (mysqli_num_rows($get_planet_result) > 0) {
                        $result = mysqli_fetch_assoc($get_planet_result);
                        $tags_field = $result['tags'];
                        $tags = explode(" ", $tags_field);
                        foreach ($tags as $tag) { ?>
                            <span class="tag <?= $tag ?>"><?= $tag ?></span>
                        <?php } ?>
                    <?php
                    } else {
                        echo "No tag for planet {$planet['pname']} found<br>";
                    }
                    ?>
                </div>

                <p class="name"><?= $planet['pname'] ?></p>
                <ul class="planet-attributes">
                    <?php
                    $get_attributes = "select * from $tb_name_attributes where planet_id = '{$planet['pname']}'";
                    $get_attributes_result = mysqli_query($conn, $get_attributes);
                    if (mysqli_num_rows($get_attributes_result) > 0) {
                        while ($attribute = mysqli_fetch_assoc($get_attributes_result)) { ?>
                            <li>
                                <ion-icon name="<?= $attribute['icon'] ?>"></ion-icon>
                                <div>
                                    <?php foreach (explode(" ", $attribute['content']) as $word) { ?>
                                        <span><?= html_entity_decode($word) ?></span>
                                    <?php } ?>
                                </div>
                            </li>
                    <?php }
                    } ?>
                </ul>
            </div>
        </div>
<?php
    }
} else {
    echo "No planet founda<br>";
}
?>