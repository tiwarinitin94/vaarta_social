<?php include("./inc/header.inc.php"); ?>

<?php 
    if(isset($_GET['id'])){
		$profile_id=mysqli_real_escape_string($connection,$_GET['id']);
		
	
     $check= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE id='$profile_id' AND closed='no' AND deactivate='no' ");
   if(mysqli_num_rows($check)==1){
  $get=mysqli_fetch_assoc($check);
  $profile_id= @$get['id'];
  $username1 = @$get['username'];
  $firstname= @$get['first_name'];
  $lastname= @$get['last_name'];
 
  }
	}  
  else{

  echo "<center style='background-color:#fff;margin-top:100px;'>User is deactivated or does not exist</center>";
  exit();
  }
	
?>
<link rel="stylesheet" type="text/css" href= "./css/set_p.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{

//Edit link action
$('.edit_link').click(function()
{
$('.text_wrapper').hide();
var data=$('.text_wrapper').html();
$('.edit').show();
$('.editbox').html(data);
$('.editbox').focus(); 
});

//Mouseup textarea false
$(".editbox").mouseup(function() 
{
return false
});

//Textarea content editing
$(".editbox").change(function() 
{
$('.edit').hide();
var boxval = $(".editbox").val();
var dataString = 'data='+ boxval;
$.ajax({
type: "POST",
url: "update_profile_ajax.php",
data: dataString,
cache: false,
success: function(html)
{
$('.text_wrapper').html(boxval);
$('.text_wrapper').show();
}
});
});

//Textarea without editing.
$(document).mouseup(function()
{
$('.edit').hide();
$('.text_wrapper').show();
});

});

</script>


<div id="mySidenav" class="sidenav">
 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
<script>
/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "180px";
 
 document.getElementById("main").style.marginLeft = "180px";



 
}
   window.onload=openNav;
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";

    document.getElementById("main").style.marginLeft = "0";
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

<style>
#wrapper{
	background-color: rgb(600,100,50);
}

</style>
<script>
document.getElementById("logo").src="./img/v.png";
</script>

<?php 

 
			   $sign_pic = "img/vaarta.png";
			  
		$quote_query=mysqli_query($connection,"SELECT* FROM info_users WHERE user_id='$profile_id'");
		       $quote_numrows=mysqli_num_rows($quote_query);
			   if($quote_numrows>=1){
			   $quote=mysqli_fetch_assoc($quote_query);
                               $sign_pic_db=$quote['signature'];
			   
			   
		if ($sign_pic_db == "") {
  $sign_pic = "img/vaarta.png";
  }
  else
  {
  $sign_pic = "userdata/data_pics/".$sign_pic_db;
  } }
  


 $check_pic = mysqli_query($connection,"SELECT profile_pic FROM myusers WHERE username='$username1'");
  $get_pic_row = mysqli_fetch_assoc($check_pic);
  $profile_pic_db = $get_pic_row['profile_pic'];
  
  if ($profile_pic_db == "") {
  $profile_pic = "img/default-pic.png";
  }
  else
  {
  $profile_pic = "userdata/profile_pics/".$profile_pic_db;
  }


?>
<script>
  document.title = "Friends of <?php echo $firstname; ?>";
  </script>
<div id="main">

<div style="float:left;width:200px;">
<ul>
  <li><a href="<?php echo $username1;?>">Profile</a></li>
    <li><a href="profile_settings.php?id=<?php echo $profile_id; ?>" onclick="fetch_friends()">Info</a></li>
  <li style="background-color:#999;"><label>Friends</label></li> 
  <li><a href="photos.php?id=<?php echo $profile_id; ?>">Chitra(Images)</a></li>
  <li><a href="answers.php?id=<?php echo $profile_id; ?>">Answers</a></li>
  <li><a href="">Shashtra</a></li>
  
</ul>
</div>

<div style="margin-left:200px;float:left;width:800px; min-height:100%;background-color:#fff;border:1px solid rgba(50,50,50,.3);">

<div id="my_image" style="margin-left:0px;" >  
   <div id="widget" class="sticky">   
     <img src="<?php echo $profile_pic;?>" style="max-top:0px;padding:13px;box-shadow:2px 1px 2px rgba(4,4,4,0.6);float:center;" height="150"width="150"  alt="<?php echo $username1; ?>'s profile" title="<?php echo $firstname ;?>'s Profile" /><br>
<?php  if($username==$username1){?>
 <div id="upload_profile" >
	  <form action="" method="POST" enctype="multipart/form-data" style="display:block;">
              <a href="#" onclick="document.getElementById('fileID_profile').click(); return false;"  /><img src="./img/camera.png" title="Upload image"style="float:left;height:30px; width:30px;"/></a>
               <input type="file" id="fileID_profile" name="profilepic" accept="image/*" style="visibility: hidden;background-color:transparent;color:#fff;font-family:papyrus;"/>
              <input type="submit" style="float:right;width:40px;font-size:10px;margin-right:30px;margin-top:-50px; border:none;" name="uploadpic" value="Upload"/>
                   </form>
	  </div>
<?php } ?></div>
<div id="bio" >
   <div id="focus"style="font-size:14px;text-shadow:.2px .2px .2px #d9d9d9;font-family:helvetica;color:#000;width:300px;margin-left:120px;margin-top:20px;padding-right:20px;padding-left:20px;">
   <?php
       $about_query=mysqli_query($connection,"SELECT bio FROM myusers WHERE username='$username1'");
    $get_result=mysqli_fetch_assoc($about_query);
    $about_the_user=$get_result['bio'];
    echo $about_the_user;	
  ?> </div>
  </div>
  
 </div>
 <?php 
  list($width,$height)=getimagesize("$sign_pic");
   if($width >100){
     $wdth_sign=100;
	  $height1_sign=($height/$width)*$wdth_sign;
   } 

?>
 <img src='<?php echo $sign_pic;?>' id='the_sign'style='margin-top:-100px;margin-right:100px;float:right;height:<?php echo $height1_sign;?>px;width:<?php echo $wdth_sign;?>px;'/>

 
 
 <div id="all_friends" style="margin-toP:60px;">
 <?php
  $selectFriendsQuery=mysqli_query($connection,"SELECT friend_array FROM myusers WHERE username ='$username1'");
	      $friendRow=mysqli_fetch_assoc($selectFriendsQuery);
	      $friendArray=$friendRow['friend_array'];	 
	     
		  $i=0;
           $countArray="";
		
            if($friendArray!=""){
	     $friendArray=explode(",",$friendArray);
		 $countArray=count($friendArray);
		 $friendArray12=array_slice($friendArray,0,12);
			}
			
			 if($countArray !=0){
	     foreach($friendArray12 as $key => $value){
		     $i++;
			 $getFriendQuery=mysqli_query($connection,"SELECT* FROM myusers WHERE username='$value' LIMIT 1");
			 $getFriendRow=mysqli_fetch_assoc($getFriendQuery);
			 $friendUsername=$getFriendRow['username'];
			 $friendProfilePic=$getFriendRow['profile_pic'];
			 $ffName=$getFriendRow['first_name'];
			  $friendCoverPic=$getFriendRow['cover_pic'];
			  
			 $ffName=(strlen($ffName)>10) ? substr($ffName,0,10).'...' : $ffName; 
			 if($friendProfilePic==""){
			      $profile_pic_f="img/default-pic.png";
				 }
				 else{
					  $profile_pic_f="userdata/profile_pics/$friendProfilePic";
				   }
				   
				   if($friendCoverPic==""){
			      $cover_pic_f="./img/background-image.png";
				 }
				 else{
					  $cover_pic_f="userdata/cover_pics/$friendCoverPic";
				   }
				   ?>
				   
				 <a href ='<?php echo $friendUsername;?>'alt="<?php echo $friendUsername;?> 's Profile" title="<?php echo $friendUsername;?> 's Profile"  style="color:rgba(50,50,50,.6);text-align:center;text:decoration:none;margin:10px;"> 
				 <div id='user_searched' >
				 <img src='<?php echo $cover_pic_f; ?>' style='width:300px;height:200px;'/>
				 <img src='<?php echo $profile_pic_f;?>'  height='60' width='60' style='margin-left:-10px;padding:5px;'>
				 <label style="margin-top:-10px;"><?php echo $ffName; ?></label>
				 </div>
				 </a>
		<?php
		}
		 }
	 else{
	 echo "<center style='background-color:rgba(600,50,50,.9); padding:10px;color:#fff;'>$firstname have no friends yet! make Some :)<center>";
	 }
		 
		 
		 
 
 ?></div>
</div></div>

