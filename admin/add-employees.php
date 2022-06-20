<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['signup']))
{
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email']; 
$category_id=$_POST['category']; 
$password=md5($_POST['password']); 
$status=1;    
$sql="INSERT INTO  employee(`name`,`email`,`password`,`mobile`,`category_id`,`status`) VALUES('$name','$email','$password','$mobile','$category_id','$status')";    
$result = $conn->query($sql);
$last_id = $conn->insert_id;
if($last_id)
{
$_SESSION['msg']="Employess Added successfully";
header('location:manage-employees.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:manage-employees.php');
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
    <title>Bug Tracking | Add Employees</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
    function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data:'emailid='+$("#emailid").val(),
            type: "POST",
            success:function(data){
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){}
        });
    }
</script>  
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
  	
  		<div class="container">
  	
  			<div class="row mt-3">
  				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class=" panel panel-info">
                        <div class="panel-heading">
                            Employee Info
                        </div>
                        <div class="panel-body">
                        <form name="signup" method="post" onSubmit="return valid();">
                                <div class="form-group">
                                    <label>Enter Full Name</label>
                                    <input class="form-control" type="text" name="name" autocomplete="off" required />
                                </div>


                                <div class="form-group">
                                    <label>Mobile Number </label>
                                    <input class="form-control" type="text" name="mobile" maxlength="10" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Enter Email</label>
                                    <input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()" autocomplete="off" required />
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>

                                <div class="form-group">
                                    <label>Enter Password</label>
                                    <input class="form-control" type="password" name="password" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                            <label> Category<span style="color:red;">*</span></label>
                            <select class="form-control" name="category" required="required">
                                <option value=""> Select Category</option>
                                <?php
                                    $status = 1;
                                    $sql = "SELECT * from  category where status='$status'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) { ?>

                                                            <option value="<?php echo htmlentities(
                                        $row['id']
                                    ); ?>"><?php echo htmlentities($row['category']); ?></option>
                                                            <?php }
                                    }
                                ?>
                            </select>
                        </div>


                                <button type="submit" name="signup" class="btn btn-info" id="submit">Create Account </button>

                            </form>
                        
                        </div>
                    </div>
  				</div>
  			</div>

  		</div>


    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
