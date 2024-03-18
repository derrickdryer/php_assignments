<?php
	//create an sample array called employee salary
	//use the employee's userId as the array key. We call it a key because it is a string.
	//If the key were an integer , we would call it an index
	//The array value is the employee's hourly salary

	$error_message = "";

    $employee_salary = array();
	$employee_salary["jac2233"] = 56.0;
	$employee_salary["abc4530"] = 78.78;
	$employee_salary["ghj1238"] = 34.56;

	var_dump($employee_salary); // test to see the array and its attributes
	
	/*get the action -- which is the common name of all the buttons across the three forms
	the buttons differ by their value.*/
	$action = filter_input(INPUT_GET, 'action');

	//switch, or route functions based on the value of button/action

	if($action == "Add_Entry"){
		$userId = filter_input(INPUT_GET, 'userId_txt1'); //this is from the text box in add entry form
		$hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt1', FILTER_VALIDATE_FLOAT);//this is from the text box in add entry form
		
		// Error Checks
		if ($userId == null) {
			$error_message = "UserId must not be null.";
		} else if (array_key_exists($userId, $employee_salary)) {
			$error_message = "UserId already exists.";
		} else if ($hourlySalary === false) {
			$error_message = "Hourly Salary must be numeric";
		} else if ($hourlySalary > 1000) {
			$error_message = "Hourly Salary must be under $1,000.";
		} else if ($hourlySalary <= 0) {
			$error_message = "Hourly Salary must not be zero";
		}
		
		// If error message does not exist, continue to execute code
		if (empty($error_message)) {
			$employee_salary[$userId] = $hourlySalary;
		} // set the array $employee_salary at the key carried by the variable of $userID, to the value carried by $hourlySalary
		//if there isn't an already entry with key carried by variable $userId, a new row will be created.
		
		var_dump($userId); // test and see
		var_dump($hourlySalary);//test
		var_dump($employee_salary);
	}

	if($action == "Update_Entry"){
		$userId = filter_input(INPUT_GET, 'userId_txt2'); //this is from the text box in update entry form
		$hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt2', FILTER_VALIDATE_FLOAT);//this is from the text box in update entry form

		// Error Checks
		if ($userId == null) {
			$error_message = "UserID must not be null.";
		} else if (!array_key_exists($userId, $employee_salary)) {
			$error_message = "UserID does not exist.";
		} else if ($hourlySalary === false) {
			$error_message = "Hourly Salary must be numeric";
		} else if ($hourlySalary > 1000) {
			$error_message = "Hourly Salary must be under $1,000.";
		} else if ($hourlySalary < 0) {
			$error_message = "Hourly Salary must not be zero";
		}
		
		// If error message does not exist, continue to execute code
		if (empty($error_message)) {
			$employee_salary[$userId] = $hourlySalary;
		}// update the array $employee_salary at the key carried by $userID, to the value carried by variable $hourlySalary
		   //if there is already and entry with the key carried by variable $userId, that row will be updated.
		  //if there isn't an already entry with $userId key, a new row will be created. 

		var_dump($userId); // test and see
		var_dump($hourlySalary);//test
		var_dump($employee_salary);//test
	}

	if($action == "Delete_Entry"){
		$userId = filter_input(INPUT_GET, 'userId_txt3'); //this is from the text box in delete entry form
		
		// Error checks
		if ($userId == null) {
			$error_message = "UserID must not be null.";
		} else if (!array_key_exists($userId, $employee_salary)) {
			$error_message = "UserID does not exist.";
		}

		// If error message does not exist, continue to execute code
		if (empty($error_message)) {
			unset($employee_salary[$userId]); // unsets/removes that row with the $userId as the key. That row is set to a null value
			//$employee_salary = array_values($employee_salary); // removes the null valued row from the array
		}
		
		var_dump($userId); // test and see
		var_dump($employee_salary);
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
				<?php foreach($employee_salary as $userId => $hourlySalary) { // this loop is needed to generate the rows
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
            <input type="text" name="userId_txt1" value="">
            <br>
            <label>Hourly Pay:</label>
            <input type="text" name="hourlySalary_txt1" value="">
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
            <input type="text" name="userId_txt2" value="">
            <br>

            <label>New Hourly Pay:</label>
            <input type="text" name="hourlySalary_txt2" value="">
            <br>
			<div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" name= "action" value="Update_Entry"><br>
        </div>
	</form>
	
	<h1>Delete a Salary </h1>
	<h3><?php echo $error_message ; ?></h3>
	<form action="index_step4.php" method="get">
        <div id="data">
            <label>UserID to delete:</label>
            <input type="text" name="userId_txt3" value="">
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