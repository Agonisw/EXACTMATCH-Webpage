<?php
 
 
 $selectedID= $_POST["selectedID"];
 
 
 header("content-type:text/html;charset=utf-8");
$link = mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV","epiz_31266886_OnlinDating");
if (!$link) {
die("fail to connect " . mysqli_connect_error());
}

mysql_query("set names utf8");  
   $sql = "delete from Blacklist_Table where User_ID='$selectedID'";
	$result = mysqli_query($link,$sql);
  echo "<script>alert('Remove Successfully!');parent.location.href='Blacklist.php'</script>"; 
 

	
?>

