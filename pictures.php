<?php include("./inc/header.inc.php");?>
<div align="top-left" style="position:absolute;"> <?php include("./button.php");?></div>
<body>
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
          
   echo "<meta http-equiv=\"refresh\" content=\"0; url=welcome.php\">";
   }
   }
   
if(!$username){


 echo '<center>
         <div id="sign_in">
		<div id="login_error">Please log in first!</div><br>
		   <form action="index.php" method="POST"style="margin-left:55px;margin-top:40px;">
		    <input type="text" name="user_login" size="25" placeholder="Username"/><p/>
			  <span><input type="password" name="password_login" size="25" placeholder="Password"/><p/></span>
			  <input type="submit" name="login" value="Sign In" style="margin-left:130px;margin-top:10px;"/>
		   </form>
		   <a href="forgot.php" style="text-decoration:none;font-size:10px;">Forgot password</a> 
		   </div></center>';
		    echo" <div style='position:absolute;top:580px;width:100%'>";
                  include("./inc/footer.inc.php"); echo '</div>';
				   exit();
 }
 ?>
 
 
 <div id="wrapper_pics">
 
<?php
$p_id="";
 //getting type of image
if(isset($_GET['p_id'])){
  $p_id=mysqli_real_escape_string($connection,$_GET['p_id']);
  
  }
 
  if($p_id){
  
  //check if user exist or not
  $check= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE id='$p_id' AND closed='no' AND deactivate='no' ");
   if(mysqli_num_rows($check)==1){
  $get=mysqli_fetch_assoc($check);
  $profile_id= @$get['id'];
  $username1 = @$get['username'];
  $firstname= @$get['first_name'];
  $lastname= @$get['last_name'];
   
   
  }
  
  $profile_pic_query=mysqli_query($connection,"SELECT profile_pics,id FROM albums WHERE user_id='$username1' ORDER BY id DESC LIMIT 12 ");
	 if((mysqli_num_rows($profile_pic_query))>=1){
	    while($get_images=mysqli_fetch_assoc($profile_pic_query)){
		      $profile_pic_name=$get_images['profile_pics'];
			  $photo_id=$get_images['id'];
			  
			 if($profile_pic_name!=""){
			 $profile_pic= "userdata/profile_pics/".$profile_pic_name;
		   echo "<img src='$profile_pic' style='box-shadow:1px 1px 1px #000;padding:5px;  margin-top:10px;margin-left:10px;float:left;max-height:400px;'/>";
		}
		
		}
	 
	 
	 }else{
	    echo "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>You don't have profile images yet</div>";
	 
	 }
    }
  ?> 
  
  <?php
  //for covers
  //getting type of image
  $cover_id="";
if(isset($_GET['cover_id'])){
  $cover_id=mysqli_real_escape_string($connection,$_GET['cover_id']);
  
  }
 
  if($cover_id!=""){
  
  //check if user exist or not
  $check= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE id='$cover_id' AND closed='no' AND deactivate='no' ");
   if(mysqli_num_rows($check)==1){
  $get=mysqli_fetch_assoc($check);
  $profile_id= @$get['id'];
  $username1 = @$get['username'];
  $firstname= @$get['first_name'];
  $lastname= @$get['last_name'];
   
   
  }
  
  $cover_pic_query=mysqli_query($connection,"SELECT cover_pics,id FROM albums WHERE user_id='$username1'  ORDER BY id DESC LIMIT 12 ");
	 if((mysqli_num_rows($cover_pic_query))>=1){
	    while($get_images=mysqli_fetch_assoc($cover_pic_query)){
		      $cover_pic_name=$get_images['cover_pics'];
			  $photo_id=$get_images['id'];
			 if($cover_pic_name!=""){
			 $cover_pic= "userdata/cover_pics/".$cover_pic_name;
		   echo "<img src='$cover_pic' style='box-shadow:1px 1px 1px #000;padding:5px; margin-top:10px;margin-left:10px;float:left;max-height:400px;'/>";
		}
		
		}
	 
	 
	 }else{
	    echo "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>You don't have cover images yet</div>";
	 
	 }
    }
  ?>
  
  
  <?php
  //for data images
$data_id="";
 //getting type of image
if(isset($_GET['data_id'])){
  $data_id=mysqli_real_escape_string($connection,$_GET['data_id']);
  
  }
 
  if($data_id){
  
  //check if user exist or not
  $check= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE id='$data_id' AND closed='no' AND deactivate='no' ");
   if(mysqli_num_rows($check)==1){
  $get=mysqli_fetch_assoc($check);
  $profile_id= @$get['id'];
  $username1 = @$get['username'];
  $firstname= @$get['first_name'];
  $lastname= @$get['last_name'];
   
   
  }
  
 $data_pic_query=mysqli_query($connection,"SELECT uploaded_photos,id FROM albums WHERE user_id='$username1' ORDER BY id DESC LIMIT 12");
	 if((mysqli_num_rows($data_pic_query))>=1){
	    while($get_images=mysqli_fetch_assoc($data_pic_query)){
		      $data_pic_name=$get_images['uploaded_photos'];
			  $photo_id=$get_images['id'];
			 if($data_pic_name!=""){
			 $data_pic= "userdata/data_pics/".$data_pic_name;
		   echo "<img src='$data_pic' style='box-shadow:1px 1px 1px #000;padding:5px; border-left:1px solid #769DD3; margin-left:10px;float:left;max-height:400px;'/>";
		}
		
		}
	 
	 
	 }else{
	    echo "<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>You don't have data images yet</div>";
	 
	 }
    }
  ?> 
  
  
  </div>