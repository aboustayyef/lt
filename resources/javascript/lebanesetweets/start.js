$(function(){

	$(document).ready(function(){

		// fix View
		ltApp.rearrange();
		$('#curtain').hide();

		// initialize isotope
		ltApp.$container.isotope({
			itemSelector: '.card',
			transitionDuration: 0,
			masonry:{
				columnWidth: 310 // includes gutter
			},
			
		});

		// if screen is so wide some space shows at the bottom, add more tweets
		ltApp.checkEmptyBottom();

	});
});