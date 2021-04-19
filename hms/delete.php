 
<?php
//including the database connection file
include("adminconn.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$sql = "DELETE FROM patients WHERE id=:id";
$query = $dbh->prepare($sql);
$query->execute(array(':id' => $id));
 
 
header("Location:Allrecord.php");
?>