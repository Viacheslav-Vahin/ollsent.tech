<?php
add_action('rest_api_init', 'starRoute');
function starRoute() {
    register_rest_route('vc/v1', 'manageVac', array(
        'methods' => 'POST',
        'callback' => 'createStar'
    ));
    register_rest_route('vc/v1', 'manageVac', array(
        'methods' => 'DELETE',
        'callback' => 'deleteStar'
    ));
}
function createStar($data)
{
    if (is_user_logged_in()) {
        $star = sanitize_text_field($data['starId']);


        $existStar = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'vstar',
            'meta_query' => array(
                array(
                    'key' => 'my_vac_id',
                    'compare' => '=',
                    'value' => $star
                )
            )
        ));
        if ($existStar->found_posts == 0 AND get_post_type($star) == 'vacancy') {
            return wp_insert_post(array(
                'post_type' => 'vstar',
                'post_status' => 'publish',
                'post_title' =>'User copied Vacancies',
                'meta_input' => array(
                    'my_vac_id' => $star
                )
            ));
        } else {
            die("Эта вакансия уже сохранена:)");
        }
    } else {
        die("Только залогиненые пользователи могут сохранить вакансию");
    }
}

function deleteStar($data)
{
   $starId = sanitize_text_field($data['star']);
   if (get_current_user_id() == get_post_field('post_author', $starId)
       AND get_post_type($starId) == 'vstar') {
       wp_delete_post($starId, true);
       return 'Вы успешно удалили вакансию';
   } else {
       die("У вас нет прав удалить это.");
   }

}



add_action('rest_api_init', 'starRecRoute');
function starRecRoute() {
    register_rest_route('rk/v1', 'manageRec', array(
        'methods' => 'POST',
        'callback' => 'crStar'
    ));
    register_rest_route('rk/v1', 'manageRec', array(
        'methods' => 'DELETE',
        'callback' => 'delStar'
    ));
}
function crStar($data)
{
    if (is_user_logged_in()) {
        $star = sanitize_text_field($data['starId']);
        $vID = sanitize_text_field($data['vac_id']);
        $rID = sanitize_text_field($data['rek_id']);


        $existStar = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'rstar',
            'meta_query' => array(
                array(
                    'key' => 'my_rec_id',
                    'compare' => '=',
                    'value' => $star
                )
            )
        ));
        if ($existStar->found_posts == 0 AND get_post_type($star) == 'rekomend') {
            return wp_insert_post(array(
                'post_type' => 'rstar',
                'post_status' => 'publish',
                'post_title' =>'User copied Recommendation',
                'meta_input' => array(
                    'my_rec_id' => $star,
                    'vac_id' => $vID,
                    'rek_id' => $rID
                )
            ));
        } else {
            die("Эта вакансия уже сохранена:)");
        }
    } else {
        die("Только залогиненые пользователи могут сохранить вакансию");
    }
}
function delStar($data)
{
    $starId = sanitize_text_field($data['star']);
    if (get_current_user_id() == get_post_field('post_author', $starId)
        AND get_post_type($starId) == 'rstar') {
        wp_delete_post($starId, true);
        return 'Вы успешно удалили вакансию';
    } else {
        die("У вас нет прав удалить это.");
    }

}

// ================================================================
add_action('rest_api_init', 'ldRoute');
function ldRoute() {
    register_rest_route('ld/v1', 'manageLD', array(
        'methods' => 'POST',
        'callback' => 'crLD'
    ));
    register_rest_route('ld/v1', 'manageLD', array(
        'methods' => 'PUT',
        'callback' => 'delLD'
    ));
}
function crLD($data)
{
    if (is_user_logged_in()) {
        $ld = sanitize_text_field($data['ld']);
       $uID = sanitize_text_field($data['uid']);
//        $rID = sanitize_text_field($data['rek_id']);


        $existStar = new WP_Query(array(
            'post_title' => get_current_user_id(),
            'post_type' => 'notiajax',
//            'meta_query' => array(
//                array(
//                    'key' => 'my_rec_id',
//                    'compare' => '=',
//                    'value' => $star
//                )
//            )
        ));

            return wp_insert_post(array(
                'post_type' => 'notiajax',
                'post_status' => 'publish',
                'post_title' =>$uID,
                'meta_input' => array(
                    'modify_date' => $ld,
                )
            ));

    } else {
        die("Только залогиненые пользователи могут сохранить вакансию");
    }
}
function delLD($data)
{
    $uID = sanitize_text_field($data['uid']);
    $postId = sanitize_text_field($data['postId']);
    $md = sanitize_text_field($data['md']);
//    return $md . ' ' . $postId;
    wp_update_post(array(
        'ID' => $postId,
        'post_type' => 'notiajax',
       //'post_title' => '55',
        'post_title' =>$uID,
        'post_status' => 'publish',
        'meta_input' => array(
            'modify_date' => $md
        )
    ));
}