<?php include("./inc/header.inc.php");?>


<?php
//Username is log in user and username1 has been used for others profile
if(!$username){
 echo "";
 }else{
   $username=strtolower($username);
}

?>
<link rel="stylesheet" src="css/sticky_style.css" type="text/css">
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function(){ // document ready

		  if (!!$('.sticky').offset()) { // make sure ".sticky" element exists

		    var stickyTop = $('.sticky').offset().top; // returns number 

		    $(window).scroll(function(){ // scroll event

		      var windowTop = $(window).scrollTop(); // returns number 

		      if (stickyTop < windowTop-180){
		        $('.sticky').css({ position: 'fixed', top: 60, left:180 });
				}
		      else {
		        $('.sticky').css('position','static');
				  }

		    });

		  }

		});
		
		$(function(){ // document ready

		  if (!!$('.sticky2').offset()) { // make sure ".sticky" element exists

		    var stickyTop = $('.sticky2').offset().top; // returns number 

		    $(window).scroll(function(){ // scroll event

		      var windowTop = $(window).scrollTop(); // returns number 

		      if (stickyTop < windowTop-320){
		        $('.sticky2').css({ position: 'fixed', bottom: 40});
				}
		      else {
		        $('.sticky2').css('position','static');
				  }

		    });

		  }

		});
		
		
		
	</script>


 <?php if($username){?>
<script>


document.getElementById("logo").src="./img/v.png";
/* Set the width of the side navigation to 250px */

   window.onload=openNav;
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
   document.getElementById("focus").style.width = "300px";
    document.getElementById("main2").style.marginLeft = "0";
	document.getElementById("bio").style.width = "445px";
    document.getElementById("new_info").style.marginRight = "110px";
    document.getElementById("the_sign").style.width = "auto"; 
	
	}

	
</script>


 <?php } ?>

<style>
body{
 min-width:1300px;
}

	
	.dropbtn {
    background-color: #4CAF50;
    color: white;
    font-size: 18px;
    border: none;
	min-width:30px;
    cursor: pointer;
}


</style>


  
<?php
if(isset($_GET['u'])){
	if(isset($_GET['c'])){
	$HE=$_GET['c'];
	ECHO $HE;
	}
  $username1=htmlspecialchars(mysqli_real_escape_string($connection,$_GET['u']));
  $username1=preg_replace('#[^A-Za-z0-9]#i','',$username1);
  $username1=strtolower($username1);
 
  if(ctype_alnum($username1)){
  //check if user exist or not
  $check= mysqli_query($connection,"SELECT username,first_name,last_name,id,gender FROM myusers WHERE username='$username1' AND closed='no' AND deactivate='no' ");
   if(mysqli_num_rows($check)==1){
  $get=mysqli_fetch_assoc($check);
  $profile_id= @$get['id'];
  $username1 = @$get['username'];
  $firstname= @$get['first_name'];
  $lastname= @$get['last_name'];
  $gender= @$get['gender'];
       
  }
  
  else{
         if($username==$username1){
			  echo "<center style='padding:20px;background-color:#fff;margin:300px;'>You are Deactivated </center>";
  exit();
		 }else{
  echo "<center style='padding:20px;background-color:#fff;margin:300px;'>User is deactivated or does not exist</center>";
  exit();
		 }
  }
  }
  }
     if(!$username1){
      echo "<center><div style='background-color:#fff; padding: 100px;font-weight:bold;'>Don't mess with me </div></center>";
	  exit();
 }
  $post_pic="";
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
    $user_posted_to = $username1;
	
   $sqlCommand = "INSERT INTO posts VALUES('','$post','$date_added','$added_by','$user_posted_to','$rand_dir_name/$post_pic','')";
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());	 
         if($username!="" &&$username!=$username1){
  
	     $suchana_query=mysqli_query($connection,"INSERT INTO suchana VALUES(' ', '$username', '$username1', 'post+pic','','$date_added','no','no')");
			
	}
     
	 }           
   }
  }
 else
  {  if ($post!="") { $date_added = date("Y-m-d");
    
    $added_by = $username;
    $user_posted_to = $username1;
	 
	
    $sqlCommand = "INSERT INTO posts VALUES('','$post','$date_added','$added_by','$user_posted_to','Nothing','')";  
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());
     if($username!="" &&$username!=$username1){
     $suchana_query1=mysqli_query($connection,"INSERT INTO suchana VALUES(' ', '$username', '$username1', 'post','','$date_added','no','no')");
		
	}
   }else{
       echo "<div style='position:absolute; top:485px;margin-left:530px;background-color:#000;color:#fff;'>Kuchh to bolo............Write something....!</div>";
   }
  }
  }
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
    $profile_pic_query = mysqli_query($connection,"UPDATE myusers SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE username='$username'");
     $date_added = date("Y-m-d");
    $added_by = $username;
    $user_posted_to = $username;
	 $sqlCommand = "INSERT INTO posts VALUES('','$username has changed profile pic','$date_added','$added_by','$user_posted_to','$rand_dir_name/$profile_pic_name','')";  
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());

    
   }
  }
  else
  {
      echo "Invailid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
  }
   }

       //Uploading cover_pic
	   
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
	$date_added = date("Y-m-d");
	 $added_by = $username;
    $user_posted_to = $username;
    $cover_pic_query = mysqli_query($connection,"UPDATE myusers SET cover_pic='$rand_dir_name/$cover_pic_name' WHERE username='$username'");
	$sqlCommand = "INSERT INTO posts VALUES('','$username has changed cover pic','$date_added','$added_by','$user_posted_to','$rand_dir_name/$cover_pic_name','')";  
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());
   
   }
  }
  else
  {
      echo "Invailid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
  }
   }
   //check for cover_pic
  $check_pic_cover = mysqli_query($connection,"SELECT cover_pic FROM myusers WHERE username='$username1'");
  $get_pic_row = mysqli_fetch_assoc($check_pic_cover);
  $cover_pic_db = $get_pic_row['cover_pic'];
   $cover_pic_db = $get_pic_row['cover_pic'];
    if ($cover_pic_db == "") {
  $cover_pic = "./img/background-image.png";
  }
  else
  {
  $cover_pic = "userdata/cover_pics/".$cover_pic_db;
  }
 
   
  //check for profile_pic
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
  document.title = "<?php echo $firstname; ?>";
  </script>
<div id="main2">
    <div id="cover_pic" >
        <?php  if($username==$username1){
		echo'
        <div id="uploading_cover" >';?>
	  <form action="" method="POST" enctype="multipart/form-data" style="margin-left:30px;display:block;">
              <a href="#" onclick="document.getElementById('fileID').click(); return false;" value="url()" /><img src="./img/camera.png" title="Upload image"style="float:left;height:50px; width:50px;margin-left:250px;"/></a>
               <input type="file" id="fileID" name="cover_pic" accept="image/*" style="visibility: hidden;background-color:transparent;color:#fff;font-family:papyrus;"/>
              <input type="submit" style="float:left;margin-top:13px;"name="uploadpic" value="Upload Image"/>
                   </form>
	  </div><?php
	  }

       list($width,$height)=getimagesize("$cover_pic");
	   
  if($width >920){
     $wdth=920;
	  $height1=($height/$width)*$wdth;
	  if($height1 < 450){
	$height1=430;
	
}
}elseif($height > $width){
	$wdth=920;
     $height1=($height/$width)*$wdth;
	   if($height1 < 450){
	$height1=430;
	
}
}else{
   $wdth=920;
     $height1=($height/$width)*$wdth;
  if($height1 < 450){
	$height1=430;
	
}
}
if($height1<450){
	$pose=100;	
}elseif($height1<800){
	$pose=200;	
}elseif($height1<=1200){
	$pose=300;	
}elseif($height1<=200){
	$pose=00;	
}else{
	$pose=400;
}
  
	  ?>
	<script>
	function cover_slide(){
	document.getElementById("cover_image")
        .getElementsByTagName("img")[0].style.marginTop="-100px";
	}
function cover_back(){
     	document.getElementById("cover_image")
        .getElementsByTagName("img")[0].style.marginTop='-<?php echo $pose?>px';
	}
	</script>
    <div id="cover_image"  style="overflow:hidden;"> <img src="<?php echo $cover_pic; ?>" onmouseout="cover_back()" onmouseover="cover_slide()" style="margin-top:-<?php echo $pose;?>px;height:<?php echo $height1; ?>px; width:<?php echo $wdth;?>px;" ></img></div>

  <div class="setting_buttons_hell">
    <button  style="background-color:rgba(50,50,50,.6);color:#fff;" >Profile</button><button id="profile_but">Info</button><button id="friends">Friends</button><button id="photos">Photos</button>

<script >
    document.getElementById("profile_but").onclick = function () {
		 		 
        location.href = "profile_settings.php?id=<?php echo $profile_id;?>";
    };
	document.getElementById("friends").onclick = function () {
		 		 
        location.href = "friends.php?id=<?php echo $profile_id;?>";
    };
	document.getElementById("photos").onclick = function () {
		 		 
        
		"photos.php?id=<?php echo $profile_id;?>";
    };
</script> 
 
</div>	
   
	</div>
		  

 
	
	    <?php 
           $fav_quotation="Enter your status";
			   $said_by="";
			   $hobby="Enter your hobbies";
			   $country="Enter the country you belong";
			   $designation="Enter your designation";
			   $sign_pic = "img/vaarta.png";
		$quote_query=mysqli_query($connection,"SELECT* FROM info_users WHERE user_id='$profile_id'");
		       $quote_numrows=mysqli_num_rows($quote_query);
			   if($quote_numrows>=1){
			   $quote=mysqli_fetch_assoc($quote_query);
                              if($quote['fav_quote']!=""){
			   $fav_quotation=$quote['fav_quote'];
                          }  
			   $said_by=$quote['said_by'];
			   $hobby=$quote['hobby'];
			   $country=$quote['country'];
			   $designation=$quote['designation'];
			   $sign_pic_db=$quote['signature'];
		if ($sign_pic_db == "") {
  $sign_pic = "img/vaarta.png";
  }
  else
  {
  $sign_pic = "userdata/data_pics/".$sign_pic_db;
  } }
  

   
    list($width,$height)=getimagesize("$sign_pic");
   if($width >100){
     $wdth_sign=100;
	  $height1_sign=($height/$width)*$wdth_sign;
   }
	if($username){  
  ?>
  
  
  
   
  
	
	<?php } ?>
   <div id="new_info">
  <?php
  
 
			   echo "<div style='word-wrap:break-word;text-shadow:1px 1px 1px #fff;width:450px;font-family:helvetica;margin-top:14px;color:#000;z-index:-1; font-size:13px;'><img src='img/quote1.png' style='margin-right:5px;margin-top:-15px;height:50px;width:50px;float:left;'>$fav_quotation<img src='img/quote.png' style='margin-left;10px;float:right;height:50px;width:50px;margin-right:-10px;'>
			                   <div style='margin-top:20px;float:right;margin-right:10px;font-size:14px;color:#000;'>:-$said_by</div></div>";
			  
		
	//modal boxes..........................	


 

if(isset($_POST['send_bio'])){
//Checking there is already
	 $check_bio_again=mysqli_query($connection,"SELECT *FROM info_users WHERE user_id='$global_id'");
   $numrows_bio_again=mysqli_num_rows($check_bio_again);   
   if($numrows_bio_again!=0){
  if(@$_POST['quote']!=""){
$fav_quote=@$_POST['quote'];
}
	     $said_by=@$_POST['said_by'];
     if(strlen($fav_quote)<150 ){		 
   $info_submit_query=mysqli_query($connection,"UPDATE info_users SET  fav_quote='$fav_quote',said_by='$said_by' WHERE user_id='$global_id'");
	
 echo "<meta http-equiv=\"refresh\" content=\"0; url=$username\">";
	
	}else{
	    echo"<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Long one you need less than 150 characters.</div>";
	
	}
	}else{
           if(@$_POST['quote']!=""){
          $fav_quote=@$_POST['quote'];
}
	  $said_by=@$_POST['said_by'];

if(strlen($fav_quote)<150){
	 $info_submit_query=mysqli_query($connection,"INSERT INTO info_users VALUES('','$global_id','','','','','$fav_quote','$said_by','','')");
	 echo "<meta http-equiv=\"refresh\" content=\"0; url=$username\">";
     
	} else{
	    echo"<div style='padding:5px;width:300px;margin-left:300px;margin-top:20px;background-color:#000000;color:#fff; font-style:papyrus;font-size:15px;opacity:.8;'>Long one you need less than 150 characters.</div>";
	
	}

}
}
    $username1=strtolower($username1);
    if($username==$username1){
		?>
  <button id="myBtn_hell" style="cursor:pointer;font-size:12px;border:none;background-color:rgb(30,130,230);margin-left:10px;color:#fff;padding:5px;border-radius:2%;">Edit</button><br>
   <?php   } ?>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
        <span class="close">x</span>
     
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn_hell");

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
	<form action="#" method="POST" style="font-size:12px; padding:10px; color:#111;">
            Update status:  <input type="text" style="background-color:#fff;" name="quote" id="quote" size="60"  value="<?php echo $fav_quotation; ?>" placeholder="Write what inspire you in 50 characters " ></input>
                                                                      Said By:  <input type="text" style="width:10px; height:12px;background-color:#fff;" name="said_by" id="said_by"  value="<?php echo $said_by; ?>" placeholder="Write who inspire you " ></input><br>
            	<input type="submit" name="send_bio" id="send_bio" value="Update status"></input>
           </form>
		   
		   </center>
     </div>
</div>


 
 
 </div>
	

  
	

   <div id="profile_image" >  
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
   <div id="focus"style="font-size:14px;text-shadow:.2px .2px .2px #d9d9d9;font-family:helvetica;color:#000;width:300px;margin-left:150px;margin-top:20px;padding-right:20px;padding-left:20px;">
   <?php
       $about_query=mysqli_query($connection,"SELECT bio FROM myusers WHERE username='$username1'");
    $get_result=mysqli_fetch_assoc($about_query);
    $about_the_user=$get_result['bio'];
    echo $about_the_user;	
  ?> </div>
  
  <!-------------------------------buttons----------------------------------------------->
  

 <script>
 function myFunction1() {
    document.getElementById("myDropdown_hell").classList.toggle("show");
}
 </script>
 
 <?php
 if($username!="" &&$username!=$username1)
	  { ?>  
  <div class="dropdown">
  <button onclick="myFunction1()" style="text-align:center;width:40px;font-size:18px;font-weight:bold;" class="dropbtn">&#8964;</button>
  <div id="myDropdown_hell" class="dropdown-content">
   <?php } ?>
  <div class="buttons_for_user"  >

<?php     	  
 //Sending message  
      $username1=strtolower($username1);      		  
     if($username!="" &&$username!=$username1){
  $error_message= " <form action='send_msg1.php?u=$username1' method='POST'><div> <input type='submit' name='sendmsg' style='min-width:150px;' value='Message'/></div></form>
    " ;  
	echo $error_message;
	}

 ?>

  
  <script>
 function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
 
                     $(document).ready(function(){
	                        $('#remove').click(function(){
	                          jQuery.ajax({
		                        type: "POST",
							   url: "remove.php",
							   data: {username:"<?php echo $username;?>",
							          username1:"<?php echo $username1;?>"
							          },
							   dataType: "text",
							   success: function(data){	
							       alert(data);                          
							       }
							   });
							   
							   });
                    });
 
 </script>
 
  <?php 
         
         //for adding and message buttons
		$error_message="";
		if(isset($_POST['addfriend'])){
		$friend_requests= $_POST['addfriend'];
		$user_to= $username;
		$user_from= $username1; 
		 $friend_requests=mysqli_query($connection,"SELECT* FROM friend_requests WHERE user_from='$username'&& user_to='$username1' or user_to='$username1'&& user_from='$username'");
            $numrows= mysqli_num_rows($friend_requests);
        if($numrows>0){
           $error_message= "<div style='background-color:#000;position:absolute;top:-40px;font-family:papyrus;font-weight:bold;color:#fff;'>You Have already sent request.</div>";
		   
    }    else{
	      $create_request= mysqli_query($connection,"INSERT INTO friend_requests VALUES ('','$user_to','$user_from')");
		  $error_message="<div style='background-color:#000;position:absolute;top:-30px;font-family:papyrus;font-weight:bold;color:#fff;'>You have sent friend request to $firstname </div>";
}
	
		}
		else{
		//do nothing
		}
	if(isset($_POST['cancel_request'])){
	    $deleting=mysqli_query($connection,"DELETE FROM friend_requests WHERE user_from='$username' && user_to='$username1' or user_from='$username1' && user_to='$username'");
	
	
	}
	
	
        
		  
		 
    
          $friend_requests=mysqli_query($connection,"SELECT* FROM friend_requests WHERE user_from='$username' AND user_to='$username1' ");
            $numrows_requested= mysqli_num_rows($friend_requests);
			
		$friend_requests_find=mysqli_query($connection,"SELECT* FROM friend_requests WHERE user_from='$username1' AND user_to='$username' ");
            $numrows_find= mysqli_num_rows($friend_requests_find);
			
			$friendsArray ="";
	      $countArray ="";
	      $friendArray12="";
	      $selectFriendsQuery=mysqli_query($connection,"SELECT friend_array FROM myusers WHERE username='$username1'");
	      $friendRow=mysqli_fetch_assoc($selectFriendsQuery);
	      $friendArray=$friendRow['friend_array'];	 
	     
		  $i=0;

		
            if($friendArray!=""){
				//if users have friends
	     $friendArray=explode(",",$friendArray);
		 $countArray=count($friendArray);
		 $friendArray12=array_slice($friendArray,0,12);
		  if($username!="" &&$username!=$username1){
	      if(in_array($username,$friendArray) ){
		  $addAsFriend= '<button id="remove" style="text-align:center;">Unpick</button>';
		  }
		  elseif($numrows_requested==1)
		  {
		         $addAsFriend= '<div class="cancel_request"><button onclick="myFunction()" style="text-align:center; background-color: #3e8e41;width:150px;" class="dropbtn">Request Sent <span> &#8964;</span></button>
                     <div id="myDropdown" class="dropdown-content">
         <form action='.$username1.' method="POST"> <input type="submit" name="cancel_request" value= "Cancel Request"></form>
  </div></div>';
				
		}elseif($numrows_find==1)
		{
		          $addAsFriend= '<div class="fd_request" ><button onclick="myFunction()" style=" text-align:center;background-color: #3e8e41;font-size:15px;width:150px;" class="dropbtn">Sent you request <span>&#8964;</span></button><div id="myDropdown" class="dropdown-content"><form action='.$username1.' method="POST"><input type="submit" name="cancel_request" value="Cancel Request"></form></div></div>';
				 
		}  
		  else{
			  if($gender=="male"){
		      $addAsFriend= '<div class="picking"><form action='.$username1.' method="POST"> <input type="submit" name="addfriend" style="background-color:#3e8e41;" value= "Add him"></form></div>'; 
		  }elseif($gender==="female"){
		      $addAsFriend= '<div class="picking"><form action='.$username1.' method="POST"> <input type="submit" name="addfriend" style="background-color:#3e8e41;" value= "Add her"></form></div>'; 
		  }else{
			    
			  $addAsFriend= '<div class="picking"><form action='.$username1.' method="POST"> <input type="submit" name="addfriend" style="background-color:#3e8e41;" value= "Add friend"></form></div>'; 
		  
		  }
		  }
		   echo $addAsFriend;
		  }//if user has no friends
		 }else{
			 if($username!="" &&$username!=$username1){ 
		 if($numrows_requested==1)
		  {
		         $addAsFriend= '<div class="cancel_request"><button onclick="myFunction()" style="text-align:center; background-color: #3e8e41;width:150px;" class="dropbtn">Request Sent <span>&#8964;</span></button>
                     <div id="myDropdown" class="dropdown-content">
         <form action='.$username1.' method="POST"> <input type="submit" style="width:100%;" name="cancel_request" value= "Cancel Request"></form>
  </div></div>';
				
		}elseif($numrows_find==1)
		{
		          $addAsFriend= '<div class="fd_request" ><button onclick="myFunction()" style="text-align:center; background-color: #3e8e41;font-size:15px;width:150px;" class="dropbtn">Sent you request <span>&#8964;</span></button><div id="myDropdown" class="dropdown-content"><form action='.$username1.' method="POST"><input type="submit" name="cancel_request" style="width:100%;" value="Cancel Request"><input type="submit" style="width:100%;" name="acceptrequest<?php echo $user_from?>" value="Accept Request"/></form></div></div>';
				 
		}else{
		        if($gender=="male"){
		      $addAsFriend= '<div class="picking"><form action='.$username1.' method="POST"> <input type="submit" name="addfriend" style="background-color:#3e8e41;" value= "Add him"></form></div>'; 
		  }elseif($gender=="female"){
		      $addAsFriend= '<div class="picking"><form action='.$username1.' method="POST"> <input type="submit" name="addfriend" style="background-color:#3e8e41;" value= "Add her"></form></div>'; 
		  }else{
			   $addAsFriend= '<div class="picking"><form action='.$username1.' method="POST"> <input type="submit" name="addfriend" style="background-color:#3e8e41;" value= "Add friend"></form></div>'; 
		 
		  }
		  }
           echo $addAsFriend;
		 } 
		 }
		 

  
  ?>
  <script>
  $(document).ready(function(){                  
					    
						 $("#follow").mouseover(function() { 
                                if ($("#follow").html() == "Following") {						 
                                  $("#follow").html("Unfollow");
								}
								});
									 
									 $("#follow").mouseout(function() {     
                                 if ($("#follow").html() == "Unfollow") {						 
                                  $("#follow").html("Following");
								}
                                     });
								 
						
					  
					   $('#follow').click(function(){
						    var text_c = $('#follow').html();
						
							 if(text_c === "Follow"){
						   jQuery.ajax({
							   type: "POST",
							   url: "follow.php",
							   data: {u_id:"<?php echo $profile_id;?>"},
							   dataType: "text",
							   success: function(data){	
							        
							      $("#follow").html("Following");
                          
							       }
							   });
							}else if(text_c === "Unfollow"){
								 
								 jQuery.ajax({
							   type: "POST",
							   url: "follow.php",
							   data: {un_id:"<?php echo $profile_id;?>"},
							   dataType: "text",
							   success: function(data){	
							   $("#follow").html("Follow");
							  
							       }
							   });
							   
							  
							}  
  });  });
  
  
  </script>
  <?php
    if($username!="" &&$username!=$username1){
          $query=mysqli_query($connection,"SELECT*FROM follow WHERE followed_by='$username' && followed_to='$username1'");
		  if(mysqli_num_rows($query)==1){
			   ?>  <button id="follow" style="text-align:center;" >Following</button><?php
		 
			  }else{
			    ?>  <button id="follow"style="text-align:center;">Follow</button><?php
		 
		  }
	}
  ?>

  
     
	 
  </div>
   <?php if($username!="" &&$username!=$username1)
 { ?>
 </div> </div>
 <?php }?>
 
  </div>
  
  
 </div>
 
 
   <div id="greetings_for_profile"style="z-index:-1;">
   <!-------for user Greetings------>
   <img src='<?php echo$sign_pic; ?>' id='the_sign'style='position:fixed; top:60px; left:10px;height:<?php echo $height1_sign;?>px;width:<?php echo $wdth_sign;?>px;'/>
  
  <?php 
     $username1=strtolower($username1);
    $firstname=(strlen($firstname)>10) ? substr($firstname,0,10).'...' : $firstname;
if($username==$username1){ echo"	
 
<div class='greetings' style='font-size:25px;max-width:200px;word-wrap:break-word;text-shadow:1px 1px 1px #fff;font-family:Helvetica;color: rgb(30,130,230);z-index: 1;'>$firstname</div>
	";}	
  else{
  echo "
  <div class='greetings' style='font-size:25px;max-width:200px;word-wrap:break-word;text-shadow:1px 1px 1px #fff;font-family:Helvetica;color: rgb(30,130,230);z-index: 1;'>$firstname</div>";}
  ?>
  </div>
 
 
 
 <?php  If($username){  ?>




<!----------------------------Profile starts------------------------->
<div id="profile_wrapper">
  <div id="postForm">
 <div id="poster">
  <script>
	$(document).ready(function (e) {
	  // Function to preview image after validation
$(function() {
$("#fileID_post").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#previewing').attr('src','noimage.png');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
	 function imageIsLoaded(e) {	
$("#fileID_post").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '150px');
$('#previewing').attr('height', '130px');
};
});
	 

function togglepost(){  
var ele = document.getElementById("image_preview");
                                                if (ele.style.display == "block") {
                                                ele.style.display = "none";
                                                   }
                                                    else
                                                   {
                                                  ele.style.display = "block";
                                                     }
                                                    }	 
	 </script> 
  <form action="<?php echo $username1;?>" method="POST" enctype="multipart/form-data" style="padding-left:20px; padding-bottom:30px; ">
  <img src="./img/camera.png" onclick="togglepost()"title="Upload image"style="height:30px;cursor:pointer; width:30px;margin-left:250px;"/>
    <input type="file" id="fileID_post" name="pic" accept="image/*" style="visibility: hidden;background-color:transparent;"  />
  <textarea id="post" name="post" rows="2" cols="60" title="What u r upto" placeholder="Shuru karo Vaartalaap.........." style="height:30px;font-size:15px;width:440px;" ></textarea> 
    <center><div id="image_preview" style="margin-top:5px;display:none;"> <a href="#" onclick="document.getElementById('fileID_post').click(); return false;" value="url()" /><img id="previewing" src="img/noimage.png" /></a></div></center>
	<input type="submit" name="send"  value="Stick it" style="margin-right:30px;margin-top:-37px;height:35px;background-color:DCE5EE; float:right; border:1px solid #656;"/>
  </form>
   <div id="name"><h3 style="text-align:center;margin-bottom:10px;font-family:papyrus;color:#000;"> <?php echo $username1; ?>'s posts </h3>  </div>
  </div>
  <div id="profilePost"> 
    <script>
  $("#profilePost").load("get_pro_post.php?u=<?php echo $username1;?>");	
</script>
  </div> 
  </div>
	<div class="sticky2">
	
  <div class="user_friends"style="color:#000;font-size:12px;text-align:center;">
  <a href="photos.php?id=<?php echo $profile_id; ?>" ><?php echo $firstname; ?>'s photos</a>
	
	 <div id='profileFriends'>
    
       <?php
	    $get_Profile=mysqli_query($connection,"SELECT* FROM posts WHERE added_by='$username1' && post_image!='Nothing' ");
                      if($get_Profile){
					  while($get_PI=mysqli_fetch_assoc($get_Profile)){	
					      $image=$get_PI['post_image'];
						  $body=$get_PI['body'];
                         
					   	   $image="userdata/data_pics/".$image;
						   if(file_exists($image)){
						   
                            echo "<img src='$image' style=' box-shadow:1px 1px 1px #769DD3;border:1px solid #769DD3;float:left;height:54px;width:52px;'/>";
	   } 						   
					  }
					  }else{
	    echo "<div id='error_' style='padding:5px;margin-top:20px;background-color:#000000;color:#fff;z-index:4; font-style:papyrus;font-size:15px;opacity:.8;'>You don't have data images yet</div>";
	 
	 }
	 
	   ?>
	    
     </div>	  
	<br>
     <a href="friends.php?id=<?php echo $profile_id; ?>" style="padding-top:10px;"> <?php echo $firstname; ?>'s Friends</a>
  <?php
     echo "<div id='profileFriends' style='padding:2px;background-color:#fff;font-family:papyrus; '>";
	 
	 if($countArray !=0){
	     foreach($friendArray12 as $key => $value){
		     $i++;
			 $getFriendQuery=mysqli_query($connection,"SELECT* FROM myusers WHERE username='$value' LIMIT 1");
			 $getFriendRow=mysqli_fetch_assoc($getFriendQuery);
			 $friendUsername=$getFriendRow['username'];
			 $friendProfilePic=$getFriendRow['profile_pic'];
			 if($friendProfilePic==""){
			     echo"<a href ='$friendUsername'><img src='img/default-pic.png' alt='$friendUsername 's Profile' title='$friendUsername's Profile ' height='53' width='53' style='float:left;border:.1px solid rgba(50,50,50,.1);'></a> ";
				 }
				 else{
				     echo "<a href ='$friendUsername'><img src='userdata/profile_pics/$friendProfilePic' alt='$friendUsername 's Profile' title='$friendUsername 's Profile ' height='53' width='53' style='float:left;border:.1px solid rgba(50,50,50,.1);'></a> ";
				 }
		 }
		 }
	 else{
	 echo "$firstname have no friends yet! make Some :)";
	 }
	 echo "</div>";
	 $followers_user=mysqli_query($connection,"SELECT *FROM follow WHERE followed_to='$username1'");
	 $num_followers=mysqli_num_rows($followers_user);
	 
  ?>
    <!---------Followers----->
	<br><a href="friends.php?id=<?php echo $profile_id; ?>" style="padding:10px;" ><?php echo $firstname; ?>'s followers(<?php echo $num_followers;?>)</a>
   <div id='profileFriends' >
      <?php 
	     if( $num_followers!=0){
			while($get=mysqli_fetch_assoc($followers_user)){
			 //getting info of users
			 $following_by=$get['followed_by'];
			 $user=mysqli_query($connection,"SELECT * FROM myusers WHERE username='$following_by'");
	     if(mysqli_num_rows($user)==1){
		$get=mysqli_fetch_assoc($user);
		$user_follow=$get['username'];
		$user_follow_pic=$get['profile_pic'];
		if($user_follow_pic==""){
			$the_pic="img/default-pic.png";
		}else{
			$the_pic="userdata/profile_pics/".$user_follow_pic;
		}
		 echo "<img src='$the_pic' title='$following_by'style=' box-shadow:1px 1px 1px #769DD3;border:1px solid #769DD3;float:left;height:54px;width:52px;'/>";
		 }
			}
		 }else{
			 echo "You do not have followers yet";
		 }
	  ?>
	</div>
  <!---------Info----->
 <br><a href="friends.php?id=<?php echo $profile_id; ?>" style="padding:10px;" ><?php echo $firstname; ?>'s Info</a>
  <div id='profileFriends' >
      
	      <label> Nationality</label> <?PHP ECHO "$country";?><br><br>
	     <label>Hobby</label> <?PHP ECHO "$hobby";?><br><br>
		 
		 <label>Designation</label> <?PHP ECHO "$designation";?>
	</div><br>
	 
       
	     <div style="text-align:center;font-family:helvetica;text-shadow:.1px .1px .1px #f2f2f2;margin-top:20px;"> <?php echo $firstname; ?>'s Shashtra</div>
	<div id="shashtra_user" style='padding:5px;background-color:#fff;font-size:15px;font-family:helvetica;text-shadow:.1px .1px .1px #f2f2f2; '>
	
	    <?php
         $shashtra_query=mysqli_query($connection,"SELECT *FROM shashtra WHERE username='$username1'");
		 if((mysqli_num_rows($shashtra_query))>=1){
		 while($get=mysqli_fetch_assoc($shashtra_query)){
		     $shashtra_url=$get['shashtra_url'];
			 $shashtra_name=$get['shashtra_name'];
			 $shashtra_pic=$get['shashtra_pic'];
		    
		  if ($shashtra_pic == "") {	
  $shashtra_avatar ="img/default-pic.png";
  }
  elseif(file_exists("userdata/data_pics/".$shashtra_pic))
  {
  $shashtra_avatar= "userdata/data_pics/".$shashtra_pic;
  }else{
	  $shashtra_avatar= "userdata/profile_pics/".$shashtra_pic;
  }
     
	 echo "<a href='shashtrartha.php?str=$shashtra_url' style='text-decoration:none; color:#000;'><table><tr><td style='width:20%;'><img src='$shashtra_avatar' style='width:30px; height:30px; border-radius:30%; box-shadow:1px 1px 1px #000;'/> </td><td style='width:55%;font-size:15px;'>$shashtra_name </td></tr></table></a>";
		 
		 
		 }
		 
		 
		 
		 
		 }
		 


		?>
	</div>
	 </div>
	 
	 </div>


</div>
</div><?php }else{
	?>
	</div>
	<?php
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
          
   echo "<meta http-equiv=\"refresh\" content=\"0; url=$username1\">";
   exit();
	}else{
	
	
	echo'<center>
         <div id="sign_in">
		<div id="login_error">Your login Incorrect try again!</div><br>
		   <form action="index.php" method="POST"style="margin-left:55px;margin-top:40px;">
		    <input type="text" name="user_login" size="25" placeholder="Username" autofocus style="color:#000;"/><p/>
			  <span><input type="password" name="password_login" size="25" placeholder="Password"/><p/></span>
			  <input type="submit" name="login" value="Sign In" style="margin-left:130px;margin-top:10px;"/>
		   </form>
		   <a href="forgot.php" style="text-decoration:none;font-size:10px;">Forgot password</a> 
		   </div></center>';
	   exit();
	
}}?> 

		
         <div style="width:400px;color:#fff;background-color:rgb(60,160,260);font-size:15px;margin-left:570px;text-align:center;margin-top:50px;padding-top:10px;padding-bottom:10px;font-family:helvetica;">
		  Do you know <?php echo $firstname ?> <br>Log in or Sign Up<br><br>
           <center>		  
		   <form action="<?php echo $username1;?>" method="POST"style="padding:10px;width:100%;background-color:#fff;">
		    <input type="text" name="user_login" autofocus placeholder="Username" style="width:180px;color:#000;"/><p/>
			  <span><input type="password" name="password_login" placeholder="Password" style="width:180px;"/><p/></span>
			  <input type="submit" name="login" value="Sign In" style="width:180px;border-radius:0px;margin-top:10px;border:1px solid rgba(50,50,50,.4);box-shadow:none;padding:8px;"/>
		   </form></center>
		   <center style="margin-top:20px;">
		   <a href="index.php" onmouseover="style='text-decoration:underline;font-size:16px;color:#fff;'" onmouseout="style='text-decoration:none;font-size:15px;color:#fff;'" style="text-decoration:none;font-size:15px;color:#fff;">Sign up</a>
		   <a href="forgot.php" style="text-decoration:none;font-size:10px;color:#fff;">Forgot password</a> </center>
		   </div>
		   
<?php }?>