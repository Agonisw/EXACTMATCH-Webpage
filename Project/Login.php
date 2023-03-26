<?php
	session_start();
	header("content-type:text/html;charset=utf-8");
	$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
	if (!$link) {
		die("fail to connect to database！ " . mysqli_connect_error());
	}
    $userid = $_POST['userid'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM User_Table WHERE User_ID = '$userid' AND Password = '$password'";
	$result = mysqli_query($link,$sql);

	$num = mysqli_num_rows($result);
	if($num){  
        $_SESSION["User_ID"]= $userid;
        $sql = "SELECT * FROM User_Table WHERE User_ID = '$userid'";
	    $result = mysqli_query($link,$sql);
	    $row = mysqli_num_rows($result);
		if($row){
			while($row= mysqli_fetch_assoc($result)){
				$username=$row['Username'];

			}}
     $_SESSION['username']=$username;
        echo "<script>alert('Login Successfully!');parent.location.href='ShowProfile.php'</script>"; 
        
       
	}else{
		echo"<script>alert('Failed user login, please check whether the password and email address are correct!!!');parent.location.href='Mainpage.html'</script>";
        
	}
	mysqli_close($link);
 ?>
 
	  
