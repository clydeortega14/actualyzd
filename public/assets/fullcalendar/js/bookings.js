	const custom_calendar = new CustomCalendar;
	const schedule = new Schedule;
	const ajax = new Ajax;

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
			let booking_date = this.$start_date.val();
			const _this = this;

			// Calendar
			$(window).on('load', (e) => {

				// get schedules
				let schedules = schedule.get();

				let calendarOptions = {
					editable: true,
			      	navLinks:  true,
			      	selectable:  true,
			      	dayMaxEvents: true, // allow "more" link when too many events
			      	events: schedules,
			      	select(arg){
			      		let foundSched = schedules.findIndex(sched => sched.start == arg.startStr);

			      		if(foundSched !== -1){

			      			// meaning a schedule is found and there are available psychologist
			      			_this.$pick_a_time_component.show();
			      			booking_date = arg.startStr;
			      			_this.$start_date.val(booking_date);

			      			// get time by date
			      			_this.getTimeByDate(arg.startStr);

			      		}else{
			      			_this.$psychologist_component.hide();
			      			_this.$pick_a_time_component.hide();
			      			_this.$onboarding_questions_component.hide();
			      			_this.$btn_submit_booking.hide();
			      		}
			      	}
				}

				custom_calendar.render(calendarOptions);


				// // bookings schedule
				// ajax.request({

				// 	url: '/bookings',
				// 	method: 'GET',
				// }).done(data => {
				// 	this.$bookings_table.html(data)
				// });
			})

			// Pick a Time
			$(document).on('change', 'input[name="time"]', function(e){

				e.preventDefault();

				// get value of the time selected
				let time_id = $(this).val();

				// check if booking date is empty
				if(booking_date === ""){

					Swal.fire("Warning", "Kindly select first a date!", "warning")
					$(this).prop("checked", false);

				}else{

					// Show psychologist component
					$('#psychologist-component').show();

					// request data from the server
					schedule.getPsychologists(booking_date, time_id)
				}

			});


			// Select psychologist
			$(document).on('change', 'input[name="psychologist"]', function(e){

				_this.$booking_buttons.show();
				_this.$onboarding_questions_component.show();

			});
		},
		getTimeByDate(start){

			ajax.asyncAwait({
				url: '/time-date',
				method: 'get',
				data: {
					start: start
				}
			}).done(function(response){
				// console.log(this.$time_by_date)
				$('#time-by-date').html(response);
			})
		},
		dom(){

			this.$time_list = $('input[name="time"]');
			this.$psychologist_row = $('#psychologist-row');
			this.$category = $('select[name="category"]');
			this.$category_questionnaire = $('#category-questionnaire');
			this.$start_date = $('input[name="start_date"]');
			this.$bookings_table = $('#bookings-table');
			this.$time_by_date = $('#time-by-date');
			this.$pick_a_time_component = $('#pick-a-time-component');
			this.$psychologist_component = $('#psychologist-component');
			this.$onboarding_questions_component = $('#onboarding-questions-component');
			this.$btn_submit_booking = $('#btn-submit-booking');
		}

	}

	bookings.initialize();