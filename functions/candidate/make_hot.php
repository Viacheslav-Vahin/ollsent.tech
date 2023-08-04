<?php
add_action('rest_api_init', 'statusRoutes');
function statusRoutes()
{
    register_rest_route('ht/v7', 'statusHot', array(
        'methods' => 'PUT',
        'callback' => 'updateStatus'
    ));
}
function updateStatus($data)
{
    $postId = sanitize_text_field($data['postId']);
   // $status = 'Горящий';
   // $timer = ($data['timer']);

    wp_update_post(array(        
        'ID' => $postId,
        'post_type' => 'rekomend',
        'post_status' => 'publish',
        'meta_input' => array(
            'status_r' => 'Горящий'
            //'dataStart0' => $timer,
        )
    ));
}