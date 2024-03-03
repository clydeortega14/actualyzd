import moment from 'moment';

export default {

	methods: {
		wholeDate(date)
		{
			return moment(date).format('LL');
		},
		wholeTime(time)
		{
			return moment(time, "HH:mm:ss").format('LT');
		},
		monthsOfTheYear()
		{
			return Array.apply(0, Array(12)).map(
				function(_,i){
					return `${moment().year()} - ${moment().month(i).format('MMM')}`
				}
			)
		}
	}
}