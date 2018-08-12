<?php include("./inc/header.inc.php");?>
<?php
   if($username){
echo "<div style='position:fixed;top:60px;'>";
include("./button.php");
echo"</div>";
}

   if(isset($_POST["submit"])) {
  
    $name=$_POST["user"];
	$userEmail=$_POST["userEmail"];
	$body=$_POST["body"];
	$query_check=mysqli_query($connection,"INSERT INTO feedback VALUES('','$name','$userEmail','$body') ");
	 echo "<center><div style='border:1px solid silver;padding:10px;margin-top:80px;width:400px;align:center;background-color:#56A1D0;border:2px solid #fff;color:#fff;font-weight:bold;font-family:helvetica;font-size:15px;'>Thank You $name for your thoughts,and time, We apppreciate it. We will try our best to make this more entertaining and useful for you. <br><br>Thank you from Vaarta team.  </div></center>";
		
   }


?>  
<script>
document.getElementById("logo").src="./img/v.png";
</script>             
   <center >
           
    <form method="post" action="feedback.php" style="border:1px solid silver;padding:20px;width:600px;margin-top:100px;font-size:15px;background-color:#fff;color:#797979;">
                                   <h1 style="font-style:italic; font-family:helvetica;color:#f9f9f9;padding:20px;background-color:#56A1D0;">For Vaarta</h1><br><br>
		  <input type="text" name="user" placeholder="Enter Your Name" style="color:#000000; background-color:#fff;"><br><br>
          <input type="email"name="userEmail" placeholder="Enter email"style="color:#000000; background-color:#fff;"><br><br>
		  <textarea cols="32"rows="1" name="body" placeholder="Enter your feedback" style="color:#000000; background-color:#fff;"></textarea><br><br>
     	   <input type="submit" name="submit">
    </form>
	</center>
	
<div style='position:absolute;top:580px;width:100%;'>
<?php include("./inc/footer.inc.php");?></div>