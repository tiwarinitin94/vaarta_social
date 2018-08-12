<?php include("./inc/header.inc.php");?>


<?php
     if(!$username){
 echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
  }
  else{ 
                 
?> 
<script>

document.getElementById("logo").src="./img/v.png";
</script>
<style>
body{

font-weight: inherit;
font-style: inherit;
}
.header20{
       background-color: rgba(230,70,70,1); 
	}
</style>


<div id="main">
 <?php

//for posting


    $post_pic="";
	$post="";
  //Sending post to database   

  
   if(isset($_POST['post'])){ 
       $post = @$_POST['post'];
         
      
    if(isset($_FILES['pic'])){
		print_r($_FILES['pic']);
       $type=@$_FILES["pic"]["type"];
		
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
    $user_posted_to = $username;
   $sqlCommand = "INSERT INTO posts VALUES('','$post','$date_added','$added_by','$user_posted_to','$rand_dir_name/$post_pic','')";  
      $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());	
    	 }         
   }
  }
  else
  {  if ($post!="")
	  { $date_added = date("Y-m-d");
    $added_by = $username;
    $user_posted_to = $username;
    $sqlCommand = "INSERT INTO posts VALUES('','$post','$date_added','$added_by','$user_posted_to','Nothing','')";  
   $query = mysqli_query($connection,$sqlCommand) or die (mysqli_error());
   }else{
       echo "<div style='position:absolute;background-color:#000;z-index:4;color:#fff; top:150px;margin-left:550px;'>Kuchh to bolo............Write something....!</div>";
   }
  }
   }
   }
   //getting more information
   $country="Enter country";
   $audaa="Enter what you are working on";
   $karma="Enter your hobbies";
  $fav_quote="Enter your Favorite quotation";
     $sign_pic = "img/v.png";
    $check_bio=mysqli_query($connection,"SELECT *FROM info_users WHERE user_id='$global_id'");
   $numrows_bio=mysqli_num_rows($check_bio);   
   if($numrows_bio!=0){
           $info_bio=mysqli_fetch_assoc($check_bio);
        $country=$info_bio['country'];
		$audaa=$info_bio['designation'];
		$karma=$info_bio['hobby'];
		$fav_quote=$info_bio['fav_quote'];
		$sign_pic_db=$info_bio['signature'];
		if ($sign_pic_db=="") {
        $sign_pic = "img/v.png";
     }
          else
      {
         $sign_pic = "userdata/data_pics/".$sign_pic_db;
      }
		 
   }
 ?>
 
 <!---------------------------------right- side------------------------------->
 
	
	 <div class="user_data">	
	 <div id='user_data1' >
	 <div class="small_cover"> <img src='<?php echo $coverpic_info_user ?>' title="<?php echo $username ?>" height='90'style='width:100%;'>
                       <a href='<?php echo $username;?>' ><img src='<?php echo $profilepic_info_user ?>' title="<?php echo $username ?>" height='90' width='90'style='margin-top:-30px;box-shadow:.2px .5px .6px #769DD3;padding:2px;border-radius:50%;'></a>
                         </div>  </div>
						   
<div class="differ" ><?php echo "Vadakkam- <a href='$username' style='font-size:13px;font-family:papyrus;text-decoration:none;color:#fff;'>$username </a><br> $country <br> $audaa<br><br><img src='$sign_pic' style='width:100px; height:30px;'/>" ; ?> 
						</div>  
	<div style="margin-top:5px;background-color:#fff; font-size:15px; text-align:center;height:25px;padding:.3px;">Apps</div><div id="shashtra" ><a href="create_shashtra.php">Create a shashtra</a></div>
	<div class="album_of_user_home" >
   <a href='photos.php?id=<?php echo $global_id; ?>' style="text-decoration:none;" >
	  	      <?php
	       $get_Profile=mysqli_query($connection,"SELECT* FROM posts WHERE added_by='$username' && post_image!='Nothing' ");
                      if($get_Profile){
					  while($get_PI=mysqli_fetch_assoc($get_Profile)){	
					      $image=$get_PI['post_image'];
						  $body=$get_PI['body'];
                         
					   	   $image="userdata/data_pics/".$image;
						   if(file_exists($image)){
						   list($width,$height)=getimagesize("$image");
						   if($width >150){
								  $wdth=150;
								  $height1=($height/$width)*$wdth;
							  }
                            echo "<img src='$image' style=' box-shadow:1px 1px 1px #769DD3;border:1px solid #769DD3;float:left;height:54px;width:50px;'/>";
	   } 						   
					  }
					  }else{
						  echo "problem";
					  }
					  
	   ?>
    	  
	   </a>

	 
</div> </div>
					
						


	
	 <!------------------------News and posting-----------------------> 
	      <div class="postForm1" > 
     <div id="poster">	
      <script>
	$(document).ready(function (e) {
	  // Function to preview image after validation
$(function() {
$("#file").change(function() {
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
$("#file").css("color","green");
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
	
   <form action="" method="POST" enctype="multipart/form-data" style="background-color:#fff;border:.1px solid rgba(20,20,20,.2);border-radius:2%;padding-bottom:32px;padding-top:10px;padding-left:10px;">
      <img src="./img/camera.png" onclick="togglepost()"title="Upload image"style="cursor:pointer;height:30px; width:30px;margin-left:250px;"/>
    <input type="file" id="file" name="pic" accept="image/*" style="visibility: hidden;background-color:transparent;"  />

  <textarea id="post" name="post" rows="2" cols="60" title="What u r upto" placeholder="Shuru karo Vaartalaap.........." style="height:30px;font-size:15px;width:420px;" ></textarea> 
 <script>
//This span is used to measure the size of the textarea
//it should have the same font and text with the textarea and should be hidden
var span = $('<span>').css('display','inline-block')
                      .css('word-break','break-all')
                      .appendTo('body').css('visibility','hidden');
function initSpan(textarea){
  span.text(textarea.text())
      .width(textarea.width())
      .css('font',textarea.css('font'));
	 
}
$('#post').on({
    input: function(){
       var text = $(this).val();      
       span.text(text);      
       $(this).height(text ? span.height() : '1.1em');
    },
    focus: function(){           
       initSpan($(this));
	
    },
    keypress: function(e){
       //cancel the Enter keystroke, otherwise a new line will be created
       //This ensures the correct behavior when user types Enter 
       //into an input field
       if(e.which == 13) {
		   
		   //repeat the function
		   
	   }
    }
});	
</script> 
   <center><div id="image_preview" style="margin-top:5px;display:none;"><a href="#" onclick="document.getElementById('file').click(); return false;" value="url()" /><img id="previewing" src="img/noimage.png" /></a></div></center>

  <input type="submit" name="send"  value="Stick it" style="margin-right:30px;margin-top:-37px;height:35px;background-color:DCE5EE; float:right; border:1px solid #656;"/>
   </form>
  
<div id="message"></div>
   </div>



<div id="newsfeed_home_friends">
    <div id="name"><h3 style="margin-left:30px;margin-bottom:10px;font-family:papyrus;color:#fff;"> Friends News </h3>  </div>
	
<script>
  $("#newsfeed_home_friends").load("get_post.php");	
</script>

</div>	   </div>	
 	

   <div id="vaarta_suggestion">
	 <div id="suggetion"> Friends Suggetions</div>
	<center> <a href="all_suggest.php" style="margin-top:10px;text-decoration:none;font-size:15px; color:#000;">See all</a> </center>
	 <?php
	 
	 /*getting the details of users who belong to user*/
	        $friendsArray_suggest ="";
	      $countArray_suggest ="";
	      $friendArray12_suggest=""; 
		  $friendsArray_suggested ="";
	      $countArray_suggested ="";
	      $friendArray12_suggested="";
	      $selectFriendsQuery_suggest=mysqli_query($connection,"SELECT friend_array FROM myusers WHERE username ='$username'");
	      $friendRow_suggest=mysqli_fetch_assoc($selectFriendsQuery_suggest);
	      $friendArray_suggest=$friendRow_suggest['friend_array'];	 
	       
		  $i_suggest=0;
            
            if($friendArray_suggest!=""){
	     $friendArray_suggestion=explode(",",$friendArray_suggest);
		 $countArray_suggest=count($friendArray_suggest);
		 $friendArray12_suggest=array_slice($friendArray_suggestion,0,12);
		 
		 if($countArray_suggest !=0){
	     foreach($friendArray12_suggest as $key_suggest => $value_suggest){
		     $i_suggest++;
			 $getFriendQuery_suggest=mysqli_query($connection,"SELECT* FROM myusers WHERE username='$value_suggest' LIMIT 1");
			 $getFriendRow_suggest=mysqli_fetch_assoc($getFriendQuery_suggest);
			/*users friendArray ->*/$friendUsername_suggestion=$getFriendRow_suggest['username'];
			 $get_suggest_query=mysqli_query($connection,"SELECT friend_array FROM myusers WHERE username='$friendUsername_suggestion'");
			 $suggestions_query=mysqli_fetch_assoc($get_suggest_query);
			 $suggested_friends=$suggestions_query['friend_array'];
				
			 //getting friends of freinds
			 if($suggested_friends!=""){
	     $suggested_friends=explode(",",$suggested_friends);
		 $countArray_suggested=count($suggested_friends);
		 $friendArray12_suggested=array_slice($suggested_friends,0,12);
		 
		 if($countArray_suggested !=0){
		 foreach($friendArray12_suggested as $key_suggested => $value_suggested){
		     $i_suggest++;
			 $getFriendQuery_suggested=mysqli_query($connection,"SELECT* FROM myusers WHERE username='$value_suggested' LIMIT 1");
			 $getFriendRow_suggested=mysqli_fetch_assoc($getFriendQuery_suggested);
			/*users friend's friendArray ->*/ $friendUsername_suggested=$getFriendRow_suggested['username'];
			$friendUsername_suggested=strtolower($friendUsername_suggested);
			if(strstr($friendArray_suggest,$friendUsername_suggested) || strstr($friendUsername_suggested,$username)){
			   
			}
			else{	
               			
			 $get_user_info = mysqli_query($connection,"SELECT * FROM myusers WHERE username='$friendUsername_suggested' ");
                             
                                                $get_info = mysqli_fetch_assoc($get_user_info);
											    $profilepic_info_suggested = $get_info['profile_pic'];
                                                if ($profilepic_info_suggested == "") {
                                                 $profilepic_info_suggested = "img/default-pic.png";
                                                }
                                                else
                                                {
                                                 $profilepic_info_suggested = "./userdata/profile_pics/".$profilepic_info_suggested;
                                                }
												//adding friend
	 $error_message="";
		if(isset($_POST['addfriend'])){
		$friend_request= $_POST['addfriend'];
		$user_to= $username;
		$user_from= $friendUsername_suggested; 
		 $friend_requests=mysqli_query($connection,"SELECT* FROM friend_requests WHERE user_from='$username'&& user_to='$friendUsername_suggested'");
            $numrows= mysqli_num_rows($friend_requests);
        if($numrows>=1){
           echo "<div style='position:absolute;top:-40px;font-family:papyrus;font-weight:bold;color:#fff;'>You Have already sent request.</div>";
		   
    }    else{
	      $create_request= mysqli_query($connection,"INSERT INTO friend_requests VALUES ('','$user_to','$user_from')");
		  echo "<div style='position:absolute;top:-40px;font-family:papyrus;font-weight:bold;color:#fff;'>You have sent friend request to $firstname </div>";
}
	
		}
		else{
		//do nothing
		}    echo "<center><div id='suggest_user' ><a href='$friendUsername_suggested' style='text-decoration:none;font-weight:bold;color:#000;font-family:helvetica;font-size:13px;'><img src='$profilepic_info_suggested' title='$friendUsername_suggested' style='background-color:#769DD3;padding:2px;box-shadow:2px 2px 2px #000;border-radius:50%;cursor:pointer;box-shadow:4px 4px 4px rgba(4px 4px 4px 4px); height:30px; width:30px;'/>$friendUsername_suggested</a></div></center>";                    
												
			}
			 }
	 }
	  }else{
			echo "<div style='margin-top:20px;text-align:center;font-family:papyrus; font-size15px;'>No suggetions Found</div>";
			}
	 }
	 }
	 }else{
			echo "<div style='margin-top:20px;text-align:center;font-family:papyrus; font-size:15px;'>No suggetions Found</div>";
			}
	 ?>
	
	 </div>  
 <div id="on_footer">
 <div id="home_footer" >
<div id="home_footer_copy_right">
    <a href="about.php">About</a>|<a href="home.php">Home</a>|<a href="<?php echo $username;?>">Profile</a>|<a href="feedback.php">Feedback</a>|<a href="http://ni3tiwari.blogspot.com">Nitin Tiwari</a>Production. (c) All rights reserved.
</div>
</div>
</div>



<?php }?>
</div>