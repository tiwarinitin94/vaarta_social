<?php include("inc/connect.inc.php"); ?>

<?php

     if(isset($_POST['username'])){
		 $username=$_POST['username'];
		 $username1=$_POST['username1'];
		 
		
	 }else{
		 $username="No user";
	 }
     echo $username."<br>";
 		     $add_friend_check=mysqli_query($connection,"SELECT friend_array FROM myusers WHERE username='$username'");
			 $get_friend_row=mysqli_fetch_assoc($add_friend_check);
			 $friend_array=$get_friend_row['friend_array'];
			 $friend_array_explode= explode(",",$friend_array);
			 $friend_array_count= count($friend_array_explode);
			 
			 //friend array for whom the logged in user work
			 $add_friend_check_username=mysqli_query($connection,"SELECT friend_array FROM myusers WHERE username='$username1'");
			 $get_friend_row_username=mysqli_fetch_assoc($add_friend_check_username);
			 $friend_array_username=$get_friend_row_username['friend_array'];
			 $friend_array_explode_username= explode(",",$friend_array_username);
			 $friend_array_count_username= count($friend_array_explode_username);
			 
			 $username1Comma= ",".$username1;
			 $username1Comma2= $username1.",";
			 
			 $usernameComma= ",".$username;
			 $usernameComma2= $username.",";
			 
			 //removing from other
			 if(strstr($friend_array_username,$usernameComma)){
			     $friend2=str_replace("$usernameComma","",$friend_array_username);
				  }
			 elseif(strstr($friend_array_username,$usernameComma2)){
			     $friend2=str_replace("$usernameComma2","",$friend_array_username);
				  }
			 elseif(strstr($friend_array_username,$username)){
			     $friend2=str_replace("$username","",$friend_array_username);
				  }
			 
			 
			 
			 //removing from other1
			 
			 if(strstr($friend_array,$username1Comma)){
			     $friend1=str_replace("$username1Comma","",$friend_array);
				  }
			 elseif(strstr($friend_array,$username1Comma2)){
			     $friend1=str_replace("$username1Comma2","",$friend_array);
				 }
			  
			 elseif(strstr($friend_array,$username1)){
			     $friend1=str_replace("$username1","",$friend_array);
				  }
			
			 
			
			 
			 $removeFriendQuery_username=mysqli_query($connection,"UPDATE myusers SET friend_array='$friend2' WHERE username='$username1'");
			 $removeFriendQuery=mysqli_query($connection,"UPDATE myusers SET friend_array='$friend1' WHERE username='$username'");
			
			 echo "Friend Removed";
			 
		  

	?>