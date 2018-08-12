<?php
include("./inc/connect.inc.php");?>

<?php
if(!isset($_SESSION["user_login"])){
$username="";

}else{
   $username=$_SESSION["user_login"]; 
   }

$id="";
$total_dislikes=0;
$uid="";
    
	

    if(isset($_POST['uid'])){
	$t_id=@$_POST['uid'];
	$get_dislikes1=mysqli_query($connection,"SELECT* FROM user_dislikes WHERE uid='$t_id' ");
	 if(mysqli_num_rows($get_dislikes1)>=1){
	$get_dislikes=mysqli_query($connection,"SELECT* FROM dislikes WHERE uid='$t_id' && username='$username'");
	  $num=mysqli_num_rows($get_dislikes);
	  if($num==1){
	  $get=mysqli_fetch_assoc($get_dislikes);
      $total_dislikes=$get['total_dislikes'];
	 
	   }else{
		   $get_dislikes_2=mysqli_query($connection,"SELECT *FROM user_dislikes WHERE uid='$t_id'");
	       $get_2=mysqli_fetch_assoc($get_dislikes_2);
	        $total_dislikes=$get_2['total_dislikes'];
			$total_dislikes++;	
		       $user_dislike=mysqli_query($connection,"UPDATE user_dislikes SET total_dislikes='$total_dislikes' WHERE uid='$t_id'");
	
	       $user_dislike_1=mysqli_query($connection,"INSERT INTO dislikes VALUES('','$username','$t_id')");
		   
	   }
	  
	}else{
		   $user_dislike=mysqli_query($connection,"INSERT INTO user_dislikes VALUES('','1','$t_id')");
	  
	       $user_dislike=mysqli_query($connection,"INSERT INTO dislikes VALUES('','$username','$t_id')");
		   echo "Lifted up";
	   }
	   }
	   
	   
	   
	   
	    if(isset($_POST['tid'])){
	$t_id=@$_POST['tid'];
     
	$get_dislikes=mysqli_query($connection,"SELECT* FROM dislikes WHERE uid='$t_id' && username='$username'");
	  $num=mysqli_num_rows($get_dislikes);
	  if($num==1){	
          $get_dislikes_2=mysqli_query($connection,"SELECT *FROM user_dislikes WHERE uid='$t_id'");	  
	     $get=mysqli_fetch_assoc($get_dislikes_2);
         $total_dislikes=$get['total_dislikes'];
	     $total_dislikes=$total_dislikes-1;	
	        
		  $user_dislike_1=mysqli_query($connection,"DELETE FROM dislikes WHERE username='$username' && uid='$t_id'");
		  $user_dislike=mysqli_query($connection,"UPDATE user_dislikes SET total_dislikes='$total_dislikes' WHERE uid='$t_id'");		  
	   

	   }
	  
	
	   }
?>
