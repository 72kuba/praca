<?php
ob_start();
require_once 'config.php'; //include configa dla wszystkich pdostorn 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Oracle Web Kit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }
        #menu {
            position: fixed;
            right: 0;
            top: 90%;
            width: 8em;
            margin-top: -2.5em;
            margin-right: 5em;
            padding: 0;
        }
        li:last-child {
            border: none;
        }

        li a {
            text-decoration: none;
            color: #000;
            display: block;
            width: 200px;

            -webkit-transition: font-size 0.3s ease, background-color 0.3s ease;
            -moz-transition: font-size 0.3s ease, background-color 0.3s ease;
            -o-transition: font-size 0.3s ease, background-color 0.3s ease;
            -ms-transition: font-size 0.3s ease, background-color 0.3s ease;
            transition: font-size 0.3s ease, background-color 0.3s ease;
        }

        li a:hover {
            font-size: 30px;
            background: #f6f6f6;
        }
        #top {
            font-size: 30px;
            border-bottom: 4px double;
            background-color: #F0F0F0;
            padding-left: 25px;
            padding-bottom: 5px;
        }
        .column {
            float: left;
            column-gap: 40px;
            padding: 40px;
        }
        .right {
            text-align: right;
            float: right;
            padding-right: 45px;
        }
    </style>
    <div id="top">Oracle DB web kit
        <div class="right"> <a class="btn btn-secondary" style="font-size: 18px"; href=/index.php?p=logout>Logout</a></div>
    </div>

</head>
<body>
<div class="col-lg-12">

    <?php
        $p = $_GET['p'] ?? 'main';
        $path = __DIR__.'/pages/'.$p.'.php';
        if (file_exists($path)) {
            require $path;
        }
        else{
            die('not found: '.$path);
        }
    ?>
</div>
</body>
</html>

<?php ob_end_flush();
