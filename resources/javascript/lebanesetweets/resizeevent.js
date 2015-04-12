$(function(){
	$(window).on('resize', function(){
		ltApp.rearrange();
		
		// if screen is so wide some space shows at the bottom, add more tweets
		ltApp.checkEmptyBottom();
	});
});