<?php 
	$topTweets = (new \LebaneseTweets\Tweet)->top($group);
?>
<li class="card top5">
	<h3>Top Tweets @if($group)<small><br>( {{ 'In ' . $group }} )</small>@endif</h3>
	<ul>
		@foreach($topTweets as $topTweet)
		<?php 
			// Detect language
			$isArabic = \LebaneseTweets\Utilities\String::isMostlyArabic($topTweet->content);
		?>
		<li>
		<a href="https://twitter.com/{{$topTweet->tweep_twitterHandle}}/status/{{$topTweet->twitter_id}}">
			<div class="item">
				<div class="thumb">
					@if($topTweet->image())
						@if($topTweet->image_height() > $topTweet->image_width())
							<img src ="{{$topTweet->image()}}" width="100" height="{{(($topTweet->image_width() * 100) / $topTweet->image_height())}}">
						@else
							<img src ="{{$topTweet->image()}}" height="100" width="auto">
						@endif
					@else
						<img src="http://placehold.it/100x100">
					@endif
				</div>
				<div class="details  @if($isArabic) arabic @endif">
					<?php echo strip_tags($topTweet->content) ?>
					<h5>{{$topTweet->tweep_public_name}}</h5>
				</div>
			</div>
		</a>

			<div>
				{{-- 
					<img class="profile" src="{{$topTweet->user_image}}" height="24" width="24" alt="">
					<h4>{{$topTweet->tweep_public_name}}</h4>
					
					<ul class="retweets_and_favorites">
						<li class="favorites">@include('svgIcons.favorite'){{$topTweet->favorites}}</li>
						<li class="retweets">@include('svgIcons.retweet'){{$topTweet->retweets}}</li>
					</ul>
				--}}
				
			</div>


		</li>
		@endforeach
	</ul>
</li>