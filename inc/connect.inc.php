<?php         


   //tripathi_myusers is my database name 
    //root is database user.
	//pswd is my password
	
    $connection = mysqli_connect("localhost", "root","pswd", "tripathi_myusers");
	 @mysqli_select_db($connection,"tripathi_myusers") or die ("Database not Found");
	session_start();	
     if(!isset($_SESSION["user_login"])){
$username="";
}
else{
	
  $username= $_SESSION["user_login"]; 
    $info_user=mysqli_query($connection,"SELECT *FROM myusers WHERE username='$username'");
				   if(mysqli_num_rows($info_user)==1){
                    $get=mysqli_fetch_assoc($info_user);
					
                    $firstname= @$get['first_name'];
                     $lastname= @$get['last_name'];
					 $bio= @$get['bio'];
					 $global_id= @$get['id'];
					 $sex=@$get['gender'];
					 if(!$bio){
					     echo "No Bio";
					 }
					 $profilepic_info_user=@$get['profile_pic'];
					 	 if ($profilepic_info_user == "") {
                                                 $profilepic_info_user = "img/default-pic.png";
                                                }
                                                else
                                                {
                                                 $profilepic_info_user = "./userdata/profile_pics/".$profilepic_info_user;
                                                }
                                                $coverpic_info_user=@$get['cover_pic'];
								 if ($coverpic_info_user == "") {
                                                 $coverpic_info_user = "img/background-image.png";
                                                }
                                                else
                                                {
                                                 $coverpic_info_user = "./userdata/cover_pics/".$coverpic_info_user;
                                                }
											} 

                             
 	//Notification or suchana
	$suchana_query=mysqli_query($connection,"SELECT* FROM suchana WHERE user_to='$username' && opened='no'");
		$numrows_suchana=mysqli_num_rows($suchana_query);
	$numrows_suchana=$numrows_suchana;
	
	
	//messages
 $unread_numrows="";	
$c_id_fk=""; 
$q= mysqli_query($connection,"SELECT c_id FROM conversation WHERE (user_one='$global_id' ) or (user_two='$global_id') ") or die(mysql_error());
$num_c_id=mysqli_num_rows($q);
 if($num_c_id>=1){
    while($get_c_id=mysqli_fetch_assoc($q)){
	
	$cid=$get_c_id['c_id'];

	$get_unread_query= mysqli_query($connection,"SELECT user_two_read,c_id_fk FROM conversation_reply WHERE user_id_fk!='$global_id' && user_two_read='no'&& c_id_fk='$cid' ");
   $get_unread=mysqli_fetch_assoc($get_unread_query);
   $c_id_fk=$get_unread['c_id_fk'];
   if( !$c_id_fk || $cid!=""){
        $c_id_fk=$cid;
   }else{
   $c_id_fk=$c_id_fk;
   
   }
   $un_numrows = mysqli_num_rows($get_unread_query);
   if($un_numrows==0){}else{$unread_numrows=$un_numrows;}
  
	}
 }
 
 // Freind request
$get_friend_query= mysqli_query($connection,"SELECT user_to FROM friend_requests WHERE user_to='$username'");
$get_friend=mysqli_fetch_assoc($get_friend_query);
$friend_numrows = mysqli_num_rows($get_friend_query);

}											
											
   ?>
   
  
   