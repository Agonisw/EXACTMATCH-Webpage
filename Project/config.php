<?php
	$conn=mysqli_connect("sql113.epizy.com","epiz_31266886","Ic4JztybZ73wMlV");
	if(!$conn){
		echo "fail to connect to database！";
	}else{
		echo "Successfully connected to the database！";
		mysqli_query($conn,"use pichai");}

?>