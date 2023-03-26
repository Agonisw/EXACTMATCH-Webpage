<?php

session_start();
$userid = $_SESSION["User_ID"];
$username = $_SESSION['username'];?>

<?php
  session_start();
  

	header("content-type:text/html;charset=utf-8");
	$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
	if (!$link) {
		die("fail to connect " . mysqli_connect_error());
	}
	$weight=$_POST['weight'];
	$height=$_POST['height'];
	$gender=$_POST['gender'];
    $hobby=$_POST['hobby'];
	
    $birthday=$_POST['birthday'];
    $lastname=$_POST["lastname"];
    $firstname=$_POST["firstname"];
	
    $seeking=$_POST["seeking"];
    $bio=$_POST['bio'];
	$submit=$_POST['submit'];
	
	   $region=$_POST["country"];
   	$city=$_POST["city"];
	$profession=$_POST["profession"];
   if($submit){
	   if($weight!=NULL)
	   {
		    $sql= "UPDATE Profile_Table SET Weight='$weight' WHERE User_ID =$userid";
	   $result=mysqli_query($link,$sql);
	   }
	     if($height!=NULL)
	   {
		    $sql= "UPDATE Profile_Table SET Height='$height' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }
	   if( $gender!=NULL)
	   {
		   $sql= "UPDATE Profile_Table SET gender = '$gender' WHERE User_ID =$userid";
	         $result=mysqli_query($link,$sql);
	   }
	     if( $hobby!=NULL)
	   {
		  $sql= "UPDATE Profile_Table SET Hobby='$hobby' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }
	      if( $firstname!=NULL)
	   {
		 $sql= "UPDATE Profile_Table SET FirstName='$firstname' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }
	      if( $lastname!=NULL)
	   {
		  $sql= "UPDATE Profile_Table SET  LastName='$lastname' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }
		 if( $birthday!=NULL)
	   {
	   $sql= "UPDATE Profile_Table SET Birthday='$birthday' WHERE User_ID =$userid";
      $result=mysqli_query($link,$sql);
	  
	  if( $birthday>"2002-04-27"){	  $age="less than 20";  }
	  else if( $birthday<"1982-04-27")  {  $age="more than 40";  }
	  else if( $birthday>="1992-04-27"){  $age="20-30";  }     
      else{
		   $age="30-40";
	  }
	   $sql= "UPDATE Profile_Table SET Age='$age' WHERE User_ID =$userid";
      $result=mysqli_query($link,$sql);
	  
	  
	   }   
	   if( $seeking!=NULL)
	   {
		  $sql= "UPDATE Profile_Table SET seeking='$seeking' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }  
	   if( $bio!=NULL)
	   {
		 $sql= "UPDATE Profile_Table SET Bio='$bio' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }
	      if( $region!=NULL)
	   {
		$sql= "UPDATE Profile_Table SET Nationality='$region' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }
     if( $city!=NULL)
	   {
		$sql= "UPDATE Profile_Table SET Resident_City='$city' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }
 if( $profession!=NULL)
	   {
		$sql= "UPDATE Profile_Table SET Profession='$profession' WHERE User_ID =$userid";
          $result=mysqli_query($link,$sql);
	   }
   }
    
  







  echo"Welcome to your profile <b>".$_SESSION['username']."</b>!";
  $username=$_SESSION['username'];
  $con=mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
        if(mysqli_connect_errno()){
	    echo"Failed to connect";
	    exit();
        }
  $sql = "SELECT * FROM User_Table left join Profile_Table using(User_ID) WHERE Username = '$username' ";
	    $result = mysqli_query($con,$sql);
	    $row = mysqli_num_rows($result);
		if($row){
			while($row= mysqli_fetch_assoc($result)){
               
				$country=$row['Nationality'];
		        $age=$row['Birthday'];
			    $hobby=$row['Hobby'];
			    $weight=$row['Weight'];
				$gender=$row['Gender'];
				$fullname=$row['FirstName'];
                $lastname=$row['LastName'];
                $height=$row['Height'];
                $userid=$row['User_ID'];
                $seeking=$row['seeking'];
                $bio=$row['Bio'];
				$city=$row['Resident_City'];
				$pro=$row['Profession'];
			}
			
            $_SESSION["User_ID"]=$userid;
		}else{
			
		}

		
		

	//c1
	$user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM User_Table WHERE User_ID = $userid"));
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
echo'	<form action="ShowProfile.php" method="post"><input type="submit" name="menu2" value="↓&emsp;&emsp;&emsp;&emsp;↓&emsp;&emsp;&emsp;&emsp;↓" class="menu"> </form>';
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
<form action="ShowProfile.php" method="post"><input type="submit" name="menu1" value="↑&emsp;&emsp;&emsp;&emsp;↑&emsp;&emsp;&emsp;&emsp;↑" class="menu"> </form>';
}
echo'
</ul>
 
 <div class="contents">
 '; 
		
		echo'
		 <br>
<img src="img/'.$image.'" width = 125 height = 125">
		
		';
		
		
		
?>


 <h2><?php print $fullname;print " ";print $lastname ?></h2>

 <div style='text-align:center;'class="contents1">
<h5>Gender:&emsp;<?php print $gender;?></h5>
 <h5>Birthday: &emsp;<?php print $age;?></h5>
<h5>Nationality: &emsp;<?php print $country;?></h5> 
<h5>Resident City: &emsp;<?php print $city;?></h5>
<h5>Profession: &emsp;<?php print $pro;?></h5>
 <h5>Hobby:&emsp;<?php print $hobby;?></h5>
 <h5>Weight:&emsp;<?php print $weight;?></h5>
 <h5>Height:&emsp;<?php print $height;?></h5>
 <h5>Seeking:&emsp;<?php print $seeking;?></h5>
 <h5>Bio:&emsp;<?php print $bio;?></h5>
</div>
<a href="Profile.php"><button>Modify</button></a><br><br>
</div>
 
