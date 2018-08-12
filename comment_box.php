<?php
include("./inc/connect.inc.php");

if (isset($_SESSION['user_login'])) {
$username = $_SESSION["user_login"];
}
else {
$username = "Aparichit";

}
?>
<?php 
if(isset($_POST['id'])){
   $get_id= $_POST['id'];
   echo $get_id;
?>
  
<?php
     
	  if(isset($_POST['post_comment' .$get_id. ''])){
	      
	      $get_user_posted=mysqli_query($connection,"SELECT* FROM posts WHERE id='$get_id'");
		  $get_name=mysqli_num_rows($get_user_posted);
		  if($get_name==1){
		  $get_name=mysqli_fetch_assoc( $get_user_posted);
	     
		 $post_body=$_POST['post_body'];
		 $posted_to=$get_name['added_by'];
		
		 $insert_post=mysqli_query($connection,"INSERT INTO post_comments VALUES ('','$post_body','$posted_to','$username','0','$get_id')");
		 
		 $date_added=date("y-m-d");
		 if($posted_to!=$username){
  
	     $suchana_query=mysqli_query($connection,"INSERT INTO suchana VALUES(' ', '$username', '$posted_to', 'comment','$get_id','$date_added','no','no')");
			
	}   $i=0;
	      $get_comments_2= mysqli_query($connection,"SELECT posted_by FROM post_comments WHERE post_id='$get_id' ORDER BY id ASC");
	       $count=mysqli_num_rows($get_comments_2);
		   if($count!=0){                        
			 while($comments=mysqli_fetch_assoc($get_comments_2)){
                    $comment_posted_by=$comments['posted_by'];
		   $temp[$i]=$comment_posted_by;
		   $i++;
     }   
		 } else{}
	  }
	  }
	   ?>
	   <div id="toggleComment" >
     <form method="POST"  action="comment_box.php?id=<?php echo $get_id; ?>" name="post_comment<?php echo $get_id; ?>">
    <input type="text" size="50" name="post_body"/>
    <input type="submit" name="post_comment<?php echo $get_id; ?>" style="float:right; display:inline;" value="Comment"/> 
     </form>
  </div>
 
  <?php
      //Deleting Comments
	   
	  //Getting comments 	          
		     $get_comments= mysqli_query($connection,"SELECT* FROM post_comments WHERE post_id='$get_id' ORDER BY id ASC");
			 $count=mysqli_num_rows($get_comments);
			 if($count!=0){
                        
			 while($comments=mysqli_fetch_assoc($get_comments)){
			      $comment_id=$comments['id'];
				 $comment_body=$comments['body']; 				
				 $comment_posted_to=$comments['posted_to'];
				 $comment_posted_by=$comments['posted_by'];
				 $post_removed=$comments['post_removed'];
                                 
				 if(@$_POST["delete_$comment_id"]){ 
                 	  
                  $delete_Post_Query=mysqli_query($connection,"DELETE FROM post_comments WHERE id='$comment_id' ");
				echo "<meta http-equiv=\"refresh\" content=\"0; url=comment_box.php?id=$get_id\">";
			   			 }
				  echo "<hr><div style='float:left;font-family:helvetica;font-weight:bold;font-size:15px;height:20px;padding:5px;'><a href='#' style='color:#000;text-decoration:none;'>$comment_posted_by</a></div><div style='color:#fff;height:20px;padding:5px;font-style:italic;font-size:15px;'>  $comment_body.<br>";
				  if($comment_posted_to==$username||$comment_posted_by==$username){
												echo"<form action='comment_box.php?id=$get_id' method='POST'  name='delete_$comment_id'>
	               <input type='submit' value=\"Delete comment\" title='Delete comment' name='delete_$comment_id' style='margin-top:-15px;float:right;margin-right:5px;height:15px;font-size:10px;line-height:10px;'>
                                            </form></div>";
											}
											}	
											
				 }
				 else{
				    echo "No comments yet !";
				 }
			}	 
			
		
		   
?>
  
<?php

    	
		if(isset($_GET['s_id'])){
echo"
<style>
  body{
	  background-color:#6FA2C3  }
  </style>";	
          $s_id= $_GET['s_id'];
      
	  if(isset($_POST['shashtra_comment' .$s_id. ''])){
	      $get_shashtra=mysqli_query($connection,"SELECT* FROM shashtra_posts WHERE id='$s_id'");
		  $get_name=mysqli_num_rows($get_shashtra);
		  if($get_name==1){
		  $get_name=mysqli_fetch_assoc($get_shashtra);
	      $post_body=htmlspecialchars($_POST['post_body']);
		  $posted_to=$get_name['added_by'];
		  $page_name=$get_name['user_posted_to'];
		  if($post_body=="")	{
			  echo "You cannot do empty comment";
		  }	 else{
		 $insert_into_post=mysqli_query($connection,"INSERT INTO shashtra_comments VALUES('','$post_body','$posted_to','$username','0','$s_id')");
		 if($posted_to!=$username){
          $date_added=date("y-m-d");
	     $suchana_query=mysqli_query($connection,"INSERT INTO suchana VALUES(' ', '$username', '$posted_to', 'comment+page','$s_id','$date_added','no','$page_name')");
			
	}
		   
		  } } else{
		    
		 }
	 }
	   ?>
	   <div id="toggleComment" >
	 
     <form method="POST"  action="comment_box.php?s_id=<?php echo $s_id; ?>" name="post_comment<?php echo $s_id; ?>">
    <input type="text"  size="40" name="post_body"/>
    <input type="submit" name="shashtra_comment<?php echo $s_id; ?>" style="float:right; display:inline;" value="Comment"/> 
     </form>
  </div>
 
  <?php
      //Deleting Comments
	   
	  //Getting comments 	          
		     $get_comments= mysqli_query($connection,"SELECT* FROM shashtra_comments WHERE post_id='$s_id' ORDER BY id ASC");
			 $count=mysqli_num_rows($get_comments);
			 if($count!=0){
			 while($comments=mysqli_fetch_assoc($get_comments)){
			      $comment_id=$comments['id'];
				 $comment_body=$comments['body']; 				
				 $comment_posted_to=$comments['posted_to'];
				 $comment_posted_by=$comments['posted_by'];
				 $post_removed=$comments['post_removed'];
				 if(@$_POST["delete_$comment_id"]){ 
                 	  
                  $delete_Post_Query=mysqli_query($connection,"DELETE FROM shashtra_comments WHERE id='$comment_id' ");
				echo "<meta http-equiv=\"refresh\" content=\"0; url=comment_box.php?s_id=$s_id\">";
			   			 }
				  echo "<hr><div style='float:left;font-family:helvetica;font-weight:bold;font-size:15px;height:20px;padding:5px;'><a href='#' style='font-weight:bold;color:#000;text-decoration:none;'></div><div style='color:#fff;height:20px;padding:5px;font-style:italic;font-size:15px;'>  $comment_posted_by</a>  $comment_body.<br>";
				  if($comment_posted_to==$username||$comment_posted_by==$username){
												echo"<form action='comment_box.php?s_id=$s_id' method='POST'  name='delete_$comment_id'>
	               <input type='submit' value=\"Delete comment\" title='Delete comment' name='delete_$comment_id' style='margin-top:-20px;float:right;margin-right:5px;height:15px;font-size:10px;line-height:10px;'>
                                            </form></div>";
											}
											}	
				 }
				 else{
				    echo "No comments yet !";
				 }
				 }		
		 
?>