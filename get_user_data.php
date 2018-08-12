<?php include("./inc/connect.inc.php");?>
<?php
//getting user info
if($username){
$check1= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE username='$username'");  
	 if(mysqli_num_rows($check1)==1){
  $get1=mysqli_fetch_assoc($check1);
  $user_one=@$get1['id'];
  


?>
<?php
		
$query_connect= mysqli_query($connection,"SELECT u.id,c.c_id,u.username,u.email
 FROM conversation c, myusers u
 WHERE CASE 
 WHEN c.user_one = '$user_one'
 THEN c.user_two = u.id
 WHEN c.user_two = '$user_one'
 THEN c.user_one = u.id
 END 
 AND (
 c.user_one = '$user_one'
 OR c.user_two = '$user_one'
 )
 ORDER BY c.c_id DESC LIMIT 20") or die(mysql_error());
 ?>
 <?php
if($row=mysqli_num_rows($query_connect)<1){
     Echo "No conversation Found";
 }
 else{
$i=0;
 while($row=mysqli_fetch_array($query_connect,MYSQLI_ASSOC)){
$c_id=$row['c_id'];
$user_id=$row['id'];
$username_db=$row['username'];
$email_db=$row['email'];

$cquery= mysqli_query($connection,"SELECT R.cr_id,R.time,R.reply,R.user_two_read,R.user_id_fk FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1") or die(mysql_error());
while($crow=mysqli_fetch_array($cquery,MYSQLI_ASSOC)){
$cr_id=$crow['cr_id'];
$temp[$i]=$cr_id;
$i++;

}

}
}
}

rsort($temp);

$clength = count($temp); 
for($x = 0; $x <  $clength; $x++) {
     $result2=mysqli_query($connection,"SELECT * FROM conversation_reply R WHERE  R.cr_id ='$temp[$x]' ");
     $row=mysqli_fetch_assoc($result2);
     $cn_id=$row['c_id_fk'];
	 $user_two_read=$row['user_two_read'];
	 $user_id_fk=$row['user_id_fk'];
     $result=mysqli_query($connection,"SELECT* FROM conversation WHERE c_id='$cn_id'");
     $row1=mysqli_fetch_assoc($result);
    
    if($row1['user_one']!=$global_id){
     $uid_db=$row1['user_one'];
}else{
    $uid_db=$row1['user_two'];
}
    $info=mysqli_query($connection,"SELECT* FROM myusers WHERE id='$uid_db'");
    if(($info_num=mysqli_num_rows($info))>=1){
  $row=mysqli_fetch_assoc($info);
$user_pic=$row['profile_pic'];
$user_firstname=$row['first_name'];
 $user_firstname=(strlen($user_firstname)>10) ? substr($user_firstname,0,10).'...' : $user_firstname;
echo "<div id='id_user' style='display:inline;margin-top:5px;'>";
  if($user_pic==""){
if($user_two_read=="no" && $user_id_fk!=$global_id){
     echo "<a href='my_messages.php?c_id=$cn_id' style='background-image:url(./img/back.png);margin-top:5px;padding-left:20px;text-decoration:none;color:#fff;'><table style='color:#fff;background-color:transparent; '><tr><td style='margin-left:-10px;width:60%;'><img src='img/default-pic.png' style='width:80px;height:80px;border-radius:50%;' title='$user_firstname'></td><td style='width:40%;overflow:hidden;'><div style='color:blue;font-family:papyrus;font-weight:bold;display:inline;float:right;margin-right:50px;font-size:10px;margin-top:30px;' >$user_firstname</div></td></tr></table></a></div>";

  }else{
      echo "<a href='my_messages.php?c_id=$cn_id'style='padding-left:20px;margin-top:5px;text-decoration:none;float:right;' ><table style='color:#fff;background-color:transparent; '><tr><td style='margin-left:-10px;width:60%;'><img src='img/default-pic.png' style='width:80px;height:80px;border-radius:50%;' title='$user_firstname'></td><td style='width:40%;overflow:hidden;'><div style='color:#fff;font-size:10px;font-family:papyrus;font-weight:bold;display:inline;float:right;margin-right:50px;margin-top:30px;' >$user_firstname</div></td></tr></table></a></div>";

}
   } else{
     if($user_two_read=="no" && $user_id_fk!=$global_id){
	  echo '<a href="my_messages.php?c_id='.$cn_id.'" style="background-image:url(./img/back.png);text-decoration:none;margin-top:5px;padding-left:20px;color:#fff;"><table style="color:#fff;background-color:transparent; "><tr><td style="width:60%;"><img src="userdata/profile_pics/'.$user_pic.'" style="width:80px;height:80px;border-radius:50%;" title="'.$user_firstname.'"></td><td style="width:40%;"><div style="color:blue;font-family:papyrus;font-size:10px;font-weight:bold;display:inline;float:right;margin-right:50px;margin-top:30px;">'.$user_firstname.'</div></td></tr></table></a></div>';

	 }else{
    echo '<a href="my_messages.php?c_id='.$cn_id.'" style="text-decoration:none;margin-top:5px;padding-left:20px; float:right;"><table style="color:#fff;background-color:transparent; "><tr><td style="width:60%;"><img src="userdata/profile_pics/'.$user_pic.'" style="width:80px;height:80px;border-radius:50%;" title="'.$user_firstname.'"></td><td style="width:40%;"><div style="color:#fff;font-family:papyrus;;font-size:10px;font-weight:bold;display:inline;float:right;margin-right:50px;margin-top:30px;" >'.$user_firstname.'</div></td></tr></table></a></div>';

	}
	}

  } 
}
}else{
	alert("You should be logged in ");
}
?>
