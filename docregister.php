<?php

include('connect.php');
error_reporting(0);
if (isset($_POST['register'])) {
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $gender = $_POST['sex'];
  $email = $_POST['Email'];
  $role = 'doctor';

  $password = ($_POST['pass']);



  // Query to check if user with this email already exists
  $query1 = "SELECT * FROM patients where (email=:useremail)";
  $queryt = $dbh->prepare($query1);
  $queryt->bindParam(':useremail', $email, PDO::PARAM_STR);

  $queryt->execute();
  $results = $queryt->fetchAll(PDO::FETCH_OBJ);
  if ($queryt->rowCount() == 0) {
    // Query for Insertion of new user data into table
    $sql = "INSERT INTO patients(fname,lname,email,gender,password,role) VALUES(:userfname,:userlname,:useremail,:usergender,:userpassword,:userRole)";
    $query = $dbh->prepare($sql);

    // Binding Post Values
    $query->bindParam(':userfname', $fname, PDO::PARAM_STR);
    $query->bindParam(':userlname', $lname, PDO::PARAM_STR);
    $query->bindParam(':useremail', $email, PDO::PARAM_STR);
    $query->bindParam(':usergender', $gender, PDO::PARAM_STR);
    $query->bindParam(':userpassword', $password, PDO::PARAM_STR);
    $query->bindParam(':userRole', $role, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
      $msg = "You have signup  Successfully";
    } else {
      $error = "Sorry, the account creation process failed..Please try again";
    }
  } else {
    $error = " Email already exist. Please register with another Email address";
  }
}
?>
<html>

<head>
  <link href="style.css" rel="stylesheet" />
</head>
<form action='' style="border:1px solid #eee" method="post">
  <div id="legend" style="padding-left:4%">
    <legend class="">Register | <a href="index.php">Sign in</a></legend>
  </div>
  <div class="container">
    <h1>REGISTER</h1>

    <hr>

    <label for="firstname"><b>Firstname</b></label>
    <input type="text" placeholder="Enter your firstname" name="firstname" required>

    <p>
      <label for="lastname"><b>Lastname</b></label>
      <input type="text" placeholder="Enter your lastname" name="lastname" required>
    <p>
      <label for="gender"><b>Gender :</b></label>
      <input type="radio" name="sex" value="male" required> <b>Male</b>
      <input type="radio" name="sex" value="female" required> <b>Female</b>
    <p>

    <p>
      <label for="email"><b>Email</b></label>
      <!--  HTML5 form validation.
    type=email ensures user types in a character in email format
    the keyword requires ensures that the forl field is filled  -->
      <input type="email" placeholder="Enter Email" name="Email" required>
    <p>
      <label for="password"><b>Password</b></label>
      <!-- type = password automatically ensures the characters are hidden 
      pattern ensures the user followsd the specified pattern
      <input type="password" placeholder="Enter Password" name="pass" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
-->
      <input type="password" placeholder="Enter Password" name="pass" required />
    <p>
    <div class="cf">

      <button type="submit" class="signupbtn" name="register">Sign Up</button>
    </div>
  </div>
</form>
<!--Error Message-->
<?php if ($error) { ?><div>
    <strong>Hello </strong> : <?php echo htmlentities($error); ?>
  </div>
<?php } ?>
<!--Account Creation Success Message-->
<?php if ($msg) { ?><div>
    <strong>Congratulations</strong> : <?php echo htmlentities($msg); ?>
  </div>
<?php } ?>