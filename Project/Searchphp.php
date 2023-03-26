<?php

	session_start();
$userid = $_SESSION["User_ID"];
$username = $_SESSION['username'];

header("content-type:text/html;charset=utf-8");
	$conn = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
	if (!$conn) {
		die("fail to connect " . mysqli_connect_error());
	}
	//c1
	$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM User_Table WHERE User_ID = $userid"));
    $image = $user["image"];
	//头像调用<img src="img/'.$image.'" width = 125 height = 125">

echo'
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="menu.css">
  <link rel="stylesheet" href="Search.css">
  <title>Search</title>
</head>

<body>
  <ul> ';
 if($_POST["menu1"]==TRUE)
{
echo'	<form action="Searchphp.php" method="post"><input type="submit" name="menu2" value="↓&emsp;&emsp;&emsp;&emsp;↓&emsp;&emsp;&emsp;&emsp;↓" class="menu"> </form>';
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
<form action="Searchphp.php" method="post"><input type="submit" name="menu1" value="↑&emsp;&emsp;&emsp;&emsp;↑&emsp;&emsp;&emsp;&emsp;↑" class="menu"> </form>';
}
echo'
</ul>
 
 <div class="contents">

 ';
	
	if($_POST['Nationality']!=NULL||$_POST['Gender']!=NULL||$_POST['Hobby']!=NULL||$_POST['Resident_City']!=NULL||$_POST['Profession']!=NULL||$_POST['Height']!=NULL||$_POST['Age']!=NULL||$_POST['Weight']!=NULL){

	$_SESSION['Nationality']=$_POST['Nationality'];
	$_SESSION['Gender']=$_POST['Gender'];
	$_SESSION['Hobby']=$_POST['Hobby'];
	$_SESSION['Resident_City']=$_POST['Resident_City'];
	$_SESSION['Profession']=$_POST['Profession'];
	$_SESSION['Height']=$_POST['Height'];
	$_SESSION['Age']=$_POST['Age'];
	$_SESSION['Weight']=$_POST['Weight'];
	}
	header("content-type:text/html;charset=utf-8");
	$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
	if (!$link) {
		die("fail to connect to database!" . mysqli_connect_error());
	}
	$Nationality=$_SESSION['Nationality'];
	$Gender=$_SESSION['Gender'];
	$Hobby=$_SESSION['Hobby'];
	$Resident_City=$_SESSION['Resident_City'];
	$Profession=$_SESSION['Profession'];
	$Height=$_SESSION['Height'];
	$Age=$_SESSION['Age'];
	$Weight=$_SESSION['Weight'];

	/*$sql="SELECT * FROM Search_Table WHERE Nationality LIKE '%".$Nationality."%' */

	$sql="Select * from User_Table left join Profile_Table using (User_ID) WHERE 
	 (
		User_ID<>'$userid' 
		AND User_ID<>ALL(select UserA_ID from Connection_Table where ((Status=0 or status=2) AND UserB_ID='$userid'))
		AND User_ID<>ALL(select UserB_ID from Connection_Table where UserA_ID='$userid')
		AND 
	( 
	(Nationality = '$Nationality' OR '$Nationality' ='' ) 
	AND (Gender = '$Gender' OR '$Gender' ='')
	AND (Hobby= '$Hobby' OR '$Hobby' ='')
	AND (Resident_City='$Resident_City' OR '$Resident_City' ='')
	AND (Profession='$Profession' OR '$Profession' ='')
	AND (Height='$Height' OR '$Height' ='' )
	AND (Age='$Age' OR '$Age' ='')
	AND (Weight ='$Weight' OR '$Weight' ='') 
	) 
	)
	ORDER BY User_ID ASC";

	$result=mysqli_query($link,$sql);
	if(!$result){
		die('Unable to read data, please contact administrator to fix:'.mysqli_error($link));
	}

	echo '<table>';
 $connectednumber=0;
   while($row=mysqli_fetch_assoc($result))
{ 
 echo 
 '<tr><td> <img src="img/'.$row["image"].'" width = 125 height = 125"></td>
      <td><b>'.$row["Username"]."<br>(".$row["User_ID"] .")</b></td>
	  <td>".$row["Gender"] .",&nbsp;".$row["Age"]." <br>".$row["Weight"]."<br>".$row["Height"]."</td>
	  <td>".$row["Nationality"].",&nbsp;".$row["Resident_City"]." <br>". $row["Profession"]."<br>".$row["Hobby"].
	  " </td></tr>";
   $connectednumber= $connectednumber=+1;;
}
if($connectednumber==0)
{
	echo "No suitable results, please try again later";
}
 echo'</table>';


if($connectednumber!=0){
 echo'<h4 style="background-color:grey;color:white">Here you can simply enter UserID and select YES or NO！</h4>

 <form method="post" action="Yes.php">
 <input type="number" name="matchedID">&emsp;
 <button class="button button1" >YES</button></form><br>
 
	 <form method="post" action="No.php">
 <input type="number" name="matchedID">&emsp;
	 <button class="button button2">NO</button></form><br>';}


	
	
	
	
	echo '

</body>

</html>';
?>

