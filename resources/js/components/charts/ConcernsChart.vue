<script>
	
	import { Bar } from 'vue-chartjs';
	export default {

		name: "ConcernsChart",
		mixins: [ Bar ],
		mounted(){

			this.renderChart({

				labels: ["2020-Sept", "2020-Oct", "2020-Dec", "2021-Jan"],
				datasets: [

					{
						label: "Mental Challenges",
						data: [10, 15, 17, 20],
						backgroundColor: 'rgba(75, 192, 192, 0.2)',
						borderColor: 'rgba(75, 192, 192, 0.2)',
						borderWidth: 1
					},

					{
						label: "Suicidal Intent",
						data: [8, 10, 12, 16],
						backgroundColor: 'rgba(80, 200, 200, 0.2)',
						borderColor: 'rgba(80, 200, 200, 0.2)',
						borderWidth: 1
					},

					{
						label: "Wellbeing Issues",
						data: [11, 14, 17, 23],
						backgroundColor: 'rgba(70, 80, 80, 0.2)',
						borderColor: 'rgba(70, 80, 80, 0.2)',
						borderWidth: 1
					}
				]
			}, {})
		}
	}
</script>