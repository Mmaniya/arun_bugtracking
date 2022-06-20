<?php 
$conn = new mysqli("localhost","root","","apj_bug_track");
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error; 
}
?>