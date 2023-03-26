
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
 
 header("content-type:text/html;charset=utf-8");
$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
if (!$link) {
die("fail to connect " . mysqli_connect_error());
}
mysql_query("set names utf8");  

	$sql = "select * from Blacklist_Table";
	$result = mysqli_query($link,$sql);
echo'
<table>
    <tr>
	<th>User_ID</th>
	<th>Email</th>
	<th>Timestamp</th>
   </tr>';
   
while($row=mysqli_fetch_assoc($result))
{ 
 echo "<tr><td>".$row["User_ID"] ."</td><td>".$row["Email"] ."</td><td>".$row["Timestamp"]."</td>";
  
}
   	
mysqli_free_result($result);
	mysqli_close($link);
echo "</table>";



echo'
  <br><br>Enter User_ID to operate:<br><br><form method="post" action="CancelBan.php">
			   <input type="number" name="selectedID">&emsp;
			   <button >Cancel the ban</button></form>
';



echo '<br><br><form method="post" action="Administration.php"><button >Return Administration</button></form>';

 echo'
 </BODY>
</HTML>
';
 

	
?>


 