<article class="popup_form addVac">
    <div class="popup_bgr" data-popup="close"></div>
    <div class="popup_box">
        <div class="pop_box_inn">
            <button type="button" class="close-modal" data-popup="close">×</button>
            <h3 class="cloud-title">Создать вакансию</h3>
                <div class="customContainer1">
                    <section class="p_form">
                        <?php
                        acf_form_head();
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                acf_form(array(
                                    'post_id'       => 'new_post',
                                    'post_title'    => false,
                                    'post_content'  => false,
                                    'new_post'      => array(
                                        'post_type'     => 'vacancy',
                                        'post_status'   => 'publish'
                                    ),
                                    'submit_value'  => 'Создать вакансию',
                                    'return' => add_query_arg('p', '%post_id%', home_url())
                                ));
                            endwhile;
                        endif;
                        ?>
                    </section>
        </div>
    </div>
</article>