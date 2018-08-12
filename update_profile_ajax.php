<?php
include("inc/connect.inc.php");

if($_POST['data'])
{
	
$data=$_POST['data'];
$data = mysql_escape_String($data);

$sql = "UPDATE info_users SET about_you='$data' WHERE user_id='$global_id'";
mysqli_query($connection,$sql);

}
?>