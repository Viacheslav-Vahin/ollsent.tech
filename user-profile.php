<?php
/*
Template Name: User Profile
*/
acf_form_head();
get_header(); ?>
<?php
$user_id = get_query_var('user_id');
$user = get_userdata($user_id);
if ($user) {
    // выводите данные пользователя, как вам нужно
    echo '<h1>' . esc_html($user->display_name) . '</h1>';
    // и так далее...
} else {
    echo 'Пользователь не найден';
}
?>
<?php get_template_part('template-parts/formAddCand') ?>
<?php get_footer(); ?>
