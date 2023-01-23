<?php
$databaseHost = 'localhost:3307'; //  => localhost at school laptop 
$databaseName = 'mapdb';  // test at school laptop 
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if (!$mysqli) {
    echo "connection failed. ";
    exit;
}
?>