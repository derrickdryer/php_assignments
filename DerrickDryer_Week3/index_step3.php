<?php 
    
	//create an sample array called employee salary
	//use the employee's userId as the array key. We call it a key because it is a string.
	//If the key were an integer , we would call it an index
	//The array value is the employee's hourly salary
	
    $employee_salary = array();
	$employee_salary["jac2233"] = 56.0;
	$employee_salary["abc4530"] = 78.78;
	$employee_salary["ghj1238"] = 34.56;
	
	/*get the action -- which is the name of the button in the form
	buttons  value will be "Add_Entry".*/
	
	$action = filter_input(INPUT_GET, 'action');
	
	//switch, or route code based on the value of button/action
	//This step doesn't take place until the user clicks the button
	if($action == "Add Entry") { 
		$userId = filter_input(INPUT_GET, 'userId'); //get the value of the userId text field... also check in the url
		$hourlySalary = filter_input(INPUT_GET, 'hourlySalary', FILTER_VALIDATE_FLOAT); // get the hourlySalary textfield 
		
		var_dump($userId); // test and see
		var_dump($hourlySalary);//test

		// Error checks
		if ($userId == null) {
			$error_message = "UserId must not be null.";
		} else if (array_key_exists($userId, $employee_salary)) {
			$error_message = "UserID already exists.";
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
		}
		// set the array $employee_salary at the key variable $userId 
		//set the value of the array at this key to the value carried by the variable $hourlySalary
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
					<th>Hourly Pay </th>
				</tr>
		
			<?php foreach($employee_salary as $userId => $hourlySalary) { ?>
				<tr>
					<td><?php echo $userId;?></td>
					<td><?php $hourlySalary_f = '$'.number_format($hourlySalary, 2);
						echo $hourlySalary_f;?></td>
				</tr>
			<?php } ?>
		
		</table>
    </div>
		
		

    </div id = "data2">
	</br>
	</br>
	</br>
    <h1>Add a new entry into the array</h1>
	<?php if (!empty($error_message)) { // If error message exists, display message ?>
    	<p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php } ?>
	<form action="index_step3.php" method="get">

        <div id="data">
            <label>UserID:</label>
            <input type="text" name="userId" value="">
            <br>

            <label>Salary Amount Per Hour:</label>
            <input type="text" name="hourlySalary" value="">
            <br>
			
			<div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" name= "action" value="Add Entry"><br>
        </div>
	</form>
	
	
    </div>	
	</main>
</body>
</html>