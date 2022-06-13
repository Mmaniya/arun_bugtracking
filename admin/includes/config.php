<?php 
$conn = new mysqli("localhost","root","","library");
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error; 
}
?>