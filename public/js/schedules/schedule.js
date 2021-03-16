const custom_ajax = new Ajax;

class Schedule {

	get(){

		custom_ajax.asyncAwait({
				url: '/psychologist/schedules',
				method: 'GET',
				async: false
			}).done( res => {
				let schedules = [];
				schedules = res.map(object => {
		          return {
		            id: object.id,
		            start: object.start,
		            end: object.end,
		            display: 'background',
		            color: 'green'
		        }
			})
			return schedules;
			});

	}
}