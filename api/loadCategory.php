<?php
	
	include 'dbAccess.php';


	header('Content-Type: application/json;charset=euc-kr');

	$json = array();
	$query = "select * from pcategory";

	$result = mysqli_query($conn,$query);

	if(!$result){
		$json['code']=0;
		echo json_encode($json);
		//return;
	}


	$json['code']=1;
	$json['category'] = array();
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$arr = array();
		$arr['ename'] = $row['ename'];
		$arr['kname'] = $row['kname'];
		$arr['cid'] = $row['no'];
		array_push($json['category'], $arr);

	}
	echo json_encode($json);

?>