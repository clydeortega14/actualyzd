<template>
	<div class="row mt-4 mb-4">
        <div class="col-md-3">
            <div class="card mb-3" v-for="total in totalMainConcerns" :key="total.main_concern.id">
                <div class="card-header">
                    <div class="text-xs text-uppercase mb-1">
                        {{ total.main_concern.name }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h1 mb-0 text-gray-800 text-center">{{ total.main_concerns_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<div class="col-md-9">
            <!--  Consulation service -->
            <div class="card mb-3">
                <div class="card-header">
                    Consultation Service
                </div>

                <div class="card-body">
                    <div class="d-sm-flex justify-content-end mb-3">
                        <div class="form-group">
                            <select name="concern" class="form-control" @change="selectMainConcern" v-model="selected_main_concern">
                                <option disabled selected :value="null">All Categories</option>
                                <option v-for="concern in concernsLists" :key="concern.id" :value="concern.id">
                                    {{ concern.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Main Concerns</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="summary in mainConcernSummarries" :key="summary.id">
                                    <td>{{ summary.to_schedule.start }}</td>
                                    <td>{{ summary.main_concern.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  end Consulation service -->
             <div class="card mb-3">
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
                                <tr v-for="(main_concern_by_date, index) in mainConcernsByDate" :key="index">
                                    <td>{{ main_concern_by_date.name }}</td>
                                    <td>{{ main_concern_by_date.mtd }}</td>
                                    <td>{{ main_concern_by_date.qtd }}</td>
                                    <td>{{ main_concern_by_date.ytd }}</td>
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
		name: "Concern",
        data(){

            return {
                selected_main_concern: null
            }
        },
        created(){
            this.serviceUtilization()
        },
        computed: {
            ...mapGetters([
                "totalMainConcerns", 
                "mainConcernSummarries", 
                "concernsLists",
                "mainConcernsByDate"
            ])
        },
        methods: {
            ...mapActions(["serviceUtilization"]),
            selectMainConcern(){
                this.serviceUtilization({
                    params: {
                        main_concern: this.selected_main_concern
                    }
                })
            }
        }

	}
</script>