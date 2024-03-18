   <!--
      Week 7 Assignment

      Author: Derrick Dryer
      Date:   2/27/2024

      Filename: index.php
   -->
<?php 
require_once('db_connect.php'); //This calls the db_connect code - connects to database


$queryAllproducts = 'SELECT * FROM products ORDER BY productID';
$statement2 = $db->prepare($queryAllproducts);
$statement2->execute();
$products = $statement2->fetchAll();
$statement2->closeCursor();

$action = filter_input(INPUT_GET, 'action');
$msg2 = '';
$msg3 = '';

if ($action == 'ListSelect') {
    $productID = filter_input(INPUT_GET, 'product_list');
    $queryProduct = 'SELECT * FROM products WHERE productID = :productID';
    $statement3 = $db->prepare($queryProduct);
    $statement3->bindValue(':productID', $productID);
    $statement3->execute();
    $product = $statement3->fetch();
    $statement3->closeCursor();
    $msg2 = 'You selected product ' . $productID;
}

if ($action == 'TableSelect') {
    $productID = filter_input(INPUT_GET, 'prodID');
    $queryProduct = 'SELECT * FROM products WHERE productID = :productID';
    $statement3 = $db->prepare($queryProduct);
    $statement3->bindValue(':productID', $productID);
    $statement3->execute();
    $product = $statement3->fetch();
    $statement3->closeCursor();
    $msg3 = 'You selected product ' . $productID;
}
?>

<!DOCTYPE html>
<html>
<head></head>
    <title>Week 7 Assignment</title>
    <link rel="stylesheet" href="main.css" />
    <body>
   <main>

<?php include('viewProducts.php'); ?>
</body>
