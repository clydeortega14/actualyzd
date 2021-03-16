	const custom_calendar = new CustomCalendar;
	const schedule = new Schedule;
	const bookings = {
		initialize(){

			this.events();
			this.construct();
		},
		construct(){
			
		},
		events(){

			$(window).on('load', (e) => {

				console.log(schedule)

				let calendarOptions = {
					editable: true,
			      	navLinks:  true,
			      	selectable:  true,
			      	dayMaxEvents: true, // allow "more" link when too many events
			      	events: schedule.get()
				}

				custom_calendar.render(calendarOptions);
			})
		},

	}
	bookings.initialize();