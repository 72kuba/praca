<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 01.02.20
 * Time: 22:24
 */
// Initialize the session
session_start();



try {
//Te wartosci ponizej w tym arrayu se podmien ( tam nie potrzebnie byl ten post);
    //sprawdzić czy wartości sa w sesji - poszukać o co kaman $_SESSION
    // session_start() w configu. przekierowanie na strone logowania jesli nie zalogowany
    //action wysyła do: login/p=login (strona login)
    //jeśli sie uda połączyć do zapisać do sesji

    $_SESSION = array(
        'loggedin' => true,
        'host' => $_POST['host'],
        'port' => $_POST['port'],
        'user' => $_POST['username'],
        'pass' => $_POST['password'],
        'db' => $_POST['sid'],
        'db_type' => 'oci',
        'encoding' => 'utf-8'
    );

    $db_config = array(
        'host' => $_SESSION['host'],
        'port' => $_SESSION['port'],
        'user' => $_SESSION['username'],
        'pass' => $_SESSION['password'],
        'db' => $_SESSION['sid'],
        'db_type' => $_SESSION['db_type'],
        'encoding' => $_SESSION['encoding']
    );

    $dsn = $db_config['db_type'].
        ':host='.$db_config['host'].
        ';port='.$db_config['port'].
        ';encoding='.$db_config['encoding'].
        ';dbname='.$db_config['db'];

    // opcje, tutaj ustawienie trybu reagowania na błędy
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    // tworzymy obiekt klasy PDO inicjując tym samym połączenie
    $dbh = new PDO($dsn, $db_config['user'], $db_config['pass'], $options);

    // w przypadku błędu, poniższe się już nie wykona:
    define('DB_CONNECTED', true);
   // echo '<h1>Connection success!</h1>';
    // łapiemy ewentualny wyjątek:
} catch (PDOException $e) {
//    die('Unable to connect: '.$e->getMessage());
}
// Check if the user is already logged in, if yes then redirect him to index page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
}
else {
    header("location: ./pages/login.php");
}
exit;

?>