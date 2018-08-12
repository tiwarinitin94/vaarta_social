<?php include("inc/connect.inc.php"); ?>

<?php 
    if(isset($_POST['uid'])){
     $uid=$_POST['uid'];
 $get_likes=mysqli_query($connection,"SELECT* FROM likes WHERE uid='$uid' && username='$username'");
	  $num=mysqli_num_rows($get_likes);
	  
	  echo $num;
	}

?>