			@if ($request->has('district') || $request->has('sect') || $request->has('party') || $request->has('hideretweets'))
				<div class="well well-sm">
					Filters applied:
					@if($request->has('district'))
							<button type="button" class="btn btn-default btn-xs" disabled="disabled">District &rarr; {{$request->get('district')}}</button>  
					@endif
					@if($request->has('sect'))
					  		<button type="button" class="btn btn-default btn-xs" disabled="disabled">Sect &rarr; {{$request->get('sect')}}</button> 
					@endif
					@if($request->has('party'))
					  <button type="button" class="btn btn-default btn-xs" disabled="disabled">Party &rarr; {{$request->get('party')}}</button> 
					@endif
					@if($request->has('hideretweets'))
					  <button type="button" class="btn btn-default btn-xs" disabled="disabled">Retweets are Hidden</button>
					@endif
					&nbsp;&nbsp;<a href="/mps"><button class="btn btn-success btn-xs">Reset</button></a>
				</div>
			@endif