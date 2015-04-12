<div id="menubar">
	<div class="inner">
		<ul>
			<li @if($group == "") class="active" @endif><a href="/">All</a></li>
			<li @if($group == "politicians") class="active" @endif ><a href="/politicians">Politicians</a></li>
			<li @if($group == "journalists") class="active" @endif ><a href="/journalists">Journalists</a></li>
		</ul> 
	</div>
</div>