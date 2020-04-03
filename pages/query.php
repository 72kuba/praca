<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 12.03.20
 * Time: 21:03
 */

if (isset($_POST['submit']))
{
    $sth = $_POST['input_value'];

    $statement = $connection->query($sth);
    $statement->execute();
    $fields = $statement->fetchAll(PDO::FETCH_ASSOC);
    drawTable($fields);
}

?>

<h3><a href=/index.php?p=reports>back to reports list</a></h3>
<h3><a href=/index.php?p=main>back to main page</a></h3>
