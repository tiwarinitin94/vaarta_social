<?php include("./inc/header.inc.php");?>
<div align="top-left" style="position:fixed;">

<?php 
include("./button.php");?></div>
<?php
class userUpdates
{
private $db;
public function __construct($db)
{
$this->db = $db;
}
/* Users  Details */
public function userDetails($user_id)
{
$query=mysqli_query($this->db,"SELECT username,email,name,profile_background,profile_background_position  FROM users WHERE user_id='$user_id' ") or die(mysqli_error($this->db));
$data=mysqli_fetch_array($query,MYSQLI_ASSOC);
return $data;
}
/* Background Image Update */
public function userBackgroundUpdate($user_id,$actual_image_name)
{
$query=mysqli_query($this->db,"UPDATE users SET profile_background='$actual_image_name' WHERE user_id='$user_id'") or die(mysqli_error($this->db));
return $query;
}
/* Background Image Position Update */
public function userBackgroundPositionUpdate($user_id,$position)
{ 
$position=mysqli_real_escape_string($this->db,$position);
$query=mysqli_query($this->db,"UPDATE users SET profile_background_position='$position' WHERE user_id='$user_id'")or die(mysqli_error($this->db));
return $query;
}
}
?>

<style>
{margin:0px;padding:0px}
body{font-family: Arial, Helvetica, sans-serif;background-color: #e9eaed;color: #333333;}
#container{margin:0 auto;width:900px}
#timelineContainer{width:100%;position:relative}
#timelineBackground {
height: 315px;
position: relative;
border-left: 1px solid #333333;
border-right: 1px solid #333333;
margin-top: -20px;
overflow: hidden;
background-color:#ffffff;
}
#timelineProfilePic {
width: 170px;
height: 170px;
border: 1px solid #666666;
background-color: #ffffff;
position: absolute;
margin-top: -145px;
margin-left: 20px;
z-index: 1000;
overflow: hidden;
}
#timelineTitle {
color: #ffffff;
font-size: 24px;
margin-top: -45px;
position: absolute;
margin-left: 206px;
font-weight: bold;
text-rendering: optimizelegibility;
text-shadow: 0 0 3px rgba(0,0,0,.8);
z-index: 999;
text-transform: capitalize;
}
#timelineShade {
min-height: 95px;
position: absolute;
margin-top: -95px;
width: 100%;
background:url(images/timeline_shade.png);
}
.timelineUploadBG {
position: absolute;
margin-top: 50px;
margin-left: 813px;
height: 32px;
width: 32px;
}
#timelineNav {
border: 1px solid #d6d7da;
background-color: #ffffff;
min-height: 43px;
margin-bottom: 10px;
position: relative;
}
uploadFile {
background: url('images_bg/whitecam.png') no-repeat;
height: 32px;
width: 32px;
overflow: hidden;
cursor: pointer;
}
.uploadFile input {
filter: alpha(opacity=0);
opacity: 0;
margin-left: -110px;
}
.custom-file-input {
height: 25px;
cursor: pointer;
}
</style>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.wallform.js"></script>
<script>
$(document).ready(function()
{

/* Uploading Profile BackGround Image */
$('body').on('change','#bgphotoimg', function()
{
$("#bgimageform").ajaxForm({target: '#timelineBackground',
success:function(){
$("#timelineShade").hide();
$("#bgimageform").hide();
}).submit();
});

/* Banner position drag */
$("body").on('mouseover','.headerimage',function()
{
var y1 = $('#timelineBackground').height();
var y2 =  $('.headerimage').height();
$(this).draggable({
scroll: false,
axis: "y",
drag: function(event, ui) {
if(ui.position.top >= 0)
{
ui.position.top = 0;
}
else if(ui.position.top <= y1 - y2)
{
ui.position.top = y1 - y2;
}
},
stop: function(event, ui)
{
}
});
});

/* Bannert Position Save*/
$("body").on('click','.bgSave',function ()
{
var p = $("#timelineBGload").attr("style");
var Y =p.split("top:");
var Z=Y[1].split(";");
var dataString ='position='+Z[0];
$.ajax({
type: "POST",
url: "image_saveBG_ajax.php",
data: dataString,
cache: false,
success: function(html)
{
if(html)
{
$(".bgImage").fadeOut('slow');
$(".bgSave").fadeOut('slow');
$("#timelineShade").fadeIn("slow");
$("#timelineBGload").removeClass("headerimage").css({'margin-top':html});
return false;
}
}
});
return false;
});

});
</script>


<div id="container">
<div id="timelineContainer">
<!-- timeline background -->
<div id="timelineBackground">
<img src="uploads/backgroundimage.jpg" class="bgImage" style="margin-top: -10px;">
</div>

<!-- timeline background -->
<div id="timelineShade">
<form id="bgimageform" method="post" enctype="multipart/form-data" action="image_upload_ajax_bg.php">
<div class="uploadFile timelineUploadBG">
<input type="file" name="photoimg" id="bgphotoimg" class="custom-file-input">
</div>
</form>
</div>

<!-- timeline profile picture -->
<div id="timelineProfilePic"></div>

<!-- timeline title -->
<div id="timelineTitle">Srinivas Tamada</div>

<!-- timeline nav -->
<div id="timelineNav"></div>

</div>
</div>

<div class="uploadFile timelineUploadBG">
<input type="file" name="photoimg" id="bgphotoimg" class="custom-file-input">
</div>
