@extends('layouts.sb-admin.master')

@section('css_links')

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">

@endsection

@section('content')

	<div class="container" id="main-index">

		<div class="row">
	        <div class="col-sm-12">
	            <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                        @include('pages.schedules.modals.create-schedule')
                    </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection

@section('js_scripts')

	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>
	<script>
		
		const custom_calendar = new CustomCalendar;
		const custom_ajax = new Ajax;
		const date_parser = new DateParser;
		let schedules = [];

		window.addEventListener('load', (event) => {

			getSchedules();

			let calendarOptions = {

				headerToolbar: {
			        left: 'prev,next today',
			        center: 'title',
			        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
			    },
				editable: true,
		      	navLinks:  true,
		      	selectable:  true,
		      	dayMaxEvents: true, // allow "more" link when too many events
		      	events: schedules,
		      	select(arg){
		      		handleSelect(arg)
		      	}
			}

			custom_calendar.render(calendarOptions);
		})

		function getSchedules()
		{
			custom_ajax.asyncAwait({
				url: '/psychologist/schedules',
				method: 'GET',
				async: false
			}).done( res => {
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

		function handleSelect(arg)
		{
			$('#create-schedule').modal('show');
        	$('.start-date').val(arg.startStr);
        	$('#create-schedule-modal-label').text(arg.startStr)
        	$('#psychologist-available').empty();

        	custom_ajax.asyncAwait({
        		url: '/psychologist/time-schedules',
        		method: 'GET',
        		async: false,
        		data: {
        			start: arg.startStr
        		}
        	}).done(data => {
        		console.log(data)
            	handleTimeList(data);
            	handleSchedulesTable(data);
        	})
		}

		function handleTimeList(data)
		{
			let $schedules_time_lists = $('#schedules-time-lists');

			$schedules_time_lists.empty();
			data.time_lists.forEach((time, index) => {
				let checked;
              	let sched = data.schedules.find(schedule => schedule.time === time.id);
	            if(sched !== undefined) checked = 'checked';
	            $schedules_time_lists.append(schedulesTimeListTemp(time, checked));
			})
		}

		function handleSchedulesTable(data)
		{
			let $schedules_table_body = $('#schedules-table');
			$schedules_table_body.empty()
			data.schedules.forEach((schedule, index) => {
              $schedules_table_body.append(scheduleDetailsTemp(schedule));
            })
		}

		function schedulesTimeListTemp(time, checked)
		{
		    return `
		    <div class="col-sm-3">
		      <div class="form-group">
		        <input type="checkbox" id="time${time.id}" name="time_lists[]" value="${time.id}" ${checked} />
		        <label for="time${time.id}">${ date_parser.convertTime(time.from) } - ${ date_parser.convertTime(time.to) }</label>
		      </div>
		    </div>
		    `
		}
		function counselingTimeListTemp(time)
		{
			console.log(time)
		    return `
		      <div class="form-group">
		        <input type="radio" id="counseling${time.id}" name="time" value="${time.id}" class="with-gap" />
		        <label for="counseling${time.id}">${ date_parser.convertTime(time.from) } - ${ date_parser.convertTime(time.to) }</label>
		      </div>
		    `
		}
	 	function scheduleDetailsTemp(schedule)
	  	{

		    return `
		      <tr>
		          <td>
		            ${ date_parser.convertTime(schedule.to_time.from) } - ${ date_parser.convertTime(schedule.to_time.to) }
		          </td>
		          <td>${schedule.book_with === null ? 'N/A' : schedule.book_with.name}</td>
		          <td>
		            <span class="${schedule.status.class}">${schedule.status.status}</span>
		          </td>
		          <td>
		            <a href="#" class="btn btn-warning btn-xs">Reschedule</a> |
		            <a href="#" class="btn btn-danger btn-xs">Cancel</a>
		          </td>
		      </tr>
		      `
	  	}
	</script>

@endsection