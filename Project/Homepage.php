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
 
echo'
<!DOCTYPE html>
<HTML>
 <HEAD>
  <TITLE>Homepage</TITLE>
  <link rel="stylesheet" type="text/css" href="menu.css"> 
   <link rel="stylesheet" type="text/css" href="Homepage.css"> 
 </HEAD>
 <BODY>
<ul>
  ';
 if($_POST["menu1"]==TRUE)
{
echo'	<form action="Homepage.php" method="post"><input type="submit" name="menu2" value="↓&emsp;&emsp;&emsp;&emsp;↓&emsp;&emsp;&emsp;&emsp;↓" class="menu"> </form>';
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
<form action="Homepage.php" method="post"><input type="submit" name="menu1" value="↑&emsp;&emsp;&emsp;&emsp;↑&emsp;&emsp;&emsp;&emsp;↑" class="menu"> </form>';
}
echo'
</ul>
 
 <div class="contents">

 ';

 //YES
 
 
 //NO
 
 
 
 
 
 //用户总数
   $sql = "select count(*) FROM User_Table";
	$result = mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);
     $numberofuser=$row["count(*)"];
 //表中已匹配的或不匹配的用户数
     $matchednumber=0;
	   $sql = "SELECT * FROM Connection_Table WHERE ((UserB_ID='$userid' And (Status=0 OR Status=2))or (UserA_ID='$userid'))";
     $result = mysqli_query($link,$sql);
 
  while($row=mysqli_fetch_assoc($result))
{ 
	 $matchednumber=$matchednumber+1;
	 }
mysqli_free_result($result);

 
 
 
 
 
   if( $matchednumber+1==$numberofuser)
  {
	  echo"<br>There are&nbsp;".$numberofuser."&nbsp;users on our platform. You have matched all users that can be matched!<br>";
	  
  }
  
  
  
 else{
	$sql = "select * from User_Table left join Profile_Table using (User_ID) where  (
	User_ID<>'$userid' AND 
	User_ID<>ALL(select UserA_ID from Connection_Table where ((Status=0 or status=2) AND UserB_ID='$userid'))
	AND User_ID<>ALL(select UserB_ID from Connection_Table where UserA_ID='$userid')
	) ORDER BY RAND() LIMIT 1";
	
  $result = mysqli_query($link,$sql);
  $row=mysqli_fetch_assoc($result);
 //matchsession
  $matchedid=$row["User_ID"];
  $_SESSION["matchedid"]=$matchedid;
     $image = $row["image"];
 echo'
 <br><br><img src="img/'.$image.'" width = 125 height = 125">
 <h3>'.$row["Username"]."(".$row["User_ID"].')</h3>
 <h5>
 Gender:&nbsp;'.$row["Gender"].'<br>
 Age:&nbsp;'.$row["Age"].'<br>
 Resident City:&nbsp;'.$row["Resident_City"].'<br><br>

  Hobby:&nbsp;'.$row["Hobby"].'<br>
  Description:&nbsp;'.$row["Bio"].'<br>
 
 </h5>
  <h2>Want to have a chat?</h2> 
  
 <a href="Yes.php"><button class="button button1" >YES</button></a>&emsp;&emsp; &emsp;&emsp;
 <a href="No.php"> <button class="button button2">NO</button></a>
 
   <br><br><br>';
//等待回应
   echo'<h4 style="background-color:grey;color:white">Here are all the users waiting for your response!</h4>';
   
   //select * from User_Table left join Profile_Table using (User_ID) WHERE User_ID IN (select UserB_ID from Connection_Table WHERE (UserA_ID=1 AND Status=1))
  
 $sql = "select * from User_Table left join Profile_Table using (User_ID) WHERE User_ID IN
       (select UserA_ID from Connection_Table WHERE (UserB_ID='$userid' AND status=1))";
     $result = mysqli_query($link,$sql);
     echo'
    <table>
    <tr>
	<th>User_ID</th>
	<th>Username</th>
	<th>Simple information</th>
	<th>Hobby</th>
   </tr>';
  while($row=mysqli_fetch_assoc($result))
{ 
	  echo "<tr><td>".$row["User_ID"] ."</td><td>".$row["Username"]."</td>
	            <td>".$row["Gender"].", ".$row["Age"]."</td><td>".$row["Hobby"]."</td></tr>";
	 }
  //SELECT * FROM Connection_Table WHERE (UserA_ID=1 OR UserB_ID=1)
//select count(*) FROM User_Table
mysqli_free_result($result);
echo "</table>";
   //快速抖索
    echo'<h4 style="background-color:grey;color:white">Here you can simply enter UserID and select YES or NO！</h4>



               <form method="post" action="Yes.php">
			   <input type="number" name="matchedID">&emsp;
			   <button class="button button1" >YES</button></form><br>
			   
			       <form method="post" action="No.php">
			   <input type="number" name="matchedID">&emsp;
			   	<button class="button button2">NO</button></form>
 
 
 ';
 
 
	}

	
	echo'<h4 style="background-color:grey;color:white">Here is your Connection Table!</h4>';
	    
		$matchednumber=0;
	   $sql = "SELECT * FROM Connection_Table WHERE (UserA_ID='$userid' or UserB_ID='$userid')";
     $result = mysqli_query($link,$sql);
 
     echo'
    <table>
    <tr>
	<th></th>
	<th>UserA_ID</th>
	<th>UserB_ID</th>
	<th>ConnectionTime</th>
	<th>Status</th>
	
   </tr>';
  while($row=mysqli_fetch_assoc($result))
{ 
	 $matchednumber=$matchednumber+1;
	if($row["Status"]==1)
	 { $sta="Waiting for UserB"; }
	 else if($row["Status"]==2)
	 { $sta="Accepted"; }
     else if($row["Status"]==0)
	  { $sta="Refused"; }
		 
	  echo "<tr><td>&emsp;&emsp;".$matchednumber."</td><td>"  .$row["UserA_ID"] ."</td><td>".$row["UserB_ID"]."</td>
	            <td>".$sta."</td><td>".$row["ConnectionTime"]."</td></tr>";
	 }
  //SELECT * FROM Connection_Table WHERE (UserA_ID=1 OR UserB_ID=1)
//select count(*) FROM User_Table
mysqli_free_result($result);
	mysqli_close($link);
echo "</table>";
 
	

  
 echo'
 </div>
 
 </BODY>
</HTML>
';
 
?>