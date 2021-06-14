<template>
	<div class="row mt-4 mb-4">
		<div class="col-md-3">
			<!-- counting of first timers and repeaters -->
			<div class="card mb-3">
				<div class="card-header">
					<div class="text-xs text-uppercase mb-1">
						First Timers
					</div>
				</div>
				<div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h1 mb-0 text-gray-800 text-center">{{ totalFirstTimers }}</div>
                        </div>
                    </div>
                </div>
			</div>

			<div class="card mb-3">
				<div class="card-header">
					<div class="text-xs text-uppercase mb-1">
						Repeaters
					</div>
				</div>
				<div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h1 mb-0 text-gray-800 text-center">{{ totalRepeaters }}</div>
                        </div>
                    </div>
                </div>
			</div>

			<div class="card mb-3" v-for="(booking_status, index) in getBookingByStatus" :key="index">
				<div class="card-header">
					<div class="text-xs text-uppercase mb-1">
						{{ booking_status.to_status.name }}
					</div>
				</div>
				<div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h1 mb-0 text-gray-800 text-center">{{ booking_status.booking_count }}</div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- counting of first timers and repeaters -->
		<!-- Sessions Table -->
		<div class="col-md-9">
			<div class="card mb-3">
				<div class="card-header">Consultation Service</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
	                                <th>Month</th>
                                    <th>Firstimer</th>
                                    <th>Repeater</th>
	                                <th>Cancelled</th>
	                                <th>No Show</th>
	                                <th>Completed</th>
	                                <th>Pending Rescheduling</th>
	                            </tr>
							</thead>
							<tbody>
								<tr v-for="(consultation, index) in consultationSummaries" :key="index">
                                    <td>{{ consultation.date }}</td>
                                    <td>{{ consultation.firstimers }}</td>
                                    <td>{{ consultation.repeaters }}</td>
                                    <td>{{ consultation.cancelled }}</td>
                                    <td>{{ consultation.no_show }}</td>
                                    <td>{{ consultation.completed }}</td>
                                    <td>{{ consultation.rescheduled }}</td>
                                </tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- End sessions table -->

			<!-- Utilization Rate table-->
			<div class="card mb-3">
				<div class="card-header">Utilization Rate</div>
				<div class="card-body">
					<div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Services</th>
                                    <th>Limit</th>
                                    <th>Usage</th>
                                    <th>Percentage</th>
                                    <th>Completion Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(service, index) in allServices" :key="index">
                                    <td>{{ service.name }}</td>
                                    <td>{{ service.limit }}</td>
                                    <td>{{ service.bookings.length }}</td>
                                    <td>{{ getPercentage(service.bookings.length, service.limit) }}%</td>
                                    <td>{{ service.completion_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
			<!-- End Utilization rate table  -->

			<div class="card mb-3">
                <div class="card-header">Services</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Services</th>
                                    <th>MTD</th>
                                    <th>QTD</th>
                                    <th>YTD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(session_type_summary, index) in sessionTypeSummaries" :key="index">
                                    <td>{{ session_type_summary.session }}</td>
                                    <td>{{ session_type_summary.mtd }}</td>
                                    <td>{{ session_type_summary.qtd }}</td>
                                    <td>{{ session_type_summary.ytd }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>

		
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';
    import ServiceUtilization from '../../mixins/service-utilization.js';

	export default {
		name: "Utilization",
        mixins: [ ServiceUtilization ],
		created(){
			this.serviceUtilization()
		},
		computed: {
			...mapGetters([
                "getBookingByStatus", 
                "allServices", 
                "consultationSummaries",
                "sessionTypeSummaries",
                "totalFirstTimers",
                "totalRepeaters"
            ])
		},
		methods: {
			...mapActions(["serviceUtilization"])
		}
	}
</script>