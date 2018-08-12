<link rel="stylesheet" type="text/css" href= "./css/style.css"/>
<style>
input[type="submit"]{
 height:15px;
 font-size:10px;
 line-height:10px;
 
}
</style>
<?php
include("./inc/connect.inc.php");
session_start();
if(!isset($_SESSION["user_login"])){
$username="";
echo"You should not be here";
}else{
   $username=$_SESSION["user_login"]; 

 $deleting_id="";

if(isset($_GET['comment_id'])){
       $deleting_id=mysqli_real_escape_string($connection,$_GET['comment_id']);
	  }
	  if(isset($_GET['post_id'])){
   $post_id=mysqli_real_escape_string($connection,$_GET['post_id']);
       
	  }
	  
	  if(isset($_POST['deleting_id'])){
	  $delete_Post_Query=mysqli_query($connection,"DELETE FROM suchana WHERE id='$post_id'");
	  echo "<meta http-equiv=\"refresh\" content=\"0; url=suchana.php\">";
	     
	  
	  }
	  
	  if(isset($_POST['deleting_id'])){
	      $delete_Post_Query=mysqli_query($connection,"DELETE FROM post_comments WHERE id='$deleting_id'");
	  echo "<meta http-equiv=\"refresh\" content=\"0; url=delete_button.php\">";
	  
	  }
			}   
			   			




?>
<form action="delete_button.php?comment_id=<?php echo $deleting_id; ?>" method="POST" style="background-color:#fff;">
<input type="submit" name="deleting_id" value="Delete" />
</form>

