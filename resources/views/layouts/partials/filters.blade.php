{{-- Add code to choose which filter set based on data --}}

<div id="filters">

		<div id="categories">
			<h2>Pick Category</h2>
			<ul>
				<li><a href=""></a>All</li>
				<li><a href=""></a>Politicians</li>
				<li><a href=""></a>Journalists</li>
			</ul>
		</div>
			
		<div>
			<h2>Apply Filters</h2>
			<form>
				{{-- Common Filters --}}
				<div class="form-group">
			      	<input type="checkbox" name="show_replies" value="yes">
					<label for="show_replies">Show Replies</label>
				</div>
				<div class="form-group">
			      	<input type="checkbox" selected="selected" name="hide_retweets" value="yes">
					<label for="hide_retweets">Hide Retweets</label>
				</div>
				<div class="form-group">
			      	<input type="checkbox" name="show_images_only" value="yes">
					<label for="show_images_only">Only Images</label>
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
						<select name="district">
						  <option value="" disabled selected>District</option>
						  @foreach($subsubgroups['District'] as $district)
							  <option value="{{$district}}">{{$district}}</option>
						  @endforeach
						</select>
					</div>

					<div class="form-group">
						<select name="party">
						  <option value="" disabled selected>Party</option>
						  @foreach($subsubgroups['Party'] as $party)
							  <option value="{{$party}}">{{$party}}</option>
						  @endforeach
						</select>
					</div>
					<div class="form-group">
						<select name="sect">
						  <option value="" disabled selected>Sect</option>
						  @foreach($subsubgroups['Sect'] as $sect)
							  <option value="{{$sect}}">{{$sect}}</option>
						  @endforeach
						</select>
					</div>
				@endif

				@if($group == 'journalists')
					<div class="form-group">
						<select name="outfit">
						  <option value="" disabled selected>Outfit</option>
						  @foreach($subsubgroups['Outfit'] as $outfit)
							  <option value="{{$outfit}}">{{$outfit}}</option>
						  @endforeach
						</select>
					</div>
					<div class="form-group">
						<select name="medium">
						  <option value="" disabled selected>Medium</option>
						  @foreach($subsubgroups['Medium'] as $medium)
							  <option value="{{$medium}}">{{$medium}}</option>
						  @endforeach
						</select>
					</div>
				@endif

				<div class="form-group">
					<input type="submit">
				</div>
			</form>		
		</div>

	
</div>