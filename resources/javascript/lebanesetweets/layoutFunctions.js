$(function(){

	// change width of container to make everything centered

	ltApp.centerCards = function(){
		var gutter = 10;
		var widthOfModule = 310; // includes gutters, makes it easier to calculate
		var windowWidth = window.innerWidth -60 ; // width of window
		var emptyArea = windowWidth % widthOfModule; // area not occupied by modules
		var usableWidth = windowWidth - emptyArea ; //gutter on the left of each item, so we have to remove 10 at the last module
		$('.cards').css('width', usableWidth);
	};

	// change height of scrollable area to fill screen

	ltApp.fixHeight = function(){
		$('#scrollingArea').height(window.innerHeight - 90);
	};


	// make the width of filters the same as that of cards
	ltApp.alignFilters = function(){
		$('#filters').css('width', $('.cards').css('width'));
	}

	// function that does all the above

	ltApp.rearrange = function(){
		ltApp.centerCards();
		ltApp.fixHeight();
		ltApp.alignFilters();
	};

});