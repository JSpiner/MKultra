<?php 
	session_start();
?>

<html>
	<head>
		<title>
			MK Magazine
		</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="main.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
		
		<script>
			jQuery(document).ready(function() {
				
				$.get(
					"api/loadCategory.php",
					{},
					function(data) {
						for(var i in data.category){
							$("#wrap").append("<div id='"+data.category[i].ename+"' class='category'>"+data.category[i].kname+"</div>").trigger("create");
							$("#wrap div").last().css("background-image","url('viewimage_s.php?image="+data.category[i].ename+".jpg')");
						}
								//$("#wrap").find("div").css("background-color", "black");
						
							$("#wrap").find("div").css("height", $("#wrap div").first().width());
							$("#wrap").find("div").css("line-height", $("#wrap div").first().width() + "px");
							
							$("#wrap div").wrapInner("<span style='border:5px solid lightgray;padding:20px;color:lightgray'></span>");
							
							
							$(".category").click(function(){
								
								var temp = $(this);
								
								//api/likeCategory.php
								
								$.get("api/likeCategory.php",
								{id: '<?php echo $_SESSION['id'] ?>', ename: $(this).attr('id')},
								function(data2){
									
									
									
									if(data2.enable==true){
										
										temp.html("<div class='clicked'>"+temp.html()+"</div>");
										temp.find(".clicked").show();									
										temp.find(".clicked").attr('style','border:none;width:100%;height:100%;background-color:gray;background-image:none;padding:0px;margin:0px;opacity: 0.7;-moz-opacity: 0.7;-khtml-opacity: 0.7;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";filter: alpha(opacity=70);');
										//$(this).toggle('puff');
										temp.find("span").css("background-color","lightgray");
										temp.find("span").css("color","black");
									}
									else{
										temp.find("span").attr('style',"border:5px solid lightgray;padding:20px;color:lightgray");
										temp.find("span").unwrap();
										temp.find(".clicked").hide();
									}
								});
							});
					});
						
				$.get("api/loadLikes.php",{id: "<?php echo $_SESSION['id'] ?>"},
				function(data){
					
					for(var i in data.likes)
					{
						var temp = $("#"+data.likes[i]);
						temp.html("<div class='clicked'>"+temp.html()+"</div>");
						temp.find(".clicked").show();									
						temp.find(".clicked").attr('style','border:none;width:100%;height:100%;background-color:gray;background-image:none;padding:0px;margin:0px;opacity: 0.7;-moz-opacity: 0.7;-khtml-opacity: 0.7;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";filter: alpha(opacity=70);');
						//$(this).toggle('puff');
						temp.find("span").css("background-color","lightgray");
						temp.find("span").css("color","black");
					}
				});		
						
						
						
						
				
			});
			
			$(window).resize(function(){
				
				$("#wrap").find("div").css("height", $("#wrap div").first().width());
				$("#wrap").find("div").css("line-height", $("#wrap div").first().width() + "px");
			});	
		</script>

	</head>
	<body>
	
		<?php
			include 'header.php';
		?>
		
		<div class="subject">
			관심있는 분야를 선택해주세요.
		</div>
		
		<div class="content">
			매일경제 추천
		</div>

		<div id="wrap">
			
		</div>
		
		<div class="content">
			에디터 추천
		</div>
		
		<div class="content">
			나만의 콘텐츠 추가
		</div>
		
		
		
		
		
		<div class="subject">
			<input type="button" class="btn" value="다음 화면으로" >
		</div>
		<?php
			include 'tail.php';
		?>
	</body>


</html>