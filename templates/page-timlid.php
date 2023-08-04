<?php
/*
Template Name: Тимлид
*/
if (!current_user_can('administrator') && !current_user_can('editor') && !current_user_can('publish_sotrudnikis')) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
acf_form_head();
get_header();
?>
<div class="dp_container rekruter">
    <div class="" id="tres8"><span id="cu6" class="dnone"><?php echo get_current_user_id(); ?></span>
        <span id="surl6" class="dnone"><?php echo get_site_url() ?></span>
    </div>
    <div class="vac_wrap">
        <div class="left_vac left2">
            <div class="fimg simg">
                <?php
                $recomendData = new WP_Query(array(
                    'post_type' => 'sotrudniki',
                    'post_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
//                        'author' => get_current_user_id(),
                    'meta_query' => array(
                        array(
                            'key' => 'id_s',
                            'compare' => '=',
                            'value' => get_current_user_id()
                        )
                    )
                ));
                while ($recomendData->have_posts()) {
                    $recomendData->the_post(); ?>
                    <!--                    <div class="ffoto"> --><?php //the_post_thumbnail(); ?><!--</div>-->
                    <?php acf_form(array('new_post' => true));
                }
                //            posts_nav_link();
                wp_reset_postdata();
                ?>
            </div>
            <div class="lMenuW myProfile"><h4><span class="dashicons dashicons-admin-users"></span>Профиль</h4>
            </div>
            <div class="lMenuW myC"><h4><span class="dashicons dashicons-portfolio"></span>Мои кандидаты</h4></div>
            <!--            <a href="--><?php //echo esc_url(site_url('/rekomendacziya')) ?><!--">-->
            <!--                <div class="lMenuW myV"><h4 if (is_page('rekomendacziya')) echo 'class = "left_menu_act"'; -->
            <div class="lMenuW myV"><h4><span class="dashicons dashicons-star-filled"></span>Сохраненные вакансии
                </h4>
            </div>
            <!--            </a>-->


            <?php
            $existStarStatus = 'no';
            if (is_user_logged_in()) {
                $existStar = new WP_Query(array(
//                'author' => get_current_user_id(),
                    'post_title' => get_current_user_id(),
                    'post_type' => 'notiajax',
                ));
                if ($existStar->found_posts) {
                    $existStarStatus = 'yes';
                }
            }
            ?>
            <div class="lMenuW myM" data-uid="<?php echo get_current_user_id(); ?>"
                 data-ld='<?php echo $existStar->posts[0]->ID; ?>'
                 data-exist='<?php echo $existStarStatus; ?>'>
                <h4><span class="dashicons dashicons-email"></span>Уведомления</h4><span id="numbMail"></span></div>
            <a href="<?php echo wp_logout_url(); ?>">
                <div class="lMenuW"><h4><span class="dashicons dashicons-arrow-left-alt"></span>Выйти из аккаунта
                    </h4>
                </div>
            </a>

        </div>
        <div class="right_vac sotr_right">
            <h5 class="myTitle">Мои данные</h5>
            <section class="sotr_personal">
                <?php
                $recomendData = new WP_Query(array(
                    'post_type' => 'sotrudniki',
                    'post_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
//                        'author' => get_current_user_id(),
                    'meta_query' => array(
                        array(
                            'key' => 'id_s',
                            'compare' => '=',
                            'value' => get_current_user_id()
                        )
                    )
                ));
                while ($recomendData->have_posts()) {
                    $recomendData->the_post(); ?>
                    <!--                    <div class="ffoto"> --><?php //the_post_thumbnail(); ?><!--</div>-->
                    <?php acf_form(array('new_post' => true));
                }
                //            posts_nav_link();
                wp_reset_postdata();
                ?>
            </section>

            <div class="mmr">
                <h1>my mailing</h1>
                <div id="loadRes"></div>
                <div class="" id="loadRes2">
                    <section>
                        <?php
                        $recomendData = new WP_Query(array(
                            'post_type' => 'notiajax',
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'author' => get_current_user_id(),
                        ));
                        while ($recomendData->have_posts()) {
                            $recomendData->the_post(); ?>
                            <div><input value="<?php echo esc_attr(get_the_title()); ?>"></div> <?php
                        }
                        //            posts_nav_link();
                        wp_reset_postdata();
                        ?>
                    </section>
                    <section class="">
                        <?php
                        $posts = get_posts(array(
                            'numberposts' => -1,
//            'category_name'    => 'soft_pets',
                            'orderby' => 'date',
                            'order' => 'ASC',
                            'post_type' => 'notification',
                            // 'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                        ));

                        foreach ($posts as $post) {
                            setup_postdata($post); ?>
                            <div class="mailUsr" data-usr="<?php $cand_ctegory = get_field('poluchatel');
                            foreach ($cand_ctegory as $k) {
                                echo $k->post_title;
                            }
                            ?>">
                                <!--                            <p>--><?php
                                //                                $cand_ctegory = get_field('poluchatel');
                                //                                foreach ($cand_ctegory as $k) {
                                //                                    echo $k->post_title;
                                //                                    ?><!--<span class="transp">a</span>-->
                                <!--                                    --><?php
                                //                                }
                                //                                ?>
                                <!--                            </p>-->
                                <p class="mail_theme">Тема уведомления: <?php the_title(); ?></p>
                                <div><?php the_content(); ?></div>
                            </div>

                            <?php
                        }

                        wp_reset_postdata(); // сброс
                        ?>
                        <!--                    --><?php
                        //                    $vacCompData = new WP_Query(array(
                        //                        'post_type' => 'notification',
                        //                        'post_per_page' => -1,
                        //                        'orderby' => 'title',
                        //                        'order' => 'ASC',
                        ////                       'author' => get_current_user_id(),
                        ////                        'meta_query' => array(
                        ////                            array(
                        ////                                'key' => 'cl_nmbr',
                        ////                                'compare' => '=',
                        ////                                'value' => get_current_user_id()
                        ////                            )
                        ////
                        ////                        )
                        //                    ));
                        //                    while ($vacCompData->have_posts()) {
                        //                        $vacCompData->the_post(); ?>
                        <!--                        <p>--><?php //the_title(); ?><!--</p>-->
                        <!--                        <p>--><?php
                        //                            $cand_ctegory = get_field('poluchatel');
                        //                            foreach ($cand_ctegory as $k) {
                        //                                echo $k->post_title;
                        //                                ?><!--<span class="transp">a</span>--><?php
                        //                            }
                        //                            ?>
                        <!--                        </p>-->
                        <!--                    --><?php
                        //                    }
                        //                    //            posts_nav_link();
                        //                    wp_reset_postdata();
                        //                    ?>
                    </section>
                </div>
                <div class="myVac">
                    <div class="sti si">
                        <input class="si i0" type="text" class="myInput" id="i0" placeholder="Искать по тексту"/>
                    </div>

                    <div class="vtabHead vacdetsep">
                        <p>Vacancie details</p>
                        <p>Client name</p>
                        <p>Date</p>
                    </div>
                    <div class="vac_descr">
                        <?php
                        $teamPageData = new WP_Query(array(
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'post_type' => 'vacancy',
                            'suppress_filters' => false,
                        )); ?>
                        <input readonly value="<?php echo $teamPageData->post_count; ?>" id="phpCount"
                               class="dp_post_count dnone"> <?php

                        while ($teamPageData->have_posts()) {
                            $teamPageData->the_post(); ?>
                            <div class="task-list-row vac_item vacdetsep"
                                 data-title="<?php the_title(); ?>"
                                 data-spec="<?php the_field(spec); ?>"
                                 data-angl="<?php the_field(angl); ?>"
                                 data-opyt="<?php the_field(opyt); ?>"
                                 data-zarplata="<?php the_field(zarplata); ?>"
                                 data-company="<?php the_field(vcompany); ?>"
                                 data-status="<?php the_field(vstatus); ?>"
                                 data-data="<?php the_field(data); ?>"
                                 data-framework="<?php  $fr_ctegory = get_field('frejmvork');
                                     foreach ($fr_ctegory as $fr) {
                                         echo $fr->post_title;
                                     }?>"
                                 data-work_format="<?php $cand_ctegory = get_field('format_raboty');
                                 foreach ($cand_ctegory as $k) {
                                     echo $k->post_title;
                                 } ?>"
                                 data-notech="<?php $cand_ctegory = get_field('notech_related');
                                 foreach ($cand_ctegory as $k) {
                                     echo $k->post_title;
                                 } ?>"
                                 data-city="<?php $cand_ctegory = get_field('gorod');
                                 foreach ($cand_ctegory as $k) {
                                     echo $k->post_title;
                                 } ?>"
                            >
                                <div class="vds1">
                                    <div class="vimgbox">
                                        <div class="vimg">
                                            <a href="<?php the_permalink(); ?>" class="vac_title"><img class=""
                                                                                                       src="<?php
                                                                                                       if (the_field('vimg')) {
                                                                                                           the_field('vimg');
                                                                                                       } ?>"
                                                                                                       alt="Vacancy Img"></a>
                                            <!--                            <img class="" src="--><?php
                                            //                            if(the_field('vimg')){
                                            //                                the_field('vimg');
                                            //                            } else { echo get_template_directory_uri() . '/assets/img/not-found.jpg'; } ?><!--" alt="Vacancy Img">-->

                                            <!--                        <p class="spec_v">-->
                                            <?php //the_field(spec); ?><!--</p>-->
                                        </div>
                                    </div>
                                    <div class="vmaintext">
                                        <h3><a href="<?php the_permalink(); ?>"
                                               class="vac_title"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="vdetails">
                                            <p>
                                                <?php
                                                $cand_ctegory = get_field('format_raboty');
                                                foreach ($cand_ctegory as $k) {
                                                    echo $k->post_title;
                                                    ?><span class="transp">a</span><?php
                                                }
                                                ?>,
                                            </p>
                                            <p><?php
                                                $cand_ctegory = get_field('gorod');
                                                foreach ($cand_ctegory as $k) {
                                                    echo $k->post_title;
                                                    ?><span class="transp">a</span><?php
                                                }
                                                ?>
                                            </p>
                                            <p> - <?php the_field(zarplata); ?>$</p>
                                            <p class="opyt_v"><?php the_field(opyt); ?> years of experience</p>
                                            <p> - <?php the_field(angl); ?> Eng</p>


                                        </div>

                                    </div>

                                </div>

                                <div class="vds2">
                                    <p><?php the_field(vcompany); ?></p>
                                </div>

                                <div class="vds3">
                                    <p><?php the_field(data); ?></p>
                                    <div><p class="vstatus"><?php the_field(vstatus); ?></p></div>
                                    <?php
                                    $vacId = get_the_ID();
                                    $starCount = new WP_Query(array(
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
                                    ?>
                                    <div class="starWrapp" data-exist='<?php echo $existStarStatus; ?>'
                                         data-vac="<?php echo $vacId ?>"
                                         data-star='<?php echo $existStar->posts[0]->ID; ?>'>
                                        <span class="dashicons dashicons-star-filled saveVac"></span>
                                        <!--                                <span class="starCount">-->
                                        <?php //echo $starCount->found_posts ?><!--</span>-->
                                        <!--                                <span> +-->
                                        <?php //echo $vacId ?><!--</span><span><span> = -->
                                        <?php //echo $existStarStatus ?><!--</span>-->
                                    </div>
                                </div>
                            </div>
                            <!--                <div>--><?php //the_content(); ?><!--</div>-->
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php get_template_part('template-parts/formAddCand'); get_footer(); ?>
