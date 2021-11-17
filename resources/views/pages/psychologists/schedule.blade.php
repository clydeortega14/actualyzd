@extends('layouts.sb-admin.master')

@section('css_links')
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/fullcalendar/css/main.css') }}">
@endsection

@section('content')
	
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
      <div id="calendar"></div>
				{{-- <div class="card">
					<div class="card-body">
					</div>
				</div> --}}
			</div>
		</div>
	</div>
	
@include('pages.schedules.modals.create-schedule')
@endsection
@section('js_scripts')

      <script type="text/javascript" src="{{ asset('assets/fullcalendar/js/main.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/date.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/schedules/schedule.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/fullcalendar/js/custom.js') }}"></script>
      <script src="{{ asset('assets/fullcalendar/js/bookings.js') }}"></script>
      <script>

            const date_parser = new DateParser;
            const new_schedule = new Schedule;

            window.addEventListener('load', (event) => {

                  let calendarOptions = {

                      //   headerToolbar: {
                      //     left: 'prev,next today',
                      //     center: 'title',
                      //     right: 'dayGridMonth'
                      // },
                        editable: true,
                        navLinks:  true,
                        selectable:  true,
                        dayMaxEvents: true, // allow "more" link when too many events
                        events: new_schedule.get(),
                        select(arg){
                            handleSelect(arg)
                        }
                  }

                  custom_calendar.render(calendarOptions);
            })

            function handleSelect(arg)
            {
                $('#create-schedule').modal('show');
                $('.start-date').val(arg.startStr);
                $('input[name="end_date"]').val(arg.endStr);
                $('#create-schedule-modal-label').text(arg.startStr)
                $('#psychologist-available').empty();
                let dom_list = $('.time-lists');

                custom_ajax.asyncAwait({
                      url: '/psychologist/time-schedules',
                      method: 'GET',
                      async: false,
                      data: {
                            start: arg.startStr
                      }
                }).done(data => {
                      handleTimeList(data);
                      // handleSchedulesTable(data);
                })
            }

            function handleTimeList(data)
            {
                  let time_schedules = data.schedules !== null ? data.schedules.time_schedules : [];
                  let $schedules_time_lists = $('#schedules-time-lists');

                  $schedules_time_lists.empty();

                  // iterate time_list to be displayed
                  data.time_lists.forEach((time, index) => {

                    // declared local variables for checked and disabled
                    let checked;
                    let disabled;

                    // find time schedules time that equals to time lists id
                    let sched = time_schedules.find(time_sched => time_sched.time == time.id);
                    
                    // if found schedule is not equal to undefined
                    if(sched !== undefined) {
                      // assinged to checked
                      checked = 'checked';

                      // check if shed has already a booking
                      if(sched.is_booked){
                        // assign to disabled
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