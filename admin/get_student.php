<?php 
require_once("includes/config.php");
if(!empty($_POST["studentid"])) {
  $studentid= strtoupper($_POST["studentid"]);
 
    $sql ="SELECT FullName,Status FROM tblstudents WHERE StudentId='$studentid'";
    $result = $conn->query($sql);
    $cnt=1;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { 
if($row['Status']==0)
{
echo "<span style='color:red'> Student ID Blocked </span>"."<br />";
echo "<b>Student Name-</b>" .$row['FullName'];
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>


<?php  
echo htmlentities($row['FullName']);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Invaid Student Id. Please Enter Valid Student id .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
