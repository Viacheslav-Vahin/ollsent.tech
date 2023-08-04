jQuery(document).ready(function($) {
    $('#acf-form').on('submit', function(e) {

        var formData = new FormData(this);
        formData.append('action', 'my_save_candidate');
        formData.append('nonce', my_ajax_object.nonce);

        // Получаем все поля ACF
        var acf_fields = $('#acf-form .acf-field :input').serializeArray();
        for (var i = 0; i < acf_fields.length; i++) {
            formData.append('acf[' + acf_fields[i].name + ']', acf_fields[i].value);
        }

        $.ajax({
            url: my_ajax_object.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    window.location.href = response.url;
                } else {
                    alert(response.message);
                }
            }
        });
    });
});
