<?php include("./inc/header.inc.php");?>

<?php
if($username==""){
?>
  <script>
  alert("You should be logged in");

</script><?php
exit();

}else{}
$check1= mysqli_query($connection,"SELECT username,first_name,last_name,id FROM myusers WHERE username='$username'");  
	 if(mysqli_num_rows($check1)==1){
  $get1=mysqli_fetch_assoc($check1);
  $user_one=@$get1['id'];
  

?>


<script>
  
document.getElementById("logo").src="./img/v.png";

</script>



<div id="main">
<div id="messenger"style="padding-left:15px;border-left:4px solid #fff; box-shadow:1px 1px 1px #000; " >

</div>


 <script>
  function 
  get_user() {
        $("#messenger").load("get_user_data.php");
			  	}
  setInterval(function(){ get_user() }, 1500);
  
</script>
<?php

if(isset($_GET['c_id'])){
$cid=mysqli_real_escape_string($connection,$_GET['c_id']);
?>
<div id="msgarea" onload="myFunction()" style="margin-left:260px;height:450px;width:700px; background-color:#fff;overflow-y:scroll;">
<center style="margin-top:200px;"><div id="loader" ></div></center>

</div>
<div id="replyboxarea" style="margin-left:255px;z-index:-1;">
  
<script>

$(document).ready(function (e) {
$("#uploadimage").on('submit',(function(e) {

var uid=<?php echo $user_one;?>;
var cid=<?php echo $cid;?>;
var message = msginput.value;
e.preventDefault();
$("#message").empty();
$('#loading').show();
$.ajax({
url: "send_mesage.php?uid="+uid+"&cid="+cid+"&msg="+message, // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$('#loading').hide();
msginput.value="";
				file.value="";
				image.src="./img/noimage.png";
}
});

}));

// Function to preview image after validation
$(function() {
$("#file").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg","image/gif"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])||(imagefile==match[3])))
{
$('#previewing').attr('src','noimage.png');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {	
$("#file").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '150px');
$('#previewing').attr('height', '100px');
};
});



function togglepost(){  
var ele = document.getElementById("image_preview");
                                                if (ele.style.display == "block") {
                                                ele.style.display = "none";
                                                   }
                                                    else
                                                   {
                                                  ele.style.display = "block";
                                                     }
                                                    }
</script>
<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
<hr id="line">
<div id="selectImage">
<input type="text"  id="msginput"  name="msginput" style="z-index-1;height:30px;width:575px;font-size:15px;border-radius:5%;" placeholder="Reply.....(Pratiuttar) Press enter to send message" ></input>
 <input type="file" name="file" id="file" accept="image/*" style="visibility: hidden;background-color:transparent;" />
<img src="./img/camera.png" onclick="togglepost()"title="Upload image"style="height:30px; width:30px;margin-left:-260px;margin-bottom:-10px; "/>
 <input type="submit"  style="border:none; box-shadow:none; background-color:#43ACEC; padding:10px;"value="Reply" class="submit" />
 <div id="image_preview" style="display:none;"><a href="#" onclick="document.getElementById('file').click(); return false;"  ><img id="previewing" src="img/noimage.png" /></a></div>
</div>
</form>
<div id="message"></div>
</div>
      
<script>




 var msginput = document.getElementById("msginput");
var msgarea = document.getElementById("msgarea");
  

 var image= document.getElementById("previewing");
 var file= document.getElementById("file");

function update(){
             var output="";
             var uid=<?php echo $user_one; ?>;                        
             var cid=<?php echo $cid; ?>;
            
           if (window.XMLHttpRequest) {
		var xmlhttp=new XMLHttpRequest();
              } else {
    // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
}                xmlhttp.onreadystatechange=function() {
       if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				             document.getElementById("msgarea").innerHTML = xmlhttp.responseText;
                                        
				msgarea.scrollTop = msgarea.scrollHeight;
				
                  				
			}
}

          xmlhttp.open("GET","get_message_ajax.php?cid="+cid+"&uid="+uid,true);
          xmlhttp.send();

           

}




 setInterval(function(){ update() }, 4500);

 </script>

 
 

</div> <?php 
	 } }  ?>
	 </div>