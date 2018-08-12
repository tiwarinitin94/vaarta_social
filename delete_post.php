<?php include("inc/connect.inc.php");?>
<?php

if(isset($_POST['id'])){
	$id=$_POST['id'];
	$delete_Post_Query=mysqli_query($connection,"DELETE FROM posts WHERE id='$id'");
	
	echo "Your post has been deleted";
	}

?>