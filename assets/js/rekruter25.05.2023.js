jQuery(document).ready(function ($) {
///////////// Видалення поста фільтра
    $('.delete-post-button').click(function() {
        var postId = $(this).data('id');
        var nonce = $(this).data('nonce');

        var data = {
            'action': 'delete_custom_post',
            'post_id': postId,
            'nonce': nonce
        };

        $.post(ajaxurl, data, function(response) {
            if(response === 'success') {
                alert('Видалено');
            } else {
                alert('Виникла помилка при видаленні');
            }
        });
    });
///////////// Кінець Видалення поста фільтра

    function showLoader() {
        $('#loader').show();
        $('.allmr.pipeCont.list').css('visibility','hidden');
    }

    function hideLoader() {
        setTimeout(function () {
            $('#loader').hide();
            $('.allmr.pipeCont.list').css('visibility','visible');
        },1000 );
    }
    function filtersApplied() {
        let filters = JSON.parse(localStorage.getItem('filters'));

        // Проверка, если хоть одно значение фильтра определено и не пустое
        for (let key in filters) {
            if (filters[key] !== undefined && filters[key] !== '') {
                return true;
            }
        }
        return false;
    }
// Определение переменных во внешней области видимости

    window.onpopstate = function(event) {
        handlePopState(event.state);
    };

    function handlePopState(state) {
        // Здесь вы можете восстановить свое состояние на основе объекта state,
        // который был связан с этим элементом истории браузера.
        if (state) {
            // Если состояние существует, восстанавливаем его
            console.log('Тут будет код восстановления состояния.');
        } else {
            // Если состояние не определено, то это, вероятно, означает, что мы только что загрузили страницу.
            // Выполняем необходимые действия для этого случая.
            console.log('Тут будет код для случая только что загруженной страницы.');

        }
    }

    let spec1 = [];
    let regExName = '';
    let regExAddName = '';
    let noTech = '';
    let regCountry = '';
    let oput = '';
    let zarpl = '';
    let zarpl_to = '';
    let workFormats = '';
    let englishLevels = '';
    let datacontact = '';

// Проверка наличия сохраненных фильтров при загрузке страницы
    $(document).ready(function() {
        setTimeout(function () {
            let savedFilters = localStorage.getItem('filters');

            // Parse the saved filters into an object
            let parsedFilters = JSON.parse(savedFilters);

            // Check if filters is not set or it is an empty array
            if (!savedFilters || (Array.isArray(parsedFilters) && parsedFilters.length === 0)) {
                let defaultFilters = {
                    spec1: [],
                    oput: "0",
                    zarpl: "",
                    zarpl_to: "5100000000",
                    workFormats: [],
                    englishLevels: [],
                    datacontact: []
                };
                localStorage.setItem('filters', JSON.stringify(defaultFilters));
                savedFilters = localStorage.getItem('filters');
            }

            if (savedFilters) {
                let filters = JSON.parse(savedFilters);
                spec1 = filters.spec1;
                regExName = filters.regExName;
                regExAddName = filters.regExAddName;
                noTech = filters.noTech;
                regCountry = filters.regCountry;
                oput = filters.oput;
                zarpl = filters.zarpl;
                zarpl_to = filters.zarpl_to;
                workFormats = filters.workFormats;
                englishLevels = filters.englishLevels;
                datacontact = filters.datacontact;

                // Установите значения фильтров в соответствии с сохраненными
                $('#vac_speciality').val(regExName);
                $('#vac_addspeciality').val(regExAddName);
                $('#vac_notech').val(noTech);
                $('#vac_country').val(regCountry);
                $('#opyt_vacans_input').val(oput);
                $('#opyt_vacans').text(oput);
                $('#zarpl').val(zarpl);
                $('#zarpl_to').val(zarpl_to);

                // Обновите состояние чекбоксов в соответствии с сохраненными фильтрами
                $('.spec1-checkbox').each(function () {
                    if (spec1.includes($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"))) {
                        $(this).prop('checked', true);
                    }
                });
                englishLevels.forEach(function(level) {
                    $(`input[data-level='${level}']`).prop('checked', true);
                });
                workFormats.forEach(function(format) {
                    $(`input[data-level='${format}']`).prop('checked', true);
                });
                datacontact.forEach(function(comm) {
                    $(`input[data-level='${comm}']`).prop('checked', true);
                });
                isFiltering = true;
                currentPage = 1; // Сбрасываем страницу на 1
                filterCandidates();
            }
        }, 0);
    });
    let currentPage = 1;
    let isFiltering = false;
    let maxPages = 1;
    let ajaxInProgress = false;
    $(document).on('click', '.prev.page-numbers', function() {
        console.log('prev');
        if (currentPage > 1) {
            currentPage--;
            filterCandidates(currentPage);
        }
    });

    $(document).on('click', '.next.page-numbers', function() {
        console.log('next');
        if (currentPage < maxPages) {
            currentPage++;
            filterCandidates(currentPage);
        }
    });

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();  // Отмените стандартное действие по клику (переход по ссылке)
        currentPage = $(this).text();  // Получите номер страницы из текста ссылки
        filterCandidates();  // Вызовите вашу функцию с новым номером страницы
        // $('.page-numbers').removeClass('current');
        // $(this).addClass('current');
    });
    function filterCandidates(page) {
        if (ajaxInProgress) return;
        showLoader();
        let phpCount = $('#phpCount').val();
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
        let workFormats = [];
        if ($('#i1').is(':checked')) {
            workFormats.push($('#i1').val());
        }
        if ($('#i2').is(':checked')) {
            workFormats.push($('#i2').val());
        }
        if ($('#i3').is(':checked')) {
            workFormats.push($('#i3').val());
        }
        if ($('#i4').is(':checked')) {
            workFormats.push($('#i4').val());
        }
        let datacontact = [];
        if ($('#vc1').is(':checked')) {
            datacontact.push($('#vc1').val());
        }
        if ($('#vc2').is(':checked')) {
            datacontact.push($('#vc2').val());
        }
        if ($('#vc3').is(':checked')) {
            datacontact.push($('#vc3').val());
        }
        if ($('#vc4').is(':checked')) {
            datacontact.push($('#vc4').val());
        }
        if ($('#vc5').is(':checked')) {
            datacontact.push($('#vc5').val());
        }
        if ($('#vc6').is(':checked')) {
            datacontact.push($('#vc6').val());
        }
        let zarpl = $('#zarpl').val();
        let zarpl_to = $('#zarpl_to').val();
        if(zarpl_to=='') {
            zarpl_to = 5100000000;
        }
        let oput = $('#opyt_vacans_input').val();
        if($('#opyt_vacans_input').val() == '7.5') {
            oput = 0;
        }
        spec1 = [];
        $('.spec1-checkbox:checked').each(function () {
            spec1.push($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"));
        });
        $('.dp_post_count2').html(`
    Кандидатів на сайті: ${phpCount}
    `);
        setTimeout(function () {
            $(".kandItem1").filter(function () {
                let rtnData = "";
                let matchCount = 0;
                let regExName = $('#vac_speciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
                let regExAddName = $('#vac_addspeciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
                let noTech = new RegExp($('#vac_notech').val().trim(), "ig");
                let regCountry = $('#vac_country').val();
                let oput = $('#opyt_vacans_input').val();
                let oputattr = $(this).data("oput");
                if (oputattr==''){oputattr=0;}
                for (let value of spec1) {
                    let regEx = new RegExp(value, "ig");
                    if ($(this).attr("data-spec1").match(regEx)) {
                        matchCount++;
                    }
                }
                rtnData = (
                    matchCount === spec1.length &&
                    $(this).attr("data-spec1").match(regExName) &&
                    $(this).attr("data-spec1").match(regExAddName) &&
                    $(this).attr("data-spec1").match(noTech) &&
                    $(this).data("zar") >= zarpl &&
                    $(this).data("zar") <= zarpl_to &&
                    (workFormats.length === 0 || workFormats.some(format => $(this).data("work_format").includes(format))) &&
                    ($('#vac_country').val() === '' || $('#vac_country').val().split('|').some(country => country === $(this).attr("data-country"))) &&
                    oputattr >= oput &&
                    (englishLevels.length === 0 || englishLevels.some(level => $(this).data("angl").includes(level))) &&
                    (datacontact.length === 0 || datacontact.some(comm => $(this).data("cont").includes(comm)))
                );
                return rtnData;
            });
        }, 0);
        function filterDelay2() {
            let postCount = $('.right_vac .kandItem1:visible').size();
            $('.dp_post_count2').html('');
            $('.dp_post_count2').html(`
        Найдено кандидатов: ${postCount}
        `);
        }setTimeout(filterDelay2, 100);

        let filters = {
            spec1: spec1,
            regExName: regExName,
            regExAddName: regExAddName,
            noTech: noTech,
            regCountry: regCountry,
            oput: oput,
            zarpl: zarpl,
            zarpl_to: zarpl_to,
            workFormats: workFormats,
            englishLevels: englishLevels,
            datacontact: datacontact
        };
        let selectedCountries = JSON.parse(localStorage.getItem('selectedCountries')) || [];
        let selectedValues = JSON.parse(localStorage.getItem('selectedValues')) || [];
        let blacklistChecked = JSON.parse(localStorage.getItem('blacklistChecked')) || false;

        localStorage.setItem('filters', JSON.stringify(filters));
        // Отправка AJAX-запроса для фильтрации элементов
        ajaxInProgress = true;
        $('.left_vac.pipe').css('pointer-events','none');
        $('#reset-filters').css('pointer-events','none');
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: 'filter_posts',
                page: currentPage,
                filters: filters ? filters : {"spec1":[],"regExName":"","regExAddName":"","noTech":"","regCountry":"","oput":"0","zarpl":"","zarpl_to":5100000000,"workFormats":[],"englishLevels":[],"datacontact":[]},
                filterscountry: selectedCountries ? selectedCountries : [],
                searchfilters: selectedValues ? selectedValues : [],
                blacklistChecked: blacklistChecked ? blacklistChecked : false,
            },
            type: 'POST',
            dataType: 'json',
            before: function() {
                $('.left_vac.pipe').css('pointer-events','none');
            },
            success: function(response) {
                // let candidates = [];
                currentPage = response.currentPage;
                maxPages = response.maxPages;
                $('.page-numbers.current').text(currentPage);
                $('.prev.page-numbers').prop('disabled', currentPage === 1);
                $('.next.page-numbers').prop('disabled', currentPage === maxPages);
                if (currentPage < maxPages) {
                    jQuery('#load-more').show();
                } else {
                    jQuery('#load-more').hide();
                }
                //Замена текущего списка элементов отфильтрованным списком
                if (isFiltering) {
                    $('.allmr.pipeCont.list').empty();
                    isFiltering = false; // Сбрасываем флаг фильтрации
                }
                $('.allmr.pipeCont.list').html(response.posts);
                $('.pagination-links').html(response.pagination);

                $('.page-numbers').each(function() {
                    var text = $(this).text();  // Получить текст элемента
                    var num = parseInt(text, 10);  // Преобразовать текст в число
                    var link = $(this).attr('href');  // Получить ссылку
                    // Если число равно currentPage, изменить структуру элемента
                    if(currentPage === 1) {
                        $('.prev.page-numbers').css({
                            'visibility' : 'hidden',
                            'pointer-events' : 'none'
                        });
                    } else {
                        $('.prev.page-numbers').css({
                            'visibility' : 'visible',
                            'pointer-events' : 'all'
                        });
                    }
                    if(currentPage === maxPages) {
                        $('.next.page-numbers').css({
                            'visibility' : 'hidden',
                            'pointer-events' : 'none'
                        });
                    } else {
                        $('.next.page-numbers').css({
                            'visibility' : 'visible',
                            'pointer-events' : 'all'
                        });
                    }
                    if (num === currentPage) {
                        if ($(this).is('a')) {
                            $(this).replaceWith('<span aria-current="page" class="page-numbers current">' + text + '</span>');
                        }
                    } else {
                        if ($(this).is('span')) {
                            $(this).replaceWith('<a class="page-numbers" href="' + link + '">' + text + '</a>');
                        }
                    }
                    $('.pagnum .next.page-numbers').css('pointer-events','none');
                });
                // currentPage++;
                filterDelay2();
                hideLoader();
            },
            error: function(error) {
                console.log('Failed to filter posts:', error);
            },
            complete: function() {
                // независимо от того, удался AJAX-запрос или нет, устанавливаем состояние обратно в false, поскольку AJAX-запрос закончился
                ajaxInProgress = false;
                $('.left_vac.pipe').css('pointer-events','all');
                $('#reset-filters').css('pointer-events','all');
            },
        });
    }
    $('#vac_speciality, #vac_addspeciality, #vac_notech, #vac_country, #opyt_vacans_input, #zarpl, #zarpl_to, .engl input, .communications input, #vac_work_format').on("change keyup", function () {
        console.log('asdas')
        isFiltering = true;
        currentPage = 1; // Сбрасываем страницу на 1
        filterCandidates();
    });

    $('.multiselect').on('click', '.countrySing', function () {
        $(this).toggleClass('selected');
        updateSelectedCountries(); // Обновите выбранные страны
        isFiltering = true;
        currentPage = 1; // Сбрасываем страницу на 1
        filterCandidates(); // Вызовите функцию фильтрации кандидатов с задержкой
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
            isFiltering = true;
            currentPage = 1; // Сбрасываем страницу на 1
            filterCandidates(); // Вызовите функцию фильтрации кандидатов с задержкой
            return false;
        }
    });

    function updateSelectedCountries() {
        let selectedCountries = [];
        $('.multiselect .countrySing.selected').each(function () {
            selectedCountries.push($(this).text());
        });
        $('#vac_country').attr('value', selectedCountries.join('|'));
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

    // $('.spec1-checkbox').on("change", function () {
    //     jQuery.ajax({
    //         url: '/wp-admin/admin-ajax.php',
    //         data: {
    //             'action':'sbfilter',
    //             'vac_speciality': $('#vac_speciality').val().trim().toLowerCase()
    //         },
    //         type:'POST',
    //         // action: 'sbfilter',
    //         error:function(xhr, status, error) {
    //             var err = eval("(" + xhr.responseText + ")");
    //             console.log(err);
    //         },
    //         success:function(data){
    //             $('.alltechwrapper').html(data); // insert data
    //         }
    //     });
    //     filterCandidates();
    // });
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
        // filterCandidates();
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
            $('body').on('click', '.modalCv', function () {
                let cvmodal = $(this).parent();
                cvmodal.addClass('active');
            });
            $('body').on('click', "#modal-background, #modal-close", function () {
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
            if (selectedValues.length > 0) {
                $('#reset-filters').show();
            }
            if (event.which === 13) {
                // Get the entered value
                var capitalized = $(this).val().trim();
                const value = capitalized.charAt(0).toUpperCase() + capitalized.slice(1);

                // Clear the input field
                $(this).val('');
                // Check if the entered value is not empty
                if (value !== '') {
                    // Add the entered value to the selected values array
                    selectedValues.push(value);
                    // Filter the elements with the "kandItem1" class based on the selected values
                    showLoader();
                    // Add the entered value as a tag to the "selectedElements" element
                    $('<div>').addClass('tag').text(value).appendTo('.selectedElements');
                }
                localStorage.setItem('selectedValues', JSON.stringify(selectedValues));
                isFiltering = true;
                currentPage = 1; // Сбрасываем страницу на 1
                filterCandidates();
            }
            // applyFilter();
        });

        // Remove tag functionality
        $('.selectedElements').on('click', '.tag', function () {
            if (selectedValues.length > 0) {
                $('#reset-filters').show();
            }
            var value = $(this).text();
            // Remove the value from the selected values array
            selectedValues = $.grep(selectedValues, function (val) {
                return val !== value;
            });
            $(this).remove();
            showLoader();
            localStorage.setItem('selectedValues', JSON.stringify(selectedValues));
            isFiltering = true;
            currentPage = 1; // Сбрасываем страницу на 1
            filterCandidates();
        });

        // Reset filter functionality
        $('.selectedElements').on('click', '.reset', function () {
            selectedValues = [];
            $('.tag').remove();
            localStorage.setItem('selectedValues', JSON.stringify(selectedValues));
            filterCandidates();
        });

        $('#reset-filters').on('click', function () {
            selectedValues = [];
            $('.tag').remove();
            $('.kandItem1').show();
            localStorage.setItem('selectedValues', JSON.stringify(selectedValues));
            localStorage.setItem('filters', JSON.stringify([]));
            localStorage.setItem('selectedCountries', JSON.stringify([]));
            $('input[type=checkbox]').prop('checked', false);
            $('#vac_speciality').val('');
            $('#vac_addspeciality').val('');
            $('#vac_notech').val('');
            $('#vac_country').val('');
            // $('#opyt_vacans_input').val(0);
            // $('#opyt_vacans').val('');
            $('#zarpl').val('');
            $('#zarpl_to').val('');

            // Обновите состояние чекбоксов в соответствии с сохраненными фильтрами
            $('.spec1-checkbox').each(function () {
                if (spec1.includes($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"))) {
                    $(this).prop('checked', false);
                }
            });
            englishLevels.forEach(function(level) {
                $(`input[data-level='${level}']`).prop('checked', false);
            });
            workFormats.forEach(function(format) {
                $(`input[data-level='${format}']`).prop('checked', false);
            });
            datacontact.forEach(function(comm) {
                $(`input[data-level='${comm}']`).prop('checked', false);
            });
            $('.multiselect .countrySing').removeClass('selected');
            isFiltering = true;
            currentPage = 1; // Сбрасываем страницу на 1
            filterCandidates();
        });

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
        }, 150);
/////////////////////////// DO FILTER LOADMORE //////////////////////////////////////////////////////
//         $('#pipe_filtrs').on("change keyup", function () {
//             isFiltering = true;
//             currentPage = 1; // Сбрасываем страницу на 1
//             filterCandidates();
//         });
        // $('#load-more').on('click', function() {
        //     // applyFilter(currentPage + 1)
        //     filterCandidates(currentPage + 1); // загружаем следующую страницу
        //     // isFiltering = true;
        // });

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
    $('body').on('click', '.getToVac', function (e) {
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
            'cstage': $('#mStage').val(),
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

        $(document).ready(function() {
            $('#filterToggle').click(function() {
                $('#filterBox').slideToggle();
                $('#filterBox').css('display','flex');
            });
        });

        $('#mVac2').change(function() {
            var vacancy_id = $(this).val();
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                method: 'POST',
                data: {
                    action: 'load_stages2',
                    vacancy_id: vacancy_id
                },
                success: function(response) {
                    $('#mStage2').html(response).show();
                }
            });
        });

        $(document).ready(function() {
            $('#saveMove2').click(function(e) {
                e.preventDefault();

                // Получаем выбранные значения
                var selectedVacancyId = $('#mVac2').val();
                var selectedStage = $('#mStage2').val();

                // Получаем текущий ID пользователя
                var currentUserId = $("h2[data-rekr]").attr('data-rekr');

                // Записываем значения в соответствующие ACF поля
                $('input[name="acf[field_61c960e73d8fb]"]').val(selectedVacancyId);
                $('input[name="acf[field_645cbc28484bf]"]').val(selectedStage);
                $('input[name="acf[field_61c95ce43d8f9]"]').val(currentUserId);


                // Отправляем форму
                $('.popup_form.addNewCand form').submit();
            });
        });
    })(jQuery);

    document.getElementById('getToVac2').addEventListener('click', function() {
        document.getElementById('moveToRekr2').style.display = 'block';
    });

    document.getElementById('close1').addEventListener('click', function() {
        document.getElementById('moveToRekr2').style.display = 'none';
    });

// ----------------------------------- cantries filter load values --------------------------
    $('#loadRes7').load(surl6 + "/wp-content/themes/devport/functions/load_countries_filter.php",  {
        cu6: parseInt($('#cu6').html(), 10) });
});

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

