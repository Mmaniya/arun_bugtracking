<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['return']))
{
$rid=intval($_GET['rid']);
$fine=$_POST['fine'];
$rstatus=1;
$sql="update tblissuedbookdetails set fine='$fine',RetrunStatus='$rstatus' where id='$rid'";
$result = $conn->query($sql);

$_SESSION['msg']="Book Returned successfully";
header('location:manage-issued-books.php');



}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issued Book Details</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
 
         <div class="container">
        <div class="row pad-botm">
          

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class="panel panel-info">
<div class="panel-heading">
Issued Book Details
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$rid=intval($_GET['rid']);
$sql = "SELECT tblstudents.FullName,tblbooks.BookName,tblbooks.qrcode,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.RetrunStatus from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblissuedbookdetails.id='$rid'";
$result = $conn->query($sql);
$cnt=1;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) { ?>                                    
                   



<div class="form-group">
<label>Student Name :</label>
<?php echo htmlentities($row['FullName']);?>
</div>

<div class="form-group">
<label>Book Name :</label>
<?php echo htmlentities($row['BookName']);?>
</div>


<div class="form-group">
<label>ISBN :</label>
<img src="../QRcode/<?php echo htmlentities($row['qrcode']);?>" height="30" weight="30">
<?php //echo htmlentities($row['ISBNNumber']);?>
</div>

<div class="form-group">
<label>Book Issued Date :</label>
<?php echo htmlentities($row['IssuesDate']);?>
</div>


<div class="form-group">
<label>Book Returned Date :</label>
<?php if($row['ReturnDate']=="")
                                            {
                                                echo htmlentities("Not Return Yet");
                                            } else {


                                            echo htmlentities($row['ReturnDate']);
}
                                            ?>
</div>

<div class="form-group">
<label>Fine (in RS) :</label>
<?php 
if($row['fine']=="")
{?>
<input class="form-control" type="text" name="fine" id="fine"  required />

<?php }else {
echo htmlentities($row['fine']);
}
?>
</div>
 <?php if($row['RetrunStatus']==0){?>

<button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>

 </div>

<?php }}} ?>
                                    </form>
                            </div>
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
