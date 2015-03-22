<div class="tweet">
	<div class="meta">
		<?php $time = new \Carbon\Carbon($tweet->tweet_date) ?>
		{{$time->diffForHumans()}}
	</div>

	<div class="media">
	  <div class="media-left">
	      <img class="media-object" src="{{$tweet->user_image}}" alt="Profile Pic">
	  </div>
	  <div class="media-body">
	    <h3>
			@if($tweet->is_retweet == 1)
				<small>Retweeted By
			@endif
			{{$tweet->first_name}} {{$tweet->last_name}}
				
			@if($tweet->is_retweet == 1)
				</small>
			@endif

		</h3>
	    <p>{!! $tweet->content !!}</p>
		@if($tweet->media)
			<div class="embeddedMedia" style="max-width:100%">
				<img src="{{$tweet->media}}">
			</div>
		@endif
	  </div>
	</div>
	
</div>

{{-- 
id: 30,
mp_id: 30,
twitter_id: "576700797641060352",
content: "لقاء مع مصلحة الطلاب في حزب الكتائب اللبنانية في الذكرى العاشرة لثورة الأرز\n<a href=\"http://samygemayel.com/photos/1991/%D9%84%D9%82%D8%A7%D8%A1-%D9%85%D8%B9-%D9%85%D8%B5%D9%84%D8%AD%D8%A9-%D8%A7%D9%84%D8%B7%D9%84%D8%A7%D8%A8-%D9%81%D9%8A-%D8%AD%D8%B2%D8%A8-%D8%A7%D9%84%D9%83%D8%AA%D8%A7%D8%A6%D8%A8-%D8%A7%D9%84%D9%84/\">samygemayel.com/photos/1991/%D…</a>",
is_retweet: 0,
username: "samygemayel",
user_image: "http://pbs.twimg.com/profile_images/500013794517479426/SVdwfqj1_normal.jpeg",
tweet_date: "2015-03-14 11:05:59",
created_at: "2015-03-22 11:41:11",
updated_at: "2015-03-22 11:41:11",
media: null,
first_name: "Samy",
last_name: "Gemayel",
gender: "Male",
district: "Metn",
twitterHandle: "samygemayel",
party: "Kataeb Party",
sect: "Maronite",
age: 35
 --}}

