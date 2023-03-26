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
echo'	<form action="Search.php" method="post"><input type="submit" name="menu2" value="↓&emsp;&emsp;&emsp;&emsp;↓&emsp;&emsp;&emsp;&emsp;↓" class="menu"> </form>';
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
<form action="Search.php" method="post"><input type="submit" name="menu1" value="↑&emsp;&emsp;&emsp;&emsp;↑&emsp;&emsp;&emsp;&emsp;↑" class="menu"> </form>';
}
echo'
</ul>
 
 <div class="contents">

 ';


  echo'
  <p class="top">
      Using UserID or UserName to search
    </p>
    <br>
    <form action="Searchphp3.php" method="post">

<div id="left1" >
<br>
      UserID:
      <input type="text" name="id" placeholder="type here">
</div>

<div id="right1">
<br>
      UserName:
      <input type="text" name="name" placeholder="type here">
</div>
<br>
<input type="submit" value="submit" name="submit">
    </form>
    <br><br>



    <p class="top">
      Search for your favorite
    </p>
    <br>
    <form action="Searchphp.php" method="post">

<div id="left" >
<br>
      Nationality:
      <input type="text" name="Nationality" placeholder="type here">
      <br><br><br><br>
      Resident_City:
      <input type="text" name="Resident_City" placeholder="type here">
      <br><br><br><br>
      Profession:
      <input type="text" name="Profession" placeholder="type here">
      <br><br><br><br>
     
</div>

<div id="right">
      Gender:
      <select name="Gender">
      <option value="" selected disabled hidden>Choose here</option>
      <option value="">Choose here</option>
        <option value="male">male</option>
        <option value="female">female</option>
      </select>
      <br><br>
      Height:
      <select name="Height">
      <option value="" selected disabled hidden>Choose here</option>
         <option value="">Choose here</option>
      <option value="less than 160cm">less than 160cm</option>
        <option value="160-170cm">160-170cm</option>
        <option value="170-180cm">170-180cm</option>
        <option value="180-190cm">180-190cm</option>
        <option value="190-200cm">190-200cm</option>
        <option value="more than 200cm">more than 200cm</option>
      </select>
      <br><br>
      Weight:
      <select name="Weight">
      <option value="" selected disabled hidden>Choose here</option>
         <option value="">Choose here</option>
      <option value="less than 50kg">less than 50kg</option>
        <option value="50-80kg">50-80kg</option>
        <option value="80-100kg">80-100kg</option>
        <option value="more than 100kg">more than 100kg</option>
      </select>
      <br><br>
      Hobby:
      <select name="Hobby">
      <option value="" selected disabled hidden>Choose here</option>
         <option value="">Choose here</option>
      <option value="Running">Running</option>
        <option value="Swimming">Swimming</option>
        <option value="Singing">Singing</option>
        <option value="Piano">Piano</option>
        <option value="Basketball">Basketball</option>
        <option value="Yoga">Yoga</option>
        <option value="Boxing">Boxing</option>
        <option value="Surfing">Surfing</option>
        <option value="Skating">Skating</option>
        <option value="Cooking">Cooking</option>
        <option value="Reading">Reading</option>
        <option value="Violin">Violin</option>
        <option value="Hurling">Hurling</option>
        <option value="Traveling">Traveling</option>
        <option value="Volleyball">Volleyball</option>
        <option value="Extreme sports">Extreme sports</option>
      </select>
      <br><br>
      Age:
      <select name="Age">
      <option value="" selected disabled hidden>Choose here</option>
         <option value="">Choose here</option>
      <option value="less than 20">less than 20</option>
        <option value="20-30">20-30</option>
        <option value="30-40">30-40</option>
        <option value="more than 40">more than 40</option>
      </select>
      <br>
</div>
<br>
<input type="submit" value="submit" name="submit">
    </form>
    <br><br>';
	
	
	echo '

</body>

</html>';
?>