<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['add'])){
    $bookname=$_POST['bookname'];
    $category=$_POST['category'];
    $author=$_POST['author'];
    $price=$_POST['price'];
    if(isset($_FILES["qrcode"]) && $_FILES["qrcode"]["error"] == 0){
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
                        $sql="INSERT INTO  tblbooks(`BookName`,`CatId`,`AuthorId`,`ISBNNumber`,`qrcode`,`BookPrice`) VALUES('$bookname','$category','$author','$isbn','$filename','$price')";
                        $result = $conn->query($sql);
                        $last_id = $conn->insert_id;
                        if($last_id){
                            $_SESSION['msg']="Book Listed successfully";
                            header('location:manage-books.php');
                        } else {
                            $_SESSION['error']="Something went wrong. Please try again";
                            header('location:manage-books.php');
                        }
                    }

                }
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
    <title>Online Library Management System | Add Book</title>
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
    <div class="container">
     
        <div class="row mt-3">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class=" panel panel-info">
                <div class="panel-heading">
                    Book Info
                </div>
                <div class="panel-body">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Book Name<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="bookname" autocomplete="off" required />
                        </div>

                        <div class="form-group">
                            <label> Category<span style="color:red;">*</span></label>
                            <select class="form-control" name="category" required="required">
                                <option value=""> Select Category</option>
                                <?php
        $status = 1;
        $sql = "SELECT * from  tblcategory where Status='$status'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) { ?>

                                <option value="<?php echo htmlentities(
            $row['id']
        ); ?>"><?php echo htmlentities($row['CategoryName']); ?></option>
                                <?php }
        }
        ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label> Author<span style="color:red;">*</span></label>
                            <select class="form-control" name="author" required="required">
                                <option value=""> Select Author</option>
                                <?php
        $sql = "SELECT * from  tblauthors ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) { ?>
                                <option value="<?php echo htmlentities(
            $row['id']
        ); ?>"><?php echo htmlentities($row['AuthorName']); ?></option>
                                <?php }
        }
        ?>
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label>ISBN Number<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="isbn" required="required" autocomplete="off" />
                            <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                        </div> -->

                        <div class="form-group">
                            <label>Upload QR Code<span style="color:red;">*</span></label>
                            <input type="file" class="form-control" name="qrcode" id="fileToUpload" required="required">
                        </div>

                        <div class="form-group">
                            <label>Price<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="price" autocomplete="off" required="required" />
                        </div>
                        <button type="submit" name="add" class="btn btn-info">Add </button>

                    </form>
                </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php // include('includes/footer.php');?>
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
