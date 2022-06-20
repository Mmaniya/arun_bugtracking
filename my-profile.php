<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_POST['update']))
{    
$id=$_SESSION['stdid'];  
$name=$_POST['name'];
$mobile=$_POST['mobile'];

 $sql="update employee set `name` = '$name', `mobile`= '$mobile' where `id`= '$id'";
$result = $conn->query($sql);

// echo '<script>alert("Your profile has been updated")</script>';
}

?>

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
    <title>Bug Tracking </title>
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
        
             <div class="row mt-3">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-info">
                        <div class="panel-heading">
                           My Profile
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post">
<?php 
 $sid=$_SESSION['stdid']; 
 $sql="SELECT *, (Select category from category where id = employee.category_id) as category_name   from employee where id ='$sid' ";
$result = $conn->query($sql);
$cnt=1;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      
       ?>  

<div class="form-group">
<label>Created Date : </label>
<?php echo htmlentities($row['created_at']);?>
</div>
<?php if($row['UpdationDate']!=""){?>
<div class="form-group">
<label>Last Updation Date : </label>
<?php echo htmlentities($row['updated_at']);?>
</div>
<?php } ?>



<div class="form-group">
<label>Full Name</label>
<input class="form-control" type="text" name="name" value="<?php echo htmlentities($row['name']);?>" autocomplete="off" required />
</div>


<div class="form-group">
<label>Mobile</label>
<input class="form-control" type="text" name="mobile" maxlength="10" value="<?php echo htmlentities($row['mobile']);?>" autocomplete="off" required />
</div>
                                        
<div class="form-group">
<label>Email</label>
<input class="form-control" type="email"  value="<?php echo htmlentities($row['email']);?>"  autocomplete="off" required readonly />
</div>

<div class="form-group">
<label>Category</label>
<input class="form-control" type="text" value="<?php echo htmlentities($row['category_name']);?>"  autocomplete="off" required readonly />
</div>

<?php }} ?>
                              
<button type="submit" name="update" class="btn btn-primary" id="submit">Update Now </button>

                                    </form>
                            </div>
                        </div>
                            </div>
        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <?php // include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
