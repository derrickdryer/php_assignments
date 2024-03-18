<?php
	// Start Session
	$status = session_status();
	if($status == PHP_SESSION_NONE) {
		session_start();
	}

    // Initilize Logins if empty
    if(empty($_SESSION['user_logins'])) {
        $_SESSION['user_logins'] = array();
        $_SESSION['user_logins']['admin'] = array("password" => "admin", "userType" => "admin");
        $_SESSION['user_logins']['employee1'] = array("password" => "employee1", "userType" => "employee");
        $_SESSION['user_logins']['employee2'] = array("password" => "employee2", "userType" => "employee");
        $_SESSION['user_logins']['employee3'] = array("password" => "employee3", "userType" => "employee");
        $_SESSION['user_logins']['client1'] = array("password" => "client1", "userType" => "client");
        $_SESSION['user_logins']['client2'] = array("password" => "client2", "userType" => "client");
        $_SESSION['user_logins']['client3'] = array("password" => "client3", "userType" => "client");
    }

	// Initilize error message
	$error_message = '';

	// Validate user login & put in session[user]
	$loggedUser = filter_input(INPUT_GET, 'userId');
	$loggedType = $_SESSION['user_logins'][$loggedUser]['userType'];
	$loggedPass = $_SESSION['user_logins'][$loggedUser]['password'];
	# Active user session
	$_SESSION['user'] = array('userId' => $loggedUser, 'password' => $loggedPass, 'userType' => $loggedType);


	#var_dump($_SESSION['user_logins']);
	var_dump($_SESSION['user']);
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Employee Portal</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>

	<body>
		<main>
			<div id="data">
				<h1>Welcome to the employee portal. You are logged in.</h1>
				<form action = "user_display.php" method="get">
					<input type="submit" name="display" value="Get More Info">
				</form>
			</div>
		</main>
	</body>
</html>