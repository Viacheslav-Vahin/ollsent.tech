<?php
add_action('rest_api_init', 'moveRoutes');
function moveRoutes()
{
    register_rest_route('dp/v4', 'moveR', array(
        'methods' => 'PUT',
        'callback' => 'updateMove'
    ));
}
function updateMove($data)
{
//    return 'You trying update like';
    $postId = sanitize_text_field($data['postId']);
    $rekr = sanitize_text_field($data['rekr']);
    $vac = sanitize_text_field($data['vac']);
    $status = sanitize_text_field($data['status']);
    $date0 = sanitize_text_field($data['date0']);
    $cStage = sanitize_text_field($data['cstage']);
//    $data['ID'] = V

    wp_update_post(array(
        // wp_insert_post(array(
        'ID' => $postId,
//        'edit_date' => true,
        'post_type' => 'rekomend',
        'post_status' => 'publish',
 //       'post_title' => 'ts create likes',
//        'post_content' => 'likes'
        'meta_input' => array(
            'id_rekr' => $rekr,
            'id_vac' => $vac,
            'status_r' => $status,
            'dataStart0' => $date0,
            'candidate_stage' => $cStage
        )
    ));
//    return  $template;
}