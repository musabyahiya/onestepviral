
<?php

session_start();
$databaseHost = 'localhost';
$databaseName = 'wwwonest_onestepviral';
$databaseUsername = 'wwwonest_root';
$databasePassword = 'musabyahiya1';
 
try {
    // http://php.net/manual/en/pdo.connections.php
    $con = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", $databaseUsername, $databasePassword);
    
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
    // More on setAttribute: http://php.net/manual/en/pdo.setattribute.php
    //for error showing
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} catch(PDOException $e) 
{
    echo $e->getMessage();
}
 
?>