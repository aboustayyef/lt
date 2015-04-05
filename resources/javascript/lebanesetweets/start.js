$(function(){

	$(document).ready(function(){

		// Center View
		ltApp.rearrange();

		// ISOTOPE INITIALIZE
		ltApp.$container.isotope({
			itemSelector: '.card',
			transitionDuration: 0,
			masonry:{
				columnWidth: 310 // includes gutter
			},

		});
	});
});