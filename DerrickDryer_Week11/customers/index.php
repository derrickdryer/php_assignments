<?php
require_once('../inc/db_connect.php');

// Get all orders
$query = 'SELECT * FROM customers
                       ORDER BY customerID';
$statement = $db->prepare($query);
$statement->execute();
$customers= $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Customers</h1></header>
<main>
    <h1>Customer List</h1>

        <!-- display a list of categories -->
   <h2>Customers</h2>
   <table>
                   <tr>
					<th>CustomerID</th>
					<th>Email</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Billing Address</th>
                    <th>Shipping Address</th>					
				   </tr>
				   
				     <?php foreach($customers as $customer): ?>
				   <tr>
				   <td><?php echo $customer['customerID']; ?></td>
				   <td><?php echo $customer['emailAddress']; ?></td>
				   <td><?php echo $customer['firstName']; ?></td>
				   <td><?php echo $customer['lastName']; ?></td>
				   <td><?php echo $customer['billingAddressID']; ?></td>
				   <td><?php echo $customer['shipAddressID']; ?></td>
				   </tr>
		            <?php endforeach; ?>
  
   </table>
   <p><a href="addCustomerForm.php">Add Customer</a></p>
   <p><a href="updateCustomersForm.php">Update Customer</a></p>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>