<div class="jumbotron text-left">
<h2>Use below options to setup your export job</h2>
</div>

<div class="row">
    <div class="column">
        <form action="#" method="POST">
            <div class="form-group">
            <label>specify job name</label><br>
            <input type="text" class="form-control" name="input_value" required pattern="[a-zA-Z-]+" title="use letters only"><br>
            <label>specify name for dumpfile</label><br>
            <input type="text" class="form-control" name="filename" required pattern="[a-zA-Z0-9-]+" title="letters and numbers only"><br>
            <label>specify directory - use list for help:</label><br>
            <input type="text" class="form-control" name="directory" required pattern="[^\s]+"><br>
            <label>specify parallel parameter (default: 1)</label><br>
            <input type="text" class="form-control" name="parallel" pattern="[1-6]{1}" title="one digit from 1 to 6"><br><br>
            <input type="submit" class="btn btn-secondary" name="submit" value="set options and start export"  style="font-size: 14px;" />
            </div>
        </form>
    </div>
    <div class="column">
        <?php
        $sth='select directory_name, directory_path from all_directories';
        $statement = $connection->query($sth);
        $statement->execute();
        $fields=$statement->fetchAll(PDO::FETCH_ASSOC);
        drawTable($fields);
        ?>
    </div>
    <br>
    <br>
    <br>
</div>

<h3><a href=/index.php?p=data_pump>Back to data pump page</a></h3>


<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 23.03.20
 * Time: 17:04
 */

$job_name = $filename = $directory  = '';
$parallel = 1;
$version = 'COMPATIBLE';
$job_name = $_POST['input_value'];

try {
    if (isset($_POST['submit'])) {
        $job_name = $_POST['input_value'];
        $filename = $_POST['filename'];
        $directory = $_POST['directory'];
        if (isset($_POST['parallel'])) {
            $parallel = $_POST['parallel'];
        }
       // $filter = $_POST['schema'];
        //   $filetype ='KU$_FILE_TYPE_LOG_FILE';

        $sth = <<<FIN
DECLARE
  ind NUMBER;              
  h1 NUMBER;               
BEGIN
h1 := DBMS_DATAPUMP.OPEN('EXPORT','FULL',NULL,'$job_name','$version');
DBMS_DATAPUMP.ADD_FILE(h1,'$filename.%u','$directory');
DBMS_DATAPUMP.SET_PARALLEL(h1,$parallel);
DBMS_DATAPUMP.START_JOB(h1);
END;
FIN;

        $statement = $connection->query($sth);
        $statement->execute();
        header('location: /index.php?p=job');
    }
}
catch(Exception $e){
    header('location: /index.php?p=job');
}

