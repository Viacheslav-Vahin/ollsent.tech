<?php
// filter Exp
add_filter( 'parse_query', 'admin_exp' );
add_action( 'restrict_manage_posts', 'admin_exp_filter' );

function admin_exp( $query ) {
    global $pagenow;
    if ( is_admin() && $pagenow=='edit.php') {
        //добавлям фильтрацию по opyt в запрос
        if (!empty($_GET['ADMIN_OPUT'])) {
            $query->query_vars['meta_key'] = 'opyt';
            $query->query_vars['meta_value'] = $_GET['ADMIN_OPUT'];
        }
    }
}

function admin_exp_filter() {
    global $wpdb, $pagenow;

    if ($pagenow != 'edit.php') return;
    $out = '';

    switch ($_GET['post_type']) {
        case 'vacancy':
            //фильтр по Oпытy
            $fieldname = 'ADMIN_OPUT';
            //надо выбрать все уникальные значения поля для показа в выпадающем поле
            $rows = $wpdb->get_results("SELECT DISTINCT meta_value FROM {$wpdb->postmeta}
        WHERE meta_key = 'opyt' ORDER BY meta_value", ARRAY_N);

            //собираем HTML код SELECT со списком Oпыта
            $out .= '<select name="' . $fieldname . '">
        <option value="">-- Искать по уровню Oпыта --</option>';

            foreach($rows as $row) {
                if (isset($_GET[$fieldname]) && $_GET[$fieldname] == $row[0] && $_GET[$fieldname] != null)
                    $out .= sprintf ('<option value="%s" selected>%s</option>',
                        $row[0], $row[0]);
                else
                    $out .= sprintf ('<option value="%s">%s</option>',
                        $row[0], $row[0]);
            }
            $out .= '</select>';
    }
    //покажем созданный фильтр
    echo $out;
}

// filter Exp
add_filter( 'parse_query', 'admin_spec' );
//add_action( 'restrict_manage_posts', 'admin_spec_filter' );

function admin_spec( $query ) {
    global $pagenow;
    if ( is_admin() && $pagenow=='edit.php') {
        //добавлям фильтрацию по Специализация в запрос
        if (!empty($_GET['ADMIN_SPEC'])) {
            $query->query_vars['meta_key'] = 'spec';
            $query->query_vars['meta_value'] = $_GET['ADMIN_SPEC'];
        }
    }
}

// кастомный фильтр zarplata
add_filter( 'parse_query', 'admin_posts_filter' );
add_action( 'restrict_manage_posts', 'admin_zarplata_filter' );


function admin_posts_filter( $query ) {
    global $pagenow;
    if ( is_admin() && $pagenow=='edit.php') {
        //добавлям фильтрацию по городу в запрос
        if (!empty($_GET['ADMIN_FILTER_SALARY'])) {
            $query->query_vars['meta_key'] = 'zarplata';
            $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_SALARY'];
        }
    }
}

function admin_zarplata_filter() {
    global $wpdb, $pagenow;

    if ($pagenow != 'edit.php') return;
    $out = '';

    switch ($_GET['post_type']) {
        case 'vacancy':
            //фильтр по городу
            $fieldname = 'ADMIN_FILTER_SALARY';
            //надо выбрать все уникальные значения поля для показа в выпадающем поле
            $rows = $wpdb->get_results("SELECT DISTINCT meta_value FROM {$wpdb->postmeta}
        WHERE meta_key = 'zarplata' ORDER BY meta_value", ARRAY_N);

            //собираем HTML код SELECT со списком
            $out .= '<select name="' . $fieldname . '">
        <option value="">-- Искать по Зарплате --</option>';

            foreach($rows as $row) {
                if (isset($_GET[$fieldname]) && $_GET[$fieldname] == $row[0] && $_GET[$fieldname] != null)
                    $out .= sprintf ('<option value="%s" selected>%s</option>',
                        $row[0], $row[0]);
                else
                    $out .= sprintf ('<option value="%s">%s</option>',
                        $row[0], $row[0]);
            }
            $out .= '</select>';
    }
    //покажем созданный фильтр
    echo $out;
}

// кастомный фильтр в список публикаций админки
add_filter( 'parse_query', 'admin_english_filter' );
add_action( 'restrict_manage_posts', 'english_filter' );


function admin_english_filter( $query ) {
    global $pagenow;
    if ( is_admin() && $pagenow=='edit.php') {
        //добавлям фильтрацию по городу в запрос
        if (!empty($_GET['ADMIN_FILTER_ENGLISH'])) {
            $query->query_vars['meta_key'] = 'angl';
            $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_ENGLISH'];
        }
    }
}

function english_filter() {
    global $wpdb, $pagenow;

    if ($pagenow != 'edit.php') return;
    $out = '';

    switch ($_GET['post_type']) {
        case 'vacancy':
            //фильтр по городу
            $fieldname = 'ADMIN_FILTER_ENGLISH';
            //надо выбрать все уникальные значения поля для показа в выпадающем поле
            $rows = $wpdb->get_results("SELECT DISTINCT meta_value FROM {$wpdb->postmeta}
        WHERE meta_key = 'angl' ORDER BY meta_value", ARRAY_N);

            //собираем HTML код SELECT со списком
            $out .= '<select name="' . $fieldname . '">
        <option value="">-- Искать по уровню Английского --</option>';

            foreach($rows as $row) {
                if (isset($_GET[$fieldname]) && $_GET[$fieldname] == $row[0] && $_GET[$fieldname] != null)
                    $out .= sprintf ('<option value="%s" selected>%s</option>',
                        $row[0], $row[0]);
                else
                    $out .= sprintf ('<option value="%s">%s</option>',
                        $row[0], $row[0]);
            }
            $out .= '</select>';
    }
    //покажем созданный фильтр
    echo $out;
}