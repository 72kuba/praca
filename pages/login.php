<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 01.02.20
 * Time: 22:15
 */


$username = $password = $hostname = $port = $sid = "";
$username_err = $password_err = "";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your database information to login</p>
    <form action="./../config.php" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Host</label>
            <input type="text" name="host" class="form-control" value="<?php echo $hostname; ?>">
        </div>
        <div class="form-group">
            <label>Port</label>
            <input type="text" name="port" class="form-control" value="<?php echo $port; ?>">
            <div>
                <label>SID</label>
                <input type="text" name="sid" class="form-control" value="<?php echo $sid; ?>">
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>

    </form>
</div>
</body>
</html>

