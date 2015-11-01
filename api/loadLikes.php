<?php
	
	include 'dbAccess.php';

	header('Content-Type: application/json;charset=euc-kr');

	$json = array();

	if(!isset($_GET['id'])){
		$json['code'] = 0;
		$json['result'] = "parameter not exist";
		echo json_encode($json);
		die();
	}

	$id = $_GET['id'];

	$query = "select * from plike where id='$id'";
	$result = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		$json['code']=1;
		$json['likes'] = split(" ",$row['likes']);
		echo json_encode($json);
		return;
	}

	$json['code'] = 0;
	$json['reason'] = "no match id";
	echo json_encode($json);
	return;


?>