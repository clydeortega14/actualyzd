import moment from 'moment';
export default {

	methods: {
		wholeDate(date)
		{
			return moment(date).format('LLLL');
		},
		wholeTime(time)
		{
			return moment(time, "HH:mm:ss").format('LT');
		},
	}
}