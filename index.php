<?php
ob_start();
require_once 'config.php'; //include configa dla wszystkich pdostorn 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php
        $p = $_GET['p'] ?? 'main';
        $path = __DIR__.'/pages/'.$p.'.php';
        if (file_exists($path)) {
            require $path;
        }
        else{
            die('Nima pliku: '.$path);
        }
    ?>
</div>
</body>
</html>

<?php ob_end_flush();
