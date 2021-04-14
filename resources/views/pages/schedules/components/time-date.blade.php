@foreach($time_lists as $time)
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    	<div class="form-group">
    		<input type="radio" name="time" value="{{ $time->toTime->id }}" required {{ isset($booking) && $booking->toSchedule->toTime->id == $time->id ? 'checked' : ''  }}/>
    		<label>{{ $time->toTime->parseTime($time->toTime->from) .' - '.$time->toTime->parseTime($time->toTime->to) }}</label>
    	</div>
    </div>
@endforeach