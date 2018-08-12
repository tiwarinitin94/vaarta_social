<?php include("./inc/header.inc.php");
If(!$username){
echo "You should not be here";
}
else{
if(isset($_POST['no'])){
  echo "<meta http-equiv=\"refresh\" content=\"0; url=account_settings.php\">";
}
if(isset($_POST['yes'])){
     $close_quey=mysqli_query($connection,"UPDATE myusers SET closed='yes' WHERE username='$username'");
	 echo "Your account has been closed";
	 session_destroy();
}
?>
<br>
<center>
<form action="close_account.php" method="POST" style="background-color:#fff;width:400px;height:100px;padding:20px;">
 
 Are you sure want to quit?<br>

<input type="submit" name="no" value="No">
<input type="submit" name="yes" value="YES">
</form>

</center>

<?php }?>