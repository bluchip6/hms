<?php
 
include('connectt.php');
$database = new Connection();
$db = $database->open();
$table ='patients'; 
 
session_start();
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
    <title>PDO | Welcome Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <style type="text/css">
          .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
    </style>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="span12">
      <div class="hero-unit center">
<?php
 
//$email=$_SESSION['email'];

$sql=("SELECT * FROM patients WHERE ( email=:email)");
$query=$db->query($sql);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query->execute(array(':email'=> $email));
       while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $lname=$row['lname'];
		$fname=$row['fname'];
       }
	   
	   /*
	   $username=$_SESSION['userlogin'];
$query=$dbh->prepare("SELECT  FullName FROM userdata WHERE (UserName=:username || UserEmail=:username)");
      $query->execute(array(':username'=> $username));
       while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $username=$row['FullName'];
       } */
       ?>
          <h1>Welcome Back <font face="Tahoma" color="red"><?php echo $lname.'  '.$fname;?> ! </font></h1>
          <br />
          <p>Lorem ipsum dolor sit amet, sit veniam senserit mediocritatem et, melius aperiam complectitur an qui. Ut numquam vocibus accumsan mel. Per ei etiam vituperatoribus, ne quot mandamus conceptam has, pri molestiae constituam quaerendum an. In molestiae torquatos eam.
          </p>
          <a href="logout.php" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Log me out</a>
        </div>
        <br />
      </div>
        <br />
        
    </div>
  </div>
</div>
<script type="text/javascript">
</script>
 <p><a href="logout"><button>logout </button> </a> </p>
</body>
</html>
<?php } ?>