<?php
add_action('rest_api_init', 'hotRoute');
function hotRoute() {
    register_rest_route('ht/v1', 'manageHot', array(
        'methods' => 'POST',
        'callback' => 'crHot'
    ));
    register_rest_route('ht/v1', 'manageHot', array(
        'methods' => 'PUT',
        'callback' => 'updHot'
    ));
}
function crHot($data)
{
    if (is_user_logged_in()) {
        $hd = sanitize_text_field($data['hd']);
       $uID = sanitize_text_field($data['uid']);


        $existStar = new WP_Query(array(
            'post_title' => get_current_user_id(),
            'post_type' => 'notiHot',
        ));

            return wp_insert_post(array(
                'post_type' => 'notiHot',
                'post_status' => 'publish',
                'post_title' =>$uID,
                'meta_input' => array(
                    'modify_date' => $hd,
                )
            ));

    } else {
        die("Только залогиненые пользователи могут сохранить вакансию");
    }
}
function updHot($data)
{
    $uID = sanitize_text_field($data['uid']);
    $postId = sanitize_text_field($data['postId']);
    $hd = sanitize_text_field($data['hd']);
    wp_update_post(array(
        'ID' => $postId,
        'post_type' => 'notiHot',
        'post_title' =>$uID,
        'post_status' => 'publish',
        'meta_input' => array(
            'modify_date' => $hd
        )
    ));
}