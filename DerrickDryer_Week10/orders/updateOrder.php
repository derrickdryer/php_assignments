<?php

$action = filter_input(INPUT_GET, 'action');
$error = "";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($action == 'Update Order' ) {
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
}
else if ($action == 'Update Order Item') {
    $orderID = filter_input(INPUT_GET, 'orderID', FILTER_VALIDATE_INT);
    $productID = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT);
    $itemPrice = filter_input(INPUT_GET, 'itemPrice', FILTER_VALIDATE_FLOAT);
    $discountAmount = filter_input(INPUT_GET, 'discountAmount', FILTER_VALIDATE_FLOAT);
    $quantity = filter_input(INPUT_GET, 'quantity', FILTER_VALIDATE_INT);
    var_dump($orderID);
    var_dump($productID);
    var_dump($itemPrice);
    var_dump($discountAmount);
    var_dump($quantity);
    if ($orderID == false) { $error = "Invalid order ID </br>"; }
    if ($productID == false) { $error = "Invalid product ID </br>"; }
    if ($itemPrice == false) { $error = "Invalid item price </br>"; }
    if ($discountAmount == false) { $error = "Invalid discount amount </br>"; }
    if ($quantity == false) { $error = "Invalid quantity </br>"; }
    echo $error;
    if ($error != "") {
        $id = $orderID;
        include("updateOrderItemsForm.php");
        exit();
    } else {
        require_once('../inc/db_connect.php');
        $query = 'UPDATE orderItems
                    SET productID = :productID,
                        itemPrice = :itemPrice,
                        discountAmount = :discountAmount,
                        quantity = :quantity
                    WHERE orderID = :orderID';
        $statement = $db->prepare($query);
        $statement->bindValue(':orderID', $orderID);
        $statement->bindValue(':productID', $productID);
        $statement->bindValue(':itemPrice', $itemPrice);
        $statement->bindValue(':discountAmount', $discountAmount);
        $statement->bindValue(':quantity', $quantity);
        $statement->execute();
        $statement->closeCursor();
        echo 'Order item updated successfully. </br>';
        include("updateOrderItemsForm.php");
    }
}
?>