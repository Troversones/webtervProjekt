<?php
if (isset($_SESSION["order_id"])) {
    $orderId = $_SESSION["order_id"];
    $query = "SELECT Products.name, Products.price, Products.discount, OrderDetails.quantity 
              FROM OrderDetails 
              JOIN Products ON OrderDetails.product_id = Products.product_id 
              WHERE OrderDetails.order_id = $orderId";
    $result = mysqli_query($kapcs, $query);
    if (mysqli_num_rows($result) > 0) {
        $totalOrderPrice = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $price = $row['price'];
            if ($row['discount'] > 0) {
                $discountFactor = (100 - $row['discount']) / 100;
                $price *= $discountFactor;
                $price = round($price, 0);
            }
            $productPrice = $price * $row['quantity'];
            $totalOrderPrice += $productPrice;
            echo '<li>';
            echo $row['name'] . '<br>';
            echo $price . ' Ft / db<br>';
            echo 'Jelenleg: ' . $row['quantity'] . ' db<br>';
            echo 'Összár: ' . $productPrice . ' Ft';
            echo '</li>';
        }
        echo '<li>Végösszeg: ' . $totalOrderPrice . ' Ft</li>';
    } else {
        echo '<li>Nincs a kosárba termék!</li>';
    }
} else {
    echo '<li>Nincs még aktív rendelésed!</li>';
}
?>
