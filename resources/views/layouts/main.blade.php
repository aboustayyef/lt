<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{URL::asset('css/lebanesetweets.css')}}">
</head>
<body>

	<div id="header">
		<div id="logo"></div>
		this is the slogan
		<!-- To add: about menu -->
	</div>


	<div id="scrollingArea">
			<ul class="cards">
					@foreach($tweets as $tweet)
						@include('partials.tweet')
					@endforeach
			</ul>
	
	</div> <!-- /Scrolling Area -->

	<script type="text/javascript" src="{{URL::asset('js/lebanesetweets-min.js')}}"></script>
</body>
</html>


{{-- 


"tweet_id": 3420,
"twitter_id": "583629856803545088",
"tweet_content": " الخير: نعمل من أجل بقاء #الحكومة وتماسكها  \n<a href=\"http://twitter.com/kazemkheir\">@kazemkheir</a>\n<a href=\"http://bit.ly/1I7t68n\">bit.ly/1I7t68n</a>",
"tweet_is_retweet": 1,
"tweep.user_image": "http://pbs.twimg.com/profile_images/450614048850051072/iL33AXyi_normal.png",
"tweet_date": "2015-04-02 14:00:18",
"tweet_created_at": "2015-04-04 11:21:47",
"tweet_media": null,
"tweet_favorites": 1,
"tweet_retweets": 1,
"tweep_public_name": "Kathem El Kheir",
"tweep_twitterHandle": "kazemkheir",
"tweep_subgroups": "Dinniyeh & Minieh , Tripoli Bloc , Sunni"


 --}}