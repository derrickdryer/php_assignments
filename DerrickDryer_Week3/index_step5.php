<?php 
    
    
	/*create an sample array called employee salary
	use the employee's userId as the array key. We call it a key because it is a string.
	If the key were an integer , we would call it an index
	The array value is now an antire row conistsing of employee's keyed attributes such as
	days worked, hours per week etc 
	We now need an array for each row. This is a 2-D array that resembles a table*/

	$error_message = "";

    $employee_salary = array();
	$employee_salary["jac2233"] = array("hourlySalary"=> 56.0 , "hrsPerWeek" => 40 , "daysPerWeek" => 5 );
	$employee_salary["abc4530"] = array("hourlySalary"=> 78.78 , "hrsPerWeek" => 32 , "daysPerWeek" => 4 );
	$employee_salary["ghj1238"] = array("hourlySalary"=> 34.56 , "hrsPerWeek" => 20 , "daysPerWeek" => 4 );
	
	
	// filter the value of button called action :  $action = filter_input(INPUT_GET, 'action');
	$action = filter_input(INPUT_GET, "action");
	

	if($action == "Add_Entry") {
		// Filter Validation
		$userId = filter_input(INPUT_GET, "userId_txt1");
		$hourlySalary = filter_input(INPUT_GET, "hourlySalary_txt1", FILTER_VALIDATE_FLOAT);
		$hoursPerWeek = filter_input(INPUT_GET, "hoursPerWeek_txt1", FILTER_VALIDATE_INT);
		$daysPerWeek = filter_input(INPUT_GET, "daysPerWeek_txt1", FILTER_VALIDATE_INT);

		// Error Checks
		if ($userId == null) {
			$error_message = "UserID must not be null.";
		} else if (array_key_exists($userId, $employee_salary)) {
			$error_message = "UserID already exists.";
		} else if ($hourlySalary === false) {
			$error_message = "Hourly Salary must be numeric.";
		} else if ($hourlySalary > 1000) {
			$error_message = "Hourly Salary must be under $1,000.";
		} else if ($hourlySalary <= 0 ) {
			$error_message = "Hourly Salary must not be zero";
		} else if ($hoursPerWeek === false) {
			$error_message = "Hours Per Week must be numeric";
		} else if ($hoursPerWeek > 100) {
			$error_message = "Hours Per Week must be under 100.";
		} else if ($hoursPerWeek <= 0) {
			$error_message = "Hours Per Week must not be zero.";
		} else if ($daysPerWeek === false) {
			$error_message = "Days Per Week must be numeric";
		} else if ($daysPerWeek > 7) {
			$error_message = "Days Per Week cannot exceed 7.";
		} else if ($daysPerWeek <= 0) {
			$error_message = "Days Per Week must not be zero.";
		}

		// If on successful
		if (empty($error_message)) {
			$employee_salary[$userId] = array("hourlySalary" => $hourlySalary, "hrsPerWeek" => $hoursPerWeek, "daysPerWeek" => $daysPerWeek);
		}

		// Testing
		var_dump($userId);
		var_dump($hourlySalary);
		var_dump($employee_salary);
	}
	/*write if condition to check if the action is equal to "Add Entry"
	//filter all the attribute values from the textboxes in the form
	//var_dump and check all teh attributes -- just to test
	//validate the inputs
	// to add a row use the statement: $employee_salary[$userId] = array("hourlySalary" => $hourlySalary , "hrsPerWeek" => $hrsPerWeek , "daysPerWeek" => $daysPerWeek );
	//var_dump the array $employee_salary
	}*/

	if($action == "Delete_Entry") {
		// Filter Validation
		$userId = filter_input(INPUT_GET,"userId_txt2");

		// Error Checks
		if ($userId == null) {
			$error_message = "UserID must not be null.";
		} else if (!array_key_exists($userId, $employee_salary)) {
			$error_message = "UserID does not exist.";
		}

		// If on successful
		if (empty($error_message)) {
			unset($employee_salary[$userId]);
		}

		// Testing
		var_dump($userId);
		var_dump($hourlySalary);
		var_dump($employee_salary);
	}
	/*write if condition to check if the action is equal to "Delete Entry"
	//filter the userId attribute values from the textboxe in the form
	//var_dump and check  -- just to test
	//validate the input
	// to delete a row use the two statements:
	//unset($employee_salary[$userId]);
	//$employee_salary = array_values($employee_salary); 
	//var_dump the array $employee_salary
	}*/
	
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
		<th>Hourly Salary </th>
		<th>Hrs/Week </th>
		<th>Days/Week </th>
		</tr>
		
		<?php foreach($employee_salary as $userId => $salaryAttributes) { ?>
		<tr>
		<td><?php echo $userId;?></td>
		<td><?php $hourlySalary_f = '$'.number_format($salaryAttributes["hourlySalary"], 2);
		    echo $hourlySalary_f;?></td>
		<td><?php echo $salaryAttributes["hrsPerWeek"]; ?></td>	
		<td><?php echo $salaryAttributes["daysPerWeek"]; ?></td>	
		</tr>
		<?php } ?>
		
		</table>
        </div>
		
		</div id="data2">
		</br>
		</br>
		</br>

		<h1>Add New Entry</h1>
		<h3><?php echo $error_message; ?></h3>
		<form action="index_step5.php" method="get">
			<div id="data">
				<label>UserID:</label>
				<input type="text" name="userId_txt1" value="">
				<br>
				<label>Hourly Pay:</label>
				<input type="text" name="hourlySalary_txt1" value="">
				<br>
				<label>Hours Per Week:</label>
				<input type="text" name="hoursPerWeek_txt1" value="">
				<br>
				<label>Days per Week:</label>
				<input type="text" name="daysPerWeek_txt1" value="">
				<br>
				<label>&nbsp;</label>
				<input type="submit" name="action" value="Add_Entry">
				<br>
			</div>
		</form>

		<h1>Delete Entry</h1>
		<h3><?php echo $error_message; ?></h3>
		<form action="index_step5.php" method="get">
			<div id="data">
				<label>UserID:</label>
				<input type="text" name="userId_txt2" value="">
				<br>
				<label>&nbsp;</label>
				<input type="submit" name="action" value="Delete_Entry">
				<br>
			</div>
		</form>
	</main>
</body>
</html>