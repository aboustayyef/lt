$(function(){

		// General function that makes sure that the button 
		// state (active or not) is in sync with the filters pane
	
		ltApp.filterButtonSync = function(){
			if ($('#filters').hasClass('active')){
				$('.filterButton button').addClass('active');
			}else{
				$('.filterButton button').removeClass('active');
			}
		};
	
		// clicking the filter button event

		$('.filterButton button').on('click',function(){
			$('#filters').toggleClass('active');
			ltApp.filterButtonSync();
		});


		// hitting escape removes filter pane;

		$(document).keyup(function(e) {
			if (e.keyCode == 27) {
				$('#filters').removeClass('active');
				ltApp.filterButtonSync();
			}
		});


});