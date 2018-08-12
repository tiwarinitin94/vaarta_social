<?php
include("./inc/header.inc.php");
?>
<h2 style="margin-top:50px;margin-left:100px;">Like Button for pages</h2>
<form action="create_like_button.php" method="POST"style="margin-left:100px;" >
<input type="text" name="like_button_url" value="Enter the URL...." size="30"onclick="value=''"/>
<input type="submit" name="create" value="create"/>
</form>

<?php
   if(isset($_POST['like_button_url'])){
   $like_button_url=strip_tags(@$_POST['like_button_url']);
   $like_button_url12=strstr($like_button_url,'http://');
    $date=date("y-m-d");
   $uid=rand(2652765924564547,882398);
   $uid=md5($uid);
   if($like_button_url12){
     //check whether URL exist in database or not
	 $b_check=mysqli_query($connection,"SELECT page_url FROM like_buttons WHERE page_url='$like_button_url'");
	 $numrows_check=mysqli_num_rows($b_check);
	 if($numrows_check==0){
      $create_button=mysqli_query($connection,"INSERT INTO like_buttons VALUES('','$username','$like_button_url','$date','$uid')");
	  $insert_like=mysqli_query($connection,"INSERT INTO user_likes VALUES('','$username','0','$uid')");
      echo "<div  style='width:400px; height:250px; border:1px solid #000000;'>
	         &lt;iframe src='http://localhost/Vaarta/like_but.php?uid=$uid' style='border:0px; height:auto; width:auto;' &gt;
			 &lt;/iframe &gt;
             </div>			 
	  ";
   }else{
       echo "Already exist";
   }
   }
   else{
   $like_button_url="http://".$like_button_url;
    //check whether URL exist in database or not
	 $b_check=mysqli_query($connection,"SELECT page_url FROM like_buttons WHERE page_url='$like_button_url'");
	 $numrows_check=mysqli_num_rows($b_check);
	 if($numrows_check==0){
    $create_button=mysqli_query($connection,"INSERT INTO like_buttons VALUES('','$username','$like_button_url','$date','$uid')");
	$insert_like=mysqli_query($connection,"INSERT INTO user_likes VALUES('','$username','0','$uid')");
     echo "<div  style='width:400px; height:250px; border:1px solid #000000;'>
	         &lt;iframe src='http://localhost/Vaarta/like_but.php?uid=$uid' style='border:0px; height:auto; width:auto;' &gt;
			 &lt;/iframe &gt;
             </div>			 
	  ";
    }else{
       echo "Already exist";
   }
   }
  
  
   }
?>