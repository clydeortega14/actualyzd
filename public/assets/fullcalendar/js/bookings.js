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

			// Show Questionnaires by category
			this.$category.change(function(e){

				let id = $(this).find('option:selected').val();
				let ajax_request = new Ajax;
				ajax_request.request({
					url: `/set-up/assessment/categories/${id}`,
					method: 'GET'
				}).done(data => {

					_this.$category_questionnaire.html(data)
				})
			});

		},
		dom(){
			this.$time_list = $('input[name="time"]');
			this.$psychologist_row = $('#psychologist-row');
			this.$category = $('select[name="category"]');
			this.$category_questionnaire = $('#category-questionnaire')
		}

	}
	bookings.initialize();