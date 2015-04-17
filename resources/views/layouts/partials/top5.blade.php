<?php 
	$topTweets = (new \LebaneseTweets\Tweet)->top($group);
?>
<li class="card top5">
	<h3>Top Recent Tweets @if($group)<small><br>( {{ 'In ' . $group }} )</small>@endif</h3>
	<ul>
		@foreach($topTweets as $topTweet)
		<?php 
			// Detect language
			$isArabic = \LebaneseTweets\Utilities\String::isMostlyArabic($topTweet->content);
		?>
		<li>
			<div>
				<img class="profile" src="{{$topTweet->user_image}}" height="24" width="24" alt="">
				<h4>{{$topTweet->tweep_public_name}}</h4>
			</div>
			<a href="https://twitter.com/{{$topTweet->tweep_twitterHandle}}/status/{{$topTweet->twitter_id}}">
			<div class="tweet @if($isArabic) arabic @endif"> 
				<ul class="retweets_and_favorites">
					<li class="favorites">@include('svgIcons.favorite'){{$topTweet->favorites}}</li>
					<li class="retweets">@include('svgIcons.retweet'){{$topTweet->retweets}}</li>
				</ul>
				@if(($topTweet->media_height > 0 )&& ($topTweet->media_width > 0))
					<div class="preview">
						<img src="{{$topTweet->media}}" height="60" width="{{($topTweet->media_width / $topTweet->media_height)*60}}">
					</div>
				@endif
				<?php echo strip_tags($topTweet->content) ?>
			</div>
			</a>

		</li>
		@endforeach
	</ul>
</li>