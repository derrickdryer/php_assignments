<?php
  // Connect to the database
  $dsn = 'mysql:host=localhost;dbname=my_guitar_shop1';

  // Connect as root
  $username = 'root';
  $password = '';

  // Attempt to connect and display error if it fails
  try {
    $db = new PDO($dsn, $username, $password);
    echo '<p> You are connected. </p>';
  }
  catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo '<p> Connection failed due to an error :  $error_message </p>';
  }

  // QUERY THE DATABASE

  // Create a query string
  $queryString = 'SELECT productID, productName FROM products ORDER BY productID';

  // Prepare the query
  $statement = $db->prepare($queryString);

  // Execute the query
  $statement->execute();

  // Get the result set
  $products = $statement-> fetchAll();

  // Print productIDs and productNames
  foreach ($products as $product) {
    echo $product['productID'] . ' - ' . $product['productName'] . '<br>';
  }
?>
