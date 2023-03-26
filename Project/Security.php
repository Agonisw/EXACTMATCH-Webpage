<?php
session_start();
$userid= $_SESSION["User_ID"];
$username=$_SESSION["username"];  

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


echo'<!DOCTYPE html>
<html>
 <head>
  <title>Security</title>
  <link rel="stylesheet" type="text/css" href="menu.css"> 
  
 </head>
 <body>
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
echo'	<form action="Security.php" method="post"><input type="submit" name="menu2" value="↓&emsp;&emsp;&emsp;&emsp;↓&emsp;&emsp;&emsp;&emsp;↓" class="menu"> </form>';
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
<form action="Security.php" method="post"><input type="submit" name="menu1" value="↑&emsp;&emsp;&emsp;&emsp;↑&emsp;&emsp;&emsp;&emsp;↑" class="menu"> </form>';
}
echo'
</ul>
 
 <div class="contents">

 ';
 
  $sql = "select * from User_Table where User_ID='$userid'";
   $result = mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);
     $confirmEmail=$row["Email"];
     $confirmPassword=$row["Password"];
	 
 


 echo'
 <h3>Change your account security information  </h3>
<a href="index.html"><button class="button button1">Log out</button></a>
<br><br><hr><br>';

if($_POST["username"])
{
	$newinformation=$_POST["username"];
	 $sql = "Update User_Table set Username='$newinformation' where User_ID='$userid'";
	$result = mysqli_query($link,$sql);
	$_SESSION["username"]=$newinformation;
	echo'<h4 style="background-color:green;color:white">Successful change!</h4><br>';
}

echo'
<form method="post" action="Security.php">
<label>&emsp;&emsp;&emsp;New Username&emsp;&emsp; <input type="text" name="username"></label>&emsp;&emsp;
<input type="submit" value="Change my username"></form>
<BR><br><hr><BR>';


if($_POST["oldemail"])
{
	if($confirmEmail!=$_POST["oldemail"])
	{
		echo'<h4 style="background-color:red;color:white">Wrong old email!</h4><br>';
		}
    else if($_POST["newemail"])
	{
		$newinformation=$_POST["newemail"];
	 $sql = "Update User_Table set Email='$newinformation' where User_ID='$userid'";
	$result = mysqli_query($link,$sql);
	echo'<h4 style="background-color:green;color:white">Successful change!</h4><br>';
	}
}


echo'
<form method="post" action="Security.php">
<label>&emsp;&emsp;&emsp;Old Email&emsp;&emsp; <input type="text" name="oldemail"></label>
<BR><BR>
<label>&emsp;&emsp;&emsp;New Email&emsp;&emsp; <input type="text" name="newemail"></label>
<BR><BR>
<input type="submit" value="Change my email"><form>
<BR><br><hr><BR>';




 if($_POST["oldpassword"]!=NULL)
{
	if($confirmPassword!=$_POST["oldpassword"])
	{
		echo'<h4 style="background-color:red;color:white">Wrong old password!</h4><br>';
	}
    else if($_POST["newpassword"]!=NULL)
	{
		 if($_POST["newpassword"]!=$_POST["repeatedpassword"])
		 {
			echo'<h4 style="background-color:red;color:white">The two passwords are inconsistent!</h4><br>';
		 }
		 else if($_POST["repeatedpassword"]!=NULL)
		 {
			$newinformation=$_POST["repeatedpassword"];
	     $sql = "Update User_Table set Password='$newinformation' where User_ID='$userid'";
	      $result = mysqli_query($link,$sql);
		  echo'<h4 style="background-color:green;color:white">Successful change!</h4><br>';
		 }
		
	}
}


echo'
<form method="post" action="Security.php">
<label>&emsp;&emsp;&emsp;Old Password&emsp;&emsp;&emsp;&emsp;<input type="password" name="oldpassword"></label>
<BR><BR>
<label>&emsp;&emsp;&emsp;New Password&emsp;&emsp;&emsp;<input type="password" name="newpassword"></label>
<BR><BR>
<label>&emsp;&emsp;&emsp;Repeated Password&emsp;<input type="password" name="repeatedpassword"></label>
<BR><BR>
<input type="submit" value="Change my password"></form>
<br>
	<br><br>';
   

   
   echo'
   </div>

 </body>
</html> ';
?>