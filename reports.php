<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 17.02.20
 * Time: 16:47
 */


function dbinfo() {
    $db_config = array(
        'host' => '172.21.0.2',
        'port' => '1521',
        'user' => 'jakub',
        'pass' => 'heyah27035',
        'db' => 'DB11G',
        'db_type' => 'oci',
        'encoding' => 'utf-8'
    );
    $dsn = $db_config['db_type'] .
        ':host=' . $db_config['host'] .
        ';port=' . $db_config['port'] .
        ';encoding=' . $db_config['encoding'] .
        ';dbname=' . $db_config['db'];

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    $dbh = oci_connect($db_config['user'],  $db_config['pass'], $db_config['host'].'/'.$db_config['db'] );

    $sql = 'select instance_name from v$instance';

    $statement=oci_parse($dbh, $sql);
    oci_execute($statement);
//    echo "<p>query: $sql</p>";

    while($row=oci_fetch_array($statement)){
        echo $row['NAME'].
            "<br>";
    }

    $stid=oci_parse($dbh,$sql);
    oci_execute($stid);

    while(($row=oci_fetch_array($stid,OCI_BOTH))!=false) {
        echo $row[0];
    }
}

?>

<html lang="en">
<h1>Welcome to report page!</h1>
    <p>your database information: <?php dbinfo(); ?></p>
</html>