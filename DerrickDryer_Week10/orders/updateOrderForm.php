<?php

if(!isset($orderID)){
$orderID = filter_input(INPUT_GET, 'orderID');

if($orderID == null){
    $error = "Error";
    echo $error;
}

else {
require('../inc/db_connect.php');

$queryOrders = 'SELECT * FROM orders
                WHERE orderID = :orderID';
$statement1 = $db->prepare($queryOrders);
$statement1->bindValue(':orderID', $orderID);
$statement1->execute();
$order = $statement1->fetch();
$statement1->closeCursor();
var_dump($order);
}
}

if(!isset($customerID)){
$customerID = filter_input(INPUT_GET, 'customerID');
}
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Order Manager</h1></header>

    <main>
        <h2>Order to Update: <?php echo $order['orderID']; ?></h2>
        <form action="updateOrder.php" method="get" id="update_order_form">
        <input type="submit" value="Update Order"><br>    
        <table>
                <tr>
                    <td>Customer</td>
                    <td><input type="text" name="customerID" value="<?php echo $order['customerID']; ?>"></td>
                </tr>
                <tr>
                    <td>Card Type</td>
                    <td><input type="text" name="cardNumber" value="<?php echo $order['cardType']; ?>"></td>
                </tr>
                <tr>
                    <td>Card Number</td>
                    <td><input type="text" name="cardNumber" value="<?php echo $order['cardNumber']; ?>"></td>
                </tr>
                <tr>
                    <td>Card Expires</td>
                    <td><input type="text" name="cardExpires" value="<?php echo $order['cardExpires']; ?>"></td>
                </tr>
                
        </form>
        </table>
        <p><a href="updateOrderItemsForm.php?id=<?php echo $order_id ?>">Update Order Items for this order</a></p>
	</main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>	