{{-- Add code to choose which filter set based on data --}}
<div id="filters">
			<form>
				{{-- Common Filters --}}
				<div class="form-group">
					<h4>General Filters</h4>
					<div class="form-controll">
				      	<input type="checkbox" name="show_replies" value="yes">
						<label for="show_replies">Show Replies <small>Hidden by Default</small></label>
					</div>
					<div class="form-controll">
				      	<input type="checkbox" name="show_retweets" value="yes">
						<label for="show_retweets">Show Retweets <small>Hidden by Default</small></label>
					</div>
					<div class="form-controll">
				      	<input type="checkbox" name="show_images_only" value="yes">
						<label for="show_images_only">Only Images</label>
					</div>
				</div>
			    
			    {{-- Special Filters  (make auto generated) --}}
			    
			    <?php 
			    	if (!\Cache::has('subsubgroups')) {
			    		// build subsubgroups/
			    		(new \LebaneseTweets\Categories)->subsubgroups();
			    	}
			    	$subsubgroups = Cache::get('subsubgroups');
			    ?>
				
				@if($group == 'politicians')
					<div class="form-group">
						<h4>Filters for Politicians</h4>
						<div class="form-controll">
							<select name="district">
							  <option value="" disabled selected>District</option>
							  @foreach($subsubgroups['District'] as $district)
								  <option value="{{$district}}">{{$district}}</option>
							  @endforeach
							</select>
						</div>

						<div class="form-controll">
							<select name="party">
							  <option value="" disabled selected>Party</option>
							  @foreach($subsubgroups['Party'] as $party)
								  <option value="{{$party}}">{{$party}}</option>
							  @endforeach
							</select>
						</div>
						<div class="form-controll">
							<select name="sect">
							  <option value="" disabled selected>Sect</option>
							  @foreach($subsubgroups['Sect'] as $sect)
								  <option value="{{$sect}}">{{$sect}}</option>
							  @endforeach
							</select>
						</div>
					</div>
				@endif

				@if($group == 'journalists')
					<div class="form-group">
						<h4>Filters for Journalists</h4>
						<div class="form-controll">
							<select name="outfit">
							  <option value="" disabled selected>Outfit</option>
							  @foreach($subsubgroups['Outfit'] as $outfit)
								  <option value="{{$outfit}}">{{$outfit}}</option>
							  @endforeach
							</select>
						</div>
						<div class="form-controll">
							<select name="medium">
							  <option value="" disabled selected>Medium</option>
							  @foreach($subsubgroups['Medium'] as $medium)
								  <option value="{{$medium}}">{{$medium}}</option>
							  @endforeach
							</select>
						</div>						
					</div>
				@endif

				<div class="form-controll">
					<input type="submit">
				</div>
			</form>		
</div>