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
/*
	$post_data = array(
		"c" => "login_action",
		"successUrl" => "http://mk.co.kr/",
		"id" => $id,
		"pw" => $pw
	);


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://member.mk.co.kr/mem/v1/action.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_data);

	$result = curl_exec($ch);

	echo $result;
*/

	$query = "select * from account where id='$id' and pw='$pw'";
	$result = mysqli_query($conn,$query);
	$c = mysqli_num_rows($result);

	if($c!=1){
		$json['code'] = 0;
		$json['reason'] = "no match id";
		echo json_encode($json);
		return;
	}

	$json['code'] = 1;
	echo json_encode($json);



?>