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
            $recomendData->the_post(); ?>

            <?php acf_form(array(
                'post_title' => true,
                'uploader' => 'basic',
                'post_content' => false,
                'submit_value' => __('Сохранить изменения'),
                'return' => add_query_arg('p', '%post_id%', home_url())

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
        <div class="foto_name">
            <?php
            if(get_field('prichina_bl')){ ?>
                <span class="lb-bl">В чорному списку!!!</span>
            <?php } ?>
            <div class="name_base">
                <h2><?php the_field('imya'); echo ' '; the_field('familiya'); if (is_user_logged_in() && get_field('user_r') == get_current_user_id()) { ?>
                        <span class="openEdit"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/pen.png" alt="edit" /></span>

                        <script>
                            jQuery(document).ready(function ($) {
                                window.confirmDeletion = function(element) {
                                    event.preventDefault();
                                    $('#confirm-dialog').dialog({
                                        resizable: false,
                                        height: 'auto',
                                        width: 400,
                                        modal: true,
                                        buttons: {
                                            'Да': function() {
                                                window.location.href = $(element).data('href');
                                            },
                                            'Нет': function() {
                                                $(this).dialog('close');
                                            }
                                        }
                                    });
                                };
                            })(jQuery);
                        </script>

                        <span><?php echo wp_delete_post_link(); ?></span>
                        <div id="confirm-dialog" title="Подтверждение удаления" style="display:none;">
                            <p>Ви хочете видалити цього кандидата?</p>
                        </div>
                    <?php } ?>
                </h2>
                <p class="color1 fsize1"><?php $pos = get_field('spec1');
                    if($pos){
                        foreach ($pos as $p) {
                            echo $p->post_title . '';
                            if (next($pos)) {
                                echo '/';
                            }

                        }} ?></p>
                </p>
                <p class="color1 fsize1"><span class="sclabel"></span><?php the_field('zarplata') ?> $</p>
                    <p><?php the_field('engl_r') ?></p>
                <div class="k_btn">
                    <div class="bk_cv">
                        <a href="javascript:void(0);" class="modalCv" id="modal-launcher">CV</a>
                        <div id="modal-background"></div>
                        <div id="modal-content">
                            <button id="modal-close">✖</button>
                            <div id="pdf_parsed" style="width: 100%;padding: 60px 0;text-align: justify;">
                                <?php
                                $resume_id = get_field('resume_r');
                                $resume_url = wp_get_attachment_url($resume_id);
                                $file_type = pathinfo($resume_url, PATHINFO_EXTENSION);
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
                    <span id="rhistory">Історія</span>
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
                        'submit_value' => __('Зберегти'),
                        'return' => add_query_arg('p', '%post_id%', home_url())
                    ));
                }
                wp_reset_postdata(); ?>
            </div>
        </div>
        <div class="kinfo1">
            <div class="cont">
                <h3>Контакти</h3>
                <?php if (get_field('telegram')): ?>
                    <a href="" target="_blank"><span class="img1" style="background-image: url(<?php echo bloginfo('template_url'); ?>/*/assets/img/rating/telegram.jpg)"></span> <span class="cp_btn" id="bk_telegram">*/<?php the_field('telegram'); ?></span></a>
                <?php endif; ?>
                <?php if (get_field('viber_r')): ?>
                    <p><span class="img1 img11" style="background-image: url(<?php echo bloginfo('template_url'); ?>/*/assets/img/rating/viber.jpg)"></span> <span class="cp_btn" id="bk_viber">*/<?php the_field('viber_r'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('skype_r')): ?>
                    <p><span class="img1 img11" style="background-image: url(<?php echo bloginfo('template_url'); ?>/*/assets/img/rating/skype.jpg)"></span> <span class="cp_btn" id="bk_skype">*/<?php the_field('skype_r'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('tel_r')): ?>
                    <p><span class="dashicons dashicons-phone"></span> <span class="cp_btn" id="bk_tel"><?php the_field('tel_r'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('email_r')): ?>
                    <p><span class="dashicons dashicons-email-alt icon1"></span> <span class="cp_btn" id="bk_email"><?php the_field('email_r'); ?></span></p>
                <?php endif; ?>
                <?php if (get_field('drugoe')): ?>
                    <p><span class="dashicons dashicons-cloud-saved icon1"></span> <span class="cp_btn" id="bk_inshe"><?php the_field('drugoe'); ?></span></p>
                <?php endif;

                if(have_rows('kontakti22')): // проверка, есть ли строки в повторителе 'kontakti22'
                    while(have_rows('kontakti22')): the_row(); // если есть строки, начинаем цикл
                        $icon = get_sub_field('ikonka');
                        $contactData = get_sub_field('dannik');
                        $kontakt222 = get_sub_field('kontakt222');
                        $kanal_zvyazku = get_sub_field('kanal_zvyazku');
                        $test = strtolower($kontakt222->post_title);

                        if($test == 'telegram') {
                            echo '<div class="socin"><a href="https://t.me/'.$contactData.'" class="spec1 cp_btn bk_'.$test.'" id="'. uniqid() .'" data-chenel="'.$kanal_zvyazku.'" target="_blank"><span class="cp_btn" id="bk_inshe">'.$contactData.'</span></a><h6 class="socialSingle">'.$contactData.'</h6></div>';
                        }
                        if($test == 'linkedin') {
                            echo '<div class="socin"><a href="'.$contactData.'" class="spec1 cp_btn bk_'.$test.'" id="'. uniqid() .'" data-chenel="'.$kanal_zvyazku.'" target="_blank"><span class="cp_btn" id="bk_inshe">'.$contactData.'</span></a><h6 class="socialSingle">'.$contactData.'</h6></div>';
                        }
                        else {
                            echo '<div class="socin"><a href="javascript:void(0);" class="spec1 cp_btn bk_'.$test.'" id="'. uniqid() .'" data-chenel="'.$kanal_zvyazku.'"><span class="cp_btn" id="bk_inshe">'.$contactData.'</span></a><h6 class="socialSingle">'.$contactData.'</h6></div>';
                        }
                    endwhile;
                endif;

                ?>

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
                        <?php $spec3 = get_field('spec3');
                        if (is_array($spec3) || is_object($spec3))
                        {
                            foreach ($spec3 as $s1) { ?>
                                <span class="kCan noTech"><?php echo $s1->post_title; ?></span>
                            <?php }
                        } ?>
                    </div>
                </div>
                <?php
                $tagsall = get_field('tegi', $post_id); // Разделяем теги по запятым
                $tags_titles = array();
                foreach ($tagsall as $ta1) {
                    $tags_titles[] = $ta1->post_title;
                }
                $tags = implode(', ', $tags_titles);
                if ($tags):
                    ?>
                    <div class="tags">
                        <h4>Теги</h4>
                        <?php
                        foreach ($tags_titles as $tag) {
                            echo '<span class="bk_tag">' . trim($tag) . '</span> ';
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
                <div class="kNotes">
                    <h3>Переглянути історію</h3>
                    <div class="ta_block"><?php the_field('additional_info'); ?></div>
                </div>
        </div>
<!--        --><?php
//        while ( have_posts() ) : the_post();
//            $candidate_id = get_the_ID();
//            $candidate_stage = get_field('candidate_stage', $candidate_id);
//            $custom_stages = get_field('custom_stages', $candidate_id);
//            $custom_stages_array = $custom_stages ? explode(',', $custom_stages) : [];
//            ?>
<!--        <div class="stages">-->
<!--            <div class="stage" data-stage="new"><span class="er-h">Новий</span>-->
<!--                --><?php //if ($candidate_stage == 'new'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="notin"><span class="er-h">Не зацікавлений</span>-->
<!--                --><?php //if ($candidate_stage == 'notin'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="intro"><span class="er-h">Intro</span>-->
<!--                --><?php //if ($candidate_stage == 'intro'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="prescreen"><span class="er-h">Pre-screen</span>-->
<!--                --><?php //if ($candidate_stage == 'prescreen'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="testtask"><span class="er-h">Test task</span>-->
<!--                --><?php //if ($candidate_stage == 'testtask'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="hrinterview"><span class="er-h">HR interview</span>-->
<!--                --><?php //if ($candidate_stage == 'hrinterview'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="techinterview"><span class="er-h">Tech interview</span>-->
<!--                --><?php //if ($candidate_stage == 'techinterview'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="customerinterview"><span class="er-h">Customer interview</span>-->
<!--                --><?php //if ($candidate_stage == 'customerinterview'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="offer"><span class="er-h">Offer</span>-->
<!--                --><?php //if ($candidate_stage == 'offer'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="preoffer"><span class="er-h">Pre-offer</span>-->
<!--                --><?php //if ($candidate_stage == 'preoffer'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            <div class="stage" data-stage="cancel"><span class="er-h">Cancel</span>-->
<!--                --><?php //if ($candidate_stage == 'cancel'):
//                    echo '<div class="candidate" draggable="true" data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
//                endif; ?>
<!--            </div>-->
<!--            --><?php //foreach ($custom_stages_array as $custom_stage) : ?>
<!--                <div class="stage" data-stage="--><?php //echo $custom_stage; ?><!--">-->
<!--                    <span class="er-h">--><?php //echo $custom_stage; ?><!--</span>-->
<!--                    --><?php //if ($candidate_stage === $custom_stage) : ?>
<!--                        <div class="candidate" draggable="true" data-id="--><?php //echo $candidate_id; ?><!--">--><?php //echo get_the_title(); ?><!--</div>-->
<!--                    --><?php //endif; ?>
<!--                </div>-->
<!--            --><?php //endforeach; ?>
<!---->
<!--            <input type="text" id="custom_stage" placeholder="Свій варіант">-->
<!--            <button id="add_custom_stage">Додати</button>-->
<!--        </div>-->
<!--        <input type="hidden" name="candidate_stage" value="">-->
<!--        <input type="hidden" name="custom_stages" value="">-->
<?php //endwhile; ?>

    </div>
</div>
<?php get_template_part('template-parts/formAddCand') ?>
<?php get_footer(); ?>
