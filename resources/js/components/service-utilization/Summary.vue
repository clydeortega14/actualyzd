<template>
	<div class="row mt-3 mb-3">
		<div class="col-md-3" v-for="service in allServices" :key="service.id">
            <div class="card">
                <div class="card-body text-center text-info">
                    <h5 class="text-info">{{ service.name }}</h5>
                    <div class="mt-4">
                        <span>{{ getPercentage(service.bookings.length, service.limit) }} %</span>
                        <div class="d-sm-flex justify-content-around mt-3">
                            <div>{{ service.limit }}</div>
                            <div class="border-right"></div>
                            <div>{{ service.bookings.length }}</div>
                        </div>

                        <div class="d-sm-flex justify-content-around mt-3">
                            <div>Limit</div>
                            <div></div>
                            <div>Usage</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	
</template>


<script>
	
	import { mapGetters, mapActions } from 'vuex';

	export default {
		name: "Summary",
		created(){
			this.serviceUtilization()
		},
		computed: {

			...mapGetters(['allServices'])
		},
		methods: {

			...mapActions(['serviceUtilization']),
			getPercentage(increase, original){
				return (increase/original) * 100;
			}
		}
	}
</script>