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
		<li class="tweet">
        <div class="profilepic">
          <a href="https://twitter.com/{{$topTweet->tweep_twitterHandle}}/status/{{$topTweet->twitter_id}}">
            <img src="{{$topTweet->user_image}}">
          </a>

        </div>
        <div class="content">
          <h5><strong>{{$topTweet->tweep_public_name}}</strong> {{'@'.$topTweet->tweep_twitterHandle}}</h5>
          <p @if($isArabic) class="arabic" @endif>{!!$topTweet->content!!}</p>
          @if($topTweet->media)
            <div class="media">
               <a href="https://twitter.com/{{$topTweet->tweep_twitterHandle}}/status/{{$topTweet->twitter_id}}">
                <img src="{{$topTweet->media}}" width="{{$topTweet->media_width}}" height="auto">
              </a>
            </div>
          @elseif($topTweet->link)
            @if($topTweet->link->image)
            <div class="media">
               <a href="https://twitter.com/{{$topTweet->tweep_twitterHandle}}/status/{{$topTweet->twitter_id}}">
                <img src="http://lebanesetweets.net/{{$topTweet->link->image}}" width="{{$topTweet->link->image_width}}" height="auto">
              </a>
            </div>
            @endif
          @endif
          <ul class="popularity">
            <li><a href="https://twitter.com/{{$topTweet->tweep_twitterHandle}}/status/{{$topTweet->twitter_id}}">@include('svgIcons.link') link</a></li>
            <li>@include('svgIcons.favorite') {{$topTweet->favorites}}</li>
            <li>@include('svgIcons.retweet') {{$topTweet->retweets}}</li>
          </ul>
        </div>
      </li>
		@endforeach
	</ul>
</li>