jQuery(document).ready(function ($) {
    $(document).on('click', '.openEditFilter', function () {
        $('body').toggleClass('activeEditor');
        $('#button1, #button2').toggleClass('editable-button');
        let isEditable = $('#button1, #button2').attr('contenteditable') === 'true';
        $('#button1, #button2').attr('contenteditable', !isEditable);
        let isTitleEditable = $('.accordion-title.editable').attr('contenteditable') === 'true';
        $('.accordion-title.editable').attr('contenteditable', !isTitleEditable);
        if($('#button2').text() !== '+') {
            $('#button2').css('display','inline-block');
        }
    });
    $('.left_vac.pipe').on('click','#button1',function () {
        $('.spec_wrapper-language').css('display','block');
        $('.spec_wrapper-noitposts').css('display','none');
        $('.specnoit').css('display','none');
        localStorage.setItem('clickedButton', this.id);
        $('#button2').removeClass('active');
        $(this).addClass('active');
        $('body').removeClass('activebtn2');
        $('body').addClass('activebtn1');
    });
    $('.left_vac.pipe').on('click','#button2',function () {
        $('.spec_wrapper-language').css('display','none');
        $('.spec_wrapper-noitposts').css('display','block');
        $('.specnoit').css('display','block');
        localStorage.setItem('clickedButton', this.id);
        $('#button1').removeClass('active');
        $(this).addClass('active');
        $('body').removeClass('activebtn1');
        $('body').addClass('activebtn2');
    });
    // Edit main top buttons
    $(document).on('click', '.editable-button', function() {
        $('#button1, #button2').attr('contenteditable', 'true');
        $(this).attr('contenteditable', 'true');
    });
    $(document).on('blur', '.editable-button', function() {
        var button_id = $(this).attr('id');
        var new_text = $(this).text();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'update_button_text',
                button_id: button_id,
                new_text: new_text
            },
            success: function(response) {
                $('#button1, #button2').attr('contenteditable', 'false');
            }
        });
    });

    ///////////////////////////////           Delete blocks         /////////////////////////////////////////////////
    $(document).on('click', '.delete-block-button', function() {
        var block_id = $(this).parent().attr('id').replace('spec_wrapper', '');
        var deleteButton = $(this);

        $('#confirm-dialog-block').dialog({
            resizable: false,
            height: 'auto',
            width: 400,
            modal: true,
            buttons: {
                'Да': function() {
                    $(this).dialog('close');
                    $.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        type: 'POST',
                        data: {
                            action: 'delete_block',
                            block_id: block_id
                        },
                        success: function(response) {
                            if (response.success) {
                                // Создаем кнопку восстановления
                                var restoreButton = $('<div>', {
                                    class: 'restore-block-button',
                                    'data-blockid': block_id  // Устанавливаем block_id в качестве значения data-blockid
                                }).text('Відновити підрозділ');
                                // Добавляем кнопку восстановления в блок
                                var block = deleteButton.parent();
                                block.append(restoreButton);
                                // Перемещаем блок в раздел удаленных блоков
                                $('#deleted-blocks-section').append(block);
                            } else {
                                console.log('Виникла помилка при видаленні блока.');
                            }
                        }
                    });
                },
                'Нет': function() {
                    $(this).dialog('close');
                }
            }
        });
    });

///////////////////////////          Restore block          ////////////////////////////////////////
    $(document).on('click', '.restore-block-button', function() {
        var block_id = $(this).data('blockid');
        var restoreButton = $(this);

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'restore_block',
                block_id: block_id
            },
            success: function(response) {
                if (response.success) {
                    // Убираем блок из списка удаленных блоков
                    var block = restoreButton.parent();
                    // Получаем post_type блока
                    var post_type = block.data('posttype');
                    // Добавляем блок обратно в список активных блоков перед кнопкой добавления
                    block.insertBefore('#add-block-button-' + post_type);
                    restoreButton.remove();
                } else {
                    console.log('Виникла помилка при восстановлении блока.');
                }
            }


        });
    });
    ////////////////////////// Отправляем AJAX запрос для получения данных о кнопках         /////////////////////
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            method: 'POST',
            data: {
                action: 'get_buttons_from_db'
            },
            success: function(data) {
                if (data.success) {
                    // Если данные получены, обновляем текст кнопок
                    for (var i = 0; i < data.data.length; i++) {
                        $('#' + data.data[i].button_id).text(data.data[i].text);
                    }
                    if($('#button2').text() !== '+') {
                        $('#button2').css('display','inline-block');
                    }
                } else {
                    // Если данных нет, выводим сообщение об ошибке
                    console.log(data.data);
                }
            },
            error: function() {
                console.log('Виникла помилка при отриманні данних кнопок.');
            }
        });
// Edit filter title
//     $('#pipe_filtrs').on('blur', '.editable', function() {
//         var post_id = $(this).data('postid');
//         var new_content = $(this).text();
//         var content_id = $(this).attr('id');
//
//         $.ajax({
//             url: '/wp-admin/admin-ajax.php',
//             type: 'POST',
//             data: {
//                 action: 'update_post_title',
//                 post_id: post_id,
//                 new_content: new_content,
//                 content_id: content_id
//             },
//             success: function( response ) {
//                 console.log( response );
//             }
//         });
//     });
    $(document).on('click', '.accordion-title', function (){
        $(this).parent().toggleClass('show');
        $(this).parent().find('.vac_speciality').toggle('fast');
        $(this).parent().find('.lang_left').toggle('fast');
    });
    $(document).on('click', '.accordion-title-blocks', function (){
        $(this).parent().toggleClass('show');
        $(this).parent().find('#deleted-blocks-section').toggle('fast');
    });
    $('#pipe_filtrs').on('blur', '.editable', function() {
        // Извлекаем block_id из id элемента, удалив "accordion-title-" из начала
        var block_id = parseInt($(this).attr('id').replace('accordion-title-', ''));
        var new_title = $(this).text();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'update_block_title',
                block_id: block_id,
                new_title: new_title
            },
            success: function( response ) {
                console.log( response );
            }
        });
    });
    ///////////////// add new block filter
    var blockCount = 1;
    function addBlock(blockCount, title, post_type, deleted) {
        // Создаем новый блок
        var newBlock = $('<div>', {id: 'spec_wrapper' + blockCount, class: 'spec_wrapper-' + post_type + ' fiw', 'data-posttype': post_type});
        newBlock.append($('<h3>', {
            id: 'accordion-title-' + blockCount,
            class: 'accordion-title editable',
            contenteditable: "false"
        }).text(title));
        newBlock.append($('<div>', {id: 'vac_speciality' + blockCount, class: 'vac_speciality'}));

        if (deleted == "0") {
            newBlock.append($('<button>', {class: 'delete-block-button'}).text('Видалити підрозділ'));
            newBlock.insertBefore('#add-block-button-' + post_type);  // Добавляем блок перед кнопкой добавления
        } else {
            var restoreButton = $('<div>', {
                class: 'restore-block-button',
                'data-blockid': blockCount  // Устанавливаем block_id в качестве значения data-blockid
            }).text('Відновити підрозділ');
            newBlock.append($('<button>', {class: 'delete-block-button'}).text('Видалити підрозділ'));
            newBlock.append(restoreButton);
            newBlock.appendTo('#deleted-blocks-section');  // Добавляем блок в контейнер для удаленных блоков
        }

        // Отправляем AJAX запрос для получения постов для этого block_id
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            method: 'POST',
            data: {
                action: 'get_posts_for_block',
                block_id: blockCount,
                post_type: post_type
            },
            success: function (data) {
                if (data.success) {
                    newBlock.find('#vac_speciality' + blockCount).append(data.data.html);
                } else {
                    console.log(data.data.html);
                }
            },
            error: function () {
                console.log('Виникла помилка при отриманні данних постів.');
            }
        });
    }


    // При загрузке страницы получаем все блоки из базы данных
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        method: 'POST',
        data: {
            action: 'get_blocks'
        },
        success: function(data) {
            if (data.success) {
                $.each(data.data, function(index, block) {
                    addBlock(block.block_id, block.title, block.post_type, block.deleted);
                    if (block.block_id > blockCount) {
                        blockCount = block.block_id;
                    }
                });
                blockCount++;
            } else {
                console.log(data.data);
            }
        },
        error: function() {
            console.log('Произошла ошибка при получении блоков.');
        }
    });

    // При нажатии на кнопку добавляем новый блок
    $('#add-block-button-language, #add-block-button-noitposts').click(function(e) {
        e.preventDefault();

        var title = prompt('Введіть назву блоку:');
        var post_type = $(this).data('type');
        if (title) {
            // Сохраняем блок в базе данных
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                method: 'POST',
                data: {
                    action: 'save_block',
                    block_id: blockCount,
                    post_type: post_type,
                    title: title
                },
                success: function(data) {
                    if (data.success) {
                        addBlock(blockCount, title, post_type);
                        blockCount++;
                    } else {
                        console.log(data.data);
                    }
                },
                error: function() {
                    console.log('Произошла ошибка при сохранении блока.');
                }
            });
        }
    });

    $(document).on('submit', '.custom-post-form', function(e) {  // Замените 'post_type' на ваш тип поста
        e.preventDefault();  // Это предотвратит обычную отправку формы

        var form = $(this);
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: form.serialize() + '&action=create_custom_post',

            success: function(data) {
                if (data.error) {
                    $('#error-notification').text(data.message).fadeIn().delay(5000).fadeOut();
                } else {
                    // Обновите страницу или добавьте новый пост на страницу здесь
                    setTimeout(function () {
                        var newPostHtml = '<label class="chbwr">' +
                            '<input type="checkbox" class="spec1-checkbox hidden-checkbox" value="' + data.post_title + '" maxlength="32">' +
                            '<span class="chbwr-text">' + data.post_title + '</span>' +
                            '<button class="delete-post-button" data-id="' + data.post_id + '" data-nonce="' + data.nonce + '" data-metakey="spec1">×</button>' +
                            '</label>';
                        $(form).before(newPostHtml);

                        // Add click event handler to the new delete button
                        $('.delete-post-button').last().on('click', function() {
                            var deleteButton = $(this);
                            var postId = $(this).data('id');
                            var nonce = $(this).data('nonce');
                            var meta_key = $(this).data('metakey');

                            var data = {
                                'action': 'delete_custom_post',
                                'meta_key': meta_key,
                                'post_id': postId,
                                'nonce': nonce
                            };

                            $('#confirm-dialog').dialog({
                                resizable: false,
                                height: 'auto',
                                width: 400,
                                modal: true,
                                buttons: {
                                    'Да': function() {
                                        $(this).dialog('close');

                                        $.post(ajaxurl, data, function(response) {
                                            if(response === 'success') {
                                                alert('Позицію видалено');
                                                deleteButton.parent().remove();
                                            } else {
                                                alert('Помилка при видалені позиції');
                                            }
                                        });
                                    },
                                    'Нет': function() {
                                        $(this).dialog('close');
                                    }
                                }
                            });
                        });
                        $('.custom-post-form input[type="text"]').val('');
                        form[0].reset();
                    }, 500);
                }
            },
            error: function() {
                console.error('There was an error submitting the form.');
            }
        });
    });
///////////// Видалення поста фільтра
    $(document).on('click', '.delete-post-button', function() {
        var deleteButton = $(this);
        var postId = $(this).data('id');
        var nonce = $(this).data('nonce');
        var meta_key = $(this).data('metakey');

        var data = {
            'action': 'delete_custom_post',
            'meta_key': meta_key,
            'post_id': postId,
            'nonce': nonce
        };

        $('#confirm-dialog').dialog({
            resizable: false,
            height: 'auto',
            width: 400,
            modal: true,
            buttons: {
                'Да': function() {
                    $(this).dialog('close');

                    $.post(ajaxurl, data, function(response) {
                        if(response === 'success') {
                            alert('Позицію видалено');
                            deleteButton.parent().remove();  // Удалить родительский элемент кнопки
                            // location.reload();  // Перезагрузить страницу
                        } else {
                            alert('Помилка при видалені позиції');
                        }
                    });

                },
                'Нет': function() {
                    $(this).dialog('close');
                }
            }
        });

    });

///////////// Кінець Видалення поста фільтра
////////////////////     Check for duplicate post /////////////////////////
    // $(document).on('submit', '#custom-post-form', function(event) {
    //     event.preventDefault();
    //
    //     var formData = $(this).serialize() + '&action=create_custom_post';
    //
    //     $.ajax({
    //         type: "POST",
    //         url: '/wp-admin/admin-ajax.php',
    //         data: formData,
    //         success: function(response) {
    //             if (response.error) {
    //                 alert(response.message);
    //             } else {
    //                 alert('Пост успешно создан!');
    //                 // здесь вы можете обновить ваш список постов или сделать что-то еще
    //             }
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             alert('Произошла ошибка при создании поста.');
    //         }
    //     });
    // });



    // Проверяем все чекбоксы при загрузке страницы
    checkCheckboxes();

    // Проверяем все чекбоксы при изменении любого из них
    $('#vac_mova .chbwr .spec1-checkbox').change(checkCheckboxes);

function checkCheckboxes() {
    if ($('#vac_mova .chbwr .spec1-checkbox').is(':checked')) {
        // Если хотя бы один чекбокс отмечен, добавляем класс
        $('.mova_wrapper').addClass('mova_ch');
    } else {
        // Если ни один чекбокс не отмечен, удаляем класс
        $('.mova_wrapper').removeClass('mova_ch');
    }
}

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

    $(document).ready(function() {
        $('#user_select').select2({
            closeOnSelect : false,
        });
        $('#user_select').on('select2:select', function (e) {
            var selectedOptions = $(this).val();  // Получаем массив выбранных значений
            if (selectedOptions.length > 1 && selectedOptions.includes('all')) {
                // Если выбрано более 1 значения и среди них "Все", то снимаем выделение с "Все"
                var index = selectedOptions.indexOf('all');
                if (index > -1) {
                    selectedOptions.splice(index, 1);
                }
                $(this).val(selectedOptions).trigger('change');
            }
        });
    });
    $(document).on('mousedown', function (e) {
        var opened = $(".select2-container--open");
        if (opened.length > 0) {
            var inContainer = opened.has(e.target).length > 0;
            var isContainer = opened.is(e.target);

            if (!inContainer && !isContainer) {
                var instances = $.fn.select2.amd.require('select2/dropdown/closeOnSelect');
                instances.close();
            }
        }
    });


    let spec1 = [];
    let mova = [];
    let regExName = '';
    let regCountry = '';
    let oput = '';
    let zarpl = '';
    let zarpl_to = '';
    let workFormats = '';
    let tags = '';
    let englishLevels = '';
    let datacontact = '';
    let datefrom = '';
    let dateto = '';
    let hasCv = false;
    let uid = '';
    let sort = '';
    let user_ids = [];

    $('#sortAsc').click(function() {
        sort = 'ASC';
        isFiltering = true;
        currentPage = 1; // Сбрасываем страницу на 1
        filterCandidates();
    });

    $('#sortDesc').click(function() {
        sort = 'DESC';
        isFiltering = true;
        currentPage = 1; // Сбрасываем страницу на 1
        filterCandidates();
    });
    $("#zarpl_to_actual").focus(function () {
        $(this).css("display","none");
        $('#zarpl_to').css("display","inline");
    });
    $(document).ready(function() {
        setTimeout(function () {
            let savedFilters = localStorage.getItem('filters');
            let parsedFilters = JSON.parse(savedFilters);
            if (!savedFilters || (Array.isArray(parsedFilters) && parsedFilters.length === 0)) {
                let defaultFilters = {
                    spec1: [],
                    mova: [],
                    oput: "0",
                    zarpl: "",
                    zarpl_to: "",
                    regCountry: [],
                    workFormats: [],
                    tags: [],
                    englishLevels: [],
                    datacontact: [],
                    datefrom: "",
                    dateto: "",
                    hasCv: false,
                    uid: "",
                    sort: "",
                    user_ids: []
                };
                localStorage.setItem('filters', JSON.stringify(defaultFilters));
                savedFilters = localStorage.getItem('filters');
            }
            if (savedFilters) {
                let filters = JSON.parse(savedFilters);
                spec1 = filters.spec1;
                mova = filters.mova;
                regExName = filters.regExName;
                regCountry = filters.regCountry;
                oput = filters.oput;
                zarpl = filters.zarpl;
                zarpl_to = filters.zarpl_to;
                workFormats = filters.workFormats;
                tags = filters.tags;
                englishLevels = filters.englishLevels;
                datacontact = filters.datacontact;
                datefrom = filters.datefrom;
                dateto = filters.dateto;
                hasCv = filters.hasCv;
                sort = filters.sort;
                uid = filters.uid;
                user_ids = filters.user_ids;
                $('#vac_speciality').val(regExName);
                $('#vac_mova').val(mova);
                $('#vac_country').val(regCountry);
                $('#opyt_vacans_input').val(oput);
                $('#opyt_vacans').text(oput);
                $('#zarpl').val(zarpl);
                $('#zarpl_to').val(zarpl_to);
                $('#dateFrom').val(datefrom);
                $('#dateTo').val(dateto);
                $('#user_ids').val(user_ids);
                $('.spec1-checkbox').each(function () {
                    if (spec1.includes($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"))) {
                        $(this).prop('checked', true);
                    }
                });
                if(hasCv === true) {
                    $('#cv_ch').prop('checked', true);
                }
                if(uid === true) {
                    $('#cv_ch').prop('checked', true);
                }
                $('.spec1-checkbox').each(function () {
                    if (spec1.includes($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"))) {
                        $(this).prop('checked', true);
                    }
                });
                englishLevels.forEach(function(level) {
                    $(`input[data-number='${level}']`).prop('checked', true);
                });
                if(workFormats) {
                    workFormats.forEach(function (format) {
                        $(`input[data-level='${format}']`).prop('checked', true);
                    });
                }
                if(tags) {
                    tags.forEach(function (ta) {
                        $(`input[data-level='${ta}']`).prop('checked', true);
                    });
                }
                datacontact.forEach(function(comm) {
                    $(`input[data-level='${comm}']`).prop('checked', true);
                });
                isFiltering = true;
                currentPage = 1; // Сбрасываем страницу на 1
                filterCandidates();
            }
            if($('#button2').text() !== '+') {
                $('#button2').css('display','inline-block');
            }
        }, 0);
    });
    $(document).ajaxComplete(function() {
    var clickedButtonId = localStorage.getItem('clickedButton');
    if (clickedButtonId) {
        $('#' + clickedButtonId).addClass('active').trigger('click');
    }
    });
    let currentPage = 1;
    let tech_count = '';
    let total_count = '';
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
    });
    function filterCandidates(page) {
        if (ajaxInProgress) return;
        showLoader();
        let phpCount = $('#phpCount').val();
        let englishLevels = [];
        let hasCv = $('#cv_ch').is(':checked');  // Чекбокс отмечен или нет
        let uid = $('#my-candidates-checkbox').is(':checked');  // Чекбокс отмечен или нет
        let user_ids = $('#user_select').val();
        $(".engl .custom-control-input:checked").each(function() {
            englishLevels.push($(this).data('number'));
        });
        let tags = [];
        $('.vac_tags').each(function() {
            if ($(this).is(':checked')) {
                tags.push($(this).val());
            }
        });
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
        let datefrom = $('#dateFrom').val();
        let dateto = $('#dateTo').val();
        let zarpl = $('#zarpl').val();
        let zarpl_to = $('#zarpl_to').val();
        if(zarpl=='') {
            zarpl = 0;
        }
        if(zarpl_to=='') {
            zarpl_to = 14000000;
        }
        let oput = $('#opyt_vacans_input').val();
        if($('#opyt_vacans_input').val() == '7.5') {
            oput = 0;
        }
        spec1 = [];
        $('.spec1-checkbox:checked').each(function () {
            spec1.push($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"));
        });
        mova = [];
        $('#vac_mova .spec1-checkbox:checked').each(function () {
            mova.push($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"));
        });
        let myCandidatesOnly = $('#my-candidates-checkbox').is(':checked');

        $('.dp_post_count2').html(`
    Кандидатів на сайті: ${phpCount}
    `);
        setTimeout(function () {
            $(".kandItem1").filter(function () {
                let rtnData = "";
                let matchCount = 0;
                let mCount = 0;
                let regExNames = [];
                $('[id^="vac_speciality"]').each(function(){
                    let value = $(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
                    regExNames.push(value);
                });
                let mova = $('#vac_mova').val().map(function(item) {
                    return item.trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
                });
                let oput = $('#opyt_vacans_input').val();
                let oputattr = $(this).data("oput");
                if (oputattr==''){oputattr=0;}
                for (let value of spec1) {
                    let regEx = new RegExp(value, "ig");
                    if ($(this).attr("data-spec1").match(regEx)) {
                        matchCount++;
                    }
                }
                for (let valuem of mova) {
                    let regExm = new RegExp(valuem, "ig");  // Используем valuem вместо value
                    if ($(this).attr("data-spec1").match(regExm)) {
                        mCount++;
                    }
                }
                let hasResume = $(this).data("pdf") !== "";  // Проверка на наличие резюме
                rtnData = (
                    matchCount === spec1.length &&
                    $(this).attr("data-spec1").match(regExName) &&
                    mCount === mova.length &&
                    $(this).attr("data-mova").match(mova) &&
                    $(this).data("zar") >= zarpl &&
                    $(this).data("zar") <= zarpl_to &&
                    (workFormats.length === 0 || workFormats.some(format => $(this).data("work_format").includes(format))) &&
                    (tags.length === 0 || tags.some(ta => $(this).data("tags").includes(ta))) &&
                    ($('#vac_country').val() === '' || $('#vac_country').val().split('|').some(country => country === $(this).attr("data-country"))) &&
                    oputattr >= oput &&
                    (datefrom || dateto) &&
                    (englishLevels.length === 0 || englishLevels.some(level => $(this).data("angl").includes(level))) &&
                    (datacontact.length === 0 || datacontact.some(comm => $(this).data("cont").includes(comm))) &&
                    (!hasCv || hasResume) &&
                    (uid) &&
                    (user_ids) &&
                    (sort)
                );
                return rtnData;
            });
        }, 0);
        function filterDelay2() {
        }setTimeout(filterDelay2, 100);
        let filters = {
            spec1: spec1,
            mova: mova,
            regExName: regExName,
            regCountry: regCountry,
            oput: oput,
            zarpl: zarpl,
            zarpl_to: zarpl_to,
            workFormats: workFormats,
            tags: tags,
            englishLevels: englishLevels,
            datacontact: datacontact,
            datefrom: datefrom,
            dateto: dateto,
            hasCv: hasCv,
            uid: uid,
            sort: sort,
            user_ids: user_ids
        };
        let selectedCountries = JSON.parse(localStorage.getItem('selectedCountries')) || [];
        let selectedValues = JSON.parse(localStorage.getItem('selectedValues')) || [];
        let blacklistChecked = JSON.parse(localStorage.getItem('blacklistChecked')) || false;
        localStorage.setItem('filters', JSON.stringify(filters));
        ajaxInProgress = true;
        $('.left_vac.pipe').css('pointer-events','none');
        $('#reset-filters').css('pointer-events','none');
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: 'filter_posts',
                page: currentPage,
                filters: filters ? filters : {"spec1":[],"mova":[],"regExName":"","regCountry":"","oput":"0","zarpl":"0","zarpl_to":14000000,"workFormats":[],"tags":[],"englishLevels":[],"datacontact":[],"datefrom":"","dateto":"","hasCv":false,"uid":"","sort":"", "user_ids":[]},
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
                currentPage = response.currentPage;
                tech_count = response.tech_count;
                total_count = response.total_count;
                maxPages = response.maxPages;
                $('.vac_filter_rest .fon').text(total_count);
                $('.vac_filter_rest .son').text(tech_count);
                $('.page-numbers.current').text(currentPage);
                $('.prev.page-numbers').prop('disabled', currentPage === 1);
                $('.next.page-numbers').prop('disabled', currentPage === maxPages);
                if (currentPage < maxPages) {
                    jQuery('#load-more').show();
                } else {
                    jQuery('#load-more').hide();
                }
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

                $('.bk_cont a, .kinfo1 .cont a').each(function() {
                    if (!$(this).css('background-image') || $(this).css('background-image') === 'none') {
                        var classes = $(this).attr('class').split(' ');
                        var bkClass = '';
                        for (var i = 0; i < classes.length; i++) {
                            if (classes[i].indexOf('bk_') === 0) {
                                bkClass = classes[i];
                                break;
                            }
                        }
                        var firstTwoLetters = bkClass.replace('bk_', '').substring(0, 2);
                        $(this).append('<b class="cropped">' + firstTwoLetters + '</b>');
                    }
                });
                filterDelay2();
                hideLoader();
                var submitButton = $('.acf-form-submit input[type="submit"]');
                if (submitButton.length > 0) {
                    submitButton.removeAttr('disabled');
                }
            },
            error: function(error) {
                console.log('Failed to filter posts:', error);
            },
            complete: function() {
                ajaxInProgress = false;
                $('.left_vac.pipe').css('pointer-events','all');
                $('#reset-filters').css('pointer-events','all');
            },
        });
    }

    $(document).on("change keyup", '#vac_speciality, [class^="vac_speciality"], #vac_mova, #vac_addspeciality, #vac_notech, #vac_country, #opyt_vacans_input, #zarpl, #zarpl_to, .engl input, .communications input, #vac_work_format, #vac_tag, #cv_ch, #my-candidates-checkbox, #user_select', function (event) {
        if ($(event.target).closest('.custom-post-form').length === 0) {
            // Элемент, вызвавший событие, не находится внутри формы '.custom-post-form'
            isFiltering = true;
            currentPage = 1; // Сбрасываем страницу на 1
            filterCandidates();
        }
    });
    $(document).on("change keyup", '#dateFrom', function (event) {
        if ($(event.target).closest('.custom-post-form').length === 0) {
            var fromDate = $(this).val();
            $('#dateTo').attr('min', fromDate);
            isFiltering = true;
            currentPage = 1; // Сбрасываем страницу на 1
            filterCandidates();
        }
    });
    $(document).on("change keyup", '#dateTo', function (event) {
        if ($(event.target).closest('.custom-post-form').length === 0) {
            var toDate = $(this).val();
            $('#dateFrom').attr('max', toDate);
            isFiltering = true;
            currentPage = 1; // Сбрасываем страницу на 1
            filterCandidates();
        }
    });

    $('#save-filter').on('click', function() {
        let filters = JSON.parse(localStorage.getItem('filters')) || {};
        let cou = JSON.parse(localStorage.getItem('selectedCountries')) || {};
        let filterName = $('#filter-name').val();

        if (!filterName) {
            alert("Будь ласка назвіть фільтр.");
            return;
        }

        let savedFiltersBz = JSON.parse(localStorage.getItem('savedFiltersBz')) || {};
        let savedCou = JSON.parse(localStorage.getItem('savedCou')) || {};
        savedFiltersBz[filterName] = filters;
        savedCou[filterName] = cou;
        localStorage.setItem('savedFiltersBz', JSON.stringify(savedFiltersBz));
        localStorage.setItem('savedCou', JSON.stringify(savedCou));
        updateSavedFilters();
        setTimeout(function () {
            $('#filter-name').val('');
        },300 );
    });

    function updateSavedFilters() {
        let savedFiltersBz = JSON.parse(localStorage.getItem('savedFiltersBz')) || {};
        let savedCou = JSON.parse(localStorage.getItem('savedCou')) || {};
        $('#saved-filters').empty();

        for (let name in savedFiltersBz) {
            let btn = $('<button class="filbtn">')
                .text(name)
                .on('click', function () {
                    localStorage.setItem('selectedCountries', JSON.stringify(savedCou[name]));
                    setTimeout(function () {
                        $('.multiselect .countrySing').each(function () {
                            if (savedCou[name].includes($(this).text().replace(/×/g, '').trim())) {
                                $(this).addClass('selected');
                            }
                        });
                        $('#vac_country').attr('value', savedCou[name].join('|'));
                        updateSelectedCountries();
                    },350 );
                    localStorage.setItem('filters', JSON.stringify(savedFiltersBz[name]));
                    setTimeout(function () {
                        let savedFilters = localStorage.getItem('filters');
                        if (savedFilters) {
                            let filters = JSON.parse(savedFilters);
                            spec1 = filters.spec1;
                            mova = filters.mova;
                            regExName = filters.regExName;
                            regCountry = filters.regCountry;
                            oput = filters.oput;
                            zarpl = filters.zarpl;
                            zarpl_to = filters.zarpl_to;
                            workFormats = filters.workFormats;
                            tags = filters.tags;
                            englishLevels = filters.englishLevels;
                            datacontact = filters.datacontact;
                            datefrom = filters.datefrom;
                            dateto = filters.dateto;
                            hasCv = filters.hasCv;
                            sort = filters.sort;
                            uid = filters.uid;
                            user_ids = filters.user_ids;
                            $('#vac_speciality').val(regExName);
                            $('#vac_mova').val(mova);
                            $('#vac_country').val(regCountry);
                            $('#opyt_vacans_input').val(oput);
                            $('#opyt_vacans').text(oput);
                            $('#zarpl').val(zarpl);
                            $('#zarpl_to').val(zarpl_to);
                            $('#dateFrom').val(datefrom);
                            $('#dateTo').val(dateto);
                            $('#user_ids').val(user_ids);
                            $('.spec1-checkbox').each(function () {
                                if (spec1.includes($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"))) {
                                    $(this).prop('checked', true);
                                }
                            });
                            if(hasCv === true) {
                                $('#cv_ch').prop('checked', true);
                            }
                            if(uid === true) {
                                $('#cv_ch').prop('checked', true);
                            }
                            $('.spec1-checkbox').each(function () {
                                if (spec1.includes($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"))) {
                                    $(this).prop('checked', true);
                                }
                            });
                            englishLevels.forEach(function(level) {
                                $(`input[data-number='${level}']`).prop('checked', true);
                            });
                            if(workFormats) {
                                workFormats.forEach(function (format) {
                                    $(`input[data-level='${format}']`).prop('checked', true);
                                });
                            }
                            if(tags) {
                                tags.forEach(function (ta) {
                                    $(`input[data-level='${ta}']`).prop('checked', true);
                                });
                            }
                            datacontact.forEach(function(comm) {
                                $(`input[data-level='${comm}']`).prop('checked', true);
                            });
                            isFiltering = true;
                            currentPage = 1; // Сбрасываем страницу на 1
                        }
                    },350 );
                    filterCandidates();
                });
            let delBtn = $('<button class="delbtn">')
                .text('✖')
                .on('click', function () {
                    delete savedFiltersBz[name];
                    delete savedCou[name];
                    localStorage.setItem('savedFiltersBz', JSON.stringify(savedFiltersBz));
                    localStorage.setItem('savedCou', JSON.stringify(savedCou));
                    updateSavedFilters();
                    filterCandidates();
                });
            let wrapper = $('<div>').addClass('btn-wrapper');
            wrapper.append(btn, delBtn);
            $('#saved-filters').append(wrapper);
        }
    }

    updateSavedFilters();


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
            return $(a).text().localeCompare($(b).text().replace(/×/g, '').trim());
        });
        let unselectedItems = $('.multiselect .countrySing:not(.selected)').sort(function (a, b) {
            return $(a).text().localeCompare($(b).text().replace(/×/g, '').trim());
        });

        $('.multiselect').html(selectedItems).append(unselectedItems);
    }

    let countryNames = [];
    $('.multiselect .countrySing').each(function () {
        let countryName = $(this).text().replace(/×/g, '').trim();
        countryNames.push(countryName);
    });

    $("#countrySearch").autocomplete({
        source: countryNames,
        select: function (event, ui) {
            let selectedItem = $('.multiselect .countrySing').filter(function () {
                return $(this).text().replace(/×/g, '').trim() === ui.item.value;
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
            let countryText = $(this).contents().filter(function() {
                return this.nodeType === 3; // Node.TEXT_NODE
            }).text().replace(/×/g, '').trim();
            selectedCountries.push(countryText);
        });
        $('#vac_country').attr('value', selectedCountries.join('|'));
        localStorage.setItem('selectedCountries', JSON.stringify(selectedCountries));
    }


    $(document).ready(function() {
        setTimeout(function () {
            let selectedCountries = JSON.parse(localStorage.getItem('selectedCountries')) || [];
            $('.multiselect .countrySing').each(function () {
                if (selectedCountries.includes($(this).text().replace(/×/g, '').trim())) {
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
            $temp.val($(element).find('span:first').text()).select();
            document.execCommand("copy");
            $temp.remove();
        }

        $(document).on('click', '.cp_btn', function () {
            let cpbk = $(this).attr('id');
            copyToClipboard('#'+cpbk);
            $(this).parent().append('<div class="coppytext">Скопійовано</div>');
            setTimeout(function () {
                $('.coppytext').remove();
            }, 1500);
        });


        $(function(){
            $('body').on('click', '.modalCv', function () {
                $('.pipeCont .myCandW.baza').css('transform','none');
                    let cvmodal = $(this).parent();
                setTimeout(function () {
                    cvmodal.addClass('active');
                }, 150 );
            });
            $('body').on('click', "#modal-background, #modal-close", function () {
                $('.pipeCont .myCandW.baza').css('transform','scale(1.02)');
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
            tags.forEach(function(ta) {
                $(`input[data-level='${ta}']`).prop('checked', false);
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
$(document).on('click', '.editpopup', function () {
    $('.ppover').css('display','block');
    $('.maincommentPopup').css('display','block');
});
$(document).on('click', '.ppover', function () {
    $('.ppover').css('display','none');
    $('.maincommentPopup').css('display','none');
});
$(document).on('click', '.closecomment', function () {
    $('.ppover').css('display','none');
    $('.maincommentPopup').css('display','none');
});
        $(document).on('click', '#sotrInfo', function () {
            $('.modalBg').css('display','block');
            $('.modalSotrIn').css('display','block');
        });
        $(document).on('click', '.modalBg', function () {
            $('.modalBg').css('display','none');
            $('.modalSotrIn').css('display','none');
        });

// Начинаем наблюдение за DOM
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if ($(mutation.addedNodes).length) {
                    let dateInput = $('#acf-field_612297b1e717a[type="hidden"]');
                    if (dateInput.length) {
                        dateInput.on('change', calculateAge);
                        let ageElement = $('<div id="age"></div>');
                        dateInput.after(ageElement);
                        observer.disconnect();  // Останавливаем наблюдение после нахождения нужного поля
                    }
                }
            });
        });

        observer.observe(document, { childList: true, subtree: true });

        function calculateAge(event) {
            let dateString = $(this).val();  // получим строку вида "20060811"
            let year = parseInt(dateString.slice(0, 4), 10);
            let month = parseInt(dateString.slice(4, 6), 10) - 1;  // месяцы в JavaScript начинаются с 0
            let day = parseInt(dateString.slice(6, 8), 10);
            let birthDate = new Date(year, month, day);
            let today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            console.log(today);
            console.log(birthDate);
            let m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            // Находим элемент для вывода возраста и обновляем его
            let ageElement = $('#age');
            if (ageElement.length) {
                ageElement.text("Age: " + age);
            }
        }

        let dateInput = $('#acf-field_612297b1e717a[type="hidden"]');
        if (dateInput.length) {
            $(document).on('change', dateInput,function () {
                let age = calculateAge();
                console.log(age);
                let ageElement = $('<div id="age">Age: ' + age + '</div>');
                dateInput.after(ageElement);
            });
        }

        $(document).on('click', '.admenmenuform #acf-form-submit', function () {
            $('.admenmenu').css('display', 'block');
            $('#editadmmenu').css('display', 'block');
            $('.admenmenuform').css('display', 'none');
        });
        $(document).on('click', '#cancelmenu', function () {
            $('.admenmenu').css('display', 'block');
            $('#editadmmenu').css('display', 'block');
            $('.admenmenuform').css('display', 'none');
            $('#cancelmenu').css('display', 'none');
        });
        $(document).on('click', '#editadmmenu', function () {
            $('.admenmenu').css('display', 'none');
            $('#editadmmenu').css('display', 'none');
            $('.admenmenuform').css('display', 'block');
            $('#cancelmenu').css('display', 'block');
        });
        $(document).on('click', '.passpop-btn', function () {
            $('.ppop-wr').css('display', 'block');
            $('.passpop-overlay').css('display', 'block');
        });
        ;
        $(document).on('click', '#passpop-close', function () {
            $('.ppop-wr').css('display', 'none');
            $('.passpop-overlay').css('display', 'none');
        });
        $(document).ready(function() {
            let bdate = $('#bdate');
            if (bdate.length) {
                let birthDate = new Date(bdate.text());
                let age = calculateAge(birthDate);
                bdate.text(age);
                bdate.css('display','inline-block');
            }
        });

        function calculateAge(birthDate) {
            let today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            let m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        // $(document).on('click', '.closecomment', function () {
        //     $('.modalBg').css('display','none');
        //     $('.modalSotrIn').css('display','none');
        // });
        // $('.disperse-button').on('mouseover', function() {
        //     var squaresNum = 30;
        //     for (var i = 0; i < squaresNum ; i++) {
        //         var span = document.createElement("span");
        //         span.style.width = this.clientWidth / squaresNum + 'px';
        //         span.style.height = this.clientHeight + 'px';
        //         span.style.left = i * this.clientWidth / squaresNum + 'px';
        //         this.appendChild(span);
        //     }
        //     anime({
        //         targets: '.disperse-button span',
        //         translateX: function() { return anime.random(-200, 200); },
        //         translateY: function() { return anime.random(-200, 200); },
        //         scale: function() { return anime.random(10, .1); },
        //         delay: anime.stagger(10),
        //         direction: 'forwards',
        //         easing: 'easeInOutExpo',
        //     });
        // });
        // $('.disperse-button').on('mouseout', function() {
        //     $('.disperse-button').html('Button');
        // });


        //// anim logo
        // function fitElementToParent(el, padding) {
        //     var timeout = null;
        //     function resize() {
        //         if (timeout) clearTimeout(timeout);
        //         anime.set(el, {scale: 1});
        //         var pad = padding || 0;
        //         var parentEl = el.parentNode;
        //         var elOffsetWidth = el.offsetWidth - pad;
        //         var parentOffsetWidth = parentEl.offsetWidth;
        //         var ratio = parentOffsetWidth / elOffsetWidth;
        //         timeout = setTimeout(anime.set(el, {scale: ratio}), 10);
        //     }
        //     resize();
        //     window.addEventListener('resize', resize);
        // }
        //
        // var sphereAnimation = (function() {
        //
        //     var sphereEl = document.querySelector('.sphere-animation');
        //     var spherePathEls = sphereEl.querySelectorAll('.sphere path');
        //     var pathLength = spherePathEls.length;
        //     var hasStarted = false;
        //     var aimations = [];
        //
        //     fitElementToParent(sphereEl);
        //
        //     var breathAnimation = anime({
        //         begin: function() {
        //             for (var i = 0; i < pathLength; i++) {
        //                 aimations.push(anime({
        //                     targets: spherePathEls[i],
        //                     stroke: {value: ['rgba(255,255,255,1)', 'rgba(255,255,255,.35)'], duration: 500},
        //                     translateX: [2, -4],
        //                     translateY: [2, -4],
        //                     easing: 'easeOutQuad',
        //                     autoplay: false
        //                 }));
        //             }
        //         },
        //         update: function(ins) {
        //             aimations.forEach(function(animation, i) {
        //                 var percent = (1 - Math.sin((i * .35) + (.0022 * ins.currentTime))) / 2;
        //                 animation.seek(animation.duration * percent);
        //             });
        //         },
        //         duration: Infinity,
        //         autoplay: false
        //     });
        //
        //     var introAnimation = anime.timeline({
        //         autoplay: false
        //     })
        //         .add({
        //             targets: spherePathEls,
        //             strokeDashoffset: {
        //                 value: [anime.setDashoffset, 0],
        //                 duration: 3900,
        //                 easing: 'easeInOutCirc',
        //                 delay: anime.stagger(190, {direction: 'reverse'})
        //             },
        //             duration: 2000,
        //             delay: anime.stagger(60, {direction: 'reverse'}),
        //             easing: 'linear'
        //         }, 0);
        //
        //     var shadowAnimation = anime({
        //         targets: '#sphereGradient',
        //         x1: '25%',
        //         x2: '25%',
        //         y1: '0%',
        //         y2: '75%',
        //         duration: 30000,
        //         easing: 'easeOutQuint',
        //         autoplay: false
        //     }, 0);
        //
        //     function init() {
        //         introAnimation.play();
        //         breathAnimation.play();
        //         shadowAnimation.play();
        //     }
        //
        //     init();
        //
        // })();



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

    $(document).ready(function() {
        $('#userlist').select2();
    });
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

