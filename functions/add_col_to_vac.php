<?php
// columns for Vacancies
function columns_vacancies($columns) {
    unset($columns['date']);
//    $columns['cand_photo'] = 'Фото';
//    $columns['v_file'] = 'Файл описания';
    $columns['v_spec'] = 'Специализация';
    $columns['v_lang'] = 'Относится к языку';
    $columns['v_experience'] = 'Опыт';
    $columns['v_level'] = 'Уровень';
    $columns['v_salary'] = 'Зар Плата';
    $columns['v_english'] = 'Английский';
    if ( current_user_can( 'manage_options' ) ) {
        $columns['v_descr'] = 'Краткое описание вакансии';
    }

    $columns['v_date'] = 'Дата';
    return $columns;
}
add_filter('manage_vacancy_posts_columns', 'columns_vacancies');
function columns_vac($column, $post_id) {
    if ($column === 'v_spec') {
        $cand_ctegory= get_field('spec');
        foreach($cand_ctegory as $k){
            echo $k . '</span>  ';
        }
//        $vac_field = get_field('spec');
//        echo $vac_field . '</p>';

    }
//    elseif ($column === 'v_file') {
//        $cand_ctegory= get_field('file_vac');
//        foreach($cand_ctegory as $k){
//            echo $k -> post_title . '</p>';
//        }
//    }
    elseif ($column === 'v_lang') {
        $cand_ctegory= get_field('spec_related');
        if (is_array($cand_ctegory) || is_object($cand_ctegory))
            {
                foreach($cand_ctegory as $k){
                    echo $k -> post_title . '</p>';
                }
            }
    }
    elseif ($column === 'v_experience') {

        $vac_field = get_field('opyt');
        echo $vac_field . '</p>';

    }
    elseif ($column === 'v_level') {

        $vac_field = get_field('uroven');
        echo $vac_field . '</p>';
    }
    elseif ($column === 'v_salary') {
        $vac_field = get_field('zarplata');
        echo $vac_field . '</p>';
//        $cand_ctegory= get_field('zarplata');
//        foreach($cand_ctegory as $k){
//            echo $k -> post_title . '</p>';
        //      }
    }
    elseif ($column === 'v_english') {
        $vac_field = get_field('angl');
        echo $vac_field . '</p>';
//        }
    }
    elseif ($column === 'v_descr') {

        if ( current_user_can( 'manage_options' ) ) {
            $vac_field = get_field('opis_vak');
            echo $vac_field . '</p>';
        }


    }
    elseif ($column === 'v_date') {

        $vac_field = get_field('data');
        echo $vac_field . '</p>';
    }

}
add_action('manage_posts_custom_column' , 'columns_vac', 10, 2);
//echo 'fffuuu';
//$user = wp_get_current_user();
//if ( in_array( 'author', (array) $user->roles ) ) {
//    //The user has the "author" role
////    if () {
////
////    }
//    echo roles + 'gggjjj';
//}
//if (is_admin()) {
//    echo 'dddqqq';
//}


//$user = wp_get_current_user();
//if ( in_array( 'author', (array) $user->roles ) ) {
//    //The user has the "author" role
//    echo 'rrrmmm';
//}


//add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
    echo '<style>
   #v_descr {
    width: 30%;
    color: green !important;
    font-weight: bold;
}
  </style>';
}
function customCSSe() {
    echo '<style>
//   #v_descr {
////   display: none !important;
//   width: 2px !important;
//    width: 30%;
//    color: yellow !important;
//    font-weight: bold;
//    font-size: 1px;
//    visibility: hidden;
//}
//.v_descr.column-v_descr p {
//font-size: 1px;
//visibility: hidden;
//}
//.v_descr {
//    color: blue;
////    display: none !important;
//    width: 2px !important;
//    font-size: 1px;
//}
.acf-field.-c0 {
display: none !important;
}
.acf-field-60e6bea4a1076 {
display: none !important;
}
.localizacia{
display: none !important;
}
.locked-info {
display: none !important;
}
.components-modal__screen-overlay {
display: none !important;
}
  </style>';
}

if ( current_user_can( 'manage_options' ) ) {
    /* A user with admin privileges */
//    echo 'rrrmmm';
    add_action('admin_head', 'my_custom_fonts');
} else {
    /* A user without admin privileges */
//    echo 'eeennn3';
    add_action('admin_head', 'customCSSe');
}