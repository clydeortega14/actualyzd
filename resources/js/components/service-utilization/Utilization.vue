<template>
	<div class="row mt-4 mb-4">

		<!-- counting of first timers and repeaters -->
		<div class="col-md-6">
			<div class="card mb-3">
				<div class="card-header">
					<div class="text-xs text-uppercase mb-1">
						First Timers
					</div>
				</div>
				<div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h1 mb-0 text-gray-800 text-center">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card mb-3">
				<div class="card-header">
					<div class="text-xs text-uppercase mb-1">
						Repeaters
					</div>
				</div>
				<div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h1 mb-0 text-gray-800 text-center">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- counting of first timers and repeaters -->

		<!-- Session Statuses -->
		<div class="col-md-4" v-for="(booking_status, index) in getBookingByStatus" :key="index">
			<div class="card mb-3">
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
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- End Session Statuses -->


		<!-- Sessions Table -->
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">Consultation Service</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover text-center">
							<thead>
								<tr>
	                                <th>Month</th>
	                                <th>First Timers</th>
	                                <th>Repeaters</th>
	                                <th>Cancelled</th>
	                                <th>No Show</th>
	                                <th>Completed</th>
	                                <th>Pending Rescheduling</th>
	                            </tr>
							</thead>
							<tbody>
								<tr>
                                    <td>3/2/2021</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>0</td>
                                    <td>3</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>3/3/2021</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>4</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3/3/2021</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>4</td>
                                    <td>1</td>
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
                        <table class="table table-hover text-center">
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
                                <tr>
                                    <td>Consultation</td>
                                    <td>60</td>
                                    <td>65</td>
                                    <td>80%</td>
                                    <td>3/15/2020</td>
                                </tr>
                                <tr>
                                    <td>Group Session</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>100%</td>
                                    <td>3/28/2020</td>
                                </tr>
                                <tr>
                                    <td>Webinar</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>100%</td>
                                    <td>3/27/2020</td>
                                </tr>
                                <tr>
                                    <td>Hotline</td>
                                    <td>60</td>
                                    <td>20</td>
                                    <td>33%</td>
                                    <td>3/30/2020</td>
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
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Services</th>
                                    <th>MTD</th>
                                    <th>QTD</th>
                                    <th>YTD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Consultation</td>
                                    <td>66</td>
                                    <td>195</td>
                                    <td>780</td>
                                </tr>
                                <tr>
                                    <td>Group Session</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>Webinar</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>Hotline</td>
                                    <td>60</td>
                                    <td>20</td>
                                    <td>720</td>
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
	export default {
		name: "Utilization",
		created(){
			this.serviceUtilization()
		},
		computed: {
			...mapGetters(["getBookingByStatus"])
		},
		methods: {
			...mapActions(["serviceUtilization"])
		}
	}
</script>