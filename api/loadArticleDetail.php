<?php

	include 'dbAccess.php';


	header('Content-Type: application/json;charset=euc-kr');

	$json = array();

	if(!isset($_GET['pid'])){
		$json['code'] = 0;
		$json['reason'] = "pid not exist";
		echo json_encode($json);
		return;
	}

	$pid = $_GET['pid'];

	$query = "select * from particle where no='$pid'";
	$result = mysqli_query($conn, $query);

	if(!$result){
		$json['code'] = 0;
		$json['reason'] = "data not found";
		echo json_encode($json);
		return;
	}


	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$row['link']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$html = curl_exec($ch);

		$stindex = strpos($html,"<!-- content -->");
		$edindex = strpos($html,"window.jQuery");

		$content = substr($html, $stindex,$edindex-$stindex);
//		echo $content."||||||||";
		$content = trim(($content));
//		echo $content;

		$json['code'] = 1;
		$json['text'] = urlencode($content);
		echo json_encode($json);
//		print_r($json);
		return;
	}



?>