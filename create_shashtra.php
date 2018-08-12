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
	
 
}
   window.onload=openNav;
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
     document.getElementById("main").style.paddingLeft = "80px";
    document.getElementById("main").style.marginLeft = "0";
	  document.getElementById("vaarta_suggestion").style.width="250px";
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


<?php

 $shashtra=@$_POST['shashtra'];
 if($shashtra){
       $shashtra_name=@$_POST['shashtra_name'];
	  $shashtra_url=@$_POST['shashtra_url'];
	  $shashtra_bio=@$_POST['shashtra_bio'];
	 $type=@$_POST['type'];
		 //uploading profile image
   if(isset($_FILES['shashtrapic'])){
     if (((@$_FILES["shashtrapic"]["type"]=="image/jpeg") || (@$_FILES["shashtrapic"]["type"]=="image/png") || (@$_FILES["shashtrapic"]["type"]=="image/gif")||(@$_FILES["shashtrapic"]["type"]=="image/jpg")||(@$_FILES["shashtrapic"]["type"]=="image/png"))&&(@$_FILES["shashtrapic"]["size"] < 1048576)){
	          $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			  $rand_dir_name = substr(str_shuffle($chars), 0, 15);
			  if(!mkdir("userdata/data_pics/$rand_dir_name")){
			     echo "Cannot make directory";
			  }
			 
                    
			  if (file_exists("userdata/data_pics/$rand_dir_name/".@$_FILES["shashtrapic"]["name"])){
                 echo @$_FILES["shashtrapic"]["name"]." Already exists";
   }
    else
   {   
      $temp = explode(".", $_FILES["shashtrapic"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file(@$_FILES["shashtrapic"]["tmp_name"],"userdata/data_pics/$rand_dir_name/".$newfilename);
	
     $shashtra_pic_name = @$newfilename;
     if ($shashtra_pic_name!=""){
	  if($shashtra_name==""&&$type==""&&$shashtra_url=="" ){
	    echo "<div style='position:absolute;padding:5px;width:300px;margin-left:650px;margin-top:20px;color:#000;margin-top:110px; font-style:papyrus;font-size:13px;background-color:#fff;font-weight:bold;'>Fill the name and type</div>";
	 }else{
    //check if already matching name
	 $check=mysqli_query($connection,"SELECT *FROM shashtra WHERE shashtra_url='$shashtra_url' AND type='$type' ");
	
	if(mysqli_num_rows($check)==1){
	        $get_detail=mysqli_fetch_assoc($check);
			$user_detail=$get_detail['username'];
	       echo "<div style='position:absolute;padding:5px;width:300px;margin-left:850px;margin-top:-20px;color:#000;margin-top:110px; font-style:papyrus;font-size:13px;background-color:#fff;font-weight:bold;'>Shashtra url '<a href='shashtrartha.php?str=$shashtra_url' style='text-decoration:none;color:#4F7EBE;font-size:15px;font-weight:bold;'> $shashtra_url.</a>' already exist. Created by <a href='$user_detail' style='text-decoration:none;color:#4F7EBE;font-size:15px;font-weight:bold;'> $user_detail</a></div>";
		
	}else{
	    $insert_query=mysqli_query($connection,"INSERT INTO shashtra VALUES('','$shashtra_url','$shashtra_name','$username','$type','$shashtra_bio','$rand_dir_name/$shashtra_pic_name','') "); 
	 echo "<div style='position:absolute;padding:5px;width:300px;margin-left:850px;margin-top:20px;color:#000;margin-top:110px; font-style:papyrus;font-size:13px;background-color:#fff;font-weight:bold;'>Your shashtra name is<a href='shashtrartha.php?str=$shashtra_url'style='text-decoration:none;color:#4F7EBE;font-size:15px;font-weight:bold;'> $shashtra_name.</a> Which is about $type. <a href='shashtrartha.php?str=$shashtra_url'style='text-decoration:none;color:#d9d9d9;font-size:15px;font-weight:bold;'>Click here</a> to see your shashtra page</div>";
		
	}
        
	  }
	  }
   }
  }
  else
  {     
       
	  if($shashtra_name=="" || $type=="" || $shashtra_url=="" ){
	    echo "<div style='position:absolute;padding:5px;width:300px;margin-left:650px;margin-top:20px;color:#000;margin-top:110px; font-style:papyrus;font-size:13px;background-color:#fff;font-weight:bold;'>Fill the Name, type and url all of them compulsory. </div>";
	 }else{
    //check if already matching name
	 $check=mysqli_query($connection,"SELECT *FROM shashtra WHERE shashtra_url='$shashtra_url' ");
	
	if(mysqli_num_rows($check)==1){
	        $get_detail=mysqli_fetch_assoc($check);
			$user_detail=$get_detail['username'];
	       echo "<div style='position:absolute;padding:5px;width:300px;margin-left:650px;margin-top:20px;color:#000;margin-top:110px; font-style:papyrus;font-size:13px;background-color:#fff;font-weight:bold;'>Shashtra url <a href='shashtrartha.php?str=$shashtra_url' style='text-decoration:none;color:#4F7EBE;font-size:15px;font-weight:bold;'> $shashtra_url</a> already exist. Created by <a href='$user_detail' style='text-decoration:none;color:#4F7EBE;font-size:15px;font-weight:bold;'> $user_detail</a></div>";
		
	}else{
	    $insert_query=mysqli_query($connection,"INSERT INTO shashtra VALUES('','$shashtra_url','$shashtra_name','$username','$type','$shashtra_bio','','') "); 
	 echo "<div style='position:absolute;padding:5px;width:300px;margin-left:650px;margin-top:20px;color:#000;margin-top:110px; font-style:papyrus;font-size:13px;background-color:#fff;font-weight:bold;'>Your shashtra name is <a href='shashtrartha.php?str=$shashtra_url' style='text-decoration:none;color:#4F7EBE;font-size:15px;font-weight:bold;'> $shashtra_name</a> Which is about $type. <a href='shashtrartha.php?str=$shashtra_url'style='text-decoration:none;color:#d9d9d9;font-size:15px;font-weight:bold;'>Click here</a> to see your shashtra page</div>";
	//Inserting for like and dislike button
	   $uid= md5($shashtra_url);
	   $date=date("y-m-d");
        $create_button=mysqli_query($connection,"INSERT INTO like_buttons VALUES('','$username','$shashtra_url','$date','$uid')");
	  $insert_like=mysqli_query($connection,"INSERT INTO user_likes VALUES('','$username','0','$uid')");
       $create_disbutton=mysqli_query($connection,"INSERT INTO dislike_buttons VALUES('','$username','$shashtra_url','$date','$uid')");
	$insert_dislike=mysqli_query($connection,"INSERT INTO user_dislikes VALUES('','$username','0','$uid')");	  
	}
        
	  }
      
  
   } 
}
}
   
?>

<div class="wrap_shashtra">
<center>
<div style=" font-family:verdana;font-weight:bold;font-size:15px;background-color:rgba;color:#fff;padding:5px;">
In 'Sanskrit' language, creating a wise discussion called 'shashtrartha'. <br><br>Start changing the world. :)<br> <br></div>
                 <form action="" method="POST" enctype="multipart/form-data">
				   <input name="shashtra_name" type="text" placeholder="Enter the topic"><br><br>
				   <input name="shashtra_url" type="text" placeholder="Please enter a name without space."><br><br>
				    <input name="type" type="text" placeholder="Enter type of shashtrartha"><br><br>
					  <textarea name="shashtra_bio" type="text" placeholder="Say something about your 'Shashtra'"></textarea><br><br>
					 <input type="file" name="shashtrapic" accept="image/*" style="background-color:transparent;"/><br/><br/>
					 
				   <input type="submit" name="shashtra" value="Create">
				   </form><br>
<div style=" font-family:verdana;font-weight:bold;font-size:12px;background-color:#9FC5DD;color:#fff;padding:5px;">
				    Upload an image for shashtra</div>
</center>
				   
            </div>  </div>
<div style="position:absolute;width:100%;bottom:0px;">
<?php include("./inc/footer.inc.php");?>
<div>