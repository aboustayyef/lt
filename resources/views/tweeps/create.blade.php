@extends('tweeps.layout')

@section('content')

<div class="col-md-6 col-md-offset-3">

	<h1>Add New</h1>

	<hr>

	@if(\Session::has('message'))
	<div>
		{{Session::get('message')}}
	</div>
	@endif

	<div>
		@include('tweeps.errors')
	</div>

	{!! Form::open(['route'=>'tweeps.store']) !!}

	<div class="form-group">
		{!! Form::label('public_name','Public Name')!!}
		{!! Form::text('public_name',null,['class'=>'form-control'])!!}
	</div>
	<div class="form-group">
		{!! Form::label('twitterHandle','Twitter Handle')!!}
		{!! Form::text('twitterHandle',null,['class'=>'form-control', 'placeholder' => 'Do\'nt include @ symbol'])!!}
	</div>
	<div class="form-group">
		{!! Form::label('group','Group')!!}
		{!! Form::text('group',null,['class'=>'form-control','placeholder' => 'Journalists, Politicians or Activists'])!!}
	</div>
	<div class="form-group">
		{!! Form::label('subgroups','Sub Groups')!!}
		{!! Form::text('subgroups',null,['class'=>'form-control', 'placeholder' => 'district, party, sect or outfit,medium'])!!}
	</div>

	<!-- Button -->
	<div class="form-group">
		{!! Form::submit('Submit',['class'=>'btn btn-primary form-control'])!!}
	</div>
	{!! Form::close() !!}

</div> {{-- cols and offset --}}

@stop