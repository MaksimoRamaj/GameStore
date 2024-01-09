<?php 
 require("constants.php");
	//Connect to MySQL:
 $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// $connection = mysqli_connect("finklesnout.design.mysql", "finklesnout_design_gamewebshop", "1234567", "finklesnout_design_gamewebshop");	
// if no connection could be established show the error msg, and close the connection:
	if (mysqli_connect_errno())
		{
		die ("Failed to connect to MySQL: " . mysqli_connect_error());
		}
