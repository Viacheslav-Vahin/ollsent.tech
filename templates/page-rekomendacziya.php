<?php
/*
Template Name: Рекомендация
*/
?>
<?php
if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}

acf_form_head();
get_header();
?>
<div class="dp_container rekomend">
<!-- <p><input name="event_date" id="date_a1" placeholder="День события" autocomplete="off" /></p> -->

    <!-- <canvas id="myChart" width="400" height="100"></canvas>
    <canvas id="chart2" width="400" height="100"></canvas> -->
    <!-- <canvas id="myChart" width="400" height="100"></canvas> -->
    
    <canvas id="chart2" width="400" height="1"></canvas>
    <div class="" id="tres8"><span id="cu6" class="dnone"><?php echo get_current_user_id(); ?></span><span id="surl6" class="dnone"><?php echo get_site_url() ?></span>

    </div>
    <div class="vac_wrap">
        <div class="left_vac left2">
            <div class="fimg">
                <?php
                $recomendData = new WP_Query(array(
                    'post_type' => 'freelcr',
                    'post_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'author' => get_current_user_id(),
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
            <div class="lMenuW myProfile"><h4><span class="dashicons dashicons-admin-users"></span>Профiль</h4></div>
            <div class="lMenuW myC"><h4><span class="dashicons dashicons-portfolio"></span>Мої кандидати</h4></div>
            <!--            <a href="--><?php //echo esc_url(site_url('/rekomendacziya')) ?><!--">-->
            <!--                <div class="lMenuW myV"><h4 if (is_page('rekomendacziya')) echo 'class = "left_menu_act"'; -->
            <div class="lMenuW myV"><h4><span class="dashicons dashicons-star-filled"></span>Мої вакансії</h4></div>
            <div class="lMenuW myO"><h4><span class="dashicons dashicons-money-alt"></span></span>Мої оффери</h4></div>
            <div class="lMenuW myA"><h4><span class="dashicons dashicons-chart-area"></span></span></span>Моя аналітика</h4></div>
            

            

            <?php
            $existStarStatus = 'no';
            if (is_user_logged_in()) {
                $existStar = new WP_Query(array(
                    'author' => get_current_user_id(),
                    'post_title' => get_current_user_id(),
                    'post_type' => 'notiajax',
                ));
                if ($existStar->found_posts) {
                    $existStarStatus = 'yes';
                }
            }
            ?>
            <div class="lMenuW myM" data-uid="<?php echo get_current_user_id(); ?>" data-ld='<?php echo $existStar->posts[0]->ID; ?>'
                 data-exist='<?php echo $existStarStatus; ?>'>
                <h4><span class="dashicons dashicons-email"></span>Повідомлення</h4><span id="numbMail"></span></div>
            <a href="<?php echo wp_logout_url(); ?>">
                <div class="lMenuW"><h4><span class="dashicons dashicons-arrow-left-alt"></span>Вийти із аккаунта</h4>
                </div>
            </a>

        </div>
        <div class="right_vac">
            <div class="mpr">
                <h5 class="myTitle">Мої дані</h5>
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
                    <div>
                        <label for="pd1">ПІБ:</label>
                        <input id="cf" type="text" class="pd fn">
                    </div>
                    <div>
                        <label for="pd2">Почта:</label>
                        <input type="text" class="pd fe">
                    </div>
                    <div>
                        <label for="pd3">Контактний номер:</label>
                        <input type="text" class="pd ftelef">
                    </div>
                    <div>
                        <label for="pd4">Telegram:</label>
                        <input type="text" class="pd fr">
                    </div>
                </div>
                <button class="fpsubmit" data-usrId="<?php echo get_current_user_id(); ?>"
                        data-exist='<?php echo $existStarStatus; ?>'>Створити</button>
                <span class="cuID dnone"><?php echo get_current_user_id(); ?></span>
                <section class="pdw">
                    <?php
                    //                $cu = get_current_user_id(); echo $cu;
                    //                global $recomendData;
                    $recomendData = new WP_Query(array(
                        'post_type' => 'freelcr',
                        'post_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
//                        'author' => get_current_user_id(),
                        'meta_query' => array(
                            array(
                                'key' => 'f_id',
                                'compare' => '=',
                                'value' => get_current_user_id()
                            )
                        )
                    ));
                    while ($recomendData->have_posts()) {
                        $recomendData->the_post(); ?>
                        <input class="dnone pd1" readonly type="text" value="<?php the_title(); ?>">
                        <input class="dnone pd2" readonly type="text" value="<?php the_field('f_email'); ?>">
                        <input class="dnone pd3" readonly type="text" value="<?php the_field('f_telef'); ?>">
                        <input class="dnone pd4" readonly type="text" value="<?php the_field('f_rekviz'); ?>">
                        <input type="number" class="dnone pd5" value="<?php the_ID(); ?>">
                        <!--                                                --><?php //acf_form(array('new_post' => true)); ?>
                        <?php
                    }
                    //            posts_nav_link();
                    wp_reset_postdata();
                    ?>
                    <h5 class="myTitle myT2">Змінити пароль</h5>
                    <?php echo do_shortcode('[changepassword_form]'); ?>

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
                             data-spec="<?php the_field('spec'); ?>"
                             data-angl="<?php the_field('angl'); ?>"
                             data-opyt="<?php the_field('opyt'); ?>"
                             data-zarplata="<?php the_field('zarplata'); ?>"
                             data-company="<?php the_field('vcompany'); ?>"
                             data-status="<?php the_field('vstatus'); ?>"
                             data-data="<?php the_field('data'); ?>"                            
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
                                        <a href="<?php the_permalink(); ?>" class="vac_title"><img class="" src="<?php
                                            if (the_field('vimg')) {
                                                the_field('vimg');
                                            } ?>" alt="Vacancy Img"></a>
                                        <!--                            <img class="" src="--><?php
                                        //                            if(the_field('vimg')){
                                        //                                the_field('vimg');
                                        //                            } else { echo get_template_directory_uri() . '/assets/img/not-found.jpg'; } ?><!--" alt="Vacancy Img">-->

                                        <!--                        <p class="spec_v">-->
                                        <?php //the_field(spec); ?><!--</p>-->
                                    </div>
                                </div>
                                <div class="vmaintext">
                                    <h3><a href="<?php the_permalink(); ?>" class="vac_title"><?php the_title(); ?></a>
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
                                        <p> - <?php the_field('zarplata'); ?>$</p>
                                        <p class="opyt_v"><?php the_field('opyt'); ?> years of experience</p>
                                        <p> - <?php the_field('angl'); ?> Eng</p>


                                    </div>

                                </div>

                            </div>

                            <div class="vds2">
                                <p><?php the_field('vcompany'); ?></p>
                            </div>

                            <div class="vds3">
                                <p><?php the_field('data'); ?></p>
                                <div><p class="vstatus"><?php the_field('vstatus'); ?></p></div>
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
            <!-- <div class="myOffers">
                
                    <h1>rrmm</h1>
                
            </div> -->
            <div class="myOffers">
                <div class="myCandW mch oh">
                    <p>Им'я</p>
                    <p>Деталі</p>
                    <p>Cтатус</p>
                    <p>Деталі</p>
                    <p>Виплати</p>
                    <button>Добавити реквізити</button>
                    <div class="rekv_form">
                        <?php
                        $recomendData = new WP_Query(array(
                            'post_type' => 'freelcr',
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'author' => get_current_user_id(),
                        ));
                        while ($recomendData->have_posts()) {
                            $recomendData->the_post(); ?>
                            <!--                    <div class="ffoto"> --><?php //the_post_thumbnail(); ?><!--</div>-->
                            <?php acf_form(array('new_post' => true));
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <section class="allmr">
                    <?php
                    //                $cu = get_current_user_id(); echo $cu;
                    //                global $recomendData;
                    $recomendData = new WP_Query(array(
                        'post_type' => 'rekomend',

                        'meta_key' => 'dataStart',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
//                    'author' => get_current_user_id(),
                        'meta_query' => array(
                            array(
                                'key' => 'user_r',
                                'compare' => '=',
                                'value' => get_current_user_id()
                            )

                        )
//                    'suppress_filters' => false,
                    ));
                    while ($recomendData->have_posts()) {
                        $recomendData->the_post(); ?>
                        <div class="myCandW mcd offer1" data-ofers="<?php the_field('status_r'); ?>">

                            <div class="mcName">
                                <a href="<?php the_permalink(); ?>"><input readonly type="text" class="kand_main_inf"
                                                                           value="<?php the_title(); ?>"></a>
                                <input readonly type="text" value="<?php the_field('email_r'); ?>">



                            </div>
                            <div class="mcd1">
                                <div><?php $cand_ctegory = get_field('spec1');
                                    foreach ($cand_ctegory as $k) {
                                        ?>
                                        <span class="spec1 kand_main_inf">
                                    <?php
                                    echo $k->post_title;
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>
                                </div>

                                <div><?php $spec2 = get_field('spec4');
                                    foreach ($spec2 as $s2) {
                                        ?>
                                        <span class="spec1">
                                    <?php
                                    echo $s2->post_title;
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>
                                </div>

                                <div><?php $spec3 = get_field('spec3');
                                    foreach ($spec3 as $s3) {
                                        ?>
                                        <span class="spec1">
                                    <?php
                                    echo $s3->post_title;
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>
                                </div>
                                <?php if (get_field('zarplata')): ?>
                                    <input readonly type="text" class="vdatewr"
                                           value="<?php the_field('zarplata'); ?>$">
                                <?php endif; ?>
                            </div>
                            <div class="mcs">
                                <p><?php the_field('status_r'); ?></p>
                            </div>
                            <div class="mcd2">
                                <p class="spec1 sp2"><?php the_field('spec2'); ?></p>
                                <p class="spec1"><?php the_field('kompaniya'); ?></p>
<!--                                <div class="spec1 kom2">--><?php //the_field(komment); ?><!--</div>-->
                            </div>
                            <div class="mcVuplaty">
                                <div>
                                    <?php if (get_field('vypl_1')): ?>
                                        <div class="vdatewr spec1"><?php the_field('vypl_1'); ?>$
                                            <p class="vdate spec1"><?php the_field('data_1'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (get_field('vypl_2')): ?>
                                        <div class="vdatewr spec1"><?php the_field('vypl_2'); ?>$</div>
                                        <p class="vdate spec1"><?php the_field('data_2'); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </section>
            </div>
            <div class="myAnalit">
                <div id="ainp">
                    <select class="" id="ayear">
                        <option value="">Выберить рік</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                        <option value="2031">2031</option>
                        <option value="2032">2032</option>
                    </select>
                    <!-- <select class="" id="amonth">
                        <option value="">Выберите месяц</option>
                        <option value="января">январь</option>
                        <option value="февраля">февраль</option>
                        <option value="марта">март</option>
                        <option value="апреля">апрель</option>
                        <option value="мая">май</option>
                        <option value="июня">июнь</option>
                        <option value="июля">июль</option>
                        <option value="августа">август</option>
                        <option value="сентября">сентябрь</option>
                        <option value="октября">октябрь</option>
                        <option value="ноября">ноябрь</option>
                        <option value="декабря">декабрь</option>
                    </select> -->
                </div>
                <div id="ares">
                    <?php
                        $recomendData = new WP_Query(array(
                            'post_type' => 'rekomend',

                            'meta_key' => 'dataStart',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'meta_query' => array(
                                array(
                                    'key' => 'user_r',
                                    'compare' => '=',
                                    'value' => get_current_user_id()
                                )

                            )
                        ));
                        while ($recomendData->have_posts()) {
                            $recomendData->the_post(); ?>
                            <div class="aitem" data-date2="<?php the_field('data_analitika'); ?>" data-status="<?php the_field('status_r'); ?>"
                            data-vupl1="<?php the_field('data_1'); ?>" data-vupl2="<?php the_field('data_2'); ?>">
                                <p><?php the_title() ?> <span><?php the_field('data_analitika'); ?></span><span>Статус: <?php the_field('status_r'); ?></span>
                                <?php
                                if(get_field('vypl_1')){ ?>
                                    <span> Виплата 1: <span class="vypl1"><?php the_field('vypl_1'); ?></span><span class="v1date"><?php the_field('data_1'); ?></span></span>
                            <?php }
                            if(get_field('vypl_2')){ ?>
                                <span> Виплата 2: <span class="vypl2"><?php the_field('vypl_2'); ?></span><span class="v2date"><?php the_field('data_2'); ?></span></span>
                                <?php }
                            ?>
                            </div>        
                        <?php
                        }
                    
                        wp_reset_postdata();
                    ?>
                </div>
                <div class="forChart1"></div>
                <div class="forChart2"></div>
            </div>
            <div class="mcr">
                <div class="myCandW mch">
                    <div class="mcfind">
                        <input type="text" class="myInput" placeholder="Шукати по тексту"/>                    
                    </div>
                    <div class="mcfind2">
                        <select class="fCss" id="findcstat">
                            <option value="">Усі Статуси</option>
                            <option value="Новий">Новий</option>
                            <option value="В роботі">В роботі</option>
                            <option value="Офер">Офер</option>
                            <option value="На паузе">На паузі</option>      
                        </select>
                        <select class="fCss" id="findcspec">
                            <option value="">Усі Спеціалізація</option>
                            <?php $countLang = 0;
                            $teamPageData = new WP_Query(array(
                                'post_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'post_type' => 'language',
                                'suppress_filters' => true,
                            ));
                            while ($teamPageData->have_posts()) {
                                $teamPageData->the_post();
                                $countLang++; ?>
                                <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                <?php
                            } ?>
                            <option class="countLang"><?php echo $countLang; ?></option> <?php
                            wp_reset_postdata();
                            ?>
                        </select>
                    </div>
                    <p>Им'я</p>
                    <p>Деталі</p>
                    <p>Cтатус</p>
                    <p>Деталі</p>
                    <p>Виплати</p>
                </div>
                <section class="allmr">
                    <?php
                    //                $cu = get_current_user_id(); echo $cu;
                    //                global $recomendData;
                    $recomendData = new WP_Query(array(
                        'post_type' => 'rekomend',

                        'meta_key' => 'dataStart',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
//                    'author' => get_current_user_id(),
                        'meta_query' => array(
                            array(
                                'key' => 'user_r',
                                'compare' => '=',
                                'value' => get_current_user_id()
                            )

                        )
//                    'suppress_filters' => false,
                    ));
                    while ($recomendData->have_posts()) {
                        $recomendData->the_post(); ?>
                        <div class="myCandW mcd kandItem"
                        data-name1 = "<?php the_field('imya'); ?>"
                        data-fam1 = "<?php the_field('familiya'); ?>"
                        data-tel1 = "<?php the_field('telegram'); ?>"
                        data-ema1 = "<?php the_field('email_r'); ?>"
                        data-spec1="<?php $cand_s1 = get_field('spec1');
                         foreach ($cand_s1 as $s1) {
                             echo $s1->post_title;
                         } ?>"
                         data-spec4="<?php $cand_s4 = get_field('spec4');
                         foreach ($cand_s4 as $s4) {
                             echo $s4->post_title;
                         } ?>"
                        data-spec3="<?php $cand_s3 = get_field('spec3');
                         foreach ($cand_s3 as $s3) {
                             echo $s3->post_title;
                         } ?>"
                         data-tip="<?php $cand_tipr = get_field('tip_raboty');
                         foreach ($cand_tipr as $tr) {
                             echo $tr->post_title;
                         } ?>"
                         data-engl1="<?php the_field('engl_r'); ?>"
                         data-reg1="<?php the_field('region'); ?>"
                         data-cit1="<?php $cand_cit1 = get_field('city_r');
                         foreach ($cand_cit1 as $c1) {
                             echo $c1->post_title;
                         } ?>"
                         data-stat1="<?php the_field('status_r'); ?>"
                        >

                            <div class="mcName">
                                <a href="<?php the_permalink(); ?>"><input readonly type="text" class="kand_main_inf" value="<?php the_title(); ?>"></a>
                                
                                <?php
                                    if(get_field('telegram')) {
                                        ?><p>Telegram: <?php the_field('telegram'); ?></p><?php
                                    } else {
                                        if(get_field('skype_r')){
                                            ?><p>Skype: <?php the_field('skype_r'); ?></p><?php
                                        }                                        
                                    }
                                    if(get_field('viber_r')) {
                                        ?><p>Viber: <?php the_field('viber_r'); ?></p><?php
                                    } else {                                
                                        if(get_field('email_r')){
                                            ?><p>Email: <?php the_field('email_r'); ?></p><?php
                                        } 
                                    }
                                    if(!get_field('telegram') && !get_field('skype_r')) {
                                        if(get_field('tel_r')){
                                            ?><p>Телефон: <?php the_field('tel_r'); ?></p><?php
                                        } 
                                    }
                                    if(!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                                        if(get_field('drugoe')){
                                            ?><p>Інше: <?php the_field('drugoe'); ?></p><?php
                                        } 
                                    }
                                ?>
                                <!-- <p><?php the_field('skype_r'); ?></p>
                                <p><?php the_field('email_r'); ?></p>
                                <p><?php the_field('tel_r'); ?></p>
                                <p><?php the_field('drugoe'); ?></p> -->



                            </div>
                            <div class="mcd1">
                                <div><?php $cand_ctegory = get_field('spec1');
                                    foreach ($cand_ctegory as $k) {
                                        ?>
                                        <span class="spec1 kand_main_inf">
                                    <?php
                                    echo $k->post_title;
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>
                                </div>

                                <div><?php $spec2 = get_field('spec4');
                                    foreach ($spec2 as $s2) {
                                        ?>
                                        <span class="spec1">
                                    <?php
                                    echo $s2->post_title;
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>
                                </div>

                                <div><?php $spec3 = get_field('spec3');
                                    foreach ($spec3 as $s3) {
                                        ?>
                                        <span class="spec1">
                                    <?php
                                    echo $s3->post_title;
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>
                                </div>
                                <?php if (get_field('zarplata')): ?>
                                    <input readonly type="text" class="vdatewr"
                                           value="<?php the_field('zarplata'); ?>$">
                                <?php endif; ?>
                            </div>
                            <div class="mcs">
                                <p><?php the_field('status_r'); ?></p>
                            </div>
                            <div class="mcd2">
                                <p class="spec1 sp2"><?php the_field('spec2'); ?></p>
                                <p class="spec1"><?php the_field('kompaniya'); ?></p>
<!--                                <div class="spec1 kom2">--><?php //the_field(komment); ?><!--</div>-->
                            </div>
                            <div class="mcVuplaty">
                                <div>
                                    <?php if (get_field('vypl_1')): ?>
                                        <div class="vdatewr spec1"><?php the_field('vypl_1'); ?>$
                                            <p class="vdate spec1"><?php the_field('data_1'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <?php if (get_field('vypl_2')): ?>
                                        <div class="vdatewr spec1"><?php the_field('vypl_2'); ?>$</div>
                                        <p class="vdate spec1"><?php the_field('data_2'); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </section>
            </div>
            <div class="mmr">
                <h1>my mailing</h1>
                <div id="loadRes"></div>
                <div class="dnone" id="loadRes2">
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
            </div>
        </div>


        <!--    -->
        <section class="rek_wrap">
            <!--            <form class="createRek rekom_item" enctype="multipart/form-data">-->
            <!--    <section class="createRek rekom_item" enctype="multipart/form-data">-->
            <!--                <form class="createRek rekom_item" enctype="application/x-www-form-urlencoded | multipart/form-data | text/plain">-->
            <!--        <h2 class="rt">Create new Rek</h2>-->
            <!--        <input class="nrt" type="text" placeholder="Имя и фамилия кандидата">-->
            <!--        <input class="nr2" type="text" placeholder="Имейл кандидата">-->
            <!--        <input class="nr5" type="text" placeholder="Телефон кандидата">-->
            <!--        <input type="file" class="nr3">-->
            <!--        <input class="nr4" type="text" placeholder="Специальность">-->
            <!--        <input class="nr6" type="number" placeholder="Зарплата">-->
            <!--        <button class="submitNewRek">Create Rek <span class="dashicons dashicons-database-import"></span></button>-->
            <!--    </section>-->
        </section>


        <article class="rek_wrap rek_from_db">
            <?php
            $rekomPageData = new WP_Query(array(
                'post_per_page' => -1,
                'post_type' => 'rekomend',
                'meta_key' => 'dataStart',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',

                'author' => get_current_user_id(),
//            'suppress_filters' => true,
            ));
            while ($rekomPageData->have_posts()) {
                $rekomPageData->the_post(); ?>
                <section class="rekom_item" data-id="<?php the_ID(); ?>" enctype="multipart/form-data">
                    <p><?php the_field('dataStart') ?></p>
                    <h4><?php echo esc_attr(get_the_author()); ?></h4>
                    <input readonly class="rt"
                           value="<?php echo str_replace('Личное: ', '', esc_attr(get_the_title())); ?>">
                    <span class="re"><span class="dashicons dashicons-edit"></span> Edit</span>
                    <span class="rd"><span class="dashicons dashicons-trash"></span> Delete</span>
                    <p>Статус: <span class="statusFomDB"><?php
                            $statusWrapper = get_field('status_r');
                            if (!empty($statusWrapper)) {
                                echo get_field('status_r');
                            } else {
                                echo 'Новий';
                            }

                            //                        $statusFromDB = the_field(status_r); ?>
                    </span></p>
                    <!--            <input readonly class="r1" value="-->
                    <?php //echo esc_attr(get_the_content()); ?><!--">-->
                    <input readonly class="r2" value="<?php echo esc_attr(get_field('email_r')); ?>">
                    <input readonly class="r5" value="<?php echo esc_attr(get_field('tel_r')); ?>"
                           placeholder="Метод коммуникации (название)">
                    <!--            <input type="file" readonly class="r3" value="-->
                    <?php //echo esc_attr(get_field(resume_r)); ?><!--">-->
                    <input readonly class="r4" value="<?php echo esc_attr(get_field('spec1')); ?>"
                           placeholder="Специализация">
                    <input type="number" readonly class="r6" value="<?php echo esc_attr(get_field('zarplata')); ?>"
                           placeholder="Ожидаемая зарплата">
                    <div class="rSave">Save <span class="dashicons dashicons-database-view"></span></div>
                </section>
                <?php
            }
            wp_reset_postdata();
            ?>
        </article>
    </div>
</div>
<?php if (is_user_logged_in() && current_user_can('publish_freelancers')) { 
get_template_part('template-parts/formAddCand'); }
get_footer(); ?>

<!-- <h1>my mailing</h1> -->
<div id="loadRes"></div>
<div class="dnone" id="loadRes2">
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

                <p class="mail_theme">Тема повідомлення: <?php the_title(); ?></p>
                <div><?php the_content(); ?></div>
            </div>

            <?php
        }

        wp_reset_postdata(); // сброс
        ?>
        ?>
    </section>
</div>
