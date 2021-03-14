	const custom_calendar = new CustomCalendar;
	const custom_ajax = new Ajax;
	const bookings = {
		initialize(){

			this.events();
		},
		getSchedules(){

			

		},
		events(){

			$(window).on('load', (e) => {

				let schedules = this.getSchedules();

				let calendarOptions = {
					editable: true,
			      	navLinks:  true,
			      	selectable:  true,
			      	dayMaxEvents: true, // allow "more" link when too many events
			      	events: schedules
				}

				custom_calendar.render(calendarOptions);
			})
		},

	}
	bookings.initialize();