<?php

// Fetch inputs from updateOrderForm.php
$orderID = filter_input(INPUT_GET, 'orderID', FILTER_VALIDATE_INT);
$customerID = filter_input(INPUT_GET, 'customerID', FILTER_VALIDATE_INT);
$cardType = filter_input(INPUT_GET, 'cardType', FILTER_VALIDATE_INT);
$cardNumber = filter_input(INPUT_GET, 'cardNumber', FILTER_VALIDATE_INT);
$cardExpires = filter_input(INPUT_GET, 'cardExpires');

// Validate inputs
if ($orderID === null || $orderID === false || 
        $customerID === null || $customerID === false || 
        $cardType === null || $cardType === false || 
        $cardNumber === null || $cardNumber === false || 
        $cardExpires === null || $cardExpires === false) {
    $error = "Invalid order data. Check all fields and try again.";
    echo $error;
}

else {
    require_once('../inc/db_connect.php');

    $query = 'UPDATE orders
                SET customerID = :customerID, cardType = :cardType, 
                cardNumber = :cardNumber, cardExpires = :cardExpires
                WHERE orderID = :orderID';
    $statement = $db->prepare($query);
    $statement->bindValue(':orderID', $orderID);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':cardType', $cardType);
    $statement->bindValue(':cardNumber', $cardNumber);
    $statement->bindValue(':cardExpires', $cardExpires);
    $statement->execute();
    $statement->closeCursor();
    
    // Display the Order List page
    echo "Update Successful!";
    include('index.php');
}

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Order Manager</h1></header>
<main>
    <h1>Order List</h1>
	
    <!-- Display all orders as a table -->
    <table>
        <tr>
            <th>OrderID</th>
            <th>CustomerID</th>
            <th>OrderDate</th>
            <th>ShipDate</th>
            <th>CardType</th>
            <th>Card Number</th>
            <th>Card Expiry</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <td><?php echo $order['orderID']; ?></td>
                <td><?php echo $order['customerID']; ?></td>
                <td><?php echo $order['orderDate']; ?></td>
                <td><?php echo $order['shipDate']; ?></td>
                <td><?php echo $order['cardType']; ?></td>
                <td><?php echo $order['cardNumber']; ?></td>
                <td><?php echo $order['cardExpires']; ?></td>
                <td><form action="updateOrderForm.php" method="get">
                    <input type="hidden" name="orderID"
                        value="<?php echo $order['orderID']; ?>">
                    <input type="hidden" name="customerID"
                        value="<?php echo $order['customerID']; ?>">
                    <input type="submit" value="Update">
                </form></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>	