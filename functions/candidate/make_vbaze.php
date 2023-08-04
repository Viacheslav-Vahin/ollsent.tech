<?php
add_action('rest_api_init', 'stRoutes');
function stRoutes()
{
    register_rest_route('ht/v8', 'statusVbaze', array(
        'methods' => 'PUT',
        'callback' => 'updStatus'
    ));
}
function updStatus($data)
{
    $postId = sanitize_text_field($data['postId']);
   // $status = 'Горящий';
   // $timer = ($data['timer']);

    wp_update_post(array(        
        'ID' => $postId,
        'post_type' => 'candidate',
        'post_status' => 'publish',
        'meta_input' => array(
            'status_r' => 'В Базе канд'
            //'dataStart0' => $timer,
        )
    ));
}