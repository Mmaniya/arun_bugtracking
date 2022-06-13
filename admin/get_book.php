<?php 
require_once("includes/config.php");
if(!empty($_POST["bookid"])) {
  $bookid=$_POST["bookid"];
 
    $sql ="SELECT BookName,id FROM tblbooks WHERE ISBNNumber='$bookid'";
    $result = $conn->query($sql);
    $cnt=1;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { ?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['BookName']);?></option>
<b>Book Name :</b> 
<?php  
echo htmlentities($row['BookName']);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
 else{?>
  
<option class="others"> Invalid ISBN Number</option>
<?php
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
