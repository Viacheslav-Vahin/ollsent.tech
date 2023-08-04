// // JavaScript код, разместите его в файле вашей темы или в виде inline-скрипта на нужной странице
// jQuery(document).ready(function($) {
//     // Обработка клика по кнопке удаления
//     $(document).on('click', '.delete-option', function(e) {
//         e.preventDefault();
//
//         var optionValue = $(this).data('optionValue');
//
//         // Отправка AJAX-запроса на сервер
//         $.post(ajaxurl, {
//             action: 'delete_option',
//             option_value: optionValue,
//             nonce: my_script_vars.nonce // Убедитесь, что вы проверяете nonce для безопасности
//         }, function(response) {
//             if (response.success) {
//                 // Удаление опции из DOM
//                 // ...
//             }
//         });
//     });
//
//     // $(document).ready(function() {
//     //     $('#yourSelectField').select2({
//     //         templateResult: formatOption,
//     //         templateSelection: formatOption
//     //     });
//     // });
//
//     function formatOption (option) {
//         if (!option.id) { return option.text; }
//         var $option = $(
//             '<span>' + option.text + ' </span><button class="remove-option" data-id="' + option.id + '">Удалить</button>'
//         );
//         return $option;
//     };
//
// });
//
