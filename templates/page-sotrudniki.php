<?php
/*
Template Name: Сотрудники
*/
if (!current_user_can('administrator') && !current_user_can('editor')) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
get_header();
?>
    <div class="dp_cont">
        <?php
        global $wpdb;
        $wp_user_search = $wpdb->get_results("SELECT ID, display_name FROM $wpdb->users ORDER BY ID");

        foreach ($wp_user_search as $userid) {
            $user_id = (int)$userid->ID;
            $user_login = stripslashes($userid->user_login);
            $display_name = stripslashes($userid->display_name);

//            $return = '';
            ?>
            <p><?php $display_name ?></p>
            <?php
//            $return .= "\t" . '<p>' . $display_name . '</p>' . "\n";

//            print($return);
        }
        ?>

        <span style="color: #000000;"><?php echo wpb_recently_registered_users(); ?></span>
    </div>
<?php
function wpb_recently_registered_users()
{
    global $wpdb;
//    global $wp_roles;
//    $roles = array();

    $recentusers = '<ol class="recently-user">';

    $usernames = $wpdb->get_results("SELECT user_nicename, user_url, user_email, user_registered, display_name, ID FROM $wpdb->users ORDER BY ID DESC LIMIT 10");
    ?>
    <div class="sotr1_wr right_vac">
        <?php
        foreach ($usernames as $username) {
            $ui = $username->ID;
            $user = new WP_User($ui);

            if (!$username->user_url) {
                ?>
                <div class="sotr1" data-rl="<?php echo get_user_role($ui); ?>">
                    <?php echo get_avatar($username->user_email, 45), ' ' ?>
                    <span class="alignContent">[<?php echo $username->ID ?>]</span><a href="<?php the_permalink(); ?>"
                                                                                      class="vac_title">link</a>
                    <span class="alignContent">{<?php echo $username->user_nicename ?>}</span>
                    <span class="alignContent">(<?php echo $username->display_name ?>)</span>
                    <span class="alignContent sr"> Роли: <?php echo get_user_role($ui) ?>;</span>
                    <span class="alignContent"> Емейл: <?php echo $username->user_email ?>;</span>
                    <span class="alignContent"> Зарегестрирован: <?php echo $username->user_registered ?></span>
                </div>
                <?php
//            if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
//                foreach ( $user->roles as $role )
//                    $roles[] .= translate_user_role($wp_roles->roles[$role]['name']);
//            }
//            $rol = implode(', ',$roles);
                $recentusers .= '<li>' . get_avatar($username->user_email, 45) . $username->user_nicename .
                    "</a> [$username->ID] $username->display_name $username->user_email  $username->user_registered </li>'<div>' . get_user_role( $ui ) </div>";

            } else {
                $recentusers .= '<li>' . get_avatar($username->user_email, 45) . '<a href="' . $username->user_url . '">'
                    . $username->user_nicename . "</a>[$username->ID] $username->display_name $username->user_email  $username->user_registered</li>";
                ?>
                <div class="sotr1" data-rl="<?php echo get_user_role($ui); ?>">
                    <?php echo get_avatar($username->user_email, 45), ' ' ?>
                    <span class="alignContent">[<?php echo $username->ID ?>]</span>
                    <span class="alignContent">{<?php echo $username->user_nicename ?>}</span>
                    <span class="alignContent">(<?php echo $username->display_name ?>)</span>
                    <span class="alignContent sr"> Роли: <?php echo get_user_role($ui) ?>;</span>
                    <span class="alignContent"> Емейл: <?php echo $username->user_email ?>;</span>
                    <span class="alignContent"> Зарегестрирован: <?php echo $username->user_registered ?></span>
                </div>
                <?php
            }
        }
        $recentusers .= '</ul>';

        ?>
    </div>
    <?php
} ?>


    <section class="dp_cont right_vac sotr1_wr">
        <?php
        $posts = get_posts(array(
            'numberposts' => -1,
//            'category_name'    => 'soft_pets',
            'orderby' => 'date',
            'order' => 'ASC',
            'post_type' => 'sotrudniki',
            // 'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        ));

        foreach ($posts as $post) {
            setup_postdata($post);  ?>
           <div class="s_full_item sotr1">
               <a href="<?php the_permalink(); ?>"><img class="sfi_details" src="<?php if (the_field('foto'))
               {the_field('foto');} ?>" alt="Фотография сотрудника"></a>
               <div class="sfi_details">
                   <h4><?php the_title() ?></h4>
                   <h5><?php the_field('dolzhnost') ?></h5>
                   <p>Емейл: <?php the_field('e-mail5') ?></p>
               </div>
           </div>
            <?php
        }

        wp_reset_postdata(); // сброс
        ?>
    </section>
<?php get_footer(); ?>