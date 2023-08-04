jQuery(document).ready(function ($) {
    let kanbanJS = function(){
        let cu5 = $('#cf').val();
        $('#cf').css('color', 'red');

        // $(`
        //  <form action="send1.php" method="post">
        //  <input class="projectName" type="text" name="proj" placeholder="Название проекта">
        //  <input class="taskName" type="text" name="taskName" placeholder="Задание">
        //  <input class="taskSubmit" type="submit" value="Submit">
        //  </form>
        // <p class="sendNote">Уведомить</p>
        // `).appendTo(".col-task-assigned").hide().slideDown();

        $('.sendNote').on("click", sendNote1.bind(this));
        function sendNote1(e) {
            let currEmpl = $(e.target).closest(".col-task-assigned");
            let currProj = $(e.target).closest(".task");

            currEmpl.addClass('w11');
            currProj.addClass('w12');
            let w11Val = $('.w11 .task-assigned-name').html().trim();
            let w12Email = $('.w12 .tan').html().trim();
            let w12Project = $('.w12 .task-project > div:first-child').html().trim();
            let w12Task = $('.w12 .task-title').html().trim();
            $('.w12 .projectName').val(w12Project);
            let knonce =$('#kanban_nonce').val();
            // console.log(w11Val);
            // console.log(w12Email);
            // console.log(w12Project);
            // console.log(w12Task);
            let newNotif = {
                'title': w11Val,
                'k_email': w12Email,
                'k_proj': w12Project,
                'k_task': w12Task,
                'status': 'publish'
            }
            // $.ajax({
            //     beforeSend: (xhr) => {
            //         xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            //     },
            //     // url: devportData.root_url + '/wp-json/wp/v2/rekomend/',
            //     url: 'http://localhost:8080/devport/wp-json/wp/v2/notiajax/1069',
            //     type: 'DELETE',
            //     // processData : false,
            //     // cache: false,
            //     // processData: false, // important
            //     // contentType: false, // important
            //     // dataType : 'json',
            //     data: newNotif,
            //     success: (response) => {
            //
            //         console.log("OK:)");
            //     },
            //     error: (response) => {
            //         // console.log("Sory((");
            //         console.log(response);
            //     }
            // });
            // let cu5 = $('#cf').val();
            //  console.log(cu5);
            console.log(newNotif);
            console.log(knonce);
            // console.log(devportData.cb);
            alert('nn4');
            currEmpl.removeClass('w11');
            currProj.removeClass('w12');
        }
        // $('.grey_bg').css('background-color', 'yellow')
    };
    setTimeout(kanbanJS, 100);
})
// let cp = window.location.href;
// console.log(cp);
// if (cp==='http://localhost:8080/devport/kabinet/') {
//     // alert('5+5');
//     function stopExecut() {
//         return;
//     }
//     stopExecut();
// }
// $('.ktmess').submit(function() {
//     // alert('dd33');
//     //     $.ajax({
//     //         type: 'POST',
//     //         url: 'send1.php',
//     //         data: { username: 4,
//     //                 password: 44 }
//     //     });
//     //     return false;
//      return false;
//     }); 