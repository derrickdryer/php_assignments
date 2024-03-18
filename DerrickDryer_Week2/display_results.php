<?php
    // No Error Message
    $error_message='';

    // POST data and filter data types
    /*$userId = filter_input(INPUT_POST,'userId');
    $hourlySalary = filter_input(INPUT_POST,'hourlySalary',FILTER_VALIDATE_FLOAT);
    $hoursPerWeek = filter_input(INPUT_POST,'hoursPerWeek',FILTER_VALIDATE_FLOAT);
    $daysPerWeek = filter_input(INPUT_POST,'daysPerWeek',FILTER_VALIDATE_INT);
    $vacationPerYear = filter_input(INPUT_POST,'vacationPerYear',FILTER_VALIDATE_INT);
    $holidayPerYear = filter_input(INPUT_POST,'holidayPerYear',FILTER_VALIDATE_INT);*/

    // GET data and filter data types & Dump
    $userId = filter_input(INPUT_GET,'userId');
    #var_dump($userId);
    $hourlySalary = filter_input(INPUT_GET,'hourlySalary',FILTER_VALIDATE_FLOAT);
    #var_dump($hourlySalary);
    $hoursPerWeek = filter_input(INPUT_GET,'hoursPerWeek',FILTER_VALIDATE_FLOAT);
    #var_dump($hoursPerWeek);
    $daysPerWeek = filter_input(INPUT_GET,'daysPerWeek',FILTER_VALIDATE_INT);
    #var_dump($daysPerWeek);
    $vacationPerYear = filter_input(INPUT_GET,'vacationPerYear',FILTER_VALIDATE_INT);
    #var_dump($vacationPerYear);
    $holidayPerYear = filter_input(INPUT_GET,'holidayPerYear',FILTER_VALIDATE_INT);
    #var_dump($holidayPerYear);

    // Error Checks
    if ($hourlySalary === false) {
        $error_message = "Hourly Salary should be a numeric value";
    }
    if ($hoursPerWeek === false) {
        $error_message = 'Hours Per Week should be a numeric value';
    }
    if ($daysPerWeek === false) {
        $error_message = 'Days Per Week should be a numeric value';
    }
    if ($vacationPerYear === false) {
        $error_message = 'Vacation Per year should be a numeric value';
    }
    if ($holidayPerYear === false) {
        $error_message = 'Holidays Per Year should be a numeric value';
    }

    // If an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit();
    }

    // Unadjusted & Dump
    $annualSalary = $hourlySalary * $hoursPerWeek * 52.0;
    #var_dump($annualSalary);
    $dailySalary = $annualSalary / 260;
    #var_dump($dailySalary);
    $daysWorkedPerYear = 260 - ($vacationPerYear + $holidayPerYear);
    #var_dump($daysWorkedPerYear);
    $hoursWorkedPerDay = $hoursPerWeek / $daysPerWeek;
    #var_dump($hoursWorkedPerDay);

    // Adjusted & Dump
    $adjAnnualSalary = $dailySalary * $daysWorkedPerYear;
    #var_dump($adjAnnualSalary);
    $adjDailySalary = $adjAnnualSalary / 260;
    #var_dump($adjDailySalary);
    $adjHourlySalary = $adjDailySalary / $hoursWorkedPerDay;
    #var_dump($adjHourlySalary);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salary Calculator</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <main>
            <article>
                <h1>Salary Calculator</h1>
                <label>UserID:</label>
                <span><?php echo htmlspecialchars($userId); ?></span><br>
                <label>Hourly Salary Amount:</label>
                <span><?php echo "$".number_format($hourlySalary, 2); ?></span><br>
                <label>Hours Per Week:</label>
                <span><?php echo number_format($hoursPerWeek, 2); ?></span><br>
                <label>Days Per Week:</label>
                <span><?php echo $daysPerWeek; ?></span><br>
                <label>Vacation Per Year:</label>
                <span><?php echo $vacationPerYear; ?></span><br>
                <label>Holidays Per Year:</label>
                <span><?php echo $holidayPerYear; ?></span><br>
            </article>
            <article>
                <table>
                    <tr>
                        <th>*****************</th>
                        <th>Unadjusted</th>
                        <th>Adjusted</th>
                    </tr>
                    <tr>
                        <td>Hourly:</td>
                        <td><?php echo "$".number_format($hourlySalary, 2); ?></td>
                        <td><?php echo "$".number_format($adjHourlySalary, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Daily:</td>
                        <td><?php echo "$".number_format($dailySalary, 2); ?></td>
                        <td><?php echo "$".number_format($adjDailySalary, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Annual:</td>
                        <td><?php echo "$".number_format($annualSalary, 2); ?></td>
                        <td><?php echo "$".number_format($annualSalary, 2); ?></td>
                    </tr>
            </article>
        </main>
    </body>
</html>