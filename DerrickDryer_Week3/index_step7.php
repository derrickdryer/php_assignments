<?php 
    $employee_salary = array();
	$employee_salary["jac2233"] = array("hourlySalary"=> 56.0 , "hrsPerWeek" => 40 , "daysPerWeek" => 5 );
	$employee_salary["abc4530"] = array("hourlySalary"=> 78.78 , "hrsPerWeek" => 32 , "daysPerWeek" => 4 );
	$employee_salary["ghj1238"] = array("hourlySalary"=> 34.56 , "hrsPerWeek" => 20 , "daysPerWeek" => 4 );

	$action = filter_input(INPUT_GET, 'action');
	if($action == "Add Entry"){
		$error_message1 = "";

		$userId = filter_input(INPUT_GET, "userId_txt1");
		$hourlySalary = filter_input(INPUT_GET, "hourlySalary_txt1", FILTER_VALIDATE_FLOAT);
		$hoursPerWeek = filter_input(INPUT_GET, "hoursPerWeek_txt1", FILTER_VALIDATE_INT);
		$daysPerWeek = filter_input(INPUT_GET, "daysPerWeek_txt1", FILTER_VALIDATE_INT);

		if ($userId == null) {
			$error_message1 = "UserID must not be null.";
		} else if (array_key_exists($userId, $employee_salary)) {
			$error_message1 = "UserID already exists.";
		} else if ($hourlySalary === false) {
			$error_message1 = "Hourly Salary must be numeric.";
		} else if ($hourlySalary > 1000) {
			$error_message1 = "Hourly Salary must be under $1,000.";
		} else if ($hourlySalary <= 0 ) {
			$error_message1 = "Hourly Salary must not be zero";
		} else if ($hoursPerWeek === false) {
			$error_message1 = "Hours Per Week must be numeric";
		} else if ($hoursPerWeek > 100) {
			$error_message1 = "Hours Per Week must be under 100.";
		} else if ($hoursPerWeek <= 0) {
			$error_message1 = "Hours Per Week must not be zero.";
		} else if ($daysPerWeek === false) {
			$error_message1 = "Days Per Week must be numeric";
		} else if ($daysPerWeek > 7) {
			$error_message1 = "Days Per Week cannot exceed 7.";
		} else if ($daysPerWeek <= 0) {
			$error_message1 = "Days Per Week must not be zero.";
		}

		if (empty($error_message1)) {
			$employee_salary[$userId] = array("hourlySalary" => $hourlySalary, "hrsPerWeek" => $hoursPerWeek, "daysPerWeek" => $daysPerWeek);
		}

		var_dump($userId);
		var_dump($hourlySalary);
		var_dump($hoursPerWeek);
		var_dump($daysPerWeek);
		var_dump($employee_salary);
	}

	if($action == "Update Entry"){
		$error_message2 = "";

		$userId = filter_input(INPUT_GET, 'userId_list1');
		$subKey = filter_input(INPUT_GET, 'userId_list2');

		if ($subKey == "hourlySalary") {
			$updateValue = filter_input(INPUT_GET, 'updateValue', FILTER_VALIDATE_FLOAT);
		} else if ($subKey == "hoursPerWeek" or $subKey == "daysPerWeek") {
			$updateValue = filter_input(INPUT_GET, 'updateValue', FILTER_VALIDATE_INT);
		}

		if ($userId == null) {
			$error_message2 = "UserID must not be null.";
		} else if (!array_key_exists($userId, $employee_salary)) {
			$error_message2 = "UserID does not exist.";
		} else if ($subKey == "hourlySalary") {
			if ($updateValue === false) {
				$error_message2 = "Hourly Salary must be numeric";
			} else if ($updateValue > 1000) {
				$error_message2 = "Hourly Salary must be under $1,000";
			} else if ($updateValue < 0) {
				$error_message2 = "Hourly Salary must not be zero.";
			}
		} else if ($subKey == "hoursPerWeek") {
			if ($updateValue === false) {
				$error_message2 = "Hours Per Week must be numeric.";
			} else if ($updateValue > 100) {
				$error_message2 = "Hours Per Week must be under 100.";
			} else if ($updateValue <= 0) {
				$error_message2 = "Hours Per Week must not be zero.";
			}
		} else if ($subKey == "daysPerWeek") {
			if ($updateValue === false) {
				$error_message2 = "Days Per Week must be numeric.";
			} else if ($updateValue > 7) {
				$error_message2 = "Days Per Week cannot exceed 7.";
			} else if ($updateValue <= 0) {
				$error_message2 = "Days Per Week must not be zero.";
			}
		}
		if (empty($updateValue2)) {
			$employee_salary[$userId][$subKey] = $updateValue;
		}

		var_dump($userId);
		var_dump($subKey);
		var_dump($employee_salary);
	}

	if($action == "Delete Entry"){
		$error_message3 = "";

		$userId = filter_input(INPUT_GET, 'userId_list3');
		$error_message2 = "";
		$userId = filter_input(INPUT_GET, 'userId_list3');

		if ($userId == null) {
			$error_message3 = "UserID must not be null.";
		} else if (!array_key_exists($userId, $employee_salary)) {
			$error_message3 = "UserID does not exist.";
		}

		if (empty($error_message3)) {
			unset($employee_salary[$userId]);
		}

		var_dump($userId);
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
					<th>Hourly Salary </th>
					<th>Hrs/Week </th>
					<th>Days/Week </th>
				</tr>
				<?php foreach($employee_salary as $userId => $salaryAttributes) { ?>
					<tr>
						<td><?php echo $userId;?></td>
						<td><?php $hourlySalary_f = '$'.number_format($salaryAttributes["hourlySalary"], 2); echo $hourlySalary_f;?></td>
						<td><?php echo $salaryAttributes["hrsPerWeek"]; ?></td>	
						<td><?php echo $salaryAttributes["daysPerWeek"]; ?></td>	
					</tr>
				<?php } ?>
			</table>
        </div>

		</br>
		</br>
		</br>

		</div id = "data2">
			<h1>Add new entry</h1>
			<h3><?php echo $error_message1; ?>
			<form action="index_step7.php" method="get">
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
					<label>Days Per Week:</label>
					<input type="text" name="daysPerWeek_txt1" value="">
					<br>
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Add Entry">
					<br>
				</div>
			</form>

			<h1>Update an entry</h1>
			<h3><?php echo $error_message2; ?>
			<form action="index_step7.php" method="get">
				<div id="data">
					<label>Select UserID:</label>
					<select name="userId_list1">
						<?php foreach($employee_salary as $userId => $salaryAttributes) : ?>
							<option value="<?php echo $userId; ?>"><?php echo $userId; ?></option>
						<?php endforeach; ?>
					</select>
					<br>
					<label>Select Attribute</label>
					<select name="userId_list2">
							<option value="hourlySalary">hourlySalary</option>
							<option value="hrsPerWeek">hrsPerWeek</option>
							<option value="daysPerWeek">daysPerWeek</option>
					</select>
					<br>
					<label>New value:</label>
					<input type="text" name="updateValue" value="">
					<br>
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Update Entry">
					<br>
				</div>
			</form>

			<h1>Delete an entry</h1>
			<h3><?php echo $error_message3; ?>
			<form action="index_step7.php" method="get">
				<div id="data">
					<label>Select UserID:</label>
					<select name="userId_list3">
						<?php foreach($employee_salary as $userId => $salaryAttributes) : ?>
							<option value="<?php echo $userId; ?>"><?php echo $userId; ?></option>
						<?php endforeach; ?>
					</select>
					<br>
					<label>&nbsp;</label>
					<input type="submit" name="action" value="Delete Entry">
					<br>
				</div>
			</form>
	</main>
</body>
</html>