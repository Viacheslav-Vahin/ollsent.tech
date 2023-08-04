jQuery(document).ready(function ($) {



    $(".fc-dayGridMonth-button").click(function () {
        $('.fc-daygrid-event').prepend('<button type="submit" class="sendNot1">x</button>');
        $('.fc-daygrid-event').prepend('<span class="dashicons dashicons-edit-large ceit"></span>');
    });

    let evbos = $('.fc-daygrid-day-events');
    // function btnDelay() {
        $('a.fc-daygrid-event').on( 'click', function( event ){

          //  event.stopPropagation(); // остановка всех текущих JS событий
            event.preventDefault(); 
        });
        $('.fc-daygrid-event').prepend('<button type="submit" class="sendNot1">x</button>');
        $('.fc-daygrid-event').prepend('<span class="dashicons dashicons-edit-large ceit"></span>');
    // }
    //  setTimeout(btnDelay, 300);
    
    // $("#calendar").on("click", '.sendNot1', gcClick.bind(this));
    // function gcClick(e)
    // {
    //     let evid = $(e.target).closest(".fc-daygrid-event").children('.eid').html();
    //     let idnbr = parseInt(evid, 10);
    //     $('#ff2').load(surl6 + "/wp-content/themes/devport/assets/gogleCalendar/php/cdell.php", {
    //         id: idnbr
    //     });
    //      console.log(idnbr);
    // }


    const surl6 = $('#surl6').html();


    // ================================== full calendar init =======================
    let event_start = $('#event_start');
    let event_end = $('#event_end');
    let event_type = $('#event_type');
    let calendarEl = $('#calendar');
    let form = $('#dialog-form');
    let event_id = $('#event_id');
    let format = "MM/dd/yyyy HH:mm";


    $(function(){
        $("#date4").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#d4").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        // $("#datepicker1").datetimepicker({hourGrid: 4, minuteGrid: 10, dateFormat: 'yy-mm-dd'});
    });
    $("#add1").click(function () {
        let et = $('#title3').val();
        let es = $('#start3').val();
        let ee = $('#end3').val();
        let esotr = $('#sotr3').val();
        let usrID = $('#sotr3').find(':selected').data('usrid');
        let edescr = $('#det1').val();

        let ed = $('#date4').val();
        let estart1 = $('#st1').val();
        let estart11 = $('#st11').val();
        let st = estart1 + ':' + estart11 + ':00';

        let eend1 = $('#end2').val();
        let eend2 = $('#end21').val();
        let et1 = eend1 + ':' + eend2 + ':00';
        $('#ff2').load(surl6 + "/wp-content/themes/devport/assets/gogleCalendar/php/ci.php", {
            // t: et, s: es, e: ee, eso: esotr
            t: et, d:ed, s1: st, e1: et1, eso: esotr, de:edescr, uid: usrID
        });
        $('#add_event').css('display', 'none');
       // console.log(st);
    });
    $("#add4").click(function () {
        // e.preventDefault();
        let currid = $('#uid4').val();
        let currt = $('#title4').val();
        let currdet = $('#det4').val();
        let csotr = $('#sotr4').val();
        let currs = $('#strt4').val() + ':' + $('#strt42').val();
        let currend1 = $('#e_4').val();
        if (currend1 == '') {
            $('#ff2').load(surl6 + "/wp-content/themes/devport/assets/gogleCalendar/php/cupd.php", {
                id: currid, t: currt, det: currdet, sotr: csotr, st: currs
            });
        } else {
            let currend2 = $('#e_42').val();
            if (currend2 == '') {
                currend2 = '00';
            }
            let curre = currend1 + ':' + currend2;
            $('#ff2').load(surl6 + "/wp-content/themes/devport/assets/gogleCalendar/php/cupd.php", {
                id: currid, t: currt, det: currdet, st: currs, end: curre
            });
        }

         console.log(currend1);

    });
    $(".sendNot1").click(function (e) {
            let evid = $(e.target).closest(".fc-daygrid-event").children('.eid').html();
            let idnbr = parseInt(evid, 10);
        $(e.target).closest(".fc-daygrid-event").slideUp('fast');
            $('#ff2').load(surl6 + "/wp-content/themes/devport/assets/gogleCalendar/php/cdell.php", {
                id: idnbr
            });
             // console.log(idnbr);fc-daygrid-day-events

    });
    $("#otmena").click(function () {
        $('#add_event').css('display', 'none');
    });
    $(".ceit").on( 'click', function(e) {
        let currid = $(e.target).closest(".fc-daygrid-event").children('.eid').html();
        let currt = $(e.target).closest(".fc-daygrid-event").children('.fc-event-title').html();
        let cs1 = $(e.target).closest(".fc-daygrid-event").children('.fc-event-time').html().substring(0, 2);
        parseInt(cs1, 10)
        let cs2 = $(e.target).closest(".fc-daygrid-event").children('.fc-event-time').html().substring(3);
        if (cs2 == '') {
            cs2 = '00';
        }
        parseInt(cs2, 10)
        //let currs = cs1 + ':' + cs2;
        // let currs = $(e.target).closest(".fc-daygrid-event").children('.fc-event-time').html();
        let currend = $(e.target).closest(".fc-daygrid-event").children('.fc-event-title').html();
        let currurl = $(e.target).closest(".fc-daygrid-event").children('.fc-event-title').html();
        let currsotr = $(e.target).closest(".fc-daygrid-event").children('.sotrudnik').html();
        let currdet = $(e.target).closest(".fc-daygrid-event").children('.det').html();
        let currdate = $(e.target).closest(".fc-daygrid-day").data('date');
         //console.log(currdet);
     // console.log(currs);
        $('#title4').val(currt);
        if (currsotr != null) {
            $('#sotr4').val(currsotr);
        }
        $('#strt4').val(cs1);
        $('#strt42').val(cs2);
        $('#d4').val(currdate);
        $('#uid4').val(currid);
        $('#det4').val(currdet);

        // let eupdatet = $('#title4').val();
        // let eupdates = $('#start4').val();
        // let eupdatee = $('#end4').val();
        // let eupdatesotr = $('#sotr4').val();
        //
        // $('#ff2').load(surl6 + "/wp-content/themes/devport/assets/gogleCalendar/php/ci.php", {
        //     t: eupdatet, s: eupdates, e: eupdatee, eso: eupdatesotr
        // });
        $('#add_event').css('display', 'none');
        $('#upd_event').css('display', 'block');
    });
    $("#otmena4").click(function () {
        $('#upd_event').css('display', 'none');
    });
    function gcDelay() {
        $('.sotrudnik:contains("null")').css('display', 'none');
        $('#calendar a[href="null"]').attr("href","#");
    }
    setTimeout(gcDelay, 100);
    $('#add_event_button').click(function () {
        $('#add_event').css('display', 'block');
    });
    $('.fc-dayGridMonth-view a.fc-daygrid-dot-event.fc-event').click(function (e) {
        e.preventDefault();
        return false;
    });
    // $('.fc-today-button').html('сегодня')
    $(document).on('click',function(e){
        if(!(($(e.target).closest("#add_event").length > 0 ) || ($(e.target).closest("#add_event_button").length > 0))){
            $("#add_event").hide();
        }
        if(!(($(e.target).closest("#upd_event").length > 0 ) || ($(e.target).closest(".ceit").length > 0))){
            $("#upd_event").hide();
        }
    });

    // ============================================================
    
    //  $("#sotr3").on( 'click', function(e) {
    //      let details = document.getElementById("sotr3").find(':selected').data('usrID');
    // //  let allData = details;
    // //  let ledger_id = allData[0];
    // //  let ledger_credit = allData[1];
    // // //  console.log(ledger_id);
    // // //  console.log(ledger_credit);
    // //  console.log(allData);
    // console.log(details);
    //  });
     $("#sotr3").change(function () {
      //  alert($(this).find(':selected').data('usrid'));
        let usrID = $(this).find(':selected').data('usrid');
        console.log(usrID);
   }); 
});
