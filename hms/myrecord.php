<?php

 
session_start();
if (isset($_SESSION['email'])){

  $inactive = 180; // set session inactivity period to 180 seconds

  if(isset($_SESSION["timeout"])) {

    $timeleft = time() - $_SESSION["timeout"];

    if($timeleft  > $inactive) {
      session_destroy();

      echo "<script>window.location = 'logout.php' </script>";
    }
  }
  $_SESSION['timeout'] = time();
}
	//$email=$_SESSION['email'];
   // $role = $_SESSION['sess_userrole'];
    if(!isset($_SESSION['email'])){
      header('index.php');
    }
	else{
//echo ("Welcome ". $email);
 
 
//session_start();
//include('connectt.php');
// Validating Session
$email=$_SESSION['email'];
 
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $email ; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="home.php">
	
	<?php echo "Welcome ".$email;  ?>
	</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
 

    

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
   <?php
 include ("usernav.php");
 ?>
<table><tr>
<?php

$dsn = "mysql:host=localhost;dbname=hospital";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);

 

$stm = $pdo->prepare("SELECT * FROM patients WHERE email = :email");
$stm->bindParam(":email", $email, PDO::PARAM_INT);
$stm->execute();

$row = $stm->fetch(PDO::FETCH_ASSOC);

echo "<th>Id: </th><td>" .$row['id']."<td>" . PHP_EOL;
echo "<tr><th>Firstname :</th> <td>" . $row['fname'] ."<td>". PHP_EOL;
echo "<tr><th>Lastname: </th><td>" . $row['lname']."<td>" . PHP_EOL;
echo "<tr><th>Gender: </th><td>" . $row['gender']."<td>" . PHP_EOL;
echo "<tr><th>Email: </th><td>" . $row['email'] ."<td>". PHP_EOL;
echo "<tr><th>Role: </th><td>" . $row['role'] ."<td>". PHP_EOL;
?>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
 

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
<?php
	}
?>