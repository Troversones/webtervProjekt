<?php
require("includes/dbconnect.php");
//Kupon használata ? azt se tudom hogyan kezdjek neki perpill
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cart-add"])) {
        $productId = $_POST["product-id"];
        incrementProductQuantity($productId);
        header("Location: cart.php");
        exit();
    } elseif (isset($_POST["cart-minus"])) {
        $productId = $_POST["product-id"];
        decrementProductQuantity($productId);
        header("Location: cart.php");
        exit();
    } elseif (isset($_POST["cart-remove"])) {
        $productId = $_POST["product-id"];
        removeProductFromOrder($productId);
        updateOrderTotalPrice();
        header("Location: cart.php");
        exit();
    } elseif (isset($_POST["finalize-order"])) {
        unset($_SESSION["order_id"]);
        echo '<script>alert("Köszönjük a vásárlást!"); window.location.href = "cart.php";</script>';
        exit();
    }
}

function incrementProductQuantity($productId)
{
    global $kapcs;
    $query = "UPDATE OrderDetails 
              SET quantity = quantity + 1 
              WHERE product_id = $productId";
    if (mysqli_query($kapcs, $query)) {
        echo "Sikeres inkrementélás";
        updateOrderTotalPrice();
    } else {
        echo "Hiba (inkrementálás): " . mysqli_error($kapcs);
    }
}

function decrementProductQuantity($productId)
{
    global $kapcs;
    $query = "UPDATE OrderDetails 
              SET quantity = quantity - 1 
              WHERE product_id = $productId";
    $query2 = "SELECT quantity 
               FROM OrderDetails 
               WHERE product_id = $productId";
    $result = mysqli_query($kapcs, $query2);
    $row = mysqli_fetch_assoc($result);
    $quantity = $row['quantity'];

    if ($quantity - 1 < 1) {
        removeProductFromOrder($productId);
        updateOrderTotalPrice();
    } else {
        if (mysqli_query($kapcs, $query)) {
            echo "Sikeres dekrementálás";
            updateOrderTotalPrice();
        } else {
            echo "Hiba (dekrementálás):" . mysqli_error($kapcs);
        }
    }
}

function removeProductFromOrder($productId)
{
    global $kapcs;
    $query = "DELETE FROM OrderDetails 
              WHERE product_id = $productId";
    if (mysqli_query($kapcs, $query)) {
        echo "Sikeres eltávolítás";
        updateOrderTotalPrice();
    } else {
        echo "Hiba (Eltávolítás):" . mysqli_error($kapcs);
    }
}

function updateOrderTotalPrice()
{
    global $kapcs;
    $orderId = $_SESSION["order_id"];
    $query = "SELECT SUM((Products.price * OrderDetails.quantity) * (1 - (Products.discount / 100))) AS total_price
              FROM OrderDetails 
              JOIN Products ON OrderDetails.product_id = Products.product_id 
              WHERE OrderDetails.order_id = $orderId";
    $result = mysqli_query($kapcs, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalPrice = $row["total_price"];

        $query2 = "UPDATE Orders 
                   SET total_price = ? 
                   WHERE order_id = ?";
        $stmt = mysqli_prepare($kapcs, $query2);
        mysqli_stmt_bind_param($stmt, "di", $totalPrice, $orderId);

        if (mysqli_stmt_execute($stmt)) {
            echo "Sikeres összár frissítés";
        } else {
            echo "Sikertelen (UpdateTotalPrice): " . mysqli_error($kapcs);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Hiba (updateOrderTotalPrice): " . mysqli_error($kapcs);
    }
}



// Form létrehozása a termékeknek
if (isset($_SESSION["order_id"])) {
    $orderId = $_SESSION["order_id"];
    $query = "SELECT Products.*, OrderDetails.quantity 
                          FROM OrderDetails 
                          JOIN Products ON OrderDetails.product_id = Products.product_id 
                          WHERE OrderDetails.order_id = $orderId";
    $result = mysqli_query($kapcs, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $discountedPrice = $row["price"];
            if ($row["discount"] > 0) {
                $discountAmount = (100 - $row["discount"]) / 100;
                $discountedPrice = $row["price"] * $discountAmount;
                $discountedPrice = round($discountedPrice, 0);
                $totalPrice = $row["quantity"] * $discountedPrice;
            } else {
                $totalPrice = $row["quantity"] * $row["price"];
            }

            echo '<div class="product-box">';
            echo '<div class="product-img">';
            echo '<img src="img/' . $row["product_id"] . '.jpg" alt="' . $row["name"] . '">';
            echo '</div>';
            echo '<div class="product-desc">';
            echo '<h3>' . $row["name"] . '</h3>';
            if ($row["discount"] > 0) {
                echo '<h2><strike>' . $row["price"] . ' Ft</strike> ' . $discountedPrice . ' Ft</h2>';
            } else {
                echo '<h2>' . $row["price"] . ' Ft</h2>';
            }
            echo '</div>';
            echo '<div class="cart-button-container">';
            echo '<form method="POST">';
            echo '<input type="hidden" name="product-id" value="' . $row["product_id"] . '">';
            echo '<button type="submit" name="cart-add" class="cart-add">+</button>';
            echo '<button type="submit" name="cart-minus" class="cart-minus">-</button>';
            echo '<button type="submit" name="cart-remove" class="cart-remove">Eltávolít</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
    }
}
