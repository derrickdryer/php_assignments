<?php
    // POST data and filter data types
    /*$userId = filter_input(INPUT_POST,'userId');
    $hourlySalary = filter_input(INPUT_POST,'hourlySalary',FILTER_VALIDATE_FLOAT);
    $hoursPerWeek = filter_input(INPUT_POST,'hoursPerWeek',FILTER_VALIDATE_FLOAT);
    $daysPerWeek = filter_input(INPUT_POST,'daysPerWeek',FILTER_VALIDATE_INT);
    $vacationPerYear = filter_input(INPUT_POST,'vacationPerYear',FILTER_VALIDATE_INT);
    $holidayPerYear = filter_input(INPUT_POST,'holidayPerYear',FILTER_VALIDATE_INT);*/

    // GET data and filter data types
    $userId = filter_input(INPUT_GET,'userId');
    $hourlySalary = filter_input(INPUT_GET,'hourlySalary',FILTER_VALIDATE_FLOAT);
    $hoursPerWeek = filter_input(INPUT_GET,'hoursPerWeek',FILTER_VALIDATE_FLOAT);
    $daysPerWeek = filter_input(INPUT_GET,'daysPerWeek',FILTER_VALIDATE_INT);
    $vacationPerYear = filter_input(INPUT_GET,'vacationPerYear',FILTER_VALIDATE_INT);
    $holidayPerYear = filter_input(INPUT_GET,'holidayPerYear',FILTER_VALIDATE_INT);

    // Dump variables & types
    var_dump($userId);
    var_dump($hourlySalary);
    var_dump($hoursPerWeek);
    var_dump($daysPerWeek);
    var_dump($vacationPerYear);
    var_dump($holidayPerYear);

    // Calculate Salary
    $yearlySalary = $hourlySalary * (($daysPerWeek * $hoursPerWeek) + (($hoursPerWeek/$daysPerWeek) * $vacationPerYear) + (($hoursPerWeek/$daysPerWeek) * $holidayPerYear));
    // Apply Formatting
    $yearlySalaryFormatted = "$".number_format($yearlySalary, 2);
    $hourlySalaryFormatted = "$".number_format($hourlySalary, 2);
    $userIdFormatted = htmlspecialchars($userId);
    $hoursPerWeekFormatted = number_format($hoursPerWeek, 2);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salary Calculator</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <main>
            <h1>Salary Calculator</h1>
            <label>UserID:</label>
            <span><?php echo $userIdFormatted; ?></span><br>
            <label>Yearly Salary:</label>
            <span><?php echo $yearlySalaryFormatted; ?></span><br>
            <label>Hourly Salary Amount:</label>
            <span><?php echo $hourlySalaryFormatted; ?></span><br>
            <label>Hours Per Week:</label>
            <span><?php echo $hoursPerWeekFormatted; ?></span><br>
            <label>Days Per Week:</label>
            <span><?php echo $daysPerWeek; ?></span><br>
            <label>Vacation Per Year:</label>
            <span><?php echo $vacationPerYear; ?></span><br>
            <label>Holidays Per Year:</label>
            <span><?php echo $holidayPerYear; ?></span><br>
        </main>
    </body>
</html>