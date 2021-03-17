	const custom_calendar = new CustomCalendar;
	const schedule = new Schedule;
	const bookings = {
		initialize(){

			this.construct();
			this.dom();
			this.events();
		},
		construct(){
			// for global variables
			this.booking_date = '';
		},
		events(){
			let booking_date = "";

			$(window).on('load', (e) => {

				let calendarOptions = {
					editable: true,
			      	navLinks:  true,
			      	selectable:  true,
			      	dayMaxEvents: true, // allow "more" link when too many events
			      	events: schedule.get(),
			      	select(arg){
			      		booking_date = arg.startStr;
			      	}
				}

				custom_calendar.render(calendarOptions);
			})
			const _this = this;
			// Pick a Time
			this.$time_list.change(function(e){
				e.preventDefault();

				let time_id = $(this).val();
				if(booking_date === ""){
					Swal.fire("Warning", "Kindly select first a date!", "warning")
				}else{
					
					// request data from the server
					schedule.getPsychologists(booking_date, time_id);
				}

			});
		},
		dom(){
			this.$time_list = $('input[name="time"]');
			this.$psychologist_row = $('#psychologist-row')
		}

	}
	bookings.initialize();