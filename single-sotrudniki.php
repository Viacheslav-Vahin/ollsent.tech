<?php
/*
Template Name: Язык прогр-я
Template Post Type: sotrudnik
*/
if (!current_user_can('administrator') && !current_user_can('editor')) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}
 get_header(); ?>
<article class="dp_cont right_vac ss">
    <section class="sperson">
        <img class="" src="<?php if (the_field('foto')) {
            the_field('foto');
        } ?>" alt="Фотография сотрудника">
        <div class="sperson_text">
            <h2>Контактная информация</h2>
            <p><span class="boldCSS">Ф.И.О - </span><?php the_title(); ?></p>
            <p><span class="boldCSS">Дата рождения - </span><?php the_field('data_rozhdeniya'); ?></p>
            <p>Социальные сети:
            <p><a href="<?php esc_url(the_field('linkedin')); ?>">Linkedin</a></p>
            <p><a href="<?php esc_url(the_field('facebook')); ?>">Facebook</a></p>
            <p>Telegram: <?php the_field('telegram'); ?></p>
            <p>E-mail: <?php the_field('e-mail5'); ?></p>
            <p>Адрес: <?php the_field('adres'); ?></p>
            <p>Карта банка: <?php the_field('karta_banka'); ?></p>
            </p>
        </div>
    </section>
    <section class="spdiff">
        <h2>ДАТА СТАРТА РАБОТЫ<span class="s_span"> - <?php the_field('data_starta'); ?></span></h2>
    </section>
    <section class="spdiff">
        <h2>ВАШИ УСЛОВИЯ РАБОТЫ:</h2>
        <p class="sd1">
            <span class="boldCSS"><?php $uslVal = get_field('vashi_usloviya_raboty');
            echo $uslVal['znachenie']; ?></span><?php $usDescr = get_field('vashi_usloviya_raboty');
            echo $uslVal['opisanie_uslovij']; ?>
        </p>
        <p>Ссылка на ваш <a class="jo_link" href="<?php the_field('ssylka_offer'); ?>">Job offer</a></p>
    </section>
    <section class="spdiff">
        <h2>СТАВКА:</h2>
        <?php $month = get_field('stavka'); $offery = get_field('offery1'); ?>
        <table>
            <tr>
                <th class="first">Месяц</th>
                <th>Янв</th>
                <th>Фев</th>
                <th>Март</th>
                <th>Апр</th>
                <th>Май</th>
                <th>Июнь</th>
                <th>Июль</th>
                <th>Авг</th>
                <th>Сент</th>
                <th>Окт</th>
                <th>Нояб</th>
                <th>Дек</th>
            </tr>

            <tr>
                <td class="first">Ставка</td>
                <td><?php echo $month['yanv']; ?></td>
                <td class="vupl_red"><?php echo $month['fev']; ?></td>
                <td class="vupl_red"><?php echo $month['mart']; ?></td>
                <td class="vupl_red"><?php echo $month['apr']; ?></td>
                <td class="vupl_red"><?php echo $month['maj']; ?></td>
                <td><?php echo $month['iyun']; ?></td>
                <td><?php echo $month['iyul']; ?></td>
                <td><?php echo $month['avg']; ?></td>
                <td><?php echo $month['sent']; ?></td>
                <td><?php echo $month['okt']; ?></td>
                <td><?php echo $month['noyab']; ?></td>
                <td><?php echo $month['dek']; ?></td>
            </tr>
        </table>
        <p>Примечания:</p>
        <p><span class="vupl_red">Красным</span> выделено то, за что уже уплачено.</p>
    </section>
    <section class="spdiff">
        <h2>ОФФЕРЫ:</h2>
        <table>
            <tr>
                <th>Дата</th>
                <th>Имя и фамилия</th>
                <th>Должность</th>
                <th>Компания</th>
                <th>Бонус</th>
            </tr>

            <tr>
                <td><?php echo $offery['data1']; ?></td>
                <td><?php echo $offery['familiya1']; ?></td>
                <td><?php echo $offery['dolzhnost1']; ?></td>
                <td><?php echo $offery['kompaniya1']; ?></td>
                <td><span class="of1 vupl_red"><?php echo $offery['bonus1']; ?></span>
                    <?php if ($offery['bonus1']) {
                        echo ' / ';
                    } ?>
                    <span class="of2"><?php echo $offery['bonus2']; ?></span></td>
            </tr>
<!--            <tr>-->
<!--                <td>11/05/2021</td>-->
<!--                <td>Volodymyr Nevmerzhytskyi </td>-->
<!--                <td>Lead Android</td>-->
<!--                <td>Agile Engine</td>-->
<!--                <td>750/750</td>-->
<!--            </tr>-->
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <p>Примечание:</p>
        <p><span class="vupl_red">Красным</span> - то, что уже выплачено.</p>
        <p></p>
        <p><a class="jo_link" href="<?php
            $citiesData = new WP_Query(array(
                'post_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'post_type' => 'sotrgeneral',
                'suppress_filters' => false,
            ));
            while ($citiesData->have_posts()) {
            $citiesData->the_post();
                the_field('baza_znanij');
            }
            wp_reset_postdata(); ?>">БАЗА ЗНАНИЙ</a> - Обучение, скрипты</p>
    </section>
    <section class="spdiff">
        <h2>ТИП МОТИВАЦИИ:</h2>
    </section>
    <section class="spdiff month_goals">
        <h2>ЦЕЛИ НА МЕСЯЦ:</h2>
        <p>Закрыть 1 кандидата и больше.</p>
        <p>Личная цель: Заработать 1к у.е.</p>
        <p>Квартальный план = минимум 2 оффера.</p>
    </section>
    <section class="spdiff">
        <h2>ВАКАНСИИ В РАБОТЕ:</h2>
        <p>Можно посмотреть <a class="jo_link" href="<?php
            $citiesData = new WP_Query(array(
                'post_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'post_type' => 'sotrgeneral',
                'suppress_filters' => false,
            ));
            while ($citiesData->have_posts()) {
                $citiesData->the_post();
                the_field('vac_v_rabote');
            }
            wp_reset_postdata(); ?>">тут</a></p>
    </section>
    <section class="spdiff">
        <?php
        $citiesData = new WP_Query(array(
            'post_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'post_type' => 'sotrgeneral',
            'suppress_filters' => false,
        ));
        while ($citiesData->have_posts()) {
            $citiesData->the_post(); ?>
            <div class="scont1"><?php the_content(); ?></div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </section>
    <section class="spdiff">
        <?php
        $citiesData = new WP_Query(array(
            'post_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'post_type' => 'sotrgeneral',
            'suppress_filters' => false,
        ));
        while ($citiesData->have_posts()) {
            $citiesData->the_post(); ?>
            <div class="scont1 sc2"><?php the_field('kakih_no'); ?></div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </section>
</article>
<?php get_footer(); ?>
