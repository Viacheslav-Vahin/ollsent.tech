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
    <!--    <script>-->
    <!--        document.addEventListener("DOMContentLoaded", function () {-->
    <!--            const acfForms = document.querySelectorAll(".acf-form");-->
    <!--            acfForms.forEach((form) => {-->
    <!--                const formId = form.getAttribute("id");-->
    <!--                const inputs = form.querySelectorAll("input");-->
    <!--                inputs.forEach((input) => {-->
    <!--                    const inputId = input.getAttribute("id");-->
    <!--                    if (inputId) {-->
    <!--                        input.setAttribute("id", inputId + "-" + formId);-->
    <!--                    }-->
    <!--                });-->
    <!--            });-->
    <!--        });-->
    <!--    </script>-->
    <div class="modalSotr">
        <div class="modalBg"></div>
        <div class="modalSotrIn">
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

                ?><span id="cutask" class="dnone"><?php $curUsr = the_id(); ?></span>
                <?php
                $unique_id = uniqid();
                acf_form(array(
                    'new_post' => true,
                    'form_attributes' => array(
                        'id' => 'acf-form-' . $unique_id,
                    ),
                ));
            }
            //            posts_nav_link();
            wp_reset_postdata();
            ?>
            <button class="passpop-btn">Змінити пароль</button>
            <div class="ppop-wr" style="display: none;">
            <div class="passpop-overlay" style="display: none;"></div>
                    <div class="passpop">
                        <button id="passpop-close">✖</button>
                        <div class="hz">

                        <?php echo do_shortcode('[changepassword_form]'); ?>
                        <!--                    --><?php //echo do_shortcode('[custom_password_reset]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        <div class="" id="tres8"><span id="cu6" class="dnone"><?php echo get_current_user_id(); ?></span><span
                    id="surl6"
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

                            ?><span id="cutask" class="dnone"><?php $curUsr = the_id(); ?></span>
                            <?php
                            $unique_id = uniqid();
                            acf_form(array(
                                'new_post' => true,
                                'fields' => array('foto'),
                                'form_attributes' => array(
                                    'id' => 'acf-form-' . $unique_id,
                                ),
                            ));
                        }
                        //            posts_nav_link();
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="sotrAllInfo">
                        <button id="sotrInfo">Редагувати</button>
                    </div>

                    <div class="admmen">
                        <?php
                        $recomendData = new WP_Query(array(
                            'post_type' => 'adminmenu',
                            'post_per_page' => 1,
                        ));
                        while ($recomendData->have_posts()) {
                        $recomendData->the_post();
                        ?>
                        <div class="admenmenuform">

                            <?php
                            $unique_id = uniqid();
                            acf_form(array(
                                'new_post' => true,
                                'form_attributes' => array(
                                    'id' => 'acf-form-' . $unique_id,
                                ),
                            ));

                            ?>
                        </div>
                        <div class="admenmenu">
                            <div class="lMenuW myProfile">
                                <h4><span class="dashicons dashicons-admin-users"></span><?php the_field('profile'); ?>
                                </h4>
                            </div>
                            <div class="lMenuW myTasks">
                                <h4>
                                    <span class="dashicons dashicons-media-document"></span></span><?php the_field('mo_zadachi'); ?>
                                </h4>
                            </div>
                            <div class="lMenuW myC">
                                <h4>
                                    <span class="dashicons dashicons-portfolio"></span><?php the_field('mo_kandidati'); ?>
                                </h4>
                            </div>
                            <div class="lMenuW myV">
                                <h4>
                                    <span class="dashicons dashicons-star-filled"></span><?php the_field('mo_vakansi'); ?>
                                </h4>
                            </div>
                            <div class="lMenuW myClients">
                                <h4><span class="dashicons dashicons-portfolio"></span><?php the_field('mo_klinti'); ?>
                                </h4>
                            </div>
                            <div class="lMenuW myO">
                                <h4>
                                    <span class="dashicons dashicons-money-alt"></span></span><?php the_field('mo_offeri'); ?>
                                </h4>
                            </div>
                            <div class="lMenuW myA">
                                <h4>
                                    <span class="dashicons dashicons-chart-area"></span></span></span><?php the_field('moya_analitika'); ?>
                                </h4>
                            </div>


                            <!--                --><?php
                            //                $existStarStatus = 'no';
                            //                if (is_user_logged_in()) {
                            //                    $existStar = new WP_Query(array(
                            ////                'author' => get_current_user_id(),
                            //                        'post_title' => get_current_user_id(),
                            //                        'post_type' => 'notiajax',
                            //                    ));
                            //                    if ($existStar->found_posts) {
                            //                        $existStarStatus = 'yes';
                            //                    }
                            //                }
                            //                $existHot = 'no';
                            //                if (is_user_logged_in()) {
                            //                    $exHot = new WP_Query(array(
                            //                        'post_title' => get_current_user_id(),
                            //                        'post_type' => 'notiHot',
                            //                    ));
                            //                    if ($exHot->found_posts) {
                            //                        $existHot = 'yes';
                            //                    }
                            //                    while ($exHot->have_posts()) {
                            //                        $exHot->the_post(); ?>
                            <!--                            <p class="hotTime dnone">-->
                            <?php //the_field('modify_date') ?><!--</p>-->
                            <!--                    --><?php //}
                            //                    wp_reset_postdata();
                            //                }
                            //                ?>
                            <div class="lMenuW myM" data-uid="<?php echo get_current_user_id(); ?>"
                            <!--                    data-ld='-->
                            <?php //echo $existStar->posts[0]->ID; ?><!--' data-exist='-->
                            <?php //echo $existStarStatus; ?><!--'                    -->
                            <!--                    data-hot='--><?php //echo $exHot->posts[0]->ID; ?><!--'-->
                            <!--                    -->
                            <!--                    data-exist2='--><?php //echo $existHot; ?><!--'                  -->
                            >
                            <h4><span class="dashicons dashicons-email"></span><?php the_field('povidomlennya'); ?></h4>
                            <span id="numbMail"></span><span id="numbHot">5</span>
                            <span id="numbHot5"></span>
                        </div>
                        <div class="lMenuW myFAQ">
                            <h4>
                                <span class="dashicons dashicons-chart-area"></span></span></span><?php the_field('faq'); ?>
                            </h4>
                        </div>
                        <a href="<?php echo wp_logout_url(); ?>">
                            <div class="lMenuW">
                                <h4>
                                    <span class="dashicons dashicons-arrow-left-alt"></span><?php the_field('vijti_iz_akaunta'); ?>
                                </h4>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                    <div class="sotrAllInfo">
                        <button id="editadmmenu">Редарувати меню</button>
                        <button id="cancelmenu">Відмінити</button>
                    </div>
                    <?php
                    $users = get_users();

                    echo '<select id="userlist" name="userlist">';
                    foreach ($users as $user) {
                        echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
                    }
                    echo '</select>';
                    ?>


                </div>
            </div>

            <div class="right_vac sotr_right">
                <!--                 <span> --><?php //print_r ($exHot->posts[0]); ?><!-- </span> -->
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
                        $recomendData->the_post();
                        $rec_name = get_field('rec_name');
                        $rec_lastname = get_field('rec_lastname');
                        $data_rozhdeniya = get_field('data_rozhdeniya');
                        $locac = get_field('locac');
                        $rec_allcont = get_field('rec_allcont');
                        $zagolovok_r = get_field('zagolovok_r');
                        $dodatkova_informacziya_tekst = get_field('dodatkova_informacziya_tekst');
                        $zrobiti_publichniminfo = get_field('zrobiti_publichniminfo');
                        $dodati_fajl = get_field('dodati_fajl');
                        $zrobiti_publichnimfile = get_field('zrobiti_publichnimfile');
                        ?>
                        <div class="top-name">
                            <div class="col-left">
                                <h3>Ім'я та прізвище: <span><?php echo $rec_name; ?><?php echo $rec_lastname; ?></span>
                                </h3>
                                <h3>Вік: <span id="bdate"><?php echo $data_rozhdeniya; ?></span></h3>
                                <?php
                                if ($locac): ?>
                                    <h3>Локація: <span><?php echo esc_html($locac->post_title); ?></span></h3>
                                <?php endif; ?>
                            </div>
                            <div class="col-right">
                                <div class="contWr">
                                    <h3>Контакти: </h3>
                                    <?php
                                    $trtr = array();
                                    if (have_rows('rec_allcont')): // проверка, есть ли строки в повторителе 'kontakti22'
                                        while (have_rows('rec_allcont')): the_row(); // если есть строки, начинаем цикл
                                            $icon = get_sub_field('ikonka');
                                            $contactData = get_sub_field('dannir');
                                            $kontakt222 = get_sub_field('rec_cont');
                                            $test = strtolower($kontakt222->post_title);
                                            $test = str_replace(' ', '', $test);
                                            $test = preg_replace("/[^a-zA-Z0-9]/", "", $test);
                                            if ($test == 'telegram') {
                                                $trtr[] = '<a href="https://t.me/' . $contactData . '" class="spec1 cp_btn bk_' . $test . '" id="' . uniqid() . '" target="_blank"><span style="display: inline-block !important; position: relative; padding-left: 45px; padding-top: 10px; font-size: 14px; font-weight: bold;">' . $contactData . '</span></a>';
                                            }
                                            if ($test == 'linkedin') {
                                                $trtr[] = '<a href="' . $contactData . '" class="spec1 cp_btn bk_' . $test . '" id="' . uniqid() . '" target="_blank"><span style="display: inline-block !important; position: relative; padding-left: 45px; padding-top: 10px; font-size: 14px; font-weight: bold;">' . $contactData . '</span></a>';
                                            } else {
                                                $trtr[] = '<a href="javascript:void(0);" class="spec1 cp_btn bk_' . $test . '" id="' . uniqid() . '"><span style="display: inline-block !important; position: relative; padding-left: 45px; padding-top: 10px; font-size: 14px; font-weight: bold;">' . $contactData . '</span></a>';
                                            }
                                        endwhile;
                                    endif;
                                    $contact_la = implode(' ', $trtr);
                                    echo $contact_la;
                                    ?>
                                </div>
                            </div>
                            <div class="col-fw">
                                <?php
                                $hero = get_field('dodatkova_informacziyar');
                                if( $hero ): ?>

                                <?php if ($hero['zagolovok_r']): ?>
                                    <h3><?php echo $hero['zagolovok_r']; ?>:</h3>
                                    <div class="addinf">
                                        <p><?php echo $hero['dodatkova_informacziya_tekst']; ?></p>
                                    </div>
                                <?php endif; ?>
                                <h3>Завантажити файл:</h3>
                                <a href="<?php echo $hero['dodati_fajl']['url']; ?>"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/file.png"
                                                                                          alt="settings"/><?php echo $hero['dodati_fajl']['title']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                    //                        $unique_id = uniqid();
                    //                        acf_form(array(
                    //                        'new_post' => true,
                    //                            'form_attributes' => array(
                    //                                'id' => 'acf-form-' . $unique_id,
                    //                            ),
                    //                            ));
                    //                    }
                    wp_reset_postdata();
                    ?>

                </section>
                <div class="tasksData">
                    <h1>Мои задачи</h1>
                    <!--                    <div id="loadCalend"></div>-->
                </div>
                <div class="faqData">
                    <div class="faqfind">
                        <input type="text" class="myInput" placeholder="Шукати по тексту"/>
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
                    <span class="dnone"><?php $cuPipe = get_current_user_id();
                        echo $cuPipe; ?></span>
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
                        <p class="dnone"><?php $rekrId = get_field('id_s');
                            echo $rekrId; ?></p>
                        <p class="dnone"><?php $rekrId = get_the_ID();
                            echo $rekrId; ?></p>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>

                    <div class="myCandW mch">
                        <p class="ownPipe">Особистий Pipeline</p>
                        <div class="mcfind">
                            <input type="text" class="myInput" placeholder="Шукати по тексту"/>
                        </div>
                        <!--                        <div class="mcfind3">-->
                        <!--                            <select class="fCss" id="findcstat">-->
                        <!--                                <option value="">Все Статусы</option>-->
                        <!--                                <option value="Новий">Новий</option>-->
                        <!--                                <option value="В роботі">В роботі</option>-->
                        <!--                                <option value="Офер">Офер</option>-->
                        <!--                                <option value="На паузе">На паузе</option>-->
                        <!--                            </select>-->
                        <!--                            <select class="fCss" id="findcspec">-->
                        <!--                                <option value="">Все Специализация</option>-->
                        <!--                                --><?php //$countLang = 0;
                        //                            $teamPageData = new WP_Query(array(
                        //                                'post_per_page' => -1,
                        //                                'orderby' => 'title',
                        //                                'order' => 'ASC',
                        //                                'post_type' => 'language',
                        //                                'suppress_filters' => true,
                        //                            ));
                        //                            while ($teamPageData->have_posts()) {
                        //                                $teamPageData->the_post();
                        //                                $countLang++; ?>
                        <!--                                <option value="--><?php //the_title(); ?><!--">-->
                        <?php //the_title(); ?><!--</option>-->
                        <!--                                --><?php
                        //                            } ?>
                        <!--                                <option class="countLang">-->
                        <?php //echo $countLang; ?><!--</option> --><?php
                        //                            wp_reset_postdata();
                        //                            ?>
                        <!--                            </select>-->
                        <!--                        </div>-->
                        <p>Имя</p>
                        <p>Детали</p>
                        <p>Cтатус</p>
                        <!-- <p>Детали</p>
                        <p>Выплаты</p> -->
                    </div>
                    <section class="allmr pipeCont pipe1">
                        <div id="moveToRekr">
                            <h2 data-rekr="<?php $cu = get_current_user_id();
                            echo $cu; ?>">
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
                                    <option data-exist='<?php echo $existStarStatus; ?>'
                                            value="<?php echo get_the_ID(); ?>"
                                            class="vacOption"><?php the_title(); ?></option>
                                    <?php
                                }
                                wp_reset_postdata();
                                ?>
                            </select>
                            <button type="submit" id="saveMove">Сохранить</button>
                        </div>
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

                        if ($favorite_candidate_ids) {
                            $candidate_query_args = array(
                                'post_type' => 'candidate',
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post__in' => $favorite_candidate_ids
                            );
                        } else {
                            $candidate_query_args = array(
                                'post_type' => 'none'
                            );
                        }

                        $candidate_query = new WP_Query($candidate_query_args);

                        $combined_posts = array_merge($rekomend_query->posts, $candidate_query->posts);

                        // Далее вы можете использовать $combined_posts для вывода результатов


                        foreach ($combined_posts as $post) {
                            setup_postdata($post); ?>
                            <div class="myCandW mcd kandItem1 baza"
                                 data-candidate-id="<?php echo get_the_ID(); ?>"
                                 data-pdf="<?php the_field('pdf_parsed'); ?>"
                                 data-timer="<?php the_field('dataStart0'); ?>"
                                 data-name1="<?php the_field('imya'); ?>"
                                 data-pipe="public"
                                 data-id="<?php the_ID(); ?>"
                                 data-fam1="<?php the_field('familiya'); ?>" data-tel1="<?php the_field('telegram'); ?>"
                                 data-ema1="<?php the_field('email_r'); ?>"
                                 data-spec1="<?php $cand_s1 = get_field('spec1');
                                 foreach ($cand_s1 as $s1) {
                                     echo $s1->post_title . ', ';
                                 } ?>"
                                 data-spec4="<?php $cand_s1 = get_field('spec4');
                                 foreach ($cand_s1 as $s1) {
                                     echo $s1->post_title . ', ';
                                 } ?>"
                                 data-angl="<?php the_field('engl_r'); ?>" data-reg1="<?php the_field('region'); ?>"
                                 data-cont="<?php $f_email = get_field_object('email_r');
                                 if ($f_email['value']) {
                                     echo $f_email['label'] . " ";
                                 }
                                 $f_skype = get_field_object('skype_r');
                                 if ($f_skype['value']) {
                                     echo $f_skype['label'] . " ";
                                 }
                                 $telegram = get_field_object('telegram');
                                 if ($telegram['value']) {
                                     echo $telegram['label'] . " ";
                                 }
                                 $viber_r = get_field_object('viber_r');
                                 if ($viber_r['value']) {
                                     echo $viber_r['label'] . " ";
                                 }
                                 $whatsapp_r = get_field_object('whatsapp_r');
                                 if ($whatsapp_r['value']) {
                                     echo $whatsapp_r['label'] . " ";
                                 }
                                 $linkedin = get_field_object('linkedin');
                                 if ($linkedin['value']) {
                                     echo $linkedin['label'];
                                 } ?>"
                                 data-contval="<?php $f_email = get_field_object('email_r');
                                 if ($f_email['value']) {
                                     echo $f_email['value'] . ", ";
                                 }
                                 $f_skype = get_field_object('skype_r');
                                 if ($f_skype['value']) {
                                     echo $f_skype['value'] . ", ";
                                 }
                                 $telegram = get_field_object('telegram');
                                 if ($telegram['value']) {
                                     echo $telegram['value'] . ", ";
                                 }
                                 $viber_r = get_field_object('viber_r');
                                 if ($viber_r['value']) {
                                     echo $viber_r['value'] . ", ";
                                 }
                                 $whatsapp_r = get_field_object('whatsapp_r');
                                 if ($whatsapp_r['value']) {
                                     echo $whatsapp_r['value'] . ", ";
                                 }
                                 $linkedin = get_field_object('linkedin');
                                 if ($linkedin['value']) {
                                     echo $linkedin['value'];
                                 } ?>"
                                 data-zar="<?php the_field('zarplata'); ?>"
                                 data-country="<?php the_field('pipe_country'); ?>"
                                 data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
                                <?php if (get_field('komp_last')) { ?>
                                 data-compn="<?php $cand_s3 = get_field('komp_last');
                                 foreach ($cand_s3 as $s3) {
                                     echo $s3->post_title;
                                 }
                                 } ?>"
                                 <?php $timedb = get_field('dataStart0');
                                 if ($timedb){
                                 ?>data-timedb="<?php echo $timedb; ?>" <?php
                            } else { ?>data-timedb="0" <?php }
                            ?>>
                                <div class="bk_time">
                                    <p class=""><?php the_field('field_61c9624e3d8fc'); ?></p>
                                </div>
                                <div class="mcName">
                                    <!-- <?php
                                    $timedb = get_field('dataStart2');
                                    if ($timedb) {
                                        ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                    } else { ?><input class="time_db" type="number" value="0"><?php }
                                    ?>                     -->
                                    <!-- <script>console.log('dd13');</script> -->
                                    <div class="bk_name">
                                        <a href="<?php the_permalink(); ?>">
                                            <p class=""><?php the_field('imya'); ?><?php the_field('familiya'); ?></p>
                                        </a>
                                    </div>
                                </div>

                                <div class="bk_mid1">
                                    <div class="bk_country">
                                        <?php $city = get_field('city_r');
                                        if ($city) {
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
                                        } ?></div>
                                </div>
                                <div class="bk_mid1">
                                    <div class="bk_zp">
                                        <span class="spec1">ЗП $<?php the_field('zarplata'); ?></span>
                                    </div>
                                </div>

                                <div class="bk_mid2">
                                    <?php if (get_field('engl_r')) { ?>
                                        <div class="bk_angl">
                                            <p class="spec1">Англ: <span
                                                        class="dnone">a</span><?php the_field('engl_r'); ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="bk_mid2 cont_wrapper">
                                    <div class="bk_cont">
                                        <?php
                                        if (get_field('linkedin')) {
                                            ?><a href="https://www.linkedin.com/in/<?php the_field('linkedin'); ?>"
                                                 class="spec1 cp_btn bk_linkedin" id="bk_linkedin<?php echo $it; ?>">
                                            <span><?php the_field('linkedin'); ?></span></a><?php
                                        }
                                        if (get_field('telegram')) {
                                            ?><a href="tg://resolve?domain=<?php the_field('telegram'); ?>"
                                                 class="spec1 cp_btn bk_telegram" id="bk_telegram<?php echo $it; ?>">
                                            <span><?php the_field('telegram'); ?></span></a><?php
                                        }
                                        if (get_field('skype_r')) {
                                            ?><a href="skype:<?php the_field('skype_r'); ?>?chat"
                                                 class="spec1 cp_btn bk_skype" id="bk_skype<?php echo $it; ?>"
                                                 target="_blank"><span><?php the_field('skype_r'); ?></span></a><?php
                                        }
                                        if (get_field('viber_r')) {
                                            ?><a href="viber://chat?number=%2B<?php the_field('viber_r'); ?>"
                                                 class="spec1 cp_btn bk_viber" id="bk_viber<?php echo $it; ?>"
                                                 target="_blank"><span><?php the_field('viber_r'); ?></span></a><?php
                                        }
                                        if (get_field('email_r')) {
                                            ?><a href="mailto:<?php the_field('email_r'); ?>"
                                                 class="spec1 cp_btn bk_email" id="bk_email<?php echo $it; ?>"
                                                 target="_blank"><span><?php the_field('email_r'); ?></span></a><?php
                                        }
                                        if (get_field('tel_r')) {
                                            ?><a href="tel:<?php the_field('tel_r'); ?>" class="spec1 cp_btn bk_phone"
                                                 id="bk_phone<?php echo $it; ?>">
                                            <span><?php the_field('tel_r'); ?></span></a><?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="bk_end">
                                    <div class="bk_cv">
                                        <a href="javascript:void(0);" class="modalCv" id="modal-launcher">CV</a>
                                        <div id="modal-background"></div>
                                        <div id="modal-content">
                                            <button id="modal-close">✖</button>
                                            <div style="width: 100%;padding: 60px 0;text-align: justify;">
                                                <?php
                                                $raw_text = get_field('pdf_parsed');
                                                $paragraphs = preg_split('/\n\s*\n/', $raw_text, -1, PREG_SPLIT_NO_EMPTY);

                                                foreach ($paragraphs as $paragraph) {
                                                    $clean_paragraph = str_replace('"', '', trim($paragraph));
                                                    echo '<p>' . $clean_paragraph . '</p>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mcs">
                                        <p><?php the_field('status_r'); ?></p>
                                    </div>
                                </div>
                                <div class="bk_mid1">
                                    <button type="button" class="getToVac">Взяти на вакансію</button>
                                    <!--                        <button class="favorite-star" data-candidate-id="-->
                                    <?php //echo get_the_ID(); ?><!--">-->
                                    <!--                            <i class="fas fa-star"></i>-->
                                    <!--                            eeeeeee-->
                                    <!--                        </button>-->
                                    <button class="favorite-star favorited"
                                            data-candidate-id="<?php echo get_the_ID(); ?>">
                                        ☆
                                    </button>

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
                        <!--                        <div id="moveToRekr">-->
                        <!--                            <h2 data-rekr="-->
                        <?php //$cu = get_current_user_id(); echo $cu; ?><!--">-->
                        <!--                                Забрать <span id="cName"></span> на вакансию<span class="close1">×</span></h2>-->
                        <!---->
                        <!--                            <select class="" id="mVac">-->
                        <!--                                <option value=0>Вакансии</option>-->
                        <!--                                --><?php
                        //            $teamPageData = new WP_Query(array(
                        //                'post_per_page' => -1,
                        //                'orderby' => 'title',
                        //                'order' => 'ASC',
                        //                'post_type' => 'vacancy',
                        //                'suppress_filters' => true,
                        //            ));
                        //            while ($teamPageData->have_posts()) {
                        //                $teamPageData->the_post(); ?>
                        <!--                                <p>--><?php //the_title(); ?><!-- <span>-->
                        <?php //echo get_the_ID(); ?><!--</span></p> -->
                        <!--                                --><?php
                        //            $vacId = get_the_ID();
                        //            $starCount = new WP_Query(array(
                        //                'post_type' => 'vstar',
                        //                'meta_query' => array(
                        //                    array(
                        //                        'key' => 'my_vac_id',
                        //                        'compare' => '=',
                        //                        'value' => $vacId
                        //                    )
                        //                )
                        //            ));
                        //            $existStarStatus = 'no';
                        //            if (is_user_logged_in()) {
                        //                $existStar = new WP_Query(array(
                        //                    'author' => get_current_user_id(),
                        //                    'post_type' => 'vstar',
                        //                    'meta_query' => array(
                        //                        array(
                        //                            'key' => 'my_vac_id',
                        //                            'compare' => '=',
                        //                            'value' => $vacId
                        //                        )
                        //                    )
                        //                ));
                        //                if ($existStar->found_posts) {
                        //                    $existStarStatus = 'yes';
                        //                }
                        //            }
                        //        ?>
                        <!--                                <option data-exist='-->
                        <?php //echo $existStarStatus; ?><!--' value="--><?php //echo get_the_ID(); ?><!--"-->
                        <!--                                    class="vacOption">-->
                        <?php //the_title(); ?><!--</option>-->
                        <!--                                --><?php
                        //            }
                        //            wp_reset_postdata();
                        //            ?>
                        <!--                            </select>-->
                        <!--                            <button type="submit" id="saveMove">Сохранить</button>-->
                        <!--                        </div>-->
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
                                 data-id="<?php the_ID(); ?>" data-pipe="own"
                                 data-fam1="<?php the_field('familiya'); ?>"
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
                                 data-zar="<?php the_field('zarplata'); ?>"
                                 data-cit1="<?php $cand_cit1 = get_field('city_r');
                                 foreach ($cand_cit1 as $c1) {
                                     echo $c1->post_title;
                                 } ?>" data-stat1="<?php the_field('status_r'); ?>"
                                 data-oput="<?php the_field('exp_r'); ?>"
                                 data-compn="<?php the_field('kompaniya'); ?>" <?php $timedb = get_field('dataStart0');
                                 if ($timedb){
                                 ?>data-timedb="<?php echo $timedb; ?>" <?php
                                 }else{ ?>data-timedb="0" <?php }
                            ?>>

                                <div class="mcName">
                                    <!-- <?php
                                    $timedb = get_field('dataStart2');
                                    if ($timedb) {
                                        ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                    } else { ?><input class="time_db" type="number" value="0"><?php }
                                    ?>                     -->
                                    <!-- <script>console.log('dd13');</script> -->
                                    <a href="<?php the_permalink(); ?>">
                                        <p class=""><?php the_field('imya'); ?><?php the_field('familiya'); ?></p>
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
                                    if (get_field('telegram')) {
                                        ?><p class="spec1">Telegram: <?php the_field('telegram'); ?></p><?php
                                    } else {
                                        if (get_field('skype_r')) {
                                            ?><p class="spec1">Skype: <?php the_field('skype_r'); ?></p><?php
                                        }
                                    }
                                    if (get_field('viber_r')) {
                                        ?><p class="spec1">Viber: <?php the_field('viber_r'); ?></p><?php
                                    } else {
                                        if (get_field('email_r')) {
                                            ?><p class="spec1">Email: <?php the_field('email_r'); ?></p><?php
                                        }
                                    }
                                    if (!get_field('telegram') && !get_field('skype_r')) {
                                        if (get_field('tel_r')) {
                                            ?><p class="spec1">Телефон: <?php the_field('tel_r'); ?></p><?php
                                        }
                                    }
                                    if (!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                                        if (get_field('drugoe')) {
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
                                        if (get_field('engl_r')) { ?>
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
                                     data-id="<?php the_ID(); ?>" data-pipe="own"
                                     data-fam1="<?php the_field('familiya'); ?>"
                                     data-tel1="<?php the_field('telegram'); ?>"
                                     data-ema1="<?php the_field('email_r'); ?>"
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
                                } ?>" data-angl="<?php the_field('engl_r'); ?>"
                                     data-reg1="<?php the_field('region'); ?>"
                                     data-zar="<?php the_field('zarplata'); ?>"
                                     data-cit1="<?php $cand_cit1 = get_field('city_r');
                                     foreach ($cand_cit1 as $c1) {
                                         echo $c1->post_title;
                                     } ?>" data-stat1="<?php the_field('status_r'); ?>"
                                     data-oput="<?php the_field('exp_r'); ?>"
                                     data-compn="<?php the_field('kompaniya'); ?>"
                                     <?php $timedb = get_field('dataStart0');
                                     if ($timedb){
                                     ?>data-timedb="<?php echo $timedb; ?>" <?php
                                     }else{ ?>data-timedb="0" <?php }
                                ?>>

                                    <div class="mcName">
                                        <!-- <?php
                                        $timedb = get_field('dataStart2');
                                        if ($timedb) {
                                            ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                        } else { ?><input class="time_db" type="number" value="0"><?php }
                                        ?>                     -->
                                        <!-- <script>console.log('dd13');</script> -->
                                        <a href="<?php the_permalink(); ?>">
                                            <p class=""><?php the_field('imya'); ?><?php the_field('familiya'); ?></p>
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
                                        if (get_field('telegram')) {
                                            ?><p class="spec1">Telegram: <?php the_field('telegram'); ?></p><?php
                                        } else {
                                            if (get_field('skype_r')) {
                                                ?><p class="spec1">Skype: <?php the_field('skype_r'); ?></p><?php
                                            }
                                        }
                                        if (get_field('viber_r')) {
                                            ?><p class="spec1">Viber: <?php the_field('viber_r'); ?></p><?php
                                        } else {
                                            if (get_field('email_r')) {
                                                ?><p class="spec1">Email: <?php the_field('email_r'); ?></p><?php
                                            }
                                        }
                                        if (!get_field('telegram') && !get_field('skype_r')) {
                                            if (get_field('tel_r')) {
                                                ?><p class="spec1">Телефон: <?php the_field('tel_r'); ?></p><?php
                                            }
                                        }
                                        if (!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                                            if (get_field('drugoe')) {
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

                                        <?php if (get_field('spec3')) {
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
                                            }
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
                                            if (get_field('engl_r')) { ?>
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
                        <input class="si i0" type="text" class="myInput" id="i01" placeholder="Шукати по тексту"/>
                    </div>

                    <div class="vtabHead vacdetsep clientVacancyTitle">
                        <p>Дата</p>
                        <p>Позиція</p>
                        <p>ЗП</p>
                        <p>Локація</p>
                        <p>Англійська</p>
                        <p>Відповідальний</p>
                        <p>Пріорітет</p>
                        <p></p>
                    </div>
                    <div class="vac_descr clientVacancy">
                        <?php
                        $teamPageData = new WP_Query(array(
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'post_type' => 'vacancy',
                            'suppress_filters' => false,
                        )); ?>
                        <input readonly value="<?php echo $teamPageData->post_count; ?>" id="phpCount1"
                               class="dp_post_count dnone"> <?php

                        while ($teamPageData->have_posts()) {
                            $teamPageData->the_post(); ?>
                            <div class="task-list-row vac_item vacdetsep clvacwrapp" data-title="<?php the_title(); ?>"
                                 data-spec="<?php the_field('nazva_vakansi'); ?>"
                                 data-angl="<?php the_field('riven_anglijsko'); ?>"
                                 data-opyt="<?php the_field('opyt'); ?>"
                                 data-zarplata="<?php the_field('zarplata1'); ?>"
                                 data-company="<?php the_field('vcompany'); ?>"
                                 data-status="<?php the_field('prioritetnist_vakansi'); ?>"
                                 data-data="<?php the_field('field_645272746b7d4'); ?>"
                                 data-framework="<?php $fr_ctegory = get_field('frejmvork');
                                 foreach ($fr_ctegory as $fr) {
                                     echo $fr->post_title;
                                 } ?>" data-work_format="<?php $cand_ctegory = get_field('format_raboty');
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
                                    <h3><a href="<?php the_permalink(); ?>"
                                           class="vac_title"><?php the_field('nazva_vakansi'); ?></a></h3>
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
                        ?>
                    </div>
                </div>
                <div class="myCli">
                    <div class="sti si clisi search-container">
                        <div class="cl-search">
                            <input class="sticl i0" type="text" class="myInput" id="i02"
                                   placeholder="Шукати по тексту"/>
                            <button id="filterToggle">
                                <img src="<?php echo bloginfo('template_url'); ?>/assets/img/settings.png"
                                     alt="settings"/>
                            </button>
                        </div>
                        <a data-popupcl="open" class="vacancy_menu addcl1">Додати клієнта</a>
                    </div>
                    <div id="filterBox" style="display: none;">
                        <div class="filter-block">
                            <div class="answ" data-pop="1" id="vac_work_format" style="display: block;">
                                <h3>Статус</h3>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input hidden-checkbox vac_work_format"
                                           id="i1" value="Активний">
                                    <label class="custom-control-label" for="i1" 1"="">Активний</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input hidden-checkbox vac_work_format"
                                           id="i2" value="На паузі">
                                    <label class="custom-control-label" for="i2" 1"="">На паузі</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input hidden-checkbox vac_work_format"
                                           id="i3" value="Не активний">
                                    <label class="custom-control-label" for="i3" 1"="">Не активний</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input hidden-checkbox vac_work_format"
                                           id="i4" value="У чорному списку">
                                    <label class="custom-control-label" for="i4" 1"="">У чорному списку</label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-block">
                            <h3>Тип компанії</h3>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input hidden-checkbox cl_type" id="ic1"
                                       value="Аутсорс">
                                <label class="custom-control-label" for="ic1" 1"="">Аутсорс</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input hidden-checkbox cl_type" id="ic2"
                                       value="Аутстафф">
                                <label class="custom-control-label" for="ic2" 1"="">Аутстафф</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input hidden-checkbox cl_type" id="ic3"
                                       value="Продукт">
                                <label class="custom-control-label" for="ic3" 1"="">Продукт</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input hidden-checkbox cl_type" id="ic4"
                                       value="Стартап">
                                <label class="custom-control-label" for="ic4" 1"="">Стартап</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input hidden-checkbox cl_type" id="ic5"
                                       value="Агенція">
                                <label class="custom-control-label" for="ic5" 1"="">Агенція</label>
                            </div>
                        </div>
                    </div>
                    <div class="vac_descr">
                        <?php
                        $teamPageData = new WP_Query(array(
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'post_type' => 'client',
                            'suppress_filters' => false,
                        )); ?>
                        <input readonly value="<?php echo $teamPageData->post_count; ?>" id="phpCount2"
                               class="dp_post_count dnone">
                        <?php while ($teamPageData->have_posts()) {
                            $teamPageData->the_post(); ?>
                            <div class="task-list-row cli_item clidetsep"
                                 data-title="<?php the_field("company_name"); ?>"
                                 data-country="<?php $cloc = get_field('company_lication');
                                 foreach ($cloc as $cl) {
                                     echo $cl->post_title;
                                     if (next($cloc)) {
                                         echo ', ';
                                     }
                                 } ?>" data-site="<?php the_field("company_site"); ?>"
                                 data-data="<?php the_field('data'); ?>" data-status1="<?php the_field('status_cl'); ?>"
                                 data-compt="<?php the_field('company_type'); ?>">
                                <div class="vds1">
                                    <div class="vimgbox">
                                        <div class="vimg">
                                            <a href="<?php the_permalink(); ?>" class="vac_title">
                                                <img class="" src="<?php
                                                if (the_field('company_logo')) {
                                                    the_field('company_logo');
                                                } ?>" style="width: 100%" alt="Client Img">
                                            </a>
                                        </div>
                                    </div>
                                    <h3>
                                        <a href="<?php the_permalink(); ?>"
                                           class="vac_title"><?php the_field("company_name"); ?></a>
                                    </h3>
                                    <div class="vdetails">
                                        <p class="expandable-text"><?php $cloc = get_field('company_lication');
                                            foreach ($cloc as $cl) {
                                                echo $cl->post_title;
                                                if (next($cloc)) {
                                                    echo ', ';
                                                }
                                            } ?></p>
                                    </div>
                                    <div class="vds2">
                                        <a href="<?php the_field('company_site'); ?>"
                                           target="_blank"><?php the_field('company_site'); ?></a>
                                    </div>
                                </div>
                            </div>
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
                            <!--                            --><?php
                            //                            $recomendData = new WP_Query(array(
                            //                                'post_type' => 'sotrudniki',
                            //                                'post_per_page' => -1,
                            //                                'orderby' => 'title',
                            //                                'order' => 'ASC',
                            //                                'meta_query' => array(
                            //                                    array(
                            //                                        'key' => 'id_s',
                            //                                        'compare' => '=',
                            //                                        'value' => get_current_user_id()
                            //                                    )
                            //
                            //                                )
                            //                            ));
                            //                            while ($recomendData->have_posts()) {
                            //                                $recomendData->the_post(); ?>
                            <!--                            --><?php
                            //                                $unique_id = uniqid();
                            //                                acf_form(array(
                            //                                'new_post' => true,
                            //                                    'form_attributes' => array(
                            //                                        'id' => 'acf-form-' . $unique_id,
                            //                                    ),
                            //                                    ));
                            //                            }
                            //                            wp_reset_postdata();
                            //                        ?>
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
                                        if (is_array($spec2) || is_object($spec2)) {
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
                                 data-status="<?php the_field('status_r'); ?>"
                                 data-comp="<?php $komp2 = get_field('komp2');
                                 foreach ($komp2 as $k2) {
                                     echo $k2->post_title;
                                 } ?>" data-vupl1="<?php the_field('data_1'); ?>"
                                 data-vupl2="<?php the_field('data_2'); ?>">
                                <p><?php the_title() ?> <span><?php the_field('data_analitika'); ?></span><span>Статус:
                                    <?php the_field('status_r'); ?></span>
                                    <?php
                                    if (get_field('vypl_1')) { ?>
                                        <span> Выплата 1: <span class="vypl1"><?php the_field('vypl_1'); ?></span><span
                                                    class="v1date"><?php the_field('data_1'); ?></span></span>
                                    <?php }
                                    if (get_field('vypl_2')) { ?>
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
                               autocomplete="off"/>
                        <input type="text" name="event_date6" id="date6" placeholder="Конец периода"
                               autocomplete="off"/>
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
                                 data-date2="<?php the_field('data_analitika'); ?>"
                                 data-status="<?php the_field('status_r'); ?>"
                                 data-comp="<?php $komp2 = get_field('komp2');
                                 foreach ($komp2 as $k2) {
                                     echo $k2->post_title;
                                 } ?>" data-vupl1="<?php the_field('data_1'); ?>"
                                 data-vupl2="<?php the_field('data_2'); ?>">
                                <p><?php the_title() ?><span
                                            class="company"><?php the_field('date_analitiky'); ?></span>
                                    <span><?php the_field('data_analitika'); ?></span><span>Статус:
                                    <?php the_field('status_r'); ?></span>
                                    <?php
                                    if (get_field('vypl_1')) { ?>
                                        <span> Выплата 1: <span class="vypl1"><?php the_field('vypl_1'); ?></span><span
                                                    class="v1date"><?php the_field('data_1'); ?></span></span>
                                    <?php }
                                    if (get_field('vypl_2')) { ?>
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
                        <input readonly value="<?php echo $recomendData->post_count; ?>" id="phpCount3"
                               class="dp_post_count dnone"> <?php
                        while ($recomendData->have_posts()) {
                            $recomendData->the_post(); ?>
                            <div class="myCandW mcd kandItem1 hotOnly"
                                 data-timer="<?php the_field('dataStart0'); ?>"
                                 data-name1="<?php the_field('imya'); ?>" data-id="<?php the_ID(); ?>"
                                 data-fam1="<?php the_field('familiya'); ?>" data-pipe="public"
                                 data-tel1="<?php the_field('telegram'); ?>"
                                 data-ema1="<?php the_field('email_r'); ?>"
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
                                 data-zar="<?php the_field('zarplata'); ?>"
                                 data-cit1="<?php $cand_cit1 = get_field('city_r');
                                 foreach ($cand_cit1 as $c1) {
                                     echo $c1->post_title;
                                 } ?>" data-stat1="<?php the_field('status_r'); ?>"
                                 data-oput="<?php the_field('exp_r'); ?>"
                                 data-compn="<?php the_field('kompaniya'); ?>"
                                 <?php $timedb = get_field('dataStart0');
                                 if ($timedb){
                                 ?>data-timedb="<?php echo $timedb; ?>" <?php
                                 }else{ ?>data-timedb="0" <?php }
                            ?>>

                                <div class="mcName">
                                    <!-- <?php
                                    $timedb = get_field('dataStart2');
                                    if ($timedb) {
                                        ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                    } else { ?><input class="time_db" type="number" value="0"><?php }
                                    ?>                     -->
                                    <!-- <script>console.log('dd13');</script> -->
                                    <a href="<?php the_permalink(); ?>">
                                        <p class=""><?php the_field('imya'); ?><?php the_field('familiya'); ?></p>
                                    </a>
                                    <!-- <p class="hot5"><?php the_field('dataStart0'); ?></p> -->
                                    <input class="hot5 dnone" type="number" value="<?php the_field('dataStart0'); ?>"
                                           placeholder="<?php the_field('dataStart0'); ?>">
                                    <p class="spec1"><?php the_field('region'); ?></p>
                                    <?php
                                    $city = get_field('city_r');
                                    if (is_array($city) || is_object($city)) {
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
                                    if (get_field('telegram')) {
                                        ?><p class="spec1">Telegram: <?php the_field('telegram'); ?></p><?php
                                    } else {
                                        if (get_field('skype_r')) {
                                            ?><p class="spec1">Skype: <?php the_field('skype_r'); ?></p><?php
                                        }
                                    }
                                    if (get_field('viber_r')) {
                                        ?><p class="spec1">Viber: <?php the_field('viber_r'); ?></p><?php
                                    } else {
                                        if (get_field('email_r')) {
                                            ?><p class="spec1">Email: <?php the_field('email_r'); ?></p><?php
                                        }
                                    }
                                    if (!get_field('telegram') && !get_field('skype_r')) {
                                        if (get_field('tel_r')) {
                                            ?><p class="spec1">Телефон: <?php the_field('tel_r'); ?></p><?php
                                        }
                                    }
                                    if (!get_field('telegram') && !get_field('viber_r') && !get_field('skype_r') && !get_field('tel_r')) {
                                        if (get_field('drugoe')) {
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
                                    if (is_array($cand_ctegory) || is_object($cand_ctegory)) {
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
                                    if (is_array($spec2) || is_object($spec2)) {
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
                                    if (is_array($spec3) || is_object($spec3)) {
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
                                        if (get_field('engl_r')) { ?>
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
get_template_part('template-parts/formAddClient');
get_footer(); ?>