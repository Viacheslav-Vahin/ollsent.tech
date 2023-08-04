<?php
/*
Template Name: Кабинет Клиента
*/
if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
acf_form_head();
get_header();
?>
    <div class="dp_container client_vac">
        <div class="" id="tres8"><span id="cu6" class="dnone"><?php echo get_current_user_id(); ?></span>
        <span id="surl6" class="dnone"><?php echo get_site_url() ?></span>
            <div class="vac_wrap">
                <div class="left_vac left2">
                    <div class="fimg">
                        <?php
                        $vacCompData = new WP_Query(array(
                            'post_type' => 'client',
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
//                       'author' => get_current_user_id(),
                            'meta_query' => array(
                                array(
                                    'key' => 'cl_nmbr',
                                    'compare' => '=',
                                    'value' => get_current_user_id()
                                )

                            )
                        ));
                        while ($vacCompData->have_posts()) {
                            $vacCompData->the_post(); ?>                            
                            <!--                    <div class="ffoto"> --><?php //the_post_thumbnail(); ?><!--</div>-->
                            <?php acf_form(array('new_post' => true));
                        }
                        //            posts_nav_link();
                        wp_reset_postdata();
                        ?>
                    </div>
                    <!--                <div class="fimg">-->
                    <!--                <img src="-->
                    <?php //echo bloginfo('template_url'); ?><!--/assets/img/proces/1.jpg" alt="img 1">-->
                    <!--                </div>-->
                    <div class="lMenuW myProfile"><h4><span class="dashicons dashicons-admin-users"></span>Профиль</h4>
                    </div>
                    <div class="lMenuW myC"><h4><span class="dashicons dashicons-portfolio"></span>Мои вакансии</h4>
                    </div>
                    <div class="lMenuW myV"><h4><span class="dashicons dashicons-star-filled"></span>Кандидаты</h4>
                    </div>
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
                        <h4><span class="dashicons dashicons-email"></span>Уведомления</h4><span id="numbMail"></span>
                    </div>
                    <a href="<?php echo wp_logout_url(); ?>">
                        <div class="lMenuW"><h4><span class="dashicons dashicons-arrow-left-alt"></span>Выйти из
                                аккаунта
                            </h4>
                        </div>
                    </a>
                </div>
                <div class="right_vac clientPD">
                    <div class="mpr">
                        <h5 class="myTitle">Мои данные<span class="dashicons dashicons-arrow-down-alt2 tran"></span>
                        </h5>
                        <!--                    --><?php //while ( have_posts() ) : the_post(); ?>
                        <!--                        --><?php //acf_form(array(
                        //                            'post_id'       => 'new_post',
                        //                            'new_post'      => array(
                        //                                'post_type'     => 'client',
                        //                                'post_status'   => 'publish'
                        //                            ),
                        //                            'submit_value'  => 'Сохранить данные'
                        //                        )); ?>
                        <!--                    --><?php //endwhile; ?>
                        <section class="cdet">
                            <?php
                                $posts = get_posts(array(
                                    'numberposts' => 1,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    // 'meta_key' => '',
                                    
                                    // 'meta_value' => '',
                                    'post_type' => 'client',
                                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                    'meta_query' => array(
                                        array(
                                            'key' => 'cl_nmbr',
                                            'compare' => '=',
                                            'value' => get_current_user_id()
                                        )

                                    )
                                ));

                                foreach ($posts as $post) {
                                    setup_postdata($post); ?>
                                    <?php acf_form(array(
                                    'post_title'    => true,
        //                            'post_content'  => false,
                                        'submit_value' => __('Сохранить данные')
                                    )); ?>
                                <?php }

                                wp_reset_postdata();
                            ?>
                        </section>
                        <!--                    --><?php
                        //                    $posts = get_posts( array(
                        //                        'numberposts' => 1,
                        //                        'orderby'     => 'date',
                        //                        'order'       => 'DESC',
                        //                        'meta_key'    => '',
                        //                        'meta_value'  =>'',
                        //                        'post_type'   => 'client',
                        //                        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                        //                    ) );
                        //
                        //                    foreach( $posts as $post ){
                        //                        setup_postdata($post); ?>
                        <!--                        <p>--><?php //the_field(tip_comp); ?><!--</p>-->
                        <!--                        <p>--><?php //the_field(com_comp); ?><!--</p>-->
                        <!--                        <p>--><?php //the_field(ofisy); ?><!--</p>-->
                        <!--                        <p><a href="-->
                        <?php //the_field(site_comp); ?><!--">Сайт компании</a></p>-->
                        <!--                        <p>--><?php //the_field(about_comp); ?><!--</p>-->
                        <!--                    --><?php //}
                        //
                        //                    wp_reset_postdata();
                        //                    ?>
                        <section class="rpdc">
                            <div class="compgrid">
                                <?php
                                $vacCompData = new WP_Query(array(
                                    'post_type' => 'client',
                                    'post_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
    //                       'author' => get_current_user_id(),
                                    'meta_query' => array(
                                        array(
                                            'key' => 'cl_nmbr',
                                            'compare' => '=',
                                            'value' => get_current_user_id()
                                        )

                                    )
                                ));
                                while ($vacCompData->have_posts()) {
                                    $vacCompData->the_post(); ?>
                                    <div class="left1">
                                        <h3><span class="dashicons dashicons-admin-home"></span> <?php the_title(); ?></h3>                                
                                        <p><span class="dashicons dashicons-flag"></span> <?php the_field(osnovana); ?></p>
                                        <p><span class="dashicons dashicons-image-filter"></span> <?php the_field(tip_comp); ?></p>
                                        <p><span class="dashicons dashicons-businessperson"></span> <?php the_field(com_comp); ?></p>
                                        <p><span class="dashicons dashicons-plugins-checked"></span> <?php the_field(min_size); ?></p>
                                        <p><span class="dashicons dashicons-clock"></span> <?php the_field(avg_rate); ?></p>
                                        <p><span class="dashicons dashicons-admin-site-alt3"></span> <a href="<?php the_field(site_comp); ?>">Сайт компании</a></p>
                                    </div>                                
                                    <div class='right1'>
                                        <?php 
                                        $ofisy = get_field('ofisy');
                                        foreach ($ofisy as $o) {
                                        ?><div class="of1"><?php echo $o->post_title; ?></div><?php                                       
                                        }
                                        ?>
                                        <div class="compd"><?php the_field(about_comp); ?></div>                                      
                                        <div class="sfery"><?php the_field(sfery); ?></div>                                      
                                        <div class="clients1"><?php the_field(nashi_klienty); ?></div>                                       
                                    </div>                             
                                    <?php
                                }
                                //            posts_nav_link();
                                wp_reset_postdata();
                                ?>
                            </div>
                            <h5 class="myTitle myT2">Изменение пароля</h5>
                                    <?php echo do_shortcode('[changepassword_form]'); ?>
                        </section>
                        <div class="mpd">
                            <?php
                            //                    $vacId = get_the_ID();
                            //                    $starCount = new WP_Query(array(
                            //                        'post_type' => 'freelcr',
                            //                        'meta_query' => array(
                            //                            array(
                            //                                'key' => 'my_vac_id',
                            //                                'compare' => '=',
                            //                                'value' => $vacId
                            //                            )
                            //                        )
                            //                    ));
                            $existStarStatus = 'no';
                            if (is_user_logged_in()) {
                                $existStar = new WP_Query(array(
                                    'author' => get_current_user_id(),
                                    'post_type' => 'freelcr',
                                    'meta_query' => array(
//                                array(
//                                    'key' => 'f_id',
//                                    'compare' => '=',
//                                    'value' => get_current_user_id()
//                                )
                                    )
                                ));
                                if ($existStar->found_posts) {
                                    $existStarStatus = 'yes';
                                }
                            }
                            ?>

                        </div>
                        <!--                    <button class="fpsubmit" data-usrId="-->
                        <?php //echo get_current_user_id(); ?><!--"-->
                        <!--                            data-exist='--><?php //echo $existStarStatus; ?><!--'>Создать-->
                        <!--                    </button>-->
                        <span class="cuID dnone"><?php echo get_current_user_id(); ?></span>
                        <!--                    <section class="pdw">-->
                        <!--                        --><?php
                        //                        $recomendData = new WP_Query(array(
                        //                            'post_type' => 'client',
                        //                            'post_per_page' => -1,
                        //                            'orderby' => 'title',
                        //                            'order' => 'ASC',
                        //                            'author' => get_current_user_id(),
                        //                        ));
                        //                        while ($recomendData->have_posts()) {
                        //                            $recomendData->the_post(); ?>
                        <!--
                                                 --><?php //acf_form(array('new_post' => true));
                        //                        }
                        //                        //            posts_nav_link();
                        //                        wp_reset_postdata();
                        //                        ?>
                        <!--                        <h5 class="myTitle myT2">Изменение пароля</h5>-->
                        <!--                        --><?php //echo do_shortcode('[changepassword_form]'); ?>
                        <!--                    </section>-->
                    </div>
                    <div class="mcr">
                        <div class="myVacDW mch compv1">
                            <p>Детали вакансии</p>
                            <p class="center1">Дата</p>
                            <p class="center1">Cтатус</p>
                            <p>Кандидаты</p>
                        </div>
                        <section class="allmr">
                            <div class="vac_descr">
                                <?php
                                $teamPageData = new WP_Query(array(
                                    'post_per_page' => -1,
                                    'post_type' => 'vacancy',
                                    'meta_key' => 'dataStart',
                                    'orderby' => 'meta_value_num',
                                    'order' => 'DESC',
//                                'author' => get_current_user_id(),
                                    'meta_query' => array(
                                        array(
                                            'key' => 'user_v',
                                            'compare' => '=',
                                            'value' => get_current_user_id()
                                        )

                                    ),
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

                                        <div class="vmaintext">
                                            <h3><a href="<?php the_permalink(); ?>"
                                                   class="vac_title"><?php the_title(); ?></a></h3>
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


                                        <div class="vds2">
                                            <!--                                        <p>-->
                                            <?php //the_field(vcompany); ?><!--</p>-->
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
                                                <span class="candForVac"><span><?php the_field(c_num); ?></span></span>
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
                        </section>
                    </div>
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
                                <input class="si i0" type="text" class="myInput" id="i0"
                                       placeholder="Искать по тексту"/>
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
    </div>
<?php get_template_part('template-parts/formAddVac') ?>
<?php get_footer(); ?>