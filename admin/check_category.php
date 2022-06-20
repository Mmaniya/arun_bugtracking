<?php 
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["id"])) {
	$id= $_POST["id"];
    $sql = "SELECT * FROM category WHERE id ='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
        $id = $row['id'];
        $category = $row['category'];
        echo '<option value="'.$id.'">'.$category.'</option>';
        } 
    }
}
?>