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
    <title>Library Management System | Admin Dash Board</title>
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
                $sql = "SELECT id from tblbooks ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  $listdbooks = mysqli_num_rows($result);
                ?>
                <h3><?php echo htmlentities($listdbooks); ?> </h3> <?php } else { ?><h3> <?php echo htmlentities('0');} ?> </h3>
                Books Listed
            </div>
          </div>


          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-bars fa-5x"></i>
              <?php
          $sql1 = "SELECT id from tblissuedbookdetails ";
          $result1 = $conn->query($sql1);
          if ($result1->num_rows > 0) {
            $issuedbooks = mysqli_num_rows($result1);
          ?>

              <h3><?php echo htmlentities($issuedbooks); ?> </h3> <?php } else { ?><h3> <?php echo htmlentities('0');} ?> </h3>
              Times Book Issued
            </div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center">
              <i class="fa fa-recycle fa-5x"></i>
              <?php
          $status = 1;
          $sql2 = "SELECT id from tblissuedbookdetails where RetrunStatus=:status";
          $result2 = $conn->query($sql2);
          if ($result2->num_rows > 0) {
            $returnedbooks = mysqli_num_rows($result2);        
          ?>
              <h3><?php echo htmlentities($returnedbooks); ?> </h3> <?php } else { ?><h3> <?php echo htmlentities('0');} ?> </h3>
              Times Books Returned
            </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-danger back-widget-set text-center">
              <i class="fa fa-users fa-5x"></i>
              <?php
          $sql3 = "SELECT id from tblstudents ";
          $result3 = $conn->query($sql3);
          if ($result3->num_rows > 0) {
            $regstds = mysqli_num_rows($result3);        
          ?>
              <h3><?php echo htmlentities($regstds); ?> </h3> <?php } else { ?><h3> <?php echo htmlentities('0');} ?> </h3>
              Registered Users
            </div>
          </div>

        </div>
        <div class="row">

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-success back-widget-set text-center">
              <i class="fa fa-user fa-5x"></i>
              <?php
          $sql4 = "SELECT id from tblauthors ";
          $result4 = $conn->query($sql4);
          if ($result4->num_rows > 0) {
            $listdathrs = mysqli_num_rows($result4);        
          ?>
              <h3><?php echo htmlentities($listdathrs); ?> </h3> <?php } else { ?><h3> <?php echo htmlentities('0');} ?> </h3>
              Authors Listed
            </div>
          </div>


          <div class="col-md-3 col-sm-3 rscol-xs-6">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-file-archive-o fa-5x"></i>
              <?php
          $sql5 = "SELECT id from tblcategory ";
          $result5 = $conn->query($sql5);
          if ($result5->num_rows > 0) {
            $listdcats = mysqli_num_rows($result5);        
          ?>
              <h3><?php echo htmlentities($listdcats); ?> </h3> <?php } else { ?><h3> <?php echo htmlentities('0');} ?> </h3>

              Listed Categories
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
