<?php

	include 'dbAccess.php';

	header('Content-Type: application/json;charset=euc-kr');
	$json = array();

	if(!isset($_POST['id'])
		|| !isset($_POST['pw'])){

		$json['code'] = 0;
		$json['reason'] = "parameter not exist";
		echo json_encode($json);
		return;
	}

	$id = $_POST['id'];
	$pw = md5($_POST['pw']);

	$query = "insert into account (no, id, pw) values (null, '$id', '$pw')";
	$result = mysqli_query($conn,$query);

	if(!$result){
		$json['code'] = 0;
		$json['reason'] = "id exist";
		echo json_encode($json);
		return;
	}


	$json['code'] = 1;
	echo json_encode($json);



?>