<?php
// Set Default values of variables for initial page load
if (!isset($userId)) {$userId = '';};
if (!isset($hourlySalary)) {$hourlySalary = '';};
if (!isset($hoursPerWeek)) {$hoursPerWeek = '';}
if (!isset($daysPerWeek)) {$daysPerWeek = '';}
if (!isset($vacationPerYear)) {$vacationPerYear = '';}
if (!isset($holidayPerYear)) {$holidayPerYear = '';}
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
            <?php if (!empty($error_message)) { ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
            <?php } ?>
            <form action="display_results.php" method="GET">
                <div id="data">
                    <label>UserID:</label>
                    <input type="text" name="userId" value="<?php echo htmlspecialchars($userId); ?>"><br>
                    <label>Salary Amount Per Hour:</label>
                    <input type="text" name="hourlySalary" value="<?php echo htmlspecialchars($hourlySalary); ?>"><br>
                    <label>Hours Per Week:</label>
                    <input type="text" name="hoursPerWeek" value="<?php echo htmlspecialchars($hoursPerWeek); ?>"><br>
                    <label>Days Per Week:</label>
                    <input type="text" name="daysPerWeek" value="<?php echo htmlspecialchars($daysPerWeek); ?>"><br>
                    <label>Vacation Per Year:</label>
                    <input type="text" name="vacationPerYear" value="<?php echo htmlspecialchars($vacationPerYear); ?>"><br>
                    <label>Holidays Per Year:</label>
                    <input type="text" name="holidayPerYear" value="<?php echo htmlspecialchars($holidayPerYear); ?>"><br>
                </div>
                <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" value="Calculate"><br>
                </div>
            </form>
        </main>
    </body>
</html>