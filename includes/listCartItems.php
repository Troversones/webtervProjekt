<?php
require("includes/dbconnect.php");
//NOTE HOLNAPRA: ellenőrzés hogy ne mehessen 0 alá a gombnyomások után
//Rendelés véglegesítése: session eldobás
//Képek rendezése, majd self.akaszt("diófa");XDDDDDDDDDDDDDDDDDD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cart-add"])) {
        $productId = $_POST["product-id"];
        incrementProductQuantity($productId);
    } elseif (isset($_POST["cart-minus"])) {
        $productId = $_POST["product-id"];
        decrementProductQuantity($productId);
    } elseif (isset($_POST["cart-remove"])) {
        $productId = $_POST["product-id"];
        removeProductFromOrder($productId);
    }
}

// inkrementálja a termékeket 1-el
function incrementProductQuantity($productId)
{
    global $kapcs;
    $query = "UPDATE OrderDetails SET quantity = quantity + 1 WHERE product_id = $productId";
    if (mysqli_query($kapcs, $query)) {
        echo "Sikeres inkrementélás";
        updateOrderTotalPrice();
    } else {
        echo "Hiba (inkrementálás): " . mysqli_error($kapcs);
    }
}

// dekrementálja a termék mennyiségét 1-el
function decrementProductQuantity($productId)
{
    global $kapcs;
    $query = "UPDATE OrderDetails SET quantity = quantity - 1 WHERE product_id = $productId";
    if (mysqli_query($kapcs, $query)) {
        echo "Sikeres dekrementálás";
        updateOrderTotalPrice();
    } else {
        echo "Hiba (dekrementálás):" . mysqli_error($kapcs);
    }
}

// Termék eltávolítás a rendelésből
function removeProductFromOrder($productId)
{
    global $kapcs;
    $query = "DELETE FROM OrderDetails WHERE product_id = $productId";
    if (mysqli_query($kapcs, $query)) {
        echo "Sikeres eltávolítás";
        updateOrderTotalPrice();
    } else {
        echo "Hiba (Eltávolítás):" . mysqli_error($kapcs);
    }
}

// Összár frissítés mikor inkrementálás történik vagy dekrementálás
function updateOrderTotalPrice()
{
    global $kapcs;
    $orderId = $_SESSION["order_id"];
    $query = "SELECT SUM(Products.price * OrderDetails.quantity) AS total_price FROM OrderDetails JOIN Products ON OrderDetails.product_id = Products.product_id WHERE OrderDetails.order_id = $orderId";
    $result = mysqli_query($kapcs, $query);
    $row = mysqli_fetch_assoc($result);
    $totalPrice = $row["total_price"];
    $updateSql = "UPDATE Orders SET total_price = $totalPrice WHERE order_id = $orderId";
    if (mysqli_query($kapcs, $updateSql)) {
        echo "Sikeres összár frissítés";
        echo "<script>window.location.href = 'cart.php';</script>"; // Oldal újraküldése a gombnyomás után elég fapados I know
    } else {
        echo "Kurva anyád (update_Totalprice): " . mysqli_error($kapcs);
    }
}

// Form létrehozása a termékeknek
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
            echo '</div>';
            echo '<div class="cart-button-container">';
            echo '<form method="post">';
            echo '<input type="hidden" name="product-id" value="' . $rowOrderDetails["product_id"] . '">';
            echo '<button type="submit" name="cart-add" class="cart-add">+</button>';
            echo '<button type="submit" name="cart-minus" class="cart-minus">-</button>';
            echo '<button type="submit" name="cart-remove" class="cart-remove">Remove</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Nincs kosárba semmi xd</p>';
    }
} else {
    echo '<p>Nincs aktív rendelés</p>';
}
