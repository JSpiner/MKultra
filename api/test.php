<html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="login.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script>

jQuery(document).ready(function() {
	$.get("http://www.naver.com",{}
		function(data){
		//data가 결과값
		alert(data);
	});
});
</script>
</head>
<body>


</body>


</html>