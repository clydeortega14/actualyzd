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
						data: [39, 140, 120, 200],
						backgroundColor: 'rgba(75, 192, 192, 0.2)',
						borderColor: 'rgba(75, 192, 192, 0.2)',
						borderWidth: 1
					},

					{
						label: "Suicidal Intent",
						data: [10, 23, 43, 143],
						backgroundColor: 'rgba(80, 200, 200, 0.2)',
						borderColor: 'rgba(80, 200, 200, 0.2)',
						borderWidth: 1
					},

					{
						label: "Wellbeing Issues",
						data: [56, 14, 89, 26],
						backgroundColor: 'rgba(70, 80, 80, 0.2)',
						borderColor: 'rgba(70, 80, 80, 0.2)',
						borderWidth: 1
					}
				]
			}, {})
		}
	}
</script>