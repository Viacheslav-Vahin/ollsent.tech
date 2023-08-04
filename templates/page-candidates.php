<?php
/*
Template Name: Кандидаты
*/
?>
<?php
if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
get_header(); ?>
<div class="dp_container">
    <h1>Кандидаты</h1>
    <div class="vac_wrap">
        <div class="left_vac">
            <!--                <h3>--><?php //the_field(left_title); ?><!--</h3>-->
            <select class="lang_left" onchange="window.location.href = this.options[this.selectedIndex].value">
                <option value="">Выберите специализацию</option>
                <?php
                $countVac = 0;
                $teamPageData = new WP_Query(array(
                    'post_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'post_type' => 'language',
                    'suppress_filters' => false,
                ));
                while ($teamPageData->have_posts()) {
                    $teamPageData->the_post();
                    $countVac++; ?>
                    <!--                        <option><a href="--><?php //the_permalink(); ?><!--">--><?php //the_title(); ?><!--</a></option>-->
                    <option value="<?php the_permalink(); ?>"><?php the_title(); ?></option>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </select>
            <!--                <h3>--><?php //the_field(left_title2); ?><!--</h3>-->
            <select class="lang_left" onchange="window.location.href = this.options[this.selectedIndex].value">
                <option value="">Выберите специальность</option>
                <?php
                $teamPageData = new WP_Query(array(
                    'post_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'post_type' => 'specialty',
                    'suppress_filters' => false,
                ));
                while ($teamPageData->have_posts()) {
                    $teamPageData->the_post(); ?>
                    <option value="<?php the_permalink(); ?>"><?php the_title(); ?></option>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </select>

            <!--            <p><input type="range" min="0.5" max="15" id="size" oninput="sizePic()" value="3"></p>-->
            <p><input type="range" min="0.5" max="17" step="0.5" id="r1" oninput="fun1()"></p>
            <p class="oput_rabot">Опыт работы: <span class="transp">a</span><span id="one">?</span><span class="transp">a</span> лет</p>
            <div class="zarplata">
                <h3>ЗП Ожидания</h3>
                <div class="zarplata_data">
                    <span>$ </span><input type="number" placeholder="от"><span class="krapku"> ... </span><input type="number" placeholder="до">
                    <span class="dashicons dashicons-arrow-right-alt afl"></span>
                </div>
            </div>
            <div class="q_a">
                <h3 class="accordion-title">Формат работы
                    <div class="qa_icon_wrapper tran">
                        <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                    </div>
                </h3>
                <div class="answ">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="i1">
                        <label class="custom-control-label" for="i1">Удаленно</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="i2">
                        <label class="custom-control-label" for="i2">Офис</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="i3">
                        <label class="custom-control-label" for="i3">Part-time</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="i4">
                        <label class="custom-control-label" for="i4">Freelance</label>
                    </div>
                </div>
            </div>

            <div class="q_a">
                <h3 class="accordion-title">Выберите город(a)
                    <div class="qa_icon_wrapper tran">
                        <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                    </div>
                </h3>
                <div class="answ">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="id1">
                        <label class="custom-control-label" for="id1">Винница</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="id2">
                        <label class="custom-control-label" for="id2">Киев</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="id3">
                        <label class="custom-control-label" for="id3">Львов</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="id4">
                        <label class="custom-control-label" for="id4">Одесса</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="id5">
                        <label class="custom-control-label" for="id5">Харьков</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="right_vac">
            <?php get_search_form(); ?>
            <div class="vac_descr">
                <?php
                $teamPageData = new WP_Query(array(
                    'post_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'post_type' => 'candidate',
                    'suppress_filters' => false,
                ));
                while ($teamPageData->have_posts()) {
                    $teamPageData->the_post(); ?>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php the_field(spec); ?></p>
                    <p><?php the_field(frejmvork); ?></p>
                    <p><?php the_field(opyt); ?></p>
                    <p><?php the_field(uroven); ?></p>
                    <p>$<?php the_field(zarplata); ?></p>
                    <p><?php the_field(angl); ?></p>
                    <p><?php the_field(lokacziya); ?></p>
                    <p><?php the_field(opis_vak); ?></p>
                    <p><?php the_field(data); ?></p>
                    <p>
                        <?php
                        $cand_ctegory = get_field('spec_related');
                        foreach ($cand_ctegory as $k) {
                            echo $k->post_title;
                        }
                        ?>
                    </p>
                    <!--                <div>--><?php //the_content(); ?><!--</div>-->
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
