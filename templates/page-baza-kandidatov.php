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
acf_form_head(); get_header();
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
    <div class="vac_wrap">
        <div class="left_vac pipe">
            <div class="top_filter_buttons">
                <button id="reset-filters">Скинути фільтри</button>
                <span class="openEditFilter">✎</span>
            </div>
            <div id="pipe_filtrs" class="vac_filtrs">
                <div class="f0w">
                    <p class="vft">Фільтри:</p>
                    <p class="vac_filter_rest">Знайдено кандидатів: <span class="fon"></span>/<span class="son"></span></p>
<!--                    <p class="vac_filter_res dp_post_count2"></p>-->
                    <div class="bnt_main_top">
                        <button id="button1" contenteditable="false"><?php the_field('it')?></button>
                        <button id="button2" contenteditable="false"><?php the_field('plus')?></button>
                    </div>
                </div>
                <div class="specnoit">
                    <button id="add-block-button-noitposts" data-type="noitposts">Додати новий блок</button>
                </div>
                <div class="specit">
                    <button id="add-block-button-language" data-type="language">Додати новий блок</button>
                    <div class="fiw">
                    <h3 class="noheading nobottom">Досвід роботи: <span class="transp">a</span><span class="oputVal" id="opyt_vacans">0</span>
                        <span class="oputVal">років</span>
                    </h3>
                    <p>
                        <input type="range" min="0" max="15" step="0.5" id="opyt_vacans_input" oninput="fun1()" value="0" class="opyt_input">
                    </p>

                </div>
                <div class="zarplata fiw">
                    <h3 class="noheading nobottom">ЗП Очікування</h3>
                    <div class="zarplata_data">
                        <input id="zarpl" type="number" placeholder="$0">
                        <span class="krapku"><span>...</span></span>
                        <input id="zarpl_to" type="number" placeholder="$0" style="display:none">
                        <input id="zarpl_to_actual" type="number" placeholder="$0">
                    </div>
                </div>
                    <div class="filter-block">
                        <input type="checkbox" id="cv_ch" value="" checked><label for="cv_ch">Показати кандидатів з CV</label>
                    </div>
                    <div class="mova_wrapper fiw">
                        <div class="q_a togleShow fh">
                            <h3 id="accordion-title-999999" class="accordion-title editable noheading" contenteditable="false" data-postid="<?php echo get_the_ID(); ?>">Мова</h3>
                            <div class="boxForChosenNoTech"></div>
                                <div class="lang_left so" id="vac_mova">
                                    <?php $countMova = 0;
                                    $movaPageData = new WP_Query(array(
                                        'post_per_page' => -1,
                                        'orderby' => 'title',
                                        'order' => 'ASC',
                                        'post_type' => 'mova',
                                        'suppress_filters' => true,
                                        'meta_query' => array(
                                            'relation' => 'OR',
                                            array(
                                                'key' => 'block_id',
                                                'compare' => 'NOT EXISTS', // для постов, где 'block_id' не установлен
                                            ),
                                            array(
                                                'key' => 'block_id',
                                                'value' => '', // для постов, где 'block_id' установлен, но пуст
                                                'compare' => '=',
                                            ),
                                        ),
                                    ));
                                    while ($movaPageData->have_posts()) {
                                        $movaPageData->the_post();
                                        $delete_nonce = wp_create_nonce('delete_post_' . get_the_ID());
                                        $countMova++; ?>
                                        <label class="chbwr">
                                            <input type="checkbox" class="spec1-checkbox hidden-checkbox" value="<?php the_title(); ?>">
                                            <span class="chbwr-text"><?php the_title(); ?></span>
                                            <button class="delete-post-button" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo $delete_nonce; ?>" data-metakey="spec1">×</button>
                                        </label>
                                        <?php
                                    } ?>
                                    <?php render_post_form('mova', false); ?>
                                </div>
                        </div>
                        <section class="engl fiw">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve1" data-level="Beginner / Elementary (A1)" data-number="1" value="Beginner / Elementary (A1)">
                                <label class="custom-control-label" for="ve1">Beginner / Elementary (A1)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve2" data-level="Pre-intermediate (A2)" data-number="2" value="Pre-intermediate (A2)">
                                <label class="custom-control-label" for="ve2">Pre-intermediate (A2)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve3" data-level="Intermediate (B1)" data-number="3" value="Intermediate (B1)">
                                <label class="custom-control-label" for="ve3">Intermediate (B1)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve4" data-level="Upper-intermediate (B2)" data-number="4" value="Upper-intermediate (B2)">
                                <label class="custom-control-label" for="ve4">Upper-intermediate (B2)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve5" data-level="Advanced (C1)" data-number="5" value="Advanced (C1)">
                                <label class="custom-control-label" for="ve5">Advanced (C1)</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input vac_work_format hidden-checkbox" id="ve6" data-level="Fluent (C2)" data-number="6" value="Fluent (C2)">
                                <label class="custom-control-label" for="ve6">Fluent (C2)</label>
                            </div>
                        </section>
                    </div>

                <section class="communications fiw">
                    <div class="q_a togleShow fh active">
                    <h3 id="accordion-title-9999999" class="accordion-title editable noheading" contenteditable="false" data-postid="<?php echo get_the_ID(); ?>">Контакти</h3>
                    <div class="boxForChosenNoTech"></div>
                    <div class="lang_left so" id="vac_mova">
                        <?php
                        $countContacts = 0;
                        $contactsPageData = new WP_Query(array(
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'post_type' => 'contacts',
                            'suppress_filters' => true,
                            'meta_query' => array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'block_id',
                                    'compare' => 'NOT EXISTS', // для постов, где 'block_id' не установлен
                                ),
                                array(
                                    'key' => 'block_id',
                                    'value' => '', // для постов, где 'block_id' установлен, но пуст
                                    'compare' => '=',
                                ),
                            ),
                        ));
                        while ($contactsPageData->have_posts()) {
                            $contactsPageData->the_post();
                            $delete_nonce = wp_create_nonce('delete_post_' . get_the_ID()); ?>
                            <label class="chbwr custom-control custom-checkbox">
                                <input type="checkbox" class="spec1-checkbox-c hidden-checkbox custom-control-input vac_communications" id="vc<?php echo $countContacts; ?>" data-level="<?php the_title(); ?>" value="<?php the_title(); ?>">
                                <span class="chbwr-text"><?php the_title(); ?></span>
                                <button class="delete-post-button" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo $delete_nonce; ?>" data-metakey="spec1">×</button>
                            </label>
                            <?php
                            $countContacts++;
                        } ?>
                        <?php render_post_form('contacts', false); ?>
                    </div>
                    </div>
                </section>

                <div class="qa_wrapper fiw workformats">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title noheading">Формат роботи</h3>
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
                                $delete_nonce = wp_create_nonce('delete_post_' . get_the_ID());
                                $countFormat++; ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input hidden-checkbox vac_work_format"
                                    id="i<?php echo $countFormat; ?>" data-level="<?php the_title(); ?>" value="<?php the_title(); ?>">
                                <label class="custom-control-label" for="i<?php echo $countFormat; ?>"
                                    <?php echo $countFormat; ?>"><?php the_title(); ?></label>
                                <button class="delete-post-button" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo $delete_nonce; ?>" data-metakey="spec1">×</button>
                            </div>
                            <?php
                            }
                            wp_reset_postdata();
                            ?>
                            <?php render_post_form('work_format', false); ?>
                        </div>
                    </div>
                </div>

               <div class="city_wrapper fiw" style="display: block;">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title noheading">Регіон:</h3>
                        <div class="boxForChosenCity"></div>
                        <div class="answ">
                            <input type="text" id="countrySearch" placeholder="Пошук країни...">
                            <div class="allcountr multiselect">
                                <?php
                                $args = array(
                                    'post_type' => array('countries'),
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'suppress_filters' => true,
                                );
                                $custom_query = new WP_Query($args);
                                $tech_id = 0;
                                $other_countries = array(); // создаем массив для "Инших" стран
                                if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); $delete_nonce = wp_create_nonce('delete_post_' . get_the_ID()); ?>
                                    <?php
                                    if (get_the_title() == 'Інші') {
                                        $other_countries[] = '<div class="countrySing" id="countrID' . $tech_id . '" class="countr_sc">' . get_the_title() . '</div>';
                                    } else {
                                        echo '<div class="countrySing" id="countrID' . $tech_id . '" class="countr_sc">' . get_the_title() . '<button class="delete-post-button" data-id="' . get_the_ID() . '" data-nonce="'. $delete_nonce .'" data-metakey="spec1">×</button></div>';
                                    }
                                    $tech_id++;
                                endwhile;

                                    // выводим "Иншие" страны в конце списка
                                    foreach ($other_countries as $country) {
                                        echo $country;
                                    }
                                endif;
                                wp_reset_postdata(); ?>
                                <?php render_post_form('countries', false); ?>
                            </div>
                            <input type="hidden" id="vac_country" value="">
                        </div>
                    </div>
                </div>
            </div>
                <div id="confirm-dialog" title="Подтверждение удаления" style="display:none;">
                    <p>Ви дійсно хочете видалити цю позицію фільтру?</p>
                </div>
                <div id="confirm-dialog-block" title="Подтверждение удаления" style="display:none;">
                    <p>Ви дійсно хочете видалити увесь блок з його вмістом?</p>
                    <i>Блок можливо відновити у розділі "Видалені підрозділи фільтру"</i>
                </div>
                <div id="error-notification" style="display: none;"></div>
                <div class="deleted-blocks-wrapper">
                    <h3 class="accordion-title-blocks">Видалені підрозділи фільтру</h3>
                    <div id="deleted-blocks-section"></div>
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
                    <select class="" id="mStage" style="display:none;">
                        <!-- Здесь будут добавлены этапы співбесід через AJAX -->
                    </select>
                <button type="submit" id="saveMove">Сохранить</button>
            </div>
            <div class="pipef si search-container">
                <input class="si i0" type="text" id="pipe0" placeholder="Шукати по тексту">
                <div class='selectedElements'></div>
                    <button id="filterToggle">
                        <img src="<?php echo bloginfo('template_url'); ?>/assets/img/settings.png" alt="settings"/>
                    </button>
            </div>
            <div class="alltechwrapper" style="display: none;">
                <?php sbfilter_function(); ?>
            </div>
            <div id="filterBox" style="display: none;">
                <div class="filter-block">
                    <h3>Пошук по даті:</h3>
                    <div class="inputWr"><label>З:</label><input type="date" id="dateFrom" placeholder="З"></div>
                    <div class="inputWr"><label>ПО:</label><input type="date" id="dateTo" placeholder="До"></div>
                </div>
                <div class="filter-block">
                    <h3>Збережені пошуки:</h3>
                    <input id="filter-name" type="text" placeholder="Назва пошуку">
                    <button id="save-filter">Зберегти пошук</button>
                    <div id="saved-filters"></div>
                </div>
<!--                <div class="filter-block">-->
<!--                    <input type="checkbox" id="my-candidates-checkbox">-->
<!--                    <label for="my-candidates-checkbox">Мої кандидати</label>-->
<!--                </div>-->
                <div class="filter-block rec_cand">
                    <h3>Кандидати</h3>
                    <?php
                    $users = get_users();

                    echo '<select name="user_select" id="user_select" multiple>';
                    echo '<option value="all" selected>Усі</option>';
                    foreach ($users as $user) {
                        echo '<option value="' . esc_attr($user->ID) . '" data-id="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
                    }
                    echo '</select>';
                    ?>

                </div>
                <div class="qa_wrapper fiw tags_wrapper">
                    <div class="q_a togleShow fh">
                        <h3 class="accordion-title" >Теги</h3>
                        <div class="boxForChosenFormat"></div>
                        <div class="answ" data-pop="1" id="vac_tag">
                            <?php $countTaFormat = 0;
                            $tagPageData = new WP_Query(array(
                                'post_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'post_type' => 'tagstype',
                                'suppress_filters' => true,
                            ));
                            while ($tagPageData->have_posts()) {
                                $tagPageData->the_post();
                                $delete_tanonce = wp_create_nonce('delete_post_' . get_the_ID());
                                $countTaFormat++; ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input hidden-checkbox vac_tags"
                                           id="tai<?php echo $countTaFormat; ?>" data-level="<?php the_title(); ?>" value="<?php the_title(); ?>">
                                    <label class="custom-control-label" for="tai<?php echo $countTaFormat; ?>"
                                    <?php echo $countTaFormat; ?>"><?php the_title(); ?></label>
                                    <button class="delete-post-button" data-id="<?php echo get_the_ID(); ?>" data-nonce="<?php echo $delete_tanonce; ?>" data-metakey="spec1">×</button>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                            <?php render_post_form('tagstype', false); ?>
                        </div>
                    </div>
                </div>
                <div class="filter-block">
                    <input type="checkbox" id="blacklist">
                    <label>Сховати в чорному списку</label>
                </div>
            </div>
            <div class="" id="bazaHead">
                <p class="datasort">Дата
                    <button id="sortAsc" data-sort="ASC">↑</button>
                    <button id="sortDesc" data-sort="DESC">↓</button>
                </p>
                <p>Імя Прізвище</p>
                <p>Локація</p>
                <div class="lb-wr">
                    ЗП:
                    <label>
                        <input class="tsort sup" type="radio" name="date" value="ASC" style="display: none" /> ↑
                    </label>
                    <label>
                        <input class="tsort sdown" type="radio" name="date" value="DESC" selected="selected" style="display: none" /> ↓
                    </label>
                    <input type="hidden" name="action" value="myfilter">
                </div>
                <p>Англійська</p>
                <p>Контакти</p>
                <p>CV</p>
                <p></p>
            </div>
<!--            <div class="buttons btns-view">-->
<!--                <button class="grid"><img src="--><?php //echo bloginfo('template_url'); ?><!--/assets/img/grid.png" style="width: 30px; height: 30px;" alt="Сітка" title="Сітка"/></button>-->
<!--                <button class="list"><img src="--><?php //echo bloginfo('template_url'); ?><!--/assets/img/list.svg" style="width: 24px; height: 30px;"  alt="Список" title="Список"/></button>-->
<!--            </div>-->
            <?php
            $name_filter = isset($_GET['name']) ? sanitize_text_field($_GET['name']) : null;
            $it = 0;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => array('candidate','rekomend'),
                'meta_key' => 'dataStart2',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'posts_per_page' => 3,
                'paged' => $paged,
            );

            if ($name_filter) {
                $args['meta_query'] = array(
                    array(
                        'key' => 'imya',
                        'value' => $name_filter,
                        'compare' => '=',
                    )
                );
            }

            $recomendData = new WP_Query($args); ?>
            <input readonly value="<?php echo $recomendData->post_count; ?>" id="phpCount" class="dp_post_count2 dnone">
            <div id="loader">
                <img src="<?php echo bloginfo('template_url'); ?>/assets/img/loader.png" alt="settings"/>
            </div>

            <section class="allmr pipeCont list">
<!--                --><?php //while ($recomendData->have_posts()) {
//                        $recomendData->the_post(); ?>
<!--                --><?php
//                $contactData = '';
//                if(have_rows('kontakti22')){ // проверка, есть ли строки в повторителе 'kontakti22'
//                        while(have_rows('kontakti22')): the_row(); // если есть строки, начинаем цикл
//                            $contactData = get_sub_field('dannik'); // получаем значение подполя 'dannik'
//                        endwhile;
//                    }
//                ?>
<!--                <div class="myCandW mcd kandItem1 baza"-->
<!--                data-pdf="--><?php //the_field('pdf_parsed'); ?><!--"-->
<!--                data-timer="--><?php //the_field('dataStart0'); ?><!--"-->
<!--                data-name1="--><?php //the_field('imya'); ?><!--"-->
<!--                data-bl="--><?php //if (get_field('prichina_bl')) {echo "blacklist";} ?><!--"-->
<!--                data-name1="--><?php //the_field('imya'); ?><!--" data-mova="--><?php //$mova = get_field('mova_p'); foreach ($mova as $mv) {
//                    echo $mv->post_title . ', ';
//                } ?><!--"-->
<!--                data-pipe="public"-->
<!--                data-id="--><?php //the_ID(); ?><!--"-->
<!--                    data-fam1="--><?php //the_field('familiya'); ?><!--" data-tel1="--><?php //the_field('telegram'); ?><!--"-->
<!--                    data-ema1="--><?php //the_field('email_r'); ?><!--"-->
<!--                     data-spec1="--><?php //$cand_s1 = get_field('spec1');
//                     foreach ($cand_s1 as $s1) {
//                         echo $s1->post_title . ', ';
//                     }?><!--, --><?php //$tehnichninetehnichni = get_field('posada_inshi');
//                     foreach ($tehnichninetehnichni as $ts1) {
//                         echo $ts1->post_title . ', ';
//                     }?><!--"-->
<!--                     data-spec4="--><?php //$cand_s1 = get_field('spec4');
//                     foreach ($cand_s1 as $s1) {
//                         echo $s1->post_title . ', ';
//                     }?><!--"-->
<!--                     data-angl="--><?php //echo get_field('engl_r'); ?><!--" data-reg1="--><?php //the_field('region'); ?><!--"-->
<!--                     data-cont="--><?php //echo $contactData; ?><!--"-->
<!--<!--                     data-cont="-->--><?php ////$f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['label'] . " "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['label'] . " "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['label'] . " "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['label'] . " "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['label'] . " "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['label']; }?><!--<!--"-->-->
<!--                     data-contval="--><?php //$f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['value'] . ", "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['value'] . ", "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['value'] . ", "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['value'] . ", "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['value'] . ", "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['value']; }?><!--" data-work_format="--><?php //$cand_tipr = get_field('tip_raboty');
//                foreach ($cand_tipr as $tr) {
//                    echo $tr->post_title;
//                } ?><!--"-->
<!--                    data-zar="--><?php //the_field('zarplata'); ?><!--"-->
<!--                    data-country="--><?php //$city = get_field('city_r'); foreach ($city as $c) { ?><!----><?php //echo $c->post_title;} ?><!--"-->
<!--                    data-stat1="--><?php //the_field('status_r'); ?><!--" data-oput="--><?php //the_field('exp_r'); ?><!--"-->
<!--    --><?php //if(get_field('komp_last')) { ?>
<!--                    data-compn="--><?php //$cand_s3 = get_field('komp_last');
//                     foreach ($cand_s3 as $s3) {
//                         echo $s3->post_title;
//                     }
//    } ?><!--"-->
<!--                    --><?php //$timedb = get_field('dataStart0');
//                         if($timedb){
//                            ?><!--data-timedb="--><?php //echo $timedb; ?><!--" --><?php
//                         }else{ ?><!--data-timedb="0" --><?php //}
//                    ?><!-->-->
<!---->
<!--                    <div class="bk_time">-->
<!--                        <p class="">--><?php //the_field('field_61c9624e3d8fc'); ?><!--</p>-->
<!--                    </div>-->
<!--                    <div class="mcName">-->
<!--                        <!-- --><?php
//                    $timedb = get_field('dataStart2');
//                     if($timedb){
//                        ?><!--<input class="time_db" type="number" value="--><?php //echo $timedb; ?><!--">--><?php
//                     }else{ ?><!--<input class="time_db" type="number" value="0">--><?php //}
//                    ?><!--                     -->-->
<!--                        <!-- <script>console.log('dd13');</script> -->-->
<!--                        <div class="bk_name">-->
<!--                            <a href="--><?php //the_permalink(); ?><!--">-->
<!--                                <p class="">--><?php //the_field('imya'); ?><!-- --><?php //the_field('familiya'); ?><!--</p>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="bk_mid1">-->
<!--                        <div class="bk_country">-->
<!--                            --><?php //$city = get_field('city_r');
//                            if($city) {
//                                foreach ($city as $c) {
//                                    ?>
<!--                                    <span class="spec1">-->
<!--                            --><?php
//                            echo $c->post_title;
//                            if (next($city)) {
//                                echo ',';
//                            }
//                            ?>
<!--                            <span class="dnone">a</span></span>-->
<!--                                    --><?php
//                                }
//                            } ?><!--</div>-->
<!--                    </div>-->
<!--                    <div class="bk_mid1">-->
<!--                        <div class="bk_zp">-->
<!--                            <span class="spec1">ЗП $--><?php //the_field('zarplata'); ?><!--</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="bk_mid2">-->
<!--                        --><?php //if(get_field('engl_r')) { ?>
<!--                            <div class="bk_angl">-->
<!--                                <p class="spec1">Англ: <span class="dnone">a</span>--><?php //the_field('engl_r'); ?><!--</p>-->
<!--                            </div>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!--                <div class="bk_mid2 cont_wrapper">-->
<!--                    <div class="bk_cont">-->
<!--                        --><?php
//                        if (get_field('linkedin')) {
//                            ?><!--<a href="https://www.linkedin.com/in/--><?php //the_field('linkedin'); ?><!--" class="spec1 cp_btn bk_linkedin" id="bk_linkedin--><?php //echo $it;?><!--"><span>--><?php //the_field('linkedin'); ?><!--</span></a>--><?php
//                        }
//                        if (get_field('telegram')) {
//                            ?><!--<a href="tg://resolve?domain=--><?php //the_field('telegram'); ?><!--" class="spec1 cp_btn bk_telegram" id="bk_telegram--><?php //echo $it;?><!--"><span>--><?php //the_field('telegram'); ?><!--</span></a>--><?php
//                        }
//                        if (get_field('skype_r')) {
//                            ?><!--<a href="skype:--><?php //the_field('skype_r'); ?><!--?chat" class="spec1 cp_btn bk_skype" id="bk_skype--><?php //echo $it;?><!--" target="_blank"><span>--><?php //the_field('skype_r'); ?><!--</span></a>--><?php
//                        }
//                        if (get_field('viber_r')) {
//                            ?><!--<a href="viber://chat?number=%2B--><?php //the_field('viber_r'); ?><!--" class="spec1 cp_btn bk_viber" id="bk_viber--><?php //echo $it;?><!--" target="_blank"><span>--><?php //the_field('viber_r'); ?><!--</span></a>--><?php
//                        }
//                        if (get_field('email_r')) {
//                            ?><!--<a href="javascript:void(0);" class="spec1 cp_btn bk_email" id="bk_email--><?php //echo $it;?><!--"><span>--><?php //the_field('email_r'); ?><!--</span></a>--><?php
//                        }
//                        if (get_field('tel_r')) {
//                        ?><!--<a href="javascript:void(0);" class="spec1 cp_btn bk_phone" id="bk_phone--><?php //echo $it;?><!--"><span>--><?php //the_field('tel_r'); ?><!--</span></a>--><?php
//                        }
//                        ?>
<!--                    </div>-->
<!--                </div>-->
<!--                    <div class="bk_end">-->
<!--                        <div class="bk_cv">-->
<!--                            <a href="javascript:void(0);" class="modalCv" id="modal-launcher">CV</a>-->
<!--                            <div id="modal-background"></div>-->
<!--                            <div id="modal-content">-->
<!--                                <button id="modal-close">✖</button>-->
<!--                                --><?php
//                                $resume_id = get_field('resume_r');
//                                // URL файла с помощью идентификатора
//                                $resume_url = wp_get_attachment_url($resume_id);
//                                ?>
<!--                                --><?php
//                                if (get_field('prichina_bl')) { ?>
<!--                                    <button class="lb-bl bkpage" id="open-popup">В чорному списку!!!</button>-->
<!--                                    <div id="popup" class="popup">-->
<!--                                        <div id="popup-content">-->
<!--                                            <p>--><?php //the_field('povnij_opis_chs')?><!--</p>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                --><?php //} ?>
<!--                                <embed src="--><?php //echo $resume_url; ?><!--" frameborder="0" width="100%" height="700px">-->
<!--                                --><?php //$post_id = get_the_ID(); // Получите ID текущего поста
//                                $docx_attach_id = get_post_meta($post_id, 'resume_docx', true); // ID вложения .docx файла
//                                $docx_url = wp_get_attachment_url($docx_attach_id); //URL вложения .docx файла
//                                ?>
<!--                                <a href="--><?php //echo $docx_url; ?><!--" class="dnl_btn" download="">Завантажити у форматі .docx</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="bk_end">-->
<!--                        <button type="button" class="getToVac">Взяти на вакансію</button>-->
<!--<!--                        <button class="favorite-star" data-candidate-id="-->--><?php ////echo get_the_ID(); ?><!--<!--">-->-->
<!--<!--                            <i class="fas fa-star"></i>-->-->
<!--<!--                            eeeeeee-->-->
<!--<!--                        </button>-->-->
<!--                        <button class="favorite-star" data-candidate-id="--><?php //echo get_the_ID(); ?><!--">-->
<!--                            ☆-->
<!--                        </button>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                --><?php
//                        $it++; }
//                    wp_reset_postdata();
//                    ?>
            </section>
            <div class="pagination-links linksDefault">
                <?php
                $big = 999999999; // нужно большое число
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'total' => $recomendData->max_num_pages,
                    'current' => max( 1, get_query_var('paged') ),
                    'prev_text' => '«',
                    'next_text' => '»',
                ));
                ?>
            </div>
<!--            <button id="load-more" style="display: none;">Завантажити ще</button>-->
        </div>
    </div>
</div>

<?php
 if (is_user_logged_in() && current_user_can('publish_freelancers')) {
    get_template_part('template-parts/formAddCand');
     get_template_part('template-parts/formAddClient');
     // get_template_part('template-parts/candToRekr');
 }
get_footer(); ?>