<?php
    require_once('../inc/db_connect.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $getCustomers = 'SELECT * FROM customers';
    $statement = $db->prepare($getCustomers);
    $statement->execute();
    $customers = $statement->fetchAll();
    $statement->closeCursor();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Order</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <h1>Add Order</h1>
    <form action="addOrder.php" method="post" id="add_order_form">
    <label>Customer:</label>
    <select name="customer_list">
        <?php foreach($customers as $customer) : ?>
            <option value="<?php echo $customer['customerID']; ?>">
                <?php echo $customer['emailAddress']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <label>Card Type</label>
    <input type="text" name="card_type"><br>
    <label>Card Number</label>
    <input type="text" name="card_number"><br>
    <label>Card Expires</label>
    <input type="text" name="card_expires"><br>
    <label>&nbsp;</label>
    <input type="submit" value="Submit Order">
</form>
<p><a href="index.php">View Product List</a></p>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>