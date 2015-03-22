@extends('app')

@section('title')
Lebanon Mps Tweet
@stop

@section('description')
The Tweets of Lebanon's MPs
@stop

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Latest Tweets of Lebanese MPs, Filtered by Party, Sect and District</h1>
			<hr>
		</div>
	</div>
	<div class="row">
  		<div class="col-md-4">
  			<div class="row">
  				<div class="col-md-10">
  					@include('partials.filters')
		  			<hr>
		  			@include('partials.aboutthisproject')
  				</div>
  			</div>	  			
  		</div>
 		<div class="col-md-8">
			@if ($request->has('district') || $request->has('sect') || $request->has('party') || $request->has('hideretweets'))
				<div class="well well-sm">
					Filters applied:
					@if($request->has('district'))
							<button type="button" class="btn btn-default btn-xs" disabled="disabled">District &rarr; {{$request->get('district')}}</button>  
					@endif
					@if($request->has('sect'))
					  		<button type="button" class="btn btn-default btn-xs" disabled="disabled">Sect &rarr; {{$request->get('sect')}}</button> 
					@endif
					@if($request->has('party'))
					  <button type="button" class="btn btn-default btn-xs" disabled="disabled">Party &rarr; {{$request->get('party')}}</button> 
					@endif
					@if($request->has('hideretweets'))
					  <button type="button" class="btn btn-default btn-xs" disabled="disabled">Retweets are Hidden</button>
					@endif
					&nbsp;&nbsp;<a href="/mps"><button class="btn btn-success btn-xs">Reset</button></a>
				</div>
			@endif
			<div>
				@if(count($tweets) == 0)
					<H2>Sorry! No Tweets Mach These Criteria </H2>
					<p>Try and make the search criteria less specific</p>
				@else
					@foreach($tweets as $tweet)
						@include('partials.tweet')
					<hr>
					@endforeach
				@endif
			</div>
 		</div>
	</div>
	
@stop