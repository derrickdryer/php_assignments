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
                    <input type="hidden" name="order_id"
                        value="<?php echo $order['orderID']; ?>">
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