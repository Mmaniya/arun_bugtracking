<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){ header('location:index.php'); 
} else{ 
    $reportid = $_REQUEST['sid'];
    if(isset($reportid)){
         $sql="update job_description set `report`='1' where id='$reportid'";
        $result = $conn->query($sql);
        if($result){
            $msg="Your Report succesfully changed";
        }
        else {
            $error="Your Report is wrong";  
        }
    }

    $reportdid = $_REQUEST['did'];
    if(isset($reportdid)){
        $sql="update job_description set `report`='2' where id='$reportdid'";
        $result = $conn->query($sql);
        if($result){
            $msg="Your Report succesfully changed";
        }
        else {
            $error="Your Report is wrong";  
        }
    }
    header('location:manage-program.php');

}
?>