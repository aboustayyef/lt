<li class="card tweet"

<?php 
//  Build metadata
$subgroups = preg_split('#\s*,\s*#',$tweet->tweep_subgroups);
foreach ($subgroups as $key => $subgroup) {	echo 'data-subgroup' . ($key + 1) . '="' . $subgroup . '" ';}?>
>

<!-- Card Header -->
<div class="cardheader @if($tweet->is_retweet) tint @endif">
		@if($tweet->is_retweet)

			<h3 class="retweeted"><img src="{{URL::asset('img/retweet.png')}}" width="16" height="11">&nbsp;{{$tweet->tweep_public_name}} Retweeted</h3>
			
		@else
			<a href="https://twitter.com/{{$tweet->tweep_twitterHandle}}">
				<img class="tweep_thumb" src="{{$tweet->user_image}}" height="50px">
				<h3>
					{{$tweet->tweep_public_name}}<br>
					<small>{{'@' . $tweet->tweep_twitterHandle}}</small>
				</h3>
			</a>
		@endif
	
		
</div>

<!-- Card body -->
<div class="cardbody">
	<div class="metaInfo">

	@if($tweet->is_retweet)
		<div class="retweetedContent">

			<div class="subheader">
			<img class="tweep_thumb	retweet" src="{{$tweet->user_image}}" height="50px">
			<a href="https://twitter.com/{{$tweet->username}}"><h3>{{'@' . $tweet->username}}</h3></a>	
			</div>

	@endif

        <div class="postedSince">
          <a href="https://twitter.com/{{$tweet->tweep_twitterHandle}}/status/{{$tweet->twitter_id}}">{{(new \Carbon\Carbon($tweet->tweet_date))->diffForHumans()}}</a>
		</div>
		<ul class="retweets_and_favorites">
			<li class="favorites">@include('svgIcons.favorite'){{$tweet->favorites}}</li>
			<li class="retweets">@include('svgIcons.retweet'){{$tweet->retweets}}</li>
		</ul>

		<?php 
			// Detect language
			$isArabic = \LebaneseTweets\Utilities\String::isMostlyArabic($tweet->content);
		?>
		
		<div class="tweetContent @if($isArabic) arabic @endif">
			<p>{!!$tweet->content!!}</p>
		</div>
		@if(($tweet->media_height > 0 )&& ($tweet->media_width > 0))
			<img src="{{$tweet->media}}" width="280" height="{{($tweet->media_height / $tweet->media_width)*280}}">
		@elseif($tweet->link)

		<?php 
			// Detect title language
			$isArabic = \LebaneseTweets\Utilities\String::isMostlyArabic($tweet->link->title);
		?>
			<div class="link @if($isArabic) arabic @endif">
				<a href="{{$tweet->link->url}}">
					<img src="{{$tweet->link->image}}" width="{{$tweet->link->image_width}}" height="{{$tweet->link->image_height}}">
				</a>
				<a href="{{$tweet->link->url}}">
					<h4 class="linkTitle">{{$tweet->link->title}}</h4>
				</a>

				<p>{{$tweet->link->excerpt}}</p>
			</div>
		@endif
		@if($tweet->is_retweet)
			</div> {{-- retweeted content --}}
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