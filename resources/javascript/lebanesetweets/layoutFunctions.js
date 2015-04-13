$(function(){

	// change width of container to make everything centered

	ltApp.centerAll = function(){
		var gutter = 10;
		var widthOfModule = 310; // includes gutters, makes it easier to calculate
		var windowWidth = window.innerWidth ; // width of window
		var emptyArea = windowWidth % widthOfModule; // area not occupied by modules
		var usableWidth = windowWidth - emptyArea ; //gutter on the left of each item, so we have to remove 10 at the last module
		$('.inner').css('width', usableWidth);
	};

	// change height of scrollable area to fill screen

	ltApp.fixHeight = function(){
		$('#filters').height(window.innerHeight - 90);
	};

	// function that does all the above

	ltApp.rearrange = function(){
		ltApp.centerAll();
		ltApp.fixHeight();
	};

});