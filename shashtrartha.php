<?php include("./inc/header.inc.php");?>
<style>
textarea{
  height:50px;

}
	background-color:rgba(220,220,210,.7);
body{
}
#wrapper{
	background-color:rgb(192,192,192);
	}

</style>

<div id="mySidenav" class="sidenav">
 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
<script>
document.getElementById("logo").src="./img/v.png";
/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "180px";
 
 document.getElementById("main2").style.marginLeft = "180px";
 document.getElementById("profile_wrapper2").style.marginLeft = "0px";

 
}
  window.onload=openNav;
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("profile_wrapper2").style.marginLeft = "100px";
    document.getElementById("main2").style.marginLeft = "0";
}
</script>

<?php 
include("./button.php");?><br>
<center>
<img src="./img/namastey.png" style="height:80px; width:80px;margin-left:10px;"><br>
Namastey<br>
<h2 style="color:#fff;font-family:papyrus;font-weight:bold;">
<?php echo $username ?>
</h2></center>
 </div>

<div style="top-left;position:fixed;">
<span onclick="openNav()"><input type="button" value="&#9776" id="style_button"></input></span>
</div>
<div id="main2">


<div id="profile_wrapper2">
<?php

if(isset($_GET['str'])){
  $shashtrarth_id=mysqli_real_escape_string($connection,$_GET['str']);
   	
}  
     if(!$shashtrarth_id){
?>
  <script>
  alert("You should be logged in, Do not try to be over smart");
</script><?php
exit();






}
  $shashtra_uid=md5($shashtrarth_id);
     $shashtra_name="";
	   $shashtra_pic="";
	   $shashtra_type="";
	   $created_by = "";
	   $shashtra_bio="";
   $shashtra_query=mysqli_query($connection,"SELECT *FROM shashtra WHERE shashtra_url='$shashtrarth_id'");
   if((mysqli_num_rows($shashtra_query))==1){
       $shastra_i_query=mysqli_fetch_assoc($shashtra_query);
	   $shashtra_name=$shastra_i_query['shashtra_name'];
	   $shashtra_pic=$shastra_i_query['shashtra_pic'];
	   $shashtra_type=$shastra_i_query['type'];
	   $created_by = $shastra_i_query['username'];
	   $shashtra_bio = $shastra_i_query['shashtra_bio'];
	   
	     }
// Up loading cover
if(isset($_FILES['cover_pic'])){
     if (((@$_FILES["cover_pic"]["type"]=="image/jpeg") || (@$_FILES["cover_pic"]["type"]=="image/png") || (@$_FILES["cover_pic"]["type"]=="image/gif")||(@$_FILES["cover_pic"]["type"]=="image/jpg")||(@$_FILES["cover_pic"]["type"]=="image/png"))&&(@$_FILES["cover_pic"]["size"] < 1048576)){
	          $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			  $rand_dir_name = substr(str_shuffle($chars), 0, 15);
			  if(!mkdir("userdata/cover_pics/$rand_dir_name")){
			     echo "Cannot make directory";
			  }
			 
                    
			  if (file_exists("userdata/cover_pics/$rand_dir_name/".@$_FILES["cover_pic"]["name"])){
                 echo @$_FILES["cover_pic"]["name"]." Already exists";
   }
    else
   {
      $temp = explode(".", $_FILES["cover_pic"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file(@$_FILES["cover_pic"]["tmp_name"],"userdata/cover_pics/$rand_dir_name/".$newfilename);
    $cover_pic_name = @$newfilename;
    $cover_pic_query = mysqli_query($connection,"UPDATE shashtra SET shashtra_cover_pic='$rand_dir_name/$cover_pic_name' WHERE shashtra_url='$shashtrarth_id'");
   // echo "<meta http-equiv=\"refresh\" content=\"0; url=shashtrartha.php?str=$shashtrarth_id\">";
    
   }
  }
  else
  {
      echo "Invailid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
  }
   }
   
   //Allowing posting 
    //Sending post to dtabase   
  $post="";
  
  
   if(isset($_POST['post'])){ 
       $post = @$_POST['post'];
         
      
    if(isset($_FILES['pic'])){
     if (((@$_FILES["pic"]["type"]=="image/jpeg") || (@$_FILES["pic"]["type"]=="image/png") || (@$_FILES["pic"]["type"]=="image/gif")||(@$_FILES["pic"]["type"]=="image/jpg")||(@$_FILES["pic"]["type"]=="image/png"))&&(@$_FILES["pic"]["size"] < 1048576)){
	          $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			  $rand_dir_name = substr(str_shuffle($chars), 0, 15);
			  if(!mkdir("userdata/data_pics/$rand_dir_name")){
			     echo "Cannot make directory";
			  }
			 
                   
			  if (file_exists("userdata/data_pics/$rand_dir_name/".@$_FILES["pic"]["name"])){
                 echo @$_FILES["pic"]["name"]." Already exists";
   }
    else  
   {
      $temp = explode(".", $_FILES["pic"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file(@$_FILES["pic"]["tmp_name"],"userdata/data_pics/$rand_dir_name/".$newfilename);
    $post_pic = @$newfilename;
	
    //$profile_pic_query = mysqli_query($connection,"UPDATE myusers SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE username='$username'");
      
	if ($post_pic!=""){	 
    $date_added = date("Y-m-d");
    $added_by = $username;
    $user_posted_to = $shashtrarth_id;
   $sqlCommand = "INSERT INTO shashtra_posts VALUES('','$post','$date_added','$added_by','$user_posted_to','$rand_dir_name/$post_pic','')";  
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());	   
	 }         
   }
  }
  else
  {  if ($post!="") { $date_added = date("Y-m-d");
    $added_by = $username;
    $user_posted_to = $shashtrarth_id;
    $sqlCommand = "INSERT INTO shashtra_posts VALUES('','$post','$date_added','$added_by','$user_posted_to','Nothing','')";  
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());
   }else{
       echo "<div style='position:absolute; top:485px;margin-left:530px;background-color:#000;color:#fff;'>Kuchh to bolo............Write something....!</div>";
   }
  }
   }
   }
		 
  //check for cover_pic
  $check_pic_cover = mysqli_query($connection,"SELECT shashtra_cover_pic FROM shashtra WHERE shashtra_url='$shashtrarth_id'");
  $get_pic_row = mysqli_fetch_assoc($check_pic_cover);
  $cover_pic_db = $get_pic_row['shashtra_cover_pic'];
  if ($cover_pic_db == "") {
  $cover_pic = "./img/background-image.png";
  }
  else
  {
  $cover_pic = "userdata/cover_pics/".$cover_pic_db;
  }
		//check if there is a pic 
		 if ($shashtra_pic == "") {	
  $shashtra_avatar ="img/default-pic.png";
  }
  elseif(file_exists("userdata/data_pics/".$shashtra_pic))
  {
  $shashtra_avatar= "userdata/data_pics/".$shashtra_pic;
  }else{
	 $shashtra_avatar= "userdata/profile_pics/".$shashtra_pic;
  }
 
 
 
 //Uploading profile
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
    $profile_pic_query = mysqli_query($connection,"UPDATE shashtra SET shashtra_pic='$rand_dir_name/$profile_pic_name' WHERE shashtra_url='$shashtrarth_id'");
     $date_added = date("Y-m-d");
    $added_by = $shashtra_name;
    $user_posted_to = $shashtra_name;
	 $sqlCommand = "INSERT INTO shashtra_posts VALUES('','$shashtra_name has changed profile pic','$date_added','$added_by','$user_posted_to','$rand_dir_name/$profile_pic_name','')";  
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());
   echo "<meta http-equiv=\"refresh\" content=\"0; url=shashtrartha.php?str=$shashtrarth_id\">";
   

    
   }
  }
  else
  {
      echo "Invailid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
  }
   }

?>
<script>

document.title = "<?php echo $shashtra_name; ?>";
</script>

<!-------------------------------for cover------------------------>
      <div class="shashtra_cover_pic">
        <?php  if($username==$created_by){
		echo'
        <div id="uploading_cover" style="display:block;">
	  <form action="" method="POST" enctype="multipart/form-data" style="margin-left:30px;display:block;">
               <input type="file" name="cover_pic" accept="image/*" style="background-color:transparent;color:#fff;font-family:papyrus;"/>
              <input type="submit" name="uploadpic" value="Upload Image"/>
                   </form>
	  </div>';
	  }
	  ?>
<?php
	
	 list($width,$height)=getimagesize("$cover_pic");
	   
  if($width >1150){
     $wdth=1150;
	  $height1=($height/$width)*$wdth;
	  if($height1 < 350){
	$height1=300;
	
}
}elseif($height > $width){
	$wdth=1150;
     $height1=($height/$width)*$wdth;
	   if($height1 < 350){
	$height1=350;
	
}
}else{
   $wdth=1150;
     $height1=($height/$width)*$wdth;
  if($height1 < 350){
	$height1=350;
	
}
}
if($height1<400){
	$pose=100;	
}elseif($height1<800){
	$pose=300;	
}elseif($height1<=1200){
	$pose=400;	
}else{
	$pose=600;
}
  
	
	
	
	?>
 	   
    <div id="shashtra_cover"> <img src="<?php echo $cover_pic; ?>" style="box-shadow:.1px .1px .1px #000;margin-top:-<?php echo $pose;?>px;height:<?php echo $height1; ?>px; width:<?php echo $wdth ;?>px;" /></div>
      <?php echo "<div style='margin-left:300px;margin-top:30px;font-family:verdana;font-size:20px;font-weight:bold;color:#fff;text-shadow:1px 1px 1px #000;'>$shashtra_name</div>"?>
	 </div>
	 
	 
	 <!-------------------------------profile image------------------------>
       <div id="shashtra_image" >     
    <img src="<?php echo $shashtra_avatar;?>" style="padding:13px;background-color:#769DD3;box-shadow:2px 1px 2px rgba(4,4,4,0.6);border:1px solid #769DD3;border-radius:50%;float:center;" height="150"width="150"  alt="<?php echo $shashtra_name; ?>'s profile" title="<?php echo $shashtra_name ;?>'s Profile" /><br>
     <div id="upload_profile" >
	  <form action="" method="POST" enctype="multipart/form-data" style="display:block;">
              <a href="#" onclick="document.getElementById('fileID_profile').click(); return false;"  /><img src="./img/camera.png" title="Upload image"style="float:left;height:30px; width:30px;"/></a>
               <input type="file" id="fileID_profile" name="profilepic" accept="image/*" style="visibility: hidden;background-color:transparent;color:#fff;font-family:papyrus;"/>
              <input type="submit" style="float:right;width:40px;font-size:10px;margin-right:30px;margin-top:-50px; border:none;" name="uploadpic" value="Upload"/>
                   </form>
	  </div>
 </div>
  
<div id='shashtra_bio' style="moz-box-shadow:3px 3px 3px #d9d9d9;box-shadow:1px 1px 1px #000000;">
	     <div style="color:#fff;font-size:20px;text-align:center;font-family:verdana;text-shadow:1px 1px 1px #d9d9d9;margin-top:20px;padding:4px;"> <?php echo $shashtra_name; ?> details</div>
 
		   <div style='color:#fff;margin-left:15px;font-size:15px;font-family:papyrus;text-shadow:.5px .5px .5px #fff; '> About : <?php echo $shashtra_bio;  ?></div>
	<div style='color:#fff;margin-left:15px;font-size:15px;font-family:papyrus;text-shadow:.5px .5px .5px #d9d9d9; '>Created-by : <?php echo "<a href='$created_by' style='text-decoration:none;color:#000;font-size:15px;font-family:papyrus;font-weight:bold;text-shadow:.5px .5px .5px #d9d9d9;'>$created_by</a>";  ?></div>
	</div><br>

<script>
var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
function init () {
    var text = document.getElementById('post');
    function resize () {
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
    }
    /* 0-timeout to get the already changed text */
    function delayedResize () {
        window.setTimeout(resize, 0);
    }
    observe(text, 'change',  resize);
    observe(text, 'cut',     delayedResize);
    observe(text, 'paste',   delayedResize);
    observe(text, 'drop',    delayedResize);
    observe(text, 'keydown', delayedResize);

    text.focus();
    text.select();
    resize();
}

</script>	
	 <div id="shashtra_postForm"> 
	 <center>
	 <?php  if($username==$created_by){?>
   <form action="<?php echo "shashtrartha.php?str=".$shashtrarth_id;?>" method="POST" enctype="multipart/form-data" style="margin-top:5px; margin-left:10px;" >
     <a href="#" onclick="document.getElementById('fileID').click(); return false;" value="url()" /><img src="./img/camera.png" style="height:30px; width:30px;margin-left:250px;"/></a>
    <input type="file" id="fileID" name="pic" accept="image/*" style="visibility: hidden;background-color:transparent;"  />
  <textarea id="post" name="post" rows="1" cols="53" title="What u r upto" placeholder="Shuru karo Vaartalaap.........."  style="height:20px;font-size:15px;width:450px;" ></textarea>
  <input type="submit" name="send"  value="Stick it" style="height:35px;float:right;margin-top:-37px;margin-right:22px;border:1px solid #656;" />
  </form>
	 <?php } ?>
</center>
	<div id="newsfeed_shashtra">
	<?php 
	$getposts = mysqli_query($connection,"SELECT* FROM shashtra_posts WHERE user_posted_to='$shashtrarth_id'ORDER BY id DESC") or die(mysqli_error());
  while($row=mysqli_fetch_assoc($getposts)){
        $id= $row['id'];
		$body=$row['body'];
		$date_added= $row['date_added'];
		$added_by=$row['added_by'];
		$user_posted_to=$row['user_posted_to'];
		$post_pic1=$row['post_image'];
		 $if_shared=$row['if_shared'];
          $get_user_info = mysqli_query($connection,"SELECT * FROM myusers WHERE username='$added_by'");
                                                $get_info = mysqli_fetch_assoc($get_user_info);
											    $profilepic_info = $get_info['profile_pic'];
                                                if ($profilepic_info == "") {
                                                 $profilepic_info = "img/default-pic.png";
                                                }
                                                else
                                                {
                                                 $profilepic_info = "./userdata/profile_pics/".$profilepic_info;
                                                }
			 ?>
			 <script language="javascript">
                                               function toggle<?php echo $id; ?>() {
                                                var ele = document.getElementById("toggleComment<?php echo $id; ?>");
                                                var text = document.getElementById("displayComment<?php echo $id; ?>");
                                                if (ele.style.display == "block") {
                                                ele.style.display = "none";
                                                   }
                                                    else
                                                   {
                                                  ele.style.display = "block";
                                                     }
                                                    }
		                                     </script>
<?php
          $uid=$id;
         $uid=md5($uid);
               if(@$_POST['delete_'.$id.'']){              
			   $delete_Post_Query=mysqli_query($connection,"DELETE FROM shashtra_posts WHERE id='$id'");
			   echo "<meta http-equiv=\"refresh\" content=\"0; url=shashtrartha.php?str=$shashtrarth_id\">";
			 } 
         //re share
			 if(@$_POST['re_stick_'.$id.'']){     
               $get_posts=mysqli_query($connection,"SELECT *FROM shashtra_posts WHERE id='$id'");
	           if((mysqli_num_rows($get_posts))==1){
	            $get_post=mysqli_fetch_assoc($get_posts);
	         $body=$get_post['body'];
	             $date=$get_post['date_added'];
	         $added_by_share=$get_post['added_by'];
	          $user_posted_to=$get_post['user_posted_to'];
	         $post_image=$get_post['post_image'];
                   			 
                  $share_post=mysqli_query($connection,"INSERT INTO posts VALUES('','$body ','$date','$username','$username','$post_image','$added_by_share')");
                   if($username!=$added_by_share){
				  $suchana_query=mysqli_query($connection,"INSERT INTO suchana VALUES(' ', '$username', '$added_by_share','share','$id','$date','no','no')");
				  }	         	
				echo "<meta http-equiv=\"refresh\" content=\"0; url=shashtrartha.php?str=$shashtrarth_id\">";
	  }	
			   
			 }  
			  
		echo "	<div id='status_shashtra' >
	                                        
			";
									if($user_posted_to==$username||$added_by==$username){
												echo"<form method='POST' action='shashtrartha.php?str=$shashtrarth_id' name='deleteing'>
	               <input type='submit' value=\"X\"  title='Delete the post' name='delete_$id' style='float:right;margin-right:5px;height:15px;font-size:10px;line-height:10px;'/>
                                            </form>";
											}echo"
                                           
                                                <div id='status1_shashtra' style='max-width:100%;'>
												";
											  if($if_shared!=""){
												  echo"<center><div id='shared'><a href='$added_by'>$added_by</a> shared <a href='$if_shared'>$if_shared</a>'s post</div></center>";
												  
											  }
											  	if($post_pic1!="Nothing"){ 
												    if(file_exists("userdata/data_pics/$post_pic1")){
														list($width,$height)=getimagesize("userdata/data_pics/$post_pic1");
 if($width<800){
     $wdth=800;
     $height1=($height/$width)*$wdth;
}elseif($width>800){
     $wdth=800;
     $height1=($height/$width)*$wdth;

}else{
   $wdth=$width;
   $height1=$height;

}
	
	
														
												   echo "<img style='-moz-box-shadow:2px 2px 5px black;box-shadow:.1px .1px .1px #d9d9d9;width:".$wdth."px;height:".$height1."px;margin-bottom:8px;' src='userdata/data_pics/$post_pic1'>";
												}elseif(file_exists("userdata/cover_pics/$post_pic1")){
													list($width,$height)=getimagesize("userdata/cover_pics/$post_pic1");
 if($width<800){
     $wdth=800;
     $height1=($height/$width)*$wdth;
}elseif($width>800){
     $wdth=800;
     $height1=($height/$width)*$wdth;

}else{
   $wdth=$width;
   $height1=$height;

}
												 echo "<img style='-moz-box-shadow:2px 2px 5px black;box-shadow:.1px .1px .1px #d9d9d9;width:".$wdth."px;height:".$height1."px;margin-bottom:8px;' src='userdata/cover_pics/$post_pic1'>";
												}else{
													list($width,$height)=getimagesize("userdata/profile_pics/$post_pic1");
  if($width<800){
     $wdth=800;
     $height1=($height/$width)*$wdth;
}elseif($width>800){
     $wdth=800;
     $height1=($height/$width)*$wdth;

}else{
   $wdth=$width;
   $height1=$height;

}

												 echo "<div id='post_reimage'><img style='-moz-box-shadow:2px 2px 5px black;box-shadow:.1px .1px .1px #d9d9d9;width:".$wdth."px;height:".$height1."px;margin-bottom:8px;' src='userdata/profile_pics/$post_pic1'></div>";
												
												}
												
												}
												echo"
												<p style='padding:5px;font-size:15px;font-weight:'>$body </p>
												";
												echo "
                                                
                                                </div>
                        <div class='active_buttons'>
												<input type='button' style='margin-left:10px;float:left;margin-top:2px;' onClick='javascript:toggle$id()' value='Comments(Tippadi)'> </input>
												<form method='POST' action='shashtrartha.php?str=$shashtrarth_id' name='sharing'>
												<input type='submit' style='border:none; border:1px solid #00508D;box-shadow:none;margin-left:0px;float:left;margin-top:2px;' name='re_stick_$id' value='Re-Stick-)'></input>
												</form>
												</div>		<div id='toggleComment$id' style='margin-left:10px;display:none; line-height:20px;word-wrap: break-word;text-align:justify;font-size:15px;font-weight:bold;'>
												<iframe src='comment_box.php?s_id=$id' frameborder='0' style='max-height:100px;height:auto;min-height:20px;width:100%;'></iframe>
										</div>
																					
                                            </div>	
                                               
									 						
						";
		
		}			   		 
			 echo"<div style='background-color:black;margin-top:80px;color:#fff; font-family:papyrus;'>No More posts to show...... <br></div>";
		
	
	?>
	</div>  </div>
</div>
</div>
<div id="album_of_user" style="margin-left:400px;">
     <div style="z-index:-5;text-align:center;font-family:helvetica;text-shadow:1px 1px 1px rgb(200,200,200);margin-top:20px;color:#000;"> <?php echo $shashtra_name; ?>'s photos</div>
	 
       <?php
	      $data_pic_query=mysqli_query($connection,"SELECT post_image FROM shashtra_posts WHERE user_posted_to='$shashtra_name' ORDER BY id DESC LIMIT 8 ");
	 if((mysqli_num_rows($data_pic_query))>=1){
	    while($get_images=mysqli_fetch_assoc($data_pic_query)){
		      $data_pic_name=$get_images['post_image'];
			  
			 if($data_pic_name!="Nothing"){
				 if(file_exists("userdata/data_pics/".$data_pic_name)){
					 $data_pic= "userdata/data_pics/".$data_pic_name;
				 }elseif(file_exists($data_pic= "userdata/cover_pics/".$data_pic_name)){
					  $data_pic= "userdata/cover_pics/".$data_pic_name;
				 }else{
					    $data_pic= "userdata/profile_pics/".$data_pic_name; 
				 }
			 
		   echo "<img src='$data_pic' style=' box-shadow:1px 1px 1px #769DD3;float:left;height:75px;width:75px;'/>";
		}
		
		}
	 
	 
	 }else{
	    echo "<div id='error_' style='padding:5px;margin-top:20px;background-color:#000000;color:#fff;z-index:4; font-style:papyrus;font-size:15px;opacity:.8;'>You don't have data images yet</div>";
	 
	 }
	 
	   ?>
	    
     </div>	