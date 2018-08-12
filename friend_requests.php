<?php include("./inc/header.inc.php");?>

<?php 
if(!$username){
?><script>
alert("You think you cool thats your bhool you fool, :P");
</script>
<?php
exit();
}
?>
<style>
.header20{
    background-color: rgb(700,700,700);
	 
	}
#menu a{
	color:rgba(50,50,50,.6);
}
</style>

<div id="main">
<div id="wrapper1">
 <div style='padding:5px;margin-right:20px;text-align:center;margin-top:20px;color:#717171;background-color:rgba(20,120,220,1);-moz-box-shadow:1px 1px 1px 1px ;box-shadow:1px 1px 1px #000;font-style:papyrus;font-size:22px;color:#fff;'>Your requests </div>
		
<?php
//findin the requests
//echo $username;
$friend_requests=mysqli_query($connection,"SELECT* FROM friend_requests WHERE user_to='$username'");
$numrows= mysqli_num_rows($friend_requests);
if($numrows==0){
echo" <div style='opacity:.4;padding:5px;text-align:center;width:100%;margin-top:20px;color:#000; font-style:papyrus;font-size:15px;'>You don't have any friend Request .</div>";
		
$user_from="";
}
else{
   while($get_row=mysqli_fetch_assoc($friend_requests)){
      $id= $get_row['id'];
	   $user_to= $get_row['user_to'];
	    $user_from= $get_row['user_from'];
		$get_user_info = mysqli_query($connection,"SELECT * FROM myusers WHERE username='$user_from'");
                                                $get_info = mysqli_fetch_assoc($get_user_info);
											    $profilepic_info = $get_info['profile_pic'];
                                                if ($profilepic_info == "") {
                                                 $profilepic_info = "img/default-pic.png";
                                                }
                                                else
                                                {
                                                 $profilepic_info = "./userdata/profile_pics/".$profilepic_info;
                                                }
	  echo "<div style='width:500px;float:left;margin-left:30px;'><div id='post-image_2' style='float: left;padding:8px; '>
                                                <img src='$profilepic_info' height='100' width='100'style='border-radius:50%;'>
                                                </div><div style='box-shadow:4px 4px 4px rgba(4,4,4,0.6);margin-left:65px;margin-top:15px;padding:30px;font-family:papyrus;font-weight:bold;background-color:#769DD3;width:auto;height:50px;'><a href='$user_from' style='margin-left:10px;text-decoration:none; color:#fff; font-family:papyrus;'>$user_from</a> wants to be your friend<br>";  
	  
   ?>
  
<?php 

   if(isset($_POST['acceptrequest'.$user_from])){
     //insertion in frinds array
	 //Get friend array for logged in user
	 $get_friend_check=mysqli_query($connection, "SELECT friend_array FROM myusers WHERE username ='$username'");
	 $get_friend_row=mysqli_fetch_assoc($get_friend_check);
	 $friend_array=$get_friend_row['friend_array'];
	 $friendArray_explode=explode(",",$friend_array);
	 $friendArray_count=count($friendArray_explode);
	 
	 //get the array for the list of requests
	 $get_friend_check_friend=mysqli_query($connection,"SELECT friend_array FROM myusers WHERE username ='$user_from'");
	 $get_friend_row_friend=mysqli_fetch_assoc($get_friend_check_friend);
	 $friend_array_friend=$get_friend_row_friend['friend_array'];
     $friendArray_explode_friend=explode(",",$friend_array_friend);
	 $friendArray_count_friend=count($friendArray_explode_friend);	

      if($friend_array ==""){
         $friendArray_count	=count(NULL);   
		 }
		 if($friend_array_friend ==""){
         $friendArray_count_friend	=count(NULL);   
		 }
		 if($friendArray_count==NULL){
		     $add_friend_query=mysqli_query($connection,"UPDATE myusers SET friend_array=CONCAT(friend_array,'$user_from') WHERE username='$username'");
		 }
		  if($friendArray_count_friend==NULL){
		     $add_friend_query=mysqli_query($connection,"UPDATE myusers SET friend_array=CONCAT(friend_array,'$user_to') WHERE username='$user_from'");
		 }
		  if($friendArray_count>=1){
		     $add_friend_query=mysqli_query($connection,"UPDATE myusers SET friend_array=CONCAT(friend_array,',$user_from') WHERE username='$username'");
		 }
		 if($friendArray_count_friend>=1){
		     $add_friend_query=mysqli_query($connection,"UPDATE myusers SET friend_array=CONCAT(friend_array,',$user_to') WHERE username='$user_from'");
		 }
		 $delete_request=mysqli_query($connection,"DELETE FROM friend_requests WHERE user_to='$user_to'&& user_from='$user_from'");
		 
		 echo"Now you are friend with $user_from";
		     echo "<meta http-equiv=\"refresh\" content=\"0; url=friend_requests.php\">";
		 }
		 
		 
		 
		 if (isset($_POST['deleterequest'.$user_from])){
		     $ignore_request=mysqli_query($connection,"DELETE FROM friend_requests WHERE user_to='$user_to'&& user_from='$user_from'");		 
		      echo"You ignored $user_from's request";
		       echo "<meta http-equiv=\"refresh\" content=\"0; url=friend_requests.php\">";
		 }
   
?>


<form action="friend_requests.php" method="POST" style="padding-left:20px;margin-left:30px;">
<input type="submit" name="acceptrequest<?php echo $user_from?>" value="Accept Request"/>
<input type="submit" name="deleterequest<?php echo $user_from?>" value="Ignore Request"/>
</form>
</div>
</div>

<?php
}
}
?>
</div>
</div>