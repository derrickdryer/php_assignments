<?php

$dsn = 'mysql:host=localhost;dbname=my_guitar_shop2';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    echo '<p> You are connected. </p>';
}
catch (PDOException $e){
    $error_message = $e->getMessage();
    echo '<p> Connection failed due to error : $error_message </p>';
}
?>