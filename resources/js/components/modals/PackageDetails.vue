<template>
	<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1"  aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						Package One
					</h5>
				</div>
				<div class="modal-body">
					<ul class="list-group">
						<li class="list-group-item d-flex justify-content-between align-items-center">
							Individual
							<span class="badge badge-primary badge-pill">
								3 of 30 used
							</span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							Group
							<span class="badge badge-primary badge-pill">
								1 of 2 used
							</span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							Webinar
							<span class="badge badge-primary badge-pill">
								0 of 1 used
							</span>
						</li>
					</ul>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
	

	export default {
		name: "PackageDetails"
	}
</script>