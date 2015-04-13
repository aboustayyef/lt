<div id="menubar">
	<div class="inner">
		<ul>
			<a href="/"><li @if($group == "") class="active" @endif>All</li></a>
			<a href="/politicians"><li @if($group == "politicians") class="active" @endif >Politicians</li></a>
			<a href="/journalists"><li @if($group == "journalists") class="active" @endif >Journalists</li></a>
		</ul> 
	</div>
</div>