<template>
	<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1"  aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						{{ getPackageName }}
					</h5>
				</div>
				<div class="modal-body">
					<div v-if="getBookings.length === 0">
						<h5 class="card-title text-center text-gray">No Calculated Usages Yet!</h5>
					</div>
					<ul class="list-group">
						<li class="list-group-item d-flex justify-content-between align-items-center" v-for="(booking, index) in getBookings" :key="index">
							{{ booking.session_type.name }}
							<span class="badge badge-primary badge-pill">
								{{ booking.bookings_count }} of {{ booking.package_service.limit }} used
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
	
	import { mapGetters } from "vuex";
	export default {
		name: "PackageDetails",
		computed: {
			...mapGetters([
				"getPackageName",
				"getBookings"
			])
		}
	}
</script>