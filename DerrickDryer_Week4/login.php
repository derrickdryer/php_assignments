<?php
    // Start Session
    $status = session_status();
    if($status == PHP_SESSION_NONE) {
        session_start();
    }

    // Use to fix session if needed.
    #$_SESSION['user_logins'] = array();

    // Initialize Logins if empty
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

    // Initialize Error Message
    $error_message = "";

    // Filter Action
    $action = filter_input(INPUT_GET, "action");

    // Login Validation
    if($action == "login") {
        $userId = filter_input(INPUT_GET, "userId");
        $userPass = filter_input(INPUT_GET, "userPass");

        if(array_key_exists($userId, $_SESSION['user_logins'])) {
            if($userPass == $_SESSION['user_logins'][$userId]['password']) {
                include("display_login.php");
                exit();
            } else {
                $error_message = "Incorrect password";

                // Check vars
                var_dump($userId);
                var_dump($userPass);
            }
        } else {
            // Display error on incorrect user/pass
            $error_message = "Incorrect username/password.";
            
            // Check vars
            var_dump($userId);
            var_dump($userPass);
        }
    }

    // Check array
    var_dump($_SESSION['user_logins']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log In To Employee Salary Portal</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
    <h3><?php echo $error_message; ?></h3>
    <h1>Login</h1>
        <div id="data">
            <form action="login.php" method="get">
                <table>
                    <tr>
                        <td>
                            <label>UserID:</label>
                        </td>
                        <td>
                            <input type="text" name="userId" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Password:</label>
                        </td>
                        <td>
                            <input type="password" name="userPass" value="">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="action" value="login">
                </table>
            </form>
        </div>
	</main>
</body>
</html>