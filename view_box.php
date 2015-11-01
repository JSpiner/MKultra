<?php 

	header('charset=euc-kr');
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://maro.iptime.org:8012/mkultra/api/loadArticleDetail.php?pid=123');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$res = curl_exec($ch);
	$res = json_decode($res);
	echo urldecode($res->{'text'});
?>

<div class='viewbox'>
	
</div>










