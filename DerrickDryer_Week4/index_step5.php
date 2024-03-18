<?php 
	$status = session_status();
	if($status == PHP_SESSION_NONE){
		// There is no active session
		session_start();
	}

	$_SESSION['employee_salary'] = array(); // Empty array for new page load to not conflict with index_step4.php

	// Initilize an array for this session
	if(empty($_SESSION['employee_salary'])) {
		$_SESSION['employee_salary'] = array();
	
		// Fill Array
		$_SESSION['employee_salary']['jac2233'] = array("hourlySalary"=> 56.0 , "hrsPerWeek" => 40 , "daysPerWeek" => 5 );
		$_SESSION['employee_salary']['abc4530'] = array("hourlySalary"=> 78.78 , "hrsPerWeek" => 32 , "daysPerWeek" => 4 );
		$_SESSION['employee_salary']['ghj1238'] = array("hourlySalary"=> 34.56 , "hrsPerWeek" => 20 , "daysPerWeek" => 4 );

		// Dump Array Variables
		var_dump($_SESSION['employee_salary']);
	}

	$error_message = "";

	$action = filter_input(INPUT_GET, "action");

	// Add new entry form
	if ($action == "Add Entry") {
		// Filter Validation
		$userId = filter_input(INPUT_GET, "userId_txt1");
		$hourlySalary = filter_input(INPUT_GET, "hourlySalary_txt1", FILTER_VALIDATE_FLOAT);
		$hoursPerWeek = filter_input(INPUT_GET, "hoursPerWeek_txt1", FILTER_VALIDATE_INT);
		$daysPerWeek = filter_input(INPUT_GET, "daysPerWeek_txt1", FILTER_VALIDATE_INT);

		// Check if user exists
		if(array_key_exists($userId, $_SESSION['employee_salary'])) {
			$error_message = "User already exists";
		} else {
			$_SESSION['employee_salary'][$userId] = array("hourlySalary" => $hourlySalary, "hrsPerWeek" => $hoursPerWeek, "daysPerWeek" => $daysPerWeek);

			// Dump and verify
			var_dump($_SESSION['employee_salary']);
		}
	}
	if ($action == "Delete Entry") {
		$userId = filter_input(INPUT_GET, "userId_txt2");
		if(array_key_exists($userId, $_SESSION['employee_salary'])) {
			unset($_SESSION['employee_salary'][$userId]);
		} else {
			$error_message = "User does not exists.";
		}
	var_dump($userId);
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
		<h1>Employee Salaries from the session</h1>
			<div id="data">
				<table>
					<tr>
						<th>UserID</th>
						<th>Hourly Salary </th>
						<th>Hrs/Week </th>
						<th>Days/Week </th>
					</tr>
				<!-- Print all items within array into table -->
				<?php foreach($_SESSION['employee_salary'] as $userId => $salaryAttributes) { ?>
					<tr>
						<td><?php echo $userId; ?></td>
						<td><?php $hourlySalary_f = '$'.number_format($salaryAttributes["hourlySalary"], 2); echo $hourlySalary_f; ?></td>
						<td><?php echo $salaryAttributes["hrsPerWeek"]; ?></td>
						<td><?php echo $salaryAttributes["daysPerWeek"]; ?></td>
					</tr>
				<?php } ?>
				</table>
			</div>

			<div id="data2">
				</br>
				</br>
				</br>

				<!-- User can add new entries via this form -->
				<h1>Add New Entry</h1>
				<h3><?php echo $error_message; ?></h3>
				<form action="index_step5.php" method="get">
					<div id = "data">
						<label>UserID:</label>
						<input type="text" name="userId_txt1" value="">
						<br>
						<label>Hourly Pay:</label>
						<input type="text" name="hourlySalary_txt1" value="">
						<br>
						<label>Hours Per Week:</label>
						<input type="text" name="hoursPerWeek_txt1" value="">
						<br>
						<label>Days Per Week</label>
						<input type="text" name="daysPerWeek_txt1" value="">
						<br>
						<div id="buttons">
							<label>&nbsp;</label>
							<input type="submit" name="action" value="Add Entry">
							<br>
					</div>
				</form>

				<!-- Users can delete user with this form if they exist -->
				<h1>Delete Entry</h1>
				<h3><?php echo $error_message; ?></h3>
				<form action="index_step5.php" method="get">
					<div id="data">
						<label>UserID:</label>
						<input type="text" name="userId_txt2" value="">
						<br>
						<div id="buttons">
							<label>&nbsp;</label>
							<input type="submit" name="action" value="Delete Entry">
							<br>
						</div>
					</div>
				</form>
			</div>
		</main>
	</body>
</html>