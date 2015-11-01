<script>
	//$( document ).click(function() {
	
	//});
	
	$( window ).scroll(function() {
		if($(document).scrollTop()<=50){
			$( "#header" ).show( 'slide',{direction:'up'} );
				
		}
		else{
			$( "#header" ).hide( 'slide',{direction:'up'} );
		
		}
	});
	
</script>



<div id="header" style="width:100%; height:50px; background-color:skyblue;line-height:50px;position:fixed;z-index:999;">
	MK Magazine
</div>


<div style="width:100%;height:50px;background-color:transparent;">
	
</div>