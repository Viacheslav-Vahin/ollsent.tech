jQuery(document).ready(function ($) {
    //alert('hhh88');
    // $( function() {
    //     $( "#datepicker" ).datepicker();
    // } );
    $.datepicker.regional['uk'] = {
        closeText: 'Закрыть',
        prevText: 'Предыдущий',
        nextText: 'Следующий',
        currentText: 'Сьогодні',
        monthNames: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
        monthNamesShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Серп', 'Вер', 'Жов', 'Лис', 'Гру'],
        dayNames: ['неділя', 'понеділок', 'вівторок', 'среда', 'четвер', 'пя\'тниця', 'субота'],
        dayNamesShort: ['нед', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
        dayNamesMin: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['uk']);

    var holidays = [
        [1, 1],
        [7, 1],
        [23, 2],
        [8, 3],
        [1, 5],
        [9, 5],
        [12, 6],
        [4, 11]
    ];

    $(function () {
        $("#datepicker").datepicker({
            beforeShowDay: function (date) {
                for (var i = 0; i < holidays.length; i++) {
                    if (holidays[i][0] == date.getDate() && holidays[i][1] - 1 == date.getMonth()) {
                        return [false];
                    }
                }
                return [true];
            }
        });
    });
    $('#cp').on('click', 'a', function () {
        alert('ff88');
        $(this).append(`
<input type="text" class="calendInp">
<input type="text" class="calendInp">
                `);
    });

    function calendarTime() {
        $('.ui-datepicker td[data-month="8"] a').append(`
<input type="text" class="calendInp">
<input type="text" class="calendInp">
<input type="text" class="calendInp">
<input type="text" class="calendInp">
                `);
        $('.ui-datepicker td[data-month="8"] a').on('click', function () {
            // alert('ff55');
        });
        // $('.ui-datepicker-inline td[data-month="8"] a.ui-state-default').on('click', function () {
        //     alert('ff77');
        // });
        $('#cp').on('click', '.t1', function () {
            $('.ui-datepicker.ui-widget td a').css('background-color', 'red');
            alert('ff88');
            $(this).append(`
<input type="text" class="calendInp">
<input type="text" class="calendInp">
                `);
        });
        // $('#datepicker').click(function(e) {
        //     var $target = $(e.target);
        //     if ($target.hasClass("ui-state-default")) {
        //         alert('ff9');
        //     }
        // });


        // $('.ui-datepicker.ui-widget td[data-month="8"]').prepend(`
        //         <p class="chosenVal1">rrrrr</p>`);

        // $('.ui-datepicker.ui-widget td[data-month="8"]').html(5555);
        // $('.ui-datepicker.ui-widget td[data-month="8"]').css('background-color', 'red');

    }

    setTimeout(calendarTime, 1000);


    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultDate: '2016-12-12',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'All Day Event',
                start: '2016-12-01'
            },
            {
                title: 'Long Event',
                start: '2016-12-07',
                end: '2016-12-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2016-12-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2016-12-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2016-12-11',
                end: '2016-12-13'
            },
            {
                title: 'Meeting',
                start: '2016-12-12T10:30:00',
                end: '2016-12-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2016-12-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2016-12-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2016-12-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2016-12-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2016-12-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'https://google.com/',
                start: '2016-12-28'
            }
        ]
    });
});