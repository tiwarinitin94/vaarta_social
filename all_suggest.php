<?php include("./inc/header.inc.php");?>
<div class="buttons" >
<?php 
include("./button.php");?></div>
<div id="wrap">
<div class="vaarta_suggestion_1">
	 <div id="suggetion_1"> Friends Suggetions</div>
	 <?php
	                $i=0;
	      $friends=mysqli_query($connection,"SELECT friend_array FROM myusers WHERE username ='$username'");
 	    $friendRow=mysqli_fetch_assoc($friends);
           $friend_array=$friendRow['friend_array'];
             echo $friend_array;
        $for_suggest=mysqli_query($connection,"SELECT username FROM myusers WHERE username IN $friend_array");
        while($friendRow_2=mysqli_fetch_assoc( $for_suggest)){
           $friend_array_2=$friendRow['username'];
             echo $friend_array_2;
}?>
	    
</div>
</div>
<div style='position:fixed;bottom:0px;width:100%;'>
<?php include("./inc/footer.inc.php");?></div>