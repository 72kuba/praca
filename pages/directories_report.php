<h2>Directories report</h2>

<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 12.03.20
 * Time: 19:48
 */

//$sth = file_get_contents("./scripts/active_sessions.sql");
$sth='select * from all_directories';
$statement = $connection->query($sth);
$statement->execute();
$fields=$statement->fetchAll(PDO::FETCH_ASSOC);
drawTable($fields);

?>

<h3><a href=/index.php?p=reports>back to reports list</a></h3>
<h3><a href=/index.php?p=main>back to main page</a></h3>