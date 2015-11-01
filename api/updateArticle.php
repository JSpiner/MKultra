<?php

	include 'dbAccess.php';

	ini_set('max_execution_time', 300); 

	$query = "select * from pcategory";
	$result = mysqli_query($conn, $query);

	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

			$pno = $row['no'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$row['rsslink']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$xml = curl_exec($ch);

		$object = simplexml_load_string($xml);
		$items = $object->channel;

		foreach ($items->item as $item) {
			$desc = strip_tags($item->description);
			$query = "insert into particle (no,pcategory,title,link,description,pubdate,guid) values (NULL, '$pno','$item->title', '$item->link', '$desc','$item->pubDate','$item->guid')";

			mysqli_query($conn,$query);
		}

	}

?>