<?php
 include ('connect.php');
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
error_reporting(0);
if (isset($_POST['reply'])) {
       
$response= $_POST['response'];
$id = $_POST['id'];
   
 
// Query for updating of new user data into table
$sql = "UPDATE appointment SET response=:response WHERE id=:id";
 

$query = $dbh->prepare($sql);

// Binding Post Values
$query->bindParam(':response',$response);
 
$query->bindParam(':id',$id);
$query->execute();
 
 header("Location: appointment.php");
 
}
?> 

<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$sql = "SELECT * FROM appointments WHERE id=:id";
$query = $dbh->prepare($sql);
$query->execute(array(':id' => $id));
 
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
     
    $email = $row['email'];
	$complaint =$row['appointment'];
}
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

<div class="card">
<h5 class="card-header info-color white-text text-center py-4">
        <strong>Doctor's response</strong>
    </h5>
	
	<div class="card-body px-lg-5 pt-0">
<form class="text-center" style="color: #757575;" action="" method="post">
  
  <div class="container">
       <div class="md-form mt-3">
           <label>    Patient's Email </label> <input type="text" value="<?php echo $email;?>" id="materialContactFormName" class="form-control" name="email" disabled required>
                 
            </div>

 <div class="md-form mt-3">
           <label>    Appointment Request </label> <input disabled type="text" value="<?php echo $complaint;?>" id="materialContactFormName" class="form-control" name="complaint" required>
                 
            </div>
       <div class="md-form mt-3">
                <input type="text" value="" id="materialContactFormName" class="form-control" name="response" required>
                <label for="Lastname">Response</label>
            </div>


 
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"> 

<button name="reply" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Respond to Appointment</button>



    
  </div>
</form> </div></div>

    
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 
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
 