<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 17.02.20
 * Time: 16:47
 */
$connection = connect($_POST['host'], $_POST['port'], $_POST['username'], $_POST['password'], $_POST['sid'], 'oci', 'utf-8');

function dbinfo($connection) {

    $stmt = $connection->prepare('select instance_name from v$instance');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    while($row=oci_fetch_array($results)){
        echo "<br>";
        echo "database name: ".$row['NAME'];
    }

    while(($row=oci_fetch_array($results,OCI_BOTH))!=false) {
        echo $row[0];
    }
}

function execute_db_info($connection){
    $query = file_get_contents("./../scripts/db_info.sql");
    $stmt = $connection->prepare($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    while(($row=oci_fetch_array($results,OCI_BOTH))!=false) {
        echo $row[0];
    }
}


if($_GET){
    if(isset($_GET['execute_db_info'])){
        execute_db_info($connection);
    }elseif(isset($_GET['execute_free_space'])){
        execute_free_space($db_config);
    }elseif(isset($_GET['execute_active_sessions'])){
        execute_active_sessions($db_config);
    }elseif(isset($_GET['execute_directories'])){
        execute_directories($db_config);
    }

}

?>




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
