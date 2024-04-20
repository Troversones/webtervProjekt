<?php
if (isset($_SESSION["order_id"])) {
    $orderId = $_SESSION["order_id"];
    $queryOrderDetails = "SELECT Products.*, OrderDetails.quantity FROM OrderDetails JOIN Products ON OrderDetails.product_id = Products.product_id WHERE OrderDetails.order_id = $orderId";
    $resultOrderDetails = mysqli_query($kapcs, $queryOrderDetails);
    if (mysqli_num_rows($resultOrderDetails) > 0) {
        while ($rowOrderDetails = mysqli_fetch_assoc($resultOrderDetails)) {
            $discPrice = $rowOrderDetails["price"];
            if ($rowOrderDetails["discount"] > 0) {
                $discFact = (100 - $rowOrderDetails["discount"]) / 100;
                $discPrice = $rowOrderDetails["price"] * $discFact;
                $discPrice = round($discPrice, 0);
                $totalPrice = $rowOrderDetails["quantity"] * $discPrice;
            } else {
                $totalPrice = $rowOrderDetails["quantity"] * $rowOrderDetails["price"];
            }

            echo '<div class="product-box">';
            echo '<div class="product-img">';
            echo '<img src="img/' . $rowOrderDetails["product_id"] . '.jpg" alt="' . $rowOrderDetails["name"] . '">';
            echo '</div>';
            echo '<div class="product-desc">';
            echo '<h3>' . $rowOrderDetails["name"] . '</h3>';
            if ($rowOrderDetails["discount"] > 0) {
                echo '<h2><strike>' . $rowOrderDetails["price"] . ' Ft</strike> ' . $discPrice . ' Ft</h2>';
            } else {
                echo '<h2>' . $rowOrderDetails["price"] . ' Ft</h2>';
            }
            echo '<p>' . $rowOrderDetails["quantity"] . ' x ' . $discPrice . ' Ft = ' . $totalPrice . ' Ft</p>';
            echo '</div>';
            echo '<div class="cart-button-container">';
            echo '<button class="cart-add">+</button>';
            echo '<button class="cart-minus">-</button>';
            echo '<button class="cart-remove">Eltávolít</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No items in the cart</p>';
    }
} else {
    echo '<p>No active order</p>';
}