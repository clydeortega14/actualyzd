@foreach($time_lists as $time)
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    	<div class="form-group">
    		<input type="radio" name="time" value="{{ $time->id }}" required {{ $booked_time == $time->id ? 'checked' : ''  }}/>
    		<label>{{ $time->parseTimeFrom().' - '.$time->parseTimeTo() }}</label>
    	</div>
    </div>
@endforeach