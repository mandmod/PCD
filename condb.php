<?php
	//ติดต่อฐานข้อมูล
	$servername = "localhost";
	$username = "root";
	$pasword = "l[kpfu";
	$dbname = "pcd";

	mysql_connect($servername, $username, $pasword);
	mysql_select_db($dbname) or die(mysql_error());
	//set for thai language
	mysql_query("set names utf8");

?>