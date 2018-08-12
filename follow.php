<?php include("inc/connect.inc.php"); ?>

<?php 
       if(!isset($_SESSION["user_login"])){
$username="";

}else{
   $username=$_SESSION["user_login"]; 
   }


if($username){	

    if(isset($_POST['u_id'])){
	$u_id=@$_POST['u_id'];
	$user=mysqli_query($connection,"SELECT * FROM myusers WHERE id='$u_id'");
	if(mysqli_num_rows($user)==1){
		$get=mysqli_fetch_assoc($user);
		$user_follow=$get['username'];
	
	$query=mysqli_query($connection,"SELECT * FROM follow WHERE followed_to='$user_follow' && followed_by='$username' ");
	if(mysqli_num_rows($query)==1){
		
	}else{
  $insert=mysqli_query($connection,"INSERT INTO follow VALUES('','$username','$user_follow')");
  
	}
	

	}
}


  if(isset($_POST['un_id'])){
	$un_id=@$_POST['un_id'];
	$user=mysqli_query($connection,"SELECT * FROM myusers WHERE id='$un_id'");
	if(mysqli_num_rows($user)==1){
		$get=mysqli_fetch_assoc($user);
		$user_follow=$get['username'];
	
	$query=mysqli_query($connection,"SELECT * FROM follow WHERE followed_to='$user_follow' && followed_by='$username' ");
	if(mysqli_num_rows($query)==1){
		 $delete=mysqli_query($connection,"DELETE FROM follow WHERE followed_to='$user_follow' && followed_by='$username'");
  
	}else{
 
	}
	

	}
}
}


?>