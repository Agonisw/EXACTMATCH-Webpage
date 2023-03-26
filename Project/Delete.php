<?php
 
 echo'
<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE>Administration</TITLE>
   <link rel="stylesheet" type="text/css" href="Administration.css"> 
 </HEAD>
 <BODY>
 ';
 
 

 $selectedID= $_POST["selectedID"];
 echo "The user {$selectedID}&nbsp;is to be permanently deleted, and the registered email of the user has been blacklisted.<br>";
 
 
 header("content-type:text/html;charset=utf-8");
$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
if (!$link) {
die("fail to connect " . mysqli_connect_error());
}
mysql_query("set names utf8");  


$sql = "select * from User_Table where User_ID='$selectedID'";
 $result = mysqli_query($link,$sql);
 $row=mysqli_fetch_assoc($result);
     $Email=$row["Email"];
     $currenttime = date("Y-m-d H:i:s");
$sql = "INSERT INTO Blacklist_Table  VALUES ('$selectedID','$Email','$currenttime')";
	$result = mysqli_query($link,$sql);
//Delete
	$sql = "delete from User_Table where User_ID='$selectedID'";
	$result = mysqli_query($link,$sql);
	$sql = "delete from Profile_Table where User_ID='$selectedID'";
	$result = mysqli_query($link,$sql);
	




echo '<br><form method="post" action="Blacklist.php"><button >Return Blacklist</button></form>';
echo '<br><form method="post" action="Administration.php"><button >Return Administration</button></form>';

echo'
 </BODY>
</HTML>
';	
?>