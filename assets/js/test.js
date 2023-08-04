$('.vac_filtrs').on("change keyup", function () {
    $(".vac_item").hide().filter(function () {
        let rtnData = "";

        let regExName = new RegExp($('#vac_speciality').val().trim(), "ig");
        let regExAddName = new RegExp($('#vac_addspeciality').val().trim(), "ig");
        let regFramework = new RegExp($('#vac_framework').val().trim(), "ig");
        let regNoTech = new RegExp($('#vac_notech').val().trim(), "ig");
        let regCity = new RegExp($('.vac_city').val().trim(), "ig");
        let opyt_vacans_Val = $('#opyt_vacans_input').val();
        let zarpl_from_vac = $('#vac_zarplata_from').val();
        let zarpl_to_vac = $('#vac_zarplata_to').val();
        let vacTitle = $('.vac_title').val();

        let format1 = '';
        let format2 = '';
        let format3 = '';
        let format4 = '';

        if ($('#i1').is(':checked')) {
            format1 = $('#i1').val();
        }
        if ($('#i2').is(':checked')) {
            format2 = $('#i2').val();
        }
        if ($('#i3').is(':checked')) {
            format3 = $('#i3').val();
        }
        if ($('#i4').is(':checked')) {
            format4 = $('#i4').val();
        }

        let engl1 = '';
        let engl2 = '';
        let engl3 = '';
        let engl4 = '';
        let engl5 = '';
        let engl6 = '';
        if ($('#ve1').is(':checked')) {
            engl1 = $('#ve1').val();
        }
        if ($('#ve2').is(':checked')) {
            engl2 = $('#ve2').val();
        }
        if ($('#ve3').is(':checked')) {
            engl3 = $('#ve3').val();
        }
        if ($('#ve4').is(':checked')) {
            engl4 = $('#ve4').val();
        }
        if ($('#ve5').is(':checked')) {
            engl5 = $('#ve5').val();
        }
        if ($('#ve6').is(':checked')) {
            engl6 = $('#ve6').val();
        }
        if (zarpl_to_vac != '') {
            rtnData = (
                // $(this).attr("data-title").match(regExWord) &&
                $(this).attr("data-spec").match(regExName) &&
                $(this).attr("data-spec").match(regExAddName) &&
                $(this).attr("data-framework").match(regFramework) &&
                $(this).attr("data-notech").match(regNoTech) &&
                $(this).attr("data-city").match(regCity) &&
                $(this).data("opyt") >= opyt_vacans_Val &&
                $(this).data("zarplata") >= zarpl_from_vac &&
                $(this).data("zarplata") <= zarpl_to_vac &&
                $(this).data("work_format").match(format1) &&
                $(this).data("work_format").match(format2) &&
                $(this).data("work_format").match(format3) &&
                $(this).data("work_format").match(format4) &&
                $(this).data("angl").match(engl1) ||
                $(this).data("angl").match(engl2) ||
                $(this).data("angl").match(engl3) ||
                $(this).data("angl").match(engl4) ||
                $(this).data("angl").match(engl5) ||
                $(this).data("angl").match(engl6)

            );
        } else {
            rtnData = (
                // $(this).attr("data-title").match(regExWord) &&
                $(this).attr("data-spec").match(regExName) &&
                $(this).attr("data-spec").match(regExAddName) &&
                $(this).attr("data-framework").match(regFramework) &&
                $(this).attr("data-notech").match(regNoTech) &&
                $(this).attr("data-city").match(regCity) &&
                $(this).data("opyt") >= opyt_vacans_Val &&
                $(this).data("zarplata") >= zarpl_from_vac &&

                $(this).data("work_format").match(format1) &&
                $(this).data("work_format").match(format2) &&
                $(this).data("work_format").match(format3) &&
                $(this).data("work_format").match(format4) &&
                $(this).data("angl").match(engl1) &&
                $(this).data("angl").match(engl2) &&
                $(this).data("angl").match(engl3) &&
                $(this).data("angl").match(engl4) &&
                $(this).data("angl").match(engl5) &&
                $(this).data("angl").match(engl6)
            );
        }
        return rtnData;
    }).fadeIn('fast');
})

jQuery(document).ready(function ($) {
    let kanbanJS = function(){
        let cu5 = $('#cf').val();
        $('#cf').css('color', 'red');

        //      $(`
        //      <form action="send1.php" method="post">
        //      <input class="projectName" type="text" name="proj" placeholder="Название проекта">
        //      <input class="taskName" type="text" name="taskName" placeholder="Задание">
        //      <input class="taskSubmit" type="submit" value="Submit">
        //      </form>
        //      <p class="sendNote">Уведомить</p>
        // `).appendTo(".col-task-assigned").hide().slideDown();

        $('.sendNote').on("click", sendNote1.bind(this));
        function sendNote1(e) {
            $('.taskSubmit').slideDown('slow');
            let currEmpl = $(e.target).closest(".col-task-assigned");
            let currProj = $(e.target).closest(".task");

            currEmpl.addClass('w11');
            currProj.addClass('w12');
            let w11Val = $('.w11 .task-assigned-name').html().trim();
            let w12Email = $('.w12 .tan').html().trim();
            let w12Project = $('.w12 .task-project > div:first-child').html().trim();
            let w12Task = $('.w12 .task-title').html().trim();
            // $('.w12 .projectName').val(w12Project);
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
$(function(){$(document).ajaxComplete(function(a,b,c){try{var d=$.parseJSON(b.responseText);growl_response_message(d)}catch(a){}});var parent=$('<div style="width:50px;height:50px;overflow:auto"><div></div></div>').appendTo("body"),child=parent.children(),scrollbar_w=child.innerWidth()-child.height(99).innerWidth();parent.remove(),$(".row-statuses-wrapper").css("marginRight",scrollbar_w),new Modal_Projects($("#modal-projects")),$(document).bind("/board/tasks/done/",function(a,b){b.record.id()==current_board_id&&(update_url(),$("#page-loading").remove(),boards[current_board_id].$el.addClass("active"),void 0!==kanban.url_params.search&&$("#board-search").val(kanban.url_params.search).trigger("keyup"),void 0!==kanban.url_params.filters&&(boards[current_board_id].record.filters=kanban.url_params.filters,boards[current_board_id].apply_filters())),$("body").hasClass("board-view-restrict-visibility")&&($(".board.active .task").hide(),$('.board.active .task[data-user_id-assigned="'+kanban.current_user_id+'"]').show())}),$(".template").each(function(){var a=$(this),b=a.attr("data-board-id"),c=a.attr("data-basename");void 0===kanban.templates[b]&&(kanban.templates[b]={}),kanban.templates[b][c]=new t(a.html())}),boards[current_board_id]=new Board(boards[current_board_id]);for(var board_id in boards)board_id!=current_board_id&&(boards[board_id]=new Board(boards[board_id],500));if(void 0!==kanban.url_params.col_index){var board=boards[current_board_id];board.status_cols_toggle(kanban.url_params.col_index)}$(window).resize(function(){on_window_resize()}),on_window_resize();var offset=5,col_tasks_sidebar_left=$(".col-tasks-sidebar-left").outerWidth()-offset,col_tasks_sidebar_right=$(".col-tasks-sidebar-right").outerWidth()-offset;$(window).mousemove(function(a){var b=Math.ceil(a.clientX/2-2*offset);b<0&&(b=0),kanban.is_dragging?$(".col-tasks-sidebar-left").css({left:"-"+col_tasks_sidebar_left+"px",opacity:".618"}):b<col_tasks_sidebar_left?$(".col-tasks-sidebar-left").css({left:-b+"px",opacity:"1"}):b>col_tasks_sidebar_left&&$(".col-tasks-sidebar-left").css({left:"-"+col_tasks_sidebar_left+"px",opacity:".618"});var c=window_w-a.clientX,c=Math.ceil(c/2-2*offset);c<0&&(c=0),kanban.is_dragging?$(".col-tasks-sidebar-right").css({right:"-"+col_tasks_sidebar_right+"px",opacity:".618"}):c<col_tasks_sidebar_right?$(".col-tasks-sidebar-right").css({right:-c+"px",opacity:"1"}):c>col_tasks_sidebar_right&&$(".col-tasks-sidebar-right").css({right:"-"+col_tasks_sidebar_right+"px",opacity:".618"})}),$("#btn-filter-modal-toggle").on("click",function(){$(this).attr("data-target","#modal-filter-"+current_board_id)}),$(".btn-filter-reset").on("click",function(){$(".btn-filter-reset").hide();var a=boards[current_board_id];$(".modal-filter option",a.$el).prop("selected",function(){return this.defaultSelected});for(var b in a.record.filters)a.record.filters[b]=null;return delete kanban.url_params.filters,update_url(),$(".task",a.$el).slideDown(),!1}),$("#btn-view-compact").on("click",function(){return $("body").addClass("board-view-set").toggleClass("board-view-compact"),cookie_views(),on_window_resize(),!1}),$("#btn-view-all-cols").on("click",function(){return $("body").addClass("board-view-set").toggleClass("board-view-all-cols"),cookie_views(),!1}),$("#btn-restrict-visibility").on("click",function(){return $("body").addClass("board-view-set").toggleClass("board-view-restrict-visibility"),cookie_views(),$("body").hasClass("board-view-restrict-visibility")?($(".board.active .task").hide(),$('.board.active .task[data-user_id-assigned="'+kanban.current_user_id+'"]').show()):$(".board.active .task").show(),!1}),$("#btn-view-fullscreen").on("click",function(){var a=$(this);return screenfull.enabled&&(screenfull.toggle(),$(".glyphicon:visible",a).length>0?$(".glyphicon",a).css("display","none"):$(".glyphicon",a).css("display","inline-block")),!1});var view_classes=Cookies.get("view");"undefined"!==view_classes&&$("body").addClass(view_classes),$("body").is(".board-view-set")||1!=boards[current_board_id].record.settings().show_all_cols||$("#btn-view-all-cols").trigger("click"),$("#board-search").on("keyup",function(){var board=boards[current_board_id],$input=$(this),$list=$(".task",board.$el),value=$input.val(),valueLower=$.trim(value.toLowerCase()),$reset=$("#board-search-clear");if(0===valueLower.length)return delete kanban.url_params.search,update_url(),$list.slideDown("fast",function(){all_match_col_h(),$reset.hide()}),!1;$reset.show(),kanban.url_params.search=valueLower,update_url();var $tasks_slideDown,$tasks_slideUp;return $list.each(function(){var to_search=[],$task=$(this);for(var i in board.record.search)to_search.push(eval(board.record.search[i]));var textLower=$.trim(to_search.join(" ").toLowerCase());textLower.search(valueLower)>-1?$tasks_slideDown=void 0===$tasks_slideDown?$task:$tasks_slideDown.add($task):$tasks_slideUp=void 0===$tasks_slideUp?$task:$tasks_slideUp.add($task)}),void 0!==$tasks_slideDown&&$tasks_slideDown.slideDown("fast"),void 0!==$tasks_slideUp&&$tasks_slideUp.slideUp("fast"),$(".task").promise().done(function(){all_match_col_h()}),!1}),$("#board-search-clear").on("click",function(){return $("#board-search").val("").trigger("keyup"),!1}),$("#page-footer").on("click",".navbar-toggle",function(){$("#page-footer").toggleClass("in")}),$("body").on("keydown",function(a){var b=$("input:focus, textarea:focus, [contenteditable]:focus"),c=boards[current_board_id];return 37===a.keyCode&&0===b.length&&a.shiftKey&&($(".col-tasks-sidebar-right",c.$el).hasClass("opened")?$(".col-tasks-sidebar-right",c.$el).trigger("click"):$(".col-tasks-sidebar-left",c.$el).hasClass("opened")||$(".col-tasks-sidebar-left",c.$el).trigger("click")),39===a.keyCode&&0===b.length&&a.shiftKey&&($(".col-tasks-sidebar-left",c.$el).hasClass("opened")?$(".col-tasks-sidebar-left",c.$el).trigger("click"):$(".col-tasks-sidebar-right",c.$el).hasClass("opened")||$(".col-tasks-sidebar-right",c.$el).trigger("click")),67===a.keyCode&&0===b.length&&a.shiftKey?($("#btn-view-compact").trigger("click"),!1):65===a.keyCode&&0===b.length&&a.shiftKey?($("#btn-view-all-cols").trigger("click"),!1):85===a.keyCode&&0===b.length&&a.shiftKey?($("#btn-view-fullscreen").trigger("click"),!1):83===a.keyCode&&0===b.length&&a.shiftKey?($("#board-search").focus(),!1):70===a.keyCode&&0===b.length&&a.shiftKey?($(".modal-filter",c.$el).modal("toggle"),!1):80===a.keyCode&&0===b.length&&a.shiftKey?($("#modal-projects").modal("toggle"),!1):75===a.keyCode&&0===b.length&&a.shiftKey?($("#modal-keyboard-shortcuts").modal("toggle"),!1):void 0}),""!==kanban.alert&&$.bootstrapGrowl(kanban.alert,{type:"info",allow_dismiss:!0}),"script"==kanban.url_params.debug&&(window.onerror=function(a,b,c){notify("Error: "+a+" Script: "+b+" Line: "+c,"danger")}),kanban.updates_task=function(){var a={action:"updates_task",datetime:js_date_to_mysql_dt(updates_dt),kanban_nonce:$("#kanban_nonce").val()};updates_dt=new Date,$.ajax({type:"POST",url:kanban.ajaxurl,data:a,success:function(a){try{for(var b in a.data.projects){var c=a.data.projects[b],d=boards[c.board_id];if(c.modified_user_id==d.record.current_user_id())return;if(1==c.is_active){d.record.project_records[c.id]=c;for(var b in d.record.tasks){var e=d.record.tasks[b];e.record.project_id==c.id&&e.project_save(c.id)}}else{delete d.record.project_records[c.id];for(var b in d.record.tasks){var e=d.record.tasks[b];e.record.project_id==c.id&&e.project_update_title("")}}}Object.size(a.data.projects)>0&&1!=Board.prototype.get_current_board().record.settings().disable_sync_notifications&&notify(kanban.text.project_updates,"success")}catch(a){}try{for(var b in a.data.tasks){var f=a.data.tasks[b],d=boards[f.board_id];if(f.modified_user_id==d.record.current_user_id())return;if(1==f.is_active){var e=d.record.tasks[f.id]=new Task(f),g=$("#task-{0}".sprintf(f.id));if($(":focus",g).length>0)continue;g.remove(),e.add_to_board(),d.update_UI(),$("#task-{0}-restore".sprintf(f.id)).remove()}else{var e=d.record.tasks[f.id];e.delete_el(!1)}}Object.size(a.data.tasks)>0&&1!=Board.prototype.get_current_board().record.settings().disable_sync_notifications&&notify(kanban.text.task_updates,"success")}catch(a){}}})},1!=Board.prototype.get_current_board().record.settings().disable_sync_notifications&&setInterval(kanban.updates_task,1e3*boards[current_board_id].record.settings().updates_check_interval_sec)});