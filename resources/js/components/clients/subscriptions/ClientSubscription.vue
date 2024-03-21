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
				<button type="button" class="btn btn-outline-primary btn-sm" @click.prevent="renewSubscription">
					<i class="fas fa-sync"></i>
					<span>Renew</span>
				</button>
				<button type="button" class="btn btn-outline-secondary btn-sm">
					<i class="fas fa-info-circle"></i>
					<span>Details</span>
				</button>
			</div>
		</div>

		<PackageInfo ref="packageInfoModal" />
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';
	import PackageInfo from '../../modals/PackageInfo.vue';
	import DateTime from '../../../mixins/datetime.js';

	export default {
		name: "ClientSubscription",
		mixins: [ DateTime ],
		data(){
			return {
				
			}
		},
		created() {
			this.getSubscriptionsData({
				ClientID: 1 
			});
		},
		components: {
			PackageInfo
		},
		computed: {

			...mapGetters(["getSubscriptions"])
		},
		methods: {
			...mapActions(["getSubscriptionsData"]),
			renewSubscription(){

				let element = this.$refs.packageInfoModal.$el;
				$(element).modal("show");

			}
		}
	}

</script>