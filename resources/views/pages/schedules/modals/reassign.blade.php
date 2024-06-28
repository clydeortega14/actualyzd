<div class="modal fade" id="pending-{{ $pending->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <reassign-session-modal 
            date="{{ $pending->toSchedule->start }}" 
            time="{{ $pending->time_id }}" 
            userid="{{ auth()->user()->id }}">
        
        </reassign-session-modal>
    </div>
</div>