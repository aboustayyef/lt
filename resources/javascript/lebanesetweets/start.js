$(function(){

	$(document).ready(function(){

		// fix View
		ltApp.rearrange();

		// initialize isotope
		ltApp.$container.isotope({
			itemSelector: '.card',
			transitionDuration: 0,
			masonry:{
				columnWidth: 310 // includes gutter
			},

		});
	});
});