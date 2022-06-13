<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{
$studentid=strtoupper($_POST['studentid']);
  if(isset($_FILES["qrcode"]) && $_FILES["qrcode"]["error"] == 0){
    $extension = pathinfo($_FILES["qrcode"]["name"], PATHINFO_EXTENSION);
    if($extension != 'png'){
        $_SESSION['error']= "Invalid Format.";
        header('location:manage-books.php');
    } else {      
      $filename = $_FILES["qrcode"]["name"];
      if(file_exists("../QRcode/" . $filename)){
        include('../qrtraindata.php');
        $sql = "SELECT * FROM tblbooks WHERE ISBNNumber ='$isbn'";
        $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
              $id = $row['id'];
              $sql="INSERT INTO  tblissuedbookdetails(`StudentID`,`BookId`) VALUES('$studentid','$id')";
              $result = $conn->query($sql);
              $last_id = $conn->insert_id;
              if($last_id){
                $_SESSION['msg']="Book issued successfully";
                header('location:manage-issued-books.php');
              } else {
                $_SESSION['error']="Something went wrong. Please try again";
                header('location:manage-issued-books.php');
              } 
            }
          }
      }else{
        $_SESSION['error']="Book Not Available.!";
        header('location:manage-issued-books.php');
      }
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
    <title>Online Library Management System | Issue a new Book</title>
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
// function getbook() {
// $("#loaderIcon").show();
// jQuery.ajax({
// url: "get_book.php",
// data:'bookid='+$("#bookid").val(),
// type: "POST",
// success:function(data){
// $("#get_book_name").html(data);
// $("#loaderIcon").hide();
// },
// error:function (){}
// });
// }

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
      <div class="row mt-3">
        <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
          <div class=" panel panel-info">
            <div class="panel-heading">
              Issue a New Book
            </div>
            <div class="panel-body">
              <form role="form" method="post" enctype="multipart/form-data">

                <div class="form-group">
                <select class="form-control" name="studentid" id="studentid" onchange="getstudent()" autocomplete="off" required>
                  <option value="">Select Student</option>
                  <?php $sql = "SELECT * from tblstudents";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) { ?>
                              <option value="<?= htmlentities($row['StudentId']); ?>"><?= htmlentities($row['StudentId']); ?></option>                        
                        <?php } } ?>
                  </select>
                </div>

                <div class="form-group">
                  <span id="get_student_name" style="font-size:16px;"></span>
                </div>




                <div class="form-group">
                    <label>Upload QR Code<span style="color:red;">*</span></label>
                    <input type="file" class="form-control" name="qrcode" id="fileToUpload" required="required">
                </div>

                <!-- <div class="form-group">
                  <label>ISBN Number or Book Title<span style="color:red;">*</span></label>
                  <input class="form-control" type="text" name="booikid" id="bookid" onBlur="getbook()" required="required" />
                </div> -->

                <!-- <div class="form-group">
                  <select class="form-control" name="bookdetails" id="get_book_name" readonly>
                  </select>
                </div> -->
                <button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>

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
