$(document).ready(function(){
    function calendar() {
        $.ajax({
            type: 'GET',
            url: 'ajax-events',
            success: function(data) {
                var locations = JSON.parse(data.models);
                var events = JSON.parse(data.events);
                var eventsArray = [];
                function registerEvent(event){
                    var event = {
                        name: event['title'],
                        location: event['title'],
                        start: event['start_date'],
                        end: event['end_date']
                    }
                    eventsArray.push(event);
                }
                events.forEach(registerEvent);

                function startOfMonth()
                {  
                    var today = new Date();
                    return new Date(today.getFullYear(), today.getMonth(), 1);
                }

                function endOfMonth(){
                    var today = new Date();
                    return new Date(today.getFullYear(), today.getMonth()+1, 0);
                }

                var mySchedule = $('#callendar-container').skedTape({
                    caption: 'Events',
                    start: startOfMonth(),
                    end: endOfMonth(),
                    showEventTime: true,
                    showEventDuration: true,
                    scrollWithYWheel: true,
                    locations: locations,
                    events: eventsArray,
                    formatters: {
                        date: function (date) {
                            return $.fn.skedTape.format.date(date, 'l', '.');
                        },
                        duration: function (start, end, opts) {
                            return $.fn.skedTape.format.duration(start, end, {
                                hrs: 'ч.',
                                min: 'мин.'
                            });;
                        },
                    }
                });
            }
        });
    };
    calendar();
});