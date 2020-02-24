<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 01.02.20
 * Time: 22:24
 */



$db_config = array(
    'host' => $_POST['host'],
    'port' => $_POST['port'],
    'user' => $_POST['username'],
    'pass' => $_POST['password'],
    'db' => $_POST['sid'],
    'db_type' => 'oci',
    'encoding' => 'utf-8'
);

try
{
    $dsn = $db_config['db_type'] .
        ':host=' . $db_config['host'] .
        ';port=' . $db_config['port'] .
        ';encoding=' . $db_config['encoding'] .
        ';dbname=' . $db_config['db'];

    // opcje, tutaj ustawienie trybu reagowania na błędy
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    // tworzymy obiekt klasy PDO inicjując tym samym połączenie
    $dbh = new PDO($dsn, $db_config['user'],  $db_config['pass'], $options);
    // w przypadku błędu, poniższe się już nie wykona:
    define('DB_CONNECTED', true);
    echo '<h1>Connection success!</h1>';
    // łapiemy ewentualny wyjątek:
} catch(PDOException $e)
{
    die('Unable to connect: ' . $e->getMessage());
}
?>
<html lang="en">
<a href="reports.php">Reports Page</a>
<a href="datapump.php">Data Pump Page</a>
</html>

