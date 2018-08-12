<?php
include("./inc/connect.inc.php");?>

<?php
if(!isset($_SESSION["user_login"])){
$username="";

}else{
   $username=$_SESSION["user_login"]; 
   }

 
$id="";
$total_likes=0;
$uid="";
    
if($username){	

    if(isset($_POST['uid'])){ 
	$t_id=@$_POST['uid'];
	$get_likes1=mysqli_query($connection,"SELECT* FROM user_likes WHERE uid='$t_id' ");
	 if(mysqli_num_rows($get_likes1)>=1){
	$get_likes=mysqli_query($connection,"SELECT* FROM likes WHERE uid='$t_id' && username='$username'");
	  $num=mysqli_num_rows($get_likes);
	  if($num==1){
	  $get=mysqli_fetch_assoc($get_likes);
      //$total_likes=$get['total_likes'];
	 
	   }else{
		   $get_likes_2=mysqli_query($connection,"SELECT *FROM user_likes WHERE uid='$t_id'");
	       $get_2=mysqli_fetch_assoc($get_likes_2);
	        $total_likes=$get_2['total_likes'];
			$total_likes++;	
		       $user_like=mysqli_query($connection,"UPDATE user_likes SET total_likes='$total_likes' WHERE uid='$t_id'");
	
	       $user_like_1=mysqli_query($connection,"INSERT INTO likes VALUES('','$username','$t_id')");
		   echo "Lifted up";
	   }
	  
	}else{
		   $user_like=mysqli_query($connection,"INSERT INTO user_likes VALUES('','1','$t_id')");
	  
	       $user_like=mysqli_query($connection,"INSERT INTO likes VALUES('','$username','$t_id')");
		   echo "Lifted up";
	   }
	   }
	   
	   
	   
	   
	    if(isset($_POST['tid'])){
	$t_id=@$_POST['tid'];
     
	$get_likes=mysqli_query($connection,"SELECT* FROM likes WHERE uid='$t_id' && username='$username'");
	  $num=mysqli_num_rows($get_likes);
	  if($num==1){	
          $get_likes_2=mysqli_query($connection,"SELECT *FROM user_likes WHERE uid='$t_id'");	  
	     $get=mysqli_fetch_assoc($get_likes_2);
         $total_likes=$get['total_likes'];
	     $total_likes=$total_likes-1;	
	        
		  $user_like_1=mysqli_query($connection,"DELETE FROM likes WHERE username='$username' && uid='$t_id'");
		  $user_like=mysqli_query($connection,"UPDATE user_likes SET total_likes='$total_likes' WHERE uid='$t_id'");		  
	   
	 echo "Lift up";
	   }
	  
	
	   }
}else{
	echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
}
?>
