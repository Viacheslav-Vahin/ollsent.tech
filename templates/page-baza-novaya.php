<?php
$name_filter = isset($_GET['name']) ? sanitize_text_field($_GET['name']) : null;
$it = 0;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => array('candidate','rekomend'),
    'meta_key' => 'dataStart2',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
//    'posts_per_page' => 2,
//    'paged' => $paged,
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
    <?php while ($recomendData->have_posts()) {
        $recomendData->the_post(); ?>
        <div class="myCandW mcd kandItem1 baza"
             data-pdf="<?php the_field('pdf_parsed'); ?>"
             data-timer="<?php the_field('dataStart0'); ?>"
             data-name1="<?php the_field('imya'); ?>"
             data-bl="<?php if (get_field('prichina_bl')) {echo "blacklist";} ?>"
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
             data-contval="<?php $f_email = get_field_object('email_r'); if($f_email['value'] ) { echo $f_email['value'] . ", "; } $f_skype = get_field_object('skype_r'); if($f_skype['value'] ) { echo $f_skype['value'] . ", "; } $telegram = get_field_object('telegram'); if($telegram['value'] ) { echo $telegram['value'] . ", "; } $viber_r = get_field_object('viber_r'); if($viber_r['value'] ) { echo $viber_r['value'] . ", "; } $whatsapp_r = get_field_object('whatsapp_r'); if($whatsapp_r['value'] ) { echo $whatsapp_r['value'] . ", "; } $linkedin = get_field_object('linkedin'); if($linkedin['value'] ) { echo $linkedin['value']; }?>" data-work_format="<?php $cand_tipr = get_field('tip_raboty');
        foreach ($cand_tipr as $tr) {
            echo $tr->post_title;
        } ?>"
             data-zar="<?php the_field('zarplata'); ?>"
             data-country="<?php $city = get_field('city_r'); foreach ($city as $c) { ?><?php echo $c->post_title;} ?>"
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
                        ?><a href="javascript:void(0);" class="spec1 cp_btn bk_email" id="bk_email<?php echo $it;?>"><span><?php the_field('email_r'); ?></span></a><?php
                    }
                    if (get_field('tel_r')) {
                        ?><a href="javascript:void(0);" class="spec1 cp_btn bk_phone" id="bk_phone<?php echo $it;?>"><span><?php the_field('tel_r'); ?></span></a><?php
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
                        // URL файла с помощью идентификатора
                        $resume_url = wp_get_attachment_url($resume_id);
                        ?>
                        <?php
                        if (get_field('prichina_bl')) { ?>
                            <button class="lb-bl bkpage" id="open-popup">В чорному списку!!!</button>
                            <div id="popup" class="popup">
                                <div id="popup-content">
                                    <p><?php the_field('povnij_opis_chs')?></p>
                                </div>
                            </div>
                        <?php } ?>
                        <embed src="<?php echo $resume_url; ?>" frameborder="0" width="100%" height="700px">
                        <?php $post_id = get_the_ID(); // Получите ID текущего поста
                        $docx_attach_id = get_post_meta($post_id, 'resume_docx', true); // ID вложения .docx файла
                        $docx_url = wp_get_attachment_url($docx_attach_id); //URL вложения .docx файла
                        ?>
                        <a href="<?php echo $docx_url; ?>" class="dnl_btn" download="">Завантажити у форматі .docx</a>
                    </div>
                </div>
            </div>
            <div class="bk_end">
                <button type="button" class="getToVac">Взяти на вакансію</button>
                <!--                        <button class="favorite-star" data-candidate-id="--><?php //echo get_the_ID(); ?><!--">-->
                <!--                            <i class="fas fa-star"></i>-->
                <!--                            eeeeeee-->
                <!--                        </button>-->
                <button class="favorite-star" data-candidate-id="<?php echo get_the_ID(); ?>">
                    ☆
                </button>

            </div>
        </div>
        <?php
        $it++; }
    echo paginate_links( array(
        'base' => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'total' => $recomendData->max_num_pages,
        'current' => max( 1, get_query_var( 'paged' ) ),
        'format' => '?paged=%#%',
        'show_all' => false,
        'prev_next' => true,
        'prev_text' => __( 'Prev' ),
        'next_text' => __( 'Next' ),
    ) );
    wp_reset_postdata();
    ?>
</section>