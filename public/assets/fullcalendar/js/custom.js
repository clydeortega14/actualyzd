Main();

function Main(){

  //declare global variable
  let schedules = [];
  let calendar;

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

  /* Parse Date */
  function parseDate(date)
  {
    var day = ("0" + date.getDate()).slice(-2);
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var today = date.getFullYear()+"-"+(month)+"-"+(day);

    return today;
  }

  /* Parse Time */
  function parseTime(date)
  {
      var hour = ("0" + date.getHours()).slice(-2);
      var minutes = ("0" + date.getMinutes()).slice(-2);
      var seconds = ("0" + date.getSeconds()).slice(-2);

      return hour+":"+minutes+":"+seconds;
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
      initialDate: parseDate(now),
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

              if(sched !== undefined){

                checked = 'checked';
              }
              

              $('#time-lists').append(`
                  <div class="form-group">
                    <input type="checkbox" id="time${time.id}" name="time_lists[]" value="${time.id}" ${checked}/>
                    <label for="time${time.id}">${time.from} - ${time.to}</label>
                  </div>
                `)
              
            })
            
          },
          error: function(error)
          {
            console.log(error)
          }
        })
        // must show timelist



        $('#title').val("");
        $('#start-time').val("");
        $('#end-date').val("");
        $('#end-time').val("");
        $('.sched-id').val("");
        $('#div-delete').hide();
        $('#allDay').prop('checked', false);
        
        calendar.unselect()
      },
      eventClick(arg){

          let mySched = schedules.find(sched => sched.id == arg.event.id);
          let split_start = mySched.start.split(" ");
          let split_end = mySched.end.split(" ");
          let start_date = split_start[0];
          let start_time = split_start[1];
          let end_date = split_end[0];
          let end_time = split_end[1];

          $('#create-schedule').modal('show');
          $('#title').val(mySched.title)
          $('#start-date').val(start_date)
          $('#start-time').val(start_time)
          $('#end-date').val(end_date)
          $('#end-time').val(end_time)
          $('.sched-id').val(mySched.id)
          $('#div-delete').show();
          mySched.allDay == 1 ? $('#allDay').prop('checked', true) : $('#allDay').prop('checked', false);

      },
      events: schedules

    });

    calendar.render();
  }
}
  