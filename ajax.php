<?php 
include './inc/header.inc.php';
?>
<style>
td{
	font-size:12px;
}
</style>
<div id="main">
<div  style="text-align:center;background:#fff;border-left:.1px solid #999;border-right:.1px solid #999;padding:5px 50px;">
<h3>List of signed up people</h3>
<?php
$query= mysqli_query($connection,"SELECT username,first_name,closed FROM myusers WHERE close='no' ORDER BY id ASC LIMIT 100");
$i=1;
?>
<center style="padding-top:20px;">
<table >
<?php
while($get=mysqli_fetch_array($query)){
	$user_signed_up=$get['username'];
	$firstname=$get['first_name'];
	
	echo"<tr><td>$i</td><td><label style='color:#333;padding-left:20px;font-size:12px;'> $user_signed_up </label></td><td><label style='color:#888;padding-left:20px;font-size:12px;'>  $firstname</label></td></tr>";
	$i++;
}

?></table>
</center>
</div></div>
<?php 
include './inc/footer.inc.php';
?>