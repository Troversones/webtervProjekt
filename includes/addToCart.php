<?php
$productId = $_POST["productId"];
$userId = $_SESSION["username"]; 
$price = $_POST["price"];

//az adatokat pusholni az adatbázisba
if (isset($_SESSION["order_id"])) {
    $orderId = $_SESSION["order_id"];
} else {
    $queryNewOrder = "INSERT INTO Orders (user_id, total_price, order_date) 
                      VALUES ('$userId', 0, NOW())";
    $resultNewOrder = mysqli_query($kapcs, $queryNewOrder);
    if (!$resultNewOrder) {
        echo "Sikertelen feltöltés(Orders)";
        exit;
    }
    $orderId = mysqli_insert_id($kapcs);
    $_SESSION["order_id"] = $orderId;
}

//OrderDetailsbe quantity update ha mégegszer rámennek a kosárba gombra
$querySelectOD = "SELECT * FROM OrderDetails 
             WHERE order_id = $orderId 
             AND product_id = $productId";
$resultSelectOD = mysqli_query($kapcs, $querySelectOD);
if (mysqli_num_rows($resultSelectOD) > 0) {
    $queryUpQuant = "UPDATE OrderDetails 
                     SET quantity = quantity + 1 
                     WHERE order_id = $orderId 
                     AND product_id = $productId";
    $resultUpQuant = mysqli_query($kapcs, $queryUpQuant);
    if (!$resultUpQuant) {
        echo "Sikertelen feltöltés(OrderDetails)";
        exit;
    }
} else {
    $queryInsertOD = "INSERT INTO OrderDetails (order_id, product_id, quantity) 
                      VALUES ('$orderId', '$productId', 1)";
    $resultInsertOD = mysqli_query($kapcs, $queryInsertOD);
    if (!$resultInsertOD) {
        echo "Sikertelen feltöltés(OrderDetails)";
        exit;
    }
}

//Rendelésnél total_price frissítése quantity alapján
$queryTP = "SELECT SUM(price * quantity) AS total_price 
            FROM OrderDetails 
            JOIN Products ON OrderDetails.product_id = Products.product_id 
            WHERE order_id = $orderId";
$resultTP = mysqli_query($kapcs, $queryTP);
$rowTP = mysqli_fetch_assoc($resultTP);
$totalPrice = $rowTP["total_price"];

$queryUpdateTP = "UPDATE Orders 
                  SET total_price = $totalPrice 
                  WHERE order_id = $orderId";
$resultUpdateTP = mysqli_query($kapcs, $queryUpdateTP);
if (!$resultUpdateTP) {
    echo "Sikertelen feltöltés(Orders total_price)";
    exit;
}

echo "Sikeres feltöltés";
?>