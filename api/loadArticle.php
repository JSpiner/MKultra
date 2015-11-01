<?php

	include 'dbAccess.php';

	header('Content-Type: application/json;charset=euc-kr');

	$json = array();

	
	if(!isset($_GET['ename'])){
		$json['code'] = 0;
		$json['reason'] = "ename not exist";
		echo json_encode($json);
		die();
	}
	$ename = $_GET['ename'];

	$query = "select * from pcategory where ename='$ename'";
	$result = mysqli_query($conn,$query);
	while($r = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$no = $r['no'];
		$query = "select * from particle where pcategory='$no'";
		$result = mysqli_query($conn,$query);

		$json['code'] = 1;
		$json['items'] = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$arr = array();
			$arr['pid'] = $row['no'];
			$arr['title'] = $row['title'];
			$arr['link'] = $row['link'];
			$arr['description'] = $row['description'];
			$arr['pubdate'] = $row['pubdate'];
			$arr['guid'] = $row['guid'];
			array_push($json['items'], $arr);
		}
		echo json_encode($json);
		return;
	}

	$json['code'] = 0;
	$json['reason'] = "no match ename";
	echo json_encode($json);

?>