$(function(){
	ltApp.addTweets = function(){
		
		// get which group is being fetched
		var object = ltApp.getGroup();
		var group = object.group;
		var search = object.search;
		console.log("http://localhost:8000/ajax/"+group+"/" + ltApp.tweetsLoaded + "/" + (ltApp.tweetsLoaded + 20) + search);

		$.get( "http://localhost:8000/ajax/"+group+"/" + ltApp.tweetsLoaded + "/" + (ltApp.tweetsLoaded + 20) + search , function( data ) {
			$data = $(data);
			ltApp.$container.append($data).isotope('appended', $data);
			ltApp.tweetsLoaded += 20;
		});
	};
});