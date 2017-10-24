<?php

$db = include_once '../config/db.php';

$dbNameStrArr = explode('=', $db['dsn']);

$database = end($dbNameStrArr);

$conString = explode(';', $db['dsn']);
$database = end($conString);
$hostString = explode('=', $conString['0']);
$db1 = explode('=', $database);
//=========== host name
$dbHostName = end($hostString);
//=========== database name
$dbName = end($db1);
//=========== database username
$dbUser = $db['username'];
//=========== database password
$dbPass = $db['password'];
//=========== connections =================
define("host", "$dbHostName");
define("db_user", "$dbUser");
define("db_password", "$dbPass");
define("db_name", "$dbName");
$con = mysqli_connect(host, db_user, db_password, db_name);
?>