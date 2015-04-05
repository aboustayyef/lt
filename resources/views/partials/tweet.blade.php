<li class="card"

<?php 
//  Build metadata
$subgroups = preg_split('#\s*,\s*#',$tweet->tweep_subgroups);
foreach ($subgroups as $key => $subgroup) {	echo 'data-subgroup' . ($key + 1) . '="' . $subgroup . '" ';}?>
>

<!-- Card Header -->
<div class="cardheader">
	@if($tweet->tweet_is_retweet)
		<h4>{{$tweet->tweep_public_name}} Retweeted</h4>
	@endif
	<img class="tweep_thumb	@if($tweet->tweet_is_retweet)retweet @endif" src="{{$tweet->tweep_user_image}}" height="50px">
	<h3>
		@if(!$tweet->tweet_is_retweet){{$tweet->tweep_public_name}}<br>@endif
		<small>{{'@' . $tweet->tweet_twitterHandle}}</small>
	</h3>
</div>


<!-- Card body -->
<div class="cardbody">
	<div class="metaInfo">
        <div class="postedSince">
          {{(new \Carbon\Carbon($tweet->tweet_created_at))->diffForHumans()}}
		</div>
		<ul class="retweets_and_favorites">
			<li class="favorites">{{$tweet->tweet_favorites}}</li>
			<li class="retweets">{{$tweet->tweet_retweets}}</li>
		</ul>
		

		<?php 
			// Detect language
			$isArabic = \LebaneseTweets\Utilities\String::isMostlyArabic($tweet->tweet_content);
		?>
		
		<div class="tweetContent @if($isArabic) arabic @endif">
			{!!$tweet->tweet_content!!}
		</div>
		@if($tweet->tweet_media_height > 0)
			<img src="{{$tweet->tweet_media}}" width="280" height="{{($tweet->tweet_media_height / $tweet->tweet_media_width)*280}}">
		@endif
	</div>
</div>


<!-- Card Footer -->
<div class="cardfooter">
	
</div></li>




{{-- 



'tweets.id as tweet_id',
	twitter_id',
	tweet_content',
	tweet_is_retweet',
	tweep_user_image',
	tweet_date',
	tweet_created_at',
	tweet_media',
	tweet_favorites',
	tweet_retweets',
	tweet_popularity_score',
	tweet_media_height',
	tweet_media_width',
	tweep_public_name',
	tweep_twitterHandle',
	tweep_subgroups'


 --}}