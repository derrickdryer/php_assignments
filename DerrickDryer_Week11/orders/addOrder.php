<?php
    $customerID = filter_input(INPUT_POST, 'customer_list', FILTER_VALIDATE_INT);
    $cardType = filter_input(INPUT_POST, 'card_type', FILTER_VALIDATE_INT);
    $cardNumber = filter_input(INPUT_POST, 'card_number', FILTER_VALIDATE_INT);
    $cardExpires = filter_input(INPUT_POST, 'card_expires');
    $orderDate = date("Y-m-d H:i:s");
    $shipAmount = 5.00;
    $taxAmount = 0.00;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('../inc/db_connect.php');
    $queryCustomer = 'SELECT * FROM customers
                        WHERE customerID = :customerID';
    $statement = $db->prepare($queryCustomer);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();

    $shipAddress = $customer['shipAddressID'];
    $billingAddress = $customer['billingAddressID'];

    if ($customerID == null || $customerID == false 
    || $cardType == null || $cardType == false 
    || $cardNumber == null || $cardNumber == false
    || $cardExpires == null || $cardExpires == false) {
        $error = "Invalid order data. Check all fields and try again.";
        include('error.php');
    } else {
        require_once('../inc/db_connect.php');

        $query = 'INSERT INTO orders
            (customerID, orderDate, shipAddressID, billingAddressID, cardType, cardNumber, cardExpires, shipAmount, taxAmount)
            VALUES
            (:customerID, :orderDate, :shipAddress, :billingAddress, :cardType, :cardNumber, :cardExpires, :shipAmount, :taxAmount)';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customerID);
        $statement->bindValue(':orderDate', $orderDate);
        $statement->bindValue(':shipAddress', $shipAddress);
        $statement->bindValue(':billingAddress', $billingAddress);
        $statement->bindValue(':cardType', $cardType);
        $statement->bindValue(':cardNumber', $cardNumber);
        $statement->bindValue(':cardExpires', $cardExpires);
        $statement->bindValue(':shipAmount', $shipAmount);
        $statement->bindValue(':taxAmount', $taxAmount);
        $statement->execute();
        $statement->closeCursor();

        echo 'Order added successfully.';
        include('index.php');
    }

?>