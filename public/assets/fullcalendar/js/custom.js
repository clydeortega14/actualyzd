Main();

function Main(){

  //declare global variable
  let schedules = [];
  let calendar;
  let date_parser = new DateParser;

  // Render Calender
  getEvents();
  renderCalendar()

  
  function getEvents()
  {
    $.ajax({
      url: '/psychologist/schedules',
      method: 'GET',
      async: false,
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
      },
      error: function(error){
        console.log(error)
      }
    })
    
    return schedules;
  }
  /* Initialize Calender */
  function renderCalendar()
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
        $('#start-date').val(arg.startStr);

        // Request time list first to server
        $.ajax({
          url: `/psychologist/time-schedules`,
          method: 'GET',
          data: {
            start: arg.startStr
          },
          success: function(data){

            $('#time-lists').empty()

            data.time_lists.forEach((time, index) => {

              let checked;
              let sched = data.schedules.find(schedule => schedule.time === time.id);

              if(sched !== undefined) checked = 'checked';

              $('#time-lists').append(`
                <div class="form-group">
                  <input type="checkbox" id="time${time.id}" name="time_lists[]" value="${time.id}" ${checked} />
                  <label for="time${time.id}">${date_parser.convertTime(time.from)} - ${date_parser.convertTime(time.to)}</label>
                </div>
              `)
              
            });
            
          },
          error: function(error)
          {
            console.log(error)
          }
        })

        $('#title').val("");
        $('#start-time').val("");
        $('#end-date').val("");
        $('#end-time').val("");
        $('.sched-id').val("");
        $('#div-delete').hide();
        $('#allDay').prop('checked', false);
        
        calendar.unselect()
      },
      events: schedules

    });

    calendar.render();
  }
}
  