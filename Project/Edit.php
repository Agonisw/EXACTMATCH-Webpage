
<?php
session_start();
if(isset($_POST["selectedID"]))
{
	$_SESSION["selectedID"]=$_POST["selectedID"];
}
else{
	
$edit= $_POST["edit"];
 $editValue= $_POST["editValue"];
}

$selectedID=$_SESSION["selectedID"];

 
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

 $sql = "Update User_Table left join Profile_Table using (User_ID) set $edit='$editValue' where User_ID='$selectedID'";
	$result = mysqli_query($link,$sql);
	
$sql = "select * from  User_Table left join Profile_Table using (User_ID) where User_ID='$selectedID'";
	$result = mysqli_query($link,$sql);
	  echo "Here's all the information about the user{$selectedID}&nbsp:<br><hr>";
 $row=mysqli_fetch_assoc($result);
 echo "Photo:&emsp;".$row["Photo"];
   echo "<br>User_ID:&emsp;".$row["User_ID"]
	   ."<br>Username:&emsp;".$row["Username"]
	   ."<br>Email:&emsp;".$row["Email"]
	   ."<br>Password:&emsp;".$row["Password"];
   
    echo "<br>Real Name:&emsp;".$row["FirstName"]."&nbsp".$row["LastName"]
       ."<br>Gender:&emsp;".$row["Gender"]
	   ."<br>Birthday:&emsp;".$row["Birthday"];
	   
  
echo '<br><hr> <form method="post" action="Edit.php">
       Which item do you want to change?<br>
		   <input type="text" name="edit">&emsp;<br>
		   What value do you want to change it to?<br>
            <input type="text" name="editValue">&emsp;<br>
			<br><button>Edit</button></form>';
		
echo '<br><hr><br><form method="post" action="Administration.php"><button >Return Administration</button></form>';
 echo'
 </BODY>
</HTML>
';
 

	
?>

