<?php
require('../inc/db_connect.php');



//fetch the text box values

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$password = password_hash($password, PASSWORD_DEFAULT);
$fName = filter_input(INPUT_POST, 'fName');
$lName = filter_input(INPUT_POST, 'lName');
$line1 = filter_input(INPUT_POST, 'line1');
$line2 = filter_input(INPUT_POST, 'line2');
$city = filter_input(INPUT_POST, 'city');
$state = filter_input(INPUT_POST, 'state');
$zipCode = filter_input(INPUT_POST, 'zipcode');
$phone = filter_input(INPUT_POST, 'phone');
$disabled = filter_input(INPUT_POST, 'disabled');

//check for unique index validation
        $queryCheckEmail = 'SELECT COUNT(*) FROM customers 
	                      WHERE emailAddress =:email';
		$stmt = $db->prepare( $queryCheckEmail);
		$stmt->bindValue(':email', $email);
        $stmt->execute();
        $countEmail = $stmt->fetchColumn();


//Validate values
if ($fName == null || $lName == null ||
        $email == null || $password ==null || $line1 == null || $line2 == null ||
        $city == null || $state == null||  $zipCode == null || $phone== null ) {
    $error = "Invalid  data. Check all fields and try again.";
    echo $error;
     include('addCustomerForm.php');	
	 }
	
	else if ($countEmail>0) { echo "Please provide a unique email Address. This address exists";
	                                include('addCustomerForm.php');
									}
	
	//Insert new customer , new Address, update customer
	else {	  
    
	// Add the product to the database  
		$queryInsertCustomer = 'INSERT INTO customers
					 (emailAddress, password, firstName, lastName)
				  VALUES
					 (:email, :password, :fName , :lName)';
		$statement2 = $db->prepare($queryInsertCustomer);
		
		$statement2->bindValue(':email', $email);
		$statement2->bindValue(':password', $password);
		$statement2->bindValue(':fName', $fName);
		$statement2->bindValue(':lName', $lName);
	    $statement2->execute();
        $lastCust = $db->lastInsertId();
		$statement2->closeCursor();


		// Add the ship address to the address table 
		$queryInsertShipAddress = 'INSERT INTO addresses
					 (customerID, line1, line2, city, state, zipCode, phone, disabled)
				  VALUES
					 (:customerID, :line1, :line2, :city, :state, :zipCode, :phone, :disabled)';
		$statement3 = $db->prepare($queryInsertShipAddress);
		
		$statement3->bindValue(':customerID', $lastCust);
		$statement3->bindValue(':line1', $line1);
		$statement3->bindValue(':line2', $line2);
		$statement3->bindValue(':city', $city);
		$statement3->bindValue(':state', $state);
		$statement3->bindValue(':zipCode', $zipCode);
		$statement3->bindValue(':phone', $phone);
		$statement3->bindValue(':disabled', $disabled);
		$statement3->execute();
		 $lastShipId = $db->lastInsertId();     
		$statement3->closeCursor();
		
		
		// Add the bill address to the address table
		$queryInsertBillAddress = 'INSERT INTO addresses
					 (customerID, line1, line2, city, state, zipCode, phone, disabled)
				  VALUES
					 (:customerID, :line1, :line2, :city, :state, :zipCode, :phone, :disabled)';
		$statement4 = $db->prepare($queryInsertBillAddress);
	    $statement4->bindValue(':customerID', $lastCust);
		$statement4->bindValue(':line1', $line1);
		$statement4->bindValue(':line2', $line2);
		$statement4->bindValue(':city', $city);
		$statement4->bindValue(':state', $state);
		$statement4->bindValue(':zipCode', $zipCode);
		$statement4->bindValue(':phone', $phone);
		$statement4->bindValue(':disabled', $disabled);
		$statement4->execute();
		 $lastBillId = $db->lastInsertId();  
		$statement4->closeCursor();
		
		//Update Shipping and Billing address for the given customer:
		$queryCustAddress = 'UPDATE customers
		                         SET shipAddressID =:shipAddressID , billingAddressID =:billingAddressID
								 WHERE customerID =:customerID';
		$statement5 = $db->prepare($queryCustAddress);
	    $statement5->bindValue(':shipAddressID',  $lastShipId);
        $statement5->bindValue(':billingAddressID', $lastBillId);
        $statement5->bindValue(':customerID', $lastCust);
        
        $statement5->execute();
        $statement5->closeCursor();
		
		
		echo $lastBillId;
		echo $lastCust;
		echo $lastShipId;
		
		include('index.php');
		
}



		
?>
