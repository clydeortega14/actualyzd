<template>
	<div class="row">
		<div class="col-md-3">

			<!-- Client Lists -->
			<ClientList />
			
		</div>

		<div class="col-md-9">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">Summary</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="utilization-tab" data-toggle="tab" href="#utilization" role="tab" aria-controls="utilization" aria-selected="false">Utilization</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="concerns-tab" data-toggle="tab" href="#concerns" role="tab" aria-controls="concerns" aria-selected="false">Concerns</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
            	
            	<!-- Summary Tab Pane -->
           		<div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">            
            		<Summary />
            	</div>

            	<!-- Utilization Tab -->
            	<div class="tab-pane fade" id="utilization" role="tabpanel" aria-labelledby="utilization-tab">
            		<Utilization />
            	</div>

            	<!-- Concerns Tab -->
            	<div class="tab-pane fade" id="concerns" role="tabpanel" aria-labelledby="concerns-tab">
            		<Concern />
            	</div>
            	<!-- End Concerns Tab-->


            </div>
		</div>
	</div>
</template>


<script>

	// Components
	import ClientList from './ClientList';
	import Summary from './Summary';
	import Utilization from './Utilization';
	import Concern from './Concern';

	// Vuex
	import { mapGetters, mapActions } from 'vuex';
	
	export default {

		name: "ServiceUtilization",
		components: {
			ClientList,
			Summary,
			Utilization,
			Concern
		}
	}
</script>