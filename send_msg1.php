<?php include("./inc/header.inc.php");?>
<div id="mySidenav" class="sidenav">
 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
<script>

document.getElementById("logo").src="./img/v.png";

/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "180px";
 
 document.getElementById("main").style.marginLeft = "180px";

 document.getElementById("main").style.paddingLeft = "30px";
    document.getElementById("vaarta_suggestion").style.width="240px";
	document.getElementById("home_footer").style.width="225px";
	
 
}
;  
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
     document.getElementById("main").style.paddingLeft = "80px";
    document.getElementById("main").style.marginLeft = "0";
	  document.getElementById("vaarta_suggestion").style.width="250px";
	  document.getElementById("home_footer").style.width="235px";
}
</script>
<?php 
include("./button.php");?>
<center>
<img src="./img/namastey.png" style="height:80px; width:80px;margin-left:10px;"><br>
Namastey<br>
<h2 style="color:#fff;font-family:papyrus;font-weight:bold;">
<?php echo $username ?>
</h2>
</center>
 </div>
 <div id="main">
<div id="wrapper1">

<?php
   
     if(isset($_GET['u'])){
  $username1=mysqli_real_escape_string($connection,$_GET['u']);
  if(ctype_alnum($username1)){
  //check if user exist or not
  $check= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE username='$username1' ");
   if(mysqli_num_rows($check)==1){
  $get=mysqli_fetch_assoc($check);
  $username1 = @$get['username'];
  $firstname= @$get['first_name'];
  $lastname= @$get['last_name'];
  $user_two=@$get['id'];
 
    $check1= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE username='$username' ");  
	 if(mysqli_num_rows($check1)==1){
  $get1=mysqli_fetch_assoc($check1);
  $user_one=@$get1['id'];
    $q= mysqli_query($connection,"SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ") or die(mysql_error());
	    $get_u=mysqli_fetch_assoc($q);
		$cid=$get_u['c_id'];
              if(mysqli_num_rows($q)==0){
	  if(isset($_POST['submit'])){
	     $msg_body=strip_tags(@$_POST['msg_body']);
		 $time=time();
         $ip=$_SERVER['REMOTE_ADDR'];
		  if($msg_body==""){
		     echo"Message Error, please write something!".$username;
		 }else{
		
              
                 $query = mysqli_query($connection,"INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')") or die(mysql_error());
                 $q=mysqli_query($connection,"SELECT c_id FROM conversation WHERE user_one='$user_one' ORDER BY c_id DESC limit 1");
				 $results=mysqli_fetch_assoc($q);
				 $c_id=$results['c_id'];
				 if(!$c_id){echo "error";}
				$q1=mysqli_query($connection,"INSERT INTO conversation_reply (user_id_fk,reply,pics,user_two_read,ip,time,c_id_fk) VALUES ('$user_one','$msg_body','Nothing','no','$ip','$time','$c_id')") or die(mysqli_error());
    Echo "Your message has been Sent ";
				 	
	}
	}
	  
	  
	  
	  
  ECHO "
      <h3>Send message to  <span>$firstname</span></h3><br>
     <form action='send_msg1.php?u=$username1' method='POST'>
	 <textarea cols='50' rows='15' name='msg_body' placeholder='Enter the message here....'></textarea><br>
      <input type='submit' name='submit' value='Send Message'>
	  </form>
  ";
 }else{
      echo "<meta http-equiv=\"refresh\" content=\"0; url=my_messages.php?c_id=$cid\">";
 }
 }
 }
 }
} 
?>
</div></div>