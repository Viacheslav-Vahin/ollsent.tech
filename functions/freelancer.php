<?php
add_action('rest_api_init', 'frRoute');
function frRoute() {
    register_rest_route('fd/v1', 'persData', array(
        'methods' => 'POST',
        'callback' => 'createFD'
    ));
    register_rest_route('fd/v1', 'persData', array(
        'methods' => 'PUT',
        'callback' => 'updFD'
    ));
}
function createFD($data)
{
    if (is_user_logged_in()) {
        $usrID = sanitize_text_field($data['f_id']);
        $usrName = sanitize_text_field($data['title']);
        $usrE = sanitize_text_field($data['f_email']);
        $usrTelef = sanitize_text_field($data['f_telef']);
        $usrRekv = sanitize_text_field($data['f_rekviz']);
        return wp_insert_post(array(
            'post_type' => 'freelcr',
            'post_status' => 'publish',
            'post_title' => $usrName,
            'meta_input' => array(
                'f_id' => $usrID,
                'f_email' => $usrE,
                'f_telef' => $usrTelef,
                'f_rekviz' => $usrRekv,
            )
        ));
    } else {
        die("Только залогиненые пользователи могут сохранить вакансию");
    }
}

function updFD($data)
{
    if (is_user_logged_in()) {
        $postId = sanitize_text_field($data['postId']);
        $usrID = sanitize_text_field($data['f_id']);
        $usrName = sanitize_text_field($data['title']);
        $usrE = sanitize_text_field($data['f_email']);
        $usrTelef = sanitize_text_field($data['f_telef']);
        $usrRekv = sanitize_text_field($data['f_rekviz']);
        wp_update_post(array(
            'ID' => $postId,
            'post_type' => 'freelcr',
            'post_status' => 'publish',
            'post_title' => $usrName,
            'meta_input' => array(
                'f_id' => $usrID,
                'f_email' => $usrE,
                'f_telef' => $usrTelef,
                'f_rekviz' => $usrRekv,
            )
        ));
    } else {
        die("Только залогиненые пользователи могут сохранить вакансию");
    }

}