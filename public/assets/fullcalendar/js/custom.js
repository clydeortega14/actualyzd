Main();

function Main(){

    //declare global variable
    let schedules = [];

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
            title: object.title,
            start: object.start,
            end: object.end,
          }
        })
      },
      error: function(error){
        console.log(error)
      }
    })
    
    return schedules;
  }

  function parseDate()
  {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day);

    return today;
  }

  function renderCalendar(){

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialDate: parseDate(),
      weekNumbers: true,
      editable: true,
      navLinks: true,
      selectable: true,
      businessHours: true,
      dayMaxEvents: true, // allow "more" link when too many events
      select: function(arg) {
        
        $('#start-date').val(arg.startStr)

        $('#create-schedule').modal('show')
        
        // var title = prompt('Event Title:');
        // if (title) {
        //   calendar.addEvent({
        //     title: title,
        //     start: arg.start,
        //     end: arg.end,
        //     allDay: arg.allDay
        //   })
        // }
        calendar.unselect()
      },
      events: schedules
    });

    calendar.render();
  }
}
  