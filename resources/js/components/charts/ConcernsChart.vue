<script>
	
	import { Bar } from 'vue-chartjs';
	import DateTime from '../../mixins/datetime.js';


	export default {

		name: "ConcernsChart",
		mixins: [ Bar, DateTime ],
		data(){

			return {

				chartData: null,
				chartOptions: null
			}
		},
		mounted(){
			this.renderChartData()
		},

		methods: {

			async renderChartData()
			{

				const response = await axios.post(`/api/consultations/chart/data`);
				
				this.chartData = {
					labels: [],
					datasets: []

					// {
					// 	label: "Mental Challenges",
					// 	data: [10, 15, 17, 20],
					// 	backgroundColor: 'rgba(51, 51, 255, 0.2)',
					// 	borderColor: 'rgba(51, 51, 255, 0.2)',
					// 	borderWidth: 1,
					// },

					// {
					// 	label: "Suicidal Intent",
					// 	data: [8, 10, 12, 16],
					// 	backgroundColor: 'rgba(255, 128, 0, 0.2)',
					// 	borderColor: 'rgba(255, 128, 0, 0.2)',
					// 	borderWidth: 1,
					// },

					// {
					// 	label: "Wellbeing Issues",
					// 	data: [11, 14, 17, 23],
					// 	backgroundColor: 'rgba(160, 160, 160, 0.2)',
					// 	borderColor: 'rgba(160, 160, 160, 0.2)',
					// 	borderWidth: 1,
					// }
				}

				this.chartOptions = {

					scales: {
			            xAxes: [{
			                stacked: true
			            }],
			            yAxes: [{
			                stacked: true
			            }]
			        }
				};

				if(response.data.success)
				{
					this.chartData.datasets = response.data.data.datasets;
					this.chartData.labels = this.monthsOfTheYear();
					this.renderChart(this.chartData, this.chartOptions);
				}
			}
		}
	}
</script>