<?php
/*
Template Name: База клієнтів
*/
$cu = get_current_user_id();
$user = get_userdata( $cu );
$user_roles = $user->roles;
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
        <!-- <h1 id="timedb"><?php the_field('test_time'); ?></h1>   -->
        <!-- <input id="timedb" type="text" value="<?php the_field('timedb'); ?>"> -->
        <div class="vac_wrap">
            <div class="left_vac pipe">
                <div id="pipe_filtrs" class="vac_filtrs">
                    <div class="f0w">
                        <p class="vft">Фільтри:</p>
                        <p class="vac_filter_res dp_post_count2"></p>
                    </div>

                    <!--                --><?php //echo do_shortcode('[fe_widget]');?>

                    <div class="spec_wrapper">
                        <div class="q_a togleShow fh">
                            <h3 class="accordion-title">Розробка:
                                <div class="qa_icon_wrapper tran">
                                    <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                                </div>
                            </h3>
                            <div class="boxForChosenSpec"></div>
                            <div class="answ">
                                <div class="lang_left so" id="vac_speciality">
                                    <!--                                <div class="chbwr" style="padding: 3px 0">-->
                                    <!--                                <input type="checkbox" class="spec1-checkbox" value="Всі мови" style="margin-right: 5px" />Всі мови-->
                                    <!--                                </div>-->
                                    <!--                                <option value="--><?php //the_title(); ?><!--">--><?php //the_title(); ?><!--</option>-->
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
                                    } ?>
                                    <option class="countLang"><?php echo $countLang; ?></option> <?php
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
                                <select class="lang_left so" id="vac_addspeciality">
                                    <option value="">Додадкові</option>
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
                                        <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                                        <?php
                                    } ?>
                                    <option class="countAddLang"><?php echo $countAddLang; ?></option> <?php
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
//                                    'post_type' => 'specialty',
                                        'post_type' => 'tech-lang',
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
                    <section class="communications fiw">
                        <h3>Контакти</h3>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input vac_communications" id="vc1" value="Telegram">
                            <label class="custom-control-label" for="vc1">Telegram</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input vac_work_format" id="vc3" value="Skype">
                            <label class="custom-control-label" for="vc3">Skype</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input vac_work_format" id="vc2" value="Viber">
                            <label class="custom-control-label" for="vc2">Viber</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input vac_work_format" id="vc4" value="Whatsapp">
                            <label class="custom-control-label" for="vc4">Whatsapp</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input vac_work_format" id="vc5" value="Email">
                            <label class="custom-control-label" for="vc5">Email</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input vac_work_format" id="vc6" value="Linkedin">
                            <label class="custom-control-label" for="vc6">Linkedin</label>
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
                                <div class="allcountr" style="display: none;">
                                    <?php
                                    $args = array(
                                        'post_type' => array('countries'),
                                        'posts_per_page' => -1, // limit the number of posts if you like to
                                        'orderby' => 'title',
                                        'order' => 'ASC'
                                    );
                                    $custom_query = new WP_Query($args);
                                    $tech_id = 0;
                                    if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                                        <span id="countrID<?php echo $tech_id ?>" class="countr_sc"><?php the_title(); ?></span>
                                        <?php
                                        $tech_id++;
                                    endwhile; endif;
                                    wp_reset_postdata(); ?>
                                </div>
                                <input type="text" class="lang_left vac_city so" id="citySelect" style="border: 1px solid;"/>
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
                    <style>
                        .pipef {
                            width: 100%;
                        }
                        .selectedElements {
                            display: flex;
                            flex-wrap: wrap;
                        }
                        .selectedElements .tag {
                            background-color: #16a086;
                            color: #fff;
                            padding: 5px 10px;
                            border-radius: 5px;
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            margin-right: 3px;
                            margin-bottom: 3px;
                            flex: 0 0 100%;
                            flex-basis: content;
                        }
                        .selectedElements .tag:after {
                            content: '\2716';
                            display: block;
                            margin-left: 7px;
                            font-size: 13px;
                        }
                    </style>
                    <input class="si i0" type="text" id="pipe0" placeholder="Шукати по тексту">
                    <div class='selectedElements'></div>
                </div>
                <div class="alltechwrapper" style="display: none;">
                    <?php sbfilter_function(); ?>
                </div>

                <div class="" id="bazaHead">
                    <p>Дата</p>
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
                    <!--                </form>-->
                    <p>Англійська</p>
                    <p>Контакти</p>
                    <p>CV</p>
                    <p></p>
                </div>
                <div class="buttons btns-view">
                    <button class="grid"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/grid.png" style="width: 30px; height: 30px;" alt="Сітка" title="Сітка"/></button>
                    <button class="list"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/list.svg" style="width: 24px; height: 30px;"  alt="Список" title="Список"/></button>
                </div>
                <?php
                $it = 0;
                $recomendData = new WP_Query(array(
                    'post_type' => 'client',
//                    'meta_key' => 'dataStart2',
//                    'orderby' => 'meta_value_num',
//                    'order' => 'DESC',
                )); ?>
                <input readonly value="<?php echo $recomendData->post_count; ?>" id="phpCount" class="dp_post_count2 dnone">
                <section class="allmr pipeCont list">
                    <?php while ($recomendData->have_posts()) {
                        $recomendData->the_post(); ?>
                        <div class="myCandW mcd kandItem1 baza"
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
                             }?>"
                             data-spec4="<?php $cand_s1 = get_field('spec4');
                             foreach ($cand_s1 as $s1) {
                                 echo $s1->post_title . ', ';
                             }?>"
                             data-angl="<?php the_field('engl_r'); ?>" data-reg1="<?php the_field('region'); ?>"
                             data-cont="<?php $f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['label'] . " "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['label'] . " "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['label'] . " "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['label'] . " "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['label'] . " "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['label']; }?>"
                             data-contval="<?php $f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['value'] . ", "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['value'] . ", "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['value'] . ", "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['value'] . ", "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['value'] . ", "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['value']; }?>"
                             data-zar="<?php the_field('zarplata'); ?>"
                             data-country="<?php the_field('pipe_country'); ?>"
                             data-stat1="<?php the_field('status_r'); ?>" data-oput="<?php the_field('exp_r'); ?>"
                            <?php if(get_field('komp_last')) { ?>
                             data-compn="<?php $cand_s3 = get_field('komp_last');
                             foreach ($cand_s3 as $s3) {
                                 echo $s3->post_title;
                             }
                             } ?>"
                             <?php $timedb = get_field('dataStart0');
                             if($timedb){
                             ?>data-timedb="<?php echo $timedb; ?>" <?php
                        }else{ ?>data-timedb="0" <?php }
                        ?>>

                            <div class="bk_time">
                                <p class=""><?php the_field('field_61c9624e3d8fc'); ?></p>
                            </div>
                            <div class="mcName">
                                <!-- <?php
                                $timedb = get_field('dataStart2');
                                if($timedb){
                                    ?><input class="time_db" type="number" value="<?php echo $timedb; ?>"><?php
                                }else{ ?><input class="time_db" type="number" value="0"><?php }
                                ?>                     -->
                                <!-- <script>console.log('dd13');</script> -->
                                <div class="bk_name">
                                    <a href="<?php the_permalink(); ?>">
                                        <p class=""><?php the_field('imya'); ?> <?php the_field('familiya'); ?></p>
                                    </a>
                                </div>
                            </div>

                            <div class="bk_mid1">
                                <div class="bk_country">
                                    <?php $city = get_field('city_r');
                                    if($city) {
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
                                <?php if(get_field('engl_r')) { ?>
                                    <div class="bk_angl">
                                        <p class="spec1">Англ: <span class="dnone">a</span><?php the_field('engl_r'); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="bk_mid2 cont_wrapper">
                                <div class="bk_cont">
                                    <?php
                                    if (get_field('linkedin')) {
                                        ?><a href="https://www.linkedin.com/in/<?php the_field('linkedin'); ?>" class="spec1 cp_btn bk_linkedin" id="bk_linkedin<?php echo $it;?>"><span><?php the_field('linkedin'); ?></span></a><?php
                                    }
                                    if (get_field('telegram')) {
                                        ?><a href="tg://resolve?domain=<?php the_field('telegram'); ?>" class="spec1 cp_btn bk_telegram" id="bk_telegram<?php echo $it;?>"><span><?php the_field('telegram'); ?></span></a><?php
                                    }
                                    if (get_field('skype_r')) {
                                        ?><a href="skype:<?php the_field('skype_r'); ?>?chat" class="spec1 cp_btn bk_skype" id="bk_skype<?php echo $it;?>" target="_blank"><span><?php the_field('skype_r'); ?></span></a><?php
                                    }
                                    if (get_field('viber_r')) {
                                        ?><a href="viber://chat?number=%2B<?php the_field('viber_r'); ?>" class="spec1 cp_btn bk_viber" id="bk_viber<?php echo $it;?>" target="_blank"><span><?php the_field('viber_r'); ?></span></a><?php
                                    }
                                    if (get_field('email_r')) {
                                        ?><a href="mailto:<?php the_field('email_r'); ?>" class="spec1 cp_btn bk_email" id="bk_email<?php echo $it;?>" target="_blank"><span><?php the_field('email_r'); ?></span></a><?php
                                    }
                                    if (get_field('tel_r')) {
                                        ?><a href="tel:<?php the_field('tel_r'); ?>" class="spec1 cp_btn bk_phone" id="bk_phone<?php echo $it;?>"><span><?php the_field('tel_r'); ?></span></a><?php
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
                                        <?php
                                        $resume_id = get_field('resume_r');

                                        // Получение URL файла с помощью идентификатора
                                        $resume_url = wp_get_attachment_url($resume_id);

                                        // Получение типа файла
                                        $file_type = pathinfo($resume_url, PATHINFO_EXTENSION);

                                        //                                if (strtolower($file_type) === 'pdf') {
                                        ?>
                                        <embed src="<?php echo $resume_url; ?>" frameborder="0" width="100%" height="700px">
                                        <?php $post_id = get_the_ID(); // Получите ID текущего поста
                                        $docx_attach_id = get_post_meta($post_id, 'resume_docx', true); // Получите ID вложения .docx файла
                                        $docx_url = wp_get_attachment_url($docx_attach_id); // Получите URL вложения .docx файла
                                        ?>
                                        <a href="<?php echo $docx_url; ?>" class="dnl_btn" download="">Завантажити у форматі .docx</a>
                                    </div>
                                </div>

                            </div>
                            <div class="bk_end">
                                <button type="button" class="getToVac">Взяти на вакансію</button>
                                <button class="favorite-star" data-candidate-id="<?php echo get_the_ID(); ?>">
                                    ☆
                                </button>
                            </div>
                        </div>
                        <?php
                        $it++; }
                    wp_reset_postdata();
                    ?>
                </section>
            </div>
        </div>
    </div>

<?php
if (is_user_logged_in() && current_user_can('publish_freelancers')) {
    get_template_part('template-parts/formAddCand');
    get_template_part('template-parts/formAddClient');
}
get_footer(); ?>