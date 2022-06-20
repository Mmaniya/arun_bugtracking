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
       $title=$_POST['pro_title'];
       $emp_id=$_POST['emp_id'];
       $time=$_POST['time']; 
       $category_id=$_POST['category_id']; 
       $description=$_POST['description']; 
       $status=1;    
       $sql="INSERT INTO job_description(`title`,`category_id`,`emp_id`,`duration`,`description`,`status`) VALUES('$title','$category_id','$emp_id','$time','$description','$status')";    
       $result = $conn->query($sql);
       $last_id = $conn->insert_id;
       if($last_id)
       {
           $_SESSION['msg']="Project Added successfully";
           header('location:manage-program.php');
       }
       else 
       {
           $_SESSION['error']="Something went wrong. Please try again";
           header('location:manage-program.php');
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
      <title>Bug Tracking | Add Program</title>
      <!-- BOOTSTRAP CORE STYLE  -->
      <link href="assets/css/bootstrap.css" rel="stylesheet" />
      <!-- FONT AWESOME STYLE  -->
      <link href="assets/css/font-awesome.css" rel="stylesheet" />
      <!-- CUSTOM STYLE  -->
      <link href="assets/css/style.css" rel="stylesheet" />
      <!-- GOOGLE FONT -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
      <script type="text/javascript">
         function select_category($id) {
             $("#loaderIcon").show();
             jQuery.ajax({
                 url: "check_category.php",
                 data:'id='+$id,
                 type: "POST",
                 success:function(data){
                     $("#category_id").html(data);
                     $("#loaderIcon").hide();
                 },
                 error:function (){}
             });
         }
      </script> 
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
                           Project Info
                        </div>
                        <div class="panel-body">
                           <form role="form" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                 <label>Project Title<span style="color:red;">*</span></label>
                                 <input class="form-control" type="text" name="pro_title" placeholder="Enter Title" autocomplete="off" required />
                              </div>
                              <div class="form-group">
                                 <label> Employee<span style="color:red;">*</span></label>
                                 <select class="form-control" name="emp_id" required="required" onchange="select_category(this.value)">
                                    <option value=""> Select Employee</option>
                                    <?php
                                       $status = 1;
                                       $sql = "SELECT * from  employee where status='$status'";
                                       $result = $conn->query($sql);
                                       if ($result->num_rows > 0) {
                                       while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo htmlentities(
                                       $row['id']
                                       ); ?>"><?php echo htmlentities($row['name']); ?></option>
                                    <?php }
                                       }
                                       ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Category<span style="color:red;">*</span></label>
                                 <select class="form-control" name="category_id" id="category_id" readonly required="required">
                                    <option value=""> Select Category</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Time<span style="color:red;">*</span></label>
                                 <input class="form-control" type="number" name="time" autocomplete="off" placeholder="Enter Duration" required />
                              </div>
                              <div class="form-group">
                                 <label>Project Description<span style="color:red;">*</span></label>
                                 <textarea class="form-control" type="text" name="description"  required="required"></textarea>
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