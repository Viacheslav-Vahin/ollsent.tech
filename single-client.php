<?php
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
    <div class="rekomFormEdit">
        <h2>Змінити <?php the_field('company_name'); ?><span id="ce1">×</span></h2>
        <?php
        $recomendData = new WP_Query(array(
            'post_type' => 'client',
            'post_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',

            // 'post_id' => the_id()
            // 'ID' => the_id(),
            'meta_query' => array(
                array(
                    'key' => 'company_name',
                    'compare' => '=',
                    'value' => get_field('company_name')
                ),
//                            array(
//                                'key' => 'familiya',
//                                'compare' => '=',
//                                'value' => get_field('familiya')
//                            )
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
                'submit_value' => __('Зберегти зміни')
            ));
        }

        wp_reset_postdata();
        ?>
    </div>
    <div class="scwrap">
        <div class="foto_name">
            <?php if(get_field('company_logo')) { ?>
                <div class="cli_logo">
                    <img src="<?php the_field('company_logo');?>" width="300" alt="Logo"/>
                </div>
            <?php } ?>
            <div class="name_base clients_info">
                <h2><?php the_field('company_name') ?>
                    <span class="openEdit"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/pen.png" alt="edit" /></span>
                </h2>
                </p>
                <p class="color1 fsize1"><span class="sclabel">
                    </span> <?php $cloc = get_field('company_lication');
                    foreach ($cloc as $cl) {
                        echo $cl->post_title;
                    } ?>
                </p>
                <p><a href="<?php the_field('company_site') ?>" target="_blank"><?php the_field('company_site') ?></a></p>
                <p>Тип компанії: <?php the_field('company_type') ?></p>
                <p>Розмір компанії: <?php the_field('company_size') ?></p>
                <?php if (current_user_can('administrator')) { ?>
                    <p>Умови компанії: <?php the_field('umovi_kompani') ?></p>
                <?php } ?>
                <div class="vac_btn">
                    <div class="bk_cv">
                        <a href="javascript:void(0);" class="modalCv modalVac" id="modal-launcher">Створити вакансію</a>
                        <div id="modal-background"></div>
                        <div id="modal-content">
                            <button id="modal-close">✖</button>
                            <div id="pdf_parsed" class="vacsave"
                                 style="width: 100%;padding: 60px 0;text-align: justify;">
                                <h3 class="cloud-title">Створити вакансію<span
                                            class="cuID1 dnone"><?php echo get_current_user_id(); ?></span>
                                    <!-- <input id="cutime" type="datetime" value="<?php
                                    date_default_timezone_set('Europe/Kiev');
                                    $date = date('m-d-Y H:i:s', time());
                                    echo $date; ?>"> -->
                                </h3>
                                <section class="p_form">
                                    <?php
                                    acf_enqueue_uploader();
                                    acf_form_head();

                                    while (have_posts()) : the_post(); ?>
                                        <?php
                                        acf_form(array(
                                            'post_id' => 'new_post',
                                            'post_title' => false,
                                            'post_content' => false,
                                            'new_post' => array(
                                                'post_type' => 'vacancy',
                                                'post_status' => 'publish'
                                            ),
                                            'submit_value' => 'Створити вакансію',
                                            'uploader' => 'basic',
                                            'return' => add_query_arg('p', '%post_id%', home_url())
                                        )); ?>
                                    <?php endwhile; ?>
                                </section>

                            </div>
                        </div>
                    </div>
                </div>
                <p class="color1 fsize1 vakopus">
                <h3 class="vacopis-h">Опис компанії</h3>
                <div class="vacopis">
                    <?php
                    if( have_rows('dodatkovi_polya_2') ):
                        while( have_rows('dodatkovi_polya_2') ) : the_row();
                            $title2 = get_sub_field('zagolovok2');
                            $text2 = get_sub_field('tekst2'); ?>
                            <h4><?php echo $title2; ?></h4>
                            <div class="additional_text"><?php echo $text2; ?></div>
                        <?php endwhile;
                    endif; ?>
                </div>
                </p>
                    </div>
                </div>
        <h3 class="hedMid">Вакансії</h3>
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
        <div class="clientVacancy">
<?php
$current_post_id = get_the_ID(); // Получаем ID текущего поста
$clvacData = new WP_Query(array(
    'post_type' => 'vacancy',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'client_ids2', // Название поля ACF
            'value' => $current_post_id,
            'compare' => '='
        )
    ),
));
while ($clvacData->have_posts()) {
    $clvacData->the_post(); ?>
    <div class="clvacwrapp">
        <div class="bk_time">
            <p class=""><?php the_field('field_645272746b7d4'); ?></p>
        </div>
        <div class="vakname">
            <h3><a href="<?php the_permalink(); ?>" class="vac_title"><?php the_field('nazva_vakansi'); ?></a></h3>
        </div>
        <div class="vakzarpl">
            <?php the_field('zarplata1'); ?>
        </div>
        <div class="vakloc">
            <?php $loc = get_field('lokacziya');
            foreach ($loc as $l) {
                echo $l->post_title;
            } ?>
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
<!--        <div class="vakformat">-->
<!--            --><?php //the_field('format_roboti'); ?>
<!--        </div>-->
<!--        <div class="vakrelocate">-->
<!--            --><?php //the_field('relocate_format'); ?>
<!--        </div>-->
<!--        <div class="vakprior">-->
<!--            --><?php //the_field('prioritetnist_vakansi'); ?>
<!--        </div>-->
<!--        <div class="vakdosvid">-->
<!--            --><?php //the_field('skilki_rokiv_dosvidu'); ?>
<!--        </div>-->
        <!--                --><?php //the_field('zrobiti_publichnoyu'); ?>
        <!--                    --><?php //the_field('vidno_dlya_vsih'); ?>
<!--        <div class="vakopus">-->
<!--            --><?php //the_field('opis_vakansi'); ?>
<!--        </div>-->
    </div>
<?php }
wp_reset_postdata();
?>
</div>
</div>
</div>



<!-- <div class="bline"></div>  -->
    </div>
</div>
<?php get_template_part('template-parts/formAddCand') ?>
<?php get_template_part('template-parts/formAddClient') ?>
<?php get_footer(); ?>
