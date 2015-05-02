<?php 
	$topTweets = (new \LebaneseTweets\Tweet)->top($group);
	$thumbwidth = 80;
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
							<img src ="{{$topTweet->image()}}" width="{{$thumbwidth}}" height="auto">
						@else
							<img src ="{{$topTweet->image()}}" height="{{$thumbwidth}}" width="auto">
						@endif
					@else
						<img src="{{\URL::to('/').'/img/no-image.png'}}" width="{{$thumbwidth}}" height="auto">
					@endif
				</div>
				<div class="details  @if($isArabic) arabic @endif">
					<img class="profile" src="{{$topTweet->user_image}}" height="15" width="15" alt="">
					<h5> {{$topTweet->tweep_public_name}}</h5>
					<?php echo strip_tags($topTweet->content) ?>
					<ul class="retweets_and_favorites">
						<li class="retweets">@include('svgIcons.retweet'){{$topTweet->retweets}}</li>
						<li class="favorites">@include('svgIcons.favorite'){{$topTweet->favorites}}</li>
					</ul>
				</div>
			</div>
		</a>

			<div>
				{{-- 
					<img class="profile" src="{{$topTweet->user_image}}" height="12" width="12" alt="">
					<h4>{{$topTweet->tweep_public_name}}</h4>
					
					
				--}}
				
			</div>


		</li>
		@endforeach
	</ul>
</li>