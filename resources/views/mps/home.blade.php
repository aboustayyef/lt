@extends('app')

@section('title')
Lebanon Mps Tweet
@stop

@section('description')
Latest Tweets of Lebanese MPs, Filtered by Party, Sect and District
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
			@include('mps.partials.filtersheader')
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