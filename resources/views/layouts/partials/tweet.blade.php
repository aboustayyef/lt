<li class="card tweet"

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
	@if($group=="")
		<?php $tweetgroup = strtolower($tweet->tweep_group) ?>
		<a href="/{{$tweetgroup}}">
			<img class="groupicon" src="{{URL::asset('img/groupicons/' . $tweetgroup . '.png')}}" width="30" height="30" alt="show {{$tweetgroup}} only" title="show {{$tweetgroup}} only">		
		</a>
	@endif
</div>


<!-- Card body -->
<div class="cardbody">
	<div class="metaInfo">
        <div class="postedSince">
          <a href="https://twitter.com/{{$tweet->tweep_twitterHandle}}/status/{{$tweet->twitter_id}}">{{(new \Carbon\Carbon($tweet->tweet_date))->diffForHumans()}}</a>
		</div>
		<ul class="retweets_and_favorites">
			<li class="favorites">@include('svgIcons.favorite'){{$tweet->tweet_favorites}}</li>
			<li class="retweets">@include('svgIcons.retweet'){{$tweet->tweet_retweets}}</li>
		</ul>
		

		<?php 
			// Detect language
			$isArabic = \LebaneseTweets\Utilities\String::isMostlyArabic($tweet->tweet_content);
		?>
		
		<div class="tweetContent @if($isArabic) arabic @endif">
			<p>{!!$tweet->tweet_content!!}</p>
		</div>
		@if(($tweet->tweet_media_height > 0 )&& ($tweet->tweet_media_width > 0))
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
	tweep_subgroups',
	tweep_group,


 --}}