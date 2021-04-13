	const custom_calendar = new CustomCalendar;
	const schedule = new Schedule;
	const ajax = new Ajax;
	const bookings = {
		initialize(){

			this.construct();
			this.dom();
			this.render();
			this.events();
		},
		construct(){
			// for global variables
			this.booking_date = '';
		},
		render(){

			// by default pick a time component, psychologist component
			// and onboarding questions component must be hide
			this.$pick_a_time_component.hide();
			this.$psychologist_component.hide();
			this.$onboarding_questions_component.hide();


		},
		events(){
			let booking_date = this.$start_date.val();
			const _this = this;

			$(window).on('load', (e) => {

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

			      		}else{

			      			_this.$pick_a_time_component.hide();
			      		}
			      	}
				}

				custom_calendar.render(calendarOptions);


				// bookings schedule
				ajax.request({

					url: '/bookings',
					method: 'GET',
				}).done(data => {
					this.$bookings_table.html(data)
				});
			})
			// Pick a Time
			this.$time_list.change(function(e){
				e.preventDefault();

				let time_id = $(this).val();
				if(booking_date === ""){
					Swal.fire("Warning", "Kindly select first a date!", "warning")
					$(this).prop("checked", false);
				}else{
					// request data from the server
					schedule.getPsychologists(booking_date, time_id);
				}

			});

			// Show Questionnaires by category
			this.$category.change(function(e){

				let id = $(this).find('option:selected').val();
				ajax.request({
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
			this.$category_questionnaire = $('#category-questionnaire');
			this.$start_date = $('input[name="start_date"]');
			this.$bookings_table = $('#bookings-table');
			this.$pick_a_time_component = $('#pick-a-time-component');
			this.$psychologist_component = $('#psychologist-component');
			this.$onboarding_questions_component = $('#onboarding-questions-component');
		}

	}
	bookings.initialize();