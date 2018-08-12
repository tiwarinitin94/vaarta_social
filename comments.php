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
 <?php
echo"<div id='wrapper1'>  <center style='margin-top:60px;'>";
if(isset($_GET['s_id'])){
   $get_id= $_GET['s_id'];

     $get_post_query=mysqli_query($connection,"SELECT* FROM posts WHERE id='$get_id'");
	 if(($numrows=mysqli_num_rows( $get_post_query))>=1){
	 $row=mysqli_fetch_assoc($get_post_query);
	 
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
										 
<?php											 
		   $uid=$id;
         $uid=md5($uid);
		    if(@$_POST['delete_'.$id.'']){              
			   $delete_Post_Query=mysqli_query($connection,"DELETE FROM posts WHERE id='$id' && user_posted_to='$username'");
			   echo "<meta http-equiv=\"refresh\" content=\"0; url=$username\">";
			 }  
			  //re share
			 if(@$_POST['re_stick_'.$id.'']){     
               $get_posts=mysqli_query($connection,"SELECT *FROM posts WHERE id='$id'");
	           if((mysqli_num_rows($get_posts))==1){
	            $get_post=mysqli_fetch_assoc($get_posts);
	         $body=$get_post['body'];
	             $date=$get_post['date_added'];
	         $added_by_share=$get_post['added_by'];
	          $user_posted_to=$get_post['user_posted_to'];
	         $post_image=$get_post['post_image'];	        
                  $share_post=mysqli_query($connection,"INSERT INTO posts VALUES('','$body ','$date','$username','$username','$post_image','$added_by_share')");
	         	 echo "<meta http-equiv=\"refresh\" content=\"0; url=$username\">";
	  }	
			   
			 } 
			 

    echo "	<div id='status' style='float:center; '>
	
                                                <div id='post-image' style='float: left; '>
                                                <img src='$profilepic_info' height='60' width='60' style='border-radius:50%;'>
                                                </div>
						<div class='posted_by'>
						Shri:
                                                <a href='$added_by'>$added_by</a><br> on $date_added</div>
												";
												if($user_posted_to==$username || $added_by==$username){
												echo"<form method='POST' action='comments.php?s_id=$id' name='deleteing'>
	                                                  <input type='submit' value=\"x\"  title='Delete the post' name='delete_$id' style='float:right;margin-right:5px;height:15px;font-size:10px;line-height:10px;'/>
                                            </form>";
											}echo"
											<br /><br /><br><hr style='background-color:#fff;height:2px;'></hr>
                                                <div id='status1' style='max-width:100%;margin-left:10px;'>
												";
											if($if_shared!=""){
												  echo"<div style='background-color:#000;color:#fff;'>$added_by shared $if_shared's post</div>";
												  
											  } echo "
												$body <br>
												";
												if($post_pic1!="Nothing"){ 
												    if(file_exists("userdata/data_pics/$post_pic1")){
												   echo "<img style='-moz-box-shadow:2px 2px 5px black;box-shadow:1px 1px 1px black;width:480px;height:600px;margin-top:8px;margin-bottom:8px;' src='userdata/data_pics/$post_pic1'>";
												}else{
												 echo "<img style='-moz-box-shadow:2px 2px 5px black;box-shadow:1px 1px 1px black;width:480px;height:600px;margin-top:8px;margin-bottom:8px;' src='userdata/profile_pics/$post_pic1'>";
												}						
												}
												echo "                                                
                                                </div>
												
												<div class='active_buttons'>
												<input type='button' style='margin-left:15px;float:left;margin-top:2px;' onClick='javascript:toggle$id()' value='Comments(Tippadi)'> </input>
												<div id='man' style='margin-top:3px;float:left; '><iframe src='like_but.php?uid=$uid' style='border:0; height:24.5px;background-color:#fff;width:120px; '></iframe></div>
												<div id='man' style='margin-top:2px;float:left; '><iframe src='dislike.php?uid=$uid' style='border:0; height:24.5px;background-color:#fff;width:120px; '></iframe></div>
												<form method='POST' action='comments.php' name='sharing'>
												<input type='submit' style='border:none; border:1px solid #00508D;box-shadow:none;margin-left:0px;float:left;margin-top:2px;' name='re_stick_$id' value='Re-Stick-)'></input>
												</form>
												 <iframe src='comment_box.php?id=$id' frameborder='0' style='margin-top:10px;height:auto;min-height:20px;width:100%;'></iframe>
												

												
												</div>	
                                            </div>												
                                                <hr />
												
						";
						}else{
	     echo "page not found";
	 
	 }

						
						
			
	 
	 }

?><h2 style="margin-top:30px;font-style:papyrus;font-size:60px;opacity:.2;">You become what you say</h2><br> <h2 style="padding-bottom:60px;margin-top:30px;font-style:papyrus;font-size:20px;">Choose your words carefully :) - Vaarta </h2> 

</center>
     

</div>