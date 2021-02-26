Main();

function Main(){

  //declare global variable
  let schedules = [];
  let calendar;
  let date_parser = new DateParser;

  // Render Calender
  getEvents();
  
  function getEvents()
  {
    $.ajax({
      url: '/psychologist/schedules',
      method: 'GET',
      success: function(res){
        schedules = res.map(object => {
          return {
            id: object.id,
            start: object.start,
            end: object.end,
            display: 'background',
            color: 'green'
          }
        })

        renderCalendar(schedules)

      },
      error: function(error){
        console.log(error)
      }
    })
    
    return schedules;
  }
  /* Initialize Calender */
  function renderCalendar(schedules)
  {
      var calendarEl = document.getElementById('calendar');
      var now = new Date();

      calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialDate: date_parser.parseDate(now),
      weekNumbers: true,
      editable: true,
      navLinks: true,
      selectable: true,
      businessHours: true,
      dayMaxEvents: true, // allow "more" link when too many events
      select(arg){

        $('#create-schedule').modal('show');
        $('.start-date').val(arg.startStr);
        $('#create-schedule-modal-label').text(arg.startStr)
        $('#psychologist-available').empty();

        // Request time list first to server
        $.ajax({
          url: `/psychologist/time-schedules`,
          method: 'GET',
          data: {
            start: arg.startStr
          },
          success: function(data){

            let $schedules_time_lists = $('#schedules-time-lists');
            let $schedules_table_body = $('#schedules-table');
            let $counseling_time_lists = $('#counseling-time-lists');


            $schedules_time_lists.empty();
            $counseling_time_lists.empty();


            data.time_lists.forEach((time, index) => {

              let checked;
              let sched = data.schedules.find(schedule => schedule.time.id === time.id);

              if(sched !== undefined) checked = 'checked';

              $schedules_time_lists.append(schedulesTimeListTemp(time, checked));

              $counseling_time_lists.append(counselingTimeListTemp(time));
              
            });

            $schedules_table_body.empty();
            // Schedules Table
            data.schedules.forEach((schedule, index) => {
              console.log(schedule)
              $schedules_table_body.append(scheduleDetailsTemp(schedule));
            })
            
          },
          error: function(error)
          {
            console.log(error)
          }
        });
        
        calendar.unselect()
      },
      events: schedules

    });

    calendar.render();
  }

  function schedulesTimeListTemp(time, checked)
  {
    return `
      <div class="form-group">
        <input type="checkbox" id="time${time.id}" name="time_lists[]" value="${time.id}" ${checked} />
        <label for="time${time.id}">${ date_parser.convertTime(time.from) } - ${ date_parser.convertTime(time.to) }</label>
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
            ${ date_parser.convertTime(schedule.time.from) } - ${ date_parser.convertTime(schedule.time.to) }
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
  
}

// Jquery Events for calendar
$(document).ready(function(){

  $(document).on('change', 'input[name="time"]', function(e){

      e.preventDefault();

      let value = $(this).val();
      let start = $('.start-date').val();

      $.ajax({
        url: '/psychologist/available',
        method: 'GET',
        data: {
          start: start,
          time: value
        },
        success:function(data){

          let $available_psychologist = $('#psychologist-available');

          $available_psychologist.empty();
          $available_psychologist.html(data);

        },
        error: function(error){
          console.log(error)
        }
      })

  })
})

  