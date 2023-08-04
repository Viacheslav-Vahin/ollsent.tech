<?php
require get_template_directory() . '/functions/post_types.php'; # AJAX search
require get_template_directory() . '/functions/add_col_to_vac.php'; // Add columns to Vacansies Post Type
require get_template_directory() . '/functions/ajax-search.php'; # AJAX search
require get_template_directory() . '/functions/admin_filters.php'; # admin search
require get_template_directory() . '/functions/save_rekomend.php'; # admin search
require get_template_directory() . '/functions/star-route.php'; # add or remove vac to personal
require get_template_directory() . '/functions/candidate/hot-route.php'; # add or remove hot candidate
require get_template_directory() . '/functions/candidate/open_notif_tab.php';
require get_template_directory() . '/functions/candidate/close_notif_tab.php';
require get_template_directory() . '/functions/candidate/make_hot.php'; # make status hot if timer stopped
require get_template_directory() . '/functions/candidate/make_vbaze.php'; # make status "В Базе кандидатов" after 14 days
// require get_template_directory() . '/functions/candidate/load_history.php'; # load candidates history
// require get_template_directory() . '/functions/candidate/get_vac_name.php'; # load candidates history
require get_template_directory() . '/functions/move_to_rekr.php'; # reassign rekruter
require get_template_directory() . '/functions/timerStop.php'; # change status to hot
require get_template_directory() . '/functions/freelancer.php'; # add or update freelancer personal data
require get_template_directory() . '/assets/js/submit.php'; # save files
// require get_template_directory() . '/functions/create1reset.php'; # reset marker in pipeline for event_id


function dp_scripts()
{
    show_admin_bar(false);
    //  wp_enqueue_style('agr-style', get_stylesheet_uri());
    wp_enqueue_style('agr-style', get_stylesheet_uri(), NULL, microtime());
    wp_enqueue_style('jqueryUI_css', get_template_directory_uri() . '/assets/css/jquery-ui.css', array(), false, 'all');
    wp_enqueue_style('polzunok_css', get_template_directory_uri() . '/assets/css/polzunok.css', array(), false, 'all');
    wp_enqueue_style('ajax_search_css', get_template_directory_uri() . '/assets/css/ajax_search.css', array(), false, 'all');
    wp_enqueue_style('svac_css', get_template_directory_uri() . '/assets/css/single_vac.css', array(), false, 'all');
    wp_enqueue_style('kabinet_css', get_template_directory_uri() . '/assets/css/ownKab.css', array(), false, 'all');
    wp_enqueue_style('sotr_css', get_template_directory_uri() . '/assets/css/sotr.css', array(), false, 'all');
//    wp_register_style( 'slick_styles',  get_template_directory_uri() .'/assets/css/1slick.css', array(), null, 'all' );

//   wp_enqueue_script( 'jquery_scripts', get_template_directory_uri() . '/assets/js/1jq.min.js');
//    wp_enqueue_script( 'slick_scripts', get_template_directory_uri() . '/assets/js/2slick.min.js');
    wp_enqueue_script('dp_scripts', get_template_directory_uri() . '/assets/js/5scr.js',
        array('jquery'), microtime(), true);
    wp_localize_script('dp_scripts', 'devportData', array(
        'root_url' => get_site_url(),
        'cb' => wp_create_nonce('wp_rest')
    ));
//    wp_localize_script('dp_scripts', 'devportKanban', array(
//        'root_url' => get_site_url(),
//        'ck' => wp_create_nonce('wp_rest')
//    ));
}
add_action('wp_enqueue_scripts', 'dp_scripts');

//function load_jsCalendar() {
//    if( is_page( 15 ) ) {
////        wp_enqueue_script('jsUI', 'http://localhost:8080/devport/wp-content/themes/devport/assets/js/jquery-ui.js', array('jquery'), '', false);
////        wp_enqueue_script('js_calendar', 'http://localhost:8080/devport/wp-content/themes/devport/assets/js/gCalendar.js', array('jquery'), '', false);
//        wp_enqueue_style('googleC_css', get_template_directory_uri() . '/assets/gogleCalendar/gc.css', array(), false, 'all');
//        wp_enqueue_script('js_calendar', 'http://localhost:8080/devport/wp-content/themes/devport/assets/gogleCalendar/gc.js', array('jquery'), '', false);
//    }
//}
//
//add_action('wp_enqueue_scripts', 'load_jsCalendar');

function load_jsCalendar() {
    if( is_page( 1060 ) ) {
//        wp_enqueue_script('jsUI', 'http://localhost:8080/devport/wp-content/themes/devport/assets/js/jquery-ui.js', array('jquery'), '', false);
//        wp_enqueue_script('js_calendar', 'http://localhost:8080/devport/wp-content/themes/devport/assets/js/gCalendar.js', array('jquery'), '', false);
//        wp_enqueue_style('fontAwes_css', 'https://use.fontawesome.com/releases/v5.12.1/css/all.css', array(), false, 'all');
        wp_enqueue_style('googleC_css', get_template_directory_uri() . '/assets/gogleCalendar/lib/main.css', array(), false, 'all');
//        wp_enqueue_script('js_moment', get_template_directory_uri() . '/assets/gogleCalendar/lib/moment.js', null, '', false);
        wp_enqueue_script('js_jqueryui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), '', false);
        wp_enqueue_script('js_timepicker', get_template_directory_uri() . '/assets/js/timepicker.js', array('jquery'), '', false);
        wp_enqueue_script('js_calendar', get_template_directory_uri() . '/assets/gogleCalendar/lib/main.js', array('jquery'), '', false);
        wp_enqueue_script('js_custom', get_template_directory_uri() . '/assets/gogleCalendar/gc_custom.js', array('jquery'), '', false);
        wp_localize_script('dp_scripts', 'devportData', array(
            'root_url' => get_site_url(),
            'cb' => wp_create_nonce('wp_rest')
        ));
    }
}

add_action('wp_enqueue_scripts', 'load_jsCalendar');
function ch1() {
    if( is_page( 1087 ) ) {
        //if( is_page( 133 ) || is_page( 1087 ) ) {
        wp_enqueue_script('js_jqui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), '', false);
        wp_enqueue_script('js_chart_lib', get_template_directory_uri() . '/assets/js/chart.min.js', array('jquery'), '', false);
        wp_enqueue_script('js_chart_cust', get_template_directory_uri() . '/assets/js/chart.cust.js', array('jquery'), '', false);
    }
}

add_action('wp_enqueue_scripts', 'ch1');

// add_action('wp_enqueue_scripts', 'rekr');
// function rekr1() {
//     if( 1181 || 1087 ) {
//         // wp_enqueue_script('js_jqui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), '', false);
//         // wp_enqueue_script('js_chart_lib', get_template_directory_uri() . '/assets/js/chart.min.js', array('jquery'), '', false);
//         wp_enqueue_script('js_cust1', get_template_directory_uri() . '/assets/js/rekruter.js', array('jquery'), '', false);
//     }
// }

// add_action('wp_enqueue_scripts', 'rekr1');

// add_action('wp_enqueue_scripts', 'rekr2');
function rekr3() {
    if( is_page( 1087 ) || is_page( 1106 ) || is_page( 1181 ) || is_page( 1087 ) || is_page( 931 ) || is_singular( $post_types = 'candidate' ) ) {
        // wp_enqueue_script('js_jqui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), '', false);
        // wp_enqueue_script('js_chart_lib', get_template_directory_uri() . '/assets/js/chart.min.js', array('jquery'), '', false);
//        wp_enqueue_style('css-list-grid', get_template_directory_uri() . '/assets/css/styles.css', array(), false, 'all');
//        wp_enqueue_script('js-list-grid', get_template_directory_uri() . '/assets/js/simple-list-grid.js');

//        wp_enqueue_script('lodash', get_template_directory_uri() . '/assets/js/lodash.js');
        wp_enqueue_script('jq-ui', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js', array('jquery'), '', false);
        wp_enqueue_script('js_pdf', 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js', array('jquery'), '', false);
        wp_enqueue_script('js_word','https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.0/mammoth.browser.min.js', array('jquery'), '', false);
        wp_enqueue_script('jspdf','https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js', array('jquery'), '', false);
        wp_enqueue_script('js_htmlcanvas','https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js', array('jquery'), '', false);
        wp_enqueue_script('js_cust2', get_template_directory_uri() . '/assets/js/rekruter.js', array('jquery'), '', false);
    }
}


add_action('wp_enqueue_scripts', 'rekr3');

//function kanban_scr() {
//    if ( is_page( 133 ) ) {
//        wp_enqueue_script('alterscript', 'http://localhost:8080/devport/wp-content/plugins/kanban/js/min/init-min.js',
//            array('jquery'), microtime(), true);
//    }
//}
//add_action( 'wp_enqueue_scripts', 'kanban_scr' );



add_theme_support('menus');


function ww_load_dashicons()
{
    wp_enqueue_style('dashicons');
}

add_action('wp_enqueue_scripts', 'ww_load_dashicons');

//function devport_features() {
//    add_theme_support('post_thumbnails');
//}
//add_action('after_setup_theme', 'devport_features');


add_theme_support('post-thumbnails');

//function cust_filters()
//{
//    admin_posts_filter_restrict_manage_posts();
////    admin_engl_filter_restrict_manage_posts();
//    // prefix_parse_filter();
//
//}
//add_action( 'restrict_manage_posts', 'cust_filters' );


// ))))))))))))))))))))))))))))))))))))
//function set_posts_per( $query ) {
//    if ( !is_admin() && $query->is_main_query() && is_page_template('templates/rekomendacziya.php') ) {
//        $query->set( 'posts_per_page', '3' );
//    }
//}
//add_action( 'pre_get_posts', 'set_posts_per' );
add_filter('pre_get_posts', 'include_search_filter');
function include_search_filter($query)
{
//    if (!is_admin() AND is_post_type_archive('language') AND $query->is_main_query) {
//        $query->set('orderby', 'title');
//        $query->set('order', 'ASC');
//    }
    if (!is_admin() && $query->is_main_query() && $query->is_search) {
        $query->set('post_type', 'vacancy');
    }
    return $query;
}

//add_action('admin_enqueue_scripts', 'ourCSS');

function my_stylesheet1()
{
    wp_enqueue_style("style-admin", get_bloginfo('stylesheet_directory') . "/assets/css/3adm.css");
}

add_action('admin_head', 'my_stylesheet1');
add_filter('login_redirect', 'my_login_redirect', 10, 3);
add_action('login_enqueue_scripts', 'ourLoginCSS');
function ourLoginCSS()
{
    wp_enqueue_style('agr-style', get_stylesheet_uri());
}

add_filter('login_headerurl', 'ourUrl');
function ourUrl()
{
    return esc_url(site_url('/'));
}

///**
// * Redirect user after successful login.
// *
// * @param string $redirect_to URL to redirect to.
// * @param string $request URL the user is coming from.
// * @param object $user Logged user's data.
// * @return string
// */
function my_login_redirect($redirect_to, $request, $user)
{

    //is there a user to check?
    if (isset($user->roles) && is_array($user->roles)) {

        // check for admins
        if (in_array('administrator', $user->roles)) {
            // redirect them to the default place
            return $redirect_to;
        } elseif (in_array('editor', $user->roles)) {
            // redirect them to the default place
            return $redirect_to;
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

//add_action('admin_init', 'subscriberRedirect');
//function subscriberRedirect() {
//    $currUser = wp_get_current_user();
//    if (count($currUser->roles) == 1 AND $currUser->roles[0] == 'subscriber') {
//        wp_redirect(site_url('/'));
//        exit;
//    }
//}

//wp_localize_script( 'my_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

// force rekomend posts to be private
//add_filter('wp_insert_post_data', 'makeRekPrivate');
//function makeRekPrivate ($data) {
//    if ($data['post_type'] == 'rekomend') {
////        $data['post_content'] = "private5";
//    }
//    if ($data['post_type'] == 'rekomend' AND $data['post_status'] != 'trash') {
//        $data['post_status'] = "private";
//    }
//  return $data;
//}
add_action('wp_ajax_md_support_save', 'md_support_save');
add_action('wp_ajax_nopriv_md_support_save', 'md_support_save');


//function md_support_save(){
////    $support_title = !empty($_POST['supporttitle']) ?
////        $_POST['supporttitle'] : 'Support Title';
//
//    if (!function_exists('wp_handle_upload')) {
//        require_once(ABSPATH . 'wp-admin/includes/file.php');
//    }
//    // echo $_FILES["upload"]["name"];
//    $uploadedfile = $_FILES['file'];
//    $upload_overrides = array('test_form' => false);
//    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
//
//    // echo $movefile['url'];
//    if ($movefile && !isset($movefile['error'])) {
//        echo "File Upload Successfully";
//    } else {
//        /**
//         * Error generated by _wp_handle_upload()
//         * @see _wp_handle_upload() in wp-admin/includes/file.php
//         */
//        echo $movefile['error'];
//    }
//    die();
//}


//if (current_user_can('subscriber') && !current_user_can('upload_files')) :
//    add_action('admin_init', 'razreshit_uchasnikam_gruzit_faili');
//endif;
//function razreshit_uchasnikam_gruzit_faili() {
//    $uchasnik= get_role('subscriber');
//    $uchasnik->add_cap('upload_files');
// }


function change_password_form()
{ ?>
    <form action="" method="post">
        <div class="mpd">
            <div>
                <label for="current_password">Старый пароль:</label>
                <input class="rspsw" id="current_password" type="password" name="current_password"
                       title="current_password" placeholder="" required>
            </div>
            <div>
                <label for="new_password">Новый пароль:</label>
                <input class="rspsw" id="new_password" type="password" name="new_password" title="new_password"
                       placeholder="" required>
            </div>
            <div><label for="confirm_new_password">Подтвердите новый пароль:</label>
                <input class="rspsw" id="confirm_new_password" type="password" name="confirm_new_password"
                       title="confirm_new_password" placeholder="" required>
            </div>
            <input type="submit" value="Обновить">
        </div>
    </form>
<?php }

function change_password()
{
    if (isset($_POST['current_password'])) {
        $_POST = array_map('stripslashes_deep', $_POST);
        $current_password = sanitize_text_field($_POST['current_password']);
        $new_password = sanitize_text_field($_POST['new_password']);
        $confirm_new_password = sanitize_text_field($_POST['confirm_new_password']);
        $user_id = get_current_user_id();
        $errors = array();
        $current_user = get_user_by('id', $user_id);
        // Check for errors
        if (empty($current_password) && empty($new_password) && empty($confirm_new_password)) {
            $errors[] = 'All fields are required';
        }
        if ($current_user && wp_check_password($current_password, $current_user->data->user_pass, $current_user->ID)) {
            //match
        } else {
            $errors[] = 'Password is incorrect';
        }
        if ($new_password != $confirm_new_password) {
            $errors[] = 'Password does not match';
        }
        if (strlen($new_password) < 6) {
            $errors[] = 'Password is too short, minimum of 6 characters';
        }
        if (empty($errors)) {
            wp_set_password($new_password, $current_user->ID);
            echo '<h3>Пароль успешно изменен!</h3>';
        } else {
            // Echo Errors
            echo '<h3>Errors:</h3>';
            foreach ($errors as $error) {
                echo '<p>';
                echo "<strong>$error</strong>";
                echo '</p>';
            }
        }

    }
}

function cp_form_shortcode()
{
    change_password();
    change_password_form();
}

add_shortcode('changepassword_form', 'cp_form_shortcode');

add_action('admin_enqueue_scripts', 'load_custom_script');
function load_custom_script()
{
    wp_enqueue_script('custom_js_script', get_bloginfo('template_url') . '/assets/js/custom.js', array('jquery'));
}

function get_user_role($user_id)
{
    global $wp_roles;
    $roles = array();
    $user = new WP_User($user_id);
    if (!empty($user->roles) && is_array($user->roles)) {
        foreach ($user->roles as $role)
            $roles[] .= translate_user_role($wp_roles->roles[$role]['name']);
    }
    return implode(', ', $roles);
}

// ====================================================
/* Create Staff Member User Role */
add_role(
    'role_rekruter', //  System name of the role.
    __( 'Рекрутер'  ), // Display name of the role.
    array(
//        'read'  => true,
//        'delete_posts'  => true,
//        'delete_published_posts' => true,
//        'edit_posts'   => true,
//        'publish_posts' => true,
//        'upload_files'  => true,
//        'edit_pages'  => true,
//        'edit_published_pages'  =>  true,
//        'publish_pages'  => true,
//        'delete_published_pages' => false,
        // This user will NOT be able to  delete published pages.
    )
);
add_role(
    'role_teamlead', //  System name of the role.
    __( 'Тимлид'  ), // Display name of the role.
    array(

    )
);
function has_user_role($check_role){
    $user = wp_get_current_user();
    if(in_array( $check_role, (array) $user->roles )){
        return true;
    }
    return false;
}
//function general_admin_notice()
//{
//    global $pagenow;
//    if ($pagenow == 'options-general.php') {
//        echo '<div class="notice notice-warning is-dismissible">
//             <p>Это уведомление появится на странице настроек.</p>
//         </div>';
//    }
//}
//
//add_action('admin_notices', 'general_admin_notice');
//
//function author_admin_notice()
//{
//    global $pagenow;
//    if ($pagenow == 'page-analitika.php') {
//        $user = wp_get_current_user();
//        if (in_array('administrator', (array)$user->roles)) {
//            echo '<div class="notice notice-info is-dismissible">
//          <p>Нажмите на <a href="edit.php">Записи</a> для того, чтобы начать статью.</p>
//         </div>';
//        }
//        echo '<div class="notice notice-info is-dismissible">
//          <p>Нажмите на <a href="edit.php">Записи</a> для того, чтобы начать статью.</p>
//         </div>';
//    }
//}
//
//add_action('admin_notices', 'author_admin_notice');

function home1() {
    if( is_page( 15 ) ) {
        wp_enqueue_style('home1_css', get_template_directory_uri() . '/assets/css/home1.css', array(), false, 'all');
        wp_enqueue_script('js_home1', get_template_directory_uri() . '/assets/js/home1.js', array('jquery'), '', false);
    }
}
add_action('wp_enqueue_scripts', 'home1');

add_action('wp_ajax_sbfilter', 'sbfilter_function'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_sbfilter', 'sbfilter_function');
function sbfilter_function()
{
    if(!empty($_POST['vac_speciality'])) {
        $taxonomy = !empty($_POST['vac_speciality']) ? $_POST['vac_speciality'] : array('php', 'java, javascript');
        echo $taxonomy;
        $taxonomy_terms = get_terms($taxonomy, array(
            'hide_empty' => 0,
            'fields' => 'names'
        ));
        $tech_id = 0;
        foreach ($taxonomy_terms as $custom_tax) { ?>
            <span id="techID<?php echo $tech_id ?>" class="tech_sc"><?php echo $custom_tax ?></span>
            <?php
            $tech_id++;
        }
    } else {
        $args = array(
            'post_type' => array('language', 'additional-lang', 'tech-lang', 'nontech'),
            'posts_per_page' => -1, // limit the number of posts if you like to
            'orderby' => 'title',
            'order' => 'ASC'
        );
        $custom_query = new WP_Query($args);
        $tech_id = 0;
        if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
            <span id="techID<?php echo $tech_id ?>" class="tech_sc"><?php the_title(); ?></span>
            <?php
            $tech_id++;
        endwhile; endif;
        wp_reset_postdata();
    }
}
add_action('wp_ajax_myfilter', 'misha_filter_function'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');

function misha_filter_function(){
    $args = array(
        'post_type' => 'candidate',
        'meta_key'          => 'zarplata',
        'orderby'           => 'meta_value',
        'order'	=> $_POST['date']
    );
    $recomendData = new WP_Query( $args );

    if( $recomendData->have_posts() ) :
        while( $recomendData->have_posts() ): $recomendData->the_post();?>
            <div class="myCandW mcd kandItem1 baza"
                 data-timer="<?php the_field('dataStart0'); ?>"
                 data-name1="<?php the_field('imya'); ?>"
                 data-pipe="public"
                 data-id="<?php the_ID(); ?>"
                 data-fam1="<?php the_field('familiya'); ?>" data-tel1="<?php the_field('telegram'); ?>"
                 data-ema1="<?php the_field('email_r'); ?>"
                 data-spec1="<?php $cand_s1 = get_field('spec1');
                 foreach ($cand_s1 as $s1) {
                     echo $s1->post_title . ', ';
                 }?>"
                 data-addspec1="<?php $cand_as1 = get_field('addspec1');
                 foreach ($cand_as1 as $as1) {
                     echo $as1->post_title . ', ';
                 }?>"
                 data-spec4="<?php $cand_s4 = get_field('spec4');
                 foreach ($cand_s4 as $s4) {
                     echo $s4->post_title . ', ';
                 }?>"
                 data-spec3="<?php $cand_s3 = get_field('spec3');
                 foreach ($cand_s3 as $s3) {
                     echo $s3->post_title . ', ';
                 }?>"
                 data-work_format="<?php $cand_tipr = get_field('tip_raboty');
                 foreach ($cand_tipr as $tr) {
                     echo $tr->post_title;
                 }?>" data-angl="<?php the_field('engl_r'); ?>" data-reg1="<?php the_field('region'); ?>"
                 data-cont="<?php $f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['label'] . " "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['label'] . " "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['label'] . " "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['label'] . " "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['label'] . " "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['label']; }?>"
                 data-contval="<?php $f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['value'] . ", "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['value'] . ", "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['value'] . ", "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['value'] . ", "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['value'] . ", "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['value']; }?>"
                 data-zar="<?php the_field('zarplata'); ?>"
                 data-country="<?php the_field('pipe_country'); ?>"
                 data-cit1="<?php $cand_cit1 = get_field('city_r');
                 foreach ($cand_cit1 as $c1) {
                     echo $c1->post_title;
                 } ?>" data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
                <?php if(get_field('komp_last')) { ?>
                 data-compn="<?php $cand_s3 = get_field('komp_last');
                 foreach ($cand_s3 as $s3) {
                     echo $s3->post_title;
                 }
                 } ?>"
                 <?php $timedb = get_field('dataStart0');
                 if($timedb){
                 ?>data-timedb="<?php echo $timedb; ?>" <?php
            }else{ ?>data-timedb="0" <?php }
            ?>>

                <div class="mcName">
                    <!-- <?php
                    $timedb = get_field('dataStart2');
                    if($timedb){
                        ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                    }else{ ?><input class="time_db" type="number" value="0"><?php }
                    ?>                     -->
                    <!-- <script>console.log('dd13');</script> -->
                    <div class="bk_name">
                        <a href="<?php the_permalink(); ?>">
                            <p class=""><?php the_field('imya'); ?> <?php the_field('familiya'); ?></p>
                        </a>
                    </div>
                </div>

                <div class="bk_mid1">
                    <div class="bk_country">
                        <?php $city = get_field('city_r');
                        if($city) {
                            foreach ($city as $c) {
                                ?>
                                <span class="spec1">
                            <?php
                            echo $c->post_title;
                            if (next($city)) {
                                echo ',';
                            }
                            ?>
                            <span class="dnone">a</span></span>
                                <?php
                            }
                        } ?></div>
                </div>
                <div class="bk_mid1">
                    <div class="bk_zp">
                        <span class="spec1">ЗП $<?php the_field('zarplata'); ?></span>
                    </div>
                </div>

                <div class="bk_mid2">
                    <?php if(get_field('engl_r')) { ?>
                        <div class="bk_angl">
                            <p class="spec1">Англ: <span class="dnone">a</span><?php the_field('engl_r'); ?></p>
                        </div>
                    <?php } ?>
                </div>
                <div class="bk_mid2">
                    <div class="bk_cont">
                        <?php
                        if (get_field('linkedin')) {
                            ?><p class="spec1 cp_btn bk_linkedin" id="bk_linkedin<?php echo $it;?>"><span><?php the_field('linkedin'); ?></span></p><?php
                        }
                        if (get_field('telegram')) {
                            ?><p class="spec1 cp_btn bk_telegram" id="bk_telegram<?php echo $it;?>"><span><?php the_field('telegram'); ?></span></p><?php
                        }
                        if (get_field('skype_r')) {
                            ?><p class="spec1 cp_btn bk_skype" id="bk_skype<?php echo $it;?>"><span><?php the_field('skype_r'); ?></span></p><?php
                        }
                        if (get_field('viber_r')) {
                            ?><p class="spec1 cp_btn bk_viber" id="bk_viber<?php echo $it;?>"><span><?php the_field('viber_r'); ?></span></p><?php
                        }
                        if (get_field('email_r')) {
                            ?><p class="spec1 cp_btn bk_email" id="bk_email<?php echo $it;?>"><span><?php the_field('email_r'); ?></span></p><?php
                        }
                        if (get_field('tel_r')) {
                        ?><p class="spec1 cp_btn bk_phone" id="bk_phone<?php echo $it;?>"><span><?php the_field('tel_r'); ?></span></p><?php
                        }
                        //                        if (!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                        //                            if (get_field('drugoe')) {
                        //                                ?><!--<p class="spec1">Другое: --><?php //the_field('drugoe'); ?><!--</p>--><?php
                        //                            }
                        //                        }
                        ?>
                    </div>
                </div>
                <div class="bk_end">
                    <div class="bk_cv">
                        <a href="javascript:void(0);" class="modalCv" id="modal-launcher">CV</a>
                        <div id="modal-background"></div>
                        <div id="modal-content">
                            <button id="modal-close">✖</button>
                            <embed src="<?php the_field('resume_r'); ?>" frameborder="0" width="100%" height="700px">
                        </div>

                    </div>
                </div>
                <div class="bk_end">
                    <button type="button" class="getToVac">Взяти на вакансію</button>
                </div>
            </div>
            <?php
            $it++;
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No posts found';
    endif;

    die();
}

function wp_delete_post_link($link = 'Видалити кандидата', $before = '', $after = '')
{
    global $post;
    if ( $post->post_type == 'page' ) {
        if ( !current_user_can( 'edit_page', $post->ID ) )
            return;
    } else {
        if ( !current_user_can( 'edit_post', $post->ID ) )
            return;
    }
    $link = "<a class='deleteCandidate' href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&amp;post=" . $post->ID, 'delete-post_' . $post->ID) . "'>".$link."</a>";
    echo $before . $link . $after;
}

//function update_candidate_post($post_id) {
//    error_log('update_candidate_post called for post_id: ' . $post_id);
//
//    // Если это новый пост
//    if (get_post_type($post_id) == 'candidate') {
//        // Получаем email из нового поста
//        $new_email = get_field('email_r', $post_id);
//
//        // Ищем существующий пост с таким же email
//        $existing_posts = get_posts(array(
//            'post_type' => 'candidate',
//            'meta_key' => 'email_r',
//            'meta_value' => $new_email,
//            'posts_per_page' => -1,
//            'post__not_in' => array($post_id),
//        ));
//
//        if (count($existing_posts) > 0) {
//            $existing_post = $existing_posts[0];
//            $existing_post_id = $existing_post->ID;
//
//            // Сравниваем дату последнего изменения
//            $last_modified = get_the_modified_date('U', $existing_post_id);
//            $now = time();
//            $three_months = 3 * 30 * 24 * 60 * 60;
//
//            if ($now - $last_modified > $three_months) {
//                // Обновляем существующий пост
//                $fields = get_fields($post_id);
//
//                foreach ($fields as $field_key => $field_value) {
//                    update_field($field_key, $field_value, $existing_post_id);
//                }
//            } else {
//                // Обновляем только те поля, которые изменились
//                $old_fields = get_fields($existing_post_id);
//
//                foreach ($old_fields as $field_key => $old_field_value) {
//                    $new_field_value = get_field($field_key, $post_id);
//
//                    if ($new_field_value != '' && $new_field_value != $old_field_value) {
//                        update_field($field_key, $new_field_value, $existing_post_id);
//                    }
//                }
//            }
//
//            // Удаляем новый пост, так как мы обновили существующий
//            wp_delete_post($post_id, true);
//        }
//    }
//}
//add_action('acf/save_post', 'update_candidate_post', 20);

/////////////////////////// Рабочий вариант ////////////////////////////////////////////////////////////////////////
///
//function update_candidate_post($post_id) {
//    error_log('update_candidate_post called for post_id: ' . $post_id);
//        if (get_post_type($post_id) == 'candidate') {
//            $new_email = get_field('email_r', $post_id);
//
//            $existing_posts = get_posts(array(
//                'post_type' => 'candidate',
//                'meta_key' => 'email_r',
//                'meta_value' => $new_email,
//                'posts_per_page' => -1,
//                'post__not_in' => array($post_id),
//            ));
//
//            if (count($existing_posts) > 0) {
//                $existing_post = $existing_posts[0];
//                $existing_post_id = $existing_post->ID;
//                $old_fields = get_fields($existing_post_id);
//
//                $last_modified = get_the_modified_date('U', $existing_post_id);
//                $now = time();
//                $three_months = 3 * 30 * 24 * 60 * 60;
//
//                if ($now - $last_modified > $three_months) {
//                    foreach ($old_fields as $field_key => $old_field_value) {
//                        $new_field_value = get_field($field_key, $post_id);
//                        if ($new_field_value !== '' && $new_field_value !== $old_field_value) {
//                            update_field($field_key, $new_field_value, $existing_post_id);
//                        }
//                    }
//                } else {
//                    foreach ($old_fields as $field_key => $old_field_value) {
//                        $new_field_value = get_field($field_key, $post_id);
//                        if ($old_field_value === '' && $new_field_value !== '') {
//                            update_field($field_key, $new_field_value, $existing_post_id);
//                        }
//                    }
//                }
//
//                wp_delete_post($post_id, true);
//            }
//        }
//    }
//    add_action('acf/save_post', 'update_candidate_post', 20);

function update_candidate_post($post_id) {
    if (get_post_type($post_id) == 'candidate') {
        $new_email = get_field('email_r', $post_id);

        $existing_posts = get_posts(array(
            'post_type' => 'candidate',
            'meta_key' => 'email_r',
            'meta_value' => $new_email,
            'posts_per_page' => -1,
            'post__not_in' => array($post_id),
        ));

        if (count($existing_posts) > 0) {
            $existing_post = $existing_posts[0];
            $existing_post_id = $existing_post->ID;
            $old_fields = get_fields($existing_post_id);

            $last_modified = get_the_modified_date('U', $existing_post_id);
            $now = time();
            $three_months = 3 * 30 * 24 * 60 * 60;

            $history = get_field('candidate_history', $existing_post_id);
            $current_time = date("Y-m-d H:i:s");

            if ($now - $last_modified > $three_months) {
                foreach ($old_fields as $field_key => $old_field_value) {
                    $new_field_value = get_field($field_key, $post_id);
                    if ($new_field_value !== '' && $new_field_value !== $old_field_value) {
                        $history .= "\n{$current_time}: Updated {$field_key} from '{$old_field_value}' to '{$new_field_value}'";
                        update_field($field_key, $new_field_value, $existing_post_id);
                    }
                }
            } else {
                foreach ($old_fields as $field_key => $old_field_value) {
                    $new_field_value = get_field($field_key, $post_id);
                    if ($old_field_value === '' && $new_field_value !== '') {
                        $history .= "\n{$current_time}: Updated {$field_key} from '{$old_field_value}' to '{$new_field_value}'";
                        update_field($field_key, $new_field_value, $existing_post_id);
                    }
                }
            }

            update_field('candidate_history', $history, $existing_post_id);
            wp_delete_post($post_id, true);
        }
    }
}
add_action('acf/save_post', 'update_candidate_post', 10);


function record_field_update_history($post_id) {
    $post_type = get_post_type($post_id);

    if ($post_type != 'candidate') {
        return;
    }

    error_log('record_field_update_history is running');

    $fields = get_field_objects($post_id);

    if ($fields) {
        $current_time = current_time('mysql');
        $changes = '';

        foreach ($fields as $field_name => $field) {
            if ($field_name !== 'candidate_history') {
                $old_value = $field['value'];
                $new_value = $_POST['acf'][$field['key']];

                if (is_array($old_value) || is_array($new_value)) {
                    $old_value = array_map(function ($item) {
                        return is_object($item) && get_class($item) === 'WP_Post' ? $item->post_title : $item;
                    }, (array) $old_value);

                    $new_value = array_map(function ($item) {
                        return is_object($item) && get_class($item) === 'WP_Post' ? $item->post_title : $item;
                    }, (array) $new_value);
                }

                if ($old_value !== '' && $old_value != $new_value) {
                    $old_value_str = is_array($old_value) ? implode(', ', $old_value) : $old_value;
                    $new_value_str = is_array($new_value) ? implode(', ', $new_value) : $new_value;
                    $changes .= "{$current_time}: Оновлено поле {$field['label']} з '{$old_value_str}' на '{$new_value_str}'\n";
                }
            }
        }

        if (!empty($changes)) {
            $current_history = get_field('candidate_history', $post_id, false);
            $updated_history = $current_history . $changes;
            update_field('candidate_history', $updated_history, $post_id);
        }
    }
}
add_action('acf/save_post', 'record_field_update_history', 20);


//function create_tech_post() {
//    $tech = array('reactjs','angularjs','vuejs','node.js','express.js','jquery','bootstrap','redux','d3.js','ember.js','meteor','gatsby','three.js','react native','typescript','Next.js', 'Nest.js', 'Svelte', 'Electron', 'GraphQL','Laravel', 'CodeIgniter', 'Symfony', 'Yii', 'CakePHP', 'Zend Framework', 'Slim', 'Phalcon', 'FuelPHP', 'Lumen', 'Doctrine', 'Aura', 'Flight', 'Fat-Free', 'PHPixie', 'RedBeanPHP', 'Kohana', 'PopPHP', 'Nette', 'SabreDAV', 'Spring Framework', 'Hibernate', 'Struts', 'JavaServer Faces (JSF)', 'Play Framework', 'Apache Wicket', 'Vaadin', 'Apache Struts 2', 'Grails', 'Spark Framework', 'Apache Tapestry', 'JHipster', 'Dropwizard', 'Blade', 'Micronaut', 'Vert.x', 'Quarkus', 'Apache Camel', 'Ratpack', 'Google Guice', 'Express', 'Nest.js', 'Koa', 'Hapi', 'Meteor', 'Sails.js', 'LoopBack', 'Restify', 'Feathers', 'Fastify', 'Socket.IO', 'Cheerio', 'Puppeteer', 'Winston', 'Mongoose', 'Passport', 'Async', 'Sharp', 'Bull', 'PM2', 'Android Studio', 'Java', 'Kotlin', 'React Native', 'Flutter', 'Corona SDK', 'PhoneGap', 'Ionic', 'ARCore', 'Realm', 'Dagger', 'Retrofit', 'Glide', 'Picasso', 'ButterKnife', 'EventBus', 'OkHttp', 'ASP.NET', 'Xamarin', 'Windows Forms', 'Blazor', 'Nancy', 'Qt', 'Boost', 'OpenCV', 'POCO', 'MFC', 'SDL', 'GLFW', 'OpenGL', 'SFML', 'VTK', 'FreeRTOS', 'Zephyr', 'mbed', 'Amazon FreeRTOS', 'Contiki', 'RIOT', 'ARM mbed OS', 'ChibiOS', 'NuttX', 'RT-Thread', '.NET Framework', 'Entity Framework', 'WPF', 'Unity', 'ServiceStack', '.NET Core', 'SignalR', 'Hangfire', 'AutoMapper', 'Serilog', 'Dapper', 'NLog', 'Polly', 'FluentValidation', 'IdentityServer4', 'Flutter SDK', 'Dart programming language', 'Bloc', 'Provider', 'Riverpod', 'GetX', 'Flutter Redux', 'RxDart', 'MobX', 'Equatable', 'Flutter SVG', 'Flutter Icons', 'Flutter Localizations', 'Flutter Swiper', 'Flutter Form Builder', 'Flutter Maps', 'Flutter Toast', 'Flutter DateTime Picker', 'Flutter Image Picker', 'Gin', 'Echo', 'Beego', 'Revel', 'Martini', 'Gorilla', 'Buffalo', 'Fiber', 'Iris', 'Negroni', 'Gorm', 'EchoSwagger', 'Viper', 'Cobra', 'Zap', 'Logrus', 'Go-kit', 'Colly', 'GoConvey', 'Testify', 'Xcode', 'Swift', 'Objective-C', 'SwiftUI', 'UIKit', 'CocoaPods', 'Carthage', 'Alamofire', 'Kingfisher', 'SnapKit', 'RxSwift', 'Combine', 'Firebase', 'CoreData', 'CoreAnimation', 'AVFoundation', 'MapKit', 'StoreKit', 'Pusher', 'UserNotifications', 'Django', 'Flask', 'PyTorch', 'TensorFlow', 'NumPy', 'Pandas', 'Matplotlib', 'SciPy', 'Scikit-learn', 'SQLAlchemy', 'Celery', 'FastAPI', 'Beautiful Soup', 'Dash', 'Tornado', 'Pygame', 'Pillow', 'Requests', 'pytest', 'Django REST framework', 'Ruby on Rails', 'Sinatra', 'Hanami', 'RSpec', 'Capybara', 'Pry', 'Sidekiq', 'Resque', 'Puma', 'Unicorn', 'Grape', 'Rack', 'Devise', 'Cancancan', 'Active Admin', 'Paperclip', 'CarrierWave', 'Haml', 'Sass', 'CoffeeScript', 'Rust Standard Library', 'Rocket', 'Actix', 'Diesel', 'Tokio', 'Serde', 'Hyper', 'Rust GTK', 'Rust OpenGL', 'Rust WASM', 'Rustyline', 'Iron', 'Warp', 'Tera', 'RustyXML', 'RustyYAML', 'Clap', 'Log4rs', 'env_logger', 'RustCrypto', 'Apex', 'Visualforce', 'Lightning Web Components (LWC)', 'Salesforce DX', 'Force.com IDE', 'Heroku', 'Salesforce REST API', 'SOQL', 'SOSL', 'Salesforce CLI', 'Salesforce Mobile SDK', 'Apex Unit Testing', 'Apex Trigger Framework', 'SFDX-Falcon', 'Salesforce AppExchange', 'Salesforce Shield', 'Salesforce Einstein', 'MavensMate', 'Skuid', 'Conga', 'Akka', 'Play', 'Slick', 'Cats', 'ZIO', 'Spark', 'ScalaTest', 'Scalaz', 'Shapeless', 'Circe', 'Finagle', 'Spray', 'Kafka', 'Cassandra', 'Elasticsearch', 'Akka HTTP', 'Scaldi', 'PureConfig', 'Monix', 'Doobie');
//    foreach ($tech as $tec) {
//        wp_insert_post(array(
//                'post_type' => 'tech-lang',
//                'post_status' => 'publish',
//                'post_title' => $tec,
//                $tec)
//        ); //cities its the tax slug
//    }
//}
//add_action('admin_init', 'create_tech_post');

//function create_tech_post() {
//    $tech = array('Австрія', 'Албанія', 'Андорра', 'Білорусь', 'Бельгія', 'Болгарія', 'Боснія і Герцеговина', 'Ватикан', 'Велика Британія', 'Венгрія', 'Греція', 'Грузія', 'Данія', 'Ізраїль', 'Ірландія', 'Ісландія', 'Іспанія', 'Італія', 'Кіпр', 'Косово', 'Латвія', 'Литва', 'Ліхтенштейн', 'Люксембург', 'Македонія', 'Мальта', 'Молдова', 'Монако', 'Нідерланди', 'Німеччина', 'Норвегія', 'Польща', 'Португалія', 'Росія', 'Румунія', 'Сан-Марино', 'Сербія', 'Словаччина', 'Словенія', 'Угорщина', 'Україна', 'Фінляндія', 'Франція', 'Хорватія', 'Чехія', 'Швейцарія', 'Швеція');
//    foreach ($tech as $tec) {
//        wp_insert_post(array(
//                'post_type' => 'countries',
//                'post_status' => 'publish',
//                'post_title' => $tec,
//                $tec)
//        ); //cities its the tax slug
//    }
//}
//add_action('wp', 'create_tech_post');

//$allposts= get_posts( array('post_type'=>'tech-lang','numberposts'=>-1) );
//foreach ($allposts as $eachpost) {
//    wp_delete_post( $eachpost->ID, true );
//}
////////////////////////////////////////// PRELAAST
//function enqueue_favorite_candidates_script() {
//    wp_enqueue_script('favorite-candidates', get_template_directory_uri() . '/assets/js/my-candscript.js', array('jquery'), '1.0.0', true);
//}
//add_action('wp_enqueue_scripts', 'enqueue_favorite_candidates_script');
//
//add_action('wp_ajax_toggle_favorite_candidate', 'toggle_favorite_candidate');
//add_action('wp_ajax_nopriv_toggle_favorite_candidate', 'toggle_favorite_candidate');
//
//function toggle_favorite_candidate() {
//    $candidate_id = intval($_POST['candidate_id']);
//    $user_id = intval($_POST['user_id']);
//
//    $favorite_candidates = get_field('favorite_candidates', 'user_' . $user_id);
//
//    if (!$favorite_candidates) {
//        $favorite_candidates = array();
//    }
//
//    if (in_array($candidate_id, $favorite_candidates)) {
//        $index = array_search($candidate_id, $favorite_candidates);
//        unset($favorite_candidates[$index]);
//        $result = update_field('favorite_candidates', $favorite_candidates, 'user_' . $user_id);
//        if ($result) {
//            echo 'removed|' . $user_id;
//        } else {
//            echo 'failed to update field|' . $user_id;
//        }
//    } else {
//        $favorite_candidates[] = $candidate_id;
//        $result = update_field('favorite_candidates', $favorite_candidates, 'user_' . $user_id);
//        if ($result) {
//            echo 'added|' . $user_id;
//        } else {
//            echo 'failed to update field|' . $user_id;
//        }
//    }
//
//    wp_die();
//
//function add_ajax_url_to_js() {
//    echo '<script type="text/javascript">
//           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
//         </script>';
//}
//add_action('wp_head', 'add_ajax_url_to_js');
//
//function add_user_id_to_js() {
//    echo '<script type="text/javascript">
//           var currentUserId = "' . get_current_user_id() . '";
//         </script>';
//}
//add_action('wp_head', 'add_user_id_to_js');
////////////////////////////////////////// PRELAAST end



////////////////////////////////////////////////////////
///
function save_additional_info($value, $post_id, $field) {
    // Якщо оновлюється поле "prichina_bl"
    if ($field['name'] === 'prichina_bl') {
        // Якщо значення поля "prichina_bl" порожнє, припиняємо виконання функції
        if (empty($value)) {
            return $value;
        }

        // Отримуємо поточне значення поля "additional_info" для поточного запису
        $additional_info = get_field('additional_info', $post_id);

        $current_date_time = current_time('mysql');
        $current_user = wp_get_current_user();
        $hto_dodav = $current_user->first_name . ' ' . $current_user->last_name;

        // Формуємо рядок з новою інформацією, що буде додана до поля "additional_info"
        $new_info = "</br><em>$current_date_time</em> - <b>Доданий в чорний список</b>. Додав: <b>$hto_dodav</b>, Причина: <b>$value</b>";

        if ($additional_info) {
            // Якщо поле "additional_info" вже містить якусь інформацію, то додамо до неї нову інформацію, розділивши їх комою
            $additional_info .= ", $new_info";
        } else {
            // Якщо поле "additional_info" ще порожнє, то новий рядок буде першим значенням поля
            $additional_info = $new_info;
        }

        // Оновлюємо значення поля "additional_info" для поточного запису
        $field_key = 'additional_info';
        update_field($field_key, $additional_info, $post_id);
    }

    return $value;
}
add_filter('acf/update_value', 'save_additional_info', 10, 3);


function remove_from_blacklist()
{
    if (isset($_POST['remove_from_blacklist'])) {
        $post_id = intval($_POST['remove_from_blacklist']);

        // Отримуємо поточне значення поля "additional_info" для поточного запису
        $additional_info = get_field('additional_info', $post_id);

        $current_date_time = current_time('mysql');
        $current_user = wp_get_current_user();
        $hto_vydalyv = $current_user->first_name . ' ' . $current_user->last_name;

        // Отримуємо значення поля "prichina_vydalennya" з форм

        $prichina_vydalennya = sanitize_text_field($_POST['prichina_vydalennya']);

// Формуємо рядок з новою інформацією, що буде додана до поля "additional_info"
        $new_info = "</br><em>$current_date_time</em> - <b>Видалений з чорного списку.</b> Видалив: <b>$hto_vydalyv</b>, Причина: <b>$prichina_vydalennya</b>";

        if ($additional_info) {
            // Якщо поле "additional_info" вже містить якусь інформацію, то додамо до неї нову інформацію, розділивши їх комою
            $additional_info .= ", $new_info";
        } else {
            // Якщо поле "additional_info" ще порожнє, то новий рядок буде першим значенням поля
            $additional_info = $new_info;
        }

// Оновлюємо значення поля "additional_info" для поточного запису
        $field_key = 'additional_info';
        update_field($field_key, $additional_info, $post_id);
        update_field('prichina_bl', '', $post_id);

// Видалити кандидата з чорного списку
// Залежно від вашої реалізації, ви можете видалити або змінити значення відповідного поля
    }
}
//////////////////////////////////////// fav button
///
function my_theme_enqueue_scripts() {
    // Реєстрація скрипту
    wp_register_script('favorite-candidates', get_template_directory_uri() . '/assets/js/my-candscript.js', array('jquery'), '1.0', true);

    // Локалізація скрипту для передачі даних, таких як URL AJAX
    wp_localize_script('favorite-candidates', 'my_theme_ajax', array('ajax_url' => admin_url('admin-ajax.php')));

    // Підключення скрипту
    wp_enqueue_script('favorite-candidates');
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

add_action('wp_ajax_toggle_favorite_candidate', 'toggle_favorite_candidate');
add_action('wp_ajax_nopriv_toggle_favorite_candidate', 'toggle_favorite_candidate');

function toggle_favorite_candidate() {
    if (!isset($_POST['candidate_id']) || !isset($_POST['favorited'])) {
        wp_send_json_error('Invalid parameters.');
    }

    $candidate_id = intval($_POST['candidate_id']);
    $favorited = ($_POST['favorited'] === 'true');

    if (!is_user_logged_in()) {
        wp_send_json_error('User not logged in.');
    }

    $user_id = get_current_user_id();
    $favorites = get_field('favorite_candidates', 'user_' . $user_id);

    if ($favorited) {
        $favorites = array_filter($favorites, function($item) use ($candidate_id) {
            return $item->ID !== $candidate_id;
        });
    } else {
        $favorites[] = $candidate_id;
    }

    update_field('favorite_candidates', $favorites, 'user_' . $user_id);

    wp_send_json_success();
}

function add_ajax_url_to_js() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'add_ajax_url_to_js');

function add_user_id_to_js() {
    echo '<script type="text/javascript">
           var currentUserId = "' . get_current_user_id() . '";
         </script>';
}
add_action('wp_head', 'add_user_id_to_js');

add_action('wp_ajax_check_favorite_candidate', 'check_favorite_candidate');
add_action('wp_ajax_nopriv_check_favorite_candidate', 'check_favorite_candidate');

function check_favorite_candidate() {
    if (!isset($_POST['candidate_id']) || !isset($_POST['user_id'])) {
        wp_send_json_error('Invalid parameters.');
    }

    $candidate_id = intval($_POST['candidate_id']);
    $user_id = intval($_POST['user_id']);

    if ($user_id === 0) {
        wp_send_json_error('User not logged in.');
    }

    $favorites = get_field('favorite_candidates', 'user_' . $user_id);
    $is_favorited = false;

    if ($favorites) {
        foreach ($favorites as $favorite) {
            if ($favorite->ID == $candidate_id) {
                $is_favorited = true;
                break;
            }
        }
    }

    wp_send_json_success(array('is_favorited' => $is_favorited));
}

////////////////////////////////// PDF PARSER ////////////////////////////////
/////
////define('WP_USE_THEMES', false);
//require_once 'vendor/autoload.php';
//use Smalot\PdfParser\Parser;
//
//function parse_and_create_candidate($post_id, $attachment_id) {
//    // Отримання локального шляху до файлу
//    $pdf_path = get_attached_file($attachment_id);
//
//    // Зчитування PDF-файлу
//    $parser = new \Smalot\PdfParser\Parser();
//    $pdf = $parser->parseFile($pdf_path);
//
//    // Отримання тексту з PDF-файлу
//    $text = $pdf->getText();
////    $text = preg_replace('/(?<=\w)\s(?=[A-Za-z0-9])/u', '', $text);
//    $text = preg_replace('/(?<=\w)\s(?=[A-Za-z0-9])/u', '', $text);
//    $text = preg_replace('/\s+/', ', ', $text);
//    $text = rtrim($text, ',');
//    // Збереження додаткових полів ACF
//    update_field('field_60d4627f9684e', $pdf_path, $post_id); // Зберігаємо поле "CV"
//    update_field('field_643f8aeade8ce', $text, $post_id); // Зберігаємо поле "pdf_parsed"
//}
//
//////////////////////////////// word parser /////////////////////////////////////////
//use PhpOffice\PhpWord\IOFactory;
//
//function parse_and_create_candidate_word($post_id, $attachment_id) {
//    // Отримання локального шляху до файлу
//    $word_path = get_attached_file($attachment_id);
//
//    // Зчитування Word-файлу
//    $phpWord = IOFactory::load($word_path);
//
//    // Отримання тексту з Word-файлу
//    $text = '';
//    $sections = $phpWord->getSections();
//    foreach ($sections as $section) {
//        $elements = $section->getElements();
//        foreach ($elements as $element) {
//            if (get_class($element) === 'PhpOffice\PhpWord\Element\TextRun') {
//                $textRuns = $element->getElements();
//                foreach ($textRuns as $textRun) {
//                    if (get_class($textRun) === 'PhpOffice\PhpWord\Element\Text') {
//                        $text .= $textRun->getText();
//                    }
//                }
//            }
//        }
//    }
//
//    // Збереження додаткових полів ACF
//    update_field('field_60d4627f9684e', $word_path, $post_id); // Зберігаємо поле "CV"
//    update_field('field_643f8aeade8ce', $text, $post_id); // Зберігаємо поле "pdf_parsed"
//}
//
////////////////// ACF save post ///////////////////////////////////
//function my_acf_save_post($post_id) {
//    // перевірте, чи є потрібний тип посту
//    if (get_post_type($post_id) !== 'candidate') {
//        return;
//    }
//
//    // отримайте URL завантаженого файлу (PDF або Word)
//    $file_url = get_field('field_60d4627f9684e', $post_id);
//
//    // перевірте, чи є дійсний URL
//    if (!$file_url || !filter_var($file_url, FILTER_VALIDATE_URL)) {
//        return;
//    }
//
//    // знайдіть ID вкладення за URL
//    global $wpdb;
//    $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid = %s", $file_url));
//
//    // отримайте розширення файлу
//    $file_path = get_attached_file($attachment_id);
//    $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
//
//    // виконайте парсинг файлу (PDF або Word) та оновіть відповідне поле
//    if (strtolower($file_ext) === 'pdf') {
//        parse_and_create_candidate($post_id, $attachment_id);
//    } elseif (strtolower($file_ext) === 'docx') {
//        parse_and_create_candidate_word($post_id, $attachment_id);
//    } else {
//        // Непідтримуваний тип файлу
//        return;
//    }
//}
//
//add_action('acf/save_post', 'my_acf_save_post', 20);


///////////////// PDF WORD ----------------------------------////////////////////////////////////////////////////////
///
///
require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;

function insert_pdf_attachment($pdfPath, $post_id, $filename) {
    $filetype = wp_check_filetype(basename($pdfPath), null);
    $wp_upload_dir = wp_upload_dir();

    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename($pdfPath),
        'post_mime_type' => $filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $pdfPath, $post_id);

    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $pdfPath);
    wp_update_attachment_metadata($attach_id, $attach_data);

    return $attach_id;
}

function convertDocToDocx($docPath, $docxPath) {
    $phpWord = \PhpOffice\PhpWord\IOFactory::load($docPath, 'MsDoc');
    $phpWord->save($docxPath, 'Word2007');
}

function convertDocxToPdf($docxPath, $pdfPath) {
    error_log("Функція convertDocxToPdf запущена");

    if (file_exists($docxPath)) {
        error_log("Файл .docx знайдено: " . $docxPath);
    } else {
        error_log("Файл .docx не знайдено: " . $docxPath);
        return;
    }

    $command = 'C:/Program Files/LibreOffice/program/soffice.exe --headless --convert-to pdf:writer_pdf_Export --outdir ' . escapeshellarg(dirname($pdfPath)) . ' ' . escapeshellarg($docxPath);
    $output = shell_exec($command);
}


function convert_resume_field_to_pdf($post_id) {
    if (isset($_FILES['acf']['name']['field_60d4627f9684e']) && $_FILES['acf']['name']['field_60d4627f9684e'] != '') {
        $uploadedFilePath = $_FILES['acf']['tmp_name']['field_60d4627f9684e'];
        $uploadedFileName = $_FILES['acf']['name']['field_60d4627f9684e'];

        // Сохранение загруженного файла .docx или .doc во временную директорию
        $tempDocxPath = tempnam(sys_get_temp_dir(), 'docx_');


        move_uploaded_file($uploadedFilePath, $tempDocxPath);

        $pdfFileName = pathinfo($uploadedFileName, PATHINFO_FILENAME) . '.pdf';
        $uploadDir = wp_upload_dir();
        $pdfFilePath = str_replace('.docx', '.pdf', str_replace('\\', '/', $uploadDir['path']) . '/' . $uploadedFileName);
        if (pathinfo($uploadedFileName, PATHINFO_EXTENSION) === 'docx' || pathinfo($uploadedFileName, PATHINFO_EXTENSION) === 'doc') {
            error_log("Поле tempDocxPath оновлено: " . $tempDocxPath);
            error_log("Поле pdfFilePath оновлено: " . $pdfFilePath);
            convertDocxToPdf($tempDocxPath, $pdfFilePath);
            $pdf_file_url = $uploadDir['url'] . '/' . $pdfFileName;
            $pdf_attach_id = insert_pdf_attachment($pdfFilePath, $post_id, $uploadedFileName);

            // Сохранение файла .docx
            $docxFilePath = str_replace('.pdf', '.docx', str_replace('\\', '/', $uploadDir['path']) . '/' . $uploadedFileName);
            copy($tempDocxPath, $docxFilePath);
            $docx_attach_id = insert_pdf_attachment($docxFilePath, $post_id, $uploadedFileName);

            // Збереження PDF-файлу в полі 'resume_r' і .docx-файлу в полі 'resume_docx'
            $updated_post = array(
                'ID' => $post_id,
                'meta_input' => array(
                    'resume_r' => $pdf_attach_id,
                    'resume_docx' => $docx_attach_id
                )
            );
            wp_update_post($updated_post);
            error_log("Поле resume_r оновлено: " . $pdf_file_url);

            // Додайте журналування для відлагодження
            error_log("Файл успішно збережено: " . $pdfFilePath);
        } else {
            // Додайте журналування для відлагодження
            error_log("Завантажений файл не має формату .docx");
        }

        // Удаление временного файла .docx после обработки
//        unlink($tempDocxPath);
    } else {
        error_log("Файл не було завантажено або не знайдено у полі resume_r");
    }
}
remove_action('acf/save_post', 'convert_resume_field_to_pdf', 20);
add_action('acf/save_post', 'convert_resume_field_to_pdf', 20);
/////////////////////////////////////////OOOOOOOOld////////////////////////////////////////////////////////////////////
///
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//require_once __DIR__ . '/vendor/autoload.php';
//
//use PhpOffice\PhpWord\IOFactory;
//use Mpdf\Mpdf;
//
//function insert_pdf_attachment($pdfPath, $post_id) {
//    $filetype = wp_check_filetype(basename($pdfPath), null);
//    $wp_upload_dir = wp_upload_dir();
//
//    $attachment = array(
//        'guid' => $wp_upload_dir['url'] . '/' . basename($pdfPath),
//        'post_mime_type' => $filetype['type'],
//        'post_title' => preg_replace('/\.[^.]+$/', '', basename($pdfPath)),
//        'post_content' => '',
//        'post_status' => 'inherit'
//    );
//
//    $attach_id = wp_insert_attachment($attachment, $pdfPath, $post_id);
//
//    require_once(ABSPATH . 'wp-admin/includes/image.php');
//    $attach_data = wp_generate_attachment_metadata($attach_id, $pdfPath);
//    wp_update_attachment_metadata($attach_id, $attach_data);
//
//    return $attach_id;
//}
//
//function convertDocxToPdf($docxPath) {
//    error_log("Функція convertDocxToPdf запущена");
//
//    if (file_exists($docxPath)) {
//        error_log("Файл .docx знайдено: " . $docxPath);
//    } else {
//        error_log("Файл .docx не знайдено: " . $docxPath);
//        return null;
//    }
//
//    $phpWord = IOFactory::load($docxPath);
//
//    // Конвертація в HTML
//    $xmlWriter = IOFactory::createWriter($phpWord, 'HTML');
//    $htmlContent = '';
//    ob_start();
//    $xmlWriter->save('php://output');
//    $htmlContent = ob_get_contents();
//    ob_end_clean();
//
//    $mpdf = new Mpdf();
//    $mpdf->WriteHTML($htmlContent);
//    $pdfContent = $mpdf->Output('', 'S');
//    error_log("Функція convertDocxToPdf повернула PDF-вміст");
//
//    return $pdfContent;
//}
//
//function handle_uploaded_docx_file($uploadedFilePath, $uploadedFileName) {
//    $tempDocxPath = tempnam(sys_get_temp_dir(), 'docx_');
//    move_uploaded_file($uploadedFilePath, $tempDocxPath);
//    return $tempDocxPath;
//}
//
//function convert_resume_field_to_pdf($post_id) {
//    if (isset($_FILES['acf']['name']['field_60d4627f9684e']) && $_FILES['acf']['name']['field_60d4627f9684e'] != '') {
//        $uploadedFilePath = $_FILES['acf']['tmp_name']['field_60d4627f9684e'];
//        $uploadedFileName = $_FILES['acf']['name']['field_60d4627f9684e'];
//
//        $tempDocxPath = handle_uploaded_docx_file($uploadedFilePath, $uploadedFileName);
//        $pdfFileName = pathinfo($uploadedFileName, PATHINFO_FILENAME) . '.pdf';
//        $uploadDir = wp_upload_dir();
//        $pdfFilePath = str_replace('\\', '/', $uploadDir['path']) . '/' . $pdfFileName;
//
//        if (pathinfo($uploadedFileName, PATHINFO_EXTENSION) === 'docx' || pathinfo($uploadedFileName, PATHINFO_EXTENSION) === 'doc') {
//            $pdfContent = convertDocxToPdf($tempDocxPath);
//            file_put_contents($pdfFilePath, $pdfContent);
//            $pdf_file_url = $uploadDir['url'] . '/' . $pdfFileName;
//            $pdf_attach_id = insert_pdf_attachment($pdfFilePath, $post_id);
//
//            // Збереження PDF-файлу в полі 'resume_r'
//            $updated_post = array(
//                'ID' => $post_id,
//                'meta_input' => array(
//                    'resume_r' => $pdf_attach_id
//                )
//            );
//            wp_update_post($updated_post);
//            error_log("Поле resume_r оновлено: " . $pdf_file_url);
//
//            // Додайте журналування для відлагодження
//            error_log("Файл успішно збережено: " . $pdfFilePath);
//        } else {
//            // Додайте журналування для відлагодження
//            error_log("Завантажений файл не має формату .docx");
//        }
//
//        // Видалення тимчасового файлу .docx після обробки
//        unlink($tempDocxPath);
//    } else {
//        error_log("Файл не було завантажено або не знайдено у полі resume_r");
//    }
//}
//
//remove_action('acf/save_post', 'convert_resume_field_to_pdf', 20);
//add_action('acf/save_post', 'convert_resume_field_to_pdf', 20);

