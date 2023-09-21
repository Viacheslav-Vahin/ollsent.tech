<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
global $wpdb;

$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . 'subscriptions';

// Перевірка на наявність таблиці
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL,
        subscription_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        status varchar(55) DEFAULT 'active' NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta($sql);
}

require get_template_directory() . '/functions/liqPay.php'; # liqPay

function liqpay_shortcode($atts) {
    //        $publicKey = get_option('liqpay_public_key');
//        $privateKey = get_option('liqpay_private_key');
    $publicKey = 'sandbox_i20264170366';
    $privateKey = 'sandbox_8qAwO0zTV4B5uz0uKoOXlZBVgqNpfysENt4vdxXV';
    $liqPay = new LiqPay($publicKey, $privateKey);

    $params = [
        'action' => 'subscribe',
        'version' => 3,
        'amount' => 1,
        'currency' => 'UAH',
        'description' => 'Підписка на один місяць',
        'order_id' => 'order_id_55',
        'subscribe' => '1',
        'subscribe_date_start' => date('Y-m-d H:i:s'),
        'subscribe_periodicity' => 'month',
        'result_url' => 'https://stage.crm.ollsent.tech/rekruter',
    ];

    return $liqPay->cnb_form($params);
}
add_shortcode('liqpay', 'liqpay_shortcode');

add_action('plugins_loaded ', 'handle_liqpay_response');
function liqpay_log($message) {
    error_log("[LiqPay]: " . $message);
}
function handle_liqpay_response() {
    liqpay_log("Функція handle_liqpay_response була викликана");
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'], $_POST['signature'])) {
//        $publicKey = get_option('liqpay_public_key');
//        $privateKey = get_option('liqpay_private_key');
        $publicKey = 'sandbox_i20264170366';
        $privateKey = 'sandbox_8qAwO0zTV4B5uz0uKoOXlZBVgqNpfysENt4vdxXV';
        $liqpay = new LiqPay($publicKey, $privateKey);
        $data = $_POST['data'];
        $signature = $_POST['signature'];

        liqpay_log("data: " . $data);
        $decoded_data = $liqpay->decode_params($data);
        liqpay_log("Decoded data: " . json_encode($decoded_data));
        liqpay_log("Received signature: " . $signature);
        liqpay_log("Expected signature: " . $liqpay->cnb_signature(['data' => $data]));
        if ($liqpay->cnb_signature(['data' => $data]) === $signature) {
            liqpay_log("Декодовані дані від LiqPay: ");
            $decoded_data = $liqpay->decode_params($data);
//            $user_email = $decoded_data['email'];
            $user_email = $decoded_data['email'] ?? null;
            if (!$user_email) {
                $current_user = wp_get_current_user();
                if ($current_user->exists()) {
                    $user_email = "fotockua@gmail.com";
                } else {
                    $user_email = "fotockua@gmail.com";
                    liqpay_log("Користувач не авторизований, email відсутній");
                }
            }
            function send_success_email($user_email) {
                wp_mail($user_email, 'Подписка активирована!', 'Спасибо за вашу подписку!');
            }
            liqpay_log("user_email " . $user_email);
            liqpay_log("decoded_data[status] " . $decoded_data['status']);
            if ($decoded_data['status'] === 'subscribed') {
                liqpay_log("Оплата прошла успешно для пользователя " . $user_email);

                if (email_exists($user_email)) {
                    // Пользователь уже существует, обновляем информацию или продлеваем подписку
                    $user_id = email_exists($user_email);
                    global $wpdb;
                    if ($user_id) {
                        // Пользователь уже существует
                        liqpay_log("Пользователь с email {$user_email} уже существует с ID {$user_id}. Обновляем информацию о подписке.");
                        // Обновляем или добавляем информацию о подписке в таблицу subscriptions
                        $table_name = $wpdb->prefix . 'subscriptions';
                        // Проверяем, есть ли уже запись о подписке для этого пользователя
                        $existing_subscription = $wpdb->get_row($wpdb->prepare(
                            "SELECT * FROM {$table_name} WHERE user_id = %d LIMIT 1",
                            $user_id
                        ));
                        if ($existing_subscription) {
                            // Подписка существует, обновляем дату
                            $updated = $wpdb->update(
                                $table_name,
                                array(
                                    'subscription_date' => current_time('mysql'),
                                    'status' => 'active'
                                ),
                                array('user_id' => $user_id),
                                array('%s', '%s'),
                                array('%d')
                            );

                            if ($updated) {
                                liqpay_log("Подписка для пользователя {$user_id} была успешно обновлена.");
                            } else {
                                liqpay_log("Ошибка при обновлении подписки для пользователя {$user_id}.");
                            }
                        } else {
                            // Подписка не существует, добавляем новую запись
                            $inserted = $wpdb->insert(
                                $table_name,
                                array(
                                    'user_id' => $user_id,
                                    'subscription_date' => current_time('mysql'),
                                    'status' => 'active'
                                ),
                                array('%d', '%s', '%s')
                            );

                            if ($inserted) {
                                liqpay_log("Подписка для пользователя {$user_id} была успешно добавлена.");
                            } else {
                                liqpay_log("Ошибка при добавлении подписки для пользователя {$user_id}.");
                            }
                        }
                    }
                } else {
                    // Создаем нового пользователя
                    $random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);
                    $user_id = wp_create_user($user_email, $random_password, $user_email);

                    // Установите роль "subscriber" или любую другую
                    $user = new WP_User($user_id);
                    $user->set_role('subscriber');

                    // Отправьте письмо пользователю с данными для входа
                    wp_mail($user_email, 'Добро пожаловать!', 'Ваши данные для входа: ' . $random_password);
                }
            } elseif ($decoded_data['status'] === 'failure') {
                liqpay_log("Ошибка оплаты для пользователя " . $user_email);
            } elseif ($decoded_data['status'] === 'sandbox') {
                // Обработка песочницы
                liqpay_log("Sandbox payment detected for $user_email");
            } else {
                liqpay_log("Неизвестный статус оплаты для пользователя " . $user_email);
            }
        } else {
            liqpay_log("Подпись не совпадает, что-то пошло не так");
        }
        wp_redirect(home_url('/rekruter'));
        exit;
    }
}
function update_liqpay_subscription($order_id, $amount, $currency, $description) {
    // Ваші ключі для LiqPay
    $publicKey = 'sandbox_i20264170366';
    $privateKey = 'sandbox_8qAwO0zTV4B5uz0uKoOXlZBVgqNpfysENt4vdxXV';

    $liqpay = new LiqPay($publicKey, $privateKey);

    // Виклик API для зміни підписки
    $response = $liqpay->api("request", array(
        'action'      => 'subscribe_update',
        'version'     => '3',
        'order_id'    => $order_id,
        'amount'      => $amount,
        'currency'    => $currency,
        'description' => $description
    ));

    // Логування відповіді
    liqpay_log("Зміна підписки для order_id {$order_id}: " . json_encode($response));

    // Перевірка статусу відповіді
    if (isset($response['status']) && $response['status'] === 'subscribed') {
        liqpay_log("Підписка для order_id {$order_id} успішно змінена.");
        return true;
    } else {
        liqpay_log("Помилка при зміні підписки для order_id {$order_id}.");
        return false;
    }
}

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
    wp_enqueue_style('slick_css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), false, 'all');

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
        wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', false);
        wp_enqueue_script('js_pdf', 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js', array('jquery'), '', false);
        wp_enqueue_script('js_word','https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.0/mammoth.browser.min.js', array('jquery'), '', false);
        wp_enqueue_script('jspdf','https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js', array('jquery'), '', false);
        wp_enqueue_script('js_htmlcanvas','https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js', array('jquery'), '', false);
        wp_enqueue_script('js_cust2', get_template_directory_uri() . '/assets/js/rekruter.js', array('jquery'), '', false);
//        wp_enqueue_script('anime', get_template_directory_uri() . '/assets/js/anime-master/lib/anime.min.js', array('jquery'), '', false);

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
// Срабатывает при входе пользователя в систему
add_action('wp_login', 'record_last_login', 10, 2);

function record_last_login($user_login, $user) {
    update_user_meta($user->ID, 'last_login', current_time('mysql'));
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

function custom_password_reset_form() {
    $output = '
    <form method="post">
        <h3>Забули пароль?</h3>
        <p>Введіть адесу електронної пошти</p>
        <p><input type="text" name="reset_email" value="" /></p>
        <p><input type="submit" name="reset_password" value="Скинути пароль" /></p>
    </form>';
    return $output;
}
add_shortcode('custom_password_reset', 'custom_password_reset_form');

function custom_password_reset() {
    if (isset($_POST['reset_password'])) {
        $user_data = get_user_by('email', trim($_POST['reset_email']));
        if (empty($user_data)) {
            echo 'Пользователь с этим адресом электронной почты не найден.';
            return;
        }

        // Генерация и отправка нового пароля
        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;

        // Генерация случайного пароля
        $key = wp_generate_password(20, false);

        // Добавляем ключ сброса пароля и время его генерации в базу данных
        $reset = get_option('password_reset');
        if (! $reset) $reset = array();
        $reset[$user_login] = array('key' => $key, 'time' => time());
        update_option('password_reset', $reset);

        // Создание сообщения
        $message = __('Кто-то запросил сброс пароля для следующего аккаунта:') . "\r\n\r\n";
        $message .= network_home_url('/') . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= __('Если это были вы, перейдите по следующей ссылке, чтобы установить новый пароль:') . "\r\n\r\n";
        $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";

        // Отправка сообщения
        if (is_multisite()) {
            $blogname = $GLOBALS['current_site']->site_name;
        } else {
            $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
        }

        $title = sprintf( __('[%s] Password Reset'), $blogname );

        if ( $message && !wp_mail($user_email, wp_specialchars_decode($title), $message) ) {
            echo "<p>Ошибка при отправке почты для сброса пароля.</p>";
            exit();
        } else {
            echo "<p>Проверьте свою электронную почту для дальнейших инструкций.</p>";
            exit();
        }
    }
}
add_action('init', 'custom_password_reset');

function change_password_form()
{ ?>
    <form action="" method="post">
        <div class="mpd">
            <div>
                <label for="current_password">Старий пароль:</label>
                <input class="rspsw" id="current_password" type="password" name="current_password"
                       title="current_password" placeholder="" required>
            </div>
            <div>
                <label for="new_password">Новий пароль:</label>
                <input class="rspsw" id="new_password" type="password" name="new_password" title="new_password"
                       placeholder="" required>
            </div>
            <div><label for="confirm_new_password">Підтвердіть новий пароль:</label>
                <input class="rspsw" id="confirm_new_password" type="password" name="confirm_new_password"
                       title="confirm_new_password" placeholder="" required>
            </div>
            <input type="submit" value="Оновити">
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
            echo '<h3 class="success">Пароль успішно оновлено</h3>';
        } else {
            // Echo Errors
            echo '<div class="error"><h3>Помилка:</h3>';
            foreach ($errors as $error) {
                echo '<p>';
                echo "<strong>$error</strong>";
                echo '</p></div>';
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
            'ep_integrate'   => true,
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
        'ep_integrate'   => true,
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


add_action('acf/save_post', 'save_old_values', 1);

function save_old_values($post_id) {
    if (get_post_type($post_id) != 'candidate') {
        return;
    }

    global $old_values;
    $old_values = get_fields($post_id);
}

add_action('acf/save_post', 'save_all_changes_to_additional_info', 20);

function save_old_field_values($post_id) {
    if (get_post_type($post_id) != 'candidate') {
        return;
    }

    $old_values = get_fields($post_id);
    update_post_meta($post_id, '_old_field_values', $old_values);
}

add_action('acf/save_post', 'save_old_field_values', 1);

function save_all_changes_to_additional_info($post_id) {
    if (get_post_type($post_id) != 'candidate') {
        return;
    }

    $old_values = get_post_meta($post_id, '_old_field_values', true);
    $new_values = get_fields($post_id);
    update_post_meta($post_id, '_old_field_values', $new_values);  // Update the old values for the next time.

    $changes = array();

    foreach ($old_values as $field_key => $old_value) {
        $new_value = isset($new_values[$field_key]) ? $new_values[$field_key] : null;

        if ($old_value != $new_value) {
            $field_object = get_field_object($field_key, $post_id);
            $field_label = $field_object['label'];

            // Convert value to label if choices array exists
            if (!empty($field_object['choices'])) {
                $old_value = isset($field_object['choices'][$old_value]) ? $field_object['choices'][$old_value] : $old_value;
                $new_value = isset($field_object['choices'][$new_value]) ? $field_object['choices'][$new_value] : $new_value;
            }

            $old_value_str = is_array($old_value) ? array_to_string($old_value) : $old_value;
            $new_value_str = is_array($new_value) ? array_to_string($new_value) : $new_value;

            $changes[] = '</br><em>' . current_time('Y-m-d H:i:s') . " - </em> <strong>Оновлено поле:</strong> $field_label з <strong>$old_value_str</strong> на <strong>$new_value_str</strong>";
        }
    }


    if (!empty($changes)) {
        $old_additional_info = get_post_meta($post_id, 'additional_info', true);
        $new_changes = implode($changes);
        $additional_info = !empty($old_additional_info) ? $old_additional_info . $new_changes : $new_changes;
        update_post_meta($post_id, 'additional_info', $additional_info);
    }
}

add_action('acf/save_post', 'save_all_changes_to_additional_info', 20);

function array_to_string($array) {
    $string_array = array();

    foreach ($array as $element) {
        if (is_object($element) && get_class($element) == 'WP_Post') {
            $string_array[] = $element->post_title;
        } else {
            $string_array[] = (string) $element;
        }
    }

    return implode(', ', $string_array);
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

        // Оновлюємо значення поля "additional_info" для поточного запису
        $field_key = 'additional_info';
        update_field($field_key, $new_info, $post_id);
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
        $prichina_vydalennya = sanitize_text_field($_POST['prichina_vydalennya']);

        $current_date_time = current_time('mysql');
        $current_user = wp_get_current_user();
        $hto_vydalyv = $current_user->first_name . ' ' . $current_user->last_name;

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
    $libreoffice_path = "/usr/bin/libreoffice";
//    $libreoffice_path = "C:\Program Files\LibreOffice\program\soffice.exe";
    $cmd = "\"{$libreoffice_path}\" --headless --infilter=\"writer_pdf_import\" --convert-to doc --outdir \"" . pathinfo($docxPath, PATHINFO_DIRNAME) . "\" \"{$pdfPath}\"";
    $return_var = 0;
    system($cmd, $return_var);
    if ($return_var == 0) {
        error_log("Конвертация PDF в DOCX прошла успешно.");
    } else {
        error_log("Ошибка конвертации PDF в DOCX. Код возврата: " . $return_var);
    }
}
function convertDocxToPdf($docxPath, $pdfPath) {
    error_log("Функція convertDocxToPdf запущена");
    $libreoffice_executable = "/usr/bin/libreoffice";
//    $libreoffice_executable = 'C:\Program Files\LibreOffice\program\soffice.exe';
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
    $file_id = get_field('field_60d4627f9684e', $post_id);
    $file_path = '';
    if ($file_id) {
        $file_path = get_attached_file($file_id);
        error_log("Файл file_path:" . $file_path);
    } else {
        error_log("Файл не найден");
    }
    if (isset($_FILES['acf']['name']['field_60d4627f9684e']) || $_FILES['acf']['name']['field_60d4627f9684e'] != '' || $file_path) {
        $uploadedFileName = '';
        if($_FILES['acf']['tmp_name']['field_60d4627f9684e']){
            $uploadedFilePath = $_FILES['acf']['tmp_name']['field_60d4627f9684e'];
            $uploadedFileName = $_FILES['acf']['name']['field_60d4627f9684e'];
            error_log("Файл uploadedFileName" . $uploadedFileName);
        } else {
            $uploadedFileName = basename($file_path);
            error_log("Файл uploadedFileNameACF" . $uploadedFileName);
        }

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
function convert_resume_field_to_pdf_api($post, $request, $update) {
    $post_id = $post->ID;
    error_log("convert_resume_field_to_pdf_api post_id: " . $post_id);
    convert_resume_field_to_pdf($post_id);

    do_action('after_convert_resume', $post_id, $post, $update);
}

function makeStarship($post_id, $post, $update) {
    $html = get_field('code_cv', $post_id);
    if (empty($html)) {
        return;
    }
    $dompdf = new \Dompdf\Dompdf();
    $html = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><style>*{ font-family: DejaVu Sans !important;}</style></head><body>' . $html . '</body></html>';
    error_log("html: " . $html);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $upload_dir = wp_upload_dir();
    $pdf_file_name = uniqid('cv_pdf_') . '.pdf';
    $pdf_file_path = $upload_dir['path'] . '/' . $pdf_file_name;
    file_put_contents($pdf_file_path, $dompdf->output());
    $pdf_file_path = insert_pdf_attachment($pdf_file_path, $post_id, $pdf_file_name);
    $updated_post = array(
        'ID' => $post_id,
        'meta_input' => array(
            'resume_r' => $pdf_file_path,
        )
    );
    wp_update_post($updated_post);
}
add_action('after_convert_resume', 'makeStarship', 20, 3);

remove_action('acf/save_post', 'convert_resume_field_to_pdf', 20);
remove_action('rest_insert_candidate', 'convert_resume_field_to_pdf_api', 20);

add_action('acf/save_post', 'convert_resume_field_to_pdf', 20);
add_action('rest_insert_candidate', 'convert_resume_field_to_pdf_api', 20, 3);

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

add_action('rest_insert_candidate', 'save_initial_field_values', 10, 3);

function save_initial_field_values($post, $request, $creating) {
    $post_id = $post->ID;
    $request_id = isset($request['id']) ? intval($request['id']) : null;

    if ($post_id != $request_id) {
        $creating = true;
    } else {
        $creating = false;
    }

    if ($creating) {
        $new_values = get_fields($post_id);
        $changes = array();

        foreach ($new_values as $field_key => $new_value) {
            $field_object = get_field_object($field_key, $post_id);
            $field_label = $field_object['label'];

            // Convert value to label if choices array exists
            if (!empty($field_object['choices'])) {
                $new_value = isset($field_object['choices'][$new_value]) ? $field_object['choices'][$new_value] : $new_value;
            }

            $new_value_str = is_array($new_value) ? array_to_string($new_value) : $new_value;

            $changes[] = '</br><em>' . current_time('Y-m-d H:i:s') . " - </em> <strong>Добавлено поле:</strong> $field_label <strong>$new_value_str</strong>";
        }

        if (!empty($changes)) {
            $old_additional_info = get_post_meta($post_id, 'additional_info', true);
            $new_changes = implode($changes);
            $additional_info = !empty($old_additional_info) ? $old_additional_info . $new_changes : $new_changes;
            update_post_meta($post_id, 'additional_info', $additional_info);
        }
    }
}

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

        update_field('field_64522925800fa', $client_id, $post_id);
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
/////////////////////////////////         Create table blocks             /////////////////////////////////////////////
function create_blocks_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'blocks';

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            block_id mediumint(9) NOT NULL,
            title text NOT NULL,
            post_type varchar(255) NOT NULL,  -- Добавлено поле post_type
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
add_action('after_setup_theme', 'create_blocks_table');


//////////////////////              get blocks from db             //////////////////////////////////////////////////
function get_blocks_from_db() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'blocks';

    $results = $wpdb->get_results("SELECT * FROM $table_name");

    // Если блоки найдены
    if ($results) {
        // Возвращаем блоки
        wp_send_json_success($results);
    } else {
        wp_send_json_error('Не найдено блоков.');
    }
}
add_action('wp_ajax_get_blocks', 'get_blocks_from_db');
add_action('wp_ajax_nopriv_get_blocks', 'get_blocks_from_db');


//////////////////              Функция для получения блоков из базы данных             /////////////////////////////
add_action('wp_ajax_save_block', 'save_block');
add_action('wp_ajax_nopriv_save_block', 'save_block');
function save_block() {
    global $wpdb;

    // Проверяем наличие block_id и title в запросе
    if (!isset($_POST['block_id']) || !isset($_POST['title']) || !isset($_POST['post_type'])) {
        wp_send_json_error('Відсутній block_id, post_type, title у запиті.');
        return;
    }

    // Получаем block_id и title из запроса
    $block_id = intval($_POST['block_id']);
    $title = sanitize_text_field($_POST['title']);
    $post_type = sanitize_text_field($_POST['post_type']);

    // Сохраняем блок в базе данных
    $wpdb->insert(
        $wpdb->prefix . 'blocks',
        array(
            'ep_integrate'   => true,
            'block_id' => $block_id,
            'title' => $title,
            'post_type' => $post_type,
        ),
        array(
            '%d',
            '%s',
            '%s',
        )
    );

    wp_send_json_success();
}
/// //////////////////////////////              Add new block to the filter             //////////////////////////////
// Регистрируем AJAX действие
add_action('wp_ajax_get_posts_for_block', 'get_posts_for_block');
add_action('wp_ajax_nopriv_get_posts_for_block', 'get_posts_for_block');
// Функция обработки AJAX запроса
function get_posts_for_block() {
    // Проверяем наличие block_id в запросе
    if (!isset($_POST['block_id'])) {
        wp_send_json_error('Відсутній block_id у запиті.');
        return;
    }
    if (!isset($_POST['post_type'])) {
        wp_send_json_error('Відсутній post_type у запиті.');
        return;
    }

    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';

    // Получаем block_id из запроса
    $block_id = intval($_POST['block_id']);

    // Получаем посты для этого block_id
    // Проверяем, на какой кнопке было совершено действие
    if ($post_type === 'language') {
        // Здесь используется тип постов 'language'
        $args = array(
            'ep_integrate'   => true,
            'post_type' => 'language',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'block_id',
                    'value' => $block_id,
                    'compare' => '='
                )
            ),
            'suppress_filters' => true
        );
    } elseif ($post_type === 'noitposts') {
        // Здесь используется тип постов 'noitposts'
        $args = array(
            'ep_integrate'   => true,
            'post_type' => 'noitposts',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'block_id',
                    'value' => $block_id,
                    'compare' => '='
                )
            ),
            'suppress_filters' => true
        );
    } else {
        // Если тип постов не указан, возвращаем ошибку
        wp_send_json_error('Неверно указан тип постов.');
        return;
    }
    $query = new WP_Query($args);

    // Начинаем буферизацию вывода
    ob_start();

    // Если посты найдены
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $delete_nonce = wp_create_nonce('delete_post_' . get_the_ID());
            ?>
            <label class="chbwr">
                <input type="checkbox" class="spec1-checkbox hidden-checkbox" value="<?php the_title(); ?>" maxlength="32">
                <span class="chbwr-text"><?php the_title(); ?></span>
                <button class="delete-post-button" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo $delete_nonce; ?>" data-metakey="spec1">×</button>
            </label>
            <?php
        }
    }

    // Всегда выводим форму для добавления новых постов
    $form_html = render_post_form($post_type, $block_id);
    $html = $form_html . ob_get_clean();

    // Отправляем ответ обратно в JavaScript
    wp_send_json_success( array( 'html' => $html ) );

    wp_reset_postdata();
}
/////////////////////////////         Рендер формы добавления позиций в фильтр             //////////////////////////
function render_post_form($post_type, $block_id, $return_html = false) {
    ob_start();
    ?>
    <form id="custom-post-form-<?php echo $post_type; ?>" class="custom-post-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
        <input type="hidden" name="action" value="create_custom_post" />
        <input type="hidden" name="post_type" value="<?php echo $post_type; ?>" />
        <input type="hidden" name="block_id" value="<?php echo $block_id; ?>" />
        <input type="text" name="post_title" required maxlength="32" placeholder="Додайте опцію фільту" />
        <input type="submit" value="Додати" />
    </form>
    <?php
    $form_html = ob_get_clean();

    if ($return_html) {
        return $form_html;
    } else {
        echo $form_html;
    }
}

///////////////////////////////           Main top buttons edit              ////////////////////////////////////////
///////////////////////////////         Create table buttons             /////////////////////////////////////////////
function create_buttons_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'buttons';

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            button_id text NOT NULL,
            text text NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
add_action('after_setup_theme', 'create_buttons_table');

//////////////////////              get buttons from db             //////////////////////////////////////////////////
function get_buttons_from_db() {
    global $wpdb;

    // Получаем данные о кнопках из базы данных
    $results = $wpdb->get_results(
        "SELECT button_id, text FROM " . $wpdb->prefix . "buttons"
    );

    if ($results) {
        // Если данные получены, возвращаем их
        wp_send_json_success($results);
    } else {
        // Если данных нет, возвращаем ошибку
        wp_send_json_error('Не вдалось отримати данні.');
    }
}
add_action('wp_ajax_get_buttons_from_db', 'get_buttons_from_db');
add_action('wp_ajax_nopriv_get_buttons_from_db', 'get_buttons_from_db');


add_action('wp_ajax_update_button_text', 'update_button_text');
add_action('wp_ajax_nopriv_update_button_text', 'update_button_text');
function update_button_text() {
    global $wpdb;

    // Проверяем наличие button_id и new_text в запросе
    if (!isset($_POST['button_id']) || !isset($_POST['new_text'])) {
        wp_send_json_error('Відсутній button_id або new_text.');
        return;
    }

    // Получаем button_id и new_text из запроса
    $button_id = sanitize_text_field($_POST['button_id']);
    $new_text = sanitize_text_field($_POST['new_text']);

    // Обновляем запись в таблице buttons
    $wpdb->update(
        $wpdb->prefix . 'buttons',
        array(
            'text' => $new_text,
        ),
        array(
            'button_id' => $button_id,
        ),
        array(
            '%s',
        ),
        array(
            '%s',
        )
    );

    wp_send_json_success();
}
//////////////////////////////           Post title edit             //////////////////////////////////////////////
//add_action('wp_ajax_update_post_title', 'update_post_title');
//add_action('wp_ajax_nopriv_update_post_title', 'update_post_title');
//function update_post_title() {
//    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
//    $new_title = isset($_POST['new_title']) ? $_POST['new_title'] : null;
//
//    if($post_id && $new_title){
//        $post_update = array(
//            'ID' => $post_id,
//            'post_title' => $new_title
//        );
//        wp_update_post( $post_update );
//    }
//    die();
//}

//add_action('wp_ajax_update_post_title', 'update_post_title');
//add_action('wp_ajax_nopriv_update_post_title', 'update_post_title');
//function update_post_title() {
//    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
//    $new_content = isset($_POST['new_content']) ? $_POST['new_content'] : null;
//    $content_id = isset($_POST['content_id']) ? $_POST['content_id'] : null;
//
//    if($post_id && $new_content && $content_id){
//        update_post_meta( $post_id, $content_id, $new_content );
//    }
//    die();
//}
add_action('wp_ajax_update_block_title', 'update_block_title');
add_action('wp_ajax_nopriv_update_block_title', 'update_block_title');
function update_block_title() {
    global $wpdb;

    // Проверяем наличие block_id и new_title в запросе
    if (!isset($_POST['block_id']) || !isset($_POST['new_title'])) {
        wp_send_json_error('Отсутствуют block_id или new_title в запросе.');
        return;
    }

    // Получаем block_id и new_title из запроса
    $block_id = intval($_POST['block_id']);
    $new_title = sanitize_text_field($_POST['new_title']);

    // Обновляем заголовок блока в базе данных
    $wpdb->update(
        $wpdb->prefix . 'blocks',
        array(
            'title' => $new_title,
        ),
        array(
            'block_id' => $block_id
        ),
        array(
            '%s',
        ),
        array(
            '%d',
        )
    );

    wp_send_json_success();
}
////////////////////////////////             Добавление поста             ///////////////////////////////////////////
add_action('wp_ajax_create_custom_post', 'create_custom_post');
add_action('wp_ajax_nopriv_create_custom_post', 'create_custom_post');
function create_custom_post() {
    $post_title = isset($_POST['post_title']) ? sanitize_text_field($_POST['post_title']) : '';
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'post';
    $block_id = isset($_POST['block_id']) ? intval($_POST['block_id']) : 0;  // Добавьте это

    $args = array(
        'ep_integrate'   => true,
        'post_type'   => $post_type,
        'post_status' => 'trash',
        'title'        => $post_title,
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        // Пост с таким именем уже существует в корзине, восстановим его
        while ($query->have_posts()) {
            $query->the_post();
            wp_untrash_post(get_the_ID());
            wp_publish_post(get_the_ID());
        }
    }
    else {
        $existing_post = get_page_by_title($post_title, OBJECT, $post_type);
        if ($existing_post !== null) {
//             Если пост с таким заголовком уже существует, отправляем ошибку
//            wp_send_json(array(
//                'error' => true,
//                'message' => 'Пост с таким названием уже существует. Пожалуйста, выберите другое название.'
//            ));
            header('Content-Type: application/json');
            echo json_encode(array(
                'error' => true,
                'message' => 'Така опція вже існує!',
            ));
            exit;
        }
        // Создаем новый пост
        $new_post = array(
            'ep_integrate'   => true,
            'post_title'    => $post_title,
            'post_status'   => 'publish',
            'post_type'     => $post_type,
        );
        $post_id = wp_insert_post($new_post);
        if ($post_id && $block_id) {
            add_post_meta($post_id, 'block_id', $block_id, true);
        }
    }

    // Перенаправление пользователя обратно на страницу формы
    header('Content-Type: application/json');
    if ($post_id !== null) {
        $nonce = wp_create_nonce('my_nonce');
        echo json_encode(array(
            'ep_integrate'   => true,
            'error' => false,
            'post_id' => $post_id,
            'post_title' => $post_title,
            'post_type' => $post_type,
            'nonce' => $nonce,
        ));
    } else {
        echo json_encode(array(
            'error' => true,
            'message' => 'Така опція вже існує!',
        ));
    }
    exit;
}
////////////////////////////            Удаление поста             /////////////////////////////////////////////////
add_action('wp_ajax_delete_custom_post', 'delete_custom_post');
function delete_custom_post() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $meta_key = isset($_POST['meta_key']) ? sanitize_text_field($_POST['meta_key']) : '';

    if(check_ajax_referer('delete_post_' . $post_id, 'nonce', false)) {
        $post_meta = get_post_meta($post_id, $meta_key, true);
        wp_trash_post($post_id);
        update_post_meta($post_id, $meta_key, $post_meta);
        echo 'success';
    } else {
        echo 'failure';
        error_log('Referer check failed for post_id: ' . $post_id . ', nonce: ' . $_POST['nonce']);  // Логирование ошибки
    }
    wp_die();
}
/////////////////////////////            Get blocs             //////////////////////////////////////////////////////
add_action('wp_ajax_get_blocks', 'get_blocks');
add_action('wp_ajax_nopriv_get_blocks', 'get_blocks');
function get_blocks() {
    global $wpdb;

    // Получаем все блоки из базы данных, включая удаленные
    $blocks = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "blocks");

    if ($blocks) {
        wp_send_json_success($blocks);
    } else {
        wp_send_json_error('Не знайдено блоків.');
    }
}
//////////////////////////             Удаление флока фильтра         ////////////////////////////////////////////////
add_action('wp_ajax_delete_block', 'delete_block');
add_action('wp_ajax_nopriv_delete_block', 'delete_block');
//function delete_block() {
//    global $wpdb;
//
//    // Проверяем наличие block_id в запросе
//    if (!isset($_POST['block_id'])) {
//        wp_send_json_error('Отсутствует block_id в запросе.');
//        return;
//    }
//
//    // Получаем block_id из запроса
//    $block_id = intval($_POST['block_id']);
//
//    // Удаляем блок из базы данных
//    $wpdb->delete(
//        $wpdb->prefix . 'blocks',
//        array(
//            'block_id' => $block_id,
//        ),
//        array(
//            '%d',
//        )
//    );
//
//    wp_send_json_success();
//}
function delete_block() {
    global $wpdb;

    if (!isset($_POST['block_id'])) {
        wp_send_json_error('Отсутствует block_id в запросе.');
        return;
    }

    $block_id = intval($_POST['block_id']);

    // Помечаем блок как удаленный вместо его удаления
    $wpdb->update(
        $wpdb->prefix . 'blocks',
        array('deleted' => 1),  // Новые данные
        array('block_id' => $block_id),  // Условия WHERE
        array('%d'),  // Формат новых данных
        array('%d')  // Формат WHERE
    );

    wp_send_json_success();
}

// Restore block
add_action('wp_ajax_restore_block', 'restore_block');
add_action('wp_ajax_nopriv_restore_block', 'restore_block');
function restore_block() {
    global $wpdb;

    if (!isset($_POST['block_id'])) {
        wp_send_json_error('Отсутствует block_id в запросе.');
        return;
    }

    $block_id = intval($_POST['block_id']);

    // Помечаем блок как восстановленный
    $wpdb->update(
        $wpdb->prefix . 'blocks',
        array('deleted' => 0),  // Новые данные
        array('block_id' => $block_id),  // Условия WHERE
        array('%d'),  // Формат новых данных
        array('%d')  // Формат WHERE
    );

    wp_send_json_success();
}

///////////////////////                  Рендер кандидата               ///////////////////////////////////////////////
function render_post($post) {
    // Get the post data
    $post_id = get_the_ID();
    $post_permalink = get_permalink($post_id);

    // For ACF fields
    $imya = get_field('imya', $post_id);
    $familiya = get_field('familiya', $post_id);
    $pdf_parsed = get_field('pdf_parsed', $post_id);
    $code_cv = get_field('code_cv', $post_id);
    $main_comment_sw = get_field('main_comment_sw', $post_id);
    $main_comment = get_field('main_comment', $post_id);
    $dataStart0 = get_field('dataStart0', $post_id);
    $telegram = get_field('telegram', $post_id);
    $photo = get_field('foto_re', $post_id);
    $email_r = get_field('email_r', $post_id);
    $fieldeng = get_field_object('engl_r', $post_id);
    $valueeng = $fieldeng['value'];
    $engl_r = $fieldeng['choices'][$valueeng];
    $region = get_field('region', $post_id);
    $zarplata = 0;
    $zarplatach = get_field('zarplata', $post_id);
    if($zarplatach) {
        $zarplata = get_field('zarplata', $post_id);
    } else {
        $zarplata = 0;
    }
    $status_r = get_field('status_r', $post_id);
    $exp_r = get_field('exp_r', $post_id);
    $prichina_bl = get_field('prichina_bl', $post_id);
    $povnij_opis_chs = get_field('povnij_opis_chs', $post_id);
    $resume_docx = get_field('resume_docx', $post_id);
    $field_61c9624e3d8fc = get_field('field_61c9624e3d8fc', $post_id);
    $zvidki_kandidat =get_field('zvidki_kandidat', $post_id);

    $spec1_values = get_field('spec1', $post_id);
    $spec1_titles = array();
    foreach ($spec1_values as $s1) {
        $spec1_titles[] = $s1->post_title;
    }
    $spec1_string = implode(', ', $spec1_titles);

    $tehnichninetehnichni_values = get_field('posada_inshi', $post_id);
    $tehnichninetehnichni_titles = array();
    if($tehnichninetehnichni_values) {
        foreach ($tehnichninetehnichni_values as $ts1) {
            $tehnichninetehnichni_titles[] = $ts1->post_title;
        }
        $tehnichninetehnichni_string = implode(', ', $tehnichninetehnichni_titles);
    } else {
        $tehnichninetehnichni_string = '';
    }
    $mv1_values = get_field('mova_p', $post_id);
    $mv1_titles = array();
    if ($mv1_values) {
        foreach ($mv1_values as $mv1) {
            $mv1_titles[] = $mv1->post_title;
        }
        $mv1_string = implode(', ', $mv1_titles);
    } else {
        $mv1_string = '';
    }

    $spec4_values = get_field('spec4', $post_id);
    $spec4_titles = array();
    if($spec4_values) {
        foreach ($spec4_values as $s4) {
            $spec4_titles[] = $s4->post_title;
        }
        $spec4_string = implode(', ', $spec4_titles);
    } else {
        $spec4_string = '';
    }
    // For the 'data-work_format' field
    $work_format_values = get_field('tip_raboty', $post_id);
    $work_format_titles = array();
    if($work_format_values) {
        foreach ($work_format_values as $wf) {
            $work_format_titles[] = $wf->post_title;
        }
        $work_format_string = implode(', ', $work_format_titles);
    } else {
        $work_format_string = '';
    }
    // For the 'data-country' field
    $city_values = get_field('city_r', $post_id);
    $city_titles = array();
    if($city_values) {
        foreach ($city_values as $c) {
            $city_titles[] = $c->post_title;
        }
        $city_string = implode(', ', $city_titles);
    } else {
        $city_string = '';
    }

    // For the 'data-compn' field
    $company_values = get_field('komp_last', $post_id);
    $company_titles = array();
    if ($company_values) {
        foreach ($company_values as $comp) {
            $company_titles[] = $comp->post_title;
        }
        $company_string = implode(', ', $company_titles);
    } else {
        $company_string = '';
    }
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

    $contactsArray = array();
    if(have_rows('kontakti22')){
        while(have_rows('kontakti22')): the_row();
            $contactData = get_sub_field('dannik');
            $contactsArray[] = $contactData;
        endwhile;
    }
    $contact_l = implode(', ', $contactsArray);
    $trtr = array();
    if(have_rows('kontakti22')): // проверка, есть ли строки в повторителе 'kontakti22'
        while(have_rows('kontakti22')): the_row(); // если есть строки, начинаем цикл
            $icon = get_sub_field('ikonka');
            $contactData = get_sub_field('dannik');
            $kontakt222 = get_sub_field('kontakt222');
            $kanal_zvyazku = get_sub_field('kanal_zvyazku');
            $test = strtolower($kontakt222->post_title);

// Удалить пробелы
            $test = str_replace(' ', '', $test);

// Удалить символы, кроме букв и цифр
            $test = preg_replace("/[^a-zA-Z0-9]/", "", $test);
            if($test == 'telegram') {
//                $trtr[] = '<a href="https://t.me/'.$contactData.'" class="telele spec1 cp_btn bk_'.$test.'" id="'. uniqid() .'" data-chenel="'.$kanal_zvyazku.'" target="_blank"><span>'.$contactData.'</span></a>';
                $trtr[] = '<a href="'.$contactData.'" class="telele spec1 cp_btn bk_'.$test.'" id="'. uniqid() .'" data-chenel="'.$kanal_zvyazku.'" target="_blank"><span>'.$contactData.'</span></a>';

            }
            else if($test == 'linkedin') {
                $trtr[] = '<a href="'.$contactData.'" class="lkdi spec1 cp_btn bk_'.$test.'" id="'. uniqid() .'" data-chenel="'.$kanal_zvyazku.'" target="_blank"><span>'.$contactData.'</span></a>';

            } else {
                $trtr[] = '<a href="javascript:void(0);" class="specspok spec1 cp_btn bk_'.$test.'" id="'. uniqid() .'" data-chenel="'.$kanal_zvyazku.'"><span>'.$contactData.'</span></a>';
            }

        endwhile;
    endif;
    $contact_la = implode(' ', $trtr);

    $tagsall = get_field('tegi', $post_id); // Разделяем теги по запятым
    $tags_titles = array();
    if ($tagsall) {
        foreach ($tagsall as $ta1) {
            $tags_titles[] = $ta1->post_title;
        }
        $tags = implode(', ', $tags_titles);
    } else {
        $tags = [];
    }

    $current_user_id = get_current_user_id();

    $zvidki_kandidat = get_field('zvidki_kandidat', $post_id);
    $zvidku = '';
    if ($zvidki_kandidat === "Linkedin") {
        $zvidku = '<span class="fromWhere" style="background-color: #0a4b78">Linkedin</span>';
    } else if ($zvidki_kandidat === "work.ua") {
        $zvidku = '<span class="fromWhere" style="background-color: #0f2b78">work.ua</span>';
    } else if ($zvidki_kandidat === "rabota.ua") {
        $zvidku = '<span class="fromWhere" style="background-color: #ff4d56">rabota.ua</span>';
    } else if ($zvidki_kandidat === "robota.ua") {
        $zvidku = '<span class="fromWhere" style="background-color: #ff4d56">robota.ua</span>';
    } else if ($zvidki_kandidat === "djinni.co") {
        $zvidku = '<span class="fromWhere" style="background-color: #7535ff">djinni.co</span>';
    } else {
        $zvidku = "unknown";
    }
    $zvidkuAll = $zvidku;

    // Generate the HTML
    $html .= "
        <div class='myCandW mcd kandItem1 baza' data-uid='{$current_user_id}' data-pdf='{$pdf_parsed}' data-timer='{$dataStart0}' data-name1='{$imya}' data-mova='{$mv1_string}' data-bl='" . ($prichina_bl ? 'blacklist' : '') . "' data-pipe='public' data-id='{$post_id}' data-fam1='{$familiya}' data-tel1='{$telegram}' data-ema1='{$email_r}' data-spec1='{$spec1_string}, {$tehnichninetehnichni_string}' data-spec4='{$spec4_string}' data-angl='{$engl_r}' data-reg1='{$region}' data-cont='{$contact_labels_string}' data-contval='{$contact_l}' data-work_format='{$work_format_string}' data-zar='{$zarplata}' data-country='{$city_string}' data-stat1='{$status_r}' data-oput='{$exp_r}' data-compn='{$company_string}' data-timedb='{$dataStart0}' data-tags='{$tags}' data-times='{$field_61c9624e3d8fc}' data-zvidku='{$zvidki_kandidat}'>
        <div class='bk_time'>
            <p>{$field_61c9624e3d8fc}</p>
        </div>
        <div class='mcName'>";
    if($photo) {
        $html .= " <div class='photo' style='background-image: url({$photo})'></div>";
    }
    $html .= "<div class='bk_name'>
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

    $html .= "{$contact_la}";

    $html .= "
            </div>
        </div>
        <div class='bk_end'>
            <div class='bk_cv'>";
    $resume_id = get_field('resume_r', $post_id);
    if ($resume_id) {
        $html .= "<a href='javascript:void(0);' class='modalCv' id='modal-launcher'>";
        if ($zvidki_kandidat) {
//            $html .= "<span class='fromWhere'>{$zvidki_kandidat}</span>";
            $html .= "{$zvidkuAll}";
        }
        $html .= "<img src='". get_bloginfo('template_url') . "/assets/img/cv.png' alt='CV'/></a>
                <div id='modal-background'></div>
                <div id='modal-content'>
                    <button id='modal-close'>✖</button>";

//        render_main_comment($main_comment, $post_id);
        if ($main_comment_sw) {
            $html .= "<div class='maincomment'><div class='mcwr'>Основний коментар - {$zvidkuAll}<button class='editpopup'>✎</button></div><div class='ppover' style='display: none;'></div><div class='maincommentPopup' style='display: none;'><button class='closecomment'>✖</button>";
            ob_start();
            acf_form(array(
                'post_id' => $post_id,
                'post_title' => false,
                'post_content' => false,
                'fields' => array('main_comment','main_comment_sw'),
                'submit_value' => __('Зберегти')
            ));
            $form_output = ob_get_clean();
            $html .= $form_output . "</div></div>";
        }
        $resume_url = wp_get_attachment_url($resume_id);
        $html .= "<embed src='{$resume_url}' frameborder='0' width='100%' height='700px'>";


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
                </div>";
    } else if ($code_cv) {
        $html .= "<a href='javascript:void(0);' class='modalCv' id='modal-launcher'>CV</a>
                <div id='modal-background'></div>
                <div id='modal-content'>
                    <button id='modal-close'>✖</button>";
        if ($main_comment_sw) {
            $html .= "<div class='maincomment'><div class='mcwr'>Основний коментар - {$zvidkuAll}<button class='editpopup'>✎</button></div><div class='ppover' style='display: none;'></div><div class='maincommentPopup' style='display: none;'><button class='closecomment'>✖</button>";
            ob_start();
            acf_form(array(
                'post_id' => $post_id,
                'post_title' => false,
                'post_content' => false,
                'fields' => array('main_comment','main_comment_sw'),
                'submit_value' => __('Зберегти')
            ));
            $form_output = ob_get_clean();
            $html .= $form_output . "</div></div>";
        }
        $html .= "{$code_cv}";


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
                </div>";
    }
    $html .= "        
    </div>
        </div>
        <div class='bk_end'>
            <button type='button' class='getToVac'><img src='". get_bloginfo('template_url') . "/assets/img/vaca.png' alt='vac'/></button>
            <button class='favorite-star' data-candidate-id='{$post_id}'>
                ☆
            </button>
        </div>
    </div>";

    return $html;
}
// Candidate filter
add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');
function filter_posts($post)
{
    // Создаем новый WP_Query для подсчета постов с определенным значением в поле tehnichninetehnichni
    $techQuery = new WP_Query(array(
        'ep_integrate'   => true,
        'post_type' => array('candidate', 'rekomend'),
        'posts_per_page' => -1,
        'fields' => 'ids',
    ));

    // Получаем количество подходящих постов
    $tech_count = $techQuery->found_posts;

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'ep_integrate'   => true,
        'post_type' => array('candidate', 'rekomend'),
//        'meta_key' => 'dataStart2',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 20,
        'paged' => $page,
    );
    $args['meta_query'] = array('relation' => 'AND');

    if (isset($_POST['searchfilters'])) {
//        $meta_query = ['relation' => 'OR'];
        foreach ($_POST['searchfilters'] as $datacontact) {
            $meta_query[] = [
                'key' => 'pdf_parsed',
                'value' => $datacontact,
                'compare' => 'LIKE',
            ];
        }
        $args['meta_query'] = $meta_query;
    }

//    if (isset($_POST['searchfilters'])) {
//        foreach ($_POST['searchfilters'] as $bktags) {
//            $meta_query_tag[] = [
//                'key' => 'tegi',
//                'value' => $bktags,
//                'compare' => 'LIKE',
//            ];
//        }
//        $args['meta_query'] = $meta_query_tag;
//    }

    if (isset($_POST['filters']['englishLevels'])) {
        $englishLevelsQuery = array('relation' => 'AND');
        foreach ($_POST['filters']['englishLevels'] as $englishLevel) {
            $englishLevelsQuery[] = array(
                'key' => 'engl_r',
                'value' => intval($englishLevel),
                'compare' => '>=',
                'type' => 'NUMERIC'
            );
        }
        $args['meta_query'][] = $englishLevelsQuery;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $filters = $_POST['filters'];
        $hasCV = $filters['hasCv'] === 'true' ? true : false;
    }

    if (isset($hasCV)) {
        if ($hasCV) {
            $args['meta_query'][] = [
                'key' => 'resume_r',
                'value' => '',
                'compare' => '!='
            ];
        }
    }
//    $args['orderby'] = array(
//        'meta_value' => 'DESC',
//    );
////////////////////////////  TODO:    $args['meta_key'] = 'resume_r';

    if (isset($_POST['filters']['sort'])) {
        if ($_POST['filters']['sort'] === 'ASC') {
            $args['order'] = 'ASC';
        } else if ($_POST['filters']['sort'] === 'DESC') {
            $args['order'] = 'DESC';
        }
    }

    if (isset($_POST['filters']['spec1'])) {
        foreach ($_POST['filters']['spec1'] as $spec1Value) {
            // Get the post object for the spec1 term
            $spec1Post = get_page_by_title($spec1Value, OBJECT, array('language', 'additional-lang', 'nontech'));
            if ($spec1Post) {
                // Use the ID of the spec1 post for filtering with key 'spec1'
                $args['meta_query'][] = [
                    'key' => 'spec1',
                    'value' => '"' . $spec1Post->ID . '"',  // relationship field stores post IDs as strings
                    'compare' => 'LIKE',
                ];
            }
        }
    }
    if (isset($_POST['filters']['spec1'])) {
        foreach ($_POST['filters']['spec1'] as $noitValue) {
            // Get the post object for the noit term
            $noitValue = str_replace("\\", "", $noitValue); // remove backslashes
            $noitPost = get_page_by_title($noitValue, OBJECT, array('noitposts'));
            if ($noitPost) {
                $args['meta_query'][] = [
                    'key' => 'posada_inshi',
                    'value' => '"' . $noitPost->ID . '"',  // relationship field stores post IDs as strings
                    'compare' => 'LIKE',
                ];
            }
        }
    }
    if (isset($_POST['filters']['mova'])) {
        foreach ($_POST['filters']['mova'] as $spec1Value) {
            // Get the post object for the spec1 term
            $spec1Post = get_page_by_title($spec1Value, OBJECT, array('mova'));
            if ($spec1Post) {
                // Use the ID of the spec1 post for filtering
                $args['meta_query'][] = [
                    'key' => 'mova_p',
                    'value' => '"' . $spec1Post->ID . '"',  // relationship field stores post IDs as strings
                    'compare' => 'LIKE',
                ];
            }
        }
    }

    // Filter by oput
    if (isset($_POST['filters']['oput'])) {
        $args['meta_query'][] = [
            'key' => 'exp_r',
            'value' => $_POST['filters']['oput'],
            'type' => 'NUMERIC',
            'compare' => '>=',
        ];
    }

    // Filter by zarpl
    if (isset($_POST['filters']['zarpl']) && isset($_POST['filters']['zarpl_to'])) {
        $zarpl = isset($_POST['filters']['zarpl']) && $_POST['filters']['zarpl'] !== '' ? $_POST['filters']['zarpl'] : 0;
        $zarpl_to = isset($_POST['filters']['zarpl_to']) && $_POST['filters']['zarpl_to'] !== '' ? $_POST['filters']['zarpl_to'] : 140000;

        $args['meta_query'][] = [
            'key' => 'zarplata',
            'value' => array($zarpl, $zarpl_to),
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        ];

    }

    if (isset($_POST['filterscountry'])) {
        $regCountryQuery = array('relation' => 'OR');
        foreach ($_POST['filterscountry'] as $regCountryValue) {
            // Get the post object for the workFormat term
            $regCountryPost = get_page_by_title($regCountryValue, OBJECT, 'countries');
            if ($regCountryPost) {
                // Use the ID of the workFormat post for filtering
                $regCountryQuery[] = [
                    'key' => 'city_r',
                    'value' => '"' . $regCountryPost->ID . '"',
                    'compare' => 'LIKE',
                ];
            }
        }
        $args['meta_query'][] = $regCountryQuery;
    }


    // Filter by workFormats
    if (isset($_POST['filters']['workFormats'])) {
        $workFormatsQuery = array('relation' => 'OR');
        foreach ($_POST['filters']['workFormats'] as $workFormatValue) {
            // Get the post object for the workFormat term
            $workFormatPost = get_page_by_title($workFormatValue, OBJECT, 'work_format');
            if ($workFormatPost) {
                // Use the ID of the workFormat post for filtering
                $workFormatsQuery[] = [
                    'key' => 'tip_raboty',
                    'value' => '"' . $workFormatPost->ID . '"',
                    'compare' => 'LIKE',
                ];
            }
        }
        $args['meta_query'][] = $workFormatsQuery;
    }

    if (isset($_POST['filters']['tags'])) {
        $tagsQuery = array('relation' => 'OR');
        foreach ($_POST['filters']['tags'] as $tagsValue) {
            // Get the post object for the workFormat term
            $tagsPost = get_page_by_title($tagsValue, OBJECT, 'tagstype');
            if ($tagsPost) {
                // Use the ID of the workFormat post for filtering
                $tagsQuery[] = [
                    'key' => 'tegi',
                    'value' => '"' . $tagsPost->ID . '"',
                    'compare' => 'LIKE',
                ];
            }
        }
        $args['meta_query'][] = $tagsQuery;
    }

    // Filter by datacontact
    $contactMap = [
        'Skype' => 'skype_r',
        'Telegram' => 'telegram',
        'Viber' => 'viber_r',
        'Whatsapp' => 'whatsapp_r',
        'Телефон' => 'tel_r',
        'Email' => 'email_r',
        'Linkedin' => 'linkedin',
        'Інше' => 'drugoe'
    ];
    if (isset($_POST['filters']['datacontact'])) {
        $contactFilters = $_POST['filters']['datacontact'];
        $contactFiltersQuery = array('relation' => 'OR');

        foreach ($contactFilters as $contact) {
            if (isset($contactMap[$contact])) {
                $field = $contactMap[$contact];
                $contactFiltersQuery[] = [
                    'key' => $field,
                    'value' => '',
                    'compare' => '!='
                ];
            }
        }
        $args['meta_query'][] = $contactFiltersQuery;
    }

    if (isset($_POST['filters']['datefrom']) && isset($_POST['filters']['dateto'])) {
        $args['date_query'] = array(
            array(
                'after'     => $_POST['filters']['datefrom'],
                'before'    => $_POST['filters']['dateto'],
                'inclusive' => true,
            ),
        );
    }

    if (isset($_POST['filters']['uid'])) {
        $uid = $_POST['filters']['uid'];
        $current_user_id = get_current_user_id();

        if ($uid === 'true') {
            $args['author'] = $current_user_id;
        } else {
            $args['author'] = ''; // Показываем все посты
        }
    } else {
        $args['author'] = ''; // Показываем все посты
    }

    if (isset($_POST['filters']['user_ids']) && is_array($_POST['filters']['user_ids'])) {
        if (in_array("all", $_POST['filters']['user_ids'])) {
            // Если "all" в списке, показываем все посты, не устанавливая 'author__in'
        } else {
            $user_ids = array_map('absint', $_POST['filters']['user_ids']); // Преобразуем все значения в абсолютные целые числа
            $args['author__in'] = $user_ids; // Фильтрация по нескольким авторам
        }
    }

    $recomendData = new WP_Query($args);
    $total_count = $recomendData->found_posts;

    $posts = array();
    if ($recomendData->have_posts()) {
        while ($recomendData->have_posts()) {
            $recomendData->the_post();
            $posts[] = render_post($post);
        }
    }

    $max_pages = $recomendData->max_num_pages;  // Получите максимальное количество страниц

    // если количество страниц больше 1
    $pagination = '';
    if ($max_pages > 1) {
        $big = 999999999; // нужно большое число
        $pagination = '<div class="pagination linksAjax"><a class="prev page-numbers" href="#">‹ Назад</a><div class="pagnum">' . paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'total' => $max_pages,
                'current' => max( 1, get_query_var('paged') ),
                'prev_text' => '',
                'next_text' => '',
            )) . '</div><a class="next page-numbers" href="№"> Далі ›</a></div>';
    }

    $response = array(
        'posts' => $posts,
        'currentPage' => intval($page),
        'maxPages' => $recomendData->max_num_pages,
        'pagination' => $pagination,
        'tech_count' => $tech_count,
        'total_count' => $total_count
    );

    echo json_encode($response);
    wp_die();
}
////////////////////////////////// Vacancy filter //////////////////////////////////////////////////////////
function render_vacancy($post) {
    // Get the post data
    $title = get_the_title($post);
    $comp = get_field('klienty', $post);
    $spec = get_field('nazva_vakansi', $post);
    $angl = get_field('riven_anglijsko', $post);
    $opyt = get_field('opyt', $post);
    $cloc = get_field('lokacziya', $post);
    $zarplata1 = get_field('zarplata1', $post);
    $vcompany = get_field('vcompany', $post);
    $prioritetnist_vakansi = get_field('prioritetnist_vakansi', $post);
    $field_645272746b7d4 = get_field('field_645272746b7d4', $post);
    $region = get_field('region', $post);
    $frejmvork = get_field('frejmvork', $post);
    $format_raboty = get_field('format_raboty', $post);
    $notech_related = get_field('notech_related', $post);
    $gorod = get_field('gorod', $post);

    $vacId = get_the_ID();
    $starCount = new WP_Query(array(
        'ep_integrate'   => true,
        'post_type' => 'vstar',
        'meta_query' => array(
            array(
                'key' => 'my_vac_id',
                'compare' => '=',
                'value' => $vacId
            )
        )
    ));
    $existStarStatus = 'no';
    if (is_user_logged_in()) {
        $existStar = new WP_Query(array(
            'author' => get_current_user_id(),
            'ep_integrate'   => true,
            'post_type' => 'vstar',
            'meta_query' => array(
                array(
                    'key' => 'my_vac_id',
                    'compare' => '=',
                    'value' => $vacId
                )
            )
        ));
        if ($existStar->found_posts) {
            $existStarStatus = 'yes';
        }
    }

    // Generate the HTML
    $html = '
        <div class="task-list-row vac_item vacdetsep clvacwrapp ajaxret" data-title="' . $title . '"
             data-comp="' . implode(', ', array_map(function($c2) { return $c2->post_title; }, $comp)) . '"
             data-spec="' . implode(', ', array_map(function($k) { return $k->post_title; }, $spec)) . '"
             data-angl="' . $angl . '" data-opyt="' . $opyt . '"
             data-country="' . implode(', ', array_map(function($cl) { return $cl->post_title; }, $cloc)) . '"
             data-zarplata="' . $zarplata1 . '"
             data-zarp2="' . $zarplata1 . '"
             data-company="' . $vcompany . '" data-status="' . $prioritetnist_vakansi . '"
             data-data="' . $field_645272746b7d4 . '" data-region="' . $region . '"
             data-framework="' . implode(', ', array_map(function($s4) { return $s4->post_title; }, $frejmvork)) . '"
             data-work_format="' . implode(', ', array_map(function($k) { return $k->post_title; }, $format_raboty)) . '"
             data-notech="' . implode(', ', array_map(function($k) { return $k->post_title; }, $notech_related)) . '"
             data-city="' . implode(', ', array_map(function($k) { return $k->post_title; }, $gorod)) . '">
            <div class="bk_time">
                <p class="">' . $field_645272746b7d4 . '</p>
            </div>
            <div class="vakname">
                <h3><a href="' . get_permalink($post) . '" class="vac_title">' . $spec . '</a></h3>
            </div>
            <div class="vakzarpl">';

    if (get_field('vidno_dlya_vsih', $post)) {
        $html .= '<p>' . $zarplata1 . '$</p>';
    }

    $html .= '
            </div>
            <div class="vakloc">
                <p class="expandable-text">' . implode(', ', array_map(function($cl) { return $cl->post_title; }, $cloc)) . '</p>
            </div>
            <div class="vakangl">
                ' . $angl . '
            </div>
            <div class="vakprior">
            </div>
            <div class="vakprior">
                ' . $prioritetnist_vakansi . '
            </div>
            <div class="bk_end vds3">
                <div class="starWrapp" data-exist="' . $existStarStatus . '"
                     data-vac="' . $vacId . '"
                     data-star="' . $existStar->posts[0]->ID . '">
                    <span class="dashicons dashicons-star-filled saveVac"></span>
                </div>
            </div>
        </div>';

    return $html;
}
add_action('wp_ajax_filter_vac', 'filter_vac');
add_action('wp_ajax_nopriv_filter_vac', 'filter_vac');
function filter_vac($post)
{
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $args = array(
        'post_type' => 'vacancy',
        'posts_per_page' => 1,
        'paged' => $page,
    );
    $args['meta_query'] = array('relation' => 'AND');

    // Filter by oput
    if (isset($_POST['vfilters']['voput'])) {
        $args['meta_query'][] = [
            'key' => 'skilki_rokiv_dosvidu',
            'value' => $_POST['vfilters']['voput'],
            'type' => 'NUMERIC',
            'compare' => '>=',
        ];
    }

    // Filter by zarpl
    if (isset($_POST['vfilters']['vzarpl']) && isset($_POST['vfilters']['vzarpl_to'])) {
        $args['meta_query'][] = [
            'key' => 'zarplata1',
            'value' => array($_POST['vfilters']['vzarpl'], $_POST['vfilters']['vzarpl_to']),
            'compare' => 'BETWEEN',
        ];
    }

    // Filter by workFormats
    if (isset($_POST['vfilters']['vworkFormats'])) {
        // This filter will match any of the selected levels
        $workFormatsQuery = array('relation' => 'OR');
        foreach ($_POST['vfilters']['vworkFormats'] as $workFormatValue) {
            $workFormatsQuery[] = array(
                'key' => 'format_roboti',
                'value' => $workFormatValue,
                'compare' => 'LIKE',
            );
        }
        $args['meta_query'][] = $workFormatsQuery;
    }

    // Filter by datacontact
    $contactMap = [
        'Skype' => 'skype_r',
        'Telegram' => 'telegram',
        'Viber' => 'viber_r',
        'Whatsapp' => 'whatsapp_r',
        'Телефон' => 'tel_r',
        'Email' => 'email_r',
        'Linkedin' => 'linkedin',
        'Інше' => 'drugoe'
    ];
    if (isset($_POST['vfilters']['vdatacontact'])) {
        $contactFilters = $_POST['vfilters']['vdatacontact'];
        $contactFiltersQuery = array('relation' => 'OR');

        foreach ($contactFilters as $contact) {
            if (isset($contactMap[$contact])) {
                $field = $contactMap[$contact];
                $contactFiltersQuery[] = [
                    'key' => $field,
                    'value' => '',
                    'compare' => '!='
                ];
            }
        }
        $args['meta_query'][] = $contactFiltersQuery;
    }
    // Filter by englishLevels
    if (isset($_POST['vfilters']['venglishLevels'])) {
        // This filter will match any of the selected levels
        $englishLevelsQuery = array('relation' => 'OR');
        foreach ($_POST['vfilters']['venglishLevels'] as $englishLevel) {
            $englishLevelsQuery[] = array(
                'key' => 'engl_r',
                'value' => $englishLevel,
                'compare' => 'LIKE',
            );
        }
        $args['meta_query'][] = $englishLevelsQuery;
    }

    if (isset($_POST['vfilterscountry'])) {
        $regCountryQuery = array('relation' => 'OR');
        foreach ($_POST['vfilterscountry'] as $regCountryValue) {
            // Get the post object for the workFormat term
            $regCountryPost = get_page_by_title($regCountryValue, OBJECT, 'countries');
            if ($regCountryPost) {
                // Use the ID of the workFormat post for filtering
                $regCountryQuery[] = [
                    'key' => 'lokacziya',
                    'value' => '"' . $regCountryPost->ID . '"',
                    'compare' => 'LIKE',
                ];
            }
        }
        $args['meta_query'][] = $regCountryQuery;
    }

    if (isset($_POST['vfilters']['vspec1'])) {
        foreach ($_POST['vfilters']['vspec1'] as $spec1Value) {
            // Get the post object for the spec1 term
            $spec1Post = get_page_by_title($spec1Value, OBJECT, array('language', 'additional-lang', 'nontech'));
            if ($spec1Post) {
                // Use the ID of the spec1 post for filtering
                $args['meta_query'][] = [
                    'key' => 'spec1',
                    'value' => '"' . $spec1Post->ID . '"',  // relationship field stores post IDs as strings
                    'compare' => 'LIKE',
                ];
            }
        }
    }

    $recomendData = new WP_Query($args);

    $posts = array();
    if ($recomendData->have_posts()) {
        while ($recomendData->have_posts()) {
            $recomendData->the_post();
            $posts[] = render_vacancy($post);
        }
    }

    $response = array(
        'posts' => $posts,
        'currentPage' => intval($page),
        'maxPages' => $recomendData->max_num_pages
    );

    echo json_encode($response);
    wp_die();
}

/////////////////// Актуалізуємо стаж кандидата (CRON)  /////////////////////////////////////////////////
add_action('my_daily_event', 'update_all_experiences');
function update_all_experiences() {
    $args = array(
        'ep_integrate'   => true,
        'post_type' => 'candidate',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    $posts = get_posts($args);
    $current_date = new DateTime();

    foreach ($posts as $post) {
        $post_date = DateTime::createFromFormat('Y-m-d H:i:s', $post->post_date);
        $interval = $post_date->diff($current_date);
        $years = $interval->y; // Исправлено на использование ->y для получения числа лет

        $experience = get_field('exp_r', $post->ID);

        // Изначальный опыт + число лет, прошедших с момента создания записи
        $new_experience = $experience + $years;

        // Обновляем значение опыта только в случае, если новый опыт больше изначального
        if($new_experience > $experience) {
            update_field('exp_r', $new_experience, $post->ID);
        }
    }
}
if (! wp_next_scheduled ( 'my_daily_event' )) {
    wp_schedule_event(time(), 'daily', 'my_daily_event');
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_cors_http_header(){
    header("Access-Control-Allow-Origin: chrome-extension://bfhmijeccoajholjbnnnepgjoeopjebd");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    error_log('CORS headers added');
}
add_action('init','add_cors_http_header');

add_action('rest_api_init', function () {
    register_rest_route('myplugin/v1', '/field/(?P<key>.+)', array(
        'methods' => 'GET',
        'callback' => 'myplugin_get_field_definition',
    ));
});

function myplugin_get_field_definition($data) {
    $field = get_field_object($data['key']);
    return $field;
}

add_action('rest_api_init', function () {
    register_rest_route('your-plugin/v1', '/convert-resume', array(
        'methods' => 'POST',
        'callback' => 'convert_resume_field_to_pdf',
    ));
});


//wp_enqueue_script( 'my-ajax2-script', get_template_directory_uri() . '/js/my-ajax2-script.js', array('jquery') );
//wp_localize_script( 'my-ajax2-script', 'MyAjax2', array(
//    'ajaxurl' => admin_url( 'admin-ajax.php' ),
//    'security' => wp_create_nonce( 'my-ajax-nonce' )
//));

//wp_enqueue_script( 'my-ajax2-script', get_template_directory_uri() . '/js/my-ajax2-script.js', array('jquery') );
//wp_localize_script( 'my-ajax2-script', 'MyAjax2', array(
//    'ajaxurl' => admin_url( 'admin-ajax.php' ),
//    'security' => wp_create_nonce( 'my-ajax2-nonce' )
//));

add_action('wp_ajax_nopriv_submit_step', 'submit_step');
add_action('wp_ajax_submit_step', 'submit_step');
function submit_step() {
    // Проверяем nonce
    check_ajax_referer('my-ajax-nonce', 'security');

    // Сохраняем данные из формы
    $userdata = array(
        'user_login'  =>  $_POST['email'], // Используйте email в качестве логина
        'user_email'  =>  $_POST['email'],
        'user_pass'   =>  $_POST['password'],  // Пароль
        'first_name'  =>  $_POST['name'],
        'last_name'   =>  $_POST['lastName'],
        'display_name'  =>  $_POST['name'] .' '. $_POST['lastName'],
    );
    $user_id = wp_insert_user( $userdata ) ;

    // Проверьте, был ли пользователь успешно создан.
    if ( is_wp_error( $user_id ) ) {
        // Вернуть ошибку клиенту
        echo json_encode(array(
            'success' => false,
            'message' => $user_id->get_error_message(),
        ));
    } else {
        // Пользователь успешно создан, автоматически войдите в систему
        wp_set_current_user($user_id, $_POST['email']);
        wp_set_auth_cookie($user_id);
        do_action('wp_login', $_POST['email']);

        // Верните успех
        echo json_encode(array(
            'success' => true,
        ));
    }

    wp_die();
}

//function submit_step() {
//    // Проверяем nonce
//    check_ajax_referer('my-ajax-nonce', 'security');
//
//    // Сохраняем данные из формы
//    $userdata = array(
//        'user_login'  =>  $_POST['email'], // Используйте email в качестве логина
//        'user_email'  =>  $_POST['email'],
//        'user_pass'   =>  $_POST['password'],  // Пароль
//        'first_name'  =>  $_POST['name'],
//        'last_name'   =>  $_POST['lastName'],
//        'display_name'  =>  $_POST['name'] .' '. $_POST['lastName'],
//    );
//    $user_id = wp_insert_user( $userdata ) ;
//
//    // Проверьте, был ли пользователь успешно создан.
//    if ( is_wp_error( $user_id ) ) {
//        // Вернуть ошибку клиенту
//        echo json_encode(array(
//            'success' => false,
//            'message' => $user_id->get_error_message(),
//        ));
//    } else {
//        // Пользователь успешно создан, вернуть успех
//        echo json_encode(array(
//            'success' => true,
//        ));
//    }
//
//    wp_die();
//}

add_action('admin_menu', 'my_custom_settings_page');

function my_custom_settings_page() {
    add_menu_page(
        'Invite message',
        'Invite',
        'manage_options',
        'welcome-settings',
        'my_custom_settings_content',
        'dashicons-welcome-write-blog',
        80
    );
}

function my_custom_settings_content() {
    ?>
    <div class="wrap">
        <h1><?php echo get_admin_page_title(); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('welcome_settings');
            do_settings_sections('welcome-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'my_custom_settings_init');

function my_custom_settings_init() {
    register_setting('welcome_settings', 'welcome_message');

    add_settings_section(
        'welcome_settings_section',
        'Настройки запрошення',
        '',
        'welcome-settings'
    );

    add_settings_field(
        'welcome_message_field',
        'Запрошення',
        'my_custom_settings_field_callback',
        'welcome-settings',
        'welcome_settings_section'
    );
}
function my_custom_settings_field_callback() {
    $welcome_message = get_option('welcome_message', ''); // Получите сохраненное сообщение или используйте пустую строку по умолчанию
    echo "<textarea name='welcome_message' rows='5' cols='50'>{$welcome_message}</textarea>";
}


add_action('wp_ajax_update_user_capabilities', 'update_user_capabilities_callback');

function update_user_capabilities_callback() {  // Обновление возможностей пользователя
    $user_id = intval($_POST['user_id']);

    $capabilities_map = [
        'delete_candidates' => 'delete_candidates',
        'publish_candidates' => 'publish_candidates',
        'delete_vacancys' => 'delete_vacancys',
        'add_vacancys' => 'add_vacancys',
        'delete_clients' => 'delete_clients',
        'add_clients' => 'add_clients',
        'delete_users' => 'delete_users',
        'create_users' => 'create_users',
        'edit_users' => 'edit_users',
        'assign_client_responsibility' => 'assign_client_responsibility'
    ];

    if(!current_user_can('manage_options')) {
        wp_send_json_error('Недостаточно прав');
        exit;
    }

    $user = new WP_User($user_id);

    foreach($capabilities_map as $post_key => $capability) {
        if(isset($_POST[$post_key]) && $_POST[$post_key] == "1") {
            $user->add_cap($capability);
        } else {
            $user->remove_cap($capability);
        }
    }

    wp_send_json_success('Можливості оновлені');
}
function custom_rewrite_rule($rules) {
    $new_rules = array(
        'user/([^/]+)/?$' => 'index.php?pagename=user-profile&username=$matches[1]'
    );
    return $new_rules + $rules;
}
add_filter('rewrite_rules_array', 'custom_rewrite_rule');
//function custom_query_vars($vars) {
//    $vars[] = 'username';
//    return $vars;
//}
//add_filter('query_vars', 'custom_query_vars');
function custom_query_vars_filter($vars) {
    $vars[] .= 'user_id';
    return $vars;
}
add_filter('query_vars', 'custom_query_vars_filter');

function custom_rew_rule() {
    add_rewrite_rule('^user-profile/([0-9]+)/?$', 'index.php?pagename=user-profile&user_id=$matches[1]', 'top');
    add_rewrite_tag('%user_id%', '([^&]+)');
}
add_action('init', 'custom_rew_rule', 10, 0);

add_action('wp_ajax_transfer_admin_rights', 'transfer_admin_rights_callback');
function transfer_admin_rights_callback() {
    if(current_user_can('administrator') && isset($_POST['user_id'])) {
        $new_admin_id = intval($_POST['user_id']);

        if ($new_admin_user = get_userdata($new_admin_id)) {
            $new_admin_user->set_role('administrator');
            $user_info = get_userdata($new_admin_id);
            $to = $user_info->user_email;
            $subject = 'Вас призначено адміністратором!';
            $message = 'Вітаємо! Вас призначено адміністратором команди ' . get_bloginfo('name') . '. Ви можете управляти сайтом, якщо перейдете за посиланням ' . get_bloginfo('url') . '/wp-admin';
            wp_mail($to, $subject, $message);
//            $current_user = wp_get_current_user();
//            $current_user->set_role('subscriber'); // или другая роль

            echo json_encode(array('success' => true, 'message' => 'Права успешно переданы пользователю ' . $new_admin_user->display_name));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Выбранный пользователь не существует.'));
        }
    }
    wp_die();
}