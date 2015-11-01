<?php

	$id = 'root';
	$pw = '';

	$conn = mysqli_connect('localhost',$id,$pw,'mkultra') or die("error");

	mysqli_query($conn,"set session character_set_connection=utf8;");
	mysqli_query($conn,"set session character_set_results=utf8;");
	mysqli_query($conn,"set session character_set_client=utf8;");
//	$conn = mysql_connect("localhost",$id,$pw) or die("error connect");

//	mysql_select_db("mkultra",$conn) or die("error select");

?>