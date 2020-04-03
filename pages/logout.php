<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 30.03.20
 * Time: 18:57
 */
session_start();
session_destroy();
header('location: /index.php?p=login');
exit;