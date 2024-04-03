<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Product Manager</h1></header>

    <main>
        <h1>Add Customer</h1>
        <form action="addCustomer.php" method="post"
              id="add_customer_form">

            
            <label>First Name:</label>
            <input type="text" name="fName"><br>

            <label>Last Name:</label>
            <input type="text" name="lName"><br>

            <label>Email:</label>
            <input type="text" name="email"><br>
			
			<label>Password:</label>
			<input type="text" name="password"><br>
			
			<label> Address Line1:</label>
            <input type="text" name="line1"><br>
			
			<label>Address Line2:</label>
            <input type="text" name="line2"><br>
			
			<label>City:</label>
            <input type="text" name="city"><br>
			
			<label>State:</label>
            <input type="text" name="state"><br>
			
			<label>Zipcode:</label>
            <input type="text" name="zipcode"><br>
			
			<label>Phone:</label>
            <input type="text" name="phone"><br>
			
			<label>Disabled</label>
            <select name="disabled">
            <option value="0">"Not Disabled </option>
			<option value="1">"Disabled </option>
            </select><br>

			
			<label>&nbsp;</label>
            <input type="submit" value="Add Customer"><br>
        </form>
        <p><a href="index.php">View Customer List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>