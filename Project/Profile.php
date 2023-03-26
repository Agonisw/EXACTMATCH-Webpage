<?php

session_start();
$userid= $_SESSION["User_ID"];
 $username=$_SESSION['username'];
 
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
    <meta charset="utf-8">
   <title>Profile</title>
   <link rel="stylesheet" type="text/css" href="menu.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
 <body>
 <ul> ';
 if($_POST["menu1"]==TRUE)
{
echo'	<form action="Profile.php" method="post"><input type="submit" name="menu2" value="↓&emsp;&emsp;&emsp;&emsp;↓&emsp;&emsp;&emsp;&emsp;↓" class="menu"> </form>';
}
else {
 echo'
<br>
 <div class ="head">
  <li class="dropdown">
  <a href="javascript:void(0)" class="dropbtn"  > <img src="img/'.$image.'" width = 125 height = 125"></a>
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
<form action="Profile.php" method="post"><input type="submit" name="menu1" value="↑&emsp;&emsp;&emsp;&emsp;↑&emsp;&emsp;&emsp;&emsp;↑" class="menu"> </form>';
}
echo'
</ul>
 
 <div class="contents">
 <h1>Improve your personal information </h1>
 '; 
 
 //头像

	
    ?>
 


  <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <div class="upload">
        <?php
        $id = $user["User_ID"];
        $name = $user["Username"];
        $image = $user["image"];
        ?>
        <img src="img/<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
        <div class="round">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
          <i class = "fa fa-camera" style = "color: #fff;"></i>
        </div>
      </div>
    </form>
    <script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
    </script>
    <?php
    if(isset($_FILES["image"]["name"])){
      $id = $_POST["id"];
      $name = $_POST["name"];

      $imageName = $_FILES["image"]["name"];
      $imageSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];

      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtension)){
        echo
        "
        <script>
          alert('Invalid Image Extension');
          document.location.href = 'Profile.php';
        </script>
        ";
      }
      else if ($imageSize > 1200000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
          document.location.href = 'Profile.php';
        </script>
        ";
      }
      else{
        $newImageName = $userid; // Generate new image name
        $query = "UPDATE User_Table SET image = '$newImageName' WHERE User_ID = '$userid'";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName, 'img/' . $newImageName);
        echo
        "
        <script>
        document.location.href = 'Profile.php';
        </script>
        ";
      }
    }
 
 ?>
 
 
 
 <?php
 
echo'

<form method="post" action="ShowProfile.php">

<br><br>

<label>Firstname&emsp; <input type="text" name="firstname"></label>
<BR><BR>
<label>&emsp;Lastname&emsp;<input type="text" name="lastname"></label>
<BR><BR>
<label>&emsp;Birthday&emsp;<input type="date" name="birthday"></label>
<BR><BR>
<label>Gender&emsp;&emsp;<select name="gender">
      <option value=""></option>
        <option value="male">male</option>
        <option value="female">female</option>
      </select></label>
<BR><BR>
<label>&emsp;Hobby&emsp;&emsp;<select name="hobby">
<option value=""></option>
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
</select></label>
<BR><BR>
<label>Weight&emsp;&emsp;<select name="weight">
<option value=""></option>
        <option value="less than 50kg">less than 50kg</option>
        <option value="50-80kg">50-80kg</option>
        <option value="80-100kg">80-100kg</option>
        <option value="more than 100kg">more than 100kg</option>
      </select></label>
<BR><BR>
<label>Height&emsp;&emsp;<select name="height">
        <option value=""></option>
        <option value="less than 160cm">less than 160cm</option>
        <option value="160-170cm">160-170cm</option>
        <option value="170-180cm">170-180cm</option>
        <option value="180-190cm">180-190cm</option>
        <option value="190-200cm">190-200cm</option>
        <option value="more than 200cm">more than 200cm</option>
      </select></label>
<BR><BR>
<label>&emsp;Nationality&emsp;&emsp;<input type="text" name="country"></label>
<BR><BR>
<label>&emsp;Resident City&emsp;&emsp;<input type="text" name="city"></label>
<BR><BR>
<label>&emsp;Profession&emsp;&emsp;<input type="text" name="profession"></label>
<BR><BR>
<label>&emsp;Seeking&emsp;&emsp;<input type="text" name="seeking"></label>
<BR><BR>
More info&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<br><br>
<textarea name="bio" rows="5" cols="40"></textarea><br><br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" value="submit" name="submit">

</form>
 
 <br><br>
 
</div>
 

 </body>
</html> ';