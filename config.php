<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 01.02.20
 * Time: 22:24
 */
// Initialize the session
session_start();
function validate($str) {
    return trim(htmlspecialchars($str));
}
function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

function drawTable(array $rows){

    echo '<table class="table table-bordered">';

    if(empty($rows)){
        echo '<tr><td colspan=5>no rows selected</td></tr>';
    }
    else{
        $headers = array_keys($rows[0]);
        echo '<tr>';
        foreach ($headers as $key => $value) {
            echo '<td>'.$value.'</td>';
        }
        echo '</tr>';

        foreach ($rows as $key => $row) {
            echo '<tr>';
            foreach ($headers as $h) {
                echo '<td>'.$row[$h].'</td>';
            }
            echo '</tr>';
        }
    }


    echo '</table>';
}

function connect($host, $port, $username, $password, $sid, $dbType, $encoding)
{
    try {
        $db_config = array(
            'host' => $host,
            'port' => $port,
            'user' => $username,
            'pass' => $password,
            'db' => $sid,
            'db_type' => $dbType,
            'encoding' => $encoding,
        );

        $dsn = $db_config['db_type'].
            ':host='.$db_config['host'].
            ';port='.$db_config['port'].
            ';encoding='.$db_config['encoding'].
            ';dbname='.$db_config['db'];

        // opcje, tutaj ustawienie trybu reagowania na błędy
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        // tworzymy obiekt klasy PDO inicjując tym samym połączenie
        //return new PDO("oci:dbname=".$tns, $db_config['user'], $db_config['pass'], $options);
        return new PDO($dsn, $db_config['user'], $db_config['pass'], $options);
    } catch (Exception $e) {
        return null;
    }
}


if (!isset($_SESSION['loggedin'])) {
    if ($_GET['p'] !== 'login') {
        header('location: /index.php?p=login');
        exit;
    }
}
else{

    $connection = connect($_SESSION['host'], $_SESSION['port'], $_SESSION['username'], $_SESSION['password'], $_SESSION['sid'], 'oci', 'utf-8');


}