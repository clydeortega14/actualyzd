<template>
	<div>
		<div class="row mt-3 mb-3">
            <div class="col-md-4 col-xs-12" v-for="service in allServices" :key="service.id">
                <div class="card mb-3">
                    <div class="card-body text-center text-primary">
                        <h5 class="text-primary">{{ service.name }}</h5>
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
	</div>
</template>



<script>
    

    import { mapGetters, mapActions } from 'vuex';
    import ServiceUtilization from '../../mixins/service-utilization.js';

    export default {

        name: "ServiceCard",
        mixins: [ ServiceUtilization ],
        created(){
            this.serviceUtilization()
        },
        computed: {

            ...mapGetters(['allServices'])
        },
        methods: {

            ...mapActions(['serviceUtilization'])
        }
    }

</script>