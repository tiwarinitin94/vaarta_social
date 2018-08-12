<?php include("./inc/connect.inc.php"); ?>
<?php
$post = @$_POST['post'];
if($post != ""){
$date_added=date("y-m-d");
$added_by="test123";
$user_posted_to="tiwarinitin94";

$sqlCommand ="INSERT INTO posts VALUES ('', '$post', '$date_added' , '$added_by','$user_posted_to')";
$query= mysqli_query($connection, $sqlCommand) or die (mysqli_error());
}
else{
echo "You must enter something to post";
}
?>
