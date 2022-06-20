<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['create'])){
$description=$_POST['description'];
$jd_id=$_POST['jd_id'];
$emp_id=$_POST['emp_id'];
$category_id=$_POST['category_id'];
$status='1';
if(isset($_FILES["document_file"]) && $_FILES["document_file"]["error"] == 0){
   
    $extension = pathinfo($_FILES["document_file"]["name"], PATHINFO_EXTENSION);
    $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name);
    $file = time() . "." . $extension;
    if(move_uploaded_file($_FILES["document_file"]["tmp_name"], "documents/" . $file)){ 
        $sql="INSERT INTO track_bug(`jd_id`,`description`,`file`,`emp_id`,`category_id`,`status`) VALUES('$jd_id','$description','$file','$emp_id','$category_id','$status')";
        $result = $conn->query($sql);
        $last_id = $conn->insert_id;
        if($last_id){
            $_SESSION['msg']="Project Submited successfully";
            header('location:task_list.php');
        }else {
            $_SESSION['error']="Something went wrong. Please try again";
            header('location:task_list.php');
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
    <title>Bug Tracking | Add Categories</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<style>
    #timer {
        float: right;
    color: RED;
    font-size: 20px;
    }
    </style>
</head>
<body>
    <div id="page-container">
    
    <?php include('includes/header.php');?>
    <div class="bg-img">
    <!-- MENU SECTION END-->
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <div class=" panel panel-info">
                    <div class="panel-heading">
                        Project Info
                        <span id="timer"></span>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" enctype="multipart/form-data">
                        <?php 
                        $sid=$_SESSION['stdid'];
                        $jid=$_REQUEST['jid'];

                        $sql1="update job_description set status='2' where id='$jid'";
                        $results = $conn->query($sql1);

                        $sql="Select * from job_description where emp_id='$sid' AND id='$jid'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {?>                                      
                                    <input class="form-control" type="hidden" name="jd_id" value="<?php echo $row['id']; ?>" />
                                    <input class="form-control" type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>"/>
                                    <input class="form-control" type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>" />
                                    <input class="form-control" type="hidden" id="duration" value="<?php echo $row['duration']; ?>" />
                                <?php }} ?>  

                            <div class="form-group">
                                <label>Upload File<span style="color:red;">*</span></label>
                                <input class="form-control" type="file" name="document_file" required="required" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            </div>
                            
                            <div class="form-group">
                                 <label>Project Description<span style="color:red;">*</span></label>
                                 <textarea class="form-control" type="text" name="description"  required="required"></textarea>
                              </div>

                            <button type="submit" name="create" class="btn btn-info">Complete </button>

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

    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->


    <script src="assets/js/bootstrap.js"></script>

    <script type="text/javascript">
        var ctrlKeyDown = false;
        $( document ).ready(function() {
            $(document).on("keydown", keydown);
            $(document).on("keyup", keyup);

            var duration = $('#duration').val();
            
            var newdate = add_minutes(duration);
            timer(newdate);
            function add_minutes (minutes) {
                return new Date(new Date().getTime() + minutes*60000);
            }

            function timer (newdate){
            var countDownDate = new Date(newdate).getTime();
            // Update the count down every 1 second
            var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
                
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
                
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = 
            + minutes + "m " + seconds + "s ";
                
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";
            }
            }, 1000);
            }

            var sec = convertHMS(duration);
            function convertHMS(duration) {
                return seconds = ((duration * 60) * 1000);
            }
            setTimeout(reloadpage, sec);
            function reloadpage(){
                  window.location.href = "task_list.php";
            }
        });

        function keydown(e) { 

if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
    // Pressing F5 or Ctrl+R
    e.preventDefault();
} else if ((e.which || e.keyCode) == 17) {
    // Pressing  only Ctrl
    ctrlKeyDown = true;
}
};

function keyup(e){
// Key up Ctrl
if ((e.which || e.keyCode) == 17) 
    ctrlKeyDown = false;
};
    </script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

   
</body>
</html>
<?php } ?>
