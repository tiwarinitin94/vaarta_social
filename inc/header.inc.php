<?php 
 include("./inc/connect.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US">
<html>
<head><meta charset="utf-8" /><meta property="og:site_name" content="Vaarta"/>
<meta name="keyword" content="Vaarta, Conversation, Social, Media, news, Chatting, groups, pages, account, people, places"/>
<meta name="description" content="Create an account, Connect with your friends, Explore your status, Have some fun, Share photos videos, staus update and more"/>
 <meta name="author" content="NITIN TIWARI" />
  <meta name="Date modified" content=""/>
  <meta name="Owner" content="Nitin Tiwari"/>
  <meta name="Designer" content="Nitin Tiwari"/>
  <meta name="reach" content="global">
<meta name="Content-Language" content="english and hindi">
<meta name="rating" content="general">
<link href="./img/vaarta_ico.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href= "./css/style.css"/>

        <link rel="stylesheet" type="text/css" href="css/style2.css" />
<!----------<		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>	
<!----------<link rel="stylesheet" type="text/css" href="http://localhost/ossn/css/view/ossn.default.css" />----->




<title>Vaarta</title>

<script src="./js/jquery-1.12.2.min.js"></script>

</head>
<body >

<div class="header20"style=" z-index:4;position:fixed;top:0;width:100%;">

     <div id="wrapper">
	   
        <?php
		if(!$username){
		echo '
		<div id="menu">		   
		   <a href="index.php" title="Home" /><span>Home</span></a>
		   <a href="about.php	" title="About Vaarta" /><span>About</span></a>
		</div>
         		';
				echo' <div class="logo" style="float:right;margin-right:290px;>';
	                echo '<a href="index.php"title="Home" "> <img id="logo"src="./img/v.png"/></a>';
		
		echo"
		</div>";
		}else{?>
		        
		 	 <div id="menu">
		       <a href="home.php" title="Logout"  ><span >Home</span></a>
			  <a href="<?php echo $username; ?>" title="Logout"  ><span >Profile</span></a>
			  <a href="logout.php" title="Logout"  ><span >Logout</span></a>
			   
		   </div>
		    <div class="logo">
		<?php
		if(!$username){
		echo '<a href="index.php"title="Home"> <img id="logo"src="./img/v.png"/></a>';
		}
		else{
		echo '<a href="welcome.php"title="Home"> <img id="logo" src="./img/v1.png"/></a>';
		}
		?>
		</div>	
		<span onclick="openNav()" id="style_button">&#x2630;</span>
		   <div id="search_box">
		 <form action="search.php" id="search" >
		   <input type="text" name="q" size="60" value="Search Vaarta" onclick="value=''" onkeyup="showResult(this.value)"/>
		    <div id="livesearch"></div>
		   </form>
		   
		 </div>
		<?php }
		?>
		
    		
		</div>
	</div>
	<?php if($username){ ?>
	<div id="mySidenav" class="sidenav">
 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> 
<script>

/* Set the width of the side navigation to 250px */
function openNav() {
	 var x=document.getElementById("mySidenav").offsetWidth;
	    if(x==1){
    document.getElementById("mySidenav").style.width = "150px"; 
	}else{
		 document.getElementById("mySidenav").style.width = "0px"; 
		
	}

}
 window.onload=openNav;  
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
     }
</script>

<?php 
include("./button.php");?>
<center>
<img src="./img/namastey.png" style="height:80px; width:80px;margin-left:10px;"><br>
Namastey<br>
<h2 style="color:#fff;font-family:papyrus;font-weight:bold;">
<?php echo $username ?>
</h2>
</center>
 </div>	
		
	<?php }?>