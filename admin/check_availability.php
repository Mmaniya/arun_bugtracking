<?php 
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "error : You did not enter a valid email.";
	}
	else {

		$sql = "SELECT * FROM employee WHERE email ='$email'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		echo "<span style='color:red'> Email Already Exist.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
		} else{			
		echo "<span style='color:green'> Email Available.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
}
?>