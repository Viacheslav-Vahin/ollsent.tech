<?php
add_action('rest_api_init', 'tsLikeRoutes');

function tsLikeRoutes()
{
    register_rest_route('dp/v1', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike'
    ));
//    register_rest_route('ts/v1', 'manageLike', array(
//        'methods' => 'DELETE',
//        'callback' => deleteLike
//    ));
    register_rest_route('dp/v1', 'manageLike', array(
        'methods' => 'PUT',
        'callback' => 'updateLike'
    ));
}

function createLike($data)
{
//    if (is_user_logged_in()) {
//        $template = sanitize_text_field($data['templateId']);
//
////    return 'You trying create like';
//      return  wp_insert_post(array(
//            'post_type' => 'likes',
//            'post_status' => 'publish',
//            'post_title' => 'ts create likes 66',
////        'post_content' => 'likes'
//            'meta_input' => array(
//                'liked_template_id' => $template
//            )
//        ));
//    } else {
//        die("Only loogged in users can create a like.");
//    }
    $template = sanitize_text_field($data['liked_template_id']);
    $designval = sanitize_text_field($data['designVote']);
    $usabilityval = sanitize_text_field($data['usabilityVote']);
    $creativityval = sanitize_text_field($data['creativityVote']);
    $userval = sanitize_text_field($data['userVal']);
    return wp_insert_post(array(
        'post_type' => 'likes',
        'post_status' => 'publish',
        'post_title' => 'create likes',
//        'post_content' => 'likes'
        'meta_input' => array(
            'liked_template_id' => $template,
            'design_vote_value' => $designval,
            'usability_vote_value' => $usabilityval,
            'creativity_vote_value' => $creativityval,
            'likes_user_id' => $userval
        )
    ));
}

//function updateLike ($data['ID'] = 1394;) {
//$my_post = array();
//$my_post['ID'] = 1394;
function updateLike($data)
{
//    return 'You trying update like';
    $postId = sanitize_text_field($data['postId']);
    $template = sanitize_text_field($data['templateId']);
    $designval = sanitize_text_field($data['designVote']);
    $usabilityval = sanitize_text_field($data['usabilityVote']);
    $creativityval = sanitize_text_field($data['creativityVote']);
    $userval = sanitize_text_field($data['userVal']);
    $postIdval = sanitize_text_field($data['postId']);
//    $data['ID'] = V

    wp_update_post(array(
        // wp_insert_post(array(
        'ID' => $postId,
//        'edit_date' => true,
        'post_type' => 'likes',
        'post_status' => 'publish',
        'post_title' => 'ts create likes',
//        'post_content' => 'likes'
        'meta_input' => array(
            'liked_template_id' => $template,
            'design_vote_value' => $designval,
            'usability_vote_value' => $usabilityval,
            'creativity_vote_value' => $creativityval,
            'likes_user_id' => $userval,
            'likes_post_id' => $postIdval
        )
    ));
//    return  $template;
}

function deleteLike($data)
{
    return 'You trying delete like';
    // $likedId = sanitize_text_field($data['id']);
//    if (get_current_user_id() == get_post_field('post_author', $likedId) AND
//    get_post_type($likedId) == 'id') {
//        wp_delete_post($likedId, true);
//    } else{
//        die("You dont ");
//    }
//    wp_delete_post($likedId, true);
}










add_action('rest_api_init', 'dpRekomend');
function dpRekomend() {
//    register_rest_route('ts/v1', 'manageLike', array(
    register_rest_route('dp/v1', 'rekom', array(
        'methods' => 'POST',
        'callback' => 'saveRekomend'
    ));
    register_rest_route('dp/v1', 'rekom', array(
        'methods' => 'PUT',
        'callback' => 'updateRekomend'
    ));
    register_rest_route('dp/v1', 'rekom', array(
        'methods' => 'DELETE',
        'callback' => 'delRekomend'
    ));
}
function saveRekomend($data) {
//    return 'you try create Rekomend';
    $emailRek = sanitize_text_field($data['email_r']);
    $telRek = sanitize_text_field($data['tel_r']);
    $dataStartRek = current_time( 'timestamp' );
    $cvlRek = $data['resume_r'];
    $titleRek = sanitize_text_field($data['title']);
//    $contentRek = sanitize_text_field($data['content']);
    $specRek = sanitize_text_field($data['spec1']);
    $zarplRek = sanitize_text_field($data['zarplata']);
    $cuID = sanitize_text_field($data['user_r']);

    return wp_insert_post(array(
        'post_type' => 'rekomend',
        'post_status' => 'publish',
        'post_title' => $titleRek,
//        'post_content' => $contentRek,
        'meta_input' => array(
            'dataStart' => $dataStartRek,
            'email_r' => $emailRek,
            'tel_r' => $telRek,
            'resume_r' => $cvlRek,
            'spec1' => $specRek,
            'zarplata' => $zarplRek,
            'user_r' => $cuID
        )
    ));
//    wp_send_json( $data );
}
function updateRekomend($data) {
//    return 'You trying update rekomend';
    $postId = sanitize_text_field($data['postId']);
    $emailRek = sanitize_text_field($data['email_r']);
    $telRek = sanitize_text_field($data['tel_r']);
    $cvlRek = ($data['resume_r']);
    $titleRek = sanitize_text_field($data['title']);
//    $contentRek = sanitize_text_field($data['content']);
    $specRek = sanitize_text_field($data['spec1']);
    $zarplRek = sanitize_text_field($data['zarplata']);
    $cuID = sanitize_text_field($data['user_r']);
    wp_update_post(array(
        'ID' => $postId,
        'post_type' => 'rekomend',
        'post_status' => 'publish',
        'post_title' => $titleRek,
//        'post_content' => $contentRek,
        'meta_input' => array(
            'email_r' => $emailRek,
            'tel_r' => $telRek,
            'resume_r' => $cvlRek,
            'spec1' => $specRek,
            'zarplata' => $zarplRek,
            'user_r' => $cuID
        )
    ));

}
function delRekomend($data) {
//    return "you try";

    $postId = sanitize_text_field($data['postId']);
 //   return wp_delete_post($postId, true);
//    return 'You trying update rekomend';
//    if (get_current_user_id() == get_post_field('post_author', $postId) AND get_post_type($postId) == 'rekomend') {
//       return wp_delete_post($postId, true);
//    } else {
//        die("Вы не имеете права удалить эту рекомендацию");
//    }
    if (get_post_type($postId) == 'rekomend') {
        return wp_delete_post($postId, true);
    } else {
        die("Вы не имеете права удалить эту рекомендацию");
    }
}





