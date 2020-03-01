<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 17.02.20
 * Time: 16:47
 */
include 'config.php';

function dbinfo($db_config) {
/*    $db_config = array(
        'host' => '172.21.0.2',
        'port' => '1521',
        'user' => 'jakub',
        'pass' => 'heyah27035',
        'db' => 'DB11G',
        'db_type' => 'oci',
        'encoding' => 'utf-8'
    );
*/
   /* $dsn = $db_config['db_type'] .
        ':host=' . $db_config['host'] .
        ';port=' . $db_config['port'] .
        ';encoding=' . $db_config['encoding'] .
        ';dbname=' . $db_config['db'];
    */

    $dbh = oci_connect($db_config['user'],  $db_config['pass'], $db_config['host'].'/'.$db_config['db'] );

    $sql = 'select instance_name from v$instance';

    $statement=oci_parse($dbh, $sql);
    oci_execute($statement);

    while($row=oci_fetch_array($statement)){
        echo "<br>";
        echo "database name: ".$row['NAME'];
    }

    $stid=oci_parse($dbh,$sql);
    oci_execute($stid);

    while(($row=oci_fetch_array($stid,OCI_BOTH))!=false) {
        echo $row[0];
    }
}

function execute_db_info($dbh){
    $query = file_get_contents("./../scripts/db_info.sql");
    $statement=oci_parse($dbh,$query);
    oci_execute($statement);
    while(($row=oci_fetch_array($statement,OCI_BOTH))!=false) {
        echo $row[0];
    }
}
function execute_free_space($dbh){
    $query = file_get_contents("./../scripts/free_space.sql");
    $statement=oci_parse($dbh,$query);
    oci_execute($statement);
    while(($row=oci_fetch_array($statement,OCI_BOTH))!=false) {
        echo $row[0];
    }
}

if($_GET){
    if(isset($_GET['execute_db_info'])){
        execute_db_info($dbh);
    }elseif(isset($_GET['execute_free_space'])){
        execute_free_space($dbh);
    }elseif(isset($_GET['execute_active_sessions'])){
        execute_active_sessions($dbh);
    }elseif(isset($_GET['execute_directories'])){
        execute_directories($dbh);
    }

}

?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        /* Style the buttons */
        .btn {
            border: none;
            outline: none;
            padding: 12px 16px;
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #ddd;
        }

        .btn.active {
            background-color: #666;
            color: white;
        }
    </style>
</head>
<body>

<h2>Welcome to reports page!</h2>

<p>list of predefined scripts: </p>

<div id="btnContainer">
    <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button>
    <button class="btn active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
</div>
<br>

<div class="row">
    <div class="column" style="background-color:#aaa;">
        <h2>@db_info</h2>
        <p>Displays general information about the database. <br>
        Requires access to V$ views
        </p>
        <input type="submit" class="button" name="execute_db_info" value="execute">
    </div>
    <div class="column" style="background-color:#bbb;">
        <h2>@free_space</h2>
        <p>Displays space usage for each datafile. <br>
        Requires access to DBA_ views
        </p>
        <input type="submit" class="button" name="execute_free_space" value="execute">
    </div>
</div>

<div class="row">
    <div class="column" style="background-color:#ccc;">
        <h2>@active_sessions.sql</h2>
        <p>Displays information on all active database sessions. <br>
            Requires access to V$ views
        </p>
        <input type="submit" class="button" name="execute_active_sessions" value="execute">
    </div>
    <div class="column" style="background-color:#ddd;">
        <h2>@directories</h2>
        <p>Displays information about all directories.<br>
            Requires access to DBA_ views
        </p>
        <input type="submit" class="button" name="execute_directories" value="execute">
    </div>
</div>

<script>
    // Get the elements with class="column"
    var elements = document.getElementsByClassName("column");

    // Declare a loop variable
    var i;

    // List View
    function listView() {
        for (i = 0; i < elements.length; i++) {
            elements[i].style.width = "100%";
        }
    }

    // Grid View
    function gridView() {
        for (i = 0; i < elements.length; i++) {
            elements[i].style.width = "50%";
        }
    }

    /* Optional: Add active class to the current button (highlight it) */
    var container = document.getElementById("btnContainer");
    var btns = container.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>

</body>
</html>