<template>

		<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="packageInfoLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- <div class="modal-header" id="packageInfoLabel">
						<h5 class="modal-title">Renew Package One ?</h5>
					</div> -->
					<div class="modal-body">

						<div class="row justify-content-center mt-3">
							<div class="col-md-8">
								<div>
									<h5 class="modal-title">Renew {{ packageName }}</h5>
								</div>
								
								<ul>
									<li v-for="(package_service, index) in packageServices" :key="index">
										{{ package_service.session_type.name }} : {{ package_service.limit }}
									</li>
								</ul>
							</div>
						</div>

						
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" @click.prevent="renewPackage(packageId)">Renew</button>
					</div>
				</div>
			</div>
		</div>
</template>


<script>
		
	

	export default {
		name: "PackageInfo",
		data(){
			return {
				
			}
		},
		props: {
			packageId: Number,
			packageName: String,
			packageServices: Array
		},
		methods: {
			renewPackage(package_id){

				EventBus.$emit('renew-subscription', package_id)
			}
		}
	}
</script>