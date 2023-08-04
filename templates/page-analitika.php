<?php
/*
Template Name: Аналитика
*/
if (!current_user_can('administrator') && !current_user_can('editor')) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
get_header();
?>
<h2>Аналитика</h2>
<?php get_footer(); ?>
