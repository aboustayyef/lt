<form method="get" action="/mps">
<fieldset>

<!-- Form Name -->
<legend>Narrow Down Criteria</legend>

<!-- Select Basic -->
<div class="form-group">
  <label for="district">District</label>
    <select id="district" name="district" class="form-control">
    <?php 
    	$districts = array_unique(\LebaneseTweets\Mp::orderBy('district','asc')->lists('district'));
    ?>
	  <option value="" selected="selected">All</option>
      @foreach($districts as $district)
		<option value="{{$district}}">{{$district}}</option>
      @endforeach
    </select>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label for="sect">Sect</label>
    <select id="sect" name="sect" class="form-control">
    <?php 
    	$sects = array_unique(\LebaneseTweets\Mp::orderBy('sect','asc')->lists('sect'));
    ?>
	  <option value="" selected="selected">All</option>
      @foreach($sects as $sect)
		<option value="{{$sect}}">{{$sect}}</option>
      @endforeach
    </select>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label for="party">Party</label>
    <select id="party" name="party" class="form-control">
    <?php 
    	$parties = array_unique(\LebaneseTweets\Mp::orderBy('party','asc')->lists('party'));
    ?>
	  <option value="" selected="selected">All</option>
      @foreach($parties as $party)
		<option value="{{$party}}">{{$party}}</option>
      @endforeach
    </select>
</div>

<!-- Multiple Checkboxes -->
<div class="form-group">
  <div class="checkbox">
    <label for="hideretweets">
      <input type="checkbox" name="hideretweets" id="hideretweets" value="yes">Hide Retweets
    </label>
	</div>
</div>


<!-- Button -->
<div class="form-group">
    <button class="btn btn-primary">Submit And Refresh</button>
</div>

</fieldset>
</form>

