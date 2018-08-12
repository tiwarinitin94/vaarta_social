<?php include("./inc/header.inc.php");?>


<?php
   	$user="";

 if(isset($_POST["senddata"])) {
      $user_db=@$_POST['user_log'];
    
      $new_password=@$_POST['newpassword'];
      $repeat_password=@$_POST['newpassword2'];

	   
		
		
		//check if the password correct
		if($new_password==$repeat_password){
		
		  $new_password_md5= md5($new_password);
		  $update_password_query=mysqli_query($connection,"UPDATE myusers SET password='$new_password_md5' WHERE username='$user_db'");
		 if($update_password_query){
		  echo "<center><div style='padding:5px;width:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Your password has been successfully updated. Please <a href='index.php' style='color:#fff;font-size:15px;font-weight:bold;'>Log in</a></div></center>";
die();
}else{

    echo "Problem";
}
		}
		else{
		 echo"<center><div style='padding:5px;width:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Password Didn't matched.</div></center>";
		 
		}
		}
		
 else{
   echo "";
   }




//matchin the numbers
 if(isset($_POST["submit_match"])) {
    $user_input=$_POST["match"];
     $text_match=$_POST["text_match"];
    $user_log=$_POST["user_log"];
    if($user_input==$text_match){
      
      echo ' <center><h3 > Change your password</h3><br>
 <form action="forgot.php" method="post" style="border:1px solid silver;padding:20px;width:400px;margin-top:100px;font-size:15px;background-color:#fff;color:#797979;">                
        
        Enter -New - Password   : <input type="password" name="newpassword" id="newpassword"size="40" placeholder="New Password"></input><br><br>
        Re -Enter New Password :<input type="password" name="newpassword2" id="newpassword2"size="40"placeholder="Re- Enter Password"></input>
        <input type="text" name="user_log" id="user_log" value='.$user_log.' style="visibility:hidden"><br><br>                 
                  <input type="submit" name="senddata" id="senddata" value="Save password">
				 
                     </form></center>'; DIE();

}else{
        
     echo "<center><div style='border:1px solid silver;padding:10px;margin-top:80px;width:200px;align:center;background-color:#fff;font-size:18px;'>The key was Wrong Please try again!</div></center>";
}


}
    
  //  $message=$_POST["message"];
  if(isset($_POST["submit"])) {
  
    $user=$_POST["user"];
	$userEmail=$_POST["userEmail"];
  
  $query_check=mysqli_query($connection,"SELECT *FROM myusers WHERE username='$user' && email='$userEmail' ");
   if((mysqli_num_rows($query_check))==1){
	   $recipient=$userEmail;
	   $subject= "Password change in Vaarta";
	   $sender= "Vaarta";
	    $message=  mt_rand(100000, 999999);
           $senderEmail="tiwarinitin94@gmail.com";
		$mailBody="Name: $sender\nEmail: $senderEmail\n\n$message";
	     mail($recipient, $subject, $mailBody, "From: $sender <tiwarinitin94@gmail.com>");
		  echo "<center><div style='border:1px solid silver;padding:10px;margin-top:80px;width:200px;align:center;background-color:#fff;font-size:18px;'>We have sent you a message</div>

<form method='POST' action='forgot.php' style='border:1px solid silver;padding:20px;width:400px;margin-top:100px;font-size:15px;background-color:#fff;color:#797979;'>
                     <input type='text' name='match' id='match' placeholder='Enter the numbers we have send you on email' style='color:#000000; background-color:#fff;'><br>
                        <input type='text' name='text_match' id='text_match' value='$message' style='visibility:hidden'>
                         <input type='text' name='user_log' id='user_log' value='$user' style='visibility:hidden'>
                      <input type='submit' name='submit_match'>
                      </form>



</center>";
                      
		Die();
	   }else{
			  echo "<center><div style='border:1px solid silver;padding:10px;margin-top:80px;width:200px;align:center;background-color:#fff;font-size:18px;'>Username and email did not matched</div></center>";
			 }
  }
?>

<link rel="stylesheet" type="text/css" href= "./css/style.css"/>

 <center >
    <form method="post" action="forgot.php" style="border:1px solid silver;padding:20px;width:400px;margin-top:100px;font-size:15px;background-color:#fff;color:#797979;">
          <input type="text" name="user" placeholder="Enter username" style="color:#000000; background-color:#fff;"><br><br>
          <input type="email"name="userEmail" placeholder="Enter email"style="color:#000000; background-color:#fff;"><br><br>
     	   <input type="submit" name="submit">
    </form>
	</center>
	

 

  


<div style='position:absolute;top:580px;width:100%;'>
<?php include("./inc/footer.inc.php");?></div>