<div id="menubar">
	<div class="inner">
		{{-- <ul>
			<a href="/"><li @if($group == "") class="active" @endif>All</li></a>
			<a href="/politicians"><li @if($group == "politicians") class="active" @endif >Politicians</li></a>
			<a href="/journalists"><li @if($group == "journalists") class="active" @endif >Journalists</li></a>
		</ul>  --}}
		<select id="categorySwitch">
			@if($group=="")
				<option data-target="/" selected="selected" >Select Category</option>
			@else
				<option data-target="/" selected="selected" >Show All</option>
			@endif
			<option data-target="/politicians" @if($group=="politicians") selected="selected" @endif>Politicians</option>
			<option data-target="/journalists" @if($group=="journalists") selected="selected" @endif>Journalists</option>
			<option data-target="/activists" @if($group=="activists") selected="selected" @endif>Activists and Bloggers</option>
		</select>
		{{-- @include('layouts.partials.filterbutton') --}}
		

	</div>
</div>