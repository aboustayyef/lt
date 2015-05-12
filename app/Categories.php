<?php namespace LebaneseTweets;


class Categories
{
	

	public function __construct(){
		$this->structure = [
			'politicians'	=>	['district','party', 'sect'],
			'journalists'	=>	['outfit', 'medium'],
			'activists'		=>	['topic']
		];
	}

	public function subgroups($group){
		if (array_key_exists($group, $this->structure)) {
			return $this->structure[$group];
		}
		return false;
	}

	public function subSubGroups(){

		\Cache::forget('subsubgroups');

		foreach ($this->structure as $key => $structure) {
			foreach ($this->structure[$key] as $subkey => $subgroup) {
				
				$options[$subgroup] = []; // example: $options['District'] = [];
				$tweeps = Tweep::where('group',$key)->get();
				foreach ($tweeps as $tweep) {
					$tweepSubgroups = preg_split('#\s*,\s*#', $tweep->subgroups);
					if (!in_array($tweepSubgroups[$subkey], $options[$subgroup])) {
						$options[$subgroup][] = $tweepSubgroups[$subkey];
					}
				}
				sort($options[$subgroup]);
			}
		}

		\Cache::forever('subsubgroups', $options);
	
	}


}


?>