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

    // Dump vars
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
            <h1>Employee Portal</h1>
            <h3>User & User Types</h3></br>
            <!-- Display if admin -->
            <?php if ($_SESSION['user']['userType'] == "admin") : ?>
            <h3>Here are all the employee userIds and their user types</h3>
            <ul>
                <?php foreach($_SESSION['user_logins'] as $user => $attribute) : ?>
                    <li><?php echo $user . '--' . $attribute['userType']; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <!-- Display if employee -->
            <?php if ($_SESSION['user']['userType'] == "employee") : ?>
            <h3>Here are all the employee userIds and their user types</h3>
            <ul>
                <?php foreach($_SESSION['user_logins'] as $user => $attribute) : ?>
                    <?php if($attribute['userType'] == "client") : ?>
                        <li><?php echo $user . '--' . $attribute['userType']; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <!-- Display if client -->
            <?php if ($_SESSION['user']['userType'] == "client") : ?>
            <h3>Please contact your admin: admin@contact.com</h3>
            <?php endif; ?>
        </main>
    </body>
</html>