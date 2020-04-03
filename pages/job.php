<h2>current job state</h2>
<form action="#" method="post">
    <input type="submit" value="refresh">
</form>
<ul id=menu>
    <li><a href=/index.php?p=main>Main page</a>
    <li><a href=/index.php?p=reports>Reports page</a>
    <li><a href=/index.php?p=data_pump>Data Pump page</a>
</ul>
<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 23.03.20
 * Time: 20:36
 */

function query1($connection)
{
    $sth = 'SELECT b.username, a.sid, b.opname, b.target,round(b.SOFAR*100/b.TOTALWORK,0) || \'%\' as "%DONE", b.TIME_REMAINING,to_char(b.start_time,\'YYYY/MM/DD HH24:MI:SS\') start_time FROM v$session_longops b, v$session a WHERE a.sid = b.sid      ORDER BY 6';
    $statement = $connection->query($sth);
    $statement->execute();
    $fields = $statement->fetchAll(PDO::FETCH_ASSOC);
    drawTable($fields);
}
function query2($connection){
    $sth = 'select OWNER_NAME,JOB_NAME,OPERATION,JOB_MODE,STATE from dba_datapump_jobs';
    $statement = $connection->query($sth);
    $statement->execute();
    $fields = $statement->fetchAll(PDO::FETCH_ASSOC);
    drawTable($fields);
}
query1($connection);
echo "<br>";
query2($connection);

if(isset($_POST['submit'])) {
    query1($connection);
    query2($connection);
}