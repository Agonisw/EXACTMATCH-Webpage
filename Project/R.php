<?php
 session_start();
 header("content-type:text/html;charset=utf-8");
$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
if (!$link) {
die("fail to connect " . mysqli_connect_error());
}
mysql_query("set names utf8");
 $sql="SELECT MAX(User_ID) from User_Table";
 
 $result = mysqli_query($link,$sql);
 $row=mysqli_fetch_assoc($result);
 $userid=$row["MAX(User_ID)"]+1;
 
 	$sql="select * from Blacklist_Table where (User_ID='$userid')";
 	$result = mysqli_query($link,$sql);
    $flag=0;
    while($row=mysqli_fetch_assoc($result))
    {  $flag=1; 
    }
	
	while($flag==1)
	{
		$userid=$userid+1;
		$sql="select * from Blacklist_Table where (User_ID='$userid')";
 	$result = mysqli_query($link,$sql);
	 $flag=0;
     while($row=mysqli_fetch_assoc($result))
    {  $flag=1; 
    }
		
		
	}
		
  $_SESSION["User_ID"]=$userid;

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Regisration</title> 
  <link rel="stylesheet" type="text/css" href="register.css">
  <link rel="shortcut icon" href="Welcomeig.png" type="image/x-icon">
 </head>
 <body background="lm.jpg">
 <div id="loginDiv">
        <form action="Register.php" method="post">
            <h1 style="text-align: center;color: aliceblue;">REGISTER</h1>
			<p>UserID:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $userid;  ?></p>
			<p>Username:&emsp;&emsp;&emsp;&emsp;<input name="username" type="text"><label id="username"></label></p>
            <p>E-mail:&emsp;&emsp;&emsp;&emsp;&emsp;<input name="email" type="text"><label id="email"></label></p>

            <p>Password:&emsp;&emsp;&emsp;&emsp;<input name="password" type="password"><label id="password"></label></p>

            <div style="text-align: center;margin-top: 30px;">
                <input type="submit" class="button" value="Create my account">
                
            </div>
</div>
        

	
 </body>
</html> 
