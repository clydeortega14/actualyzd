class CustomCalendar {

  constructor(){
    this.calendar;
  }

  render(options)
  {
    let calendarEl = document.getElementById('calendar');
    this.calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialView: 'dayGridMonth',
      editable: options.editable,
      navLinks: options.navLinks,
      selectable: options.selectable,
      dayMaxEvents: options.dayMaxEvents, // allow "more" link when too many events
      events: options.events,
      select: options.select

    });

    this.calendar.render();
  }
}
// // Jquery Events for calendar
// $(document).ready(function(){

//   $(document).on('change', 'input[name="time"]', function(e){

//       e.preventDefault();

//       let value = $(this).val();
//       let start = $('.start-date').val();

//       $.ajax({
//         url: '/psychologist/available',
//         method: 'GET',
//         data: {
//           start: start,
//           time: value
//         },
//         success:function(data){

//           let $available_psychologist = $('#psychologist-available');

//           $available_psychologist.empty();
//           $available_psychologist.html(data);

//         },
//         error: function(error){
//           console.log(error)
//         }
//       })

//   })
// })

  