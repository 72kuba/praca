<div class="jumbotron text-left">
<h2>Use below options to setup your import job</h2>
</div>

<div class="row">
    <div class="column">
        <form id="remap_action" action="/index.php?p=schema_imp" method="GET">
            <div class="form-check">
            <label class="form-check-label">Do you require to remap tablespace?</label><br>
            <input type ="checkbox" class="form-check-input" id="remap" name="remap" value="remap" onchange="valueChanged()">
            <br><br><br>
            </div>
        </form>

        <form action="#" method="POST">
            <div class="form-group">
            <label>specify job name</label><br>
            <input type="text" class="form-control" name="input_value" required><br>
            <label>specify name for dumpfile</label><br>
            <input type="text" class="form-control" name="filename" required><br>
            <label>specify directory - use list for help:</label><br>
            <input type="text" class="form-control" name="directory" required><br>
            <div id="second" parent="none">
                <label>provide old tablespace name</label><br>
                <input type="text" class="form-control" name="tbs"><br>
                <label>provide new tablespace name</label><br>
                <input type="text" class="form-control" name="new_tbs"><br>
            </div>
            <label>specify TABLE_EXISTS_ACTION parameter</label><br>
            <input type="radio" id="replace" name="exist_action" value="REPLACE">
            <label for="male">replace</label><br>
            <input type="radio" id="append" name="exist_action" value="APPEND">
            <label for="male">append</label><br>
            <input type="radio" id="skip" name="exist_action" value="SKIP">
            <label for="skip">skip</label><br>
            <input type="radio" id="truncate" name="exist_action" value="TRUNCATE">
            <label for="male">truncate</label><br>
                <br>
            <input type="submit" class="btn btn-secondary" name="submit" value="set options and start export" style="font-size: 14px;"/>
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
    <div id="third" class="column">
        <?php
        $sth='select tablespace_name from dba_tablespaces';
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
<script>
    document.getElementById("second").style.visibility = "hidden";


    function valueChanged() {
        if (document.getElementById('remap').checked) {
            document.getElementById("second").style.visibility = "visible";
        }else{
            document.getElementById("second").style.visibility = "hidden";
        }
    }
</script>

<h3><a href=/index.php?p=data_pump>Back to data pump page</a></h3>


<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 23.03.20
 * Time: 17:04
 */

$job_name = $filename = $directory  = $filter = $new_schema = $tbs = '';
$version = 'COMPATIBLE';
$job_name = $_POST['input_value'];

$dump_type = 'dbms_datapump.ku$_file_type_dump_file';
$log_type = 'dbms_datapump.ku$_file_type_log_file';

try {
    if (isset($_POST['submit'])) {
        $job_name = $_POST['input_value'];
        $filename = $_POST['filename'];
        $directory = $_POST['directory'];
        $filter = $_POST['exist_action'];
        $tbs = $_POST['tbs'];
        $new_tbs = $_POST['new_tbs'];

        if(empty($_POST['new_tbs'])){
            $remap_line ='';
        }else $remap_line ="dbms_datapump.metadata_remap(handle => h1, name => 'REMAP_TABLESPACE', old_value => '$tbs', value => '$new_tbs');";


        /*       $sth = <<<FIN
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
       */
        $sth = <<< FIN
declare
h1   NUMBER;
begin
h1 := dbms_datapump.open(operation => 'IMPORT', job_mode => 'TABLESPACE',job_name => '$job_name');
dbms_datapump.add_file(handle => h1, filename => '$filename',directory => '$directory');
dbms_datapump.add_file(handle => h1, filename => '$filename',directory => '$directory', filetype => $log_type);
$remap_line
dbms_datapump.SET_PARAMETER(handle => h1, name => 'TABLE_EXISTS_ACTION', value => '$filter');
dbms_datapump.start_job(handle => h1); 
dbms_datapump.detach(handle => h1); 
end;
FIN;
         $statement = $connection->query($sth);
         $statement->execute();
         header('location: /index.php?p=job');
    }
}
catch(Exception $e){
    header('location: /index.php?p=job');
}

