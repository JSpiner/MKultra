<?php 
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// username and password sent from Form
		$id=$_POST['id'];
		$pw=$_POST['pw']; 
		$data = array('id' => $id, 'pw' => $pw);
		$url = 'http://maro.iptime.org:8012/mkultra/api/login.php';
		
		/*
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($ch);
		echo "response : ".$response;

		// use key 'http' even if you send the request to https://...
		*/
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data),
			),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$result = json_decode($result);
		

//		$result = json_decode($result);
		//var_dump($result);
		
		// If result matched $myusername and $mypassword, table row must be 1 row
		if($result->{'code'}=='1')
		{
			//session_register("myusername");
			$_SESSION['id']=$id;

			header("location: index.php");
		}
		else 
		{
			echo '<div id="dialog">입력한 정보가 올바르지 않습니다.</div>';
		}
	}
?>
<html>
	<head>
		<title>MK Magazine</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    	<link rel="stylesheet" type="text/css" href="login.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
		<script src="request/request.js"></script>
		<!--<script type="text/javascript" src="/path/to/the/file/jquery.xdomainajax.js"></script>-->
		<script>
	
			function loaded(){
				alert("sibal");


				var request = require('request');
				request('http://www.google.com', function (error, response, body) {
				  if (!error && response.statusCode == 200) {
				    console.log(body) // Show the HTML for the Google homepage.
				    alert(body);
				  }
				});


			}

			$(function() {

				
				$(".btn").click(function(){
					//alert(document.getElementById('userInfo').contentWindow.document.body.innerHTML);
					document.location.href="https://member.mk.co.kr/mem/v1/login.php?successUrl=http://maro.iptime.org:8012/mkultra?pass=1";
				});
				
				
				
			});
			
			jQuery(document).ready(function() {


				$( "#dialog" ).show( 'slide',{direction:'up'} );

			});


		</script>
		
		
		
	</head>


<iframe src="https://member.mk.co.kr/mem/updateUser.php" id="userInfo" onload="loaded()" sandbox></iframe>
<body>
<div id="bg"></div>
<div id="login">

	<img src="image/logo.png" width="80%" id="logo"></img>
	<br />
	<form action="" method="post" name="formName" id="slick-login">
		<input type="button" class="btn" value="매일경제 통합아이디로 로그인"/>
	</form>
</div>
<div class="about" style="background-image:url('image/about1.jpg')">
	<div class="aboutcontent">
		<p class="subject">맨날 인터넷 기사에 뜨는 광고에 질리셨나요?</p>
		<p class="content">나에게 딱 맞는 정보만 보여드립니다.</p>
	</div>
</div>
<div class="about" style="background-image:url('image/about2.jpg')">
	<div class="aboutcontent">
		<p class="subject">나만의 매거진을 만들어보고 싶으세요?</p>
		<p class="content">원하는 분야의 내용만 쏙쏙 골라 보여드립니다.</p>
	</div>
</div>
<div class="about">
	<div class="aboutcontent">
		<p class="subject">흥미로우신가요?</p>
		<p class="content">지금 무료로 이용하실 수 있습니다!</p>
		<input type="button" class="btn" value="매일경제 통합아이디로 로그인"/>
		
	</div>
</div>
</body>
</html>