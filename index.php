<?php


session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{
  //code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {
$email=$_POST['emailid'];
$password=md5($_POST['password']);

$sql = "SELECT * FROM employee WHERE email ='$email' AND password='$password'";   
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $_SESSION['stdid'] = $row['id'];
     $row['status'];
if($row['status']==1)
{
 $_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else {
echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";

}
}

} 

else{
echo "<script>alert('Invalid Details');</script>";
}
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bug Tracking | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!------MENU SECTION START-->
    <?php  include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <!-- <div class="content-wrapper"> -->
      <div class="container">
        <br>
        <!--LOGIN PANEL START-->
        <div class="row ">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                LOGIN FORM
              </div>
              <div class="panel-body">
                <form role="form" method="post">

                  <div class="form-group">
                    <label>Enter Email id</label>
                    <input class="form-control" type="text" name="emailid" required autocomplete="off" />
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" required autocomplete="off" />
                    <p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
                  </div>

                  <div class="form-group">
                    <label>Verification code : </label>
                    <input type="text" class="form-control1" name="vercode" maxlength="5" autocomplete="off" required style="height:25px;" />&nbsp;<img src="captcha.php">
                  </div>

                  <button type="submit" name="login" class="btn btn-info">LOGIN </button> 
                </form>
              </div>
            </div>
          </div>
        </div>
        <!---LOGIN PABNEL END-->
      </div>
    <!-- </div> -->
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php //include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
