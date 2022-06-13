<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update'])){
  $bookname=$_POST['bookname'];
  $category=$_POST['category'];
  $author=$_POST['author'];
  $price=$_POST['price'];
  $bookid=intval($_GET['bookid']);

  $sql="update  tblbooks set `BookName`='$bookname',`CatId`='$category',`AuthorId`='$author',`BookPrice`='$price' where id='$bookid'";
  $result = $conn->query($sql);

  if(isset($_FILES["qrcode"]) && $_FILES["qrcode"]["error"] == 0){

    $sqlq = "SELECT * FROM tblbooks WHERE id ='$bookid'";
    $results = $conn->query($sqlq);
    if ($results->num_rows > 0) {
      while($rows = $results->fetch_assoc()) {        
        unlink( "../QRcode/".$rows['qrcode']);
        $sqlr="update  tblbooks set `ISBNNumber`='',`qrcode`='' where id='$bookid'";
        $conn->query($sqlr);
      }
    }

    $extension = pathinfo($_FILES["qrcode"]["name"], PATHINFO_EXTENSION);
    if($extension != 'png'){
            $_SESSION['error']= " Invalid Format.";
            header('location:manage-books.php');
    } else {

        $filename = $_FILES["qrcode"]["name"];
        if(file_exists("../QRcode/" . $filename)){
            $_SESSION['error']= $filename . " is already exists.";
            header('location:manage-books.php');
        } else{

            if(move_uploaded_file($_FILES["qrcode"]["tmp_name"], "../QRcode/" . $filename)){
                include('../qrtraindata.php');

                $sql = "SELECT * FROM tblbooks WHERE ISBNNumber ='$isbn'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $_SESSION['error']= "Already Book Exist.!";
                    header('location:manage-books.php');
                    unlink( "../QRcode/".$filename);
                }else{
                  $sql="update  tblbooks set `ISBNNumber`='$isbn',`qrcode`='$filename' where id='$bookid'";
                  $result = $conn->query($sql);
                  $_SESSION['msg']="Book info updated successfully..!";
                  header('location:manage-books.php');           
                }
            }
        }
    }
  }else{   
    $_SESSION['msg']="Book info updated successfully";
    header('location:manage-books.php'); 
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
    <title>Online Library Management System | Edit Book</title>
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
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post" enctype="multipart/form-data">
<?php 
$bookid=intval($_GET['bookid']);
$sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId where tblbooks.id='$bookid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) { ?>

<div class="form-group">
<label>Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($row['BookName']);?>" required />
</div>

<div class="form-group">
<label> Category<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value="<?php echo htmlentities($row['cid']);?>"> <?php echo htmlentities($catname=$row['CategoryName']);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  tblcategory where Status='$status'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
  while($row1 = $result1->fetch_assoc()) {

if($catname==$row1['CategoryName'])
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row1['id']);?>"><?php echo htmlentities($row1['CategoryName']);?></option>
 <?php }}} ?> 
</select>
</div>


<div class="form-group">
<label> Author<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value="<?php echo htmlentities($row['athrid']);?>"> <?php echo htmlentities($athrname=$row['AuthorName']);?></option>
<?php 

$sql2 = "SELECT * from  tblauthors ";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
  while($row2 = $result2->fetch_assoc()) {         
if($athrname==$row2['AuthorName'])
{
continue;
} else{

    ?>  
<option value="<?php echo htmlentities($row2['id']);?>"><?php echo htmlentities($row2['AuthorName']);?></option>
 <?php }}} ?> 
</select>
</div>

<!-- <div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($row['ISBNNumber']);?>"  required="required" />
<p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
</div> -->

<div class="form-group">
    <label>Upload QR Code<span style="color:red;">*</span></label>
    <input type="file" class="form-control" name="qrcode" id="fileToUpload" >
</div>

 <div class="form-group">
 <label>Price in USD<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="price" value="<?php echo htmlentities($row['BookPrice']);?>"   required="required" />
 </div>
 <?php }} ?>
<button type="submit" name="update" class="btn btn-info">Update </button>

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
