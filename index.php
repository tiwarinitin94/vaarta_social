
<?php include("./inc/header.inc.php");?>
 <div id="main4">
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<style>
#wrapper{
	background-color:#000;
}
</style>
<?php
if (!isset($_SESSION["user_login"])) {
    echo "";
}
else
{
    echo "<meta http-equiv=\"refresh\" content=\"0; url=home.php\">";	
}

?>

<?php 
$reg= @$_POST['reg'];
//declaring variable for preventing from errors
$fn= ""; //FIST_NAME
$ln="";  //LAST_NAME
$un="";  //USER_NAME
$em="";  //Email
$em2=""; //EMAIL2
$pswd=""; //paswrd
$pswd2=""; //paswrd2
$d=""; //sign up and date
$u_check="";//check if username exist
$gender="";
//registration form
$fn=strip_tags(@$_POST['fname']);
$ln=strip_tags(@$_POST['lname']);
$un=strip_tags(@$_POST['username']);
$em=strip_tags(@$_POST['email']);
$em2=strip_tags(@$_POST['email2']);
$pswd=strip_tags(@$_POST['password']);
$pswd2=strip_tags(@$_POST['password2']);
$d=date("Y-m-d");
$gender = strip_tags(@$_POST['gender']);

if($reg){
 $pswd=strip_tags(@$_POST['password']);			

if($em==$em2){//checking if usernames are identical
$u_check = mysqli_query($connection,"SELECT username FROM  myusers WHERE username ='$un'");
//counting the rows where usrname=$un
$check=mysqli_num_rows($u_check);
$e_check = mysqli_query($connection,"SELECT email FROM myusers WHERE email='$em'");
//Count the number of rows returned
$email_check = mysqli_num_rows($e_check);
if($check==0){//check if all filled in 
     if($email_check==0){
if($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2&&$gender){
     if((preg_match("/^[A-Za-z0-9]*$/",$un))){
	if($pswd==$pswd2){//checking the maximum
	if(strlen($un)>25||strlen($fn)>25||strlen($ln)>25){
	echo "<center><div id='error'>Maximum lenth of username or First name or Last name are 25 only</div>";
	}
	
else{
//checking the maximum and minimum lenth of password
if(strlen($pswd)>30||strlen($pswd)<5){
echo "<center><div id='error'>Your password is too small or too big</div>";
}
else{//encrypting the password using md5
$pswd=md5($pswd);
$pswd2=md5($pswd2);
$query =mysqli_query($connection,"INSERT INTO myusers VALUES ('', '$un','$fn','$ln','$em','$pswd','$d','0','Write Something about yourself','','','','$gender','no','no')");
if(!$query){
echo "<center><div id='error'>problem with sign up</div></center>";

exit();
}
die("<center><div  id='error'><h3 >Welcome to VAARTA </h3><br><h2><a href='index.php' onmousehover('text-decoration:underline;')style='text-decoration:none;color'>Log in</a> to your account to Start VAARTA laap</h2></div></center>");
}
}
}
else{
  echo "<center><div id='error''>Password did't matched </div></center>";

  }
  }else{
   echo "<center><div id='error'> You cannot use special character in username, or leave space</div></center>";

  
  }
  }
  else{
  echo "<center><div id='error'>Fill in the all fields</div></center><script> alert('Keep your focus on what you are doing, Fill all fields');</script>";
  }
  }
  else{
    echo"<center><div id='error'>Email already registered</div></center>";
  }
  }
  else{
  echo "<center><div id='error'>Username already taken</div></center>";
  }
  }
  else{
  echo "<center><div id='error'>Email didn't match</div></center>";
  }
  }
  ?>
 <?php 
  //user log in codes SIGN in
  if(isset($_POST["user_login"])&&isset($_POST["password_login"])){
  $user_login=preg_replace('#[^A-Za-z0-9]#i','',$_POST["user_login"]);//filter everything but numbers or letters. 
  $password_login=$_POST["password_login"]	;
  $password_login_md5=md5($password_login);
  $sql=mysqli_query($connection,"SELECT id FROM myusers WHERE username ='$user_login' AND password ='$password_login_md5' AND closed='no' LIMIT 1");//query
  //check for their existance
  $userCount =mysqli_num_rows($sql);//count the number of rows return
   if($userCount==1){
   while($rows=mysqli_fetch_array($sql)){
     $id=$rows["id"];
   }
  
    $_SESSION["id"] = $id;
		 $_SESSION["user_login"] = $user_login;
		 $_SESSION["password_login"] = $password_login;
?>
<script>
 $("#main4").load("welcome.php");	
</script>
<?php

   exit();
   }else{
   echo '<center>
         <div id="sign_in">
		<div id="login_error">Your login Incorrect try again!</div><br>
		   <form action="index.php" method="POST"style="margin-left:55px;margin-top:40px;">
		    <input type="text" name="user_login" size="25" autofocus placeholder="Username" style="color:#000;"/><p/>
			  <span><input type="password" name="password_login" size="25" placeholder="Password"/><p/></span>
			  <input type="submit" name="login" value="Sign In" style="margin-left:130px;margin-top:10px;"/>
		   </form>
		   <a href="forgot.php" style="text-decoration:none;font-size:10px;">Forgot password</a> 
		   </div></center>'
		 ; echo" <div style='position:absolute;top:580px;width:100%'>";
                  include("./inc/footer.inc.php"); echo '</div>';
   exit();
   }
   } 
?> 
      <ul class="cb-slideshow" style="z-index:-5;">
            <li><span>Image 01</span><div><h2>Number1</h2></div></li>
            <li><span>Image 02</span><div><h2>Number1</h2></div></li>
            <li><span>Image 03</span><div><h2>Number1</h2></div></li>
            <li><span>Image 04</span><div><h2>Number1</h2></div></li>
            <li><span>Image 05</span><div><h2>Number1</h2></div></li>
            <li><span>Image 06</span><div><h2>Number1</h2></div></li>
        </ul>         
     <div class="wrapper_home">	    


 <div id="signup_circle"  >
			<center>
          <h3 style="margin-top:10px;color:#fff;">Sign_up </h3>
		   	   <form action="index.php" method="POST" style="margin-top:10px;">
		      <input id="fn" type="text" name="fname" size="25" placeholder="First Name"/><p>
			  <input id="ln" type="text" name="lname" size="25" placeholder="Last Name"/><p>
                            <div class="tooltip"><input id="un" type="text" name="username" size="25" placeholder="User Name"/><p>
                          <span class="tooltiptext">Select username without special char(@,#,$,%,^,&,*,.) & use lower case only</span>
                                                                     </div><br>
			  <div class="tooltip_em"> <input id="em" type="email" name="email" size="25" placeholder="Enter your email"/><p>
                                  <span class="tooltiptext_em">Enter your valid email id</span>
                                                                     </div><br>			
			 <div class="tooltip_em2"><input  type="email" name="email2" size="25" placeholder="Re-Enter Email"/><p>
                                 <span class="tooltiptext_em2">Enter your valid email again</span>
                                                                     </div><br>
			<div class="tooltip_pswd"><input type="password" name="password" size="25" placeholder="Enter your password"/><p>
			    <span class="tooltiptext_pswd">Enter a strong password</span>
                                                                     </div><br>
 <div class="tooltip_pswd2">
			  <input type="password" name="password2" size="25" placeholder="Re-Enter Password"/>
        <span class="tooltiptext_pswd2">Enter same password again</span>
                                                                  </div><br> <br>
          		
													  
																  Female<input type="radio" name="gender" value="female" style="width:20px;">
                                                    Male<input type="radio" name="gender" value="male" style="width:20px;"><br>
			  <input type="submit" name="reg" value="Sign Up" style="margin-top:10px;"/>
			  </form>
			  </center>
         </div>
      
  <button id="myBtn">Sign_in</button><br>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
     
        <span class="close">x</span>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script> 
            
	        <center>
		<h3 style="color:#fff;width:100%; background-color:rgb(20,120,220);padding:10px 0px 10px 0px;font-weight:bold;font-size:15px;text-align:center;">If already a member sign in</h3>
		   <form action="index.php" method="POST" style="margin-top:20px;padding:20px;">
		    <input type="text" name="user_login"  autofocus placeholder="Username"/><p/>
			  <span><input type="password" name="password_login"  placeholder="Password"/><p/></span>
			  <input type="submit" name="login" value="Sign In" style="margin-left:5px;width:195px;border-radius:0px;box-shadow:none;border:.5px solid #fff;background-color:rgb(20,120,220);color:#fff; padding:8px;"/>
		   </form>
		  </center>
             <a href="forgot.php" style="text-decoration:none;font-size:10px;margin-left:20px;">Forgot password ?</a>
     </div>

</div>
     <div id="welcm_spch">
      <h3 style="font-weight:bold;font-family:helvetica;color:#fff;font-size:28px; text-shadow:1px 1px 1px #000;">Swagatam, welcome</h3><br>
      <h2 style="color:#fff;font-weight:bold;font-size:24px; text-shadow:.4px .4px .4px #000;"> Create your account</h2><br>
    <h2 style="color:#fff; font-size:22px;text-shadow:.1px .1px 1px #000;">Spread some magic by words</h2>
  

   
</div>
		   
		 
		    
			
		</div>
		
		
		
<?php include("./inc/footer.inc.php");?>

</div>