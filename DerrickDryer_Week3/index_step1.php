<?php 
    
    
	//create an sample array called employee salary
	//use the employee's userId as the array key. We call it a key because it is a string.
	//If the key were an integer , we would call it an index
	//The array value is the employee's hourly salary
	
    $employee_salary = array(); // creates an empty array
	$employee_salary["jac2233"] = 56.0; //adds an element with the given key. This element has only one value 56.0
	$employee_salary["abc4530"] = 78.78; //add another element
	$employee_salary["ghj1238"] = 34.56; //add another element

	// Individual var_dump of each employee's salary
	var_dump($employee_salary["jac2233"]);
	var_dump($employee_salary["abc4530"]);
	var_dump($employee_salary["ghj1238"]);
	
	// var_dump of the entire array
	var_dump($employee_salary);
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
		
			<?php foreach($employee_salary as $userId => $hourlySalary) { 
			/*this loop is needed to generate the rows. We split the super-key and the element/salary. key is in variable $userID, the  value lies in the variable $salary*/
			?>
				<tr>
					<td><?php echo $userId;// this is the value in the UserID column for the row
					    ?></td>
					<td><?php $hourlySalary_f = '$'.number_format($hourlySalary, 2); // format the salary
						echo $hourlySalary_f;// this is what will be echoed into the 2nd column of the row
						?></td>
				</tr>
		    <?php } // the loop runs for as many rows there are in the array ?>
		
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