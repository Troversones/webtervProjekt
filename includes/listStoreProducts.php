<?php
require("includes/dbconnect.php");

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
$query = "SELECT * FROM Products";
if (!empty($categoryFilter)) {
    $query .= " WHERE category = '$categoryFilter'";
}
$result = mysqli_query($kapcs, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $discPrice = $row["price"];
        if ($row["discount"] > 0) {
            $discFact = (100 - $row["discount"]) / 100;
            $discPrice = $row["price"] * $discFact;
            $discPrice = round($discPrice, 0);
        }

        echo '<div class="product-box">';
        echo '<div class="product-img">';
        echo '<img src="img/' . $row["product_id"] . '.jpg" alt="' . $row["name"] . '">';
        echo '</div>';
        echo '<div class="product-desc">';
        echo '<h3>' . $row["name"] . '</h3>';
        if ($row["discount"] > 0) {
            echo '<h2><strike>' . $row["price"] . ' Ft</strike> ' . $discPrice . ' Ft</h2>';
        } else {
            echo '<h2>' . $row["price"] . ' Ft</h2>';
        }
        echo '</div>';
        echo '<div class="product-button">';
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="productId" value="' . $row["product_id"] . '">';
        echo '<input type="hidden" name="userId" value="Troversones">';
        echo '<input type="hidden" name="price" value="' . $discPrice . '">';
        echo '<button type="submit" name="addToCart" onclick="openPopup()">Kosárba</button>';
        echo '</form>';
        echo '</div>';
        echo '<input type="hidden" class="category" value="' . $row["category"] . '">';
        echo '</div>';
    }
} else {
    echo "Nincs termék xd";
}
?>
