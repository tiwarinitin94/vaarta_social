<?php
 include("./inc/header.inc.php");
?>
<style>
body{
background-color:#f0f0f0;
}
#wrapper{
  	background-color:rgba(800,100,100,.9);
}
</style>
<script>
document.getElementById("logo").src="./img/v.png";
</script>	
<div id="mySidenav" class="sidenav">
 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
<script>
/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "180px";
 
 document.getElementById("main").style.marginLeft = "180px";
 

 
}
  window.onload=openNav;
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    
    document.getElementById("main").style.marginLeft = "0";
	
}
</script>

<?php 
include("./button.php");?><br>
<center>
<img src="./img/namastey.png" style="height:80px; width:80px;margin-left:10px;"><br>
Namastey<br>
<h2 style="color:#fff;font-family:papyrus;font-weight:bold;">
<?php echo $username ?>
</h2></center>
 </div>

<div style="top-left;position:fixed;">
<span onclick="openNav()"><input type="button" value="&#9776" id="style_button"></input></span>
</div>
<div id="main">
<center style="width:1000px;">
<div class="search_user" >
<div style="padding:5px;">Searched People</div>

<?php
//Searching people
   
    if(isset($_GET['q'])){
     $search_query=mysqli_real_escape_string($connection,$_GET['q']);
	 if($search_query==""){
		    echo "<center style='background-color:rgba(600,50,50,.9); padding:10px;color:#fff;'> Please enter words</center>";
			exit();
	 }
    $sear_q=mysqli_query($connection,"SELECT* FROM myusers WHERE first_name LIKE '%$search_query%' or username LIKE '$search_query%' or last_name LIKE '$search_query%' LIMIT 5");
     $num_search_rows=mysqli_num_rows($sear_q);
	 If($num_search_rows>=1){
	 while($search_name=mysqli_fetch_assoc($sear_q)){
    $first_user_name=$search_name['username'];
     $first_name=$search_name['first_name'];
	  $first_name=(strlen($first_name)>10) ? substr($first_name,0,10).'...' : $first_name;
	 $last_name= $search_name['last_name']; 
	 $cover_pic_search= $search_name['cover_pic']; 
	  if ($cover_pic_search == "") {
  $cover_pic_search = "./img/background-image.png";
  }
  else
  {
  $cover_pic_search = "userdata/cover_pics/".$cover_pic_search;
  }
	 $profilepic_info_suggested = $search_name['profile_pic'];
                                                if ($profilepic_info_suggested == "") {
                                                 $profilepic_info_suggested = "img/default-pic.png";
                                                }
                                                else
                                                {
                                                 $profilepic_info_suggested = "./userdata/profile_pics/".$profilepic_info_suggested;
                                                }
												?>
												<script>
												 document.title = "Search Result-<?php echo $search_query; ?>";
												</script>
												
												<a href='<?php echo $first_user_name;?>' style='color:#000000;text-decoration:none;font-style:helvetica;'>
												<div id='user_searched' >
												<img src='<?php echo $cover_pic_search; ?>' style='width:300px;height:200px;'/>
												<img src='<?php echo $profilepic_info_suggested; ?>' title='$first_name' style='margin-top:-20px;cursor:pointer;box-shadow:4px 4px 4px rgba(4px 4px 4px 4px); height:80px; width:80px;border-radius:50%;'/>
												<?php echo $first_name." ".$last_name; ?></div></a> <?php
	}
	}else{
	       echo "<div style='margin-top:20px;text-align:center;font-family:times new roman;opacity:.3; font-size:22px;'>Sorry....No People Found.......</div>";
	
	}
	


?>
</div>



<div class="search_pages"  >
<div style="width:100%;text-align:center;padding:5px;">Searched Pages</div>
<?php
//Searching people
    
    $sear_q=mysqli_query($connection,"SELECT* FROM shashtra WHERE shashtra_name LIKE '%$search_query%' or shashtra_url='$search_query'LIMIT 5");
     $num_search_rows=mysqli_num_rows($sear_q);
	 If($num_search_rows>=1){
	 while($search_name=mysqli_fetch_assoc($sear_q)){
    $shahstra_url=$search_name['shashtra_url'];
     $shashtra_name=$search_name['shashtra_name'];
	                                               
	 $profilepic_info_suggested = $search_name['shashtra_pic'];
                                                if ($profilepic_info_suggested == "") {
                                                 $profilepic_info_suggested = "img/default-pic.png";
                                                }
                                                else
                                                {
                                                 $profilepic_info_suggested = "./userdata/data_pics/".$profilepic_info_suggested;
                                                }
												echo"<div id='page_searched'><a href='shashtrartha.php?str=$shahstra_url' style='float:left;color:#000000;text-decoration:none;font-style:papyrus;font-weight:bold;margin-top:30px;'><img src='$profilepic_info_suggested' title='$shashtra_name' style='cursor:pointer;margin-left:10px;float:left;box-shadow:4px 4px 4px rgba(4px 4px 4px 4px); height:100px; width:100px;'/>$shashtra_name</a></div>";
	}
	}else{
	       echo "<div style='text-align:center;font-family:times new roman;opacity:.3; font-size:22px;'>Sorry....No Page Found.......</div>";
	
	}
	
}

?>
</div>
</center>
</div>
