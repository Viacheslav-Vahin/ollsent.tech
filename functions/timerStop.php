<?php
add_action('rest_api_init', 'timerRoutes');
function timerRoutes()
{
    register_rest_route('dp/v5', 'timerR', array(
        'methods' => 'PUT',
        'callback' => 'updateStop'
    ));
}
function updateStop($data)
{
    $postId = sanitize_text_field($data['postId']);
    $status = sanitize_text_field($data['status']);
    $timer = ($data['timer']);

    wp_update_post(array(        
        'ID' => $postId,
        'post_type' => 'rekomend',
        'post_status' => 'publish',
        'meta_input' => array(
            'status_r' => $status,
            'dataStart0' => $timer,
        )
    ));
}