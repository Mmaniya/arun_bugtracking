<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['del']))
{
$id=$_GET['del'];

$sql1 = "SELECT * FROM tblbooks WHERE id='$id'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
  while($row = $result1->fetch_assoc()) {
     unlink( "../QRcode/".$row['qrcode']);
  }
}

$sql = "delete from tblbooks  WHERE id='$id'";
$result = $conn->query($sql);

$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:manage-books.php');

}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bug Tracking </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
     
     <div class="row">
    <?php if($_SESSION['error']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-danger" >
 <strong>Error :</strong> 
 <?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['msg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['msg']);?>
<?php echo htmlentities($_SESSION['msg']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['updatemsg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['updatemsg']);?>
<?php echo htmlentities($_SESSION['updatemsg']="");?>
</div>
</div>
<?php } ?>


   <?php if($_SESSION['delmsg']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
</div>
<?php } ?>

</div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Test Project
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Details</th>
                                            <th>Description</th>
                                            <th>Document</th>
                                            <th>Employee</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $id = $_REQUEST['id'];
                                    $sql = "SELECT employee.name,category.category,track_bug.description as jd,track_bug.file, job_description.title,job_description.duration,job_description.description,job_description.status,job_description.id as id from  job_description join employee on employee.id=job_description.emp_id join category on category.id=job_description.category_id join track_bug on track_bug.jd_id=job_description.id where job_description.id = '$id'";
                                    $result = $conn->query($sql);
                                    $cnt=1;
                                    if ($result->num_rows > 0) {

                                    while($row = $result->fetch_assoc()) { ?>                                
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($row['title']);?></td>
                                            <td class="center"><?php echo htmlentities($row['jd']);?></td>
                                            <td class="center"><a href="../documents/<?php echo htmlentities($row['file']);?>">Download</a></td>
                                            <td class="center"><?php echo htmlentities($row['description']);?></td>
                                            <td class="center"><?php echo htmlentities($row['name']);?></td>
                                            <td class="center"><?php echo htmlentities($row['category']);?></td>
                                            <td class="center"><?php if($row['status'] == '2'){ ?> 
                                                <span class="label label-success"><i class="fa fa-check"></i> Completed</span>
                                                <?php } else { ?> 
                                                <span class="label label-danger"><i class="fa fa-times"></i>Not Completed</span>
                                                <?php } ?></td>
                                                <td class="center">
                                                    <a href="report.php?sid=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Are you sure you want to Approved?');" >  <button class="btn btn-success"><i class="fa fa-check"></i>Approved</button>
                                                    <a href="report.php?did=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Are you sure you want to Rejected?');" >  <button class="btn btn-danger"><i class="fa fa-times"></i>Not Approved</button>
                                                </td>
                                        </tr>
                                    <?php $cnt=$cnt+1;}} else {
                                    $sql = "SELECT employee.name,category.category, job_description.title,job_description.duration,job_description.description,job_description.status,job_description.id as id from  job_description join employee on employee.id=job_description.emp_id join category on category.id=job_description.category_id where job_description.id = '$id'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {

                                        while($row = $result->fetch_assoc()) { ?>                                
                                            <tr class="odd gradeX">
                                                <td class="center"><?php echo htmlentities($cnt);?></td>
                                                <td class="center"><?php echo htmlentities($row['title']);?></td>
                                                <td class="center"></td>
                                                <td class="center"></td>
                                                <td class="center"><?php echo htmlentities($row['description']);?></td>
                                                <td class="center"><?php echo htmlentities($row['name']);?></td>
                                                <td class="center"><?php echo htmlentities($row['category']);?></td>
                                                <td class="center"><?php if($row['status'] == '2'){ ?> 
                                                    <span class="label label-success"></i> Completed</span>
                                                    <?php } else { ?> 
                                                    <span class="label label-danger"></i>Not Completed</span>
                                                    <?php } ?></td>
                                                <td class="center">
                                                    <a href="report.php?sid=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Are you sure you want to Approved?');" >  <button class="btn btn-success"><i class="fa fa-check"></i>Approved</button>
                                                    <a href="report.php?did=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Are you sure you want to Rejected?');" >  <button class="btn btn-danger"><i class="fa fa-times"></i>Not Approved</button>
                                                </td>
                                            </tr>
                                        <?php $cnt=$cnt+1;}}

                                    } ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
