<?php
require_once('../inc/db_connect.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Query all orders
$queryAllOrders = 'SELECT * FROM orders';
$statement = $db->prepare($queryAllOrders);
$statement->execute();
$orders = $statement->fetchAll();
$statement->closeCursor();

include('viewOrders.php')

?>