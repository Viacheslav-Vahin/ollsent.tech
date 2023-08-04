<?php
/*
Template Name: Вакансія
Template Post Type: vacancy
*/
?>
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
        <h2>Змінити <?php the_field('nazva_vakansi'); ?><span id="ce1">×</span></h2>
        <?php
        $recomendData = new WP_Query(array(
            'post_type' => 'vacancy',
            'post_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',

            // 'post_id' => the_id()
            // 'ID' => the_id(),
            'meta_query' => array(
                array(
                    'key' => 'nazva_vakansi',
                    'compare' => '=',
                    'value' => get_field('nazva_vakansi')
                ),
            )
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
            <div class="name_base">
                <h2><?php the_field('nazva_vakansi') ?>
                    <span class="openEdit"><img src="<?php echo bloginfo('template_url'); ?>/assets/img/pen.png" alt="edit" /></span>
                </h2>
                <p class="color1 fsize1"><span class="c-bl">Локація: </span><?php $cloc = get_field('lokacziya');
                    foreach ($cloc as $cl) {
                        echo $cl->post_title;
                    } ?>
                </p>
                <p class="color1 fsize1"><span class="c-bl">Англійський: </span><?php the_field('riven_anglijsko') ?></p>
                    <?php if (get_field('vidno_dlya_vsih')) { ?>
                        <p class="color1 fsize1"><span class="c-bl">ЗП: </span><?php the_field('zarplata1'); ?>$</p>
                    <?php } ?>
                <p class="color1 fsize1 vakformat">
                    <span class="c-bl">Формат роботи: </span><?php the_field('format_roboti'); ?>
                </p>
                <?php if(get_field('relocate_format')) { ?>
                    <p class="color1 fsize1 vakrelocate">
                        <span class="c-bl">Релокейт у: </span><?php the_field('relocate_format'); ?>
                    </p>
                <?php } ?>
                <p class="color1 fsize1 vakprior">
                    <span class="c-bl">Пріоритетність вакансії: </span><?php the_field('prioritetnist_vakansi'); ?>
                </p>
                <p class="color1 fsize1 vakdosvid">
                    <span class="c-bl">Скільки років досвіду: </span><?php the_field('skilki_rokiv_dosvidu'); ?>
                </p>
                <p class="color1 fsize1 vakopus">
                    <h3 class="vacopis-h">Опис вакансії</h3>
                    <div class="vacopis">
                        <?php
                        if( have_rows('dodatkovi_polya') ):
                            while( have_rows('dodatkovi_polya') ) : the_row();
                                $title = get_sub_field('zagolovok');
                                $text = get_sub_field('tekst1'); ?>
                                <h4><?php echo $title; ?></h4>
                                <div class="additional_text"><?php echo $text; ?></div>
                            <?php endwhile;
                        endif; ?>
                    </div>
                </p>
<!--                --><?php
//                if ( have_posts() ) {
//                    while ( have_posts() ) {
//                        the_post();
//
//                        $etapi_spivbesidi = get_field('etapi_spivbesidi', $post_id);
//
//                        if( $etapi_spivbesidi ): ?>
<!--                            <ul>-->
<!--                                --><?php //foreach ($etapi_spivbesidi as $etap): ?>
<!--                                    --><?php //if ($etap !== 'Свій варіант'): ?>
<!--                                        <li>--><?php //echo $etap; ?><!--</li>-->
<!--                                    --><?php //endif; ?>
<!--                                --><?php //endforeach;
//                                if (get_field('svij_variant')) {
//                                    echo '<li>' . get_field('svij_variant') . ' </li>';
//                                } ?>
<!--                            </ul>-->
<!--                        --><?php
//                        endif;
//                    }
//                }
//                ?>
            </div>
        </div>
        <?php
        // Замените это на ID вакансии, которую вы используете
        $vacancy_id = get_the_ID();
        $etapi_spivbesidi_values = get_field('etapi_spivbesidi', $vacancy_id);
        $stages = array();
        $stage_names = array();

        if (is_array($etapi_spivbesidi_values) && count($etapi_spivbesidi_values) > 0) {
            foreach ($etapi_spivbesidi_values as $value) {
                $stages[$value] = array();
                $stage_names[$value] = $value;
            }
        }

        // Получите все рекомендации для этой вакансии
        $args = array(
            'post_type' => array('rekomend','candidate'),
            'meta_query' => array(
                array(
                    'key' => 'id_vac',
                    'value' => $vacancy_id,
                    'compare' => '='
                )
            )
        );
        $recommendations = new WP_Query($args);



        $custom_stages = array();

        if ($recommendations->have_posts()) :
            while ($recommendations->have_posts()) : $recommendations->the_post();

                $candidate_id = get_the_ID();
                $candidate_stage = get_field('candidate_stage', $candidate_id);
                $custom_stages_values = get_field('custom_stages', $vacancy_id);
                $custom_stages_array = $custom_stages_values ? explode(',', $custom_stages_values) : [];

                foreach ($custom_stages_array as $custom_stage) {
                    if (!isset($custom_stages[$custom_stage])) {
                        $custom_stages[$custom_stage] = array();
                    }
                    if ($candidate_stage === $custom_stage) {
                        $custom_stages[$custom_stage][] = $candidate_id;
                    }
                }

                if (isset($stages[$candidate_stage])) {
                    $stages[$candidate_stage][] = $candidate_id;
                }
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
        <h3>Етапи співбесід</h3>
        <div class="stages"  data-vacid="<?php echo $vacancy_id; ?>">
            <?php
            $field_object = get_field_object('etapi_spivbesidi', $vacancy_id);
            $etapi_spivbesidi_values = $field_object['value'];
            $choices = $field_object['choices'];

            if (is_array($etapi_spivbesidi_values) && count($etapi_spivbesidi_values) > 0) :
                foreach ($etapi_spivbesidi_values as $value) :
                    $label = isset($choices[$value]) ? $choices[$value] : $value;
                    $candidates = isset($stages[$value]) ? $stages[$value] : array();
                    ?>
                    <div class="stage" data-stage="<?php echo $value; ?>">
                        <span class="er-h"><?php echo $label; ?></span>
                        <?php
                        foreach ($candidates as $candidate_id) :
                            $imya = get_field('imya', $candidate_id);
                            $fam = get_field('familiya', $candidate_id);
                            ?>
                            <div class="candidate" draggable="true" data-id="<?php echo $candidate_id; ?>"><?php echo $imya . ' ' . $fam; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach;
            endif;

            ?>

            <?php foreach ($custom_stages as $stage => $candidates) : ?>
                <div class="stage" data-stage="<?php echo $stage; ?>">
                    <span class="er-h"><?php echo $stage; ?></span>
                    <button class="delete-stage" data-stage="<?php echo $stage; ?>">X</button>
                    <?php foreach ($candidates as $candidate_id) :
                        $imya = get_field('imya', $candidate_id);
                        $fam = get_field('familiya', $candidate_id);
                        ?>
                        <div class="candidate" draggable="true" data-id="<?php echo $candidate_id; ?>"><?php echo $imya; echo ' ' . $fam; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>


            <input type="text" id="custom_stage" placeholder="Свій варіант">
            <button id="add_custom_stage">Додати</button>
        </div>
        <input type="hidden" name="candidate_stage" value="">
        <input type="hidden" name="custom_stages" value="">


    </div>
        </div>
<script>
    var vacancy_id = <?php echo $vacancy_id; ?>;
</script>
<?php
get_template_part('template-parts/formAddCand') ?>
<?php get_footer(); ?>
