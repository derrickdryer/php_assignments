<?php
if(!isset($orderID)){
$orderID = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
}

if($orderID == null){
    $error = "Error";
    echo $error;
}

else {
require_once('../inc/db_connect.php');

$queryOrders = 'SELECT * FROM orders
                WHERE orderID = :orderID';
$statement1 = $db->prepare($queryOrders);
$statement1->bindValue(':orderID', $orderID);
$statement1->execute();
$order = $statement1->fetch();
$statement1->closeCursor();
var_dump($order);
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
        <h2>Order to Update: <?php echo isset($order) ? $order['orderID'] : 'Not set'; ?></h2>
        <form action="updateOrder.php" method="get" id="update_order_form">
        <input type="submit" name="action" value="Update Order"><br>    
        <table>
                <tr>
                    <td>Customer</td>
                    <td><input type="text" name="customerID" value="<?php echo $order['customerID']; ?>"></td>
                </tr>
                <tr>
                    <td>Card Type</td>
                    <td><input type="text" name="cardType" value="<?php echo $order['cardType']; ?>"></td>
                </tr>
                <tr>
                    <td>Card Number</td>
                    <td><input type="text" name="cardNumber" value="<?php echo $order['cardNumber']; ?>"></td>
                </tr>
                <tr>
                    <td>Card Expires</td>
                    <td><input type="text" name="cardExpires" value="<?php echo $order['cardExpires']; ?>"></td>
                </tr>
                <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">                
        </form>
        </table>
        <p><a href="updateOrderItemsForm.php?order_id=<?php echo $orderID ?>">Update Order Items for this order</a></p>
	</main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>	