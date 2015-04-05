$(function(){
	ltApp.rearrange = function(){
		// change width of container to make everything centered
		var gutter = 10;
		var widthOfModule = 310; // includes gutters, makes it easier to calculate
		var windowWidth = window.innerWidth; // width of window
		var emptyArea = windowWidth % widthOfModule; // area not occupied by modules
		var usableWidth = windowWidth - emptyArea ; //gutter on the left of each item, so we have to remove 10 at the last module
		$('.cards').css('width', usableWidth);
	};
});