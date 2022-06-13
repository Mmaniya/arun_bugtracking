<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change'])){
  //code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT EmailId FROM tblstudents WHERE EmailId='$email' and MobileNumber='$mobile'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$sql="update tblstudents set Password='$newpassword' where EmailId='$email' and MobileNumber='$mobile'";
$result = $conn->query($sql);
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
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
    <title>Online Library Management System | Password Recovery </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="container">

             
<!--LOGIN PANEL START-->           
<div class="row mt-3">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 LOGIN FORM
</div>
<div class="panel-body">
<form role="form" name="chngpwd" method="post" onSubmit="return valid();">

<div class="form-group">
<label>Enter Reg Email id</label>
<input class="form-control" type="email" name="email" required autocomplete="off" />
</div>

<div class="form-group">
<label>Enter Reg Mobile No</label>
<input class="form-control" type="text" name="mobile" required autocomplete="off" />
</div>

<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="newpassword" required autocomplete="off"  />
</div>

<div class="form-group">
<label>ConfirmPassword</label>
<input class="form-control" type="password" name="confirmpassword" required autocomplete="off"  />
</div>

 <div class="form-group">
<label>Verification code : </label>
<input type="text" class="form-control1"  name="vercode" maxlength="5" autocomplete="off" required  style="height:25px;" />&nbsp;<img src="captcha.php">
</div> 

 <button type="submit" name="change" class="btn btn-info">Chnage Password</button> | <a href="index.php">Login</a>
</form>
 </div>
</div>
</div>

<!---LOGIN PABNEL END-->            
             
 
    </div>
    </div>
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
