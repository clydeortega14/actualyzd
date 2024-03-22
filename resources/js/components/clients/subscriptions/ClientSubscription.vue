<template>
	<div>
		<div class="row justify-content-between mb-5 border-bottom" v-for="(sub, index) in getSubscriptions" :key="index">
			<div class="col-md-6">
				<div>
					<span>
						<small>subscribed to</small> <br />
						<h5 class="mb-0">{{ sub.package.name }}</h5>
						<small>Exp {{ wholeDate(sub.completion_date) }}</small>
					</span>
				</div>
			</div>
			<div class="col-md-6" align="right">
				<button type="button" class="btn btn-outline-primary btn-sm" @click.prevent="renewSubscription(sub.package)">
					<i class="fas fa-sync"></i>
					<span>Renew</span>
				</button>

				

				<button type="button" class="btn btn-outline-secondary btn-sm" @click.prevent="checkPackageDetail">
					<i class="fas fa-info-circle"></i>
					<span>Check Usage</span>
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
				
			}
		},
		created() {
			this.getSubscriptionsData({
				ClientID: 1 
			});
		},
		mounted(){

			EventBus.$on('renew-subscription', data => {
				this.success("Successfully Renewed")

				let element = this.$refs.packageInfoModal.$el;
				$(element).modal("hide");
			});
		},
		components: {
			PackageInfo,
			PackageDetail
		},
		computed: {

			...mapGetters(["getSubscriptions", "getPackageId", "getPackageName", "getPackageServices"])
		},
		methods: {
			...mapActions(["getSubscriptionsData"]),
			renewSubscription(subscription_package){

				let element = this.$refs.packageInfoModal.$el;
				$(element).modal("show");

				this.$store.commit('setPackageId', subscription_package.id)
				this.$store.commit('setPackageName', subscription_package.name)
				this.$store.commit('setPackageServices', subscription_package.services)

			},
			checkPackageDetail(){

				let element = this.$refs.packageDetailModal.$el;

				$(element).modal("show");
			}
		}
	}

</script>