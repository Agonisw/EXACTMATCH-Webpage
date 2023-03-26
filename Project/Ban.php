
<?php

 
 $selectedID= $_POST["selectedID"];

 
 echo'
<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE>Administration</TITLE>
   <link rel="stylesheet" type="text/css" href="Administration.css"> 
 </HEAD>
 <BODY>
 ';
 
 header("content-type:text/html;charset=utf-8");
$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
if (!$link) {
die("fail to connect " . mysqli_connect_error());
}
mysql_query("set names utf8");  

$currenttime = date("Y-m-d H:i:s");
$sql = "INSERT INTO Blacklist_Table (User_ID,Timestamp) VALUES (' $selectedID','$currenttime')";
	$result = mysqli_query($link,$sql);
	  echo "The user {$selectedID}&nbsp;has been blacklisted and cannot chat with others until the ban is lifted. <br>";
 


echo '<br><form method="post" action="Blacklist.php"><button >Return Blacklist</button></form>';
echo '<br><form method="post" action="Administration.php"><button >Return Administration</button></form>';

 echo'
 </BODY>
</HTML>
';
 

	
?>

