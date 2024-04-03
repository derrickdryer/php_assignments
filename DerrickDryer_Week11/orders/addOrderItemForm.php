<?php
    $orderID = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('../inc/db_connect.php');
    $queryOrderItems = 'SELECT * FROM orderItems
                        WHERE orderID = :orderID';
    $statement = $db->prepare($queryOrderItems);
    $statement->bindValue(':orderID', $orderID);
    $statement->execute();
    $orderItems = $statement->fetchAll();
    $statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Items</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <h1>Orders</h1>
    <h2>Order List</h2>
    <h3>Order items for Order ID: <?php echo $orderID; ?></h3>
    <table>
        <tr>
            <th>ItemID</th>
            <th>OrderID</th>
            <th>ProductID</th>
            <th>ItemPrice</th>
            <th>Discount Amount</th>
            <th>Quantity</th>
        </tr>
        <?php foreach($orderItems as $orderItem) : ?>
            <tr>
                <td><?php echo $orderItem['itemID']; ?></td>
                <td><?php echo $orderItem['orderID']; ?></td>
                <td><?php echo $orderItem['productID']; ?></td>
                <td><?php echo $orderItem['itemPrice']; ?></td>
                <td><?php echo $orderItem['discountAmount']; ?></td>
                <td><?php echo $orderItem['quantity']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Order items for Order ID: <?php echo $orderID; ?></h2>
    <form action="addOrderItem.php" method="post" id="add_order_item_form">
    <table>
        <input type="hidden" name="order_id" value="<?php echo $orderID; ?>">
        <tr>
            <td>Product ID</td>
            <td><input type="text" name="product_id"></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><input type="text" name="quantity"></td>
        </tr>
        <input type='hidden' name='order_id' value='<?php echo $orderID ?>'>
    <table>
    <input type="submit" value="Add Item">
    </form>
    <p><a href="index.php">View All Order</a></p>
    <footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>