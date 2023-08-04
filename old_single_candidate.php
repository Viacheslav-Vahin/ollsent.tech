<?php
///*
//Template Name: Кандидат
//Template Post Type: candidate
//*/
//
//get_header(); ?>
<!--<div class="dp_cont bcsingle">-->
<!--<h1 class="openPopup">--><?php //the_title(); ?><!--</h1>-->
<!--<p>Должность: --><?php ////the_field(dolzhnost); ?><!--</p>-->
<!--    <p>--><?php
//        $dolzhnost_category = get_field('dolzhnost');
//        if($dolzhnost_category) {
//            foreach ($dolzhnost_category as $k) {
//                echo $k->post_title;
//                ?><!--<span class="transp">a</span>--><?php
//            }
//
//        }?><!--</p>-->
<!--<div>--><?php //the_field(more_dopolnitelno); ?><!--</div>-->
<!--</div>-->
<?php //get_footer(); ?>


<?php
/*
Template Name: Рекомендация
Template Post Type: candidate
*/
acf_form_head();
get_header(); ?>
<style>
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
    }
</style>
<div class="dp_container single_candid">
    <span class="currCand dnone"><?php the_id(); ?></span>
    <!-- <button type="button">Изменить информацию про кандидата<?php the_id(); ?></button> -->
    <?php remove_from_blacklist(); ?>
    <div class="rekomFormEdit">
        <h2>Змінити <?php the_field('imya'); echo ' '; the_field('familiya'); ?><span id="ce1">×</span></h2>
        <?php
        $recomendData = new WP_Query(array(
            'post_type' => 'candidate',
            'post_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',

            // 'post_id' => the_id()
            // 'ID' => the_id(),
            'meta_query' => array(
                array(
                    'key' => 'imya',
                    'compare' => '=',
                    'value' => get_field('imya')
                ),
                array(
                    'key' => 'familiya',
                    'compare' => '=',
                    'value' => get_field('familiya')
                )
            )
            // 'post_id' => the_id()
            // 'ID' => the_id(),
        ));
        while ($recomendData->have_posts()) {
            $recomendData->the_post(); ?>

            <?php acf_form(array(
                'post_title' => true,
                'uploader' => 'basic',
                'post_content' => false,
                'submit_value' => __('Сохранить изменения')
            )); ?>
            <?php
            echo '<div class="popup" id="removeFromBlacklistPopup">
    <div class="popup-content">
        <h3>Видалити з чорного списку</h3>
        <form method="post" action="">
            <input type="hidden" name="remove_from_blacklist" value="<?php echo $post->ID; ?>">
            <label for="prichina_vydalennya">Причина видалення:</label>
            <input type="text" name="prichina_vydalennya" id="prichina_vydalennya" required>
            <br>
            <input type="submit" value="Відправити">
            <button type="button" id="cancelRemoveFromBlacklist">Скасувати</button>
        </form>
    </div>
</div>
<button type="button" id="openRemoveFromBlacklistPopup">Видалити з чорного списку</button>';
        }

        wp_reset_postdata();
        ?>
    </div>
    <script>
        document.getElementById("openRemoveFromBlacklistPopup").addEventListener("click", function () {
            document.getElementById("removeFromBlacklistPopup").style.display = "block";
        });

        document.getElementById("cancelRemoveFromBlacklist").addEventListener("click", function () {
            document.getElementById("removeFromBlacklistPopup").style.display = "none";
        });
    </script>
    <div class="scwrap">
        <!-- <div id="loadHist2">ggggggggg</div> -->
        <!-- <div id="loadHist3">rrrrrrrrr</div> -->
        <div class="foto_name">
            <div class="kimg" style="background-image: url('<?php the_field('fotogr'); ?>')"></div>
            <?php
            if(get_field('prichina_bl')){ ?>
                <span class="lb-bl">В чорному списку!!!</span>
            <?php } ?>
            <div class="name_base">
                <h2><?php the_field('imya'); echo ' '; the_field('familiya'); if (is_user_logged_in() && get_field('user_r') == get_current_user_id()) { ?>
                        <span class="openEdit">Змінити кандидата</span>
                        <span><?php echo wp_delete_post_link(); ?></span>
                    <?php } ?>
                </h2>
                <!--                <p class="color1 fsize1">Middle + Back-End Developer</p>-->
                <!--                <p class="color1 fsize1"><span class="sclabel">26 years old, --><?php //the_field('region') ?><!--,-->
                <?php $city = get_field('city_r');
                if($city){
                    foreach ($city as $c) {
                        echo $c->post_title;
                        if (next($city)) {
                            echo ', ';
                        }

                    }} ?>.
                </p>
                <p class="color1 fsize1"><span class="sclabel">Зарплата: $</span><?php the_field('zarplata') ?></p>
                <div class="k_btn">
                    <div class="bk_cv">
                        <a href="javascript:void(0);" class="modalCv" id="modal-launcher">Переглянути резюме</a>
                        <div id="modal-background"></div>
                        <div id="modal-content">
                            <button id="modal-close">✖</button>
                            <div id="pdf_parsed" style="width: 100%;padding: 60px 0;text-align: justify;">
                                <?php
                                $raw_text = get_field('pdf_parsed');
                                $paragraphs = preg_split('/\s{2,}/', $raw_text, -1, PREG_SPLIT_NO_EMPTY);

                                foreach ($paragraphs as $paragraph) {
                                    $clean_paragraph = str_replace('"', '', trim($paragraph));
                                    echo '<p>' . $clean_paragraph . '</p>';
                                }
                                ?>
                            </div>
                            <!-- Ваш попап вікно з полем textarea та кнопкою "Завантажити" -->
                            <div id="popup-window">
                                <h4 class="pdf_redh">Редагування резюме</h4>
                                <div id="dump_block" contenteditable="true"></div>
                                <div class="btns-wrp" style="display: flex; justify-content: space-between; padding: 35px 0;">
                                    <button id="download-button" style="background-color: #16a086; color: #fff; padding: 5px; border-radius: 3px;">Завантажити резюме</button>
                                    <button id="view-resume-button" style="background-color: #16a086; color: #fff; padding: 5px; border-radius: 3px;">Редагувати резюме</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span id="rhistory">Переглянути Історію</span>
                    <span id="rbl">Додати в чорний список</span>
                </div>
            </div>
        </div>
        <div class="blacklistModal">
            <div id="modal-background-bl"></div>
            <div id="modal-content-bl">
                <button id="modal-close-bl">✖</button>
                <?php
                $recomendData = new WP_Query(array(
                    'post_type' => 'candidate',
                    'post_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'imya',
                            'compare' => '=',
                            'value' => get_field('imya')
                        ),
                        array(
                            'key' => 'familiya',
                            'compare' => '=',
                            'value' => get_field('familiya')
                        )
                    )
                ));
                while ($recomendData->have_posts()) {
                    $recomendData->the_post();
                    acf_form(array(
                        'post_title' => false,
                        'post_content' => false,
                        'fields' => array('prichina_bl'),
                        'submit_value' => __('Зберегти')
                    ));
                }
                wp_reset_postdata(); ?>
            </div>
        </div>
        <div class="historyW">
            <span id="surl6" class="dnone"><?php echo get_site_url(); ?></span>
            <span id="cu8" class="dnone"><?php echo get_current_user_id(); ?></span>
            <h3>інформація про співбесіди кандидата<span id="ce2">×</span></h3>
            <div id="loadHist"></div>
            <!-- <div id="loadHist2"></div> -->
            <!-- <?php
            $recomendData = new WP_Query(array(
                'post_type' => 'history',
                'post_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'order' => 'DESC',

                // 'post_id' => the_id()
                // 'ID' => the_id(),

                // 'meta_query' => array(
                //     array(
                //         'key' => 'imya',
                //         'compare' => '=',
                //         'value' => get_field(imya)
                //     ),
                //     array(
                //         'key' => 'familiya',
                //         'compare' => '=',
                //         'value' => get_field(familiya)
                //     )
                // )

                // 'post_id' => the_id()
                // 'ID' => the_id(),
            ));
            while ($recomendData->have_posts()) {
                $recomendData->the_post(); ?>
                        <div class="history1">

                            <span><?php the_field('data'); ?> </span>
                            <span><?php $spec4 = get_field('comp');
                foreach ($spec4 as $s1) { ?>
                                    <span class="red"><?php echo $s1->post_title; ?></span>
                            <?php } ?>, </span>
                            <span>Зарплата: <?php the_field('zarplata'); ?>, </span>
                            <span><?php the_field('posada'); ?>, </span>
                            <span>Статус: <?php the_field('status'); ?> </span>
                            <div><?php the_field('dopolnitelno'); ?> </div>
                        </div>
                <?php
            }

            wp_reset_postdata();
            ?> -->
        </div>
        <!-- <div class="bline"></div>  -->
        <div class="kinfo1">
            <div class="cont">
                <h3>Контакти</h3>
                <?php if (get_field('telegram')): ?>
                    <p><span class="img1" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/telegram.jpg)"></span> <span class="cp_btn" id="bk_telegram"><?php the_field('telegram'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('viber_r')): ?>
                    <p><span class="img1 img11" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/viber.jpg)"></span> <span class="cp_btn" id="bk_viber"><?php the_field('viber_r'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('skype_r')): ?>
                    <p><span class="img1 img11" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/skype.jpg)"></span> <span class="cp_btn" id="bk_skype"><?php the_field('skype_r'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('tel_r')): ?>
                    <p><span class="dashicons dashicons-phone"></span> <span class="cp_btn" id="bk_tel"><?php the_field('tel_r'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('email_r')): ?>
                    <p><span class="dashicons dashicons-email-alt icon1"></span> <span class="cp_btn" id="bk_email"><?php the_field('email_r'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('drugoe')): ?>
                    <p><span class="dashicons dashicons-cloud-saved icon1"></span> <span class="cp_btn" id="bk_inshe"><?php the_field('drugoe'); ?></span></p>
                <?php endif; ?>

            </div>
            <div class="exp">
                <h3>Досвід</h3>
                <div><?php the_field('history'); ?></div>
            </div>
            <div class="addt">
                <h3>Додаткова інформація</h3>
                <div class="rSkills">
                    <h4>Навики</h4>
                    <div class="skillWrap">
                        <?php $spec1 = get_field('spec1');
                        foreach ($spec1 as $s1) { ?>
                            <span class="kCan"><?php echo $s1->post_title; ?></span>
                        <?php } ?>
                        <!--                        --><?php //$addspec1 = get_field('addspec1');
                        //                        if($addspec1) {
                        //                        foreach ($addspec1 as $as1) { ?>
                        <!--                            <span class="kCan">--><?php //echo $as1->post_title; ?><!--</span>-->
                        <!--                        --><?php //}} ?>
                        <!--                        --><?php //$spec4 = get_field('spec4');
                        //                        if($spec4) {
                        //                        foreach ($spec4 as $s1) { ?>
                        <!--                            <span class="kCan framw">--><?php //echo $s1->post_title; ?><!--</span>-->
                        <!--                        --><?php //}} ?>
                        <?php $spec3 = get_field('spec3');
                        if (is_array($spec3) || is_object($spec3))
                        {
                            foreach ($spec3 as $s1) { ?>
                                <span class="kCan noTech"><?php echo $s1->post_title; ?></span>
                            <?php }
                        } ?>
                    </div>
                </div>
                <div class="rAngl">
                    <h4>Англійский</h4>
                    <p><?php the_field('engl_r') ?></p>
                </div>
            </div>
            <!-- <div class="exp"></div>
            <div class="addt"></div> -->
        </div>
        <div class="kInfo2">
            <div class="kNotes">
                <h3>Примітки до кандидата</h3>
                <div><?php the_field('additional_info'); ?></div>
            </div>
            <div class="kRating"
                 data-navuky="<?php the_field('razrabotka'); ?>"
                 data-team="<?php the_field('v_komande'); ?>"
                 data-organiz="<?php the_field('organiz'); ?>"
                 data-sravny="<?php the_field('sravnenie'); ?>"
                 data-rating="<?php the_field('rejting'); ?>"
                 data-sr="<?php the_field('sravn'); ?>"
            >
                <div class="kr1">
                    <h5>Навики розробки</h5>
                    <div class="rWrap">
                        <div id="rt1" class="rInner"><div class="krW">
                                <div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r1.jpg)"></div>
                                <span>Прекрасно</span>
                            </div>
                        </div>
                        <div id="rt2" class="rInner">
                            <div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r2.jpg)"></div>
                                <span>Добре</span>
                            </div>
                        </div>
                        <div id="rt3" class="rInner">
                            <div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r3.jpg)"></div>
                                <span>Погано</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kr1">
                    <h5>Робота в команді</h5>
                    <div class="rWrap pl15">
                        <div id="rt4" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r1.jpg)"></div> <span>Прекрасно</span></div></div>
                        <div id="rt5" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r2.jpg)"></div> <span>Добре</span></div></div>
                        <div id="rt6" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r3.jpg)"></div> <span>Погано</span></div></div>
                    </div>
                </div>
                <div class="kr1">
                    <h5>Організованість</h5>
                    <div class="rWrap pl15">
                        <div id="rt7" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r1.jpg)"></div> <span>Прекрасно</span></div></div>
                        <div id="rt8" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r2.jpg)"></div> <span>Добре</span></div></div>
                        <div id="rt9" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r3.jpg)"></div> <span>Погано</span></div></div>
                    </div>
                </div>
                <div class="kr2">
                    <h5>Порівняння з іншими</h5>
                    <div class="rWrap pl15">
                        <div id="rt10" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r1.jpg)"></div> <span>Прекрасно</span></div></div>
                        <div id="rt11" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r2.jpg)"></div> <span>Добре</span></div></div>
                        <div id="rt12" class="rInner"><div class="krW"><div class="krImg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/rating/r3.jpg)"></div> <span>Погано</span></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_template_part('template-parts/formAddCand') ?>
<?php get_footer(); ?>
