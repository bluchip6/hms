<?php

include('connectt.php');
$database = new Connection();
$db = $database->open();
$table ='complaints'; 
 
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
 
$email=$_SESSION['email'];
 $name=$_SESSION['name'];
?>

<?php


 
//including the database connection file
include_once("adminconn.php");
 
//fetching data in descending order (lastest entry first)
$result = $dbh->query("SELECT * FROM complaints ORDER BY id DESC");
 

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $name ; ?></title>

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
	
	<?php echo "Welcome ".$name;  ?>
	</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
 

    

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
  <?php

include ("doctornav.php");
?>


    <table width='100%' border=1>
 
    <tr bgcolor='#CCCCCC'>
	<td>id</td>
       
        <td>Email</td>
		<td>Complaint</td>
<td> Your Response </td>         
    </tr>
    <?php     
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
        echo "<tr>";
		echo "<td>".$row['id']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['complaint']."</td>"; 
           echo "<td>".$row['response']."</td>"; 
        echo "<td><a href=\"replyComplaint.php?id=$row[id]\">Reply</a> </td>";        
    }
    ?>
    </table>

    
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