$(function(){

	ltApp.checkEmptyBottom = function(){
		if (!ltApp.updating) {
			if (($('.card.tweet').last().position().top - $('#scrollingArea').scrollTop()) < 1500) { // add more posts whenever there's a thousand pixels to bottom
				ltApp.addTweets();
			}
		}
	};

	$('#scrollingArea').on('scroll', function(){
		console.log('test');
		ltApp.checkEmptyBottom();
	});
});