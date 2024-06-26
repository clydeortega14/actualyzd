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
                <li class="nav-item">
                      <a class="nav-link {{ isset($schedules) ? 'active' :'' }}" href="{{ route('psychologist.home') }}">Schedules</a>
                </li>
                <li class="nav-item">
                      <a class="nav-link {{ isset($bookings) ? 'active' : ''}}" href="{{ route('psychologist.bookings') }}">Bookings</a>
                </li>
                <li class="nav-item" role="presentation">
                      <a class="nav-link {{ isset($reports) ? 'active' : ''}}" href="{{ route('psychologist.progress.reports') }}">Progress Reports</a>
                </li>
            </ul>

          <div class="tab-content">
            @if(isset($schedules))
              <div class="tab-pane fade show active">
                    <div class="mt-4">
                          <div class="row">
                                <div class="col-md-12">
                                      <div id="calendar"></div>
                                      @include('pages.schedules.modals.create-schedule')
                                </div>
                          </div>
                    </div>
              </div>
            @endif

            @if(isset($bookings))
            	<div class="tab-pane fade show active">
            		<div class="mt-4">
            			<div class="row justify-content-center">
            				<div class="col-md-12">
                      {{-- <bookings-lists></bookings-lists> --}}
                      {{-- <div class="table-responsive">
                          @include('pages.bookings.index')
                      </div>
 --}}            				</div>
            			</div>
            		</div>
            	</div>
            @endif

            @if(isset($reports))
              <div class="tab-pane fade show active">
                <div class="mt-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Timestamp</th>
                              <th>Date of session</th>
                              <th>Company</th>
                              <th>Employee</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($reports as $report)
                              <tr>
                                <td>{{ $report->booking->time->parseTimeFrom().' - '.$report->booking->time->parseTimeTo() }}</td>
                                <td>{{ $report->booking->toSchedule->formattedStart() }}</td>
                                <td>{{ $report->booking->toClient->name }}</td>
                                <td>
                                  @if(count($report->booking->participants) > 0)
                                    @foreach($report->booking->participants as $participant)
                                      <span>{{ $participant->name }}</span>
                                    @endforeach
                                  @endif
                                </td>
                                <td></td>
                              </tr>

                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            @endif
                
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
            const new_schedule = new Schedule;

            window.addEventListener('load', (event) => {

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