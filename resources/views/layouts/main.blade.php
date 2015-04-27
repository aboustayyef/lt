@section('title')

	@if($group=="journalists")
		Latest Tweets By Lebanese Journalists
	@elseif($group=="politicians")
		Latest Tweets By Lebanese Politicans
	@else
		Latest Lebanese Tweets by Journalists and Politicans
	@endif

@stop

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{URL::asset('css/lebanesetweets.css?v=1.00')}}">
</head>
<body>
	<script>
		// Initialization.
		if ( typeof ltApp != 'object'){
			var ltApp = {};
			ltApp.webRoot = "{{URL::to('/')}}";
			console.log(ltApp.webRoot);
			ltApp.updating = false;
			ltApp.tweetsLoaded = 20; // initial count;
	    }
    </script>
<div id="curtain"></div>

<div class="fixed">
	@include('layouts.partials.topbar')
	@include('layouts.partials.menubar')
</div>
<div id="scrollingArea">

{{-- @include('layouts.partials.filters') --}}


<div class="inner">
	@if($group)
		@include('layouts.partials.narrowDownFurther')
	@endif
	<ul class="cards">
	@include('layouts.partials.top5')
	@foreach($tweets as $tweet)
		@include('layouts.partials.tweet')
	@endforeach
</ul>
</div>

@include('layouts.partials.footer')
</div> <!--/scrollingArea-->
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