<?php 

 include("./inc/connect.inc.php");
?>


<?php if($username){

	 

   
	
	  
    ?>

         <center>
         <img src="./img/welcome.png" style="-box-shadow:5px 5px #fff;margin-top:10px;"></img>
		 
		<div class="newsfeed" >

		<a href="home.php" title="Home page" style="text-decoration:none;color:#000000;border-radius:50%;overflow:hidden;">
		<div class="left_at_home"  >
		
<!---------------------------------------Home Page link---------------------------
<div id="greetings" style="font-size:20px;margin-top:100px;margin-left:80px;font-weight:bold; font-style:Arial;padding:10px; color:transparent;-moz-text-shadow:1px 1px 1px black;text-shadow:1px 1px 1px black;">'.$firstname.' '.$lastname.'<br>('.$username.') </div>
												<div id="bio" style="color:#fff; font-size:10px;font-weight:bold;font-style:verdana;margin-left:80px;border:1px solid ;width:150px;">.'.$bio.'</div>';
----->
  <?php echo '<div id="namaskaar" style="-moz-text-shadow:.5px .5px .5px #111;text-shadow:.9px .9px .9px #000;padding:2px;margin-left:50px;margin-top:20px;float:center;font-weight:bold;font-family:papyrus;color:#fff;">Home</div> <div id="post-image_2" style="margin-left:30px; ">
                                                <img src='.$profilepic_info_user.' height="80px" width="80px;"style="border-radius:50%;">
                                                </div>'	;										
												
												?>
 
 

 </div>
    </a>
	<!---------------------------------------Messages Link-------------------------------->
		<a href="my_messages.php?c_id=<?php echo $c_id_fk;?>" title="Messages" style="text-decoration:none;height:auto;width:auto;border-radius:50%;">
		<div class="right-side"type="button" title="Messages" action="my_messages.php" >
       <?php echo'  <span>';if(!$unread_numrows){echo'<div style="-moz-text-shadow:.5px .5px .5px #fff;text-shadow:.9px .9px .9px #000;font-family:papyrus;color:#fff; font-weight:bold; font-size:18px;margin-left:20px;margin-top:60px;">Messages</div><img style="margin-left:60px;height:50px;width:50px;margin-bottom:3px;" src="./img/mail.png" >';}else{echo'<div style="font-family:papyrus;-moz-text-shadow:.9px .9px .9px #000;text-shadow:.9px .9px .9px #000;color:#fff; font-weight:bold; font-size:20px;margin-left:20px;margin-top:60px;">Messages</div><img style="margin-left:60px;height:50px;width:50px;" src="./img/mail.png"><div style="margin-left:80px;color:#000000;border-radius:50%; background-color:#fff;text-align:center;font-size:20px;width:20px;margin-top:-40px;">'.$unread_numrows.'</div>';} echo'</span>';?>
		 </div>
		 </a>
		 <!---------------------------------------Profile Link-------------------------------->
		 <?php
		 echo'
           <a href="'.$username.'" title="Profile of '.$username.'"  >';?>
		 <div class="profile_link"  >
		   
  <?php echo '<div id="namaskaar" style="padding:2px;margin-left:50px;margin-top:15px;float:center;font-weight:bold;color:#fff;font-family:papyrus;-moz-text-shadow:.9px .9px .9px #000;text-shadow:.9px .9px .9px #000;">Profile</div>  <div id="post-image_2" style="margin-left:30px; margin-top:5px;">
                                                <img src='.$profilepic_info_user.' height="80px" style="border-radius:50%;width:80px;">
                                                </div>											
												';
												?> 
												</div>
												</a>
     <!---------------------------------------Account settings link-------------------------------->
		 <a href="account_settings.php" title="Account Settings" style="text-decoration:none;border-radius:50%;">
		<div class="right-side"type="button" title="Account Settings" action="my_messages.php" >
         <h3 style="-moz-text-shadow:.9px .9px .9px #000;text-shadow:.9px .9px .9px #000;padding:5px;margin-top:50px;color:#fff;font-family:papyrus;"> Settings</h3> <img style="margin-left:80px;height:50px;width:50px;margin-bottom:3px;" src="./img/set.png" >
		</div>
		 </a>
		
		 <!---------------------------------------Friend Requests link-------------------------------->
		 <a href="friend_requests.php" title="Friend Requests" style="text-decoration:none;height:auto;width:auto;border-radius:50%;">
		<div class="right-side"type="button" title="Friend Requests" action="my_messages.php" >
        <?php if($friend_numrows>99){$friend_numrows="99+";};if($friend_numrows!=""){echo'<h2 style="-moz-text-shadow:.9px .9px .9px #000;text-shadow:.9px .9px .9px #000;color:#fff;font-family:papyrus;margin-left:15px;margin-top:50px;">Friend Requests</h2><div style="color:#fff;width:30px; font-family:papyrus;margin-left:80px;font-size:15px;border-radius:50%; background-color:blue;text-align:center;">'.$friend_numrows.'</div> ';}else{echo'<h2 style="font-family:papyrus;color:#fff;margin-left:20px;margin-top:50px;-moz-text-shadow:.9px .9px .9px #000;text-shadow:.9px .9px .9px #000;font-size:20px;">Friend Requests</h2>';}?> 
		</div>
		 </a>
		  <!---------------------------------------Suchana (Notification) link-------------------------------->
		 <a href="suchana.php" title="Suchana(Notification)" style="text-decoration:none;height:auto;width:auto;border-radius:50%;">
		<div class="right-side"type="button" title="Suchana(Notification)" action="my_messages.php" >
        <?php if($numrows_suchana!=""){echo'<h2 style="-moz-text-shadow:.9px .9px .9px #000;text-shadow:.9px .9px .9px #000;color:#fff;font-family:papyrus;margin-left:15px;margin-top:50px;">Suchana</h2><div style="color:#fff; font-family:papyrus;margin-left:80px;font-size:20px;border-radius:50%; background-color:blue;text-align:center;width:20px;">'.$numrows_suchana.'</div> ';}else{echo'<h2 style="font-family:papyrus;color:#fff;margin-left:20px;margin-top:50px;-moz-text-shadow:.9px .9px .9px #000;text-shadow:.9px .9px .9px #000;font-size:20px;">Suchana</h2>';}?> 
		</div>
		 </a>
		
		</div>
			</center>
			
			<?php }  ?>