<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 01.02.20
 * Time: 22:24
 */
// Initialize the session
session_start();

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
        return new PDO($dsn, $db_config['user'], $db_config['pass'], $options);
    } catch (\Exception $e) {
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
    // tutaj wrzucic z sesji dane do polaczenia
}