$(function(){

	ltApp.checkEmptyBottom = function(){
		if (!ltApp.updating) {
			if (($('.card.tweet').last().position().top - $(document).scrollTop()) < 1500) { // add more posts whenever there's a thousand pixels to bottom
				ltApp.addTweets();
			}
		}
	};

	$(window).on('scroll', function(){
		ltApp.checkEmptyBottom();
	});
});