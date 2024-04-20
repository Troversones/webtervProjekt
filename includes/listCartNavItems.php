<?php
if (isset($_SESSION["order_id"])) {
    $orderId = $_SESSION["order_id"];
    $queryOrderDetails = "SELECT Products.name, Products.price, Products.discount, OrderDetails.quantity FROM OrderDetails JOIN Products ON OrderDetails.product_id = Products.product_id WHERE OrderDetails.order_id = $orderId";
    $resultOrderDetails = mysqli_query($kapcs, $queryOrderDetails);
    if (mysqli_num_rows($resultOrderDetails) > 0) {
        while ($rowOrderDetails = mysqli_fetch_assoc($resultOrderDetails)) {
            $price = $rowOrderDetails['price'];
            if ($rowOrderDetails['discount'] > 0) {
                $discountFactor = (100 - $rowOrderDetails['discount']) / 100;
                $price *= $discountFactor;
                $price = round($price, 0);
            }
            echo '<li>';
            echo $rowOrderDetails['name'] . '<br>';
            echo $price . ' Ft / db<br>';
            echo 'Jelenleg: ' . $rowOrderDetails['quantity'] . ' db<br>';
            echo 'Összár: ' . ($price * $rowOrderDetails['quantity']) . ' Ft';
            echo '</li>';
        }
    } else {
        echo '<li>Nincs a kosárba termék!</li>';
    }
} else {
    echo '<li>Nincs még aktív rendelésed!</li>';
}