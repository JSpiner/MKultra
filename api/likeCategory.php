<?php

	include 'dbAccess.php';

	header('Content-Type: application/json;charset=euc-kr');

	$json = array();

	if(!isset($_GET['id']) ||
		!isset($_GET['ename'])){
		$json['code'] = 0;
		$json['result'] = "parameter not exist";
		echo json_encode($json);
		die();
	}

	$id = $_GET['id'];
	$ename = $_GET['ename'];

	$pid = loadEname($conn,$ename);
	$likes = split(" ",checkId($conn,$id));
	
	$sw = false;
	for($i=0;$i<count($likes);$i++){
		if($likes[$i]==$ename){
			$likes[$i]="";
			$sw = true;
			break;
		}
	}
	if(!$sw){
		array_push($likes, $ename);
	}

	$str = "";
	for($i=0;$i<count($likes);$i++){
		if($likes[$i]!=""){
			$str.=($likes[$i]." ");
		}
	}

	$query = "update plike set likes = '$str' where id='$id'";
	mysqli_query($conn, $query);

	$json['code'] = 1;
	$json['enable'] = !$sw;
	echo json_encode($json);



	function checkId($conn,$id){
		$query = "select * from plike where id='$id'";
		$result = mysqli_query($conn, $query);

		$num = mysqli_num_rows($result);
		if($num!=1) {
			$query = "insert into plike (no,id,likes) values (null, '$id', '')";
			mysqli_query($conn,$query);
			return "";
		}
		while($r = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			return $r['likes'];
		}
	}

	function loadEname($conn,$ename){

		$query = "select * from pcategory where ename='$ename'";
		$result = mysqli_query($conn,$query);
		while($r = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			return $r['no'];
		}

		$json['code'] = 0;
		$json['reason'] = "no match ename";
		echo json_encode($json);
		die();
	}

?>