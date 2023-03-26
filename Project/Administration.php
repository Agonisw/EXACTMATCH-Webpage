<?php

session_start();
$userid= $_SESSION["User_ID"];
 $username=$_SESSION['username'];

 header("content-type:text/html;charset=utf-8");
$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
if (!$link) {
die("fail to connect " . mysqli_connect_error());
}
mysql_query("set names utf8");
	//c1
	$user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM User_Table WHERE User_ID = $userid"));
    $image = $user["image"];
	//头像调用

 $sql = "select * from User_Table where User_ID=$userid";
 
$result = mysqli_query($link,$sql);
  $row=mysqli_fetch_assoc($result);
     $admin=$row["Admin"];
  
 echo'
<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE>Administration</TITLE>
  <link rel="stylesheet" type="text/css" href="menu.css"> 
   <link rel="stylesheet" type="text/css" href="Administration.css"> 
 </HEAD>
 <BODY>
 <ul>
 ';
  if($_POST["menu1"]==TRUE)
{
	$_SESSION["menu"]=1;
}
else if($_POST["menu2"]==TRUE){
	$_SESSION["menu"]=0;
}

 if($_SESSION["menu"]==1)
{
echo'	<form action="Administration.php" method="post"><input type="submit" name="menu2" value="↓&emsp;&emsp;&emsp;&emsp;↓&emsp;&emsp;&emsp;&emsp;↓" class="menu"> </form>';
}
else {
 echo'
<br>
 <div class ="head">
  <li class="dropdown">
  <a href="javascript:void(0)" class="dropbtn"  ><img src="img/'.$image.'" width = 125 height = 125"></a>
    <div class="dropdown-content">
	  <a href="Security.php">Information security</a>
	  <br>
	 <div class="container">
	    <img src="img/'.$image.'" width = 125 height = 125">
	    <form method="post" action="ShowProfile.php">
         <button type="submit" class="btn">Modify the profile</button></form>
     </div>
    </div>
  </li>
  <div>
  <h3>&emsp;'.$username.'&emsp;</h3>
   <hr>
   <h3>&emsp;'.$userid.'&emsp;<h3>
</div>
  </div>
  <li ><a class="active1" href="Homepage.php">Homepage</a></li>
    <li><a class="active3" href="Search.php">Search</a></li>
	<li ><a class="active4" href="Chat.php">Chat</a></li>
   <li><a class="active5" href="Administration.php">Administration</a></li>
<form action="Administration.php" method="post"><input type="submit" name="menu1" value="↑&emsp;&emsp;&emsp;&emsp;↑&emsp;&emsp;&emsp;&emsp;↑" class="menu"> </form>';
}
echo'
</ul>
 
 <div class="contents">

 ';
 
 
 if($admin!=1)
 {
      echo'<br>'."You're not an administrator, so you don't have administrative rights.".
	 '<br>If necessary, please contact the administrator Guiyang. Her email is 1064334057@qq.com<br><br>';


}
else{
 
	$sql = "select * from User_Table left join Profile_Table using (User_ID)";
	$result = mysqli_query($link,$sql);

 

 echo '<h4 style="background-color:grey;color:white">Here you can enter the UserID you want to operate with and click the button to operate!</h4>
             <div class="btn-group">
             <form method="post" action="Edit.php" >
			      <input type="number" name="selectedID">&emsp;
				  <button type="submit" class="button">Edit</button></form><br>
				  
               <form method="post" action="Ban.php">
			   <input type="number" name="selectedID">&emsp;
			   <button class="button">Ban</button></form><br>
			  
			  
			   <form method="post" action="Delete.php">
			   <input type="number" name="selectedID">&emsp;
			   <button type="submit" class="button">Delete</button></form><br>
			   
			   <form method="post" action="Blacklist.php">
			   <button type="submit">Blacklist</button></form>
                
				</div>
	
				';


echo'<h4 style="background-color:grey;color:white">Here you can view the information of all users!</h4>
<table>
    <tr>
	<th>Profile Picture</th>
	<th>Security Information</th>
	<th>Resume information</th>
   </tr>';
   
   
  
   

while($row=mysqli_fetch_assoc($result))
{  $image = $row["image"];
 echo '<tr><td><img src="img/'.$image.'" width = 125 height = 125"></td>';
   echo "<td>User_ID:&emsp;".$row["User_ID"]
	   ."<br>Userame:&emsp;".$row["Username"]
	   ."<br>Email:&emsp;".$row["Email"]
	   ."<br>Password:&emsp;".$row["Password"]."</td>";
   
    echo "</td><td>Real Name:&emsp;".$row["FirstName"]."&nbsp".$row["LastName"]
       ."<br>Gender:&emsp;".$row["Gender"]
	   ."<br>Birthday:&emsp;".$row["Birthday"]
	     ."<br>Resident City:&emsp;".$row["Resident_City"].'</td>';
   
}
   	
mysqli_free_result($result);
	mysqli_close($link);

echo "</table>";


	
}

 echo'
 </div>
 
 </BODY>
</HTML>
';
 

	
?>