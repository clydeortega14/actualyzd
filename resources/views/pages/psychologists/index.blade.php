@extends('layouts.sb-admin.master')

@section('css_links')
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">
@endsection

@section('content')
	
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="schedules-tab" data-toggle="tab" href="#schedules" role="tab" aria-controls="schedules" aria-selected="false">Schedules</a>
                </li>
                <li class="nav-item" role="presentation">
                      <a class="nav-link" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="true">Bookings</a>
                </li>
                <li class="nav-item" role="presentation">
                      <a class="nav-link" id="progress-reports-tab" data-toggle="tab" href="#progress-reports" role="tab" aria-controls="progress-reports" aria-selected="false">Progress Reports</a>
                </li>
          </ul>

          <div class="tab-content">
                <div class="tab-pane fade show active" id="schedules" role="tabpanel" aria-labelledby="schedules-tab">
                      <div class="mt-4">
                            <div class="row">
                                  <div class="col-md-12">
                                        <div id="calendar"></div>
                                        @include('pages.schedules.modals.create-schedule')
                                  </div>
                            </div>
                      </div>
                </div>
          	<div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
          		<div class="mt-4">
          			<div class="row justify-content-center">
          				<div class="col-md-12">
                    <div class="table-responsive">
                        @include('pages.bookings.index')
                    </div>
          				</div>
          			</div>
          		</div>
          	</div>
          	<div class="tab-pane fade" id="progress-reports" role="tabpanel" aria-labelledby="progress-reports-tab">
          		<div class="mt-4">
          			<div class="row">
          				<div class="col-md-12">
          					<div class="table-responsive">
          						<table class="table table-bordered">
          							<thead>
          								<tr>
          									<th>Timestamp</th>
          									<th>Date Of Session</th>
          									<th>Company Name</th>
          									<th>Employee Name</th>
          									<th>Main Concern</th>
          									<th>Current prescriptions and over the counter</th>
          									<th>Initial Assessment / Impression</th>
          									<th>Recommended for follow up session</th>
          									<th>Intervention Plan / Treatment Goal:</th>
          								</tr>
          							</thead>
          						</table>
          					</div>
          				</div>
          			</div>
          		</div>
          	</div>
                
          </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection
@section('js_scripts')

      <script type="text/javascript" src="{{ asset('assets/fullcalendar/js/main.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/schedules/schedule.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>
      <script src="{{ asset('assets/fullcalendar/js/bookings.js') }}"></script>
      <script>

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
                        let disabled;
                  let sched = data.schedules.find(schedule => schedule.time === time.id);
                  
                  if(sched !== undefined) {

                    checked = 'checked';
                    if(sched.status.status === 'booked'){
                      disabled = 'disabled';
                    } 
                  }

                    $schedules_time_lists.append(schedulesTimeListTemp(time, checked, disabled));
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

            function schedulesTimeListTemp(time, checked, disabled)
            {
                return `
                <div class="col-sm-3">
                  <div class="form-group">
                    <input type="checkbox" id="time${time.id}" name="time_lists[]" value="${time.id}" ${checked} ${disabled} />
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