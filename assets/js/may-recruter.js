jQuery(document).ready(function ($) {
    console.log('24 hours '+Math.floor(new Date().getTime() / 1000 + 84500));
    //console.log(Math.floor(new Date().getTime() / 1000));
    console.log('60 sec '+Math.floor(new Date().getTime() / 1000+60));
    // console.log(Math.floor(new Date().getTime() / 1000+100));


// Определение переменных во внешней области видимости
    let spec1Values = [];
    let regExName = '';
    let regExAddName = '';
    let noTech = '';
    let regCountry = '';
    let oput = '';
    let zarpl = '';
    let zarpl_to = '';
    let format1 = '';
    let format2 = '';
    let format3 = '';
    let format4 = '';
    let englishLevels = '';
    let engl1 = '';
    let engl2 = '';
    let engl3 = '';
    let engl4 = '';
    let engl5 = '';
    let engl6 = '';
    let comm1 = '';
    let comm2 = '';
    let comm3 = '';
    let comm4 = '';
    let comm5 = '';
    let comm6 = '';

// Проверка наличия сохраненных фильтров при загрузке страницы
    $(document).ready(function() {
        let savedFilters = localStorage.getItem('filters');

        if (savedFilters) {
            let filters = JSON.parse(savedFilters);

            spec1Values = filters.spec1Values;
            regExName = filters.regExName;
            regExAddName = filters.regExAddName;
            noTech = filters.noTech;
            regCountry = filters.regCountry;
            oput = filters.oput;
            zarpl = filters.zarpl;
            zarpl_to = filters.zarpl_to;
            format1 = filters.format1;
            format2 = filters.format2;
            format3 = filters.format3;
            format4 = filters.format4;
            englishLevels = filters.englishLevels;
            engl1 = filters.engl1;
            engl2 = filters.engl2;
            engl3 = filters.engl3;
            engl4 = filters.engl4;
            engl5 = filters.engl5;
            engl6 = filters.engl6;
            comm1 = filters.comm1;
            comm2 = filters.comm2;
            comm3 = filters.comm3;
            comm4 = filters.comm4;
            comm5 = filters.comm5;
            comm6 = filters.comm6;
            filterCandidates();
        }
    });


    function filterCandidates() {
        englishLevels = [];
        if ($('#ve1').is(':checked')) {
            englishLevels.push($('#ve1').val());
        }
        if ($('#ve2').is(':checked')) {
            englishLevels.push($('#ve2').val());
        }
        if ($('#ve3').is(':checked')) {
            englishLevels.push($('#ve3').val());
        }
        if ($('#ve4').is(':checked')) {
            englishLevels.push($('#ve4').val());
        }
        if ($('#ve5').is(':checked')) {
            englishLevels.push($('#ve5').val());
        }
        if ($('#ve6').is(':checked')) {
            englishLevels.push($('#ve6').val());
        }
        let phpCount = $('#phpCount').val();
        $('.dp_post_count2').html(`
    Кандидатів на сайті: ${phpCount}
    `);
        let spec1Values = [];
        $('.spec1-checkbox:checked').each(function () {
            spec1Values.push($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"));
        });
        $(".kandItem1").hide().filter(function () {
            let rtnData = "";
            let matchCount = 0;
            let regExName = $('#vac_speciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            let regExAddName = $('#vac_addspeciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            let noTech = new RegExp($('#vac_notech').val().trim(), "ig");
            let regCountry = $('#vac_country').val();
            let oput = $('#opyt_vacans_input').val();
            let zarpl = $('#zarpl').val();
            let zarpl_to = $('#zarpl_to').val();
            if(zarpl_to=='') {
                zarpl_to = 51000;
            }
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
            let englishLevels = [];
            if ($('#ve1').is(':checked')) {
                englishLevels.push($('#ve1').val());
            }
            if ($('#ve2').is(':checked')) {
                englishLevels.push($('#ve2').val());
            }
            if ($('#ve3').is(':checked')) {
                englishLevels.push($('#ve3').val());
            }
            if ($('#ve4').is(':checked')) {
                englishLevels.push($('#ve4').val());
            }
            if ($('#ve5').is(':checked')) {
                englishLevels.push($('#ve5').val());
            }
            if ($('#ve6').is(':checked')) {
                englishLevels.push($('#ve6').val());
            }
            let comm1 = '';
            let comm2 = '';
            let comm3 = '';
            let comm4 = '';
            let comm5 = '';
            let comm6 = '';
            if ($('#vc1').is(':checked')) {
                comm1 = new RegExp($('#vc1').val().trim(), "ig");
            }
            if ($('#vc2').is(':checked')) {
                comm2 = new RegExp($('#vc2').val().trim(), "ig");
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
            let oputattr = $(this).data("oput");
            if (oputattr==''){oputattr=0;}
            for (let value of spec1Values) {
                let regEx = new RegExp(value, "ig");
                if ($(this).attr("data-spec1").match(regEx)) {
                    matchCount++;
                }
            }
            rtnData = (
                matchCount === spec1Values.length &&
                $(this).attr("data-spec1").match(regExName) &&
                $(this).attr("data-spec1").match(regExAddName) &&
                $(this).attr("data-spec1").match(noTech) &&
                $(this).data("zar") >= zarpl &&
                $(this).data("zar") <= zarpl_to &&
                $(this).data("work_format").match(format1) &&
                $(this).data("work_format").match(format2) &&
                $(this).data("work_format").match(format3) &&
                $(this).data("work_format").match(format4) &&
                ($('#vac_country').val() === '' || $('#vac_country').val().split('|').some(country => country === $(this).attr("data-country"))) &&
                oputattr >= oput &&
                englishLevels.some(level => $(this).data("angl").includes(level)) &&
                $(this).data("cont").match(comm1) &&
                $(this).data("cont").match(comm2) &&
                $(this).data("cont").match(comm3) &&
                $(this).data("cont").match(comm4) &&
                $(this).data("cont").match(comm5) &&
                $(this).data("cont").match(comm6)
            );
            return rtnData;
        }).fadeIn('fast');
        function filterDelay2() {
            let postCount = $('.right_vac .kandItem1:visible').size();
            $('.dp_post_count2').html('');
            $('.dp_post_count2').html(`
            Найдено кандидатов: ${postCount}
        `);
        }
        setTimeout(filterDelay2, 100);

        let filters = {
            spec1Values: spec1Values,
            regExName: regExName,
            regExAddName: regExAddName,
            noTech: noTech,
            regCountry: regCountry,
            oput: oput,
            zarpl: zarpl,
            zarpl_to: zarpl_to,
            format1: format1,
            format2: format2,
            format3: format3,
            format4: format4,
            englishLevels: englishLevels,
            comm1: comm1,
            comm2: comm2,
            comm3: comm3,
            comm4: comm4,
            comm5: comm5,
            comm6: comm6
        };

        localStorage.setItem('filters', JSON.stringify(filters));
    }


    $('.multiselect').on('click', '.countrySing', function () {
        $(this).toggleClass('selected');
        updateSelectedCountries(); // Обновите выбранные страны
        sortMultiselect();
    });

    function sortMultiselect() {
        let selectedItems = $('.multiselect .countrySing.selected').sort(function (a, b) {
            return $(a).text().localeCompare($(b).text());
        });
        let unselectedItems = $('.multiselect .countrySing:not(.selected)').sort(function (a, b) {
            return $(a).text().localeCompare($(b).text());
        });

        $('.multiselect').html(selectedItems).append(unselectedItems);
    }

    let countryNames = [];
    $('.multiselect .countrySing').each(function () {
        countryNames.push($(this).text());
    });

    $("#countrySearch").autocomplete({
        source: countryNames,
        select: function (event, ui) {
            let selectedItem = $('.multiselect .countrySing').filter(function () {
                return $(this).text() === ui.item.value;
            });
            selectedItem.toggleClass('selected');
            sortMultiselect();
            $(this).val('');
            updateSelectedCountries();
            return false;
        }
    });

    function updateSelectedCountries() {
        let selectedCountries = [];
        $('.multiselect .countrySing.selected').each(function () {
            selectedCountries.push($(this).text());
        });
        $('#vac_country').attr('value', selectedCountries.join('|'));
        setTimeout(() => filterCandidates(), 150); // Вызовите функцию фильтрации кандидатов с задержкой
        localStorage.setItem('selectedCountries', JSON.stringify(selectedCountries));
    }

    $(document).ready(function() {
        setTimeout(function () {
            let selectedCountries = JSON.parse(localStorage.getItem('selectedCountries')) || [];
            $('.multiselect .countrySing').each(function () {
                if (selectedCountries.includes($(this).text())) {
                    $(this).addClass('selected');
                }
            });
            $('#vac_country').attr('value', selectedCountries.join('|'));
            updateSelectedCountries();
        }, 150);
    });

    $('.spec1-checkbox').on("change", function () {
        jQuery.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: {
                'action':'sbfilter',
                'vac_speciality': $('#vac_speciality').val().trim().toLowerCase()
            },
            type:'POST',
            // action: 'sbfilter',
            error:function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err);
            },
            success:function(data){
                $('.alltechwrapper').html(data); // insert data
            }
        });
        filterCandidates();
    });
    $('#pipe_filtrs').on("change keyup", function () {
        filterCandidates();
    });

    $('.sup').on('click', function () {
        var players = $(".kandItem1:visible");
        var temp = players.sort(function(a,b){
            return parseInt($(b).attr("data-zar")) - parseInt($(a).attr("data-zar"));
        });
        $(".pipeCont").html(temp);
    });
    $('.sdown').on('click', function () {
        var players = $(".kandItem1:visible");
        var temp = players.sort(function(a,b){
            return parseInt($(a).attr("data-zar")) - parseInt($(b).attr("data-zar"));
        });
        $(".pipeCont").html(temp);
    });

    // $(document).ready(function() {
    //     $('#vac_speciality, #vac_addspeciality, #vac_notech').change(function() {
    //         var selectedOption = $(this).val();
    //         $('#pipe0').val(selectedOption);
    //         var e = jQuery.Event("keypress");
    //         e.which = 13;
    //         $("#pipe0").trigger(e);
    //     });
    //     $('#citySelect').on('keypress',function(e) {
    //         if(e.which == 13) {
    //             var selectedOption = $(this).val();
    //             $('#pipe0').val(selectedOption);
    //             var e = jQuery.Event("keypress");
    //             e.which = 13;
    //             $("#pipe0").trigger(e);
    //         }
    //     });
    //     // TEst checkbox
    //     $('.engl.fiw input, .communications.fiw input, #vac_work_format input').change(function() {
    //         if(this.checked) {
    //             $(this).prop("checked", true);
    //         } else {
    //             $(this).prop("checked", false);
    //         }
    //         let lbtext = $(this).parent().find('label').text();
    //         $('#pipe0').val(lbtext);
    //         var e = jQuery.Event("keypress");
    //         e.which = 13;
    //         $("#pipe0").trigger(e);
    //     });
    // });

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

        // $('.acf-basic-uploader').append('<div id="file">Завантажити файл</div>');
        // var wrapper = $('<div class="fwr"/>').css({height:0,width:0,'overflow':'hidden'});
        // var fileInput = $(':file').wrap(wrapper);
        //
        // fileInput.change(function(){
        //     $this = $(this);
        //     $('#file').text($this.val());
        //     $('.fwr').css({height:'auto',width:'auto','overflow':'visible'});
        // })
        //
        // $('#file').click(function(){
        //     fileInput.click();
        // }).show();

        $('.selection .choices').on('click', 'ul .acf-rel-item ',function () {
            $(this).closest('.selection').parent().find('input').val($(this).text());
        });

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
        var selectedValues = JSON.parse(localStorage.getItem('selectedValues')) || [];
        // Восстановить пользовательский интерфейс
        for (var i = 0; i < selectedValues.length; i++) {
            $('<div>').addClass('tag').text(selectedValues[i]).appendTo('.selectedElements');
        }
// Применить фильтрацию на основе восстановленных значений
        applyFilter();
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
                    $('.kandItem1:visible').each(function () {
                        var pdf = $(this).data('pdf').toLowerCase();
                        var spec1 = $(this).data('spec1').toLowerCase();
                        var spec4 = $(this).data('spec4').toLowerCase();
                        var datafam1 = $(this).data("fam1").toLowerCase();
                        // var datacit1 = $(this).data("cit1").toLowerCase();
                        var datacountry = $(this).data("country").toLowerCase();
                        var dataangl = $(this).data("angl").toLowerCase();
                        var datacont = $(this).data("cont").toLowerCase();
                        var datacontval = $(this).data("contval").toLowerCase();
                        var datastat1 = $(this).data("stat1").toLowerCase();
                        var isMatch = true;

                        for (var i = 0; i < selectedValues.length; i++) {
                            var selectedValue = selectedValues[i];
                            if (pdf.indexOf(selectedValue) === -1 &&
                                spec1.indexOf(selectedValue) === -1 &&
                                spec4.indexOf(selectedValue) === -1 &&
                                datafam1.indexOf(selectedValue) === -1 &&
                                // datacit1.indexOf(selectedValue) === -1 &&
                                datacountry.indexOf(selectedValue) === -1 &&
                                dataangl.indexOf(selectedValue) === -1 &&
                                datacont.indexOf(selectedValue) === -1 &&
                                datacontval.indexOf(selectedValue) === -1 &&
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
            localStorage.setItem('selectedValues', JSON.stringify(selectedValues));
            applyFilter();
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
                var pdf = $(this).data('pdf').toLowerCase();
                var spec1 = $(this).data('spec1').toLowerCase();
                var spec4 = $(this).data('spec4').toLowerCase();
                var datafam1 = $(this).data("fam1").toLowerCase();
                // var datacit1 = $(this).data("cit1").toLowerCase();
                var datacountry = $(this).data("country").toLowerCase();
                var dataangl = $(this).data("angl").toLowerCase();
                var datacont = $(this).data("cont").toLowerCase();
                var datacontval = $(this).data("cont").toLowerCase();
                var datastat1 = $(this).data("stat1").toLowerCase();
                var isMatch = true;
                for (var i = 0; i < selectedValues.length; i++) {
                    var selectedValue = selectedValues[i];
                    if (pdf.indexOf(selectedValue) === -1 &&
                        spec1.indexOf(selectedValue) === -1 &&
                        spec4.indexOf(selectedValue) === -1 &&
                        datafam1.indexOf(selectedValue) === -1 &&
                        // datacit1.indexOf(selectedValue) === -1 &&
                        datacountry.indexOf(selectedValue) === -1 &&
                        dataangl.indexOf(selectedValue) === -1 &&
                        datacont.indexOf(selectedValue) === -1 &&
                        datacontval.indexOf(selectedValue) === -1 &&
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
            localStorage.setItem('selectedValues', JSON.stringify(selectedValues));
            applyFilter();
        });

        // Reset filter functionality
        $('.selectedElements').on('click', '.reset', function () {
            selectedValues = [];
            $('.tag').remove();
            // Show all elements with the "kandItem1" class
            $('.kandItem1').show();
            localStorage.setItem('selectedValues', JSON.stringify(selectedValues));
            applyFilter();
        });

        function applyFilter() {
            setTimeout(function () {
                $('.kandItem1').each(function () {
                    var pdf = $(this).data('pdf').toLowerCase();
                    var spec1 = $(this).data('spec1').toLowerCase();
                    var spec4 = $(this).data('spec4').toLowerCase();
                    var datafam1 = $(this).data("fam1").toLowerCase();
                    var datacountry = $(this).data("country").toLowerCase();
                    var dataangl = $(this).data("angl").toLowerCase();
                    var datacont = $(this).data("cont").toLowerCase();
                    var datacontval = $(this).data("contval").toLowerCase();
                    var datastat1 = $(this).data("stat1").toLowerCase();
                    var isMatch = true;
                    for (var i = 0; i < selectedValues.length; i++) {
                        var selectedValue = selectedValues[i];
                        if (pdf.indexOf(selectedValue) === -1 &&
                            spec1.indexOf(selectedValue) === -1 &&
                            spec4.indexOf(selectedValue) === -1 &&
                            datafam1.indexOf(selectedValue) === -1 &&
                            datacountry.indexOf(selectedValue) === -1 &&
                            dataangl.indexOf(selectedValue) === -1 &&
                            datacont.indexOf(selectedValue) === -1 &&
                            datacontval.indexOf(selectedValue) === -1 &&
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
            },200 );
        }

        console.log("selectedValues "+selectedValues);

        $('#blacklist').change(function() {
            if(this.checked) {
                // if the checkbox is checked, hide elements with data-bl="blacklist"
                $('.kandItem1').each(function() {
                    if ($(this).data('bl') === 'blacklist') {
                        $(this).hide();
                    }
                });
            } else {
                // if the checkbox is unchecked, show all .kandItem1 elements
                $('.kandItem1').show();
            }
            localStorage.setItem('blacklistChecked', this.checked);
        });

        var blacklistChecked = JSON.parse(localStorage.getItem('blacklistChecked')) || false;

        $('#blacklist').prop('checked', blacklistChecked);
        setTimeout(function () {
            if (blacklistChecked) {
                $('.kandItem1').each(function () {
                    if ($(this).data('bl') === 'blacklist') {
                        $(this).hide();
                    }
                });
            } else {
                $('.kandItem1').show();
            }
        }, 250);


        $('.cl_type').on('change', function(){
            // Get the value of the selected checkbox
            var selectedType = $(this).val();

            // Show all items initially
            $('.cli_item').show();

            // If a checkbox is unchecked, hide items that have that value in data-compt
            $('.cl_type:not(:checked)').each(function(){
                var typeToHide = $(this).val();
                $('.cli_item').filter(function(){
                    return $(this).data('compt') == typeToHide;
                }).hide();
            });

            // If no checkbox is checked, show all items
            if($('.cl_type:checked').length == 0){
                $('.cli_item').show();
            }
        });
        $('#mVac').change(function() {
            var vacancy_id = $(this).val();
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                method: 'POST',
                data: {
                    action: 'load_stages',
                    vacancy_id: vacancy_id
                },
                success: function(response) {
                    $('#mStage').html(response).show();
                }
            });
        });
        // Modernizr.on('inputtypes.date', function(result) {
        //     if (!result) {
        //         // No native support for <input type="date">, fall back to jQuery UI datepicker
        //         $( "#datepicker" ).datepicker();
        //     }
        // });

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
        console.log('test addvac');
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
        // $('.loadRes3').load(surl6 + "/wp-content/themes/devport/functions/candidate/send_notif.php",  {
        //     cu6: parseInt($('#cu6').html(), 10) });
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
    (function ($) {
        $(document).ready(function () {
            // Обработка изменения поля поиска
            $('.acf-relationship .filters .filter input').on('input', function () {
                setTimeout(function () {
                    // Проверка наличия результатов поиска
                    var results = $('.acf-relationship .selection .choices .list .acf-rel-item');
                    var noResults = $('.acf-relationship .selection .choices .list:contains("Совпадения не найдены")');

                    if (results.length === 0 && noResults.length > 0) {
                        // Заменить "Совпадения не найдены" на контейнер с элементами списка с постом "Інші"
                        replaceNoResultsWithInshiPost(noResults);
                    }
                }, 1000);
            });
        });

        function replaceNoResultsWithInshiPost(noResults) {
            var inshiPostContainer = `
           <ul class="acf-bl list choices-list">
                <li>
                <span class="acf-rel-label">language</span>
                <ul class="acf-bl">
                    <li>
                        <span tabindex="0" class="acf-rel-item acf-rel-item-add" data-id="90">Інші</span>
                    </li>
                </ul>
            </li></ul>`;
            noResults.replaceWith(inshiPostContainer);
        }






        // $(document).ready(function () {
        //     $('#acf-form').on('submit', function (e) {
        //         e.preventDefault();
        //
        //         var formData = $(this).serialize();
        //
        //         $.ajax({
        //             url: '/path/to/your/server-side/script.php',
        //             method: 'POST',
        //             data: formData,
        //             dataType: 'json',
        //             success: function (response) {
        //                 var oldValues = response.old_values;
        //
        //                 // Разобрать данные формы и сохранить их в объекте
        //                 var newValues = {};
        //                 var formArray = $('#acf-form').serializeArray();
        //                 formArray.forEach(function (item) {
        //                     newValues[item.name] = item.value;
        //                 });
        //
        //                 // Функция для сравнения старых и новых значений полей
        //                 function hasChanges(oldValues, newValues) {
        //                     for (var key in oldValues) {
        //                         if (oldValues.hasOwnProperty(key) && newValues.hasOwnProperty(key)) {
        //                             if (oldValues[key] !== newValues[key]) {
        //                                 return true;
        //                             }
        //                         }
        //                     }
        //                     return false;
        //                 }
        //
        //                 // Определить, нужно ли обновлять запись
        //                 var shouldUpdate = hasChanges(oldValues, newValues);
        //
        //                 // Если есть изменения, отправьте новые данные на сервер для обработки и обновления
        //                 if (shouldUpdate) {
        //                     $('#acf-form').off('submit').submit();
        //                 }
        //             },
        //             error: function (jqXHR, textStatus, errorThrown) {
        //                 console.error('Ошибка AJAX-запроса:', textStatus, errorThrown);
        //             },
        //         });
        //     });
        // });
        $(document).ready(function() {
            $('#filterToggle').click(function() {
                $('#filterBox').slideToggle();
                $('#filterBox').css('display','flex');
            });
        });

    })(jQuery);



// ----------------------------------- cantries filter load values --------------------------
    $('#loadRes7').load(surl6 + "/wp-content/themes/devport/functions/load_countries_filter.php",  {
        cu6: parseInt($('#cu6').html(), 10) });
});
/////////////////////////// JS parse PDF/WORD
// jQuery(document).ready(function($) {
//     const fileInput = $('#acf-field_60d4627f9684e')[0];
//     console.log(fileInput);
//
//     if (!fileInput) {
//         console.error('File input not found');
//         return;
//     }
//
//     // const form = fileInput.closest('form');
//     const form = $('#acf-form');
//     const pdfParsedField = $('#acf-field_643f8aeade8ce');
//     let fileProcessed = false; // Додати цей рядок
//
//     $(fileInput).on('change', async function (e) {
//         console.log('File input change event triggered');
//         if (fileInput.files.length > 0) {
//             const file = fileInput.files[0];
//             const fileExt = file.name.split('.').pop().toLowerCase();
//             console.log('File extension:', fileExt);
//
//             if (fileExt === 'pdf') {
//                 const pdfData = await readFileAsArrayBuffer(file);
//                 const pdfParsedData = await parsePdfData(pdfData);
//                 console.log('PDF parsed data:', pdfParsedData);
//                 setTimeout(() => {
//                     pdfParsedField.val(pdfParsedData);
//                     fileProcessed = true; // Додати цей рядок
//                 }, 500);
//             } else if (fileExt === 'docx') {
//                 const wordData = await readFileAsArrayBuffer(file);
//                 const wordParsedText = await parseWordData(wordData);
//                 console.log('Word parsed data:', wordParsedText);
//                 setTimeout(() => {
//                     pdfParsedField.val(wordParsedText);
//                     fileProcessed = true; // Додати цей рядок
//                 }, 500);
//             } else {
//                 console.error('Unsupported file format');
//             }
//         }
//     });
//
//
//
// // Змінений обробник подій submit для форми
// //         $(form).on('submit', function(e) {
// //             if (!fileProcessed) {
// //                 e.preventDefault();
// //                 alert('Завантажте файл і дочекайтеся завершення обробки перед відправкою форми.');
// //             } else {
// //                 pdfParsedField.attr('name', 'pdf_parsed');
// //                 pdfParsedField.val(pdfParsedField.val().trim()); // Додайте цей рядок
// //                 console.log('pdf_parsed value before submit:', pdfParsedField.val());
// //             }
// //         });
//
//
//     async function readFileAsArrayBuffer(file) {
//         return new Promise((resolve, reject) => {
//             const reader = new FileReader();
//             reader.onload = e => resolve(e.target.result);
//             reader.onerror = e => reject(e.target.error);
//             reader.readAsArrayBuffer(file);
//         });
//     }
//
//     async function parsePdfData(data) {
//         const loadingTask = pdfjsLib.getDocument({ data: data });
//         const pdf = await loadingTask.promise;
//         const numPages = pdf.numPages;
//         let fullText = '';
//
//         for (let i = 1; i <= numPages; i++) {
//             const page = await pdf.getPage(i);
//             const content = await page.getTextContent();
//             const strings = content.items.map(item => item.str);
//             const lastItem = content.items[content.items.length - 1];
//
//             fullText += strings.join(' ');
//
//             // Додаємо перенос рядка на кінці сторінки, крім останньої
//             if (i < numPages && lastItem.transform[5] > 0) {
//                 fullText += '\n\n';
//             }
//         }
//
//         return fullText;
//     }
//
//     async function parseWordData(data) {
//         try {
//             const arrayBuffer = new Uint8Array(data);
//             const result = await mammoth.extractRawText({ arrayBuffer });
//             const text = result.value;
//             return text;
//         } catch (error) {
//             console.error('Error parsing Word data:', error);
//             return '';
//         }
//     }
// });
/////////////////////////// JS download PDF
// window.onload = function() {
//     jQuery(document).ready(function ($) {
//         // Обробник подій для кнопки "Переглянути резюме"
//         $('#view-resume-button').on('click', function() {
//             var resumeContent = $('#pdf_parsed').html();
//
//             // Вставка контенту резюме у блок dump_block у попап вікні
//             $('#dump_block').html(resumeContent);
//             $('.pdf_redh').toggleClass('visible');
//         });
//
//         // Обробник подій для кнопки "Завантажити"
//         $('#download-button').on('click', function() {
//             var dumpBlock = $('#dump_block')[0];
//
//             // Якщо блок dump_block порожній, використовувати вихідний контент резюме з #pdf_parsed
//             if ($('#dump_block').is(':empty')) {
//                 var resumeContent = $('#pdf_parsed').html();
//                 $('#dump_block').html(resumeContent);
//                 dumpBlock = $('#dump_block')[0];
//             }
//
//             // Створення знімка блоку dump_block
//             html2canvas(dumpBlock, {scale: 2, useCORS: true}).then(function(canvas) {
//                 // Створення PDF-файлу зі створеного зображення
//                 var imgData = canvas.toDataURL('image/png');
//                 var pdf = new window.jspdf.jsPDF('p', 'mm', 'a4');
//                 var imgProps = pdf.getImageProperties(imgData);
//                 var pdfWidth = pdf.internal.pageSize.getWidth();
//                 var pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
//                 pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
//
//                 // Завантаження PDF-файлу
//                 pdf.save('resume.pdf');
//             });
//         });
//     });
// };


// $('#download-button').on('click', function() {
//     // Отримання HTML-контенту з блоку dump_block
//     var modifiedContent = $('#dump_block').html();
//
//     // Розбиття контенту на параграфи за допомогою тегів <p>
//     const paragraphs = modifiedContent.split(/<\/?p>/).filter((p) => p.trim());
//
//     // Створення документа .docx
//     const docx = officegen('docx');
//
//     // Додавання параграфів до документа .docx
//     paragraphs.forEach((text) => {
//         const pObj = docx.createP();
//         pObj.addText(text);
//     });
//
//     // Створення посилання для завантаження файлу .docx
//     const downloadLink = document.createElement('a');
//     downloadLink.href = URL.createObjectURL(docx.generateBlob());
//     downloadLink.download = 'resume.docx';
//     downloadLink.style.display = 'none';
//     document.body.appendChild(downloadLink);
//
//     // Імітація кліку на посиланні для завантаження файлу .docx
//     downloadLink.click();
//
//     // Видалення посилання з DOM після завантаження
//     document.body.removeChild(downloadLink);
// });


document.addEventListener("DOMContentLoaded", function() {
    // Получите попап и кнопки
    var popup = document.getElementById("popup");
    var btn = document.getElementById("open-popup");
    var span = document.getElementById("popup-content");

    // Когда пользователь нажимает на кнопку, откройте попап
    if (btn) {
        btn.onmouseenter = function() {
            popup.style.display = "block";
        }
    }

    // Когда пользователь нажимает на кнопку (x), закройте попап
    if (span) {
        span.onmouseleave = function() {
            popup.style.display = "none";
        }
    }
});

