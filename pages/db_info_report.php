<h2> Database information report</h2>

<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 12.03.20
 * Time: 19:39
 */

function query1($connection)
{
    $sth = 'SELECT NAME,DB_UNIQUE_NAME,DBID,RESETLOGS_TIME,LOG_MODE,OPEN_MODE,DATABASE_ROLE,FLASHBACK_ON FROM v$database';
    $statement = $connection->query($sth);
    $statement->execute();
    $fields = $statement->fetchAll(PDO::FETCH_ASSOC);
    drawTable($fields);
}
function query2($connection)
{
    $sth = 'select INSTANCE_NAME,HOST_NAME,VERSION,STARTUP_TIME,STATUS,DATABASE_STATUS,INSTANCE_ROLE from v$instance';
    $statement = $connection->query($sth);
    $statement->execute();
    $fields = $statement->fetchAll(PDO::FETCH_ASSOC);
    drawTable($fields);
}
function query3($connection)
{
    $sth = 'select * from v$version';
    $statement = $connection->query($sth);
    $statement->execute();
    $fields = $statement->fetchAll(PDO::FETCH_ASSOC);
    drawTable($fields);
}
function query4($connection)
{
    $sth = 'SELECT Substr(d.name,1,60) "Datafile",NVL(d.status,\'UNKNOWN\') "Status",d.enabled "Enabled",LPad(To_Char(Round(d.bytes/1024000,2),\'9999990.00\'),10,\' \') "Size(M)" FROM v$datafile d ORDER BY 1';
    $statement = $connection->query($sth);
    $statement->execute();
    $fields = $statement->fetchAll(PDO::FETCH_ASSOC);
    drawTable($fields);
}
function query5($connection)
{
    $sth = 'SELECT l.group# "Group",Substr(l.member,1,60) "Logfile",NVL(l.status,\'UNKNOWN\') "Status" FROM   v$logfile l ORDER BY 1,2';
    $statement = $connection->query($sth);
    $statement->execute();
    $fields = $statement->fetchAll(PDO::FETCH_ASSOC);
    drawTable($fields);
}
query1($connection); echo "<br>";echo "<br>";
query2($connection); echo "<br>";echo "<br>";
query3($connection); echo "<br>";echo "<br>";
query4($connection); echo "<br>";echo "<br>";
query5($connection); echo "<br>";echo "<br>";
?>

<h3><a href=/index.php?p=reports>back to reports list</a></h3>
<h3><a href=/index.php?p=main>back to main page</a></h3>