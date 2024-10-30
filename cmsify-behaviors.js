jQuery(document).ready(function ($) {
    $('#tabvanilla > ul').tabs({
        fx: {
            height: 'toggle',
            opacity: 'toggle'
        }
    });
	
	$("a.colorbox").colorbox();
	 
	function InputReps(elemID){
		var Rep = $('#'+elemID+'Repeat').html();
		 $('#'+elemID+'Repeat').remove();
		 $('#'+elemID+'Add').live('click', function(){
			$(this).before(Rep);
			return false; 
		 });
		 $('.'+elemID+'Remove').live('click', function(){
			$(this).parent().remove();
			return false; 
		 }); 
	 }
	
	InputReps('AdminBar');
	InputReps('ImageSize');
	InputReps('FontSize');
	InputReps('AdminAccess');
  

});