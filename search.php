<?php get_header(); ?>
    <div class="dp_container">
        <h1 class="et">Все вакансии</h1>
        <div class="vac_wrap">
            <div class="left_vac">
                <div id="vac_filtrs" class="vac_filtrs">
                    <input class="lang_left" type="text" class="myInput" id="i0" placeholder="искать по названию вакансии"/>
                    <select class="lang_left" id="vac_speciality">
                        <option value="">Выберите язык прог-я</option>
                        <?php
                        $teamPageData = new WP_Query(array(
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'post_type' => 'language',
                            'suppress_filters' => true,
                        ));
                        while ($teamPageData->have_posts()) {
                            $teamPageData->the_post(); ?>
                            <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </select>

                    <!--                <h3>--><?php //the_field(left_title2); ?><!--</h3>-->
                    <!--            <select class="lang_left" onchange="window.location.href = this.options[this.selectedIndex].value">-->
                    <select class="lang_left" id="vac_framework">
                        <option value="">Выберите фреймворк</option>
                        <?php
                        $teamPageData = new WP_Query(array(
                            'post_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'post_type' => 'specialty',
                            'suppress_filters' => true,
                        ));
                        while ($teamPageData->have_posts()) {
                            $teamPageData->the_post(); ?>
                            <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </select>


                    <!--            <p><input type="range" min="0.5" max="15" id="size" oninput="sizePic()" value="3"></p>-->
                    <p><input type="range" min="0.5" max="17" step="0.5" id="opyt_vacans_input" oninput="fun1()"
                              value="0.5"></p>
                    <p class="oput_rabot">Опыт работы: <span class="transp">a</span><span id="opyt_vacans">?</span><span
                                class="transp">a</span> лет</p>

                    <div class="zarplata">
                        <h3>ЗП Ожидания</h3>
                        <div class="zarplata_data">
                            <span>$ </span><input id="vac_zarplata_from" type="number" placeholder="от"><span
                                    class="krapku"> ... </span>
                            <input id="vac_zarplata_to" type="number" placeholder="до">
                            <!--                    <span class="dashicons dashicons-arrow-right-alt afl"></span>-->
                        </div>
                    </div>
                    <div class="qa_wrapper">
                        <div class="q_a">
                            <h3 class="accordion-title">Формат работы
                                <div class="qa_icon_wrapper tran">
                                    <span class="dashicons dashicons-arrow-right-alt2 tran"></span>
                                </div>
                            </h3>
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
                                               id="i<?php echo $countFormat; ?>"
                                               value="<?php the_title(); ?>">
                                        <label class="custom-control-label"
                                               for="i
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
<!--                <div class="sti">-->
<!--                    <input class="si i0" type="text" class="myInput" id="i0" placeholder="Искать по названию вакансии"/>-->
<!--                </div>-->
                <form action="<?php bloginfo('url'); ?>" method="get" class="search_vac">
                    <input class="si" type="text" name="s" placeholder="<?php the_field(placeh_inp); ?>"
                           value="<?php if (!empty($_GET['s'])) {
                               echo $_GET['s'];
                           } ?>">
<!--                    <button type="submit"><span class="dashicons dashicons-arrow-right-alt avr"></span></button>-->
                    <!--                        <p><input type="checkbox" name="option1" value="a1" checked>-->
                    <?php //the_field(search_all); ?><!--<Br>-->
                    <!--                        <input type="checkbox" checked>-->
                    <!--                            <span class="ch">&#10003;</span>-->
<!--                    <div class="vert_align">-->
<!--                        <input type="checkbox" id="allt" name="allt">-->
<!--                        <label for="allt">--><?php //the_field(search_all); ?><!--</label>-->
<!--                    </div>-->
                </form>
                <?php
                //        $args = array_merge( $wp_query->query, array( 'post_type' => array("post", "vacancy")) );
                $args = array_merge($wp_query->query, array('post_type' => array("vacancy")));
                query_posts($args); ?>
               <h2 class="search_results"> <?php printf(__('Результаты поиска: %s', 'devport'), '' . get_search_query() . ''); // Динамический заголовок поиска?></h2>
                <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                <div class="dp_post_count"><?php echo $wp_query->post_count; ?></div> <?php // Начало цикла ?>
                    <div class="task-list-row vac_item"
                         data-title="<?php the_title(); ?>"
                         data-spec="<?php the_field(spec); ?>"
                         data-angl="<?php the_field(angl); ?>"
                         data-opyt="<?php the_field(opyt); ?>"
                         data-zarplata="<?php the_field(zarplata); ?>"
                         data-framework="<?php the_field(frejmvork); ?>"
                         data-work_format="<?php $cand_ctegory = get_field('format_raboty');
                         foreach ($cand_ctegory as $k) {
                             echo $k->post_title;
                         } ?>"
                    >
                        <h3 class="entry-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="date"><?php the_time('F j, Y'); // Дата создания поста ?></div>
                        <p>
                            <?php
                            $cand_ctegory = get_field('spec_related');
                            foreach ($cand_ctegory as $k) {
                                echo $k->post_title;
                            }
                            ?>
                        </p>
                        <p><?php the_field(frejmvork); ?></p>
                        <p class="opyt_v"><?php the_field(opyt); ?></p>
                        <p><?php the_field(uroven); ?></p>
                        <p>$<?php the_field(zarplata); ?></p>
                        <p><?php the_field(angl); ?></p>
                        <p>
                            <?php
                            $cand_ctegory = get_field('format_raboty');
                            foreach ($cand_ctegory as $k) {
                                echo $k->post_title;
                                ?><span class="transp">a</span><?php
                            }
                            ?>
                        </p>
                        <p><?php the_field(lokacziya); ?></p>
                        <p><?php the_field(opis_vak); ?></p>
                        <p><?php the_field(data); ?></p>
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        } // Проверяем наличие миниатюры, если есть показываем ?>
                        <?php the_content(); // Содержимое страницы ?>
                    </div>
                <?php endwhile; // Конец цикла ?>
                <div class="pagination"><?php // Пагинация
                    global $wp_query;
                    $big = 999999999;
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'type' => 'list',
                        'prev_text' => __('« Назад'),
                        'next_text' => __('Вперед »'),
                        'total' => $wp_query->max_num_pages
                    ));
                    ?></div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>