<?php include("inc/connect.inc.php");?>

<?php 
      if(isset($_POST['sid'])){
		 $sid=$_POST['sid'];
         echo $sid;		 
	  

       
               $get_posts=mysqli_query($connection,"SELECT *FROM posts WHERE id='$sid'");
	           if((mysqli_num_rows($get_posts))==1){
	            $get_post=mysqli_fetch_assoc($get_posts);
	         $body=$get_post['body'];
	             $date=$get_post['date_added'];
	         $added_by_share=$get_post['added_by'];
	          $user_posted_to=$get_post['user_posted_to'];
	         $post_image=$get_post['post_image'];	        
                  $share_post=mysqli_query($connection,"INSERT INTO posts VALUES('','$body ','$date','$username','$username','$post_image','$added_by_share')");
	         	echo "Successfully shared";	
				if($username!=$added_by_share){
				  $suchana_query=mysqli_query($connection,"INSERT INTO suchana VALUES(' ', '$username', '$added_by_share','share','$sid','$date','no','no')");
				  }
	  }	
			   
			 }  






?>
