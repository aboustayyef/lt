<?php 
	$topTweets = (new \LebaneseTweets\Tweet)->top($group);
?>
<li class="card top5">
	<h3>Top Tweets <small>in the last 12 hours</small></h3>
	<ul>
		@foreach($topTweets as $topTweet)
		<?php 
			// Detect language
			$isArabic = \LebaneseTweets\Utilities\String::isMostlyArabic($topTweet->tweet_content);
		?>
		<li>
			<div>
				<img class="profile" src="{{$topTweet->tweep_user_image}}" height="48" width="48" alt="">
				<h4>{{'@'.$topTweet->tweep_twitterHandle}}</h4>
				<ul class="retweets_and_favorites">
					<li class="favorites">@include('svgIcons.favorite'){{$topTweet->tweet_favorites}}</li>
					<li class="retweets">@include('svgIcons.retweet'){{$topTweet->tweet_retweets}}</li>
			</ul>
			</div>

			<p @if($isArabic) class="arabic" @endif>
				{!!$topTweet->tweet_content!!}
				
			</p>

		</li>
		@endforeach
	</ul>
</li>