var Calendar = {
	init: () => {
		console.log('init');
		
		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'dayGrid' ],
			eventSources: [
				{
					url: "/workout-events",
					type: "POST",
					data: {
						filters: {},
					},
					error: () => {
							// alert("There was an error while fetching FullCalendar!");
					},
				},
			],
			allDayDefault: true,
			dateClick: function(info) {
				alert('Clicked on: ' + info.dateStr);
				alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
				alert('Current view: ' + info.view.type);
				// change the day's background color just for fun
				info.dayEl.style.backgroundColor = 'red';
			}
		});
		
		calendar.render();
	}
}

Calendar.init();