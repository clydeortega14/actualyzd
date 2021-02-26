@if(count($psychologists) > 0)
    @foreach($psychologists as $psych)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="http://placehold.it/500x300">
                <div class="caption text-center">
                    <div class="form-group">
                        <input type="radio" id="psych{{ $psych->id }}" name="psychologist" value="{{ $psych->psych->id }}" class="with-gap" />
                        <label for="psych{{ $psych->id }}">{{ $psych->psych->name }}</label>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else

    <h2 class="text-center">NO PSYCHOLOGIST AVAILABLE</h2>
@endif