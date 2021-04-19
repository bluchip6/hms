<?php
session_start();

//Database Configuration File
include('connectt.php');


// creating object of the Connection class
$database = new Connection();
$db = $database->open();
$table = 'patients';

//error_reporting(0);
if (isset($_POST['login'])) {
	// Get email and password from the form
	$email = strip_tags($_POST['email']);
	$password = strip_tags($_POST['password']);

	// Fetch user data from database table using email and password validation

	// $sql ="SELECT fname,lname,email,gender FROM patient WHERE (email=:useremail) ";
	$sql = "SELECT * FROM {$table} WHERE email='$email' && password='$password'";
	$query = $db->query($sql);
	$row = $query->fetch();
	$count = $query->rowCount();

	#if (password_verify($password, $row['password']) && $count ==1 )



	#{
	if ($sql) {
		$_SESSION['email'] = $row['email'];
		$_SESSION['name'] = $row['lname'] . ' ' . $row['fname'];
		$_SESSION['role'] = $row['role'];

		if ($_SESSION['role'] == "patient") {
			//echo "<script>alert('Login successfully')</script>";
			header('refresh:1; home.php');
		} elseif ($_SESSION['role'] == "doctor") {
			header('refresh:1; doctor.php');
		} else {
			header('refresh:1; pharmacy.php');
		}
	} else {
		$error = " <p style='color: red;'>Login failed wrong email or password </p> ";
		echo $error;
	}
}
?>

<html>

<head>
	<link href="style.css" rel="stylesheet" />
</head>
<form style="border:2px solid #eee" method="post">
	<div id="legend" style="padding-left:4%; marrgin:auto;">
		<legend class=""> Sign in |<a href="register.php">Register</a> </legend>
	</div>
	<div>
		<label for="Email">Email id</label>
		<input type="text" class="form-control" name="email" required="" title="Please enter your Email" placeholder="your email">

	</div>
	<div ">
<label for=" password">Password</label>
		<input type="password" id="password" name="password" placeholder="Password" required="" title="Please enter your password">

	</div>
	<button type="submit" name="login">Login</button>
</form>