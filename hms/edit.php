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
if (isset($_POST['update'])) {
$ufname = $_POST['firstname'];   
$ulname = $_POST['lastname'];
$ugender = $_POST['gender'];      
$urole= $_POST['role'];
$id = $_POST['id'];
   
 
// Query for updating of new user data into table
$sql = "UPDATE patients SET fname=:fname, lname=:lname, gender=:gender ,role=:role WHERE id=:id";
 

$query = $dbh->prepare($sql);

// Binding Post Values
$query->bindParam(':fname',$ufname);
$query->bindParam(':lname',$ulname);
 
$query->bindParam(':gender',$ugender);
 
$query->bindParam(':role',$urole);
$query->bindParam(':id',$id);
$query->execute();
 
 header("Location: Allrecord.php");
 
}
?> 

<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$sql = "SELECT * FROM patients WHERE id=:id";
$query = $dbh->prepare($sql);
$query->execute(array(':id' => $id));
 
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $lname = $row['lname'];
    $fname = $row['fname'];
    $email = $row['email'];
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
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Actions</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
           
          <a class="dropdown-item" href="Allrecord.php">View All Records</a>
          <a class="dropdown-item" href="Allcomplaint.php">View Complaints</a>
           <a class="dropdown-item" href="logout.php">logout</a>

      </li>
   
    </ul>
<div class="card">
<h5 class="card-header info-color white-text text-center py-4">
        <strong>Update Record</strong>
    </h5>
	
	<div class="card-body px-lg-5 pt-0">
<form class="text-center" style="color: #757575;" action="" method="post">
  
  <div class="container">
       <div class="md-form mt-3">
                <input type="text" value="<?php echo $fname;?>" id="materialContactFormName" class="form-control" name="firstname" required>
                <label for="Firstname">Firstname</label>
            </div>

 
       <div class="md-form mt-3">
                <input type="text" value="<?php echo $lname;?>" id="materialContactFormName" class="form-control" name="lastname" required>
                <label for="Lastname">Lastname</label>
            </div>


 


  <span>Gender</span>
            <select class="mdb-select" name="gender">
                <option value="" disabled>Choose option</option>
                <option value="male" selected>Male</option>
                <option value="female">Female</option>
                 
            </select>

<span>Role</span>
            <select class="mdb-select" name="role">
                <option value="" disabled>Choose option</option>
                <option value="user" selected>user</option>
                <option value="admin">admin</option>
                 
            </select>

<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"> 

<button name="update" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Update record</button>



    
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
 