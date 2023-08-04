<?php
/*
Template Name: Рекрутер
*/
if (!current_user_can('administrator') && !current_user_can('editor') && !current_user_can('publish_sotrudnikis')) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
acf_form_head();
get_header();
?>
    <div class="dp_container timlid">
        <div class="cc loadRes3 dnone" id=""></div>
        <?php $curUsr = 'Gonch';
        $exHot0 = new WP_Query(array(
            'post_title' => get_current_user_id(),
            'post_type' => 'notiHot',
        ));
        while ($exHot0->have_posts()) {
            $exHot0->the_post(); ?>
            <p class="openNotif0 dnone"><?php the_field('openN') ?></p>
        <?php }
        wp_reset_postdata();
        ?>
        <!-- <p class="openNotif">open notif</p> -->
        <canvas id="chart2" width="400" height="1"></canvas>
        <div class="" id="tres8"><span id="cu6" class="dnone"><?php echo get_current_user_id(); ?></span><span id="surl6"
                                                                                                               class="dnone"><?php echo get_site_url() ?></span>
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
                            $recomendData->the_post();

                            ?><span id="cutask" class="dnone"><?php $curUsr = the_id(); ?></span><?php
                            acf_form(array('new_post' => true));
                        }
                        //            posts_nav_link();
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="lMenuW myProfile">
                        <h4><span class="dashicons dashicons-admin-users"></span>Профіль</h4>
                    </div>
                    <!-- <div class="lMenuW pipeline">
                        <h4><span class="dashicons dashicons-edit-page"></span></span>Pipe line</h4>
                    </div> -->
                    <div class="lMenuW myTasks">
                        <h4><span class="dashicons dashicons-media-document"></span></span>Мої задачі</h4>
                    </div>
                    <div class="lMenuW myC">
                        <h4><span class="dashicons dashicons-portfolio"></span>Мої кандидати</h4>
                    </div>
                    <!--            <a href="--><?php //echo esc_url(site_url('/rekomendacziya')) ?>
                    <!--">-->
                    <!--                <div class="lMenuW myV"><h4 if (is_page('rekomendacziya')) echo 'class = "left_menu_act"'; -->
                    <div class="lMenuW myV">
                        <h4><span class="dashicons dashicons-star-filled"></span>Мої вакансії</h4>
                    </div>
                    <div class="lMenuW myO">
                        <h4><span class="dashicons dashicons-money-alt"></span></span>Мої оффери</h4>
                    </div>
                    <div class="lMenuW myA">
                        <h4><span class="dashicons dashicons-chart-area"></span></span></span>Моя аналітика</h4>
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
                    $existHot = 'no';
                    if (is_user_logged_in()) {
                        $exHot = new WP_Query(array(
                            'post_title' => get_current_user_id(),
                            'post_type' => 'notiHot',
                        ));
                        if ($exHot->found_posts) {
                            $existHot = 'yes';
                        }
                        while ($exHot->have_posts()) {
                            $exHot->the_post(); ?>
                            <p class="hotTime dnone"><?php the_field('modify_date') ?></p>
                        <?php }
                        wp_reset_postdata();
                    }
                    ?>
                    <div class="lMenuW myM" data-uid="<?php echo get_current_user_id(); ?>"
                         data-ld='<?php echo $existStar->posts[0]->ID; ?>' data-exist='<?php echo $existStarStatus; ?>'
                         data-hot='<?php echo $exHot->posts[0]->ID; ?>'

                         data-exist2='<?php echo $existHot; ?>'
                    >
                        <h4><span class="dashicons dashicons-email"></span>Повідомлення</h4><span id="numbMail"></span><span id="numbHot">5</span>
                        <span id="numbHot5"></span>
                    </div>
                    <div class="lMenuW myFAQ">
                        <h4><span class="dashicons dashicons-chart-area"></span></span></span>FAQ</h4>
                    </div>
                    <a href="<?php echo wp_logout_url(); ?>">
                        <div class="lMenuW">
                            <h4><span class="dashicons dashicons-arrow-left-alt"></span>Вийти із акаунта
                            </h4>
                        </div>
                    </a>

                </div>

                <div class="right_vac sotr_right">
                    <!-- <span> <?php print_r ($exHot->posts[0]); ?> </span> -->
                    <section class="sotr_personal mpr">
                        <h5 class="myTitle">Мої дані</h5>
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
                            <!--                    <div class="ffoto"> --><?php //the_post_thumbnail(); ?>
                            <!--</div>-->
                            <?php acf_form(array('new_post' => true));
                        }
                        //            posts_nav_link();
                        wp_reset_postdata();
                        ?>
                        <h5 class="myTitle myT2">Изменение пароля</h5>
                        <?php echo do_shortcode('[changepassword_form]'); ?>
                    </section>
                    <div class="tasksData">
                        <h1>Мои задачи</h1>
                        <div id="loadCalend"></div>
                    </div>
                    <div class="faqData">
                        <div class="faqfind">
                            <input type="text" class="myInput" placeholder="Шукати по тексту" />
                        </div>
                        <div class="faq1">
                            <?php
                            $recomendData = new WP_Query(array(
                                'post_type' => 'faq',
                                'post_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
//                        'author' => get_current_user_id(),

                            ));
                            while ($recomendData->have_posts()) {
                                $recomendData->the_post(); ?>
                                <div class="itemW" data-faq1="<?php the_title() ?>">
                                    <div class="faqItem">
                                        <div class="faq_bgr" data-popup="closeFAQ"></div>
                                        <div class="faqAnsw">
                                            <div class="fainn">
                                                <h2><?php the_title() ?></h2>
                                                <button type="button" class="close-modal faqClose">×</button>
                                                <?php the_field('pravila_i_usloviya') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <a data-popup="open4" class="faqOpen"><?php the_title(); ?></a>
                                </div>
                                <?php
                            }
                            //            posts_nav_link();
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <div class="mcr">
                        <span class="dnone"><?php $cuPipe=get_current_user_id(); echo $cuPipe; ?></span>
                        <?php $rekrId = ''; ?>
                        <?php
                        $teamPageData = new WP_Query(array(
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'post_type' => 'sotrudniki',
                            'suppress_filters' => true,
                            'meta_query' => array(
                                array(
                                    'key' => 'id_s',
                                    'compare' => '=',
                                    'value' => get_current_user_id()
                                )
                            )
                        ));
                        while ($teamPageData->have_posts()) {
                            $teamPageData->the_post(); ?>
                            <p class="dnone"><?php $rekrId = get_field('id_s'); echo $rekrId; ?></p>
                            <p class="dnone"><?php $rekrId = get_the_ID(); echo $rekrId; ?></p>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>

                        <div class="myCandW mch">
                            <p class="ownPipe">Особистий Pipeline</p>
                            <div class="mcfind">
                                <input type="text" class="myInput" placeholder="Шукати по тексту" />
                            </div>
                            <div class="mcfind3">
                                <select class="fCss" id="findcstat">
                                    <option value="">Все Статусы</option>
                                    <option value="Новий">Новий</option>
                                    <option value="В роботі">В роботі</option>
                                    <option value="Офер">Офер</option>
                                    <option value="На паузе">На паузе</option>
                                </select>
                                <select class="fCss" id="findcspec">
                                    <option value="">Все Специализация</option>
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
                            <p>Имя</p>
                            <p>Детали</p>
                            <p>Cтатус</p>
                            <!-- <p>Детали</p>
                            <p>Выплаты</p> -->
                        </div>
                        <section class="allmr pipe1">
                            <?php $current_user_id = get_current_user_id();
                            $favorite_candidates = get_field('favorite_candidates', 'user_' . $current_user_id);

                            $favorite_candidate_ids = array();
                            if ($favorite_candidates) {
                                foreach ($favorite_candidates as $favorite_candidate) {
                                    $favorite_candidate_ids[] = $favorite_candidate->ID;
                                }
                            }

                            $rekomend_query_args = array(
                                'post_type' => 'rekomend',
                                'meta_key' => 'dataStart2',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'user_r',
                                        'compare' => '=',
                                        'value' => $current_user_id
                                    ),
                                    array(
                                        'key' => 'status_r',
                                        'compare' => 'NOT IN',
                                        'value' => array('Особистий')
                                    ),
                                )
                            );

                            $rekomend_query = new WP_Query($rekomend_query_args);

                            $candidate_query_args = array(
                                'post_type' => 'candidate',
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post__in' => $favorite_candidate_ids
                            );

                            $candidate_query = new WP_Query($candidate_query_args);

                            $combined_posts = array_merge($rekomend_query->posts, $candidate_query->posts);

                            // Далее вы можете использовать $combined_posts для вывода результатов


                            while ($combined_posts->have_posts()) {
                            $combined_posts->the_post();?>
                            <div class="myCandW mcd kandItem"
                                 data-name1="<?php the_field('imya'); ?>"
                                 data-id="<?php the_ID(); ?>" data-fam1="<?php the_field('familiya'); ?>" data-pipe="own2"
                                 data-tel1="<?php the_field('telegram'); ?>" data-ema1="<?php the_field('email_r'); ?>"
                                 data-spec1="<?php $cand_s1 = get_field('spec1');
                                 foreach ($cand_s1 as $s1) {
                                     echo $s1->post_title;
                                 } ?>" data-spec4="<?php $cand_s4 = get_field('spec4');
                            foreach ($cand_s4 as $s4) {
                                echo $s4->post_title;
                            } ?>" data-spec3="<?php $cand_s3 = get_field('spec3');
                            foreach ($cand_s3 as $s3) {
                                echo $s3->post_title;
                            } ?>" data-work_format="<?php $cand_tipr = get_field('tip_raboty');
                            foreach ($cand_tipr as $tr) {
                                echo $tr->post_title;
                            } ?>" data-angl="<?php the_field('engl_r'); ?>" data-reg1="<?php the_field('region'); ?>"
                                 data-zar="<?php the_field('zarplata'); ?>" data-cit1="<?php $cand_cit1 = get_field('city_r');
                            foreach ($cand_cit1 as $c1) {
                                echo $c1->post_title;
                            } ?>" data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
                                 data-compn="<?php the_field('kompaniya'); ?>" <?php $timedb = get_field('dataStart0');
                                 if($timedb){
                                 ?>data-timedb="<?php echo $timedb; ?>" <?php
                                 }else{ ?>data-timedb="0"<?php }
                            ?>
                            <div class="mcName">-->
                                <?php
                                $timedb = get_field('dataStart2');
                                if($timedb){
                                    ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                }else{ ?><input class="time_db" type="number" value="0"><?php }
                                ?>
                                <script>console.log('dd13');</script>
                                <a href="<?php the_permalink(); ?>">
                                    <p class=""><?php the_field('imya'); ?> <?php the_field('familiya'); ?></p>
                                </a>
                                <p class="spec1"><?php the_field('region'); ?></p>
                                <?php $city = get_field('city_r');
                                if (is_array($city) || is_object($city))
                                {
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
                                } ?>
                                <p class="spec1">Linkedin: <?php the_field('linkedin'); ?></p>
                                <?php
                                if(get_field('telegram')) {
                                    ?><p class="spec1">Telegram: <?php the_field('telegram'); ?></p><?php
                                } else {
                                    if(get_field('skype_r')){
                                        ?><p class="spec1">Skype: <?php the_field('skype_r'); ?></p><?php
                                    }
                                }
                                if(get_field('viber_r')) {
                                    ?><p class="spec1">Viber: <?php the_field('viber_r'); ?></p><?php
                                } else {
                                    if(get_field('email_r')){
                                        ?><p class="spec1">Email: <?php the_field('email_r'); ?></p><?php
                                    }
                                }
                                if(!get_field('telegram') && !get_field('skype_r')) {
                                    if(get_field('tel_r')){
                                        ?><p class="spec1">Телефон: <?php the_field('tel_r'); ?></p><?php
                                    }
                                }
                                if(!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                                    if(get_field('drugoe')){
                                        ?><p class="spec1">Другое: <?php the_field('drugoe'); ?></p><?php
                                    }
                                }
                                ?>
                                <p><?php the_field('skype_r'); ?></p>
                                <p><?php the_field('email_r'); ?></p>
                                <p><?php the_field('tel_r'); ?></p>
                                <p><?php the_field('drugoe'); ?></p>



                            </div>
                            <div class="mcd1">
                                <div>
                                    <?php $cand_ctegory = get_field('spec1');
                                    if (is_array($cand_ctegory) || is_object($cand_ctegory))
                                    {
                                        foreach ($cand_ctegory as $k) {
                                            ?>
                                            <span class="spec1 kand_main_inf">
                                        <?php
                                        echo $k->post_title;
                                        ?>
                                        <span class="dnone">a</span></span>
                                            <?php
                                        }
                                    } ?>
                                </div>

                                <div>
                                    <?php
                                    $spec2 = get_field('spec4');
                                    if (is_array($spec2) || is_object($spec2))
                                    {
                                        foreach ($spec2 as $s2) {
                                            ?>
                                            <span class="spec1">
                                                <?php
                                                echo $s2->post_title;
                                                ?>
                                                <span class="dnone">a</span></span>
                                            <?php
                                        }
                                    } ?>
                                </div>

                                <div>
                                    <?php
                                    $spec3 = get_field('spec3');
                                    if (is_array($spec3) || is_object($spec3))
                                    {
                                        foreach ($spec3 as $s3) {
                                            ?>
                                            <span class="spec1">
                                        <?php
                                        echo $s3->post_title;
                                        ?>
                                        <span class="dnone">a</span></span>
                                            <?php
                                        }
                                    } ?>
                                </div>
                                <?php if (get_field('zarplata')): ?>
                                    <p class="vdatewr"><?php the_field('zarplata'); ?>$</p>
                                <?php endif; ?>
                            </div>
                            <div class="mcs">
                                <p><?php the_field('status_r'); ?></p>
                            </div>
                            <div class="mcd2">
                                <p class="spec1 sp2"><?php the_field('spec2'); ?></p>
                                <p class="spec1"><?php the_field('kompaniya'); ?></p>
                                <div class="spec1 kom2"><?php //the_field(komment); ?>
                                </div>
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
                    <section class="allmr pipe2">
                        <p id="surl7" class="dnone"><?php echo get_site_url() ?></p>
                        <div id="eventBox" class="dnone"></div>
                        <div id="moveToRekr">
                            <h2 data-rekr="<?php $cu = get_current_user_id(); echo $cu; ?>">
                                Забрать <span id="cName"></span> на вакансию<span class="close1">×</span></h2>

                            <select class="" id="mVac">
                                <option value=0>Вакансии</option>
                                <?php
                                $teamPageData = new WP_Query(array(
                                    'post_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post_type' => 'vacancy',
                                    'suppress_filters' => true,
                                ));
                                while ($teamPageData->have_posts()) {
                                    $teamPageData->the_post(); ?>
                                    <!-- <p><?php the_title(); ?> <span><?php echo get_the_ID(); ?></span></p> -->
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
                                    <option data-exist='<?php echo $existStarStatus; ?>' value="<?php echo get_the_ID(); ?>"
                                            class="vacOption"><?php the_title(); ?></option>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>
                            </select>
                            <button type="submit" id="saveMove">Сохранить</button>
                        </div>
                        <?php $recomendData = new WP_Query(array(
                            'post_type' => 'rekomend',
                            'meta_key' => 'dataStart0',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'meta_query' => array(
                                array(
                                    'key' => 'rekrutyor',
                                    'compare' => 'LIKE',
                                    'value' => $rekrId
                                ),
                                array(
                                    'key' => 'status_r',
                                    'compare' => 'IN',
                                    'value' => array('Особистий')
                                )
                            )
                        ));
                        while ($recomendData->have_posts()) {
                            $recomendData->the_post(); ?>
                            <div class="myCandW mcd kandItem1" data-name1="<?php the_field('imya'); ?>"
                                 data-id="<?php the_ID(); ?>" data-pipe="own" data-fam1="<?php the_field('familiya'); ?>"
                                 data-tel1="<?php the_field('telegram'); ?>" data-ema1="<?php the_field('email_r'); ?>"
                                 data-spec1="<?php $cand_s1 = get_field('spec1');
                                 foreach ($cand_s1 as $s1) {
                                     echo $s1->post_title;
                                 } ?>" data-spec4="<?php $cand_s4 = get_field('spec4');
                            foreach ($cand_s4 as $s4) {
                                echo $s4->post_title;
                            } ?>" data-spec3="<?php $cand_s3 = get_field('spec3');
                            foreach ($cand_s3 as $s3) {
                                echo $s3->post_title;
                            } ?>" data-work_format="<?php $cand_tipr = get_field('tip_raboty');
                            foreach ($cand_tipr as $tr) {
                                echo $tr->post_title;
                            } ?>" data-angl="<?php the_field('engl_r'); ?>" data-reg1="<?php the_field('region'); ?>"
                                 data-zar="<?php the_field('zarplata'); ?>" data-cit1="<?php $cand_cit1 = get_field('city_r');
                            foreach ($cand_cit1 as $c1) {
                                echo $c1->post_title;
                            } ?>" data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
                                 data-compn="<?php the_field('kompaniya'); ?>" <?php $timedb = get_field('dataStart0');
                                 if($timedb){
                                 ?>data-timedb="<?php echo $timedb; ?>" <?php
                                 }else{ ?>data-timedb="0" <?php }
                            ?>>

                                <div class="mcName">
                                    <!-- <?php
                                    $timedb = get_field('dataStart2');
                                    if($timedb){
                                        ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                    }else{ ?><input class="time_db" type="number" value="0"><?php }
                                    ?>                     -->
                                    <!-- <script>console.log('dd13');</script> -->
                                    <a href="<?php the_permalink(); ?>">
                                        <p class=""><?php the_field('imya'); ?> <?php the_field('familiya'); ?></p>
                                    </a>
                                    <p class="spec1"><?php the_field('region'); ?></p>
                                    <?php $city = get_field('city_r');
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
                                    } ?>
                                    <p class="spec1">Linkedin: <?php the_field('linkedin'); ?></p>
                                    <?php
                                    if(get_field('telegram')) {
                                        ?><p class="spec1">Telegram: <?php the_field('telegram'); ?></p><?php
                                    } else {
                                        if(get_field('skype_r')){
                                            ?><p class="spec1">Skype: <?php the_field('skype_r'); ?></p><?php
                                        }
                                    }
                                    if(get_field('viber_r')) {
                                        ?><p class="spec1">Viber: <?php the_field('viber_r'); ?></p><?php
                                    } else {
                                        if(get_field('email_r')){
                                            ?><p class="spec1">Email: <?php the_field('email_r'); ?></p><?php
                                        }
                                    }
                                    if(!get_field('telegram') && !get_field('skype_r')) {
                                        if(get_field('tel_r')){
                                            ?><p class="spec1">Телефон: <?php the_field('tel_r'); ?></p><?php
                                        }
                                    }
                                    if(!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                                        if(get_field('drugoe')){
                                            ?><p class="spec1">Другое: <?php the_field('drugoe'); ?></p><?php
                                        }
                                    }
                                    ?>
                                    <!-- <p><?php the_field('skype_r'); ?></p>
                                <p><?php the_field('email_r'); ?></p>
                                <p><?php the_field('tel_r'); ?></p>
                                <p><?php the_field('drugoe'); ?></p> -->



                                </div>
                                <div class="mcd1">
                                    <?php $cand_ctegory = get_field('spec1');
                                    foreach ($cand_ctegory as $k) {
                                        ?>
                                        <span class="spec1">
                                    <?php
                                    echo $k->post_title;
                                    if (next($cand_ctegory)) {
                                        echo ',';
                                    }
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>

                                    <?php $spec2 = get_field('spec4');
                                    foreach ($spec2 as $s2) {
                                        ?>
                                        <span class="spec1">
                                    <?php
                                    echo $s2->post_title;
                                    if (next($spec2)) {
                                        echo ',';
                                    }
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>

                                    <?php $spec3 = get_field('spec3');
                                    foreach ($spec3 as $s3) {
                                        ?>
                                        <span class="spec1">
                                    <?php
                                    echo $s3->post_title;
                                    if (next($spec3)) {
                                        echo ',';
                                    }
                                    ?>
                                    <span class="dnone">a</span></span>
                                        <?php
                                    } ?>
                                    <?php if (get_field('zarplata')): ?>
                                        <span class="spec1">$<?php the_field('zarplata'); ?></span>
                                        <?php if (get_field('exp_r')) { ?>
                                            <span class="spec1"> Опыт, лет: <?php the_field('exp_r'); ?></span>
                                        <?php } ?>

                                        <?php if (get_field('tip_raboty')) {
                                            ?><span> - </span><?php
                                            $tip_raboty = get_field('tip_raboty');
                                            foreach ($tip_raboty as $tr) {
                                                ?>
                                                <span class="spec1">
                                    <?php
                                    echo $tr->post_title;
                                    if (next($tip_raboty)) {
                                        echo ',';
                                    }
                                    ?>
                                    <span class="dnone">a</span></span>
                                                <?php
                                            }
                                        }
                                        if(get_field('engl_r')) { ?>
                                            <span class="spec1"> - <?php the_field('engl_r'); ?></span>
                                        <?php }
                                        ?>

                                    <?php endif; ?>
                                </div>
                                <div class="mcs">
                                    <p class="stat4"><?php the_field('status_r'); ?></p>
                                </div>
                                <div class="mcd2">
                                    <!-- <p class="spec1 sp2"><?php the_field('spec2'); ?></p>
                        <p class="spec1"><?php the_field('kompaniya'); ?></p> -->
                                    <button type="button" class="getToVac">Забрать на Вакансию</button>
                                </div>
                                <div class="mcVuplaty">
                                    <!-- <div>
                            <?php if (get_field('vypl_1')): ?>
                            <div class="vdatewr spec1"><?php the_field('vypl_1'); ?>$
                                <p class="vdate spec1"><?php the_field('data_1'); ?></p>
                            </div>
                            <?php endif; ?>
                        </div> -->
                                    <div class="timer2">

                                        <!-- <?php if (get_field('vypl_2')): ?>
                            <div class="vdatewr spec1"><?php the_field('vypl_2'); ?>$</div>
                            <p class="vdate spec1"><?php the_field('data_2'); ?></p>
                            <?php endif; ?> -->
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                        <div class="ownBusy">
                            <?php
                            $recomendData = new WP_Query(array(
                                'post_type' => 'rekomend',
                                'meta_key' => 'dataStart2',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                                'meta_query' => array(
                                    // array(
                                    //     'key' => 'rekrutyor',
                                    //     'compare' => 'LIKE',
                                    //     'value' => $rekrId
                                    // ),
                                    array(
                                        'key' => 'status_r',
                                        'compare' => 'IN',
                                        'value' => array('Занятий')
                                    )
                                )
                            ));

                            while ($recomendData->have_posts()) {
                                $recomendData->the_post(); ?>
                                <div class="myCandW mcd kandItem1"
                                     data-name1="<?php the_field('imya'); ?>"
                                     data-id="<?php the_ID(); ?>" data-pipe="own" data-fam1="<?php the_field('familiya'); ?>"
                                     data-tel1="<?php the_field('telegram'); ?>" data-ema1="<?php the_field('email_r'); ?>"
                                     data-spec1="<?php $cand_s1 = get_field('spec1');
                                     foreach ($cand_s1 as $s1) {
                                         echo $s1->post_title;
                                     } ?>" data-spec4="<?php $cand_s4 = get_field('spec4');
                                foreach ($cand_s4 as $s4) {
                                    echo $s4->post_title;
                                } ?>" data-spec3="<?php $cand_s3 = get_field('spec3');
                                foreach ($cand_s3 as $s3) {
                                    echo $s3->post_title;
                                } ?>" data-work_format="<?php $cand_tipr = get_field('tip_raboty');
                                foreach ($cand_tipr as $tr) {
                                    echo $tr->post_title;
                                } ?>" data-angl="<?php the_field('engl_r'); ?>" data-reg1="<?php the_field('region'); ?>"
                                     data-zar="<?php the_field('zarplata'); ?>" data-cit1="<?php $cand_cit1 = get_field('city_r');
                                foreach ($cand_cit1 as $c1) {
                                    echo $c1->post_title;
                                } ?>" data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
                                     data-compn="<?php the_field('kompaniya'); ?>" <?php $timedb = get_field('dataStart0');
                                     if($timedb){
                                     ?>data-timedb="<?php echo $timedb; ?>" <?php
                                     }else{ ?>data-timedb="0" <?php }
                                ?>>

                                    <div class="mcName">
                                        <!-- <?php
                                        $timedb = get_field('dataStart2');
                                        if($timedb){
                                            ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                        }else{ ?><input class="time_db" type="number" value="0"><?php }
                                        ?>                     -->
                                        <!-- <script>console.log('dd13');</script> -->
                                        <a href="<?php the_permalink(); ?>">
                                            <p class=""><?php the_field('imya'); ?> <?php the_field('familiya'); ?></p>
                                        </a>
                                        <p class="spec1"><?php the_field('region'); ?></p>
                                        <?php $city = get_field('city_r');
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
                                        } ?>
                                        <p class="spec1">Linkedin: <?php the_field('linkedin'); ?></p>
                                        <?php
                                        if(get_field('telegram')) {
                                            ?><p class="spec1">Telegram: <?php the_field('telegram'); ?></p><?php
                                        } else {
                                            if(get_field('skype_r')){
                                                ?><p class="spec1">Skype: <?php the_field('skype_r'); ?></p><?php
                                            }
                                        }
                                        if(get_field('viber_r')) {
                                            ?><p class="spec1">Viber: <?php the_field('viber_r'); ?></p><?php
                                        } else {
                                            if(get_field('email_r')){
                                                ?><p class="spec1">Email: <?php the_field('email_r'); ?></p><?php
                                            }
                                        }
                                        if(!get_field('telegram') && !get_field('skype_r')) {
                                            if(get_field('tel_r')){
                                                ?><p class="spec1">Телефон: <?php the_field('tel_r'); ?></p><?php
                                            }
                                        }
                                        if(!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                                            if(get_field('drugoe')){
                                                ?><p class="spec1">Другое: <?php the_field('drugoe'); ?></p><?php
                                            }
                                        }
                                        ?>
                                        <!-- <p><?php the_field('skype_r'); ?></p>
                                <p><?php the_field('email_r'); ?></p>
                                <p><?php the_field('tel_r'); ?></p>
                                <p><?php the_field('drugoe'); ?></p> -->



                                    </div>
                                    <div class="mcd1">
                                        <?php $cand_ctegory = get_field('spec1');
                                        foreach ($cand_ctegory as $k) {
                                            ?>
                                            <span class="spec1">
                                    <?php
                                    echo $k->post_title;
                                    if (next($cand_ctegory)) {
                                        echo ',';
                                    }
                                    ?>
                                    <span class="dnone">a</span></span>
                                            <?php
                                        } ?>

                                        <?php $spec2 = get_field('spec4');
                                        foreach ($spec2 as $s2) {
                                            ?>
                                            <span class="spec1">
                                    <?php
                                    echo $s2->post_title;
                                    if (next($spec2)) {
                                        echo ',';
                                    }
                                    ?>
                                    <span class="dnone">a</span></span>
                                            <?php
                                        } ?>

                                        <?php if(get_field('spec3')){
                                            $spec3 = get_field('spec3');
                                            foreach ($spec3 as $s3) {
                                                ?>
                                                <span class="spec1">
                                    <?php
                                    echo $s3->post_title;
                                    if (next($spec3)) {
                                        echo ',';
                                    }
                                    ?>
                                    <span class="dnone">a</span></span>
                                                <?php
                                            }} ?>
                                        <?php if (get_field('zarplata')): ?>
                                            <span class="spec1">$<?php the_field('zarplata'); ?></span>
                                            <?php if (get_field('exp_r')) { ?>
                                                <span class="spec1"> Опыт, лет: <?php the_field('exp_r'); ?></span>
                                            <?php } ?>

                                            <?php if (get_field('tip_raboty')) {
                                                ?><span> - </span><?php
                                                $tip_raboty = get_field('tip_raboty');
                                                foreach ($tip_raboty as $tr) {
                                                    ?>
                                                    <span class="spec1">
                                    <?php
                                    echo $tr->post_title;
                                    if (next($tip_raboty)) {
                                        echo ',';
                                    }
                                    ?>
                                    <span class="dnone">a</span></span>
                                                    <?php
                                                }
                                            }
                                            if(get_field('engl_r')) { ?>
                                                <span class="spec1"> - <?php the_field('engl_r'); ?></span>
                                            <?php }
                                            ?>

                                        <?php endif; ?>
                                    </div>
                                    <div class="mcs">
                                        <p class="stat4"><?php the_field('status_r'); ?></p>
                                    </div>
                                    <div class="mcd2">
                                        <!-- <p class="spec1 sp2"><?php the_field('spec2'); ?></p>
                        <p class="spec1"><?php the_field('kompaniya'); ?></p> -->
                                        <button type="button" class="getToVac">Забрать на Вакансию</button>
                                    </div>
                                    <div class="mcVuplaty">
                                        <!-- <div>
                            <?php if (get_field('vypl_1')): ?>
                            <div class="vdatewr spec1"><?php the_field('vypl_1'); ?>$
                                <p class="vdate spec1"><?php the_field('data_1'); ?></p>
                            </div>
                            <?php endif; ?>
                        </div> -->
                                        <div class="timer2">

                                            <!-- <?php if (get_field('vypl_2')): ?>
                            <div class="vdatewr spec1"><?php the_field('vypl_2'); ?>$</div>
                            <p class="vdate spec1"><?php the_field('data_2'); ?></p>
                            <?php endif; ?> -->
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </section>
                </div>
                <!-- ===============================    -->
                <div class="myVac">
                    <div class="sti si">
                        <input class="si i0" type="text" class="myInput" id="i0" placeholder="Шукати по тексту" />
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
                            <div class="task-list-row vac_item vacdetsep" data-title="<?php the_title(); ?>"
                                 data-spec="<?php the_field('spec'); ?>" data-angl="<?php the_field('angl'); ?>"
                                 data-opyt="<?php the_field('opyt'); ?>" data-zarplata="<?php the_field('zarplata'); ?>"
                                 data-company="<?php the_field('vcompany'); ?>" data-status="<?php the_field('vstatus'); ?>"
                                 data-data="<?php the_field('data'); ?>" data-framework="<?php  $fr_ctegory = get_field('frejmvork');
                            foreach ($fr_ctegory as $fr) {
                                echo $fr->post_title;
                            }?>" data-work_format="<?php $cand_ctegory = get_field('format_raboty');
                            foreach ($cand_ctegory as $k) {
                                echo $k->post_title;
                            } ?>" data-notech="<?php $cand_ctegory = get_field('notech_related');
                            foreach ($cand_ctegory as $k) {
                                echo $k->post_title;
                            } ?>" data-city="<?php $cand_ctegory = get_field('gorod');
                            foreach ($cand_ctegory as $k) {
                                echo $k->post_title;
                            } ?>">
                                <div class="vds1">
                                    <div class="vimgbox">
                                        <div class="vimg">
                                            <a href="<?php the_permalink(); ?>" class="vac_title"><img class="" src="<?php
                                                if (the_field('vimg')) {
                                                    the_field('vimg');
                                                } ?>"
                                                                                                       alt="Vacancy Img"></a>
                                            <!--                            <img class="" src="--><?php
                                            //                            if(the_field('vimg')){
                                            //                                the_field('vimg');
                                            //                            } else { echo get_template_directory_uri() . '/assets/img/not-found.jpg'; } ?>
                                            <!--" alt="Vacancy Img">-->

                                            <!--                        <p class="spec_v">-->
                                            <?php //the_field(spec); ?>
                                            <!--</p>-->
                                        </div>
                                    </div>
                                    <div class="vmaintext">
                                        <h3><a href="<?php the_permalink(); ?>" class="vac_title"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="vdetails">
                                            <p>
                                                <?php
                                                $cand_ctegory = get_field('format_raboty');
                                                if (is_array($cand_ctegory) || is_object($cand_ctegory))
                                                {
                                                    foreach ($cand_ctegory as $k) {
                                                        echo $k->post_title;
                                                        ?><span class="transp">a</span><?php
                                                    }
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
                                    <div>
                                        <p class="vstatus"><?php the_field('vstatus'); ?></p>
                                    </div>
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
                                         data-vac="<?php echo $vacId ?>" data-star='<?php echo $existStar->posts[0]->ID; ?>'>
                                        <span class="dashicons dashicons-star-filled saveVac"></span>
                                        <!--                                <span class="starCount">-->
                                        <?php //echo $starCount->found_posts ?>
                                        <!--</span>-->
                                        <!--                                <span> +-->
                                        <?php //echo $vacId ?>
                                        <!--</span><span><span> = -->
                                        <?php //echo $existStarStatus ?>
                                        <!--</span>-->
                                    </div>
                                </div>
                            </div>
                            <!--                <div>--><?php //the_content(); ?>
                            <!--</div>-->
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
                <div class="myOffers">
                    <div class="myCandW mch oh">
                        <p>Имя</p>
                        <p>Детали</p>
                        <p>Cтатус</p>
                        <p>Детали</p>
                        <p>Выплаты2</p>
                        <button>Добавить реквизиты</button>
                        <div class="rekv_form">
                            <?php
                            $recomendData = new WP_Query(array(
                                'post_type' => 'sotrudniki',
                                'post_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
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
                                <!--                    <div class="ffoto"> --><?php //the_post_thumbnail(); ?>
                                <!--</div>-->
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
                                    <a href="<?php the_permalink(); ?>">
                                        <p class="kand_main_inf"><?php the_title(); ?></p>
                                    </a>
                                    <p><?php the_field('email_r'); ?></p>



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

                                    <div>
                                        <?php
                                        $spec2 = get_field('spec4');
                                        if (is_array($spec2) || is_object($spec2))
                                        {
                                            foreach ($spec2 as $s2) {
                                                ?>
                                                <span class="spec1">
                                        <?php
                                        echo $s2->post_title;
                                        ?>
                                        <span class="dnone">a</span></span>
                                                <?php
                                            }
                                        }
                                        ?>
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
                                        <p class="vdatewr"><?php the_field('zarplata'); ?>$</p>
                                    <?php endif; ?>
                                </div>
                                <div class="mcs">
                                    <p><?php the_field('status_r'); ?></p>
                                </div>
                                <div class="mcd2">
                                    <p class="spec1 sp2"><?php the_field('spec2'); ?></p>
                                    <p class="spec1"><?php the_field('kompaniya'); ?></p>
                                    <!--                                <div class="spec1 kom2">--><?php //the_field(komment); ?>
                                    <!--</div>-->
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
                            <option value="2021">Виберіть рік</option>
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
                        <select class="" id="amonth">
                            <option value="">Усі</option>
                            <option value="января">січень</option>
                            <option value="февраля">лютий</option>
                            <option value="марта">березень</option>
                            <option value="апреля">квітень</option>
                            <option value="мая">травень</option>
                            <option value="июня">червень</option>
                            <option value="июля">липень</option>
                            <option value="августа">серпень</option>
                            <option value="сентября">вересень</option>
                            <option value="октября">жовтень</option>
                            <option value="ноября">листопад</option>
                            <option value="декабря">грудень</option>
                        </select>
                    </div>
                    <!-- <ul id="list1">
                        <li id="1a" data-fn="1c">List 1b</li>
                        <li id="2a" data-fn="2c">List 2b</li>
                        <li id="3a" data-fn="3c">List 3b</li>
                    </ul> -->
                    <div id="ares0"
                         style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/chart1.jpg)">
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
                            <div class="aitem" data-date2="<?php the_field('data_analitika'); ?>"
                                 data-status="<?php the_field('status_r'); ?>" data-comp="<?php $komp2 = get_field('komp2');
                            foreach ($komp2 as $k2) {
                                echo $k2->post_title;
                            } ?>" data-vupl1="<?php the_field('data_1'); ?>"
                                 data-vupl2="<?php the_field('data_2'); ?>">
                                <p><?php the_title() ?> <span><?php the_field('data_analitika'); ?></span><span>Статус:
                                    <?php the_field('status_r'); ?></span>
                                    <?php
                                    if(get_field('vypl_1')){ ?>
                                        <span> Выплата 1: <span class="vypl1"><?php the_field('vypl_1'); ?></span><span
                                                class="v1date"><?php the_field('data_1'); ?></span></span>
                                    <?php }
                                    if(get_field('vypl_2')){ ?>
                                        <span> Выплата 2: <span class="vypl2"><?php the_field('vypl_2'); ?></span><span
                                                class="v2date"><?php the_field('data_2'); ?></span></span>
                                    <?php } ?>
                                    <span class="company"><?php $komp2 = get_field('komp2');
                                        foreach ($komp2 as $c2) {
                                            echo $c2->post_title;
                                        } ?>
                                </span>
                            </div>
                            <?php
                        }

                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="forChart1"></div>
                    <div class="forChart2"></div>
                    <div class="forChart3"></div>
                    <div class="forChart4"></div>
                    <div class="forChart5"></div>

                    <div class="forChart6"></div>
                    <div class="forChart7"></div>
                    <!-- <canvas id="c8" width="400" height="400"></canvas> -->
                    <div id="period">
                        <span>Виберить період: </span>
                        <input type="text" name="event_date" id="date5" placeholder="Начало периода"
                               autocomplete="off" />
                        <input type="text" name="event_date6" id="date6" placeholder="Конец периода"
                               autocomplete="off" />
                        <!-- <input type="date" id="addd1"> -->
                    </div>
                    <div id="event5">
                        <div class="" id="start5"></div>
                        <div class="" id="end5"></div>
                    </div>
                    <div id="ares20"
                         style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/chart2.jpg)">
                    </div>
                    <div id="ares2">
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
                            <div class="aitem2" data-date3="<?php the_field('date_analitiky'); ?>"
                                 data-date2="<?php the_field('data_analitika'); ?>" data-status="<?php the_field('status_r'); ?>"
                                 data-comp="<?php $komp2 = get_field('komp2');
                                 foreach ($komp2 as $k2) {
                                     echo $k2->post_title;
                                 } ?>" data-vupl1="<?php the_field('data_1'); ?>"
                                 data-vupl2="<?php the_field('data_2'); ?>">
                                <p><?php the_title() ?><span class="company"><?php the_field('date_analitiky'); ?></span>
                                    <span><?php the_field('data_analitika'); ?></span><span>Статус:
                                    <?php the_field('status_r'); ?></span>
                                    <?php
                                    if(get_field('vypl_1')){ ?>
                                        <span> Выплата 1: <span class="vypl1"><?php the_field('vypl_1'); ?></span><span
                                                class="v1date"><?php the_field('data_1'); ?></span></span>
                                    <?php }
                                    if(get_field('vypl_2')){ ?>
                                        <span> Выплата 2: <span class="vypl2"><?php the_field('vypl_2'); ?></span><span
                                                class="v2date"><?php the_field('data_2'); ?></span></span>
                                    <?php } ?>
                                    <span class="company"><?php $komp2 = get_field('komp2');
                                        foreach ($komp2 as $c2) {
                                            echo $c2->post_title;
                                        } ?>
                                </span>
                            </div>
                            <?php
                        }

                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="forChart10"></div>
                    <!-- <canvas id="c801" width="400" height="400"></canvas> -->
                </div>
                <div class="mmr">
                    <!-- <h1>уведомления c планировщика</h1> -->
                    <div class="" id="loadRes"></div>
                    <h1>повідомлення про горящих кандидатів</h1>

                    <!-- <div class="cc loadRes3" id=""></div> -->
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
                                    //                                    ?>
                                    <!--<span class="transp">a</span>-->
                                    <!--                                    --><?php
                                    //                                }
                                    //                                ?>
                                    <!--                            </p>-->
                                    <p class="mail_theme">Тема повідомленняя: <?php the_title(); ?></p>
                                    <div><?php the_content(); ?></div>
                                </div>

                                <?php
                            }

                            wp_reset_postdata(); // сброс
                            ?>

                        </section>
                    </div>
                    <section class="hotC">
                        <?php
                        //                $cu = get_current_user_id(); echo $cu;
                        //                global $recomendData;
                        $recomendData = new WP_Query(array(
                            'post_type' => 'rekomend',

                            'meta_key' => 'dataStart0',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            // 'order' => 'ASC',
                            'meta_query' => array(
                                'meta_query' => array(
                                    array(
                                        'key' => 'status_r',
                                        'compare' => 'IN',
                                        'value' => array('Горящий')
                                    )
                                )
                            )
//                    'suppress_filters' => false,
                        )); ?>
                        <input readonly value="<?php echo $recomendData->post_count; ?>" id="phpCount"
                               class="dp_post_count dnone"> <?php
                        while ($recomendData->have_posts()) {
                            $recomendData->the_post(); ?>
                            <div class="myCandW mcd kandItem1 hotOnly"
                                 data-timer="<?php the_field('dataStart0'); ?>"
                                 data-name1="<?php the_field('imya'); ?>" data-id="<?php the_ID(); ?>"
                                 data-fam1="<?php the_field('familiya'); ?>" data-pipe="public" data-tel1="<?php the_field('telegram'); ?>"
                                 data-ema1="<?php the_field('email_r'); ?>" data-spec1="<?php $cand_s1 = get_field('spec1');
                            foreach ($cand_s1 as $s1) {
                                echo $s1->post_title;
                            } ?>" data-spec4="<?php $cand_s4 = get_field('spec4');
                            foreach ($cand_s4 as $s4) {
                                echo $s4->post_title;
                            } ?>" data-spec3="<?php $cand_s3 = get_field('spec3');
                            foreach ($cand_s3 as $s3) {
                                echo $s3->post_title;
                            } ?>" data-work_format="<?php $cand_tipr = get_field('tip_raboty');
                            foreach ($cand_tipr as $tr) {
                                echo $tr->post_title;
                            } ?>" data-angl="<?php the_field('engl_r'); ?>" data-reg1="<?php the_field('region'); ?>"
                                 data-zar="<?php the_field('zarplata'); ?>" data-cit1="<?php $cand_cit1 = get_field('city_r');
                            foreach ($cand_cit1 as $c1) {
                                echo $c1->post_title;
                            } ?>" data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
                                 data-compn="<?php the_field('kompaniya'); ?>"
                                 <?php $timedb = get_field('dataStart0');
                                 if($timedb){
                                 ?>data-timedb="<?php echo $timedb; ?>" <?php
                                 }else{ ?>data-timedb="0" <?php }
                            ?>>

                                <div class="mcName">
                                    <!-- <?php
                                    $timedb = get_field('dataStart2');
                                    if($timedb){
                                        ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                    }else{ ?><input class="time_db" type="number" value="0"><?php }
                                    ?>                     -->
                                    <!-- <script>console.log('dd13');</script> -->
                                    <a href="<?php the_permalink(); ?>">
                                        <p class=""><?php the_field('imya'); ?> <?php the_field('familiya'); ?></p>
                                    </a>
                                    <!-- <p class="hot5"><?php the_field('dataStart0'); ?></p> -->
                                    <input  class="hot5 dnone" type="number" value="<?php the_field('dataStart0'); ?>" placeholder="<?php the_field('dataStart0'); ?>">
                                    <p class="spec1"><?php the_field('region'); ?></p>
                                    <?php
                                    $city = get_field('city_r');
                                    if (is_array($city) || is_object($city))
                                    {
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
                                    } ?>
                                    <p class="spec1">Linkedin: <?php the_field('linkedin'); ?></p>
                                    <?php
                                    if(get_field('telegram')) {
                                        ?><p class="spec1">Telegram: <?php the_field('telegram'); ?></p><?php
                                    } else {
                                        if(get_field('skype_r')){
                                            ?><p class="spec1">Skype: <?php the_field('skype_r'); ?></p><?php
                                        }
                                    }
                                    if(get_field('viber_r')) {
                                        ?><p class="spec1">Viber: <?php the_field('viber_r'); ?></p><?php
                                    } else {
                                        if(get_field('email_r')){
                                            ?><p class="spec1">Email: <?php the_field('email_r'); ?></p><?php
                                        }
                                    }
                                    if(!get_field('telegram') && !get_field('skype_r')) {
                                        if(get_field('tel_r')){
                                            ?><p class="spec1">Телефон: <?php the_field('tel_r'); ?></p><?php
                                        }
                                    }
                                    if(!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                                        if(get_field('drugoe')){
                                            ?><p class="spec1">Інше: <?php the_field('drugoe'); ?></p><?php
                                        }
                                    }
                                    ?>
                                    <!-- <p><?php the_field('skype_r'); ?></p>
                                <p><?php the_field('email_r'); ?></p>
                                <p><?php the_field('tel_r'); ?></p>
                                <p><?php the_field('drugoe'); ?></p> -->



                                </div>
                                <div class="mcd1">
                                    <?php
                                    $cand_ctegory = get_field('spec1');
                                    if (is_array($cand_ctegory) || is_object($cand_ctegory))
                                    {
                                        foreach ($cand_ctegory as $k) {
                                            ?>
                                            <span class="spec1">
                            <?php
                            echo $k->post_title;
                            if (next($cand_ctegory)) {
                                echo ',';
                            }
                            ?>
                            <span class="dnone">a</span></span>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    $spec2 = get_field('spec4');
                                    if (is_array($spec2) || is_object($spec2))
                                    {
                                        foreach ($spec2 as $s2) {
                                            ?>
                                            <span class="spec1">
                            <?php
                            echo $s2->post_title;
                            if (next($spec2)) {
                                echo ',';
                            }
                            ?>
                            <span class="dnone">a</span></span>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    $spec3 = get_field('spec3');
                                    if (is_array($spec3) || is_object($spec3))
                                    {
                                        foreach ($spec3 as $s3) {
                                            ?>
                                            <span class="spec1">
                            <?php
                            echo $s3->post_title;
                            if (next($spec3)) {
                                echo ',';
                            }
                            ?>
                            <span class="dnone">a</span></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php if (get_field('zarplata')): ?>
                                        <span class="spec1">$<?php the_field('zarplata'); ?></span>
                                        <?php if (get_field('exp_r')) { ?>
                                            <span class="spec1"> Досвід, років: <?php the_field('exp_r'); ?></span>
                                        <?php } ?>

                                        <?php if (get_field('tip_raboty')) {
                                            ?><span> - </span><?php
                                            $tip_raboty = get_field('tip_raboty');
                                            foreach ($tip_raboty as $tr) {
                                                ?>
                                                <span class="spec1">
                            <?php
                            echo $tr->post_title;
                            if (next($tip_raboty)) {
                                echo ',';
                            }
                            ?>
                            <span class="dnone">a</span></span>
                                                <?php
                                            }
                                        }
                                        if(get_field('engl_r')) { ?>
                                            <span class="spec1"> - <?php the_field('engl_r'); ?></span>
                                        <?php }
                                        ?>

                                    <?php endif; ?>
                                </div>
                                <div class="mcs">
                                    <p class="stat4"><?php the_field('status_r'); ?></p>
                                </div>
                                <div class="mcd2">
                                    <!-- <p class="spec1 sp2"><?php the_field('spec2'); ?></p>
                        <p class="spec1"><?php the_field('kompaniya'); ?></p> -->
                                    <!-- <button type="button" class="getToVac">Забрать на Вакансию</button> -->
                                </div>
                                <div class="mcVuplaty">
                                    <!-- <div>
                            <?php if (get_field('vypl_1')): ?>
                            <div class="vdatewr spec1"><?php the_field('vypl_1'); ?>$
                                <p class="vdate spec1"><?php the_field('data_1'); ?></p>
                            </div>
                            <?php endif; ?>
                        </div> -->
                                    <div class="timer2">

                                        <!-- <?php if (get_field('vypl_2')): ?>
                            <div class="vdatewr spec1"><?php the_field('vypl_2'); ?>$</div>
                            <p class="vdate spec1"><?php the_field('data_2'); ?></p>
                            <?php endif; ?> -->
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </section>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>

    </div>
<?php
get_template_part('template-parts/formAddCand');
get_footer(); ?>