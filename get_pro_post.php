<?php include("./inc/connect.inc.php");?>
<script src="./js/jquery-1.12.2.min.js"></script>
<script>

$(document).ready(function() {
	$(window).scroll(function(){
if ($(window).scrollTop() == $(document).height() - $(window).height()){
get_more();
}
});

    $("img").on("contextmenu",function(){
       return false;
    }); 
});
</script>
<?php
if(isset($_GET['u'])){
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

  echo "<center style='background-color:#fff;margin-top:100px;'>User is deactivated or does not exist</center>";
  exit();
  }
  }
  }
     if(!$username1){
      echo "<center><div style='background-color:#fff; padding: 100px;font-weight:bold;'>Don't mess with me </div></center>";
	  exit();
 }


?>


<?php 
      if(isset($_GET['l_id'])){
  $l_id=htmlspecialchars(mysqli_real_escape_string($connection,$_GET['l_id']));
	  }else{
		  $l_id="";
	  }
	
	 $id="";
	?>
<link rel="stylesheet" type="text/css" href= "./css/style.css"/>
<style>
body{

font-weight: inherit;
font-style: inherit;
}

</style>
<?php 



    if(!$l_id){
  $getposts = mysqli_query($connection,"SELECT* FROM posts WHERE user_posted_to='$username1' ORDER BY id DESC LIMIT 16") or die(mysqli_error());
	}else{
		  $getposts = mysqli_query($connection,"SELECT* FROM posts WHERE user_posted_to='$username1'&& id<'$l_id' ORDER BY id DESC LIMIT 16") or die(mysqli_error());

	}
  while($row=mysqli_fetch_assoc($getposts)){
        $id= $row['id'];
		$body=$row['body'];
		$date_added= $row['date_added'];
		$added_by=$row['added_by'];
		$user_posted_to=$row['user_posted_to'];	
		$post_pic1=$row['post_image'];
      	$if_shared=$row['if_shared'];	
		 $uid=$id;
         $uid=md5($uid);
		 $get_likes=mysqli_query($connection,"SELECT* FROM likes WHERE uid='$uid' && username='$username'");
	  $num=mysqli_num_rows($get_likes);
	  $get_likes=mysqli_query($connection,"SELECT* FROM dislikes WHERE uid='$uid' && username='$username'");
	  $num1=mysqli_num_rows($get_likes);
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
                                               
                                              			$(document).ready(function(){ 
														var id=<?php echo $id; ?>;
														 var ele = document.getElementById("toggleComment<?php echo $id; ?>");
                                                var text = document.getElementById("displayComment<?php echo $id; ?>");
							                             $('#comments<?php echo $id; ?>').click(function(){      	
								                      if (ele.style.display == "block") {
                                                ele.style.display = "none";
                                                   }
                                                    else
                                                   {
                                                  ele.style.display = "block";
                                                     }
								                   $.ajax({
			                                        type: "POST",
                                              data: {id:"<?php echo $id;?>"},
                                                      url: "comment_box.php",
                                                  success: function(data){
                                                $("#toggleComment<?php echo $id; ?>").html(data);
                                                          }
                                                            });
			                                               });
			                                           });
				
		    
					
					$(document).ready(function(){                      
					    
					   $('#like_<?php echo $uid;?>').click(function(){
						    var text_c = $('#like_<?php echo $uid;?>').text();
							
							if(text_c === "Lift up"){
						   jQuery.ajax({
							   type: "POST",
							   url: "like_but.php",
							   data: {uid:"<?php echo $uid;?>"},
							   dataType: "text",
							   success: function(data){	
							      $( "#like_<?php echo $uid;?>" ).html("<img src='img/lift2.png'/>Lifted up");
                          
							       }
							   });
							}else if(text_c === "Lifted up"){
								 jQuery.ajax({
							   type: "POST",
							   url: "like_but.php",
							   data: {tid:"<?php echo $uid;?>"},
							   dataType: "text",
							   success: function(data){	
							   $( "#like_<?php echo $uid;?>" ).html("<img src='img/lift1.png'/>Lift up");
							  
							       }
							   });
							}
							    });
								
					 											
		});
		
		      $(document).ready(function(){
	                        $('#delete_<?php echo $id;?>').click(function(){
	                          jQuery.ajax({
		                        type: "POST",
							   url: "delete_post.php",
							   data: {id:<?php echo $id;?>
							          },
							   dataType: "text",
							   success: function(data){	
							       alert(data); 
                                    								   
							       }
							   });
							   
							   });
                    });		
					    
		
					$(document).ready(function(){ 
					
		  $('#dislike_<?php echo $uid;?>').click(function(){
						    var text_c1 = $('#dislike_<?php echo $uid;?>').text();
							
							if(text_c1 === "Lift down"){
						   jQuery.ajax({
							   type: "POST",
							   url: "dislike.php",
							   data: {uid:"<?php echo $uid;?>"},
							   dataType: "text",
							   success: function(data){	
							      $( "#dislike_<?php echo $uid;?>" ).html("<img src='img/liftd2.png'/>Lifted down");
                          
							       }
							   });
							}else if(text_c1 === "Lifted down"){
								 jQuery.ajax({
							   type: "POST",
							   url: "dislike.php",
							   data: {tid:"<?php echo $uid;?>"},
							   dataType: "text",
							   success: function(data){	
							   $( "#dislike_<?php echo $uid;?>" ).html("<img src='img/liftd1.png'/>Lift down");
							  
							       }
							   });
							}
							    });
										
			});
			
			//sharing
			
			 $('#share<?php echo $id;?>').click(function(){
			                  jQuery.ajax({
							   type: "POST",
							   url: "share.php",
							   data: {sid:"<?php echo $id;?>"},
							   dataType: "text",
							   success: function(data){	
							       alert(data);
							       }
							   });
						
						});	      

					
		                                     </script>	
<?php											 
		  
		    if(@$_POST['delete_'.$id.'']){              
			   $delete_Post_Query=mysqli_query($connection,"DELETE FROM posts WHERE id='$id' && user_posted_to='$username'");
			   echo "<meta http-equiv=\"refresh\" content=\"0; url=$username\">";
			 } 
			 //re share
			
			 

    echo "	<div id='status' >
	
                                      <div class='posted_by'>
						Shri:
                                                                                                <a href='$added_by'>$added_by</a>";if($added_by!=$user_posted_to){ echo  "<a href='$user_posted_to'>->".$user_posted_to."</a>";}echo"<br> on $date_added
</div>                                       
                                                <div id='post-image' >
                                                <img src='$profilepic_info' height='60' width='60'style='padding:5px;border-radius:50%;'>
                                                </div>
												";
												if($user_posted_to==$username || $added_by==$username){
												echo"<button id='delete_$id'>x</button>";
											}echo"
											<br /><br /><br><hr style='background-color:#fff;height:2px;'></hr>
											 <center>
                                                <div id='status1' >
												 ";
											  if($if_shared!=""){
												  echo"<center><div id='shared'><a href='$added_by'>$added_by</a> shared <a href='$if_shared'>$if_shared</a>'s post</div></center>";
												  
											  }
											  echo"
												$body <br>
												";
												if($post_pic1!="Nothing"){ 
												   
if(file_exists("userdata/data_pics/$post_pic1")){
						list($width,$height)=getimagesize("userdata/data_pics/$post_pic1");
  if($width>480){
     $wdth=480;
     $height1=($height/$width)*$wdth;
}else{
   $wdth=$width;
   $height1=$height;

}
												   echo "<img style='-moz-box-shadow:1px 1px 1px #000;box-shadow:.1px .1px .1px #000;width:".$wdth."px;height:".$height1."px;margin-top:8px;margin-bottom:8px;' src='userdata/data_pics/$post_pic1'>";
												}elseif(file_exists("userdata/cover_pics/$post_pic1")){
list($width,$height)=getimagesize("userdata/cover_pics/$post_pic1");
  if($width>480){
     $wdth=480;
     $height1=($height/$width)*$wdth;
}else{
   $wdth=$width;
   $height1=$height;

}
												   echo "<img style='-moz-box-shadow:1px 1px 1px #000;box-shadow:.1px .1px .1px #000;width:".$wdth."px;height:".$height1."px;margin-top:8px;margin-bottom:8px;' src='userdata/cover_pics/$post_pic1'>";
												}else{

list($width,$height)=getimagesize("userdata/profile_pics/$post_pic1");
  if($width>480){
     $wdth=480;
     $height1=($height/$width)*$wdth;
}else{
   $wdth=$width;
   $height1=$height;

}
												 echo "<img style='-moz-box-shadow:1px 1px 1px #000;box-shadow:.1px .1px .1px #000;width:".$wdth."px;height:".$height1."px;margin-top:8px;margin-bottom:8px;' src='userdata/profile_pics/$post_pic1'>";
												}						
												}
												echo "                                                
                                                </div>
												
												</center>
											<div class='active_buttons'>
												<button id='comments$id' >Comments</button>
												";
												
												 if($num==1){
													echo "<button id='like_$uid'><img src='img/lift2.png'/>Lifted up</button>";												 
												}else{
													echo "<button id='like_$uid'><img src='img/lift1.png'/>Lift up</button>";												 
												 }
												 
												  if($num1==1){
													echo "<button id='dislike_$uid'><img src='img/liftd2.png'/>Lifted down</button>
													";												 
												}else{
													echo "<button id='dislike_$uid'><img src='img/liftd1.png'/>Lift down</button>";												 
												 }
												 
												 echo"<button id='share$id' style='margin-top:2px;float:left;text-align:left;'><img src='img/stick.png' />Re-Stick</button><br>
												<div id='toggleComment$id' style='margin-left:10px;line-height:20px;word-wrap:break-word;text-align:justify;font-size:15px;'>
												</div>
												</div>											
                                            </div>
						";
						
		}		
		?>
				
				
				
		
	<?php   
	  if(!$id){
		    $id=""; 
 echo"<div style='background-color:black;margin-top:80px;color:#fff; font-family:papyrus;'>No More posts to show...... <br></div>";
  exit();
	  }
	else{
	
    ?>
	<div id="newsfeed_home_<?php echo $id;?>">
	
	
	
	</div>
	<script>

          function get_more(){
		 var l_id=<?php echo $id;?>;
       $("#newsfeed_home_"+l_id).load("get_pro_post.php?u=<?php echo $username1;?>&l_id="+l_id);	
	       
		  }
	</script>
	<?php
     if(!$l_id){ 	
	?>
	<button id="getmore" onclick="get_more()" >Show More</button>
	 <?php }
	} ?>

 