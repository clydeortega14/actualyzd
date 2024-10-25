<template>
	<div>
		<div class="row justify-content-between mb-5 border-bottom" v-for="(sub, index) in getSubscriptions" :key="index">
			<div class="col-md-6">
				<div>
					<span>
						<small>subscribed to</small> <br />
						<h5 class="mb-0">{{ sub.package.name }} </h5>
						<small class="text-gray">
							{{ sub.reference_no }}
						</small> <br />
						<small>Expires at {{ wholeDate(sub.completion_date) }}</small>
					</span>
				</div>
			</div>
			<div class="col-md-6" align="right">
				<button type="button" class="btn btn-outline-primary btn-sm" @click.prevent="renewSubscription(sub.id)">
					<i class="fas fa-sync"></i>
					<span>Renew</span>
				</button>

				<button type="button" class="btn btn-outline-secondary btn-sm" @click.prevent="checkPackageDetail">
					<i class="fas fa-info-circle"></i>
					<span>Usage</span>
				</button>

				<button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="cancelSubscription(sub.id)">
					<i class="fas fa-times"></i>
					<span>Cancel</span>
				</button>
			</div>
		</div>

		<PackageInfo ref="packageInfoModal"
				:package-id="getPackageId"
				:package-name="getPackageName"
				:package-services="getPackageServices"
			/>

		<PackageDetail ref="packageDetailModal"/>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';
	import PackageInfo from '../../modals/PackageInfo.vue';
	import PackageDetail from '../../modals/PackageDetails.vue';
	import DateTime from '../../../mixins/datetime.js';
	import SweetAlert from '../../../mixins/sweet-alert.js';

	export default {
		name: "ClientSubscription",
		mixins: [ DateTime, SweetAlert ],
		data(){
			return {
				client_subscription_reference: ''
			}
		},
		props: {
			client: Object
		},
		created() {
			this.getSubscriptionsData({
				ClientID: this.client.client.id
			});
		},
		mounted(){

			EventBus.$on('renew-subscription', data => {
				
				this.updateClientSubscription({
					ClientID: this.getClientID,
					subscription: this.getPackageName,
					client_subscription_reference: this.getReferenceNo,
					action: "renew"
				})
				.then((response) => {

					if(!response.data.error){
						this.success("Successfully Renewed");

						let element = this.$refs.packageInfoModal.$el;
						$(element).modal("hide");

						this.getSubscriptionsData({
							ClientID: this.getClientID
						});
					}
				})
				.catch((error) => {
					this.error(error);
				});
			});
		},
		components: {
			PackageInfo,
			PackageDetail
		},
		computed: {

			...mapGetters([
				"getId",
				"getClientID",
				"getReferenceNo",
				"getCompletionDate",
				"getSubscriptions", 
				"getPackageId", 
				"getPackageName", 
				"getPackageServices"
			])
		},
		methods: {
			...mapActions(["getSubscriptionsData", "updateClientSubscription"]),
			renewSubscription(subscription_id){

				let find_subscription = this.getSubscriptions.find((sub) => sub.id == subscription_id);

				if(find_subscription !== undefined)
				{
					let element = this.$refs.packageInfoModal.$el;
					$(element).modal("show");

					this.$store.commit('setId', find_subscription.id);
					this.$store.commit('setClientID', find_subscription.client_id);
					this.$store.commit('setReferenceNo', find_subscription.reference_no);
					this.$store.commit('setCompletionDate', find_subscription.completion_date);
					this.$store.commit('setPackageId', find_subscription.package.id);
					this.$store.commit('setPackageName', find_subscription.package.name);
					this.$store.commit('setPackageServices', find_subscription.package.services);
				}
				
			},
			checkPackageDetail(){

				let element = this.$refs.packageDetailModal.$el;

				$(element).modal("show");
			},
			cancelSubscription(sub_id)
			{
				let find_subscription = this.getSubscriptions.find((sub) => sub.id == sub_id);

				if(find_subscription !== undefined){

					this.$store.commit('setClientID', find_subscription.client_id);
					this.$store.commit('setReferenceNo', find_subscription.reference_no);
					this.$store.commit('setPackageName', find_subscription.package.name);

					this.dialog(
						'Are you sure?',
						"You want to cancel this subscription?",
						"warning",
						"No",
						"Yes, Cancel it"
					).then(result => {
						
						if(result.isConfirmed){
							this.updateClientSubscription({
								ClientID: this.getClientID,
								subscription: this.getPackageName,
								client_subscription_reference: this.getReferenceNo,
								action: "cancel"
							})
							.then(response => {
								if(!response.data.error){
									let filtered_sub = this.getSubscriptions.filter( (sub) => sub.id != sub_id );

									this.$store.commit('setSubscriptions', filtered_sub)

									this.success("Cancelled Successfully");
								}
							}	)
						}
					});
				}
				
			}
		}
	}

</script>