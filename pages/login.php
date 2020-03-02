<?php
if(isset($_POST['submit'])) {
    // 3 linie ponizej to debug $_POSTa
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    $connection = connect($_POST['host'], $_POST['port'], $_POST['username'], $_POST['password'], $_POST['sid'], 'oci', 'utf-8');
    if ($connection === null) {
        die('zle dane polaczenia');

    } else {
        $_SESSION['loggedin'] = true;
        $_SESSION['host'] = $_POST['host'];
        $_SESSION['port'] = $_POST['port'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['sid'] = $_POST['sid'];
        $_SESSION['db_type'] = 'oci';
        $_SESSION['encoding'] = 'utf-8';
        header('location: /index.php?p=main');
        exit;
    }
}




?>

<h2>Login</h2>
<p>Please fill in your database information to login</p>
<form action="/index.php?p=login" method="post">
    <div class="form-group <?php echo isset($username_err) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input type="text" name="username" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group <?php echo (!isset($password_err)) ? 'has-error' : ''; ?>">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Host</label>
        <input type="text" name="host" class="form-control">
    </div>
    <div class="form-group">
        <label>Port</label>
        <input type="text" name="port" class="form-control">
        <div>
            <label>SID</label>
            <input type="text" name="sid" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="Login">
    </div>

</form>
