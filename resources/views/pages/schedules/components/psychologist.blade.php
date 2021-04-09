@if(count($psychologists) > 0)
    @foreach($psychologists as $psych)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card mb-3 text-center"> 
                <img src="{{ asset ('sb-admin/img/undraw_profile.svg') }}" alt="Psychologist Image" width="80" height="80" class="mx-auto d-block pt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $psych->psych->name }}</h5>
                    <div class="form-check">
                        <input type="radio" name="psychologist" id="psych{{ $psych->id }}" value="{{ $psych->psych->id }}">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-7 offset-md-3">
        <h4 class="text-center text-gray">No Psychologist Available</h4>
    </div>
@endif