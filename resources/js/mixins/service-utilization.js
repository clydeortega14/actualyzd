export default {

	methods: {

		getPercentage(increase, original){
			let decimal_number = (increase/original) * 100;
			return Math.round(decimal_number)
		}
	}
}