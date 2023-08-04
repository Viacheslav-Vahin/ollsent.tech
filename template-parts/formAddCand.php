<article class="popup_form addNewCand">
    <div class="popup_bgr" data-popup="close"></div>
    <div class="popup_box">
        <div class="pop_box_inn">
            <button type="button" class="close-modal" data-popup="close">×</button>
            <h3 class="cloud-title">Створити кандидата<span class="cuID1 dnone"><?php echo get_current_user_id(); ?></span>
        <!-- <input id="cutime" type="datetime" value="<?php
        date_default_timezone_set('Europe/Kiev');
        $date = date('m-d-Y H:i:s', time()); echo $date; ?>"> -->
        </h3>
            <section class="p_form">
                <?php
                acf_enqueue_uploader();
                acf_form_head();

                while (have_posts()) : the_post(); ?>
                    <?php
                    acf_form(array(
                        'post_id' => 'new_post',
                        'post_title' => true,
                        'post_content' => false,
                        'new_post' => array(
                            'post_type' => 'candidate',
                            'post_status' => 'publish'
                        ),
                        'submit_value' => 'Створити кандидата',
                        'uploader' => 'basic',
                        'return' => home_url('/baza-kandidatov/')
//                        'return' => add_query_arg('p', '%post_id%', home_url())
                    )); ?>
                <?php endwhile;
                $teamPageData = new WP_Query(array(
                    'post_per_page' => 2,
                    'meta_key' => 'dataStart',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    'post_type' => 'vacancy',
                    'suppress_filters' => false,
                    'meta_query' => array(
                        array(
                            'key' => 'show_v',
                            'compare' => '=',
                            'value' => 1
                        )

                    )
                )); ?>
                <input readonly value="<?php echo $teamPageData->post_count; ?>" id="phpCount"
                       class="dp_post_count dnone">
                <button type="button" id="getToVac2" class="getToVac2">Взяти на вакансію</button>
                <div id="moveToRekr2" style="display: none;">
                    <h2 data-rekr="<?php $cu = get_current_user_id(); echo $cu; ?>">
                        Забрати <span id="cName"></span> на вакансію<span id="close1" class="close1">×</span></h2>

                    <select class="" id="mVac2">
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
                            <option data-exist='<?php echo $existStarStatus; ?>' value="<?php echo get_the_ID(); ?>" class="vacOption2"><?php the_title(); ?></option>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </select>
                    <select class="" id="mStage2" style="display:inline-block;">
                        <!-- Здесь будут добавлены этапы співбесід через AJAX -->
                    </select>
                    <button type="submit" id="saveMove2">Сохранить</button>
                </div>
            </section>
        </div>
    </div>
</article>