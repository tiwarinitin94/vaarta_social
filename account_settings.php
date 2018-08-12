<?php include("./inc/header.inc.php");?>
<style>

#wrapper{
    background-color: rgb(40,200,40);
	 
	}
</style>
<?php
if($username){

}
else{
die("Please log into your account");
}
?>

<script>
/* Set the width of the side navigation to 250px */
document.getElementById("logo").src="./img/v.png";
</script>

<link rel="stylesheet" type="text/css" href= "./css/nav.css"/>
<div id="main">
<div id="wrapper1">
<?php
 $senddata=@$_POST['senddata'];
 $send_bio=@$_POST['send_bio'];
 //Variables for password
 $old_password=@$_POST['oldpassword'];
 $new_password=@$_POST['newpassword'];
 $repeat_password=@$_POST['newpassword2'];
 if($senddata){
    //if the form is submitted
	$password_query=mysqli_query($connection,"SELECT *from myusers where username='$username'");
	while($row= mysqli_fetch_assoc($password_query)){
	    $db_password=@$row['password'];
		/*$ps= md5("tripathi");
		echo "'$ps'";*/
		//checking if the password matched or not
		if(md5($old_password)==$db_password){
		
		//check if the password correct
		if($new_password==$repeat_password){
		 
		  $new_password_md5= md5($new_password);
		  $update_password_query=mysqli_query($connection,"UPDATE myusers SET password='$new_password_md5' WHERE username='$username'");
		  
		  echo "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Your password has been successfully updated.</div>";
		}
		else{
		 echo"<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Password Didn't matched.</div>";
		 
		}
		}
		else{
		echo"<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Please check the old password you have entered.</div>";
		}
	}
 }
 else{
   echo "";
   }
   //getting info
   $get_info=mysqli_query($connection,"SELECT first_name, last_name ,bio FROM myusers WHERE username='$username'");
   $get_row=mysqli_fetch_assoc($get_info);
   $db_firstname= $get_row['first_name'];
   $db_last_name=$get_row['last_name'];
   $db_bio=$get_row['bio'];
   $send_data=@$_POST['send_data'];
   if($send_data){
     $firstname=@$_POST['fname'];
	 $lastname=@$_POST['lname'];
	 $bio=@$_POST['aboutyou'];
	 if(strlen($firstname)>18){
	     echo "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Too long, Your first name must be less than 18 character, use your brain.</div>";
	 }elseif(strlen($bio)>120){
	     echo "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Too long, You need to be brief, use your brain, less than 120 char.</div>";
	 }else{
	 $info_submit_query=mysqli_query($connection,"UPDATE myusers SET first_name='$firstname', last_name='$lastname', bio='$bio' WHERE username='$username'");
       
	 echo "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Your account info has been updated.</div>";
	 }
   }
   else{
   
   }
   //check if there is Bio 
   $check_bio=mysqli_query($connection,"SELECT *FROM info_users WHERE user_id='$global_id'");
   $numrows_bio=mysqli_num_rows($check_bio);
   $DOB="";
   $audaa="";
   $karma="";
   $fav_quote="";
   $said_by="";
   $country="";
   $signature_pic="";
   if($numrows_bio!=0){
        $info_bio=mysqli_fetch_assoc($check_bio);
		$country=$info_bio['country'];
		$DOB=$info_bio['dob'];
		$audaa=$info_bio['designation'];
		$karma=$info_bio['hobby'];
		$fav_quote=$info_bio['fav_quote'];
		$said_by=$info_bio['said_by'];
        $signature_pic=$info_bio['signature'];
   }
     // Update Bio
    if($send_bio){
	//Checking there is already
	 $check_bio_again=mysqli_query($connection,"SELECT *FROM info_users WHERE user_id='$global_id'");
   $numrows_bio_again=mysqli_num_rows($check_bio_again);   
   if($numrows_bio_again!=0){
         $country=@$_POST['nation'];
  		 $DOB=@$_POST['dob'];
	    $audaa=@$_POST['audaa'];
	    $karma=@$_POST['karma'];
	   $fav_quote=@$_POST['quote'];
	     $said_by=@$_POST['said_by'];
     if(strlen($fav_quote)<150){		 
   $info_submit_query=mysqli_query($connection,"UPDATE info_users SET country='$country',dob='$DOB', designation='$audaa',hobby='$karma', fav_quote='$fav_quote',said_by='$said_by' WHERE user_id='$global_id'");
	echo  "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Your account info has been updated.</div>";
	
	}else{
	    echo"<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Long one you need less than 150 characters.</div>";
	
	}
	}
	 else{
	 $country=@$_POST['nation'];
     $DOB=@$_POST['dob'];
	 $audaa=@$_POST['audaa'];
	 $karma=@$_POST['karma'];
	 $fav_quote=@$_POST['quote'];
	  $said_by=@$_POST['said_by'];
	  
	 
	  if(strlen($fav_quote)<50){
	 $info_submit_query=mysqli_query($connection,"INSERT INTO info_users VALUES('','$global_id','$country','$DOB','$audaa','$karma','$fav_quote','$said_by','','')");
	 echo "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Your account info has been updated.</div>";
	} else{
	    echo"<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Long one you need less than 50 characters.</div>";
	
	}
	 }
   }
    //Check whether the user has uploaded a sign pic or not
	 $check_pic_sign = mysqli_query($connection,"SELECT signature FROM info_users WHERE user_id='$global_id'");
    $get_pic_row_sign = mysqli_fetch_assoc($check_pic_sign);
  $sign_pic_db = $get_pic_row_sign['signature'];
  if ($sign_pic_db == "") {
  $sign_pic = "img/vaarta.png";
  }
  else
  {
  $sign_pic = "userdata/data_pics/".$sign_pic_db;
  }
   
   
    // uploading signature
	 if(isset($_FILES['signaturepic'])){
     if (((@$_FILES["signaturepic"]["type"]=="image/jpeg") || (@$_FILES["signaturepic"]["type"]=="image/png") || (@$_FILES["signaturepic"]["type"]=="image/gif")||(@$_FILES["signaturepic"]["type"]=="image/jpg")||(@$_FILES["signaturepic"]["type"]=="image/png")||(@$_FILES["signaturepic"]["type"]=="image/bmp")) &&(@$_FILES["signaturepic"]["size"] < 1048576)){
	          $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			  $rand_dir_name = substr(str_shuffle($chars), 0, 15);
			  if(!mkdir("userdata/data_pics/$rand_dir_name")){
			     echo "Cannot make directory";
			  }
			 
                    
			  if (file_exists("userdata/data_pics/$rand_dir_name/".@$_FILES["signaturepic"]["name"])){
                 echo @$_FILES["signaturepic"]["name"]." Already exists";
   }
    else
   {
      $temp = explode(".", $_FILES["signaturepic"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file(@$_FILES["signaturepic"]["tmp_name"],"userdata/data_pics/$rand_dir_name/".$newfilename);
	
     $signature_pic_name = @$newfilename;
    $signature_pic_query = mysqli_query($connection,"UPDATE info_users SET signature='$rand_dir_name/$signature_pic_name' WHERE user_id='$global_id'");

   echo "<meta http-equiv=\"refresh\" content=\"0; url=account_settings.php\">";
    
   }
  }
  else
  {
      echo "Invailid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
  }
   }
    //Check whether the user has uploaded a profile pic or not
 $check_pic = mysqli_query($connection,"SELECT profile_pic FROM myusers WHERE username='$username'");
  $get_pic_row = mysqli_fetch_assoc($check_pic);
  $profile_pic_db = $get_pic_row['profile_pic'];
  if ($profile_pic_db == "") {
  $profile_pic = "img/default-pic.png";
  }
  else
  {
  $profile_pic = "userdata/profile_pics/".$profile_pic_db;
  }
   //uploading profile image
   if(isset($_FILES['profilepic'])){
     if (((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif")||(@$_FILES["profilepic"]["type"]=="image/jpg")||(@$_FILES["profilepic"]["type"]=="image/png"))&&(@$_FILES["profilepic"]["size"] < 1048576)){
	          $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			  $rand_dir_name = substr(str_shuffle($chars), 0, 15);
			  if(!mkdir("userdata/profile_pics/$rand_dir_name")){
			     echo "Cannot make directory";
			  }
			 
                    
			  if (file_exists("userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"])){
                 echo @$_FILES["profilepic"]["name"]." Already exists";
   }
    else
   {
      $temp = explode(".", $_FILES["profilepic"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"userdata/profile_pics/$rand_dir_name/".$newfilename);
	
     $profile_pic_name = @$newfilename;
    $profile_pic_query = mysqli_query($connection,"UPDATE myusers SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE username='$username'");
     $date_added = date("Y-m-d");
    $added_by = $username;
    $user_posted_to = $username;
	 $sqlCommand = "INSERT INTO posts VALUES('','$username has changed profile pic','$date_added','$added_by','$user_posted_to','$rand_dir_name/$profile_pic_name','')";  
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());
   $sqlCommand1 = "INSERT INTO albums VALUES('','$username','$rand_dir_name/$profile_pic_name','','')";  
   $query1 = mysqli_query($connection,$sqlCommand1) or die (mysqli_error());
   echo "<meta http-equiv=\"refresh\" content=\"0; url=account_settings.php\">";
    
   }
  }
  else
  {
      echo "Invailid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
  }
   }
?>


  <nav class="menu">
        <ul class="clearfix">  
<!-------------------------------------profile pic uploading------------------->		
       <li> <a href="#">Upload Your Profile pic |</a> 
                <ul class="sub-menu">
                   <div class="heading_type" style="margin-left:10px;"> 
                 
              <h3>Upload your Avtar here</h3><br/>
               <form action="" method="POST" enctype="multipart/form-data">
               <img src="<?php echo $profile_pic; ?>" width="70" style="border-radius:50%;" />
               <input type="file" name="profilepic" accept="image/*" style="background-color:#fff;"/><br/><br/>
              <input type="submit" name="uploadpic" value="Upload Image"/><br/>
                   </form>
                 
                    </div>
                </ul>				 
            </li>
<!-------------------------------------Change your password------------------->
			<li> <a href="#"> |  Change your password</a> 
                    <ul class="sub-menu">
					  <div class="heading_type" style="padding-right:10px;"> 
                   <h3 style="margin-left:30px;"><span> Change your password</span></h3><br>
                   <form action="account_settings.php" method="post">
                  <pre>
        Enter your old Password :<input type="password" name="oldpassword" id="oldpassword"size="40"placeholder="Old Password"></input><br><br>
        Enter -New - Password   : <input type="password" name="newpassword" id="newpassword"size="40" placeholder="New Password"></input><br><br>
        Re -Enter New Password :<input type="password" name="newpassword2" id="newpassword2"size="40"placeholder="Re- Enter Password"></input><br><br>
                 
                  <input type="submit" name="senddata" id="senddata" value="Save password">
				  </pre>
                     </form></div>
                </ul>
               </li>  
		<!-------------------------------------Change your Bio------------------->	   
			<li> <a href="#"> |Edit your Info|</a> 
                    <ul class="sub-menu">
					  <div class="heading_type" style="padding-right:10px;"> 
                   <h3 style=""><span> Edit your Info</span></h3><br>
                             
				 <form action="account_settings.php" method="post" style="margin-bottom:10px;">
           First name :<input type="text" name="fname" id="fname"size="40"  value="<?php echo "$db_firstname";?>" ></input><br>
           Last name  : <input type="text" name="lname" id="lname"size="40"  value="<?php echo "$db_last_name";?>"></input><br><br>
           Enter quote:<br><input type="text" style="height:50px; width:400px;" name="aboutyou" id="aboutyou" placeholder="Describe yourself in just 80 characters" value="<?php echo "$db_bio";?>" onclick="value=''"></textarea>

<input type="submit" name="send_data" id="send_data" value="Update Bio">
</form></div>
                </ul>
               </li> 
			   
			   <!-------------------------------------Close your account------------------->	   
			<li> <a href="#"> |Close your account|</a> 
                    <ul class="sub-menu">
					  <div class="heading_type" style="padding-right:10px;"> 
                   <h3 style="margin-left:20px;"><span> Close your account</span></h3><br>
                   <form action="close_account.php" method="post" style="margin-bottom:10px;">
                     <img src="<?php echo $profile_pic; ?>" width="120px" height="120px"style="margin-left:20px;border-radius:50%;" /><br><br>
                          Closing your account will cause you will not be able to sign in ever again with same account.<br>		  
						  
						  <input type="submit" name="close_account" id="close_account" value="Close account"> <br><br>
						 </form>
						 <?php
						 $check_deactivation=mysqli_query($connection,"SELECT deactivate FROM myusers WHERE username='$username'");
						 $deactivation=mysqli_fetch_assoc($check_deactivation);
						 $check=$deactivation['deactivate'];
						 if($check=='yes'){
						    echo '<form action="deactivate.php?q=a" method="post" style="margin-bottom:10px;">
						  You can activate your account again from here.<br>
						  <input type="submit" name="deactivate" id="deactivate" value="Activate">
                </form>';
						 }else{
						 echo '<form action="deactivate.php?q=d" method="post" style="margin-bottom:10px;">
						  By deactivating you can take rest and come back again.<br>
						  <input type="submit" name="deactivate" id="deactivate" value="Deactivate">
                </form>';
						 }
						 ?>
						 </div>
                </ul>
               </li> 
             </ul>
    </nav>



<br>
<div class="settings"  style="margin-top:70px; margin-left:80px;text-shadow:4px 5px 6px rgba(4,4,4,0.6);color:black;font-style:Papyrus;paddin-bottom:60px; ">
<br>
<h3><span>Edit your info</span></h3><br>
<form action="account_settings.php" method="post" style="margin-bottom:10px;">
<pre>     
                     Nationality:   <input type="text" style="background-color:#fff;" name="nation" id="nation"size="40" value="<?php echo $country; ?>"   title="Enter you nationality " placeholder="Enter you nationality " ></input><br> 
            DOB :   <input type="Date" style="background-color:#fff;" name="dob" id="dob"size="40" value="<?php echo $DOB; ?>"   title="Enter you Birth Date" ></input><br> 
                         Designation:   <input type="text" name="audaa" id="audaa"size="40"  value="<?php echo $audaa; ?>" placeholder="Enter you've achieved or about to...." ></input><br>
          Hobbys:    <input type="text" style="background-color:#fff;" name="karma" id="karma"size="40"  value="<?php echo $karma; ?>" placeholder="Write what you like" ></input><br> 
                                  Update status:  <input type="text" style="background-color:#fff;" name="quote" id="quote" size="60"  value="<?php echo $fav_quote; ?>" placeholder="Write what inspire you in 50 characters " ></input>
                                                                      Said By:  <input type="text" style="background-color:#fff;" name="said_by" id="said_by"size="15"  value="<?php echo $said_by; ?>" placeholder="Write who inspire you " ></input><br>
            	<input type="submit" name="send_bio" id="send_bio" value="Update Bio">
						 </pre></form>
						  <!--------------------------signature image----------------------------------------->
						  <center>
						  <form action="" method="POST" enctype="multipart/form-data" style="padding:40px;">						
						Upload your signature image:<img src="<?php echo $sign_pic; ?>" width="70" style="border-radius:50%;"  /> <input type="file" name="signaturepic" value="<?php echo $signature_pic; ?>"accept="image/*"style="background-color:#fff;"/><br> <br>
				             <input type="submit" name="uploadpic" value="Upload Image"/><br/>
                   </form>
				   </center>
		  </div>
</div>
</div>


