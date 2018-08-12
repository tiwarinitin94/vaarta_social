<?php include("./inc/connect.inc.php");?>
<?php
$cid=stripslashes(htmlspecialchars( $_GET['cid']));
   $user_one=stripslashes(htmlspecialchars($_GET['uid']));
   $post=stripslashes(htmlspecialchars($_GET['msg']));
   
if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")||($_FILES["file"]["type"] == "image/gif")
) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{ 
     $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			  $rand_dir_name = substr(str_shuffle($chars), 0, 15);
			  if(!mkdir("userdata/data_pics/$rand_dir_name")){
			     echo "Cannot make directory";
			  }
 if (file_exists("userdata/data_pics/$rand_dir_name/".@$_FILES["file"]["name"])){
                 echo @$_FILES["file"]["name"]." Already exists";
   }
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$temp = explode(".", $_FILES["file"]["name"]);
 $newfilename = round(microtime(true)) . '.' . end($temp);
 move_uploaded_file(@$_FILES["file"]["tmp_name"],"userdata/data_pics/$rand_dir_name/".$newfilename);
     $post_pic = @$newfilename;
    $time=date("Y-m-d H:i:s");
    $ip=$_SERVER['REMOTE_ADDR'];
     $q= mysqli_query($connection,"INSERT INTO conversation_reply (reply,pics,user_id_fk,user_two_read,ip,time,c_id_fk) VALUES ('$post','$rand_dir_name/$post_pic','$user_one','no','$ip','$time','$cid')") or die(mysqli_error());

}
}
}
else
{ 
     echo $post;
	if($post!=""){
		$time=date("Y-m-d H:i:s");
    $ip=$_SERVER['REMOTE_ADDR'];
		$q= mysqli_query($connection,"INSERT INTO conversation_reply (reply,pics,user_id_fk,user_two_read,ip,time,c_id_fk) VALUES ('$post','Nothing','$user_one','no','$ip','$time','$cid')") or die(mysqli_error());
      
	}else{
		echo "Write Something or your Image is invalid";
	}

}
}
?>