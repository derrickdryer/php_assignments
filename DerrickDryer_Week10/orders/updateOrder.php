<?php
// Fetch inputs from updateOrderForm.php
$orderID = filter_input(INPUT_GET, 'orderID', FILTER_VALIDATE_INT);
$customerID = filter_input(INPUT_GET, 'customerID', FILTER_VALIDATE_INT);
$cardType = filter_input(INPUT_GET, 'cardType', FILTER_VALIDATE_INT);
$cardNumber = filter_input(INPUT_GET, 'cardNumber', FILTER_VALIDATE_INT);
$cardExpires = filter_input(INPUT_GET, 'cardExpires');
var_dump($orderID);
var_dump($customerID);
var_dump($cardType);
var_dump($cardNumber);
var_dump($cardExpires);
// Validate inputs
if ($orderID == false) { $error = "Invalid product ID </br>"; }
if ($customerID == false) { $error = "Invalid customer ID </br>"; }
if ($cardType == false) { $error = "Invalid card type </br>"; }
if ($cardNumber == false) { $error = "Invalid card number </br>"; }
if ($cardExpires == false) { $error = "Invalid card expiry </br>"; }
echo $error;
if ($error != "") {
    $order_id = $orderID;
    $customer_id = $customerID;
    include("updateOrderForm.php");
    exit();
} else {
    require_once('../inc/db_connect.php');
    $query = 'UPDATE orders
                SET customerID = :customerID,
                    cardType = :cardType,
                    cardNumber = :cardNumber,
                    cardExpires = :cardExpires
                WHERE orderID = :orderID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':cardType', $cardType);
    $statement->bindValue(':cardNumber', $cardNumber);
    $statement->bindValue(':cardExpires', $cardExpires);
    $statement->bindValue(':orderID', $orderID);
    $statement->execute();
    $statement->closeCursor();
    echo 'Order updated successfully. </br>';
    include("index.php");
}
#include("viewOrders.php");
?>