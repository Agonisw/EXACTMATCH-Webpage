<?php
 session_start();
 $id1=$_SESSION["User_ID"];
 if(isset($_POST["matchedID"]))
{
	$id2= $_POST["matchedID"];
}
else{ $id2=$_SESSION["matchedid"]; }
 
 $currenttime = date("Y-m-d H:i:s");
 
 
 header("content-type:text/html;charset=utf-8");
$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
if (!$link) {
die("fail to connect " . mysqli_connect_error());
}

mysql_query("set names utf8");  

 $sql="select * from Connection_Table where (UserA_ID='$id2'AND UserB_ID='$id1' AND Status=1)";
 	$result = mysqli_query($link,$sql);
	 $flag1=0;
while($row=mysqli_fetch_assoc($result))
    {  $flag1=1; 
    }

 
 $sql="select *  from Connection_Table where ((UserA_ID='$id2' AND UserB_ID='$id1')or(UserB_ID='$id2' AND UserA_ID='$id1'))";
 	$result = mysqli_query($link,$sql);
	 $flag2=0;
while($row=mysqli_fetch_assoc($result))
{ $flag2=1; }
 
 
 if($id2==$id1){$flag3=1;}
 
if($flag1)
{    
  $sql= "update Connection_Table set Status = 2,ConnectionTime='$currenttime' where (UserA_ID='$id2' AND UserB_ID='$id1' AND Status=1)";
 	 $result = mysqli_query($link,$sql);
	 echo "<script>alert('Operation is successful！You two can have a chat now.');parent.location.href='Homepage.php'</script>"; 
}

else if($flag2)
{ 
    echo "<script>alert('Operation repeat, please return to main page and try again.');parent.location.href='Homepage.php'</script>"; 
}
else if($flag3)
{
	 echo "<script>alert('You can not add yourself as a contact!');parent.location.href='Homepage.php'</script>"; 
}
else
{

	$status=1;
	 $sql = "select count(*) FROM Connection_Table";
	$result = mysqli_query($link,$sql);
 $row=mysqli_fetch_assoc($result);
 $connectionid=$row["count(*)"]+1;

	
	 $sql = "insert into Connection_Table(Connection_ID, UserA_ID, UserB_ID, ConnectionTime,Status)  
	                            values ('$connectionid','$id1','$id2','$currenttime','$status')";
    $result = mysqli_query($link,$sql);
	
	  echo "<script>alert('Operation is successful！Now wait for the user to agree to chat.');parent.location.href='Homepage.php'</script>"; 
}
 
?>