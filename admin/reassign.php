<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){ header('location:index.php'); 
} else{ 
    $reportid = $_REQUEST['id'];
    if(isset($reportid)){
         $sql="update job_description set `report`= NULL, `status` ='1' where id='$reportid'";
        $result = $conn->query($sql);
        if($result){
            $msg="Your Task succesfully changed";
        }
        else {
            $error="Your Report is wrong";  
        }
    }
    header('location:manage-program.php');

}
?>