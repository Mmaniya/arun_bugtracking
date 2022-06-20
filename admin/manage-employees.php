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
$sql = "delete from employee  WHERE id='$id'";
$result = $conn->query($sql);
$_SESSION['delmsg']="Employee deleted";
header('location:manage-employees.php');

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
        <div class="row mt-3">
            <div class="row">
                <?php if ($_SESSION["error"] != "") { ?>
                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <strong>Error :</strong>
                        <?php echo htmlentities($_SESSION["error"]); ?>
                        <?php echo htmlentities($_SESSION["error"] = ""); ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($_SESSION["msg"] != "") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong>
                        <?php echo htmlentities($_SESSION["msg"]); ?>
                        <?php echo htmlentities($_SESSION["msg"] = ""); ?>
                    </div>
                </div>
                <?php } ?>
                <?php if ($_SESSION["updatemsg"] != "") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong>
                        <?php echo htmlentities($_SESSION["updatemsg"]); ?>
                        <?php echo htmlentities($_SESSION["updatemsg"] = ""); ?>
                    </div>
                </div>
                <?php } ?>


                <?php if ($_SESSION["delmsg"] != "") { ?>
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>Success :</strong>
                        <?php echo htmlentities($_SESSION["delmsg"]); ?>
                        <?php echo htmlentities($_SESSION["delmsg"] = ""); ?>
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
                    Employee List
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
        $sql = "SELECT * from  employee";
        $result = $conn->query($sql);
        $cnt=1;
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) { ?>
      
                                    <tr class="odd gradeX">
                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                        <td class="center"><?php echo htmlentities($row['name']); ?></td>
                                        <td class="center"><?php echo htmlentities($row['email']); ?></td>
                                        <td class="center"><?php echo htmlentities($row['mobile']); ?></td>
                                        <td class="center">
                                            
                                        <?php 
                                        $id = $row['category_id'];
                                         $sql1 = "select * from category WHERE id='$id'";
                                        $result1 = $conn->query($sql1);
                                        if ($result1->num_rows > 0) {
                                            while($row1 = $result1->fetch_assoc()) {
                                        
                                        echo htmlentities($row1['category']); } } ?>
                                    
                                    </td>

                                        <td class="center">

                                          
                                                <a href="manage-employees.php?del=<?php echo htmlentities(
                $row['id']
            ); ?>" onclick="return confirm('Are you sure you want to delete?');" >  <button class=" btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                        </td>
                                    </tr>
                                    <?php $cnt = $cnt + 1;}
        }
        ?>
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