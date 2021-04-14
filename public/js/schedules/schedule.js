const custom_ajax = new Ajax;

class Schedule {

	get(){

		// Define array schedules
		let schedules = [];

		// request schedules from server
		custom_ajax.asyncAwait({
				url: '/psychologist/schedules',
				method: 'GET',
				async: false
			}).done( res => {
					// assign map arrays in schedules array
					schedules = res.map(object => {
			          return {
			            id: object.id,
			            start: object.start,
			            end: object.end,
			            display: 'background',
			            color: 'green'
			        }
				})
			
			});

			// return schedule
			return schedules;

	}
	getPsychologists(date, time){
		custom_ajax.asyncAwait({
			url: '/psychologist/available',
			method: 'GET',
			data: {
				start: date,
				time: time
			},
			async: false
		}).done(data => {

			$('#psychologist-row').html(data)
		});
	}
}