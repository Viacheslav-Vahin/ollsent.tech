<article class="popupcl_form addNewClient">
    <div class="popup_bgr" data-popupcl="close"></div>
    <div class="popup_box">
        <div class="pop_box_inn">
            <button type="button" class="close-modal" data-popupcl="close">×</button>
            <h3 class="cloud-title">Створити компанію<span class="cuID1 dnone"><?php echo get_current_user_id(); ?></span>
                <!-- <input id="cutime" type="datetime" value="<?php
                date_default_timezone_set('Europe/Kiev');
                $date = date('m-d-Y H:i:s', time()); echo $date; ?>"> -->
            </h3>
            <section class="p_form">
                <?php
                acf_form_head();
                while (have_posts()) : the_post(); ?>
                    <?php
                    acf_form(array(
                        'post_id' => 'new_post',
                        'post_title' => false,
                        'post_content' => false,
                        'new_post' => array(
                            'post_type' => 'client',
                            'post_status' => 'publish'
                        ),
                        'submit_value' => 'Створити компанію',
                        'uploader' => 'basic',
                        'return' => add_query_arg('p', '%post_id%', home_url())
                    )); ?>
                <?php endwhile; ?>
            </section>
        </div>
    </div>
</article>