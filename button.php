	<?php if($username){ ?>
   

<script>
$(function () { // dom ready
    var $meta = $('meta[name=robots]').attr('content', 'noindex');
    $('body').text($meta.attr('content'));​
});
</script>   
		<div class="buttons" >
	
		<a href="home.php" title="Home page" style="text-decoration:none;">
		<div class="home_button"  >
		
<!---------------------------------------Home Page link-------------------------------->
  <?php echo '<div id="post-image_2" style="margin-left:25px; ">
                                                <img src='.$profilepic_info_user.'  style="width:30px; height:30px;border-radius:50%;">
                                                </div><div id="namaskaar" style="padding:2px;float:left;margin-left:10px;margin-top:15px;font-size:12px;">Home</div> '	;										
												
												?>
 
 

 </div>
   </a>

		 <!---------------------------------------Profile Link-------------------------------->
		 <?php
		 echo'
           <a href="'.$username.'" title="Profile of '.$username.'" style="text-decoration:none;" >';?>
		 <div class="profile_button"  >
		   
  <?php echo '<div id="post-image_2" style="margin-left:25px; ">
                                                <img src='.$profilepic_info_user.'  style="width:30px; height:30px;border-radius:50%;">
                                                </div><div id="namaskaar" style="padding:2px;margin-left:10px;float:left;margin-top:15px;font-size:12px;">Profile</div>											
												';
												?> 
												</div>
												</a>
	<!---------------------------------------Messages Link-------------------------------->
		<a href="my_messages.php?c_id=<?php echo $c_id_fk; ?>" title="Messages" style="text-decoration:none;">
		<div class="msg_button"type="button" title="Messages" action="my_messages.php" >
       <?php if($unread_numrows>99){$unread_numrows="99+";}echo'  <span>';if(!$unread_numrows){echo'<div id="post-image_2" style="overflow:hidden;margin-left:25px; "><img style="border-radius:50%;float:left;height:30px;width:30px;margin-bottom:3px;" src="./img/mail.png" ></div><div style="margin-left:10px; font-size:12px;float:left;margin-top:20px;">Messages</div>';}else{echo'<div id="post-image_2" style="overflow:hidden;margin-left:25px; "><img style="height:30px;width:30px;float:left;border-radius:50%" src="./img/mail.png"></div><div style="color:#111; font-family:helvetica;float:left;margin-left:-53px;margin-top:10px;font-size:12px;border-radius:50%;background-color:rgba(250,250,250,.9); text-align:center;min-width:20px;">'.$unread_numrows.'</div><div style="margin-left:10px; font-size:12px;float:left;margin-top:20px;">Messages</div>';} echo'</span>';?>
		 </div>
		 </a>
		
     <!---------------------------------------Account settings link-------------------------------->
		 <a href="account_settings.php" title="Account Settings" style="text-decoration:none;border-radius:50%;">
		<div class="settings_button"type="button" title="Messages" action="my_messages.php" >
        <div id="post-image_2" style="overflow:hidden;margin-left:25px; "> <img style="border-radius:50%;float:left;height:30px;width:30px;margin-bottom:3px;" src="./img/set.png" >
	</div><div style=" font-size:12px;margin-left:10px;margin-top:15px;float:left;">Settings</div>	</div>
		 </a>
		
		 <!---------------------------------------Friend Requests link-------------------------------->
		 <a href="friend_requests.php" title="Friend Requests" style="text-decoration:none;height:auto;width:auto;border-radius:50%;">
		<div class="fr_button"type="button" title="Friend Requests" action="my_messages.php" >
        <?php echo'<div id="post-image_2" style="overflow:hidden;margin-left:25px; "><img style="border-radius:50%;float:left;height:30px;width:30px;margin-bottom:3px;" src="./img/friend.jpg" ></div>';if($friend_numrows>99){$friend_numrows="99+";}if($friend_numrows!=""){echo'<div style="color:#fff;font-family:helvetica;font-size:15px;border-radius:50%; background-color:blue;text-align:center;margin-top:20px;margin-left:-50px;min-width:20px;float:left;">'.$friend_numrows.'</div><div style="margin-left:10px; font-size:12px;float:left;margin-top:20px;">Requests</div> ';}else{echo'<div style="margin-left:10px; font-size:12px;float:left;margin-top:20px;">Requests</div>';}?> 
		</div>
		 </a>
		  <a href="suchana.php" title="Suchana(Notification)" style="text-decoration:none;height:auto;width:auto;border-radius:50%;">
		<div class="suchana_button"type="button" title="Suchana(Notification)"  >
        <?php echo '<div id="post-image_2" style="overflow:hidden;margin-left:25px; "><img style="border-radius:50%;float:left;height:30px;width:30px;margin-bottom:3px;" src="./img/news.jpg" ></div>'; if($numrows_suchana>99){$numrows_suchana="99+";}if($numrows_suchana!=""){echo'<div style="font-family:helvetica;float:left;margin-left:15px;margin-top:15px;">Suchana</div><div style=" font-family:helvetica;font-size:12px;border-radius:50%; background-color:blue;text-align:center;margin-top:10px;margin-right:15px;min-width:20px;float:right;">'.$numrows_suchana.'</div> ';}else{echo'<div style="font-family:helvetica;margin-left:10px;float:left;margin-top:15px;font-size:12px;">Suchana</div>';}?> 
		</div>
		 </a>
		</div>
		<?php }?>