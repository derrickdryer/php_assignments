<!DOCTYPE html>
<html>
    <head>
        <title>Salary Calculator</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <main>
            <h1>Salary Calculator</h1>
            <form action="display_results.php" method="GET">
                <div id="data">
                    <label>UserID:</label>
                    <input type="text" name="userId"><br>
                    <label>Salary Amount Per Hour:</label>
                    <input type="text" name="hourlySalary"><br>
                    <label>Hours Per Week:</label>
                    <input type="text" name="hoursPerWeek"><br>
                    <label>Days Per Week:</label>
                    <input type="text" name="daysPerWeek"><br>
                    <label>Vacation Per Year:</label>
                    <input type="text" name="vacationPerYear"><br>
                    <label>Holidays Per Year:</label>
                    <input type="text" name="holidayPerYear"><br>
                </div>
                <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" value="Calculate"><br>
                </div>
            </form>
        </main>
    </body>
</html>