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
