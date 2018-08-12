<?php include("./inc/header.inc.php");?>

<?php

$check1= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE username='$username'");  
	 if(mysqli_num_rows($check1)==1){
  $get1=mysqli_fetch_assoc($check1);
  $user_one=@$get1['id'];
  
?>
<style>

#id_user a:focus{
    background-image:url(./img/back.png);   
   color:#000;
}
#id_user a:active{
    background-image:url(./img/back.png);   
color:#000;
}
#id_user a:hover{
    background-image:url(./img/back.png);   
  
}


</style>
<?php 
include("./button.php");?>
<div style="position:absolute; top:60px;left:100px;">
 <div id="inbox"style="margin-top:10px;margin-left:80px; position:absolute;"><h2 style="font-family:papyrus;"> Swagatam </h2></div>
<div class="user_details"style="border-left:4px solid #fff; box-shadow:1px 1px 1px #000; ">

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
while($row=mysqli_fetch_array($query_connect,MYSQLI_ASSOC)){
$c_id=$row['c_id'];
$user_id=$row['id'];
$username_db=$row['username'];
$email_db=$row['email'];

$cquery= mysqli_query($connection,"SELECT R.cr_id,R.time,R.reply,R.user_two_read,R.user_id_fk FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1") or die(mysql_error());
while($crow=mysqli_fetch_array($cquery,MYSQLI_ASSOC)){
$cr_id=$crow['cr_id'];
$reply=$crow['reply'];
$time=$crow['time'];
$user_two_read=$crow['user_two_read'];
$user_id_fk=$crow['user_id_fk'];
$user_pic="";
$user_firstname="";


$info=mysqli_query($connection,"SELECT *FROM myusers WHERE username='$username_db' ");
if(($info_num=mysqli_num_rows($info))>=1){
$row=mysqli_fetch_assoc($info);
$user_pic=$row['profile_pic'];
$user_firstname=$row['first_name'];

//HTML Output.
echo "<div id='id_user' style='display:inline;width:150px;'>";
  if($user_pic==""){
if($user_two_read=="no" && $user_id_fk!=$global_id){
     echo "<a href='my_messages1.php?c_id=$c_id' style='background-image:url(./img/back.png);padding:20px;text-decoration:none;float:right;'><table style='color:#fff;background-color:transparent; '><tr><td style='widht:40%;'><img src='img/default-pic.png' style='width:80px;height:80px;border-radius:50%;' title='$user_firstname'></td><td style='width:30%;'><div style='color:blue;font-family:papyrus;font-weight:bold;display:inline;float:right;margin-right:50px;font-size:10px;margin-top:30px;' >$user_firstname</div></td></tr></table></a></div>";

  }else{
      echo "<a href='my_messages1.php?c_id=$c_id'style='padding:20px;text-decoration:none;float:right;' ><table style='color:#fff;background-color:transparent; '><tr><td style='widht:40%;'><img src='img/default-pic.png' style='width:80px;height:80px;border-radius:50%;' title='$user_firstname'></td><td style='width:30%;'><div style='color:#fff;font-size:10px;font-family:papyrus;font-weight:bold;display:inline;float:right;margin-right:50px;margin-top:30px;' >$user_firstname</div></td></tr></table></a></div>";

}
   } else{
     if($user_two_read=="no" && $user_id_fk!=$global_id){
	  echo '<a href="my_messages1.php?c_id='.$c_id.'" style="background-image:url(./img/back.png);text-decoration:none;padding:20px;float:right;"><table style="color:#fff;background-color:transparent; "><tr><td style="widht:40%;"><img src="userdata/profile_pics/'.$user_pic.'" style="width:80px;height:80px;border-radius:50%;" title="'.$user_firstname.'"></td><td style="width:30%;"><div style="color:blue;font-family:papyrus;font-size:10px;font-weight:bold;display:inline;float:right;margin-right:50px;margin-top:30px;">'.$user_firstname.'</div></td></tr></table></a></div>';

	 }else{
    echo '<a href="my_messages1.php?c_id='.$c_id.'" style="text-decoration:none;padding:20px; float:right;"><table style="color:#fff;background-color:transparent; "><tr><td style="widht:40%;"><img src="userdata/profile_pics/'.$user_pic.'" style="width:80px;height:80px;border-radius:50%;" title="'.$user_firstname.'"></td><td style="width:30%;"><div style="color:#fff;font-family:papyrus;;font-size:10px;font-weight:bold;display:inline;float:right;margin-right:50px;margin-top:30px;" >'.$user_firstname.'</div></td></tr></table></a></div>';

	}
	}
}
}
}
}
?>

</div>
<div id="msgarea_double"style="border-left:4px solid #fff; box-shadow:1px 1px 1px #000; ">
<?php

if(isset($_GET['c_id'])){
$cid=mysqli_real_escape_string($connection,$_GET['c_id']);

$query= mysqli_query($connection,"SELECT  R.cr_id,R.time,R.pics,R.reply,U.id,U.username,U.email,U.profile_pic,U.first_name FROM myusers U, conversation_reply R WHERE R.user_id_fk=U.id and R.c_id_fk='$cid' ORDER BY R.cr_id DESC LIMIT 20") or die(mysqli_error());


while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$cr_id=$row['cr_id'];
$time=$row['time'];
$reply=$row['reply'];
$sent_pic=$row['pics'];
$user_id=$row['id'];
$query_update=mysqli_query($connection,"UPDATE conversation_reply SET user_two_read='yes' WHERE user_id_fk!='$user_one'  ");if(!$query_update){echo "problem";}	
$user_firstname_2=$row['first_name'];
$user_pic_2=$row['profile_pic'];
$username_db_2=$row['username'];
$email_db_2=$row['email'];
//HTML Output
echo "<table>
<tr>
<td style='width:20%;margin-left:0px;'><div id='id_user' style='float:left;margin-top:10px;width:auto;'> ";
 if($user_pic_2==""){
   echo "<img src='img/default-pic.png' style='margin-left:15px;width:90px;height:90px;border-radius:50%;' title='$user_firstname_2'></div></td>";
} else{
    echo '<img src="userdata/profile_pics/'.$user_pic_2.'" style="margin-left:15px;width:90px;height:90px;border-radius:50%;" title="'.$user_firstname_2.'"></div></td>';
} 

        echo "<td style='width:79%;margin-left:0px;align:top; '><div style='font-family:arial; font-size:12px;width:620px;float:left;text-align:justify;margin-top:60px;'>$reply "; if($sent_pic!='Nothing'){echo" <div style=''><img src='userdata/data_pics/$sent_pic' style='align:justify;width:100px; height:100px;'></div></div></td>";}else{echo "</div></td>";}
	  echo "</tr></table>";
}


//inserting reply
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
	
         
	//if there is a pic	
    if ($post_pic!=""){	 
    $date_added = date("Y-m-d");
   $time=time();
    $ip=$_SERVER['REMOTE_ADDR'];
   $q= mysqli_query($connection,"INSERT INTO conversation_reply (reply,pics,user_id_fk,user_two_read,ip,time,c_id_fk) VALUES ('$post','$rand_dir_name/$post_pic','$user_one','no','$ip','$time','$cid')") or die(mysqli_error());  	   
  echo "<meta http-equiv=\"refresh\" content=\"0; url=my_messages1.php?c_id=$cid\">";
     
	 }           
   }
  }
 else
   {  //if not pics
   if ($post!="") {  $date_added = date("Y-m-d");
      $time=time();
      $ip=$_SERVER['REMOTE_ADDR'];
    $q= mysqli_query($connection,"INSERT INTO conversation_reply (reply,pics,user_id_fk,user_two_read,ip,time,c_id_fk) VALUES ('$post','Nothing','$user_one','no','$ip','$time','$cid')") or die(mysqli_error());  
  echo "<meta http-equiv=\"refresh\" content=\"0; url=my_messages1.php?c_id=$cid\">";
   }else{
       echo "<div style='position:absolute; top:60px;margin-left:280px;'>Kuchh to bolo............Write something....!</div>";
   }
  }
  }
  }
		
   
?>
</div>

<div id="replyboxarea" style="position:absolute;margin-top:480px;margin-left:320px;">

<form action="" method="POST" enctype="multipart/form-data">
       <input type="text" id="post"  name="post" style="height:30px;width:740px;font-size:15px;"placeholder="Reply.....(Pratiuttar)"></input>
       <div style="background-color:#9FC5DD;width:750px;border:1px solid #fff;">
	  <input type="file" id="fileID" name="pic" accept="image/*" style="visibility: hidden;background-color:transparent;"><a href="#" onclick="document.getElementById('fileID').click(); return false;"  /><img src="./img/camera.png" title="Upload image"style="height:30px; width:30px;margin-left:-230px;margin-top:18px; "/></a>
   
  <input type="submit" name="send" value="Uttar" style="padding:10px;margin-left:30px;background-color:DCE5EE;margin-top:10px; float: left; border:1px solid #656;"/></div>
  </form>
</div>
</div><?php 
 }} ?>