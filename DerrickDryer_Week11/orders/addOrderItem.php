<?php
    $orderID = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
    $productID = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('../inc/db_connect.php');
    $queryProduct = 'SELECT * FROM products
                        WHERE productID = :productID';
    $statement = $db->prepare($queryProduct);
    $statement->bindValue(':productID', $productID);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();

    $itemPrice = $product['listPrice'];
    $discountPercent = $product['discountPercent'];
    $discountAmount = $itemPrice * ($discountPercent/100) * $quantity;

    if ($orderID == null || $orderID == false || 
    $productID == null || $productID == false || 
    $quantity == null || $productID == false) {
        $error = "Invalid order item data. Check all fields and try again.";
        include('error.php');
    } else {
        require_once('../inc/db_connect.php');

        $query = 'INSERT INTO orderItems
            (orderID, productID, itemPrice, discountAmount, quantity)
            VALUES
            (:orderID, :productID, :itemPrice, :discountAmount, :quantity)';
        $statement2 = $db->prepare($query);
        $statement2->bindValue(':orderID', $orderID);
        $statement2->bindValue(':productID', $productID);
        $statement2->bindValue(':itemPrice', $itemPrice);
        $statement2->bindValue(':discountAmount', $discountAmount);
        $statement2->bindValue(':quantity', $quantity);
        $statement2->execute();
        $statement2->closeCursor();
        
        echo 'Order item added successfully.';

        header("Location: addOrderItemForm.php?order_id=$orderID");
        exit;
    }
?>