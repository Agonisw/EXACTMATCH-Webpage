
<?php
session_start();
$userid= $_SESSION["User_ID"];
$username=$_SESSION["username"];  


if($_POST["back"]==TRUE)
{
	 unset($_SESSION['chatid']);
}



  header("content-type:text/html;charset=utf-8");
$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
if (!$link) {
die("fail to connect " . mysqli_connect_error());
}
mysql_query("set names utf8"); 
 	//c1
	$user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM User_Table WHERE User_ID = $userid"));
    $image = $user["image"];
	//头像调用<img src="img/'.$image.'" width = 125 height = 125">
echo'<!DOCTYPE html>
<html>
 <head>
 <link rel="shortcut icon" href="Welcomeig.png" />
  <title>ExactMatch</title>
  <link rel="stylesheet" type="text/css" href="menu.css"> 
   <link rel="stylesheet" type="text/css" href="Chat.css"> 
 </head>
 <body>
 <ul>
 ';
 if($_POST["menu1"]==TRUE)
{
echo'	<form action="Chat.php" method="post"><input type="submit" name="menu2" value="↓&emsp;&emsp;&emsp;&emsp;↓&emsp;&emsp;&emsp;&emsp;↓" class="menu"> </form>';
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
<form action="Chat.php" method="post"><input type="submit" name="menu1" value="↑&emsp;&emsp;&emsp;&emsp;↑&emsp;&emsp;&emsp;&emsp;↑" class="menu"> </form>';
}
echo'
</ul>
 
 <div class="contents">

 ';
 
  $sql = "select * from User_Table left join Profile_Table using (User_ID) where ( 
  User_ID in (select UserB_ID from Connection_Table where (UserA_ID='$userid' AND Status=2))   OR 
  User_ID in (select UserA_ID from Connection_Table where (UserB_ID='$userid' AND Status=2))
  )";
   $result = mysqli_query($link,$sql);
   
   
    echo'

 <h1>Conversations</h1>
 
  <div class = "window">
<table>';
 

 $connectednumber=0;
   while($row=mysqli_fetch_assoc($result))
{ 
 echo '<tr><td> <img src="img/'.$row["image"].'" width = 125 height = 125"></td>
      <td><b>'.$row["Username"]."<br>(".$row["User_ID"] .")</b><br>".$row["Gender"] .",&nbsp;".$row["Age"]."
	  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	  <br>".$row["Profession"]."</td></tr>";
   $connectednumber= $connectednumber=+1;;
}
 echo'
  </table>';

  
  
mysqli_free_result($result);
	
 //没有accept的
 if($connectednumber==0){
	 echo'<br><h3>&emsp;There is no user who can set up chat, please wait patiently.<br><br></h3>';
 }
else{
//左边表
   echo'
<div class="conversation">';



if($_POST["matchedID"]==0&&$_SESSION["chatid"]==0){
	
	echo '<br>Enter the User_ID of the user you want to chat with <br> to start the conversation.<br>(You can only choose from the list on the left !!!) <br>
	       <br> <form method="post" action="Chat.php">
			   <input type="number" name="matchedID">&emsp;
			   <button class ="button" >Chat!</button></form><br>';
}

else{
	$chatid=$_POST["matchedID"];
	 $sql = "select * from Connection_Table where (( (UserA_ID='$chatid' AND UserB_ID='$userid')OR(UserB_ID='$chatid' AND UserA_ID='$userid') )
	  AND Status=2)";
   $result = mysqli_query($link,$sql);
	$chatnumber=0;
	   while($row=mysqli_fetch_assoc($result))
        {  $chatnumber= $chatnumber=+1; }
	
	
	  if ($chatnumber==0 && $_SESSION["chatid"]==0)
	  {
		  echo '<br> invalid input!<br>You can only choose from the list on the left. <br>
		   <br> <form method="post" action="Chat.php">
			   <button class ="button" >Back</button></form>
		  <br>';  
	  }   
	  
	  else{
	//  
		  if($chatid==0)
		  {
			  $chatid=$_SESSION["chatid"];
		  }else{
			   $_SESSION["chatid"]=$chatid; 
		  }
		 
		  
	//发送了通知添加到messagetable
	if($_POST["message"]!=NULL)
	{	
		 $sql = "select count(*) FROM Message_Table";
	    $result = mysqli_query($link,$sql);
         $row=mysqli_fetch_assoc($result);
          $messageid=$row["count(*)"]+1;
		$message=$_POST["message"];
	     $currenttime = date("Y-m-d H:i:s");
		 $sql = "insert into Message_Table(Message_ID, Sender_ID, Receiver_ID, Message, MessageTime)  
	                            values ('$messageid','$userid','$chatid','$message',' $currenttime')";
        $result = mysqli_query($link,$sql);
	}
	//聊天的人
	 $sql = "select * from User_Table Where User_ID='$chatid'";
	    $result = mysqli_query($link,$sql);
         $row=mysqli_fetch_assoc($result);
	

	
		  echo'
  <br>
  <div class ="h">
      <div> &emsp;<img src="img/'.$row["image"].'" width = 70 height = 70"></div>&emsp;
	  <div><h3>'.$row["Username"]."(".$row["User_ID"].')</h3></div>
  </div> 
  
    ';
	 
	  $sql = "select * from Message_Table where ( (Sender_ID='$chatid' AND Receiver_ID='$userid')OR(Receiver_ID='$chatid' AND Sender_ID='$userid') )";
     $result = mysqli_query($link,$sql);

	 
	  //输出聊天


	  while($row=mysqli_fetch_assoc($result))
        {  
        
		 if($row["Sender_ID"]==$userid)
			   { 
		    echo '<div class="right"><p>'.$row["Message"].'&emsp;&emsp;</p>
			<h5 style="background-color:grey;color:white">'.$row["MessageTime"].'&emsp;&emsp;</h5></div>';
		   }
        	
		  else
			   { 
		    echo '<div class="left"><p>&emsp;&emsp;'.$row["Message"].'</p>
			<h5 style="background-color:grey;color:white">&emsp;&emsp;'.$row["MessageTime"].'</h5></div>'; 
		   }

	 }

  
  //禁言判断
   $sql = "select * from Blacklist_Table where User_ID='$userid'";
   $result = mysqli_query($link,$sql);
	$blnumber=0;
	   while($row=mysqli_fetch_assoc($result))
        {  $blnumber= 1; }
	
	
	  if ($blnumber==1)
	  {
	 echo'
	 <br>
     <h3 style="color:red"> You have been banned from sending messages!!!</h3>
	   <form action="Chat.php" method="post"><input type="submit" name="back" value="Back" class ="button"> </form>
     <br><br>

 ';
	  }   
  else{
	   echo'
	 <br>
      <form action="Chat.php" method="post">
      <input type="text" name="message"> 
	  <input type="submit" value="send" class ="button"><br><br><hr><br>
     </form>
<form action="Chat.php" method="post"><input type="submit" name="back" value="Back" class ="button"> </form>
     <br>
 ';
	  
  }
  
  
  
	
		  
		  
	  }
	
	
	
	
}
	
	echo' </div>';
   
	}
   
   echo'<br><br><br>
  </div>

 </body>
</html> ';
?>



