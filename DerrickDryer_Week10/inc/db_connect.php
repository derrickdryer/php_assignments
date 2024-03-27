<?php
  $dsn = 'mysql:host=localhost;dbname=my_guitar_shop2';
    $username = 'root';
    $password = '';
    try {
        $db = new PDO($dsn, $username, $password);
		echo '<p> You are connected to the database.</p>';
    } 
	catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo  'Connection error.:$error_message';
    }
?>