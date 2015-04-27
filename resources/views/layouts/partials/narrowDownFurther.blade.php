<?php 
$subgroupStructure = [
	'politicians' => ['district', 'party', 'sect'],
	'journalists' => ['outfit', 'medium'] 
];
	if (!\Cache::has('subsubgroups')) {
		// build subsubgroups/
		(new \LebaneseTweets\Categories)->subsubgroups();
	}
	$subsubgroups = Cache::get('subsubgroups');
?>
<ul class="narrowDownFurther">
	<form>
	<li class="headline">Narrow Down Further: </li>
	@foreach ($subgroupStructure[$group] as $subgroup)
	
		<li>
			<select name="{{$subgroup}}">
			  <option value="" disabled selected>{{$subgroup}}</option>
			  <?php var_dump($subsubgroups[$subgroup]); ?>

			</select>
		</li>
	@endforeach
	<li>
		<div class="form-controll">
			<input type="submit">
		</div>
	</li>
	</form>
</ul>
