<?php
add_action('rest_api_init', 'hotRoute3');
function hotRoute3() {
    register_rest_route('ht/v3', 'manageHot3', array(
        'methods' => 'PUT',
        'callback' => 'updHot3'
    ));
}
function updHot3($data)
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
            'openN' => 0
        )
    ));
}