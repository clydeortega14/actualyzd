class DateParser {

	/*
	 * formats a date into Y-m-d
	*/
	parseDate(date)
	{
		let day = ("0" + date.getDate()).slice(-2);
    	let month = ("0" + (date.getMonth() + 1)).slice(-2);
    	let today = date.getFullYear()+"-"+(month)+"-"+(day);

    	return today;
	}

	/*
	 * fortmats time into 00:00:00
	*/
	parseTime(date)
	{
		let hour = ("0" + date.getHours()).slice(-2);
      	let minutes = ("0" + date.getMinutes()).slice(-2);
      	let seconds = ("0" + date.getSeconds()).slice(-2);

     	return hour+":"+minutes+":"+seconds;
	}
	/*
	 * Converts 24 hour format to 12 hour
	*/
	convertTime(time)
	{
		// Check correct time format and split into components
	    time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

	    if (time.length > 1) { // If time format correct
	      time = time.slice (1);  // Remove full string match value
	      time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
	      time[0] = +time[0] % 12 || 12; // Adjust hours
	    }

	    return time.join (''); // return adjusted time or original string
	}

	amPm(date)
	{
		var hours = date.getHours();
	    var minutes = date.getMinutes();
	    var ampm = hours >= 12 ? 'pm' : '';
	    hours = hours % 12;
	    hours =  hours ? hours : 12; // hour 0 should be 12
	    minutes = minutes < 10 ?  '0'+minutes : minutes;
	    var strTime = hours+':'+minutes+' '+ampm

	    return strTime;
	}

	formatDate(date)
	{
		var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
		
		return date.toLocaleDateString("en-US", options)
		
	}
}