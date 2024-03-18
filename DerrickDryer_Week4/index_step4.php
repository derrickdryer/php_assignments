<?php 
    /*In week 3 assignments you had created a sample array called $employee_salary
	This array was created each time you ran this page.
	This array was non-persistent - it couldn't save the changes beyond a buton click
	This is how you had created the array
	$employee_salary = array();
	$employee_salary["jac2233"] = 56.0;
	$employee_salary["abc4530"] = 78.78;
	$employee_salary["ghj1238"] = 34.56;*/
	
	/*In week 4 assignment, we will make the $employee_Salary persistent by putting in a session
	We will add the contents of the employee_salary array into a $_SESSION array
	We will identify our array ($employee_salary ) with the $_SESSION array using a special key
	So now we have a $_SESSION array --- this carried the $employee_salary array--which in turn,
	carries the associative array that consititutes its elemets.
	We now have a complex array at various levels $_SESSION, in which you have the $_employee_salary, in which you have 
	the associative arrays that forms the rows of $employee_salary.*/
	
	//first, initialize the $_SESSION array 
	//create an empty $_SESSION array if there is none
	$status = session_status();
	if($status = PHP_SESSION_NONE){
		//there is no active session
		session_start();
	}

	$_SESSION['employee_salary'] = array(); // empty employee salary so it doesn't conflict with index_step5.php
	
	//second, initialize an entry in the $_SESSION array- this will be the space for your  employee_salary array
	if(empty($_SESSION['employee_salary'])){  //we have a super-super-key called "employee_salary" as our array identifier in the session
		$_SESSION['employee_salary'] = array(); // create the empty array for employee salary
		//now create your employee salary starter array like you did before
		
	    $_SESSION['employee_salary']["jac2233"] = 56.0;
	    $_SESSION['employee_salary']["abc4530"] = 78.78;
	    $_SESSION['employee_salary']["ghj1238"] = 34.56;
		
		//put this $employee_salary into the session array:
		
		var_dump($_SESSION['employee_salary']); // test to see if array is populated
		
	}
	
	/*get the action -- which is the common name of all the buttons across the three forms
	the buttons differ by their value.*/
	$action = filter_input(INPUT_GET, 'action');
	$error_msg = "";
	//switch, or route functions based on the value of button/action
	
	if($action == "Add_Entry"){
		 $userId = filter_input(INPUT_GET, 'userId_txt1'); //this is from the text box in add entry form
		 $hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt1', FILTER_VALIDATE_FLOAT);//this is from the text box in add entry form
		/*In this assignment, we will add to the session and continue to work directly with the session*/
		
		if(array_key_exists($userId, $_SESSION['employee_salary'])) { $error_msg = "key exists";}
		else { $_SESSION['employee_salary'][$userId] = $hourlySalary;}
		 var_dump($userId); // test and see
		 var_dump($hourlySalary);//test
	}
	
	if($action == "Update_Entry"){
		 $userId = filter_input(INPUT_GET, 'userId_txt2'); //this is from the text box in update entry form
		 $hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt2', FILTER_VALIDATE_FLOAT);//this is from the text box in update entry form
		
		  if(array_key_exists($userId, $_SESSION['employee_salary'])) 
		  {$_SESSION['employee_salary'][$userId] = $hourlySalary; }
		  else {$error_msg = "key does not exist";}
		  
		 var_dump($userId); // test and see
		 var_dump($hourlySalary);//test
	}
	
	if($action == "Delete_Entry"){
		$userId = filter_input(INPUT_GET, 'userId_txt3'); //this is from the text box in delete entry form
		 if(array_key_exists($userId, $_SESSION['employee_salary'])) 
		  { unset($_SESSION['employee_salary'][$userId]); }
		  else {$error_msg = "key does  not exist";}
		  
		// unsets removes that row with the $userId as the key
		//no need to do array_values()with sessions.
		var_dump($userId); // test and see
		
		
	}
	
	
	
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Employee Salary Portal</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
    <h1>Employee Salaries</h1>
	<div id = "data">
		<table>
				<tr>
					<th>UserID</th>
					<th>Salary </th>
				</tr>
		
			<?php foreach($_SESSION['employee_salary'] as $userId => $hourlySalary) { // this loop is needed to generate the rows
			?>
				<tr>
					<td><?php echo $userId; // this is the value in the UserID column for the row 
					?></td>
					<td><?php $hourlySalary_f = '$'.number_format($hourlySalary, 2); // format the salary
						echo $hourlySalary_f; // this is what will be echoed into the 2nd column of the row 
						?></td>
				</tr>
			<?php } // the loop runs for as many rows there are in the array 
			?>
		
		</table>
    </div>
		
		

   </div id = "data2">
	</br>
	</br>
	</br>
     <h1>Add a new entry into the array</h1>
	 	<h3><?php echo $error_message ; ?></h3>
	    <form action="index_step4.php" method="get">

        <div id="data">
            <label>UserID:</label>
            <input type="text" name="userId_txt1"
                   value="">
            <br>

            <label>Hourly Pay:</label>
            <input type="text" name="hourlySalary_txt1"
                   value="">
            <br>
			
			 			
			<div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" name= "action" value="Add_Entry"><br>
        </div>
	    </form>
	 
	 <h1>Update a Salary </h1>
	 	<h3><?php echo $error_message ; ?></h3>
	 <form action="index_step4.php" method="get">

        <div id="data">
            <label>UserID to update:</label>
            <input type="text" name="userId_txt2"
                   value="">
            <br>

            <label>New Hourly Pay:</label>
            <input type="text" name="hourlySalary_txt2"
                   value="">
            <br>
			
			 			
			<div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" name= "action" value="Update_Entry"><br>
        </div>
	 </form>
	 
	 <h1>Delete a Salary </h1>
	 <form action="index_step4.php" method="get">

        <div id="data">
            <label>UserID to delete:</label>
            <input type="text" name="userId_txt3"
                   value="">
            <br>
			
			<div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" name= "action" value="Delete_Entry"><br>
        </div>
	 </form>
	 
    </div>	
	</main>
</body>
</html>