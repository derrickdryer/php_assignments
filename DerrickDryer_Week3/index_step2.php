<?php 
    
    
	/*create an sample array called employee salary
	use the employee's userId as the array key. We call it a key because it is a string.
	If the key were an integer , we would call it an index
	The array value is now an antire row conistsing of employee's keyed attributes such as
	days worked, hours per week etc 
	We now need an array for each row. This is a 2-D array that resembles a table*/
	
    $employee_salary = array(); // creates an empty array
	//next, add an element with the given key. This element itself is has multiple attribues ( sub-keys) and this element is an associative array.
	//the attribute names of the elements are : "hourlySalary", "hrsPerWeek" and "daysPerWeek"
	//the values of the attributes are 56.0, 40 and 5, respectively
	//the first element has a key ( or super/primary-key) "jac2233". This key can be used to pull out all the attributes by refereing to its sub-keys
	$employee_salary["jac2233"] = array("hourlySalary"=> 56.0 , "hrsPerWeek" => 40 , "daysPerWeek" => 5 );
	// var_dump of each association of the employee
	var_dump($employee_salary["jac2233"]["hourlySalary"]);
	var_dump($employee_salary["jac2233"]["hrsPerWeek"]);
	var_dump($employee_salary["jac2233"]["daysPerWeek"]);
	
	//then, add more rows using super and sub keys and sub-key values
	$employee_salary["abc4530"] = array("hourlySalary"=> 78.78 , "hrsPerWeek" => 32 , "daysPerWeek" => 4 );
	var_dump($employee_salary["abc4530"]["hourlySalary"]);
	var_dump($employee_salary["abc4530"]["hrsPerWeek"]);
	var_dump($employee_salary["abc4530"]["daysPerWeek"]);

	$employee_salary["ghj1238"] = array("hourlySalary"=> 34.56 , "hrsPerWeek" => 20 , "daysPerWeek" => 4 );
	var_dump($employee_salary["ghj1238"]["hourlySalary"]);
	var_dump($employee_salary["ghj1238"]["hrsPerWeek"]);
	var_dump($employee_salary["ghj1238"]["daysPerWeek"]);

	// var_dump of the entire array
	var_dump($employee_salary);
	
	/* 
	An alternate way to add each data point to the 2D array is as follows: 
	$employee_salary["abc4530"]["hourlySalary"] = 78.78;
	$employee_salary["abc4530"]["hrsPerWeek"] = 32;
	$employee_salary["abc4530"]["daysPerWeek"] = 4;
	$employee_salary["ghj1238"]["hourlySalary"] = 34.56;
	$employee_salary["ghj1238"]["hrsPerWeek"] = 20;
	$employee_salary["ghj1238"]["daysPerWeek"] = 4;
	Here we map each data to its position in the table using the combination
	of the super-key and sub-key ( same as primary key and attribute name).
	
	
	*/
	
	
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
					<th>Hrs/Week </th>
					<th>Days/Week </th>
					<th>Hrs/Day </th>
				</tr>
		
			<?php foreach($employee_salary as $userId => $salaryAttributes) { 
			/* this loop is needed to generate the rows. 
			We split the super-key and the element/row as such. 
			super key is in variabe $userID, the array is in $salaryAttributes*/
			?>
			
				<tr>
					<td><?php echo $userId;  // this is the value in the UserID column for the row 
					?></td>
					<td><?php $hourlySalary_f = '$'.number_format($salaryAttributes["hourlySalary"], 2);  // format the salary. noticed the way I get the sub-key/attribute
						echo $hourlySalary_f; // this is what will be echoed into the 2nd column of the row 
					?></td>
					<td><?php echo $salaryAttributes["hrsPerWeek"]; // get the value of attribute/sub-key "hrsPerweek" from the element/array $salaryAttributes
					?></td>	
					<td><?php echo $salaryAttributes["daysPerWeek"]; // get the value of attribute/sub-key "daysPerweek" from the element/array $salaryAttributes
					?></td>
					<td><?php echo $salaryAttributes["hrsPerWeek"]/$salaryAttributes["daysPerWeek"]; // calculate the hours per day
					?></td>
				</tr>
			<?php } // the loop runs for as many rows/super-keys there are in the array  ?>
		
		</table>
    </div>

    </div id = "data2">
     </br>
	 </br>
	 </br>
    </div>	
	</main>
</body>
</html>