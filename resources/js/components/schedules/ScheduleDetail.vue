<template>
    <div class="modal fade" id="show-time" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="show-time-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="show-time-label">Schedule Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true">&times;</span>
		        	</button>
				</div>

                <div class="modal-body">

                    <div class="btn-group mb-5 btn-block" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success">Complete</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                        <button type="button" class="btn btn-warning">Reschedule</button>
                        <button type="button" class="btn btn-secondary">No Show</button>
                        <button type="button" class="btn btn-primary">Join Now</button>
                    </div>

                    <div class="border-bottom mb-3">
                        <b>DateTime</b>
                        <p>
                            July 15, 2024 10:00 - 11:00 am
                        </p>
                    </div>

                    <div class="border-bottom mb-3">
                        <b>Type of session</b>
                        <p>
                            Individual Session
                        </p>
                    </div>

                    <div class="border-bottom mb-3">
                        <b>Participants</b>
                        <ul class="list-unstyled ml-3">
                            <li>
                                Mark Juaman
                                <span class="badge badge-success">Member</span>
                                <a href="#" class="ml-2">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </li>
                            <li>
                                Pychologist Two
                                <span class="badge badge-success">psychologist</span>
                                <a href="#" class="ml-2">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Schedule Detail",
        
    }
</script>