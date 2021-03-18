class CustomCalendar {

  constructor(){
    this.calendar;
  }

  render(options)
  {
    let calendarEl = document.getElementById('calendar');
    this.calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: options.headerToolbar,
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

  