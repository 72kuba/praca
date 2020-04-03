<?php
if(isset($_POST['submit'])) {
    // 3 linie ponizej to debug $_POSTa
    //echo '<pre>';
    //var_dump($_POST);
   // echo '</pre>';

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $host = validate($_POST['host']);
    $port = validate($_POST['port']);
    $sid = validate($_POST['sid']);

    $connection = connect($host, $port, $username, $password, $sid, 'oci', 'utf-8');
    if ($connection === null) {
        die('invalid information');

    } else {
        $_SESSION['loggedin'] = true;
        $_SESSION['host'] = $host;
        $_SESSION['port'] = $host;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['sid'] = $sid;
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
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required placeholder="enter schema name" pattern="^[a-zA-Z]+$" title="provide proper schema name - must start with letter">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Host</label>
        <input type="text" name="host" class="form-control" required placeholder="known hostname or ip address"  pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$|[a-zA-Z0-9-]+" title="known hostname or IP address">
    </div>
    <div class="form-group">
        <label>Port</label>
        <input type="text" name="port" class="form-control" required placeholder="listener port e.g. 1521" pattern="[0-9]+" title="numbers only">
        <div>
            <label>SID</label>
            <input type="text" name="sid" class="form-control" required placeholder="database name">
        </div>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="Login" required>
    </div>

</form>
