<?php
 
$databaseHost = 'localhost';
$databaseName = 'hospital';
$databaseUsername = 'root';
$databasePassword = '';
 
try {
 
    $dbh = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", $databaseUsername, $databasePassword);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
  
} catch(PDOException $e) {
    echo $e->getMessage();
}
 
?>