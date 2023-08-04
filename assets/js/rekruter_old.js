jQuery(document).ready(function ($) {
    console.log('24 hours '+Math.floor(new Date().getTime() / 1000 + 84500));
    //console.log(Math.floor(new Date().getTime() / 1000));
    console.log('60 sec '+Math.floor(new Date().getTime() / 1000+60));
    // console.log(Math.floor(new Date().getTime() / 1000+100));
    function filterCandidates() {
        let phpCount = $('#phpCount').val();
        $('.dp_post_count2').html(`
    Кандидатів на сайті: ${phpCount}
    `);
        $(".kandItem1").hide().filter(function () {
            let rtnData = "";
            let regExName = $('#vac_speciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            let regExAddName = $('#vac_addspeciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            let framework1 = new RegExp($('#vac_framework').val().trim(), "ig");
            let noTech = new RegExp($('#vac_notech').val().trim(), "ig");
            // let regComp = new RegExp($('#vac_comp').val().trim(), "ig");
            let regNoTech = new RegExp($('#vac_notech').val().trim(), "ig");
            let regCity = new RegExp($('.vac_city').val().trim(), "ig");
            let regCountry = $('.vac_country').val();

            // let regCountry2 = new RegExp($('#search_country_input').val().trim(), "ig");

            let regRegion = $('#regSelect').val();
            //let regRegion = new RegExp($('#regSelect').val().trim(), "ig");
            // let regRegion = $('#regSelect').val();
            let oput = $('#opyt_vacans_input').val();
            let zarpl = $('#zarpl').val();
            let zarpl_to = $('#zarpl_to').val();
            let rek_comp = $('#vac_comp').val();
            let zarpl_to_v1 = $('#vac_zarpl_to').val();
            let vacTitle = $('.vac_title').val();
            // if(regRegion==null) {
            //     regRegion = '';
            // }
            // if (!regCountry) {
            //     regCountry = 'Австрія';
            // }
            // console.log(regCountry);
            if(zarpl_to=='') {
                zarpl_to = 51000;
            }
            //     console.log(regRegion);
            //    console.log(regFramework);

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
            // let engl7 = '';
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
            let comm1 = '';
            let comm2 = '';
            let comm3 = '';
            let comm4 = '';
            let comm5 = '';
            let comm6 = '';
            if ($('#vc1').is(':checked')) {
                comm1 = new RegExp($('#vc1').val().trim(), "ig");
                console.log(comm1);
            }
            if ($('#vc2').is(':checked')) {
                comm2 = new RegExp($('#vc2').val().trim(), "ig");
                console.log(comm2);
            }
            if ($('#vc3').is(':checked')) {
                comm3 = new RegExp($('#vc3').val().trim(), "ig");
            }
            if ($('#vc4').is(':checked')) {
                comm4 = new RegExp($('#vc4').val().trim(), "ig");
            }
            if ($('#vc5').is(':checked')) {
                comm5 = new RegExp($('#vc5').val().trim(), "ig");
            }
            if ($('#vc6').is(':checked')) {
                comm6 = new RegExp($('#vc6').val().trim(), "ig");
            }
            // if ($('#ve1').is(':checked')) {
            //     engl1 = new RegExp($('#ve1').val().trim(), "ig");
            // }
            // if ($('#ve2').is(':checked')) {
            //     engl2 = $('#ve2').val();
            // }
            // if ($('#ve3').is(':checked')) {
            //     engl3 = new RegExp($('#ve3').val().trim(), "ig");
            // }
            // if ($('#ve4').is(':checked')) {
            //     engl4 = $('#ve4').val();
            // }
            // if ($('#ve5').is(':checked')) {
            //     engl5 = $('#ve5').val();
            // }
            // if ($('#ve6').is(':checked')) {
            //     engl6 = $('#ve6').val();
            // }

            // console.log('t8');
            let oputattr = $(this).data("oput");
            if (oputattr==''){oputattr=0;}
            rtnData = (
                $(this).attr("data-spec1").match(regExName) &&
                $(this).attr("data-spec1").match(regExAddName) &&
                $(this).attr("data-spec4").match(framework1) &&
                $(this).attr("data-spec3").match(noTech) &&
                $(this).data("zar") >= zarpl &&
                $(this).data("zar") <= zarpl_to &&
                $(this).data("work_format").match(format1) &&
                $(this).data("work_format").match(format2) &&
                $(this).data("work_format").match(format3) &&
                $(this).data("work_format").match(format4) &&
                // $(this).data("reg1").match(regRegion) &&id="acf-form"
                $(this).attr("data-cit1").match(regCity) &&
                $(this).attr("data-country").match(regCountry) &&
                // ($(this).attr("data-cit1").match(regCountry2) ||
                // $(this).attr("data-country").match(regCountry2)) &&
                oputattr >= oput &&
                // $(this).data("compn").match(rek_comp) &&
                $(this).data("angl").match(engl1) &&
                $(this).data("angl").match(engl2) &&
                $(this).data("angl").match(engl3) &&
                $(this).data("angl").match(engl4) &&
                $(this).data("angl").match(engl5) &&
                $(this).data("angl").match(engl6) &&
                $(this).data("cont").match(comm1) &&
                $(this).data("cont").match(comm2) &&
                $(this).data("cont").match(comm3) &&
                $(this).data("cont").match(comm4) &&
                $(this).data("cont").match(comm5) &&
                $(this).data("cont").match(comm6)
            );
            return rtnData;
            // });
        }).fadeIn('fast');
        function filterDelay2() {
            let postCount = $('.right_vac .kandItem1:visible').size();
            // $('.dp_post_count').html(postCount);
            $('.dp_post_count2').html('');
            $('.dp_post_count2').html(`
        Найдено кандидатов: ${postCount}
        `);
        }setTimeout(filterDelay2, 100);

        // $('#w2').attr('size',30);
        // $(document).click(function(e) {
        //     $('.select1').attr('size',0);
        // });
    };

    // $('#pipe_filtrs').on("change keyup", function () {
    //     filterCandidates();
    // });
    $(document).ready(function() {
        $('#vac_speciality, #vac_addspeciality, #vac_notech').change(function() {
            var selectedOption = $(this).val();
            $('#pipe0').val(selectedOption);
            var e = jQuery.Event("keypress");
            e.which = 13;
            $("#pipe0").trigger(e);
        });
        $('#citySelect').on('keypress',function(e) {
            if(e.which == 13) {
                var selectedOption = $(this).val();
                $('#pipe0').val(selectedOption);
                var e = jQuery.Event("keypress");
                e.which = 13;
                $("#pipe0").trigger(e);
            }
        });
        // TEst checkbox
        $('.engl.fiw input, .communications.fiw input, #vac_work_format input').change(function() {
            if(this.checked) {
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
            let lbtext = $(this).parent().find('label').text();
            $('#pipe0').val(lbtext);
            var e = jQuery.Event("keypress");
            e.which = 13;
            $("#pipe0").trigger(e);
        });
    });

    let phpCount = $('#phpCount').val();
    // console.log(phpCount);
    $('.dp_post_count2').html(`
    Кандидатів на сайті: ${phpCount}
    `);

    $('#search_country_div').on("click", getCountry.bind(this));
    function getCountry(e) {
        let currCountry = $(e.target).closest(".country2").text();
        $('#search_country_input').val(currCountry);
        $('#selected_country').val(currCountry);
        $('#search_country_div').slideUp();
        console.log(currCountry);
        filterCandidates();
    };
    $('#search_country_input').on("click", function () {
        if($('#search_country_div').css('display') == 'none')
        {
            $('#search_country_div').slideDown();
        }
    });

    $('#loadRegions').on("change keyup", function () {
        $('#loadRes8  option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('.vac_city  option').prop('selected', function() {
            return this.defaultSelected;
        });
        const region = $('#loadRegions').val();
        if (region === 'Україна') {
            $('.countries_wrapper').slideUp();
            $('.city_wrapper').slideDown();
        } else {
            $('.city_wrapper').slideUp();
            $('.countries_wrapper').slideDown();

            const region_options = $('#loadRes8  option');
            region_options.css('display', 'none');
            $("#loadRes8  option[data-region='" + region + "']").css('display', 'block');
        }
    });


    $(document).ready(function () {
        $('#filter').on('click', function () {
            $('#filter').submit()
        });
        $('#filter').submit(function(){
            var filter = $('#filter');
            $.ajax({
                url:filter.attr('action'),
                data:filter.serialize(),
                type:filter.attr('method'),
                success:function(data){
                    $('.pipeCont').html(data); // insert data
                }
            });
            return false;
        });

        $('.buttons button').on('click',function(e) {
            if ($(this).hasClass('grid')) {
                $('.allmr.pipeCont').removeClass('list').addClass('grid');
            }
            else if($(this).hasClass('list')) {
                $('.allmr.pipeCont').removeClass('grid').addClass('list');
            }
        });

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
        $('.cp_btn').on('click', function () {
            let cpbk = $(this).attr('id');
            copyToClipboard('#'+cpbk);
            $(this).parent().append('<div class="coppytext">Скопійовано</div>');
            setTimeout(function () {
                $('.coppytext').remove();
            }, 1500);
        });

        $(function(){
            $('.modalCv').on('click', this, function () {
                let cvmodal = $(this).parent();
                cvmodal.addClass('active');
            });
            $("#modal-background, #modal-close").click(function () {
                $(".modalCv").parent().removeClass("active");
            });
        });
        // ==============================================================
        // ============ Candidate search/input/filter START =============
        // ==============================================================
        var selectedValues = [];
        $('.pipef').on("keyup", function (event) {
            let divs = $('.tech_sc');
            var availableAttributes = [];
            for (var i = 0; i < divs.length; i++) {
                availableAttributes.push(divs[i].textContent);
            }
            $("#pipe0").autocomplete({
                source: availableAttributes
            });
        });
        // Wait for keypress events on the input field
        $('#pipe0').on('keypress', function (event) {
            // Check if the key pressed was enter or space
            // if (event.which === 13 || event.which === 32) {
            if (event.which === 13) {
                // Get the entered value
                var value = $(this).val().trim().toLowerCase();
                // Clear the input field
                $(this).val('');
                // Check if the entered value is not empty
                if (value !== '') {
                    // Add the entered value to the selected values array
                    selectedValues.push(value);
                    // Filter the elements with the "kandItem1" class based on the selected values
                    $('.kandItem1').each(function () {
                        var spec1 = $(this).data('spec1').toLowerCase();
                        var spec4 = $(this).data('spec4').toLowerCase();
                        var datafam1 = $(this).data("fam1").toLowerCase();
                        var datacit1 = $(this).data("cit1").toLowerCase();
                        var datacountry = $(this).data("country").toLowerCase();
                        var dataangl = $(this).data("angl").toLowerCase();
                        var datacont = $(this).data("cont").toLowerCase();
                        var datastat1 = $(this).data("stat1").toLowerCase();
                        var isMatch = true;

                        for (var i = 0; i < selectedValues.length; i++) {
                            var selectedValue = selectedValues[i];
                            if (spec1.indexOf(selectedValue) === -1 &&
                                spec4.indexOf(selectedValue) === -1 &&
                                datafam1.indexOf(selectedValue) === -1 &&
                                datacit1.indexOf(selectedValue) === -1 &&
                                datacountry.indexOf(selectedValue) === -1 &&
                                dataangl.indexOf(selectedValue) === -1 &&
                                datacont.indexOf(selectedValue) === -1 &&
                                datastat1.indexOf(selectedValue) === -1
                            ) {
                                isMatch = false;
                                break;
                            }
                        }
                        if (isMatch) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                    // Add the entered value as a tag to the "selectedElements" element
                    $('<div>').addClass('tag').text(value).appendTo('.selectedElements');
                }
            }
        });

        // Remove tag functionality
        $('.selectedElements').on('click', '.tag', function () {
            var value = $(this).text();
            // Remove the value from the selected values array
            selectedValues = $.grep(selectedValues, function (val) {
                return val !== value;
            });
            $(this).remove();
            // Filter the elements with the "kandItem1" class based on the selected values
            $('.kandItem1').each(function () {
                var spec1 = $(this).data('spec1').toLowerCase();
                var spec4 = $(this).data('spec4').toLowerCase();
                var datafam1 = $(this).data("fam1").toLowerCase();
                var datacit1 = $(this).data("cit1").toLowerCase();
                var datacountry = $(this).data("country").toLowerCase();
                var dataangl = $(this).data("angl").toLowerCase();
                var datacont = $(this).data("cont").toLowerCase();
                var datastat1 = $(this).data("stat1").toLowerCase();
                var isMatch = true;
                for (var i = 0; i < selectedValues.length; i++) {
                    var selectedValue = selectedValues[i];
                    if (spec1.indexOf(selectedValue) === -1 &&
                        spec4.indexOf(selectedValue) === -1 &&
                        datafam1.indexOf(selectedValue) === -1 &&
                        datacit1.indexOf(selectedValue) === -1 &&
                        datacountry.indexOf(selectedValue) === -1 &&
                        dataangl.indexOf(selectedValue) === -1 &&
                        datacont.indexOf(selectedValue) === -1 &&
                        datastat1.indexOf(selectedValue) === -1
                    ) {
                        isMatch = false;
                        break;
                    }
                }
                if (isMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Reset filter functionality
        $('.selectedElements').on('click', '.reset', function () {
            selectedValues = [];
            $('.tag').remove();
            // Show all elements with the "kandItem1" class
            $('.kandItem1').show();
        });

        console.log("selectedValues "+selectedValues);

    });
    // ==============================================================
    // ============ Candidate search/input/filter END ===================
    // ==============================================================
    /////////////////////////////////////////////////////////////////////////////////////////////
    // $('*[data-popup="open5"]').on('click', function () {
    //     $('body').addClass("show_popup");
    //     // let countCand = $('.sv_chose_cand .starWr[data-exist =yes]').length;
    //     // $('.acf-field[data-name="c_num"] input').val(countCand);
    //     // console.log(countCand);
    // });
    // $('*[data-popup="close5"]').on('click', function () {
    //     $('body').removeClass("show_popup");
    // });

//     function faqDelay() {
//     $('.faqOpen').on('click', function (e) {
//         // $('body').addClass("show_popup");
//         $('body').addClass("show_answ");
//          let currFAQitem = $(e.target).closest(".itemW");
//         currFAQitem.children(".faqItem").addClass("show2");
//     });
//    // $('.faqItem').css('background-color', 'red');

//     }setTimeout(faqDelay, 300);
    $('.faq_bgr').on('click', function () {
        $('body').removeClass("show_answ");
        $('.faqItem').removeClass("show2");
    });

    $(".faq1").on("click", ".faqOpen", updRekWrapper.bind(this));
    function updRekWrapper(e) {
        $('body').addClass("show_answ");
        let thisR = $(e.target).parents(".itemW");
        thisR.find(".faqItem").addClass("show2");
    }
    $('.faqClose').on('click', function () {
        $('body').removeClass("show_answ");
        $('.faqItem').removeClass("show2");
    });

    // ================================== Мои задачи ========================================
    const surl6 = $('#surl6').html();
    // console.log(surl6);
    // $('#loadCalend').load(surl6 + "/wp-content/themes/devport/functions/loadRekrKalendar.php");
    $('#loadCalend').load(surl6 + "/wp-content/themes/devport/functions/loadRekrKalendar.php",  {
        cu6: parseInt($('#cu6').html(), 10), cu7: parseInt($('#cutask').html(), 10) });

    // ============================================================
    // //let rr = $('#timedb').val();
    // // let pretty;
    // let adr = $('#countdown').css('color', 'red');
    // let rr = new Date().getTime() / 1000;
    //  rr = parseInt(rr);
    //  $('#ct').html(rr);

    // //  console.log(rr);
    //  let timeInSecs;
    //  let ticker;
    //  let timedb = $('#timedb').val();

    //  function startTimer(secs) {
    //     timeInSecs = parseInt(secs);
    //     ticker = setInterval(tick9, 1000);
    //  }

    //  function tick9( ) {
    //     var secs = timeInSecs;
    //     if (secs > 0) {
    //     timeInSecs--;
    //     }
    //     else {
    //         clearInterval(ticker);
    //         startTimer(1728);  // start again
    //     }

    //     var hours= Math.floor(secs/3600);
    //     secs %= 3600;
    //     var mins = Math.floor(secs/60);
    //     secs %= 60;
    //    let pretty = ( (hours < 10 ) ? "0" : "" ) + hours + ":" + ( (mins < 10) ? "0" : "" ) + mins + ":" + ( (secs < 10) ? "0" : "" ) + secs;
    //     //document.getElementById("countdown").innerHTML = pretty;
    //     adr.html(pretty);
    //     }

    //  startTimer(timedb);  // 24 hours in seconds
    // startTimer(86400);  // 24 hours in seconds 1209600 - 14 days

    let ki2 = $('.kandItem1');
    // let ki3 = ki2.length;
    // console.log(ki3);

// ============================================================================================
    let rr = new Date().getTime() / 1000;
    rr = parseInt(rr);
    $('#ct').html(rr);
    //console.log(rr);
    let currItem2 = '';
    let idCand2 = 0;
    for (let i = 0; i < ki2.length; i++) {
        let cell = ki2[i];
        let kicl= 'cl' + [i];

        cell.classList.add(kicl);
        let tdbval = cell.dataset.timedb;
        let pipeVal = cell.dataset.pipe;
        // ---------------------------------------------------------------------------------------
        let timeInSecs;
        let ticker;
        //let timedb = $('#timedb').val();

        function startTimer(secs) {
            timeInSecs = parseInt(secs);
            ticker = setInterval(tick9, 1000);
        }

        let executed = 0;

        function tick9( ) {
            //$('.'+kicl+' .getToVac').attr("disabled", true);
            $('.timlid .getToVac').prop("disabled", false);
            let secs = timeInSecs;
            if (secs > 0) {
                timeInSecs--;
            }
            else {
                $('.'+kicl+' .timer2').html();
                $('.'+kicl+' .timer2').addClass('dnone');

                if(executed!==1) {
                    executed = 1;
                    console.log('timer stopped');
                    // cell.classList.add('dnone');
                    currItem2 = cell.dataset.id;
                    //console.log(currItem2);

                    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
                    if(pipeVal=="own") {
                        const newTime = Math.floor(new Date().getTime() / 1000+86400);
                        const timer1 = {
                            'postId': currItem2,
                            'timer': newTime,
                            'status': 'Новий'
                        }
                        $.ajax({
                            beforeSend: (xhr) => {
                                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
                            },
                            url: devportData.root_url + '/wp-json/dp/v5/timerR/',
                            type: 'PUT',
                            data: timer1,
                            success: (response) => {
                                // cell.querySelector('.stat4').html('Горячий').addClass('stHot');
                                // makeRekomReadOnly(thisR);
                                // console.log(response);
                            },
                            error: (response) => {
                                // makeRekomReadOnly(thisR);
                            }
                        });
                        cell.classList.add('dnone');
                        //alert('dunnnn');
                    }
                    const newTime2 = Math.floor(new Date().getTime() / 1000);
                    const timer2 = {
                        'postId': currItem2,
                        'timer': newTime2,
                        'status': 'Горящий'
                    }
                    if(pipeVal=="public") {
                        console.log(timer2);
                        //alert('oop');
                        $.ajax({
                            beforeSend: (xhr) => {
                                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
                            },
                            url: devportData.root_url + '/wp-json/dp/v5/timerR/',
                            type: 'PUT',
                            data: timer2,
                            success: (response) => {
                                // cell.querySelector('.stat4').html('Горячий').addClass('stHot');
                                // makeRekomReadOnly(thisR);
                                // console.log(response);
                            },
                            error: (response) => {
                                // makeRekomReadOnly(thisR);
                            }
                        });
                        let cellStatus = cell.querySelector('.stat4');
                        cellStatus.classList.add('stHot');
                        cellStatus.textContent = "Горящий";
                    }
                    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

                    //$('.'+kicl+' .getToVac').attr("disabled", false);
                }
                let cellBtn = cell.querySelector('.getToVac');
                //cellBtn.disabled = false;

                //cellBtn.classList.add('stHot');
                cellBtn.removeAttribute('disabled');
            }

            let hours= Math.floor(secs/3600);
            secs %= 3600;
            let mins = Math.floor(secs/60);
            secs %= 60;
            let pretty = ( (hours < 10 ) ? "0" : "" ) + hours + ":" + ( (mins < 10) ? "0" : "" ) + mins + ":" + ( (secs < 10) ? "0" : "" ) + secs;
            //document.getElementById("countdown").innerHTML = pretty;
            // console.log(pretty);
            $('.'+kicl+' .timer2').html(pretty).css('border', '1px dashed #000');
            // $('.'+kicl+' .getToVac').attr("disabled", true);
        }
        if(tdbval>0 && tdbval - rr>0){
            startTimer(tdbval - rr);  // 24 hours in seconds
        }

        // startTimer(rr-tdbval);  // 24 hours in seconds
    }

    // ============================= Забрать на Вакансию ============================
    let currItem1 = '';
    let name1 = '';
    let fam1 = '';
    let idCand = 0;
    $('.getToVac').on("click", function (e) {
        $('#moveToRekr').fadeIn();
        currItem1 = $(e.target).closest(".kandItem1");
        idCand = currItem1.data("id");
        name1 = currItem1.data("name1");
        fam1 = currItem1.data("fam1");

        $('#cName').text(name1+' '+fam1);

        $(".vacOption").hide();
        $(".vacOption[data-exist=yes]").show();
    });

    $('#saveMove').on("click", function () {
        //alert('go-gu');
        const surl7 = $('#surl7').html();

// .............................................................

        let sec1 = new Date().getTime() / 1000;
        sec1 = sec1 + 86400;
        sec1 = Math.floor(sec1);

        // const date0 = sec1+86400;
        const move1 = {
            'postId': idCand,
            'rekr': $('#moveToRekr h2').data("rekr"),
            'vac': $('#mVac').val(),
            'status': 'Занятий',
            'date0': sec1
        }
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/dp/v4/moveR/',
            type: 'PUT',
            data: move1,
            success: (response) => {
                // makeRekomReadOnly(thisR);
                // console.log(response);
            },
            error: (response) => {
                // makeRekomReadOnly(thisR);
            }
        });
        // console.log('id: '+idCand);
        // console.log(move1);
        // .................... create id event when reassign rekruter ...................................
        const d1 = new Date();
        const month = d1.getMonth()+1;
        const day = d1.getDate();
        const hours = d1.getHours();
        const min = d1.getMinutes();
        const sec = d1.getSeconds();
        const curdt = d1.getFullYear() + (month<10 ? '0' : '')+"-"+ month+"-" + (day<10 ? '0' : '') + day + " " + hours+":"+min+":"+sec;
        //console.log('vv22 ' + Math.floor(sec1));
        let evc = idCand;
        let evr = $('#moveToRekr h2').data("rekr");
        let evf = 0;
        // let evf = edgeVal
        let evv = $('#mVac').val();
        let evd2 = sec1;
        let evd = curdt;
        $('#eventBox').load(surl7 + "/wp-content/themes/devport/functions/create1_kevent.php", {
            er: evr, ef: evf, ev: evv, ec: evc, edt: evd, ed2: evd2
        });
        // ...............................................................................................
        $('#moveToRekr').fadeOut();
        window.location.reload();
        //console.log(devportData.root_url);
        // console.log('cand '+evc);
        // console.log('recr '+evr);
        // console.log('freel '+evf);
        // console.log('vac '+evv);
        // console.log('dat2 '+evd2);
        // console.log('dattime '+evd);
    });
    // ----------------------------------------------------------------------------
    $('.close1').on("click", function () {
        $('#moveToRekr').fadeOut();
    });
    // ============================= add number to filters options ==================
    let kel1 = $('.kandItem1[data-stat1="Новий"]');
    // console.log('dd'+kel1.length);
    for (let i = 0; i < kel1.length; i++) {
        // console.log('dd1 '+i);
        // let cell = kels[i];
        // if (cell.textContent  == 'Офер') {
        //     cell.classList.add('stRelised');
        // }
        // if (cell.textContent  == 'Новый') {
        //     cell.classList.add('stNew');
        // }
        // if (cell.textContent  == 'В работе') {
        //     $('.mcd2 p:first-child').addClass('vRaboteDetails');
        //     cell.classList.add('stProc');
        // }
        // if (cell.textContent  == 'На паузе') {
        //     cell.classList.add('vPauza');
        // }
        // if (cell.textContent  == '') {
        //     // cell.html('Новый');
        //     cell.classList.add('stMt');
        //     // cell.textContent('stMt');
        // }
    }
    let lg1 = "Android";
    // $('#vac_speciality option:contains("'+ lg1 +'")').css('background-color', 'red');
    // $('.'+kicl).append('<span class="">4'+[i]+'</span>');

    // let lopt = $('#vac_speciality option').css('color', 'blue');
    //let lopt = $('#vac_speciality option').css('color', 'blue');
    //  console.log('opt: '+lopt.length);
    //  for (let i = 0; i < lopt.length; i++) {
    //     let op1 = lopt[i].querySelector( ":before" );
    //     console.log(op1);
    //    // op1.style.color = 'yellow';
    //     // op1.style.cssText = `
    //     // content: "5";
    //     // height: 15px;
    //     // width: 15px;
    //     // background: #ccc;
    //     // border-radius: 50%;
    //     // display: inline-flex;
    //     // justify-content: center;
    //     // `;
    //    // op1.style.color = 'yellow';
    //  }
    // ===================== calendar ===================
    // $(function(){
    //     $("#date5").datepicker({
    //         changeYear: true,
    //     //  //   monthNames: [ "Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December" ],
    //         dateFormat: 'yy-mm-dd',
    //     // inline:true,
    //     // showOtherMonths: true,
    //     // altField: "#date-start-value",
    //     // altFormat: "dd M yy",
    //     // dateFormat: "dd M yy",
    //     onSelect: function(dateText){
    //         $('#start5').html(dateText);
    //     }
    //     });
    //     $("#date5").datepicker("option", "showAnim", 'drop');
    //     //$("#date5").datepicker("option", "monthNames", [ "Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December" ]);
    //     $("#date6").datepicker({
    //         dateFormat: 'yy-mm-dd',
    //         changeYear: true,
    //         onSelect: function(dateText){
    //             $('#end5').html(dateText);
    //         }
    //     });
    //     $("#date6").datepicker("option", "showAnim", 'clip');
    //     // $("#d4").datepicker({
    //     //     dateFormat: 'yy-mm-dd'
    //     // });
    //     // $("#datepicker1").datetimepicker({hourGrid: 4, minuteGrid: 10, dateFormat: 'yy-mm-dd'});
    // });

    // ================================= Особистий Pipeline ===========================================
    let pipeState = 1;
    $('.ownPipe').on("click", function () {
        if(pipeState===1){
            $('.ownPipe').css('transition', 'all .3s ease 0s').text('Мои кандидаты');
            pipeState=0;
            $(".pipe1").slideUp("slow");
            $(".pipe2").slideDown("slow");
        }else{
            $('.ownPipe').text('Особистий Pipeline');
            pipeState=1;
            $(".pipe2").slideUp("slow");
            $(".pipe1").slideDown("slow");
        }
    });

    // ========================= Рассылка уведомлений рекрутёрам об горящих кандидатах =====================
    let lastVisit = $('.hotTime').text();
    lastVisit = parseInt(lastVisit, 10);
    //let lastVisit = $('.hotTime').text();
    // console.log('last '+lastVisit);
    let changedVal = 0;
    let timerId = setTimeout(function tick() {
        //console.log('mm22');
        $('.loadRes3').load(surl6 + "/wp-content/themes/devport/functions/candidate/send_notif.php",  {
            cu6: parseInt($('#cu6').html(), 10) });
        //alert('yooo');
        function dunDelay() {
            let dNumbr=$('.loadRes3 div').length;
            //console.log('dn1 '+dNumbr);
            let dElem=$('.hotC>div').length;
            // if(dNumbr == dElem || (changedVal==dNumbr && changedVal == 0)){
            //     $('#numbHot').css('visibility', 'hidden');
            // }
            // $('#numbHot').css('visibility', 'hidden');
            if(dNumbr !== dElem){
                // if(dNumbr !== dElem || (changedVal!==dNumbr && changedVal !== 0)){
                //changedVal=dNumbr;
                //console.log('jjrr');
                $('#numbHot').remove();

                const nHot = dNumbr-dElem;
                if(nHot>0){
                    $('#numbHot5').css('display', 'block');
                    $('#numbHot5').text(nHot);
                    $('#numbHot').css('visibility', 'visible');
                }

                // console.log('numb00 '+changedVal);
                // console.log('elem00 '+dElem);
                // console.log('elem22 '+nHot);

                // window.location.reload();
            }
            // $('#numbHot5').text(5);
            // console.log('numb '+dNumbr);
            // console.log('elem '+dElem);
            // alert('yooo');
        }
        setTimeout(dunDelay, 3000);

        let numHot = $('.hotOnly .hot5').filter(function () {
            return $(this).val() > lastVisit;
        });
        let numHot1 = numHot.length;
        // console.log('num '+numHot1);

        if (numHot1 > 0) {
            $('#numbHot').addClass('hotActive');
            $('.hotActive').text(numHot1);
        } else {
            $('#numbHot').removeClass('hotActive');
            $('.hotActive').text(0);
        }
        timerId = setTimeout(tick, 2000); // (*)
    }, 10);
    //  $('#numbHot').css('visibility', 'hidden');
    function showNotif() {
        // $('#numbHot').css('visibility', 'visible');

    }
    setTimeout(showNotif, 2100);

    // ---------------------------- open notification tab ----------------------------------
    $('.openNotif').on('click', function () {
        //alert('4400');
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/ht/v2/manageHot2',
            data: {
                'postId': $('.myM').data('hot'),
                //'hd': currTime,
                'uid': $(".myM").data('uid')
            },
            type: 'PUT',
            success: (response) => {
                let currLD = $(".myM");
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    });

// ----------------------------------- cantries filter load values --------------------------
    $('#loadRes7').load(surl6 + "/wp-content/themes/devport/functions/load_countries_filter.php",  {
        cu6: parseInt($('#cu6').html(), 10) });
});