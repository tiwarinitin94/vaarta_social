<?php include("./inc/header.inc.php");?>
<div id="wrapper1">
<?php
     if(isset($_GET['u'])){
  $username1=mysqli_real_escape_string($connection,$_GET['u']);
  if(ctype_alnum($username1)){
  //check if user exist or not
  $check= mysqli_query($connection,"SELECT username,first_name,last_name FROM myusers WHERE username='$username1' ");
   if(mysqli_num_rows($check)==1){
  $get=mysqli_fetch_assoc($check);
  $username1 = @$get['username'];
  $firstname= @$get['first_name'];
  $lastname= @$get['last_name'];
      
	  if(isset($_POST['submit'])){
	     $msg_body=strip_tags(@$_POST['msg_body']);
		 $date=date("y-m-d");
		 $opened="no";
		 $deleted="no";
		 
		 if($msg_body==""){
		     echo"Please enter your message it was empty";
		 }
		
		if($msg_body!=""){
		$send_msg=mysqli_query($connection,"INSERT INTO pvt_messages VALUES('','$username','$username1','$msg_body','$date','$opened','$deleted')");
	  echo "Your message has been sent";
	  }else {
	     
	  }
	  }
	  
  ECHO "
      <h3>Send message to  <span>$firstname</span></h3><br>
     <form action='send_msg.php?u=$username1' method='POST'>
	 <textarea cols='50' rows='15' name='msg_body' placeholder='Enter the message here....'></textarea><br>
      <input type='submit' name='submit' value='Send Message'>
	  </form>
  ";
 }
 }
 }
     
?>
</div>