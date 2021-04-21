<?php
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
   // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

*/
// DB credentials.

// PDO stands for PHP Data object..it is an object oriented based programming concept in PHP
define('DB_HOST','localhost'); // Host name
define('DB_USER','root'); // db user name
define('DB_PASS',''); // db user password name
define('DB_NAME','hospital'); // db name
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>


