<?php
/*
Template Name: Вакансии
*/
?>
<?php acf_form_head();
 get_header(); ?>

<div class="dp_container">
    <h1 class="et">Все вакансии</h1>
    <!--    <select size="1">-->
    <!--        <option value="1">p1</option>-->
    <!--        <option value="2">p2</option>-->
    <!--    </select>-->
    <div class="vac_wrap">
        <div class="left_vac">
            <button id="reset-vacfilters">Скинути фільтри</button>
            <div id="vac_filtrs" class="vac_filtrs">
            <div id="loadRes7"></div>
                <div class="f0w">
                    <p class="vft">Фільтри:</p>
                    <p class="vac_filter_res dp_post_count"></p>
                </div>

                <div class="company_wrap">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Kомпанії:
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                            </div>
                        </h3>
                        <div class="boxForChosenComp"></div>
                        <div class="answ">
                            <div class="lang_left so" id="vac_comp">
                                <?php $countComp = 0;
                                $teamPageData = new WP_Query(array(
                                    'post_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post_type' => 'client',
                                    'suppress_filters' => true,
                                ));
                                while ($teamPageData->have_posts()) {
                                    $teamPageData->the_post();
                                    $countComp++; ?>
                                    <label class="chbwr">
                                        <input type="checkbox" class="spec1-checkbox hidden-checkbox" value="<?php the_title(); ?>">
                                        <span class="chbwr-text"><?php the_title(); ?></span>
                                    </label>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spec_wrapper">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Мови програмування:
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                            </div>
                        </h3>
                        <div class="boxForChosenSpec"></div>
                        <div class="answ">
                            <div class="lang_left so" id="vac_speciality">
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
                                    <label class="chbwr">
                                        <input type="checkbox" class="spec1-checkbox hidden-checkbox" value="<?php the_title(); ?>">
                                        <span class="chbwr-text"><?php the_title(); ?></span>
                                    </label>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="addspec_wrapper">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Ще технічні:
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                            </div>
                        </h3>
                        <div class="boxForChosenAddSpec"></div>
                        <div class="answ">
                            <div class="lang_left so" id="vac_addspeciality">
                                <?php $countAddLang = 0;
                                $teamPageData = new WP_Query(array(
                                    'post_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post_type' => 'additional-lang',
                                    'suppress_filters' => true,
                                ));
                                while ($teamPageData->have_posts()) {
                                    $teamPageData->the_post();
                                    $countAddLang++; ?>
                                    <label class="chbwr">
                                        <input type="checkbox" class="spec1-checkbox hidden-checkbox" value="<?php the_title(); ?>">
                                        <span class="chbwr-text"><?php the_title(); ?></span>
                                    </label>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="notech_wrapper">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Нетехнічні:
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                                <!--                                <span class="dashicons dashicons-arrow-right tran"></span>-->
                            </div>
                        </h3>
                        <div class="boxForChosenNoTech"></div>
                        <div class="answ">
                            <div class="lang_left so" id="vac_notech">
                                <option value="">Усі нетехнічні</option>
                                <?php $countNoTech = 0;
                                $teamPageData = new WP_Query(array(
                                    'post_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post_type' => 'nontech',
                                    'suppress_filters' => true,
                                ));
                                while ($teamPageData->have_posts()) {
                                    $teamPageData->the_post();
                                    $countNoTech++; ?>
                                    <label class="chbwr">
                                        <input type="checkbox" class="spec1-checkbox hidden-checkbox" value="<?php the_title(); ?>">
                                        <span class="chbwr-text"><?php the_title(); ?></span>
                                    </label>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fiw">
                    <h3>Досвід роботи: <span class="transp">a</span><span class="oputVal" id="opyt_vacans">0</span>
                        <span class="oputVal">років</span>
                    </h3>
                    <p>
                        <input type="range" min="0" max="15" step="0.5" id="opyt_vacans_input" oninput="fun1()" value="0" class="opyt_input">
                    </p>

                </div>
                <div class="zarplata fiw">
                    <h3>ЗП Очікування</h3>
                    <div class="zarplata_data">
                        <input id="zarpl" type="number" placeholder="$0">
                        <span class="krapku"><span>...</span></span>
                        <input id="zarpl_to" type="number" placeholder="$0">
                    </div>
                </div>
                <section class="engl fiw">
                    <h3>Англійска мова:</h3>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve1" data-level="Beginner / Elementary (A1)" value="Beginner / Elementary (A1)">
                        <label class="custom-control-label" for="ve1">Beginner / Elementary (A1)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve2" data-level="Pre-intermediate (A2)" value="Pre-intermediate (A2)">
                        <label class="custom-control-label" for="ve2">Pre-intermediate (A2)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve3" data-level="Intermediate (B1)" value="Intermediate (B1)">
                        <label class="custom-control-label" for="ve3">Intermediate (B1)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve4" data-level="Upper-intermediate (B2)" value="Upper-intermediate (B2)">
                        <label class="custom-control-label" for="ve4">Upper-intermediate (B2)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve5" data-level="Advanced (C1)" value="Advanced (C1)">
                        <label class="custom-control-label" for="ve5">Advanced (C1)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve6" data-level="Fluent (C2)" value="Fluent (C2)">
                        <label class="custom-control-label" for="ve6">Fluent (C2)</label>
                    </div>
                </section>
                <div class="qa_wrapper">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Формат роботи
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                            </div>
                        </h3>
                        <div class="boxForChosenFormat"></div>
                        <div class="answ" data-pop="1" id="vac_work_format">
                            <?php $countFormat = 0;
                            $teamPageData = new WP_Query(array(
                                'post_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'post_type' => 'work_format',
                                'suppress_filters' => true,
                            ));
                            while ($teamPageData->have_posts()) {
                                $teamPageData->the_post();
                                $countFormat++; ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input hidden-checkbox vac_work_format"
                                           id="i<?php echo $countFormat; ?>" data-level="<?php the_title(); ?>" value="<?php the_title(); ?>">
                                    <label class="custom-control-label" for="i<?php echo $countFormat; ?>"
                                    <?php echo $countFormat; ?>"><?php the_title(); ?></label>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="city_wrapper" style="display: block;">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Регіон:
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                            </div>
                        </h3>
                        <div class="boxForChosenCity"></div>
                        <div class="answ">
                            <input type="text" id="countrySearch" placeholder="Пошук країни...">
                            <div class="allcountr multiselect">
                                <?php
                                $args = array(
                                    'post_type' => array('countries'),
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC'
                                );
                                $custom_query = new WP_Query($args);
                                $tech_id = 0;
                                $other_countries = array(); // создаем массив для "Инших" стран
                                if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                                    <?php
                                    if (get_the_title() == 'Інші') {
                                        $other_countries[] = '<div class="countrySing" id="countrID' . $tech_id . '" class="countr_sc">' . get_the_title() . '</div>';
                                    } else {
                                        echo '<div class="countrySing" id="countrID' . $tech_id . '" class="countr_sc">' . get_the_title() . '</div>';
                                    }
                                    $tech_id++;
                                endwhile;

                                    // выводим "Иншие" страны в конце списка
                                    foreach ($other_countries as $country) {
                                        echo $country;
                                    }
                                endif;
                                wp_reset_postdata(); ?>
                            </div>
                            <input type="hidden" id="vac_country" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right_vac">
            <div class="stisingle si">
                <input class="si i0" type="text" class="myInputCli" id="i0cli" placeholder="Шукати по тексту" />
            </div>
                <div class="clientVacancyTitle">
                    <p>Дата</p>
                    <p>Позиція</p>
                    <p>ЗП</p>
                    <p>Локація</p>
                    <p>Англійська</p>
                    <p>Відповідальний</p>
                    <p>Пріорітет</p>
                    <p></p>
                </div>
            <div id="loader">
                <img src="<?php echo bloginfo('template_url'); ?>/assets/img/loader.png" alt="settings"/>
            </div>
                <div class="vac_descr clientVacancy">
                <?php

                $teamPageData = new WP_Query(array(
                    'posts_per_page' => 3,
                    'paged' => 0,
                    //                    'meta_key' => 'dataStart',
//                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    'post_type' => 'vacancy',
//                    'suppress_filters' => false,
//                    'meta_query' => array(
//                        array(
//                            'key' => 'show_v',
//                            'compare' => '=',
//                            'value' => 1
//                        )
//                    )
                )); ?>
             <?php
                while ($teamPageData->have_posts()) {
                    $teamPageData->the_post();
                    if (get_field('zrobiti_publichnoyu')) {
                        ?>
                        <div class="task-list-row vac_item vacdetsep clvacwrapp" data-title="<?php the_title(); ?>"
                             data-comp="<?php $comp = get_field('klienty');
                             foreach ($comp as $c2) {
                                 echo $c2->post_title;
                             } ?>" data-spec="<?php $cand_ctegory = get_field('nazva_vakansi');
                        foreach ($cand_ctegory as $k) {
                            echo $k->post_title;
                        } ?>" data-angl="<?php the_field('riven_anglijsko'); ?>" data-opyt="<?php the_field('opyt'); ?>"
                             data-country="<?php $cloc = get_field('lokacziya'); foreach ($cloc as $cl) { echo $cl->post_title; if (next($cloc)) { echo ', '; } } ?>"
                             data-zarplata="<?php the_field('zarplata1'); ?>"
                             data-zarp2="<?php the_field('zarplata1'); ?>"
                             data-company="<?php the_field('vcompany'); ?>" data-status="<?php the_field('prioritetnist_vakansi'); ?>"
                             data-data="<?php the_field('field_645272746b7d4'); ?>" data-region="<?php the_field('region'); ?>"

                             data-framework="<?php $cand_s4 = get_field('frejmvork');
                             foreach ($cand_s4 as $s4) {
                                 echo $s4->post_title;
                             } ?>"
                             data-work_format="<?php $cand_ctegory = get_field('format_raboty');
                             foreach ($cand_ctegory as $k) {
                                 echo $k->post_title;
                             } ?>" data-notech="<?php $cand_ctegory = get_field('notech_related');
                        foreach ($cand_ctegory as $k) {
                            echo $k->post_title;
                        } ?>" data-city="<?php $cand_ctegory = get_field('gorod');
                        foreach ($cand_ctegory as $k) {
                            echo $k->post_title;
                        } ?>">
                            <div class="bk_time">
                                <p class=""><?php the_field('field_645272746b7d4'); ?></p>
                            </div>
                            <div class="vakname">
                                <h3><a href="<?php the_permalink(); ?>" class="vac_title"><?php the_field('nazva_vakansi'); ?></a></h3>
                            </div>
                            <div class="vakzarpl">
                                <?php if (get_field('vidno_dlya_vsih')) { ?>
                                    <p><?php the_field('zarplata1'); ?>$</p>
                                <?php } ?>
                            </div>
                            <div class="vakloc">
                                <p class="expandable-text">
                                    <?php $cloc = get_field('lokacziya');
                                    foreach ($cloc as $cl) {
                                        echo $cl->post_title;
                                        if (next($cloc)) {
                                            echo ', ';
                                        }
                                    } ?>
                                </p>
                            </div>
                            <div class="vakangl">
                                <?php the_field('riven_anglijsko'); ?>
                            </div>
                            <div class="vakprior">
                                <?php $hto_vydalyv = $current_user->first_name . ' ' . $current_user->last_name; ?>
                            </div>
                            <div class="vakprior">
                                <?php the_field('prioritetnist_vakansi'); ?>
                            </div>
                            <div class="bk_end vds3">
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
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
            <button id="load-more" style="display: none;">Завантажити ще</button>
        </div>
    </div>
</div>
<?php
   if(is_user_logged_in() && current_user_can('publish_clients')) { ?>
<!-- <article class="popup_form addVac">
    <div class="popup_bgr" data-popup="close"></div>
    <div class="popup_box">
        <div class="pop_box_inn">
            <button type="button" class="close-modal" data-popup="close">×</button>
            <h3 class="cloud-title">Создать вакансию</h3>
            <section>
                <div class="customContainer1">
                    <section class="p_form">
                        <?php acf_form(array(
                       'post_title' => true,
                       'post_content' => true,
                       'submit_value' => __('Зберегти зміни')
                   )); ?>
                    </section>

                </div>
        </div>
</article> -->
<?php }
if (is_user_logged_in() && current_user_can('publish_freelancers')) { 
get_template_part('template-parts/formAddCand'); }
get_footer(); ?>