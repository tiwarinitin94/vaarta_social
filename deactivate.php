<?php include("./inc/header.inc.php");
If(!$username){
echo "You should not be here";
}
else{


if(isset($_GET['q'])){
      $activation=$_GET['q'];
	  if($activation=='a'){
	    if(isset($_POST['nopes'])){
  echo "<meta http-equiv=\"refresh\" content=\"0; url=account_settings.php\">";
}
if(isset($_POST['yupp'])){
     $close_quey=mysqli_query($connection,"UPDATE myusers SET deactivate='no' WHERE username='$username'");
	 echo "Your account has been activated";
	 echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
	
}
		      echo'<br>
<center>
<form action="deactivate.php?q=a" method="POST" style="background-color:#fff;width:400px;height:100px;padding:20px;">
 
Do you want to Re activate your account?<br>

<input type="submit" name="nopes" value="No">
<input type="submit" name="yupp" value="YES">
</form>

</center>';
	  
	  
	  }
	  elseif($activation=='d'){
			    if(isset($_POST['no'])){
  echo "<meta http-equiv=\"refresh\" content=\"0; url=account_settings.php\">";
}
if(isset($_POST['yes'])){
     $close_quey=mysqli_query($connection,"UPDATE myusers SET deactivate='yes' WHERE username='$username'");
	 echo "Your account has been deactivated";
      session_destroy();
}
	
	  echo'<br>
<center>
<form action="deactivate.php?q=d" method="POST" style="background-color:#fff;width:400px;height:100px;padding:20px;">
 
 Are you sure want to deactivate?<br>

<input type="submit" name="no" value="No">
<input type="submit" name="yes" value="YES">
</form>

</center>';
	  
	  
	  }

}

?>


<?php }?>