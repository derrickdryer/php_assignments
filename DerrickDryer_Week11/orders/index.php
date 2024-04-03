<?php
    require_once '../inc/db_connect.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $queryOrders = 'SELECT * FROM orders';
    $statement = $db->prepare($queryOrders);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <h1>Orders</h1>
    <h2>Order list</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer ID</th>
            <th>Order Date</th>
            <th>Ship Date </th>
        </tr>
        <?php foreach($orders as $order) : ?>
            <tr>
                <td><?php echo $order['orderID']; ?></td>
                <td><?php echo $order['customerID']; ?></td>
                <td><?php echo $order['orderDate']; ?></td>
                <td><?php echo $order['shipDate']; ?></td>
                <td><form action="addOrderItemForm.php" method="get">
                    <input type="hidden" name="order_id"
                        value="<?php echo $order['orderID']; ?>">
                    <input type="submit" value="Add/View Item">
                </form></td>
        <?php endforeach; ?>
    </table>
    <p><a href="addOrderForm.php">Add a new order</a></p>