<?php
add_action('rest_api_init', 'hotRoute2');
function hotRoute2() {
    register_rest_route('ht/v2', 'manageHot2', array(
        'methods' => 'PUT',
        'callback' => 'updHot2'
    ));
}
function updHot2($data)
{
    $uID = sanitize_text_field($data['uid']);
    $postId = sanitize_text_field($data['postId']);
 //   $hd = sanitize_text_field($data['hd']);
//    return $md . ' ' . $postId;
    wp_update_post(array(
        'ID' => $postId,
        'post_type' => 'notiHot',
       //'post_title' => '55',
        'post_title' =>$uID,
        'post_status' => 'publish',
        'meta_input' => array(
            'openN' => 1
        )
    ));
}