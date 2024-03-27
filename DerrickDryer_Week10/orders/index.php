<?php
require_once('../inc/db_connect.php');

// Query all orders
$queryAllOrders = 'SELECT * FROM orders';
$statement = $db->prepare($queryAllOrders);
$statement->execute();
$orders = $statement->fetchAll();
$statement->closeCursor();

include('updateOrder.php')

?>