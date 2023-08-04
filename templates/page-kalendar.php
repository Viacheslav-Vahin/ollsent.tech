<?php
/*
Template Name: Календарь
*/
//if (!current_user_can('administrator') && !current_user_can('editor')) {
//    wp_redirect(esc_url(site_url('/')));
//    exit;
//}
if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
acf_form_head();
get_header();
?>
<div class="dp_cont kalendar">
<!--<div class="dp_cont kalendar">-->
    <div id="cu7" class="dnone"><?php echo get_current_user_id(); ?></div>
    <span id="surl6" class="dnone"><?php echo get_site_url() ?></span>
    <div id="loadRes5"></div>
    <h3 id="ff2"></h3>
    <button id="add_event_button">Добавити подію</button>
    <!--    <div id="dialog-form" title="Событие">-->
    <!--        <form>-->
    <!--            <p>-->
    <!--                <label for="event_type">событие</label>-->
    <!--                <input type="text" id="event_type" name="event_type" placeholder="событие"></p>-->
    <!--            <p>-->
    <!--                <label for="event_start">Начало</label>-->
    <!--                <input type="text" name="event_start" id="event_start" placeholder="Начало" /></p>-->
    <!--            <p>-->
    <!--                <label for="event_end">Конец</label>-->
    <!--                <input type="text" name="event_end" id="event_end" placeholder="Конец" /></p>-->
    <!--            <input type="hidden" name="event_id" id="event_id" value="">-->
    <!--        </form>-->
    <!--    </div>-->
    <div id="add_event" class="cform">
        <form>
            <!--                <input type="text" id="datepicker1" placeholder="Выберите дату">-->
            <p><input type="text" id="title3" name="title3" placeholder="Назва події" autocomplete="off"></p>

            <select name="" id="sotr3">
                <option value="">Виберіть співпрацівника</option>
                <?php
                $posts = get_posts(array(
                    'numberposts' => -1,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'post_type' => 'sotrudniki',
                    // 'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ));

                foreach ($posts as $post) {
                    setup_postdata($post); ?>
<!--                    --><?php //acf_form(); ?>
                    <!--                    <input type="text" class="tname" value="--><?php //the_title() ?><!--">-->

                    <option data-usrID="<?php $uid = get_the_ID(); echo $uid; ?>" value="<?php the_title(); ?>"><?php the_title(); ?></option>
                    <?php
                }

                wp_reset_postdata(); // сброс
                ?>
            </select>

<!--            <p><input type="datetime-local" name="event_start" id="start3" placeholder="Начало"/></p>-->
<!--            <p><input type="datetime-local" name="event_end" id="end3" placeholder="Конец"/></p>-->
            <p><input type="text" name="event_date" id="date4" placeholder="День события"  autocomplete="off" /></p>
            <p><select id="st1">
                    <option value="">час початку</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                </select>
                <select id="st11">
                    <option value="">хвилини начала</option>
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select></p>
            <p><select id="end2">
                    <option value="">час кінця</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                </select>
                <select id="end21">
                    <option value="">хвилини кіньця</option>
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select></p>
            <textarea id="det1" name="story" rows="3" cols="33" placeholder="Деталі"></textarea>
<!--            <input type="hidden" name="event_id" id="event_id" value="">-->
            <button type="submit" id="add1">Добавити</button>
            <button type="button" id="otmena">Відміна</button>
<!--            <button id="edit1">Изменить</button>-->
<!--            <button id="cancel1">Отмена</button>-->
<!--            <button id="delete1">Удалить</button>-->
        </form>
    </div>
    <div id="upd_event" class="cform">
        <form>
            <!--                <input type="text" id="datepicker1" placeholder="Выберите дату">-->
            <input type="text" id="uid4"  class="dnone" name="uid4" placeholder="id">
            <p><input type="text" id="title4" name="title4" placeholder="Назва події" autocomplete="off" ></p>

            <select name="" id="sotr4">
                <option value="">Виберіть співпрацівника</option>
                <?php
                $posts = get_posts(array(
                    'numberposts' => -1,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'post_type' => 'sotrudniki',
                    // 'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ));

                foreach ($posts as $post) {
                    setup_postdata($post); ?>
                    <!--                    --><?php //acf_form(); ?>
                    <!--                    <input type="text" class="tname" value="--><?php //the_title() ?><!--">-->

                    <option value="<?php the_title() ?>"><?php the_title() ?></option>
                    <?php
                }

                wp_reset_postdata(); // сброс
                ?>
            </select>

<!--            <p><input type="time" name="event_start" id="start4" placeholder="Начало"/></p>-->
<!--            <p><input type="datetime-local" name="event_end" id="end4" placeholder="Конец"/></p>-->
            <p><input type="text" name="event_date" id="d4" placeholder="День" autocomplete="off" /></p>
            <p><select id="strt4">
                    <option value="">час початку</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                </select>
            <select id="strt42">
                    <option value="">хвилини початку</option>
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select></p>
            <p><select id="e_4">
                    <option value="">час кінця</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                </select>
                <select id="e_42">
                    <option value="">хвилини кіньця</option>
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select></p>
            <textarea id="det4" name="story" rows="3" cols="33"></textarea>
<!--            <input type="hidden" name="event_id" id="event_id" value="">-->
            <button type="submit" id="add4">Обновити</button>
            <button type="button" id="otmena4">Відміна</button>
            <!--            <button id="edit1">Изменить</button>-->
            <!--            <button id="cancel1">Отмена</button>-->
            <!--            <button id="delete1">Удалить</button>-->
        </form>
    </div>
    <div id='wrap'>

        <div id='external-events'>


            <div id='external-events-list'>

            </div>


        <p>
<!--            <input type='text' id='input-event' class="form-control"/>-->
            <button type="button" id="add-event" class="btn btn-primary mt-2">add event</button>
        </p>
    </div>

    <div id='calendar-wrap'>
        <div id='calendar'></div>
    </div>

</div>

<!--    <div id='calendar'></div>-->
<!--    <div id='calendar-container'>-->
<!--        <div id='calendar' class="goodleC"></div>-->
<!--    </div>-->

<!--    <div class="mecTimer">-->
<!--        --><?php //echo do_shortcode('[MEC id="1054"]'); ?>
<!--    </div>-->
<!--    --><?php //echo do_shortcode('[MEC id="1047"]'); ?>

<script>
    let ev1 = document.getElementById('external-events-list');
    let input = document.getElementById('input-event');
    let btn1 = document.getElementById('add-event');
    // document.addEventListener('DOMContentLoaded', function () {

        /* initialize the external events
        -----------------------------------------------------------------*/

        // let containerEl = document.getElementById('external-events-list');
        // new FullCalendar.Draggable(containerEl, {
        //     itemSelector: '.fc-event',
        //     eventData: function (eventEl) {
        //         return {
        //             title: eventEl.innerText.trim()
        //         }
        //     }
        // });
        // btn1.addEventListener('click', function () {
        //     let div = document.createElement('div');
        //     let inval = document.createTextNode(input.value);
        //     let inval2 = document.createTextNode(input.value);
        //     div.className = 'fc-event';
        //     div.append(inval);
        //     // div.append('<p>test11</p>');
        //     ev1.appendChild(div);
        // })


        //// the individual way to do it
        // var containerEl = document.getElementById('external-events-list');
        // var eventEls = Array.prototype.slice.call(
        //   containerEl.querySelectorAll('.fc-event')
        // );
        // eventEls.forEach(function(eventEl) {
        //   new FullCalendar.Draggable(eventEl, {
        //     eventData: {
        //       title: eventEl.innerText.trim(),
        //     }
        //   });
        // });

        /* initialize the calendar
        -----------------------------------------------------------------*/

        let siteURL = document.getElementById('surl6').innerText;
        console.log(siteURL + '/wp-content/themes/devport/assets/gogleCalendar/php/cget.php');
        // console.log(siteURL);
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // customButtons: {
            //     myCustomButton: {
            //         text: 'custom!',
            //         click: function() {
            //             alert('clicked the custom button!');
            //         }
            //     }
            // },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            // timeZone: 'Ukraine/Kiev',
            // locales: ['idLocale'],
            nowIndicator: true,
            weekNumbers: true,
            // weekNumberCalculation: 'ISO',
            allDaySlot: true,
            locale: 'ru',
            firstDay: 1,
            slotLabelInterval: 15,
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            droppable: true, // this allows things to be dropped onto the calendar
            // selectable: true,
            // selectHelper: true,
           // slotDuration: '00:15:00',

            // eventRender: function(event, element) {
            //     element.find(".fc-event-title").remove();
            //     element.find(".fc-event-time").remove();
            //     let new_description =
            //             moment(event.start).format("HH:mm") + '-'
            //             + moment(event.end).format("HH:mm") + '<br/>'
            //             + event.sotr5 + '<br/>'
            //             + '<strong>Address: </strong><br/>' + event.sotr5 + '<br/>'
            //         // + '<strong>Task: </strong><br/>' + event.task + '<br/>'
            //         // + '<strong>Place: </strong>' + event.place + '<br/>'
            //     ;
            //     element.append(new_description);
            // },

            // dayClick: function() {
            //     alert('day clicked');
            //     console.log('day clicked');
            // },

            // select: function (start, end, allDay)
            // {
            //     //alert('hihi2');
            //     let title = prompt("Напишите назву таска");
            //     if (title) {
            //         // let start = $.fullCalendar.formatDate()
            //         alert('hihi3');
            //     }
            // },
            select: function (arg) {
                let title = prompt('Напишите назву таска');
                // let start1 = document.getElementById('datepicker1').valueOf();
                let start1 = document.getElementById('event_start').value;
                let end1 = document.getElementById('event_end').value;
                let url1 = document.getElementById('surl6').innerHTML;
                let url2 = url1.concat('/wp-content/themes/devport/assets/gogleCalendar/php/cinsert.php');
                if (title) {
                    calendar.addEvent({
                        title: title,
                        start: start1,
                        end: end1
                    });

                    // request.send(params);

                    // $.ajax({
                    //     type: "POST",
                    //     url: url2,
                    //     data: {
                    //         start: start1,
                    //         end: end1,
                    //         title: title
                    //     }
                    // });
                }
                calendar.unselect()
            },
            eventResize: function (info) {
                // alert(info.event.title + " end is now " + info.event.end.toISOString());

                // if (!confirm("is this okay?")) {
                // if (!confirm("is this okay?")) {
                //     info.revert();
                // }
            },
            drop: function (arg) {
                // is the "remove after drop" checkbox checked?
                if (document.getElementById('drop-remove').checked) {
                    // if so, remove the element from the "Draggable Events" list
                    arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                }
            },
            eventSources: [

                {
                    url: siteURL + '/wp-content/themes/devport/assets/gogleCalendar/php/cget.php',
                   // url: 'http://localhost:8080/devport/wp-content/themes/devport/assets/gogleCalendar/php/cget.php',
                    // url: 'http://localhost:8080/devport/wp-content/themes/devport/assets/js/gc1.php',
                    type: 'GET',
                    data: {},
                    error: function () {
                        alert('There was an error while fetching events!');
                    }
                }
            ],

            // events: siteURL + "/wp-content/themes/devport/assets/js/gc1.php",

            //  events: "http://localhost:8080/devport/wp-content/themes/devport/assets/js/gc1.php",

            //  events: 'http://localhost:8080/devport/wp-content/themes/devport/assets/js/testa.json',
            // events: 'loadC.php',

            // events:
            //    {
            // url: 'loadC.js'
            // url: 'http://localhost:8080/devport/wp-content/themes/devport/assets/gogleCalendar/php/loadC.js'
            // url: 'http://localhost:8080/devport/wp-content/themes/devport/assets/gogleCalendar/php/get-events.php',
            //      url: 'http://localhost:8080/devport/wp-content/themes/devport/assets/js/testa.json',
            //      failure: function() {
            //          document.getElementById('script-warning').style.display = 'block'
            //      }
            // },

            //  loading: function(bool) {
            //      document.getElementById('loading').style.display =
            //          bool ? 'block' : 'none';
            // }

            //     [
            //     {
            //         title: 'All Day Event',
            //         start: '2021-09-01'
            //     },
            //     {
            //         title: 'Long Event',
            //         start: '2021-09-07',
            //         end: '2021-09-10'
            //     },
            //     {
            //         groupId: 999,
            //         title: 'Repeating Event',
            //         start: '2021-09-09T16:00:00'
            //     },
            //     {
            //         groupId: 999,
            //         title: 'Repeating Event',
            //         start: '2021-09-16T16:00:00'
            //     },
            //     {
            //         title: 'Conference',
            //         start: '2021-10-11',
            //         end: '2021-10-13'
            //     },
            //     {
            //         title: 'Meeting',
            //         start: '2021-10-12T10:30:00',
            //         end: '2021-09-12T12:30:00'
            //     },
            //     {
            //         title: 'Lunch',
            //         start: '2021-09-12T12:00:00'
            //     },
            //     {
            //         title: 'Meeting',
            //         start: '2021-09-12T14:30:00'
            //     },
            //     {
            //         title: 'Happy Hour',
            //         start: '2021-09-12T17:30:00'
            //     },
            //     {
            //         title: 'Dinner',
            //         start: '2021-09-12T20:00:00'
            //     },
            //     {
            //         title: 'Birthday Party',
            //         start: '2021-09-13T07:00:00'
            //     },
            //     {
            //         title: 'Click for Google',
            //         url: 'http://google.com/',
            //         start: '2021-09-28'
            //     },
            //     {
            //         title: 'Happy Hour',
            //         start: '2021-09-29T17:30:00'
            //     },
            //     {
            //         title: 'Meeting1',
            //         start: '2021-09-30T10:30:00',
            //         end: '2021-09-30T12:30:00'
            //     },
            //         {
            //             title: 'Meeting2',
            //             start: '2021-09-30T10:30:00',
            //             end: '2021-09-30T12:30:00'
            //         },
            //         {
            //             title: 'Meeting3',
            //             start: '2021-09-30T10:30:00',
            //             end: '2021-09-30T12:30:00'
            //         }
            // ]
        });
        calendar.render();
        // calendar.addEvent({
        //     title: 'Add Event....5',
        //     start: '2021-09-30',
        //     // allDay: true
        //     end: '2021-10-01T12:30:00',
        //     sotr: 'Юрий Галыч'
        // });


</script>
<style>

    body {
        margin-top: 40px;
        font-size: 14px;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    }

    #external-events {
        /*position: fixed;*/
        left: 20px;
        top: 140px;
        width: 375px;
        padding: 0 10px;
        border: 1px solid #ccc;
        background: #eee;
        text-align: left;
        display: none;
    }

    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
        margin-bottom: 15px;
    }

    #external-events .fc-event {
        margin: 3px 0;
        cursor: move;
        padding: 5px 5px 0 5px;
    }

    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
    }

    #external-events .c_descr_task, #external-events .c_descr_task_div p {
        margin: 0;
        /*font-size: 11px;*/
        color: #fff;
        margin-bottom: 5px;
    }

    #external-events p input {
        margin: 0;
        vertical-align: middle;
    }

    #calendar-wrap {
        margin-left: 20px;
    }

    #calendar {
        /*max-width: 1100px;*/
        margin: 0 auto;
    }

    #calendar-wrap {
        width: 1255px;
    }

    .fc-scroller.fc-scroller-liquid-absolute {
        overflow-y: hidden !important;
    }

    /*#wrap {*/
    /*    display: flex;*/
    /*}*/

</style>
</div>
<?php
if(is_user_logged_in() && current_user_can('publish_clients')) { ?>
<article class="popup_form addVac">
    <div class="popup_bgr" data-popup="close"></div>
    <div class="popup_box">
        <div class="pop_box_inn">
            <button type="button" class="close-modal" data-popup="close">×</button>
            <h3 class="cloud-title">Створити вакансію</h3>
            <section>
                <div class="customContainer1">
                    <section class="p_form">
                        <?php acf_form(array(
                            'post_title' => true,
                            'post_content' => true,
                            'submit_value' => __('Зберегти зміни')
                        )); ?>
            </section>

        </div>
    </div>
</article>
<?php }
if (is_user_logged_in() && current_user_can('publish_freelancers')) { 
get_template_part('template-parts/formAddCand'); }
get_footer(); ?>
