<?php
if(!isset($orderID)) {
    $orderID = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
}
var_dump($orderID);

if($orderID == null) {
    $error = "Error";
    echo $error;
} else {
    require_once('../inc/db_connect.php');

    // query order items
    $queryOrderItems = 'SELECT * FROM orderItems
                        WHERE orderID = :orderID';
    $statement1 = $db->prepare($queryOrderItems);
    $statement1->bindValue(':orderID', $orderID);
    $statement1->execute();
    $orderItems = $statement1->fetchAll();
    $statement1->closeCursor();
    var_dump($orderItems);
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
        <header><h1>Order Item Manager</h1></header>

        <main>
            <h2>Order Items to Update: <?php echo isset($orderID) ? $orderID : 'Not set' ?></h2>
            <form action="updateOrder.php" method="get" id="update_order_items_form">
            <table>
                <tr>
                    <th>ProductID</th>
                    <th>ItemPrice</th>
                    <th>DiscountAmount</th>
                    <th>Quantity</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($orderItems as $orderItem) : ?>
                    <tr>
                        <td><input type="text" name="productID" value="<?php echo $orderItem['productID']; ?>"></td>
                        <td><input type="text" name="itemPrice" value="<?php echo $orderItem['itemPrice']; ?>"></td>
                        <td><input type="text" name="discountAmount" value="<?php echo $orderItem['discountAmount']; ?>"></td>
                        <td><input type="text" name="quantity" value="<?php echo $orderItem['quantity']; ?>"></td>
                        <td><input type="hidden" name="orderID" value="<?php echo $orderItem['orderID']; ?>">
                            <input type="submit" name="action" value="Update Order Item">
                        </form></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            </form>
            <p><a href="../orders">View Orders</a></p>
        </main>
    </body>
</html>