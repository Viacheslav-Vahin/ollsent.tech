<?php
/*
Template Name: База кандидатов
*/
$cu = get_current_user_id();
$user = get_userdata( $cu );
$user_roles = $user->roles;
// if ( in_array( 'role_rekruter', $user_roles, false ) || in_array( 'timlid', $user_roles, false ) || 
// !current_user_can('administrator') || !current_user_can('editor') ) {
//     wp_redirect(esc_url(site_url('/')));
//     exit;
// }
if (!current_user_can('administrator') && !current_user_can('editor') && !in_array( 'role_rekruter', $user_roles, true )) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
get_header();
?>
<div class="dp_container pipeW">
<!-- <?php
        $posts = get_posts(array(
            'numberposts' => -1,
//            'category_name'    => 'soft_pets',
            'orderby' => 'date',
            'order' => 'ASC',
            'post_type' => 'sotrudniki',
            'meta_query' => array(
                array(
                    'key' => 'dolzhnost',
                    'compare' => 'LIKE',
                    'value' => 'Рекрутер'
                )  
            )
            // 'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        ));

        foreach ($posts as $post) {
            setup_postdata($post);  ?>
               <p class="rekrId"><?php the_field('id_s') ?></p>
            <?php
        }

        wp_reset_postdata(); // сброс
        ?> -->
    <div id="moveCtoR">
        <h1></h1>
    </div>
    <div id="eventBox" class="dnone"></div>
    
    <p id="ct" class="dnone">ddtt</p>
    <p id="surl7" class="dnone"><?php echo get_site_url() ?></p>
    <!-- <p id="d1">d1</p>
    <p id="d2">d2</p> -->
    <h2 id="countdown" style="font-weight: bold;"></h2>
    <!-- <h1 id="timedb"><?php the_field('test_time'); ?></h1>   -->
    <!-- <input id="timedb" type="text" value="<?php the_field('timedb'); ?>"> -->
    <div class="vac_wrap">
        <div class="left_vac pipe">
            <div id="pipe_filtrs" class="vac_filtrs">
                <div class="f0w">
                    <p class="vft">Фільтри:</p>
                    <p class="vac_filter_res dp_post_count2"></p>
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
                            <select class="lang_left so" id="vac_speciality">
                                <option value="">Всі мови</option>
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
                    </div>
                </div>


                <div class="tech_wrapper">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Фреймворки і CMS:
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                                <!--                                <span class="dashicons dashicons-arrow-right tran"></span>-->
                            </div>
                        </h3>
                        <div class="boxForChosenTech"></div>
                        <div class="answ">
                            <select class="lang_left so" id="vac_framework">
                                <option value="">Усі фреймворки і CMS</option>
                                <?php $countFramew = 0;
                                $teamPageData = new WP_Query(array(
                                    'post_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post_type' => 'specialty',
                                    'suppress_filters' => true,
                                ));
                                while ($teamPageData->have_posts()) {
                                    $teamPageData->the_post();
                                    $countFramew++; ?>
                                <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                <?php
                                } ?>
                                <option class="countFamework"><?php echo $countFramew; ?></option> <?php
                                wp_reset_postdata();
                                ?>
                            </select>
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
                            <select class="lang_left so" id="vac_notech">
                                <option value="">Все Нетехнические</option>
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
                                <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                <?php
                                } ?>
                                <option class="countNoTech dnone"><?php echo $countNoTech; ?></option> <?php
                                wp_reset_postdata();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!--                <div id="wrapper">-->
                <!--                    <input id="range" type="range" value="0">-->
                <!--                    <input type="text" id="range-value">-->
                <!--                </div>-->

                <!--            <p><input type="range" min="0.5" max="15" id="size" oninput="sizePic()" value="3"></p>-->
                <div class="fiw">
                    <h3>Досвід роботи: <span class="transp">a</span><span class="oputVal" id="opyt_vacans">0</span>
                        <span class="oputVal">років</span>
                    </h3>
                    <p><input type="range" min="0" max="15" step="0.5" id="opyt_vacans_input" oninput="fun1()" value="0"
                            class="opyt_input"></p>

                </div>
                <div class="zarplata fiw">
                    <h3>ЗП Очікування</h3>
                    <div class="zarplata_data">
                        <!--                        <span>$ </span>-->

                        <input id="zarpl" type="number" placeholder="$0">
                        <span class="krapku"><span>...</span></span>
                        <input id="zarpl_to" type="number" placeholder="$0">
                    </div>
                </div>
                <section class="engl fiw">
                    <h3>Англійска мова:</h3>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format" id="ve1" value="(A1)">
                        <label class="custom-control-label" for="ve1">Beginner / Elementary (A1)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format" id="ve2" value="(A2)">
                        <label class="custom-control-label" for="ve2">Pre-intermediate (A2)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format" id="ve3" value="(B1)">
                        <label class="custom-control-label" for="ve3">Intermediate (B1)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format" id="ve4" value="(B2)">
                        <label class="custom-control-label" for="ve4">Upper-intermediate (B2)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format" id="ve5" value="(C1)">
                        <label class="custom-control-label" for="ve5">Advanced (C1)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input vac_work_format" id="ve6" value="(C2)">
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
                                <input type="checkbox" class="custom-control-input vac_work_format"
                                    id="i<?php echo $countFormat; ?>" value="<?php the_title(); ?>">
                                <label class="custom-control-label" for="i<?php echo $countFormat; ?>"
                                    <?php echo $countFormat; ?>"><?php the_title(); ?></label>
                            </div>
                            <?php
                            }
                            wp_reset_postdata();
                            ?>

                            <!--<div id="total"></div>-->
                            <!--                            <div class="custom-control custom-checkbox">-->
                            <!--                                <input type="checkbox" class="custom-control-input" id="format1" value="Удаленно">-->
                            <!--                                <label class="custom-control-label" for="format1">Удаленно</label>-->
                            <!--                            </div>-->
                            <!--                            <div class="custom-control custom-checkbox">-->
                            <!--                                <input type="checkbox" class="custom-control-input" id="format2" value="Офис">-->
                            <!--                                <label class="custom-control-label" for="format2">Офис</label>-->
                            <!--                            </div>-->
                            <!--                            <div class="custom-control custom-checkbox">-->
                            <!--                                <input type="checkbox" class="custom-control-input" id="i3" value="Неполный день">-->
                            <!--                                <label class="custom-control-label" for="i3">Неполный день</label>-->
                            <!--                            </div>-->
                            <!--                            <div class="custom-control custom-checkbox">-->
                            <!--                                <input type="checkbox" class="custom-control-input" id="i4" value="Полный день">-->
                            <!--                                <label class="custom-control-label" for="i4">Полный день</label>-->
                            <!--                            </div>-->
                        </div>
                    </div>
                </div>
               <div class="reg_wrap">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Регион:
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                            </div>
                        </h3>
                        <div class="boxRegion"></div>
                        <div class="answ">
                            <select size="2" class="lang_left so" id="regSelect">
                                <option value="">Все регионы</option>
                                <option value="Украина">Украина</option>
                                <option value="Другие регионы">Другие регионы</option>
                            </select>
                        </div>
                    </div>
                </div>
               <div class="city_wrapper">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title">Город:
                            <div class="qa_icon_wrapper tran">
                                <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                            </div>
                        </h3>
                        <div class="boxForChosenCity"></div>
                        <div class="answ">
                            <select class="lang_left vac_city so" id="citySelect">
                                <option value="">Все города</option>
                                <?php $countCity = 0;
                                $citiesData = new WP_Query(array(
                                    'post_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post_type' => 'cities',
                                    'suppress_filters' => false,
                                ));
                                while ($citiesData->have_posts()) {
                                    $citiesData->the_post();
                                    $countCity++; ?>
                                <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                <?php
                                } ?>
                                <option class="countCities"><?php echo $countCity; ?></option> <?php
                                wp_reset_postdata();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right_vac">
                <div id="moveToRekr">
                <h2 data-rekr="<?php $cu = get_current_user_id(); echo $cu; ?>">
                    Забрати <span id="cName"></span> на вакансію<span class="close1">×</span></h2>
                        
                <select class="" id="mVac">
                    <option value=0>Вакансії</option>
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
                <option data-exist='<?php echo $existStarStatus; ?>' value="<?php echo get_the_ID(); ?>" class="vacOption"><?php the_title(); ?></option>
                <?php
                    }
                    wp_reset_postdata();
                    ?>
                </select>
                <button type="submit" id="saveMove">Сохранить</button>
            </div>
            <div class="pipef si">
                <input class="si i0" type="text" id="pipe0" placeholder="Шукати по тексту">
            </div>
            <div class="" id="bazaHead">
                <p>Ім'я</p>
                <p>Деталі</p>
                <p>Статус</p>
                <p>Дата</p>
                <p>
                <?php
                    if (current_user_can('administrator')|| in_array( 'editor', $user_roles, true )) { echo 'Выплаты'; }
                ?>
                </p>
                <p>
                <?php
                    if (current_user_can('administrator')|| in_array( 'editor', $user_roles, true )) { echo 'Рекрутёр'; }
                ?>
                    </p>
            </div>
            <section class="allmr pipeCont">
                <?php
                    //                $cu = get_current_user_id(); echo $cu;
                    //                global $recomendData;
                    $recomendData = new WP_Query(array(
                        'post_type' => 'candidate',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
//                        'meta_query' => array(
//                            'meta_query' => array(
//                                array(
//                                    'key' => 'status_r',
//                                    'compare' => 'IN',
//                                    'value' => array('В Базі канд')
//                                    //'value' => array('На паузе', 'Офер', 'В работе', 'Новый', 'Занятий')
//                                ),
//                                array(
//                                    'key' => 'status_r',
//                                    'compare' => 'NOT IN',
//                                    'value' => array('Особистий', 'На паузі', 'Офер', 'В роботі', 'Новий', 'Занятий')
//                                )
//                            )
//                        )






//                    'suppress_filters' => false,
//                        'post_type' => 'rekomend',
//
//                        'meta_key' => 'dataStart2',
//                        'orderby' => 'meta_value_num',
//                        'order' => 'DESC',
//                        'meta_query' => array(
//                            'meta_query' => array(
//                                array(
//                                    'key' => 'status_r',
//                                    'compare' => 'IN',
//                                    'value' => array('В Базі канд')
//                                    //'value' => array('На паузе', 'Офер', 'В работе', 'Новый', 'Занятий')
//                                ),
//                                array(
//                                    'key' => 'status_r',
//                                    'compare' => 'NOT IN',
//                                    'value' => array('Особистий', 'На паузі', 'Офер', 'В роботі', 'Новий', 'Занятий')
//                                )
//                            )
//                        )
////                    'suppress_filters' => false,
                    )); ?>
                <input readonly value="<?php echo $recomendData->post_count; ?>" id="phpCount" class="dp_post_count2 dnone">
                    <?php while ($recomendData->have_posts()) {
                        $recomendData->the_post(); ?>
                <div class="myCandW mcd kandItem1 baza"
                data-timer="<?php the_field('dataStart0'); ?>"
                data-name1="<?php the_field('imya'); ?>"
                data-pipe="public"
                data-id="<?php the_ID(); ?>"
                    data-fam1="<?php the_field('familiya'); ?>" data-tel1="<?php the_field('telegram'); ?>"
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
                    data-zar="<?php the_field('zarplata'); ?>"
                    data-country="<?php the_field('pipe_country'); ?>"
                    data-cit1="<?php $cand_cit1 = get_field('city_r');
                         foreach ($cand_cit1 as $c1) {
                             echo $c1->post_title;
                         } ?>" data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
                    data-compn="<?php $cand_s3 = get_field('komp_last');
                     foreach ($cand_s3 as $s3) {
                         echo $s3->post_title;
                     } ?>"
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

                        <?php
                        $spec3 = get_field('spec3');
                        if (is_array($spec3) || is_object($spec3))
                            {
                                    foreach ($spec3 as $s3)
                                {
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
                        <p class="spec1">Стаж: <?php the_field('exp_r') ?></p>



                       
                        
                        <!-- <p class="spec1">Linkedin: <?php the_field('linkedin'); ?></p>
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
                                ?> -->
                        <?php if (get_field('zarplata')): ?>
                        <span class="spec1">Побажання по ЗП $<?php the_field('zarplata'); ?></span>
                        
                        <?php
                         $comp = get_field('komp_last');
                         if ($comp) {
                                    foreach ($comp as $c) {
                                        ?>
                        <p class="spec1">Компанія:<span class="dnone">a</span>
                            <?php
                                    echo $c->post_title;
                                    } ?></p><?php
                                 } ?>
                                    



                    </div>
                    <div class="mcd1">
                    <?php
                        $country = get_field('pipe_country');
                        if ($country) {
                            ?>
                                <p><?= $country; ?></p>
                            <?php
                        }
                        ?>
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
                       
                        <!-- <?php if (get_field('exp_r')) { ?>
                        <p class="spec1"> Опыт, лет: <?php the_field('exp_r'); ?></p>
                        <?php } ?> -->

                        <?php if (get_field('tip_raboty')) {
                             $tip_raboty = get_field('tip_raboty');
                             foreach ($tip_raboty as $tr) {
                                 ?>
                        <p class="spec1">Формат: <span class="dnone">a</span>
                            <?php
                             echo $tr->post_title;
                             if (next($tip_raboty)) {
                                 echo ',';
                             }
                             ?>
                            <span class="dnone">a</span></p>
                        <?php
                             } 
                         } 
                         if(get_field('engl_r')) { ?>
                        <p class="spec1">Англ: <span class="dnone">a</span><?php the_field('engl_r'); ?></p>
                        <?php }
                         ?>

                        <?php endif; ?>
                    </div>
                    <div class="mcs">
                    <?php
                        $status_r = get_field('status_r');
                        if (is_array($status_r) || is_object($status_r))
                            {
                    ?>
                                <p class="stat4"><?php echo $status_r; ?></p>
                    <?php
                            }
                    ?>
                    </div>
                    <div class="mcd2">
                        <!-- <button type="button" class="getToVac">Забрать на Вакансию</button> -->
                    </div>
                    <div class="mcVupl">
                    <?php
                    if (current_user_can('administrator') || in_array( 'editor', $user_roles, true )) {
                        if(get_field('vyplaty')) { ?>
                            <p class="spec1">$<span class="dnone">a</span><?php the_field('vyplaty'); ?></p>
                            <?php }
                    }
                             ?>
                                          
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
<?php
 if (is_user_logged_in() && current_user_can('publish_freelancers')) { 
    get_template_part('template-parts/formAddCand');
   // get_template_part('template-parts/candToRekr');
 }
get_footer(); ?>