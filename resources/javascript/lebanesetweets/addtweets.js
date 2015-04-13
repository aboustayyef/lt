$(function(){
	ltApp.addTweets = function(){
		
		// get which group is being fetched
		ltApp.updating = true;
		var object = ltApp.getGroup();
		var group = object.group;
		var search = object.search;
		console.log("http://lebanesetweets.net/ajax/"+group+"/" + (ltApp.tweetsLoaded + 1) + "/" + (ltApp.tweetsLoaded + 20));

		$.get( "http://lebanesetweets.net/ajax/"+group+"/" + (ltApp.tweetsLoaded + 1) + "/" + (ltApp.tweetsLoaded + 20) + search , function( data ) {
			$data = $(data);
			ltApp.$container.append($data).isotope('appended', $data);
			ltApp.tweetsLoaded += 20;
			ltApp.updating = false;
		});
	};
});