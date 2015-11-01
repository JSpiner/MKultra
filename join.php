<?php 
	
	
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// username and password sent from Form
		$id=$_POST['id'];
		$pw=$_POST['pw']; 
		$pw2=$_POST['pw2']; 
		
		if($pw==$pw2){
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
				$_SESSION['login_user']=$id;
	
				header("location: index.php");
			}
			else 
			{
				echo '<div id="dialog">입력한 정보가 올바르지 않습니다.</div>';
			}
		}
		else{
			echo '<div id="dialog">입력한 두 비밀번호가 서로 일치하지 않습니다.</div>';
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
		<script>
	
    
	
				
			$(function() {

				$( "#dialog" ).dialog();
				$(".btn").click(function(){
					location.href="login.php";
				});
				
				
				
			});
			
			
		</script>
		
		
		
	</head>



<body>
<div id="bg"></div>
<div id="login">

	<img src="image/logo.png" width="80%" id="logo"></img>
	<br />
	<form action="" method="post" name="formName" id="slick-login">
	
		<input type="text" name="id" placeholder="maro@shooooong.xyz"/>
		
		<input type="password" name="pw" placeholder="비밀번호"/>
		<input type="password" name="pw2" placeholder="비밀번호 다시 입력"/>
		<input type="submit" class="btn"  value="회원가입" onclick="document.formName.submit()"/>
	
	</form>
</div>
</body>
</html>