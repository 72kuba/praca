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
               <label>specify schema name - use list for help:</label><br>
               <input type="text" class="form-control" name="schema" required pattern="^[a-zA-Z]+$" title="schema name starts with letter"><br><br>
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
        <div class="column">
            <?php
            $sth='select username as SCHEMA from all_users where username not in (\'SYS\',\'SYSTEM\')';
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

$job_name = $filename = $directory = $filter = '';
$version = 'COMPATIBLE';
$job_name = $_POST['input_value'];

try {
    if (isset($_POST['submit'])) {
        $job_name = $_POST['input_value'];
        $filename = $_POST['filename'];
        $directory = $_POST['directory'];
        $filter = $_POST['schema'];
       // $filetype ='DBMS_DATAPUMP.ku$_file_type_log_file';

        $dump_type = 'dbms_datapump.ku$_file_type_dump_file';
        $log_type = 'dbms_datapump.ku$_file_type_log_file';

/*        $sth = <<<FIN
DECLARE
  h1 NUMBER;               
BEGIN
h1 := DBMS_DATAPUMP.OPEN('EXPORT','SCHEMA',NULL,'$job_name','$version');
DBMS_DATAPUMP.ADD_FILE(h1,'$filename','$directory');
DBMS_DATAPUMP.METADATA_FILTER(h1,'SCHEMA_EXPR','IN (''$filter'')');
DBMS_DATAPUMP.START_JOB(h1);
END;
FIN;
*/
    $sth = <<<FIN
declare
h1   NUMBER;
begin
h1 := dbms_datapump.open(operation => 'EXPORT', job_mode => 'SCHEMA',job_name => '$job_name'); 
dbms_datapump.add_file(handle => h1, filename => '$filename',directory => '$directory', filetype => $dump_type); 
dbms_datapump.add_file(handle => h1, filename => '$filename',directory => '$directory', filetype => $log_type);
dbms_datapump.metadata_filter(handle => h1, name => 'SCHEMA_LIST', value => '''$filter''');
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

