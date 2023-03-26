<?php
    session_start();
    $userid= $_SESSION["User_ID"];
	
	
	header("content-type:text/html;charset=utf-8");
	$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
	if (!$link) {
		die("fail to connect " . mysqli_connect_error());
	}
	$username=$_POST['username'];
	$password=$_POST['password'];
    $email=$_POST['email'];
    

	 $sql="select * from Blacklist_Table where (Email='$email')";
 	$result = mysqli_query($link,$sql);
	 $flag=0;
while($row=mysqli_fetch_assoc($result))
    {  $flag=1; 
    }


	$sql_select = "SELECT * FROM User_Table WHERE Username = '$username'";
	$select = mysqli_query($link,$sql_select);
	$num = mysqli_num_rows($select);

    
       if($email=="" || $username == "" || $password == "")
	{
		echo "<script>alert('Please confirm the completeness of the information');parent.location.href='R.php'</script>";   
        
	}
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo"<script>alert('$email is not a valid email address');parent.location.href='R.php'</script>";
    }
        
    else if ($flag==1)
    {
        echo "<script>alert('Your information has been blacklisted and cannot be registered again.');parent.location.href='R.php'</script>";
    }
    else if($num){
		echo "<script>alert('Username has already taken');parent.location.href='R.php'</script>";
	}
    else{
		$img="nophoto";
			$sql="insert into User_Table(Username,Password,Email,User_ID,image) values('$username','$password','$email','$userid','$img')";
			$result=mysqli_query($link,$sql);
			if(!$result)
			{
				echo "Incorrect Registartion！"."<br>";
				echo "<a href='Register.html'>Return</a>";
			}
			else
			{
				echo "<script>alert('Registed successfully!');parent.location.href='Mainpage.html'</script>";
				
                $sql="insert into Profile_Table(User_ID) values('$userid')";
                $result=mysqli_query($link,$sql);
                
			}
		}
    
    
    
	
	
?>