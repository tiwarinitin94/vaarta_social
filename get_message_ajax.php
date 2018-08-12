<?php include("./inc/connect.inc.php");?>
<style>


.bottom {
		width: 100%;
		height: 50px;
		position: fixed;
		bottom: 0px;
		border-top: 1px solid #CCC;
		background-color: #EBEBEB;
	}
	#whitebg {
		width: 100%;
		height: 100%;
		background-color: #FFF;
		overflow-y: scroll;
		opacity: 0.6;
		display: none;
		position: absolute;
		top: 0px;
		z-index: 1000;
	}
	
	
	.msg {
		margin: 10px 10px;
		background-color: #f1f0f0;
		max-width: calc(45% - 20px);
		color: #000;
		padding: 10px;
		font-size: 13px;
	}
	.msgfrom {
		background-color: #0084ff;
		color: #FFF;
		margin: 10px 10px 10px 55%;
	}
	.msgarr {
		width: 0;
		height: 0;
		border-left: 8px solid transparent;
		border-right: 8px solid transparent;
		border-bottom: 8px solid #f1f0f0;
		transform: rotate(315deg);
		margin: -12px 0px 0px 45px;
	}
	.msgarrfrom {
		border-bottom: 8px solid #0084ff;
		float: right;
		margin-right: 45px;
	}
	.msgsentby {
		color: #8C8C8C;
		font-size: 12px;
		margin: 4px 0px 0px 10px;
	}
	.msgsentbyfrom {
		float: right;
		margin-right: 12px;
	}



</style>
<?php  
if($username){ 
   $cid=stripslashes(htmlspecialchars( $_GET['cid']));
   $uid=stripslashes(htmlspecialchars( $_GET['uid'])); 
      
   echo $uid;

  $i=0;  
   $result=mysqli_query($connection,"SELECT * FROM myusers U, conversation_reply R WHERE R.user_id_fk=U.id and R.c_id_fk='$cid'  ORDER BY R.cr_id DESC LIMIT 20");
 

   while($row=mysqli_fetch_assoc($result)){ 
    $msg[$i]=$row['cr_id']; 
     $sent_pic[$i]=$row['pics'];  
	$i++;
	
    
}    
sort($msg);

$clength = count($msg); 

$query_update=mysqli_query($connection,"UPDATE conversation_reply SET user_two_read='yes' WHERE user_id_fk!='$uid' AND c_id_fk='$cid'  ");if(!$query_update){echo "problem";}
for($x = 0; $x <  $clength; $x++) {
    
    
      $result2=mysqli_query($connection,"SELECT * FROM myusers U, conversation_reply R WHERE R.user_id_fk=U.id and R.cr_id ='$msg[$x]' ");
     $row=mysqli_fetch_assoc($result2); 
     $sent_pic=$row['pics'];
	 if( $sent_pic!="Nothing"){
		$sent_pic2= "userdata/data_pics/$sent_pic";
		if(file_exists($sent_pic2)){
		list($width,$height)=getimagesize("$sent_pic2");
						   if($width >200){
								  $wdth=200;
								  $height1=($height/$width)*$wdth;
						   }
							  }
	 }
  if($row['id']==$uid){
             echo"<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgfrom\">".$row['reply']; if($sent_pic!='Nothing'){echo" <div style=''><img src='$sent_pic2' style='align:justify;width:".$wdth."px;height:".$height1."px;'></div></div>";}else{echo "</div>";} echo"<div class=\"msgarr msgarrfrom\"></div> <div class=\"msgsentby msgsentbyfrom\">Sent by ".$row['username']. "</div> </div>";
}else{
      echo"<div class=\"msgc\"> <div class=\"msg\">" .$row['reply']; if($sent_pic!='Nothing'){echo" <div style=''><img src='$sent_pic2' style='align:justify;width:".$wdth."px;height:".$height1."px;'></div></div>";}else{echo "</div>";} echo" </div> <div class=\"msgarr\"></div> <div class=\"msgsentby\">Sent by " .$row['username']. "</div> </div>";


}


   
		
}

// Free result set
mysqli_free_result($result);

mysqli_close($connection);

}else{
	alert("You should be logged in ");
}
?>