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
            });

            const arr_schedule_time = [];


            $(function(){

              const token = $('meta[name="csrf-token"]').attr('content');
              let $start_date_input = $('input[name="start_date"]');
              let $end_date_input = $('input[name="end_date"]');

              $(document).on('click', '.check-time', function(e){

                let time_id = e.target.value;
                let index = arr_schedule_time.findIndex(sched_time => sched_time == time_id);

                if(e.target.checked){
        
                  if(index > -1){

                    // console.log('found')

                  }else{

                    // console.log('not found')
                    // add time_id to array of time
                    arr_schedule_time.push(parseInt(time_id));
                  }
                  // console.log(index)

                }else{

                  arr_schedule_time.splice(index, 1);
                }

              });



              $('#schedule-form').on('submit', function(e){

                e.preventDefault();

                $.ajax({

                  url: '/psychologist/schedule',
                  method: 'POST',
                  data: {
                    _token: token,
                    start_date: $start_date_input.val(),
                    end_date: $end_date_input.val(),
                    time_lists: arr_schedule_time
                  },
                  success: function(response){

                    Swal.fire('Success!', response, 'success');
                    $('#create-schedule').modal('hide');

                  },
                  error: function(err){
                    Swal.fire('Oops!', 'Something went wrong!', 'error');
                  }

                })


              });


            });

            function handleSelect(arg)
            {
              let parsedClickDate = date_parser.parseDate(arg.start);
              let parsedCurrentDate = date_parser.parseDate(new Date());

              if(parsedClickDate < parsedCurrentDate){ 

                Swal.fire('Oops!', 'this date is not available', 'warning');
               
              }else{

                $('#create-schedule').modal('show');
                $('.start-date').val(arg.startStr);
                $('input[name="end_date"]').val(arg.endStr);
                $('#create-schedule-modal-label').text(date_parser.formatDate(arg.start))
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
                      handleSchedulesTable(data);
                });
              }
                
            }



            function handleTimeList(data)
            {
                  let time_schedules = data.schedules;
                  let $schedules_time_lists = $('#schedules-time-lists');

                  $schedules_time_lists.empty();

                  // iterate time_list to be displayed
                  data.time_lists.forEach((time, index) => {

                    // declared local variables for checked and disabled
                    let checked;
                    let disabled;

                    // find time schedules time that equals to time lists id
                    let sched = time_schedules.findIndex(time_sched => time_sched.time_id == time.id);

                    
                    
                    // if found schedule is not equal to undefined
                    if(sched !== -1) {
                      // assinged to checked
                      checked = 'checked';

                      let findBookedSchedule = time_schedules.find(time_sched => time_sched.time_id === time.id)

                      // check if shed has already a booking
                      if(findBookedSchedule.is_booked){
                        // assign to disabled
                        disabled = 'disabled';
                      }
                    }


                    $schedules_time_lists.append(schedulesTimeListTemp(time, checked, disabled));
                  })
            }

            function readOnlyCheckbox()
            {
              return false
            }

            function handleSchedulesTable(data)
            {
                  let $schedules_table_body = $('#schedules-table');
                  $schedules_table_body.empty()
                  data.schedules.forEach((schedule, index) => {
                    $schedules_table_body.append(scheduleDetailsTemp(schedule));
                    arr_schedule_time.push(schedule.time_id);
                  });
            }

            function schedulesTimeListTemp(time, checked, disabled)
            {
                return `
                  <tr>
                    <td>
                      <div class="form-check">
                        <input type="checkbox" id="time${time.id}" name="time_lists[]" value="${time.id}" ${checked} ${disabled} class="form-check-input check-time" />
                        <label for="time${time.id}" class="form-check-label"></label>
                      </div>
                    </td>
                    <td align="right">${ date_parser.convertTime(time.from) } - ${ date_parser.convertTime(time.to) }</td>
                  </td>
                `
            }
            function counselingTimeListTemp(time)
            {
                return `
                  <div class="form-check mb-3">
                    <input type="radio" id="counseling${time.id}" name="time" value="${time.id}" class="form-check-input" />
                    <label for="counseling${time.id}" class="form-check-label">${ date_parser.convertTime(time.from) } - ${ date_parser.convertTime(time.to) }</label>
                  </div>
                `
            }
            function scheduleDetailsTemp(schedule)
            {
                return `
                  <tr>
                      <td style="width: 30%;">
                        ${ date_parser.convertTime(schedule.time_list.from) } - ${ date_parser.convertTime(schedule.time_list.to) }
                      </td>
                      <td style="width: 10%;">
                        <span class="badge ${schedule.is_booked ? 'badge-primary' : 'badge-success'}">${schedule.is_booked ? schedule.booking.to_status.name : 'Available'}</span>
                      </td>
                      <td style="width: 20%;">
                        ${ schedule.booking != null ? schedule.booking.session_type.name : ''}
                      </td>
                      <td>${ schedule.booking != null && schedule.booking.counselee != null ? schedule.booking.to_counselee.name : ''}</td>
                      <td style="width: 20%;">`
                      if(schedule.is_booked || schedule.booking !== null){
                        `
                          <a href="#" class="btn btn-primary btn-sm">
                            <i class="fa fa-eye"></i>
                            <span>view booking</span>
                          </a>
                        `
                      }
                      ` 
                      </td>
                  </tr>
                  `
            }
      </script>

@endsection