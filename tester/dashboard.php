<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Bug Tracking | Admin Dash Board</title>
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
  <div id="page-container">
    <!------MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="bg-img">
      <div class="container ">
        <div class="row mt-3">

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-success back-widget-set text-center">
              <i class="fa fa-book fa-5x"></i>
                    <?php
                $sql = "SELECT id from job_description ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  $a = mysqli_num_rows($result);
                ?>
                <h3><?php echo htmlentities($a); ?> </h3> <?php } else { ?><h3> <?php echo htmlentities('0');} ?> </h3>
                Total Project
            </div>
          </div>


          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-bars fa-5x"></i>
              <?php
          $sql1 = "SELECT id from track_bug ";
          $result1 = $conn->query($sql1);
          if ($result1->num_rows > 0) {
            $b = mysqli_num_rows($result1);
          ?>

              <h3><?php echo htmlentities($b); ?> </h3> <?php } else { ?><h3> <?php echo htmlentities('0');} ?> </h3>
              Received Files
            </div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center">
              <i class="fa fa-file-archive-o fa-5x"></i>
              <?php
        //  $sqll = "SELECT id from job_description ";
        //  $results = $conn->query($sqll);
        //  if ($results->num_rows > 0) {
        //   while($rows = $results->fetch_assoc()) { 
        //       $id[] =$rows['id'];
        //   }}
        //     $ree = implode(",",$id);
        //     $sql3 = "SELECT count(*) as total from track_bug where jd_id IN ($ree)";
        //   $result3 = $conn->query($sql3);
           $tid=$_SESSION['tdid'];  
          $sql3 = "SELECT count(*) as total  from job_description where id = (Select jd_id from track_bug WHERE status = '1' ) AND status ='2'";
          $result3 = $conn->query($sql3);
          if ($result3->num_rows > 0) {
            while($row3 = $result3->fetch_assoc()) {
              
              ?>
              <h3><?php echo htmlentities($row3['total']); ?> </h3>
            <?php } } ?>
            Completed
            </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-danger back-widget-set text-center">
              <i class="fa fa-recycle fa-5x"></i>
              <?php 
           $row4 = "SELECT count(*) as total from job_description where id NOT IN (Select jd_id from track_bug) AND status ='1'";
          $result4 = $conn->query($row4);
          if ($result4->num_rows > 0) {
            while($row4 = $result4->fetch_assoc()) {
              
              ?>
              <h3><?php echo htmlentities($row4['total']); ?> </h3>
            <?php } } ?>
              Incompleted

            </div>
          </div>

        </div>
             
      </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php //include('includes/footer.php');?>
    </div>
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
