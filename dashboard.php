<?php
   session_start();
   error_reporting(0);
   include('includes/config.php');
   if(strlen($_SESSION['login'])==0)
     { 
   header('location:index.php');
   }
   else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Bug Tracking | Emp Dash Board</title>
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
      <?php include('includes/header.php');?>
      <!-- MENU SECTION END-->
      <div class="container">
         <div class="row pad-botm">
         </div>
         <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-6">
               <div class="alert alert-info back-widget-set text-center">
                  <i class="fa fa-bars fa-5x"></i>
                  <?php 
                     $sid=$_SESSION['stdid'];
                      $sql1 ="SELECT * from track_bug where emp_id='$sid' and status='1'";
                     $result = $conn->query($sql1);
                     if ($result->num_rows > 0) {
                       $row = mysqli_num_rows($result);                     
                     ?>
                  <h3><?php echo htmlentities($row); ?> </h3>
                  <?php } else { ?>
                  <h3> <?php echo htmlentities('0');} ?> </h3>
                  Completed Task
               </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
               <div class="alert alert-warning back-widget-set text-center">
                  <i class="fa fa-recycle fa-5x"></i>
                  <?php 
                     $rsts=1;
                      $sql2 ="SELECT * from job_description where emp_id='$sid' and status='$rsts'";
                     $result1 = $conn->query($sql2);
                     if ($result1->num_rows > 0) {
                       $row = mysqli_num_rows($result1);
                     ?>
                  <h3><?php echo htmlentities($row); ?> </h3>
                  <?php } else { ?>
                  <h3> <?php echo htmlentities('0');} ?> </h3>
                  Pending Task
               </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
               <div class="alert alert-warning back-widget-set text-center">
                  <i class="fa fa-times fa-5x"></i>
                  <?php 
                     $rsts=1;
                     $sql3 ="SELECT * from job_description where emp_id='1' and status='2' AND (select jd_id from track_bug) != id";
                     $result1 = $conn->query($sql3);
                     if ($result1->num_rows > 0) {
                       $row = mysqli_num_rows($result1);
                     ?>
                  <h3><?php echo htmlentities($row); ?> </h3>
                  <?php } else { ?>
                  <h3> <?php echo htmlentities('0');} ?> </h3>
                  Pending Task
               </div>
            </div>
         </div>
      </div>
      <!-- CONTENT-WRAPPER SECTION END-->
      <?php //include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
      <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
      <!-- CORE JQUERY  -->
      <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS  -->
      <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
      <script src="assets/js/custom.js"></script>
   </body>
</html>
<?php } ?>