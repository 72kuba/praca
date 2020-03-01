<?php
if(isset($_POST['submit'])) {
    // 3 linie ponizej to debug $_POSTa
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

//    $connection = connect() // tutaj dane z POST - jesli nie jest NULL to polaczenie sie udalo i przekieruj gdzie trzeba
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
