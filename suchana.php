<?php include("./inc/header.inc.php");?>
<style>
#wrapper{
    background-color: rgb(700,700,700);
	 
	}
	body{
		background-color:#fff;
		
	}
#menu a{
	color:rgba(50,50,50,.6);
}
</style>

<script>
/* Set the width of the side navigation to 250px */
  window.onload=openNav;
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    }
 document.title = "Notification";
</script>
<div id="main">
<?php
   If(!$username){
    echo "You should not be here";
   
   }
   else{
?>
    
   <div id="wrapper1" style="margin-right:40px;text-align:center;font-family:papyrus;font-weight:bold;color:#496EA1;font-size:20px;">
   
   Suchana aur sanvaad (Notification)
<?php 
              $seen_query=mysqli_query($connection,"UPDATE suchana SET opened='yes' WHERE user_to='$username'");
         
       $s_id="";
	   $suchana_page="";
        $suchana_query=mysqli_query($connection,"SELECT* FROM suchana WHERE user_to='$username' ORDER BY id DESC");
		$numrows_suchana=mysqli_num_rows($suchana_query);
		if($numrows_suchana>=1){
	    while($suchana=mysqli_fetch_assoc($suchana_query)){
		    $suchana_id=$suchana['id'];
		    $suchana_type=$suchana['suchna_type'];
			$suchana_from=$suchana['user_from'];
			$suchana_page=$suchana['page_name'];
			$s_id=$suchana['s_id'];
		    if($suchana_type=='post'){
			    if(@$_POST['delete_'.$suchana_id.'']){              
			   $delete_Post_Query=mysqli_query($connection,"DELETE FROM suchana WHERE id='$suchana_id' && user_to='$username'");
			   echo "<meta http-equiv=\"refresh\" content=\"0; url=suchana.php\">";
			 }
			       echo "<a href='$username'style='font-family:times new roman;color:#6991C7;text-decoration:none;'><div style='background-color:#111;padding-left:30px;color:#fff;margin-top:5px;font-family:papyrus;width:auto;'>$suchana_from posted on your wall.</div></a>
				                      <form method='POST' action='suchana.php' >
			<input type='submit' value=\"x\"  title='Delete the Suchana' name='delete_$suchana_id' id='delete_$suchana_id' style='border:1px solid #d9d9d9;box-shadow:none;margin-top:-20px;float:right;margin-right:5px;height:15px;font-size:10px;line-height:10px;'/>
                                            </form>";
			
			}elseif($suchana_type=='post+pic'){
			 if(@$_POST['delete_'.$suchana_id.'']){              
			   $delete_Post_Query=mysqli_query($connection,"DELETE FROM suchana WHERE id='$suchana_id' && user_to='$username'");
			   echo "<meta http-equiv=\"refresh\" content=\"0; url=suchana.php\">";
			 }
			       echo "<a href='$username'style='font-family:times new roman;color:#6991C7;text-decoration:none;'><div style='background-color:#111;padding-left:30px;color:#fff;margin-top:5px;font-family:papyrus;width:auto;'>$suchana_from posted a photo on your wall.</div></a>
				   <form method='POST' action='suchana.php'>
	            <input type='submit' value=\"x\"  title='Delete the Suchana' name='delete_$suchana_id' id='delete_$suchana_id' style='border:1px solid #d9d9d9;box-shadow:none;margin-top:-20px;float:right;margin-right:5px;height:15px;font-size:10px;line-height:10px;'/>
                                            </form>";
			
			}
			elseif($suchana_type=='comment'){
			 if(@$_POST['delete_'.$suchana_id.'']){              
			   $delete_Post_Query=mysqli_query($connection,"DELETE FROM suchana WHERE id='$suchana_id' && user_to='$username'");
			   echo "<meta http-equiv=\"refresh\" content=\"0; url=suchana.php\">";
			 }
			       echo "<a href='comments.php?s_id=$s_id' style='font-family:times new roman;color:#6991C7;text-decoration:none;'><div style='background-color:#111;padding-left:30px;color:#fff;margin-top:5px;font-family:papyrus;width:auto;'>$suchana_from posted a comment on your post.</div></a>
				   <form method='POST' action='suchana.php' >
	        <input type='submit' value=\"x\"  title='Delete the post' name='delete_$suchana_id' id='delete_$suchana_id' style='border:1px solid #d9d9d9;box-shadow:none;margin-top:-20px;float:right;margin-right:5px;height:15px;font-size:10px;line-height:10px;'/>
                                            </form>";
			
			}elseif($suchana_type=='comment+page'){
			 if(@$_POST['delete_'.$suchana_id.'']){              
			   $delete_Post_Query=mysqli_query($connection,"DELETE FROM suchana WHERE id='$suchana_id' && user_to='$username'");
			   echo "<meta http-equiv=\"refresh\" content=\"0; url=suchana.php\">";
			 }
			       echo "<a href='shashtrartha.php?str=$suchana_page'style='font-family:times new roman;color:#6991C7;text-decoration:none;'><div style='background-color:#111;padding-left:30px;color:#fff;margin-top:5px;font-family:papyrus;width:auto;'>$suchana_from posted a comment on your post on page $suchana_page.</div></a>
				   <form method='POST' action='suchana.php'>
	            <input type='submit' value=\"x\"  title='Delete the Suchana' name='delete_$suchana_id' id='delete_$suchana_id' style='border:1px solid #d9d9d9;box-shadow:none;margin-top:-20px;float:right;margin-right:5px;height:15px;font-size:10px;line-height:10px;'/>
                                            </form>";
			
			}
		}
		
		}
		else{
		    echo" <div style='opacity:.4;padding:5px;width:300px;margin-left:350px;margin-top:20px;color:#d9d9d9; font-style:papyrus;font-size:15px;opacity:.8;'>You don't have any Notification .</div>";
		}
?>
</div>
<?php }?></div>