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
    if( is_page( 1087 ) || is_page( 1106 ) || is_page( 1181 ) || is_page( 1087 ) || is_page( 931 ) || is_page( 8488 ) || is_singular( $post_types = 'candidate' ) ) {
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
        'post_type' => array('candidate','rekomend'),
        'meta_key'          => 'zarplata',
        'orderby'           => 'meta_value',
        'order'	=> $_POST['date']
    );
    $recomendData = new WP_Query( $args );
    $it = 0;
    if( $recomendData->have_posts() ) :
        while( $recomendData->have_posts() ): $recomendData->the_post();?>
            <div class="myCandW mcd kandItem1 baza"
                 data-pdf="<?php the_field('pdf_parsed'); ?>"
                 data-timer="<?php the_field('dataStart0'); ?>"
                 data-name1="<?php the_field('imya'); ?>"
                 data-bl="<?php if (get_field('prichina_bl')) {echo "blacklist";} ?>"
                 data-name1="<?php the_field('imya'); ?>"
                 data-pipe="public"
                 data-id="<?php the_ID(); ?>"
                 data-fam1="<?php the_field('familiya'); ?>" data-tel1="<?php the_field('telegram'); ?>"
                 data-ema1="<?php the_field('email_r'); ?>"
                 data-spec1="<?php $cand_s1 = get_field('spec1');
                 foreach ($cand_s1 as $s1) {
                     echo $s1->post_title . ', ';
                 }?>"
                 data-spec4="<?php $cand_s1 = get_field('spec4');
                 foreach ($cand_s1 as $s1) {
                     echo $s1->post_title . ', ';
                 }?>"
                 data-angl="<?php the_field('engl_r'); ?>" data-reg1="<?php the_field('region'); ?>"
                 data-cont="<?php $f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['label'] . " "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['label'] . " "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['label'] . " "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['label'] . " "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['label'] . " "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['label']; }?>"
                 data-contval="<?php $f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['value'] . ", "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['value'] . ", "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['value'] . ", "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['value'] . ", "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['value'] . ", "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['value']; }?>" data-work_format="<?php $cand_tipr = get_field('tip_raboty');
            foreach ($cand_tipr as $tr) {
                echo $tr->post_title;
            } ?>"
                 data-zar="<?php the_field('zarplata'); ?>"
                 data-country="<?php $city = get_field('city_r'); foreach ($city as $c) { ?><?php echo $c->post_title;} ?>"
                 data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
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

                <div class="bk_time">
                    <p class=""><?php the_field('field_61c9624e3d8fc'); ?></p>
                </div>
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
                <div class="bk_mid2 cont_wrapper">
                    <div class="bk_cont">
                        <?php
                        if (get_field('linkedin')) {
                            ?><a href="https://www.linkedin.com/in/<?php the_field('linkedin'); ?>" class="spec1 cp_btn bk_linkedin" id="bk_linkedin<?php echo $it;?>"><span><?php the_field('linkedin'); ?></span></a><?php
                        }
                        if (get_field('telegram')) {
                            ?><a href="tg://resolve?domain=<?php the_field('telegram'); ?>" class="spec1 cp_btn bk_telegram" id="bk_telegram<?php echo $it;?>"><span><?php the_field('telegram'); ?></span></a><?php
                        }
                        if (get_field('skype_r')) {
                            ?><a href="skype:<?php the_field('skype_r'); ?>?chat" class="spec1 cp_btn bk_skype" id="bk_skype<?php echo $it;?>" target="_blank"><span><?php the_field('skype_r'); ?></span></a><?php
                        }
                        if (get_field('viber_r')) {
                            ?><a href="viber://chat?number=%2B<?php the_field('viber_r'); ?>" class="spec1 cp_btn bk_viber" id="bk_viber<?php echo $it;?>" target="_blank"><span><?php the_field('viber_r'); ?></span></a><?php
                        }
                        if (get_field('email_r')) {
                            ?><a href="javascript:void(0);" class="spec1 cp_btn bk_email" id="bk_email<?php echo $it;?>"><span><?php the_field('email_r'); ?></span></a><?php
                        }
                        if (get_field('tel_r')) {
                            ?><a href="javascript:void(0);" class="spec1 cp_btn bk_phone" id="bk_phone<?php echo $it;?>"><span><?php the_field('tel_r'); ?></span></a><?php
                        }
                        ?>
                    </div>
                </div>
                <div class="bk_end">
                    <div class="bk_cv">
                        <a href="javascript:void(0);" class="modalCv" id="modal-launcher">CV</a>
                        <div id="modal-background"></div>
                        <div id="modal-content">
                            <button id="modal-close">✖</button>
                            <?php
                            $resume_id = get_field('resume_r');
                            // URL файла с помощью идентификатора
                            $resume_url = wp_get_attachment_url($resume_id);
                            ?>
                            <?php
                            if (get_field('prichina_bl')) { ?>
                                <button class="lb-bl bkpage" id="open-popup">В чорному списку!!!</button>
                                <div id="popup" class="popup">
                                    <div id="popup-content">
                                        <p><?php the_field('povnij_opis_chs')?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <embed src="<?php echo $resume_url; ?>" frameborder="0" width="100%" height="700px">
                            <?php $post_id = get_the_ID(); // Получите ID текущего поста
                            $docx_attach_id = get_post_meta($post_id, 'resume_docx', true); // ID вложения .docx файла
                            $docx_url = wp_get_attachment_url($docx_attach_id); //URL вложения .docx файла
                            ?>
                            <a href="<?php echo $docx_url; ?>" class="dnl_btn" download="">Завантажити у форматі .docx</a>
                        </div>
                    </div>
                </div>
                <div class="bk_end">
                    <button type="button" class="getToVac">Взяти на вакансію</button>
                    <!--                        <button class="favorite-star" data-candidate-id="--><?php //echo get_the_ID(); ?><!--">-->
                    <!--                            <i class="fas fa-star"></i>-->
                    <!--                            eeeeeee-->
                    <!--                        </button>-->
                    <button class="favorite-star" data-candidate-id="<?php echo get_the_ID(); ?>">
                        ☆
                    </button>

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

function wp_delete_post_link($link = '', $before = '', $after = '')
{
    global $post;
    if ( $post->post_type == 'page' ) {
        if ( !current_user_can( 'edit_page', $post->ID ) )
            return;
    } else {
        if ( !current_user_can( 'edit_post', $post->ID ) )
            return;
    }
    $image_url = get_bloginfo('template_url') . '/assets/img/trash.png';
    $link = "<a class='deleteCandidate' href='#' data-href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&amp;post=" . $post->ID, 'delete-post_' . $post->ID) . "' onclick=\"confirmDeletion(this); return false;\"><img src='" . $image_url . "' alt='Видалити кандидата'></a>";
    echo $before . $link . $after;
}

function redirect_after_delete() {
    if (isset($_GET['deleted']) && $_GET['deleted'] == '1') {
        $redirect_url = get_bloginfo('url') . '/baza-kandidatov';
        wp_redirect($redirect_url);
        exit;
    }
}
add_action('init', 'redirect_after_delete');



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
//////////////////// ACF SAVE POST CRON ////////////////////////////////////////////////////////////////////////////////
///
/// ACF SAVE POST CRON
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//function update_candidate_post($post_id) {
//    if (get_post_type($post_id) == 'candidate') {
//        $new_email = get_field('email_r', $post_id);
//
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
//            $old_fields = get_fields($existing_post_id);
//
//            $last_modified = get_the_modified_date('U', $existing_post_id);
//            $now = time();
//            $three_months = 3 * 30 * 24 * 60 * 60;
//
//            $history = get_field('additional_info', $existing_post_id);
//            $current_time = date("Y-m-d H:i:s");
//
//            if ($now - $last_modified > $three_months) {
//                foreach ($old_fields as $field_key => $old_field_value) {
//                    $new_field_value = get_field($field_key, $post_id);
//                    if ($new_field_value !== '' && $new_field_value !== $old_field_value) {
//                        $history .= "</br>\n{$current_time}: Updated {$field_key} from '{$old_field_value}' to '{$new_field_value}'</br>";
//                        update_field($field_key, $new_field_value, $existing_post_id);
//                    }
//                }
//            } else {
//                foreach ($old_fields as $field_key => $old_field_value) {
//                    $new_field_value = get_field($field_key, $post_id);
//                    if ($old_field_value === '' && $new_field_value !== '') {
//                        $history .= "</br>\n{$current_time}: Updated {$field_key} from '{$old_field_value}' to '{$new_field_value}'</br>";
//                        update_field($field_key, $new_field_value, $existing_post_id);
//                    }
//                }
//            }
//
//            update_field('additional_info', $history, $existing_post_id);
//            wp_delete_post($post_id, true);
//        }
//    }
//}
//add_action('acf/save_post', 'update_candidate_post', 10);


add_action('acf/save_post', 'save_changes_to_additional_info', 20);
function save_changes_to_additional_info($post_id) {
    // Если это не нужный тип записи, пропустить
    if (get_post_type($post_id) != 'candidate') {
        return;
    }
    // Если это новый пост, пропустить
    $post = get_post($post_id);
    if ($post->post_date_gmt === $post->post_modified_gmt) {
        return;
    }
//    error_log('Candidate post detected: ' . $post_id);

    // Получить старые и новые значения полей
    $fields_to_check = array(
        'field_60f1c99e93bf8' => 'Посада',
        'field_60f726e1937cd' => 'Рівень англійської',
        'field_60f7278cc75e7' => 'Стаж',
        'field_610e35e8df773' => 'Skype',
        'field_610e27236f96a' => 'Telegram',
        'field_610e35d5df772' => 'Viber',
        'field_64199caf47447' => 'Whatsapp',
        'field_60f6b37e97c93' => 'Телефон',
        'field_64199a44ba4b7' => 'Email',
        'field_61c4420ff8ea3' => 'Linkedin',
        'field_610e3736b9278' => 'Інше',
        'field_60f726af937cc' => 'Локація',
        'field_644f92c44e3ee' => 'Додатково'
    );

//    $old_values = array();
//    foreach ($fields_to_check as $field_key => $field_name) {
//        $old_values[$field_key] = get_field($field_key, $post_id);
//    }
    $old_values = array();
    foreach ($fields_to_check as $field_key => $field_name) {
        $old_value = get_field($field_key, $post_id);
        if (is_array($old_value)) {
            // Преобразовать каждый объект WP_Post в его ID
            $old_value = array_map(function ($post) {
                if (is_object($post) && property_exists($post, 'ID')) {
                    return $post->ID;
                } else {
                    return $post;
                }
            }, $old_value);
        }
        $old_values[$field_key] = $old_value;
    }

// Обработка значений field_60f1c99e93bf8 (Посада)
    if (isset($old_values['field_60f1c99e93bf8'])) {
        if (is_string($old_values['field_60f1c99e93bf8'])) {
            $old_values['field_60f1c99e93bf8'] = array($old_values['field_60f1c99e93bf8']);
        }
        $values_array = $old_values['field_60f1c99e93bf8'];
        $values_string = array();
        foreach ($values_array as $value) {
            if (is_object($value) && property_exists($value, 'post_title')) {
                $values_string[] = $value->post_title;
            } elseif (is_string($value)) {
                $values_string[] = $value;
            }
        }
        $old_values['field_60f1c99e93bf8'] = implode(', ', $values_string);
    }

    $new_values = $_POST['acf'];
    $new_value_60f1c99e93bf8 = $new_values['field_60f1c99e93bf8'];

    if (is_array($new_value_60f1c99e93bf8)) {
        $new_value_titles = array();
        foreach ($new_value_60f1c99e93bf8 as $id) {
            if (is_string($id) && !empty($id)) { // Added check for !empty($id)
                $new_value_titles[] = get_the_title($id);
            }
        }
        $new_values['field_60f1c99e93bf8'] = implode(', ', $new_value_titles);
    }

//    error_log('Old values: ' . print_r($old_values, true));
//    error_log('New values: ' . print_r($new_values, true));

    $changes = array();

    foreach ($fields_to_check as $field_key => $field_name) {
        if (isset($old_values[$field_key]) && isset($new_values[$field_key])) {
            $old_value = $old_values[$field_key];
            $new_value = $new_values[$field_key];
            // Преобразование значений field_60f1c99e93bf8 (Посада) в названия
//            if ($field_key == 'field_60f1c99e93bf8') {
//                if (is_array($old_value)) {
//                    $old_value_titles = array();
//                    foreach ($old_value as $id) {
//                        if (is_string($id)) {
//                            $old_value_titles[] = get_the_title($id);
//                        }
//                    }
//                    $old_value = implode(', ', $old_value_titles);
//                }
//                if (is_array($new_value)) {
//                    $new_value_titles = array();
//                    foreach ($new_value as $id) {
//                        if (is_string($id)) {
//                            $new_value_titles[] = get_the_title($id);
//                        }
//                    }
////                    $new_value = implode(', ', $new_value_titles);
//                    $new_value = implode($new_value_titles);
//                }
//            }
//            // Преобразование значений field_60f726af937cc (Локація) в названия
//            if ($field_key == 'field_60f726af937cc') {
//                if (is_array($old_value)) {
//                    $old_value_titles = array();
//                    foreach ($old_value as $obj) {
//                        if (is_object($obj) && property_exists($obj, 'post_title')) {
//                            $old_value_titles[] = $obj->post_title;
//                        }
//                    }
//                    $old_value = implode(', ', $old_value_titles);
//                }
//                if (is_array($new_value)) {
//                    $new_value_titles = array();
//                    foreach ($new_value as $obj) {
//                        if (is_object($obj) && property_exists($obj, 'post_title')) {
//                            $new_value_titles[] = $obj->post_title;
//                        }
//                    }
//                    $new_value = implode(', ', $new_value_titles);
//                }
//            }
            // Преобразование значений field_60f1c99e93bf8 (Посада) в названия
            if ($field_key == 'field_60f1c99e93bf8' || $field_key == 'field_60f726af937cc') {
                if (is_array($old_value)) {
                    $old_value_titles = array();
                    foreach ($old_value as $id) {
                        if (is_string($id)) {
                            $old_value_titles[] = get_the_title($id);
                        }
                    }
                    $old_value = implode(', ', $old_value_titles);
                }
                if (is_array($new_value)) {
                    $new_value_titles = array();
                    foreach ($new_value as $id) {
                        if (is_string($id)) {
                            $new_value_titles[] = get_the_title($id);
                        }
                    }
                    $new_value = implode(', ', $new_value_titles);
                }
            }
// Преобразование значений field_60f726af937cc (Локація) в названия
//            if ($field_key == 'field_60f726af937cc') {
//                if (is_array($old_value)) {
//                    $old_value_titles = array();
//                    foreach ($old_value as $obj) {
//                        if (is_object($obj) && property_exists($obj, 'post_title')) {
//                            $old_value_titles[] = $obj->post_title;
//                        }
//                    }
//                    $old_value = implode(', ', $old_value_titles);
//                }
//                if (is_array($new_value)) {
//                    $new_value_titles = array();
//                    foreach ($new_value as $obj) {
//                        if (is_object($obj) && property_exists($obj, 'post_title')) {
//                            $new_value_titles[] = $obj->post_title;
//                        }
//                    }
//                    $new_value = implode(', ', $new_value_titles);
//                }
//            }


//            // Сравнить старое и новое значения
//            if ($old_value != $new_value) {
//                $changes[] = '</br><em>' . current_time('Y-m-d H:i:s') . " - </em> <strong>Оновлено поле:</strong> $field_name на <strong>$old_value</strong>";
//            }
            if (($old_value !== null || $new_value !== null) && wp_json_encode($old_value) != wp_json_encode($new_value)) {
                $changes[] = '</br><em>' . current_time('Y-m-d H:i:s') . " - </em> <strong>Оновлено поле:</strong> $field_name на <strong>$new_value</strong>";
            }

        }
    }
//    error_log('Changes: ' . print_r($changes, true));

    // Если есть изменения, добавить их к полю additional_info
    if (!empty($changes)) {
        $old_additional_info = get_post_meta($post_id, 'additional_info', true);
//        $new_changes = implode("\n", $changes);
        $new_changes = implode($changes);

        if (!empty($old_additional_info)) {
//            $additional_info = $old_additional_info . "\n" . $new_changes;
            $additional_info = $old_additional_info . $new_changes;
        } else {
            $additional_info = $new_changes;
        }

        update_post_meta($post_id, 'additional_info', $additional_info);
//        error_log('Updated additional_info: ' . $additional_info);
    }
}

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
        $field_key2 = 'povnij_opis_chs';
        update_field($field_key, $additional_info, $post_id);
        update_field($field_key2, $new_info, $post_id);
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
//
///////////////// PDF <=> WORD - PARSER/CONVERTOR -----------------------END-----------////////////////////////////////////////////////////////
///

require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Smalot\PdfParser\Parser;

function insert_pdf_attachment($pdfPath, $post_id, $filename) {
    $filetype = wp_check_filetype(basename($pdfPath), null);
    $wp_upload_dir = wp_upload_dir();

    // Изменение нижеследующей строки: заменить basename($pdfPath) на $filename
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . $filename,
        'post_mime_type' => $filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $pdfPath, $post_id);

    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $pdfPath);
    wp_update_attachment_metadata($attach_id, $attach_data);

    return $attach_id;
}

function parsePdf($pdfPath) {
    $parser = new Parser();
    $pdf = $parser->parseFile($pdfPath);
    $text = $pdf->getText();
    return $text;
}
function convertPdfToDocx($pdfPath, $docxPath) {
//    $libreoffice_path = "/usr/bin/libreoffice";
    $libreoffice_path = "C:\Program Files\LibreOffice\program\soffice.exe";
    $cmd = "\"{$libreoffice_path}\" --headless --infilter=\"writer_pdf_import\" --convert-to doc --outdir \"" . pathinfo($docxPath, PATHINFO_DIRNAME) . "\" \"{$pdfPath}\"";
    $return_var = 0;
    system($cmd, $return_var);

    if ($return_var == 0) {
        error_log("Конвертация PDF в DOCX прошла успешно.");
    } else {
        error_log("Ошибка конвертации PDF в DOCX. Код возврата: " . $return_var);
    }
}

//Конвертируем ВОРД В ПДФ
function convertDocxToPdf($docxPath, $pdfPath) {
    error_log("Функція convertDocxToPdf запущена");
//    $libreoffice_executable = "/usr/bin/libreoffice";
    $libreoffice_executable = 'C:\Program Files\LibreOffice\program\soffice.exe';

    if (file_exists($docxPath)) {
        error_log("Файл .docx или .doc знайдено: " . $docxPath);
    } else {
        error_log("Файл .docx или .doc не знайдено: " . $docxPath);
        return;
    }
    $tempDocxWithCorrectName = dirname($docxPath) . DIRECTORY_SEPARATOR . pathinfo($docxPath, PATHINFO_FILENAME) . '.' . pathinfo($docxPath, PATHINFO_EXTENSION);
    copy($docxPath, $tempDocxWithCorrectName);

    $cmd = '"' . $libreoffice_executable . '" --headless --convert-to pdf:writer_pdf_Export --outdir "' . dirname($pdfPath) . '" "' . str_replace('/', DIRECTORY_SEPARATOR, $tempDocxWithCorrectName) . '"';
    error_log("Выполняемая команда: " . $cmd);
    $returnCode = system($cmd, $output);
    if ($returnCode === FALSE) {
        error_log("Ошибка конвертации. Не удалось выполнить команду.");
    } else {
        error_log("Конвертация прошла успешно.");
    }
    error_log("Код возврата: " . $output);

//    unlink($tempDocxWithCorrectName);
}

function convert_resume_field_to_pdf($post_id) {
    if (isset($_FILES['acf']['name']['field_60d4627f9684e']) && $_FILES['acf']['name']['field_60d4627f9684e'] != '') {
        $uploadedFilePath = $_FILES['acf']['tmp_name']['field_60d4627f9684e'];
        $uploadedFileName = $_FILES['acf']['name']['field_60d4627f9684e'];
        $uploadedFileName = strtolower(str_replace([' ', '(', ')'], ['-', '', ''], $uploadedFileName));

        // Сохранение загруженного файла .docx или .doc в директории uploads
        $uploadDir = wp_upload_dir();
        $docxFilePath = $uploadDir['path'] . '/' . $uploadedFileName;
        move_uploaded_file($uploadedFilePath, $docxFilePath);
        $pdfFileName = pathinfo($uploadedFileName, PATHINFO_FILENAME) . '.pdf';
        $pdfFilePath = str_replace(['.docx', '.doc'], '.pdf', str_replace('\\', '/', $uploadDir['path']) . '/' . $uploadedFileName);
        error_log("upl file ext: " . pathinfo($uploadedFileName, PATHINFO_EXTENSION));

        if (pathinfo($uploadedFileName, PATHINFO_EXTENSION) === 'docx' || pathinfo($uploadedFileName, PATHINFO_EXTENSION) === 'doc') {
            error_log("Поле docxFilePath обновлено: " . $docxFilePath);
            error_log("Поле pdfFilePath обновлено: " . $pdfFilePath);
            convertDocxToPdf($docxFilePath, $pdfFilePath);
            sleep(5);
            // Parse text from PDF
            if (file_exists($pdfFilePath)) {
                $parsedPdfText = parsePdf($pdfFilePath);
            } else {
                error_log("Файл .pdf не найден: " . $pdfFilePath);
            }
            // Insert parsed text into 'pdf_parsed' field (key field_643f8aeade8ce)
            update_field('field_643f8aeade8ce', $parsedPdfText, $post_id);

            $pdf_file_url = $uploadDir['url'] . '/' . $pdfFileName;
            $pdf_attach_id = insert_pdf_attachment($pdfFilePath, $post_id, $uploadedFileName);

            // Saving .docx file
            $docxFilePath = str_replace('.pdf', '.docx', str_replace('\\', '/', $uploadDir['path']) . '/' . $uploadedFileName);
//            copy($docxFilePath, $docxFilePath);
            $docx_attach_id = insert_pdf_attachment($docxFilePath, $post_id, $uploadedFileName);
//            unlink($docxFilePath);


            // Save PDF file to 'resume_r' field and .docx file to 'resume_docx' field
            $updated_post = array(
                'ID' => $post_id,
                'meta_input' => array(
                    'resume_r' => $pdf_attach_id,
                    'resume_docx' => $docx_attach_id
                )
            );
            wp_update_post($updated_post);
            error_log("Поле resume_r обновлено: " . $pdf_file_url);

            // Add logging for debugging
            error_log("Файл успешно сохранен: " . $pdfFilePath);
        }
        if (pathinfo($uploadedFileName, PATHINFO_EXTENSION) === 'pdf') {
            error_log("Поле pdfFilePath обновлено: " . $pdfFilePath);

            // Конвертировать PDF в DOCX
            $docxFilePath = str_replace('.pdf', '.docx', $pdfFilePath);
            sleep(5);
            convertPdfToDocx($pdfFilePath, $docxFilePath);

            // Сохранить DOCX-файл в поле resume_docx
            $docx_attach_id = insert_pdf_attachment($docxFilePath, $post_id, $uploadedFileName);
            $updated_post = array(
                'ID' => $post_id,
                'meta_input' => array(
                    'resume_docx' => $docx_attach_id
                )
            );
            wp_update_post($updated_post);

        } else {
            // Add logging for debugging
            error_log("Загруженный файл не имеет формата .docx или .pdf");
        }



        $pdf_attach_id = insert_pdf_attachment($pdfFilePath, $post_id, $uploadedFileName);

        // Saving .docx file
        $docxFilePath = str_replace('.pdf', '.docx', str_replace('\\', '/', $uploadDir['path']) . '/' . $uploadedFileName);
//        copy($docxFilePath, $docxFilePath);
        $docx_attach_id = insert_pdf_attachment($docxFilePath, $post_id, $uploadedFileName);

        // Удаление временного файла .docx после обработки
//        unlink($docxFilePath);

        // Парсинг текста из PDF-файла
        $pdf_parsed_text = parsePdf($pdfFilePath);
        $pdf_parsed_text2 = preg_replace('/\s+/u', ' ', $pdf_parsed_text);;

        // Remove all whitespace characters using a custom callback
        $pdf_parsed_text3 = preg_replace('/^\s+|\s+$/m', '', $pdf_parsed_text2);
        update_field('field_643f8aeade8ce', $pdf_parsed_text3, $post_id);

        // Обновление записи с добавлением распарсенного текста PDF
        $updated_post = array(
            'ID' => $post_id,
            'meta_input' => array(
                'resume_r' => $pdf_attach_id,
                'resume_docx' => $docx_attach_id
            )
        );
        wp_update_post($updated_post);
        error_log("Поле field_643f8aeade8ce обновлено: " . $pdf_parsed_text);
    } else {
        error_log("Загруженный файл не имеет формата .docx");
    }
}
remove_action('acf/save_post', 'convert_resume_field_to_pdf', 20);
add_action('acf/save_post', 'convert_resume_field_to_pdf', 20);

// Vacancy update field field_645272746b7d4
function set_creation_date_on_save($post_id) {
    // Убедитесь, что это пост нужного типа
    if (get_post_type($post_id) == 'vacancy') {
        // Получаем текущую дату и время
        $current_datetime = current_time('Y-m-d H:i');

        // Обновляем поле даты и времени в ACF
        update_field('field_645272746b7d4', $current_datetime, $post_id);
    }
}
add_action('acf/save_post', 'set_creation_date_on_save', 15);

add_action('acf/save_post', 'save_client_id', 10, 1);
function save_client_id($post_id) {
    if (get_post_type($post_id) == 'vacancy') {
        global $post;

        // Проверяем, является ли текущий пост клиентом (на основе типа записи)
        if (get_post_type($post->ID) == 'client') {
            $client_id = $post->ID;
        } else {
            // Обработка ситуации, когда клиент не найден или текущий пост не является клиентом
        }

        update_field('field_64522925800fa', $client_id, $post_id); // Замените "field_64522925800fa" на реальный ключ вашего поля
    }
}

//
// my_acf_add_vacancy_to_client
//
function my_acf_add_vacancy_to_client($post_id) {
    // Получаем пост по ID
    $post = get_post($post_id);

    // Проверяем, что это вакансия и это новая запись
    if ($post->post_type == 'vacancy' && $post->post_status == 'auto-draft') {
        // Получаем значение поля client_id
        $client_id = get_field('field_64522925800fa', $post_id);

        if ($client_id) {
            // Получаем текущие вакансии клиента
            $current_vacancies = get_field('clvakansi', $client_id);

            // Добавляем новую вакансию
            $current_vacancies[] = $post_id;

            // Обновляем поле clvakansi для клиента
            update_field('clvakansi', $current_vacancies, $client_id);
        }
    }
}
add_action('acf/save_post', 'my_acf_add_vacancy_to_client', 10, 1);
//
// update_post_title_from_nazva_vakansi
//
function update_post_title_from_nazva_vakansi( $data, $postarr ) {
    // Проверяем, что это запись типа 'vacancy'
    if ( $data['post_type'] == 'vacancy' ) {
        // Проверяем, что в массиве $_POST есть значение 'acf'
        if ( isset( $_POST['acf'] ) ) {
            // Получаем поле 'nazva_vakansi' из массива $_POST
            $nazva_vakansi = isset( $_POST['acf']['field_64520ddfddde6'] ) ? $_POST['acf']['field_64520ddfddde6'] : '';

            // Если значение 'nazva_vakansi' не пустое, устанавливаем его как заголовок записи
            if ( !empty( $nazva_vakansi ) ) {
                $data['post_title'] = $nazva_vakansi;
            }
        }
    }

    return $data;
}

add_filter( 'wp_insert_post_data', 'update_post_title_from_nazva_vakansi', 10, 2 );
//
// update_vacancy_title
//
function update_vacancy_title( $post_id ) {
    // Проверяем, что это запись типа "vacancy".
    if ( get_post_type( $post_id ) === 'vacancy' ) {
        // Получаем значение поля "nazva_vakansi".
        $nazva_vakansi = get_field( 'nazva_vakansi', $post_id );

        // Обновляем название поста с использованием значения поля "nazva_vakansi".
        wp_update_post( array(
            'ID'         => $post_id,
            'post_title' => $nazva_vakansi,
        ) );
    }
}
add_action( 'acf/save_post', 'update_vacancy_title', 20 );


function update_post_title_from_company_name( $data, $postarr ) {
    if ( $data['post_type'] == 'client' ) {
        // Проверяем, что в массиве $_POST есть значение 'acf'
        if ( isset( $_POST['acf'] ) ) {
            // Получаем поле 'company_name' из массива $_POST
            $company_name = isset( $_POST['acf']['field_644fa717d31a3'] ) ? $_POST['acf']['field_644fa717d31a3'] : '';
            if ( !empty( $company_name ) ) {
                $data['post_title'] = $company_name;
            }
        }
    }
    return $data;
}

add_filter( 'wp_insert_post_data', 'update_post_title_from_company_name', 10, 2 );

function update_client_title( $post_id ) {
    if ( get_post_type( $post_id ) === 'client' ) {
        $company_name = get_field( 'company_name', $post_id );
        wp_update_post( array(
            'ID'         => $post_id,
            'post_title' => $company_name,
        ) );
    }
}
add_action( 'acf/save_post', 'update_client_title', 20 );

function my_theme_single_template( $single_template ) {
    global $post;

    if ( $post->post_type == 'vacancy' ) {
        $single_template = dirname( __FILE__ ) . '/single-vacancy.php';
    }
    return $single_template;
}
add_filter( 'single_template', 'my_theme_single_template' );

function my_log($message) {
    if (is_array($message) || is_object($message)) {
        error_log(print_r($message, true));
    } else {
        error_log($message);
    }
}

function my_acf_form_submit($form) {
    my_log('ACF form submit called');
    if ('new_post' === $form['post_id']) {
        add_filter('acf/pre_save_post', 'my_acf_pre_save_post', 10, 1);
    }
}

function my_acf_pre_save_post($post_id) {
    my_log('ACF pre_save_post called');
    if ($post_id == 'new_post') {
        $post_id = wp_insert_post(array(
            'post_type' => 'vacancy',
            'post_status' => 'publish'
        ));
        my_log('New post created with ID: ' . $post_id);
    }

    return $post_id;
}

function my_acf_load_field($field) {
    // Get the saved options
    $options = get_option('my_saved_options');

    // If there are saved options, add them to the choices of the Select field
    if ($options) {
        $field['choices'] = array_merge($field['choices'], $options);
    }

    return $field;
}
add_filter('acf/load_field/name=etapi_spivbesidi', 'my_acf_load_field');

function my_acf_save_post( $post_id ) {
    // Get the new option value
    $new_option = get_field('svij_variant', $post_id);

    // Check if the new option is not empty
    if( $new_option ) {
        // Get the saved options
        $options = get_option('my_saved_options');

        // If the new option doesn't exist in the saved options, add it
        if (!in_array($new_option, $options)) {
            $options[] = $new_option;
            update_option('my_saved_options', $options);
        }
    }
}
add_action('acf/save_post', 'my_acf_save_post', 20);

function my_enqueue_scripts_vac() {
    // Генерация nonce
    $nonce = wp_create_nonce('my_ajax_nonce');

    // Регистрация скрипта
    wp_register_script('my_script_vac', get_template_directory_uri() . '/assets/js/acf-select-vac.js', array('jquery'), '1.0', true);

    // Локализация скрипта
    wp_localize_script('my_script_vac', 'my_script_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => $nonce,
    ));

    // Подключение скрипта
    wp_enqueue_script('my_script_vac');
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts_vac');

// PHP код, разместите его в файле functions.php вашей темы
add_action('wp_ajax_delete_option', 'my_delete_option');
add_action('wp_ajax_nopriv_delete_option', 'my_delete_option');

function my_delete_option() {
    check_ajax_referer('my_ajax_nonce', 'nonce');

    $option_value = $_POST['option_value'];

    // Получение сохраненных опций
    $options = get_option('my_saved_options');

    if (($key = array_search($option_value, $options)) !== false) {
        // Удаление опции из массива
        unset($options[$key]);

        // Обновление опций в базе данных
        update_option('my_saved_options', $options);

        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}

add_action('wp_ajax_update_acf_field', 'update_acf_field');

function update_acf_field() {
    $candidate_id = $_POST['candidate_id'];
    $field_name = $_POST['field_name'];
    $value = $_POST['value'];

    update_field($field_name, $value, $candidate_id);
    // Обновляем дату изменения поста
    wp_update_post(array(
        'ID' => $candidate_id,
        'post_modified' => current_time('mysql'),
        'post_modified_gmt' => current_time('mysql', 1)
    ));

    wp_die(); // необходимо для завершения работы AJAX в WordPress
}

add_action('wp_ajax_update_vacancy_custom_stages', 'update_vacancy_custom_stages');

function update_vacancy_custom_stages() {
    $vacancy_id = $_POST['vacancy_id'];
    $custom_stages = $_POST['custom_stages'];

    update_field('custom_stages', $custom_stages, $vacancy_id);

    wp_die(); // необходимо для завершения работы AJAX в WordPress
}
add_action('wp_ajax_delete_vacancy_custom_stage', 'delete_vacancy_custom_stage');

function delete_vacancy_custom_stage() {
    $vacancy_id = $_POST['vacancy_id'];
    $stage = $_POST['stage'];

    // Получить текущее значение поля custom_stages
    $custom_stages = get_field('custom_stages', $vacancy_id);
    $custom_stages_array = $custom_stages ? explode(',', $custom_stages) : [];

    // Удалить стадию из массива
    $updated_stages_array = array_diff($custom_stages_array, array($stage));

    // Обновить значение поля custom_stages
    $updated_stages = implode(',', $updated_stages_array);
    update_field('custom_stages', $updated_stages, $vacancy_id);

    wp_die(); // необходимо для завершения работы AJAX в WordPress
}


//add_action('wp_ajax_update_acf_field', 'my_update_acf_field');
//add_action('wp_ajax_nopriv_update_acf_field', 'my_update_acf_field');
//
//function my_update_acf_field() {
//    $candidate_id = $_POST['candidate_id'];
//    $field_name = $_POST['field_name'];
//    $sub_field_name = $_POST['sub_field_name'];
//    $value = json_decode(stripslashes($_POST['value']), true);
//
//    // Удалить все текущие строки из поля-повторителя
//    delete_field($field_name, $candidate_id);
//
//    // Добавить каждую стадию в поле-повторитель
//    foreach ($value as $stage) {
//        add_row($field_name, array($sub_field_name => $stage), $candidate_id);
//    }
//
//    wp_send_json_success();
////
////    echo 'ACF field updated.';
////    wp_die();
//}

add_action('wp_ajax_load_stages', 'load_stages');
add_action('wp_ajax_nopriv_load_stages', 'load_stages');

function load_stages() {
    $vacancy_id = $_POST['vacancy_id'];
    $labels = array();
    $field_name = "etapi_spivbesidi";
    $values = get_field($field_name, $vacancy_id);
    $field = get_field_object($field_name, $vacancy_id);

    if($values) {
        foreach( $values as $value ){
            echo '<option value="'.esc_attr($value).'">'.$labels[] = $field['choices'][ $value ].'</option>';
        }
    }

    wp_die();
}

add_action('wp_ajax_load_stages2', 'load_stages2');
add_action('wp_ajax_nopriv_load_stages2', 'load_stages2');

function load_stages2() {
    $vacancy_id = $_POST['vacancy_id'];
    $labels = array();
    $field_name = "etapi_spivbesidi";
    $values = get_field($field_name, $vacancy_id);
    $field = get_field_object($field_name, $vacancy_id);

    if($values) {
        foreach( $values as $value ){
            echo '<option value="'.esc_attr($value).'">'.$labels[] = $field['choices'][ $value ].'</option>';
        }
    }

    wp_die();
}
/////////////////////////////////////////////////// Filters //////////////////////////////////////////////////////////////////////////
///

function render_post($post) {
    // Get the post data
    $post_id = $post->ID;
    $post_permalink = get_permalink($post_id);

    // For ACF fields
    $imya = get_field('imya', $post_id);
    $familiya = get_field('familiya', $post_id);
    $pdf_parsed = get_field('pdf_parsed', $post_id);
    $dataStart0 = get_field('dataStart0', $post_id);
    $telegram = get_field('telegram', $post_id);
    $email_r = get_field('email_r', $post_id);
    $engl_r = get_field('engl_r', $post_id);
    $region = get_field('region', $post_id);
    $zarplata = get_field('zarplata', $post_id);
    $status_r = get_field('status_r', $post_id);
    $exp_r = get_field('exp_r', $post_id);
    $linkedin = get_field('linkedin', $post_id);
    $skype_r = get_field('skype_r', $post_id);
    $viber_r = get_field('viber_r', $post_id);
    $tel_r = get_field('tel_r', $post_id);
    $prichina_bl = get_field('prichina_bl', $post_id);
    $povnij_opis_chs = get_field('povnij_opis_chs', $post_id);
    $resume_docx = get_field('resume_docx', $post_id);
    $field_61c9624e3d8fc = get_field('field_61c9624e3d8fc', $post_id);

    $spec1_values = get_field('spec1', $post_id);
    $spec1_titles = array();
    foreach ($spec1_values as $s1) {
        $spec1_titles[] = $s1->post_title;
    }
    $spec1_string = implode(', ', $spec1_titles);

    $spec4_values = get_field('spec4', $post_id);
    $spec4_titles = array();
    foreach ($spec4_values as $s4) {
        $spec4_titles[] = $s4->post_title;
    }
    $spec4_string = implode(', ', $spec4_titles);
    // For the 'data-work_format' field
    $work_format_values = get_field('tip_raboty', $post_id);
    $work_format_titles = array();
    foreach ($work_format_values as $wf) {
        $work_format_titles[] = $wf->post_title;
    }
    $work_format_string = implode(', ', $work_format_titles);
    // For the 'data-country' field
    $city_values = get_field('city_r', $post_id);
    $city_titles = array();
    foreach ($city_values as $c) {
        $city_titles[] = $c->post_title;
    }
    $city_string = implode(', ', $city_titles);

    // For the 'data-compn' field
    $company_values = get_field('komp_last', $post_id);
    $company_titles = array();
    if ($company_values) {
        foreach ($company_values as $comp) {
            $company_titles[] = $comp->post_title;
        }
    }
    $company_string = implode(', ', $company_titles);
    // For the 'data-cont' and 'data-contval' fields
    $contact_fields = array('email_r', 'skype_r', 'telegram', 'viber_r', 'linkedin');
    $contact_labels = array();
    $contact_values = array();
    foreach ($contact_fields as $field) {
        $field_value = get_field($field, $post_id);
        if ($field_value) {
            $contact_labels[] = ucfirst($field);
            $contact_values[] = $field_value;
        }
    }
    $contact_labels_string = implode(', ', $contact_labels);
    $contact_values_string = implode(', ', $contact_values);

    // For the 'data-cont' and 'data-contval' fields
    $contact_fields = array('email_r', 'skype_r', 'telegram', 'viber_r', 'linkedin');
    $contact_labels = array();
    $contact_values = array();
    foreach ($contact_fields as $field) {
        $field_value = get_field($field, $post_id);
        if ($field_value) {
            $contact_labels[] = ucfirst($field);
            $contact_values[] = $field_value;
        }
    }
    $contact_labels_string = implode(', ', $contact_labels);
    $contact_values_string = implode(', ', $contact_values);

    // Generate the HTML
    $html = "
        <div class='myCandW mcd kandItem1 baza' data-pdf='{$pdf_parsed}' data-timer='{$dataStart0}' data-name1='{$imya}' data-bl='" . ($prichina_bl ? 'blacklist' : '') . "' data-pipe='public' data-id='{$post_id}' data-fam1='{$familiya}' data-tel1='{$telegram}' data-ema1='{$email_r}' data-spec1='{$spec1_string}' data-spec4='{$spec4_string}' data-angl='{$engl_r}' data-reg1='{$region}' data-cont='{$contact_labels_string}' data-contval='{$contact_values_string}' data-work_format='{$work_format_string}' data-zar='{$zarplata}' data-country='{$city_string}' data-stat1='{$status_r}' data-oput='{$exp_r}' data-compn='{$company_string}' data-timedb='{$dataStart0}'>
        <div class='bk_time'>
            <p>{$field_61c9624e3d8fc}</p>
        </div>
        <div class='mcName'>
            <div class='bk_name'>
                <a href='{$post_permalink}'>
                    <p>{$imya} {$familiya}</p>
                </a>
            </div>
        </div>

        <div class='bk_mid1'>
            <div class='bk_country'>{$city_string}</div>
        </div>
        <div class='bk_mid1'>
            <div class='bk_zp'>
                <span class='spec1'>ЗП {$zarplata}</span>
            </div>
        </div>

        <div class='bk_mid2'>
            <div class='bk_angl'>
                <p class='spec1'>Англ: {$engl_r}</p>
            </div>
        </div>

        <div class='bk_mid2 cont_wrapper'>
            <div class='bk_cont'>";

    if ($linkedin) {
        $html .= "<a href='https://www.linkedin.com/in/{$linkedin}' class='spec1 cp_btn bk_linkedin' id='bk_linkedin'><span>{$linkedin}</span></a>";
    }
    if ($telegram) {
        $html .= "<a href='tg://resolve?domain={$telegram}' class='spec1 cp_btn bk_telegram' id='bk_telegram'><span>{$telegram}</span></a>";
    }
    if ($skype_r) {
        $html .= "<a href='skype:{$skype_r}?chat' class='spec1 cp_btn bk_skype' id='bk_skype' target='_blank'><span>{$skype_r}</span></a>";
    }
    if ($viber_r) {
        $html .= "<a href='viber://chat?number={$viber_r}' class='spec1 cp_btn bk_viber' id='bk_viber' target='_blank'><span>{$viber_r}</span></a>";
    }
    if ($email_r) {
        $html .= "<a href='mailto:{$email_r}' class='spec1 cp_btn bk_email' id='bk_email'><span>{$email_r}</span></a>";
    }
    if ($tel_r) {
        $html .= "<a href='tel:{$tel_r}' class='spec1 cp_btn bk_phone' id='bk_phone'><span>{$tel_r}</span></a>";
    }

    $html .= "
            </div>
        </div>
        <div class='bk_end'>
            <div class='bk_cv'>
                <a href='javascript:void(0);' class='modalCv' id='modal-launcher'>CV</a>
                <div id='modal-background'></div>
                <div id='modal-content'>
                    <button id='modal-close'>✖</button>";

    $resume_id = get_field('resume_r', $post_id);
    if ($resume_id) {
        $resume_url = wp_get_attachment_url($resume_id);
        $html .= "<embed src='{$resume_url}' frameborder='0' width='100%' height='700px'>";
    }

    if ($prichina_bl) {
        $html .= "
                <button class='lb-bl bkpage' id='open-popup'>В чорному списку!!!</button>
                <div id='popup' class='popup'>
                    <div id='popup-content'>
                        <p>{$povnij_opis_chs}</p>
                    </div>
                </div>";
    }

    if ($resume_docx) {
        $docx_url = wp_get_attachment_url($resume_docx);
        $html .= "<a href='{$docx_url}' class='dnl_btn' download>Завантажити у форматі .docx</a>";
    }

    $html .= "
                </div>
            </div>
        </div>
        <div class='bk_end'>
            <button type='button' class='getToVac'>Взяти на вакансію</button>
            <button class='favorite-star' data-candidate-id='{$post_id}'>
                ☆
            </button>
        </div>
    </div>";

    return $html;
}

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

function filter_posts($post)
{
    $posts_per_page = 6;
    $loaded_posts = 0;
    $offset = 0;

    while ($loaded_posts < $posts_per_page) {
        $args = array(
            'post_type' => array('candidate', 'rekomend'),
            'posts_per_page' => $posts_per_page - $loaded_posts,
            'offset' => $offset,
        );

        // Filter by oput
        if (isset($_POST['oput'])) {
            $args['meta_query'][] = [
                'key' => 'oput',
                'value' => $_POST['oput'],
                'compare' => '>=',
                'type' => 'NUMERIC',
            ];
        }

        // Filter by spec1Values
        if (isset($_POST['spec1'])) {
            foreach ($_POST['spec1'] as $spec1Value) {
                $args['meta_query'][] = [
                    'key' => 'spec1',
                    'value' => $spec1Value,
                    'compare' => 'LIKE',
                ];
            }
        }

        // Filter by zarpl
        if (isset($_POST['zarpl']) && isset($_POST['zarpl_to'])) {
            $args['meta_query'][] = [
                'key' => 'zar',
                'value' => array($_POST['zarpl'], $_POST['zarpl_to']),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC',
            ];
        }

        // Filter by workFormats
        if (isset($_POST['workFormats'])) {
            foreach ($_POST['workFormats'] as $workFormat) {
                $args['meta_query'][] = [
                    'key' => 'work_format',
                    'value' => $workFormat,
                    'compare' => 'LIKE',
                ];
            }
        }

        // Filter by englishLevels
        if (isset($_POST['englishLevels'])) {
            foreach ($_POST['englishLevels'] as $englishLevel) {
                $args['meta_query'][] = [
                    'key' => 'angl',
                    'value' => $englishLevel,
                    'compare' => 'LIKE',
                ];
            }
        }

        // Filter by datacontact
        if (isset($_POST['datacontact'])) {
            foreach ($_POST['datacontact'] as $datacontact) {
                $args['meta_query'][] = [
                    'key' => 'cont',
                    'value' => $datacontact,
                    'compare' => 'LIKE',
                ];
            }
        }

        // Filter by regCountry
        if (isset($_POST['regCountry'])) {
            $args['meta_query'][] = [
                'key' => 'country',
                'value' => $_POST['regCountry'],
                'compare' => 'LIKE',
            ];
        }

        $recomendData = new WP_Query($args);

        $posts = array();
        if ($recomendData->have_posts()) {
            while ($recomendData->have_posts() && $loaded_posts < $posts_per_page) {
                $recomendData->the_post();
                $posts[] = render_post($post);
                $loaded_posts++;
                $offset += $posts_per_page - $loaded_posts;
            }
        } else {
            break;
        }


    }

    if ($loaded_posts == 0) {
        $response = array('message' => 'No more posts found');
    } else {
        $response = array('posts' => $posts);
    }

    echo json_encode($response);
    wp_die();
}

//add_action('wp_ajax_filter_posts', 'filter_posts');
//add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');
//
//function filter_posts($post) {
//    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
//    $args = array(
//        'post_type' => array('candidate', 'rekomend'),
//        'posts_per_page' => 6,
//        'paged' => $page,
//    );
//
//    // Filter by oput
//    if (isset($_POST['oput'])) {
//        $args['meta_query'][] = [
//            'key' => 'oput',
//            'value' => $_POST['oput'],
//            'compare' => '>=',
//            'type' => 'NUMERIC',
//        ];
//    }
//
//    // Filter by spec1Values
//    if (isset($_POST['spec1'])) {
//        foreach ($_POST['spec1'] as $spec1Value) {
//            $args['meta_query'][] = [
//                'key' => 'spec1',
//                'value' => $spec1Value,
//                'compare' => 'LIKE',
//            ];
//        }
//    }
//
//    // Filter by zarpl
//    if (isset($_POST['zarpl']) && isset($_POST['zarpl_to'])) {
//        $args['meta_query'][] = [
//            'key' => 'zar',
//            'value' => array($_POST['zarpl'], $_POST['zarpl_to']),
//            'compare' => 'BETWEEN',
//            'type' => 'NUMERIC',
//        ];
//    }
//
//    // Filter by workFormats
//    if (isset($_POST['workFormats'])) {
//        foreach ($_POST['workFormats'] as $workFormat) {
//            $args['meta_query'][] = [
//                'key' => 'work_format',
//                'value' => $workFormat,
//                'compare' => 'LIKE',
//            ];
//        }
//    }
//
//    // Filter by englishLevels
//    if (isset($_POST['englishLevels'])) {
//        foreach ($_POST['englishLevels'] as $englishLevel) {
//            $args['meta_query'][] = [
//                'key' => 'angl',
//                'value' => $englishLevel,
//                'compare' => 'LIKE',
//            ];
//        }
//    }
//
//    // Filter by datacontact
//    if (isset($_POST['datacontact'])) {
//        foreach ($_POST['datacontact'] as $datacontact) {
//            $args['meta_query'][] = [
//                'key' => 'cont',
//                'value' => $datacontact,
//                'compare' => 'LIKE',
//            ];
//        }
//    }
//
//    // Filter by regCountry
//    if (isset($_POST['regCountry'])) {
//        $args['meta_query'][] = [
//            'key' => 'country',
//            'value' => $_POST['regCountry'],
//            'compare' => 'LIKE',
//        ];
//    }
//
//    $recomendData = new WP_Query($args);
//
//    $posts = array();
//    if ($recomendData->have_posts()) {
//        while ($recomendData->have_posts()) {
//            $recomendData->the_post();
//            $posts[] = render_post($post);
//        }
//    }
//
//    $response = array(
//        'posts' => $posts,
//        'currentPage' => intval($page),
//        'maxPages' => $recomendData->max_num_pages
//    );
//
//    echo json_encode($response);
//    wp_die();
//}


















//function load_more($post) {
//    $page = intval($_POST['page']);  // получаем номер страницы из AJAX запроса
//    $filter = $_POST['filter'];  // получаем данные фильтра из AJAX запроса
//
//    $args = array(
//        'post_type' => array('candidate', 'rekomend'),
//        'posts_per_page' => 2,
//        'paged' => $page,
//    );
//
//    // Filter by oput
//    if (isset($filter['oput'])) {
//        $args['meta_query'][] = [
//            'key' => 'oput',
//            'value' => $filter['oput'],
//            'compare' => '>=',
//            'type' => 'NUMERIC',
//        ];
//    }
//
//    // Filter by spec1Values
//    if (isset($filter['spec1'])) {
//        foreach ($filter['spec1'] as $spec1Value) {
//            $args['meta_query'][] = [
//                'key' => 'spec1',
//                'value' => $spec1Value,
//                'compare' => 'LIKE',
//            ];
//        }
//    }
//
//    // Filter by zarpl
//    if (isset($filter['zarpl']) && isset($filter['zarpl_to'])) {
//        $args['meta_query'][] = [
//            'key' => 'zar',
//            'value' => array($filter['zarpl'], $filter['zarpl_to']),
//            'compare' => 'BETWEEN',
//            'type' => 'NUMERIC',
//        ];
//    }
//
//    // Filter by workFormats
//    if (isset($filter['workFormats'])) {
//        foreach ($filter['workFormats'] as $workFormat) {
//            $args['meta_query'][] = [
//                'key' => 'work_format',
//                'value' => $workFormat,
//                'compare' => 'LIKE',
//            ];
//        }
//    }
//
//    // Filter by englishLevels
//    if (isset($filter['englishLevels'])) {
//        foreach ($filter['englishLevels'] as $englishLevel) {
//            $args['meta_query'][] = [
//                'key' => 'angl',
//                'value' => $englishLevel,
//                'compare' => 'LIKE',
//            ];
//        }
//    }
//
//    // Filter by datacontact
//    if (isset($filter['datacontact'])) {
//        foreach ($filter['datacontact'] as $datacontact) {
//            $args['meta_query'][] = [
//                'key' => 'cont',
//                'value' => $datacontact,
//                'compare' => 'LIKE',
//            ];
//        }
//    }
//
//    // Filter by regCountry
//    if (isset($filter['regCountry'])) {
//        $args['meta_query'][] = [
//            'key' => 'country',
//            'value' => $filter['regCountry'],
//            'compare' => 'LIKE',
//        ];
//    }
//
//    $query = new WP_Query($args);
//
//    $posts = array();
//    if ($query->have_posts()) {
//        while ($query->have_posts()) {
//            $query->the_post();
//            $posts[] = render_post($post);
//        }
//    }
//
//    echo json_encode($posts);
//    wp_die();
//}
//
//// добавляем действие на AJAX запрос
//add_action('wp_ajax_load_more', 'load_more');
//add_action('wp_ajax_nopriv_load_more', 'load_more');
