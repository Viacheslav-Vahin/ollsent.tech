<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Devport</title>
    <link rel="shortcut icon" href="<?php echo bloginfo('template_url');?>/assets/img/favicons/1.ico" type="image/x-icon">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <?php
    wp_head();
    ?>
</head>
<body>
<header>
    <div class="header">
        <div class="btn-menu" data-menu="open">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <a href="<?php echo esc_url(site_url('/'))  ?>" class="logo">Ollsent-hire
            <!--            <img src="/ThemeAS/images/logo2.png" alt="">-->
        </a>
        <span class="dnone"><?php $arrm = ['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];
            $m5 = date('n')-1;
            echo date('j').' '. $arrm[$m5].', '.date('Y'); ?></span>
        <div class="showNav">
            <a class="vacancy_menu" href="<?php echo esc_url(site_url('/vacancies')) ?>"><span <?php if (is_page('vacancies')) echo 'class = "menu_act"'; ?>>Вакансії</span></a>
            <?php
            $cu = get_current_user_id();
            $user = get_userdata( $cu );
            $user_roles = $user->roles;
            if ( is_user_logged_in() && ( in_array( 'role_rekruter', $user_roles, true ) || in_array( 'timlid', $user_roles, true )) ) { ?>
                <a class="vacancy_menu" href="<?php echo esc_url(site_url('/pipeline')) ?>"><span <?php if (is_page('pipeline')) echo 'class = "menu_act"'; ?>>Pipeline</span></a>
                <a class="vacancy_menu"  href="<?php echo esc_url(site_url('/baza-kandidatov'))  ?>"><span <?php if (is_page('baza-kandidatov')) echo 'class = "menu_act"'; ?>>База кандидатів</span></a>
            <?php  }

            ?>
            <!--        <a data-popup="open" class="vacancy_menu">Добавить кандидата</a>-->
            <?php
            if(!is_user_logged_in()) { ?>
                <a class="vacancy_menu" href="<?php echo esc_url(site_url('/wp-login.php')); ?>">Додати кандидата</a>
            <?php  } elseif (is_user_logged_in() && (in_array( 'freelancer', $user_roles, true ) || in_array( 'role_rekruter', $user_roles, true ) || in_array( 'timlid', $user_roles, true ) || in_array( 'administrator', $user_roles, true ) || in_array( 'editor', $user_roles, true ))) { ?>
                <a data-popup="open" class="vacancy_menu addc1">Додати кандидата</a>
            <?php } elseif (is_user_logged_in() && in_array( 'client', $user_roles, true ) ) { ?>
                <a data-popup="open" class="vacancy_menu addVacClick">Додати вакансію<span class="cusID dnone"><?php echo get_current_user_id(); ?></span></a>
            <?php }
            ?>
            <nav>
                <!--            <ul class="menu" id="menu" data-menu="close">-->
                <!--                <li>-->
                <!--                    <a href="#command">-->
                <!--                        Command-->
                <!--                    </a>-->
                <!--                </li>-->

                <!-- <div class="lang_switch">
                    <a href="#">РУС</a>
                    <a href="#">УКР</a>
                </div> -->

                <?php
                //            wp_nav_menu( [
                //                'menu'            => 'Main',
                //                'container'       => false,
                //                'menu_class'      => 'menu',
                //                'menu_id'         => 'menu',
                //                'echo'            => true,
                //                'fallback_cb'     => 'wp_page_menu',
                //                'items_wrap'      => '<ul id="menu" class="menu">%3$s</ul>',
                //                'depth'           => 1,
                //            ] );
                $cu = get_current_user_id();
                //            echo $cu;
                $user = get_userdata( $cu );

                // Get all the user roles as an array.
                $user_roles = $user->roles;

                // Check if the role you're interested in, is present in the array.
                if ( is_user_logged_in() && in_array( 'timlid', $user_roles, true ) ) { ?>
                    <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
                    <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
                    <a href="<?php echo esc_url(site_url('/timlid'))  ?>"><span <?php if (is_page('timlid')) echo 'class = "menu_act"'; ?>>Особистий кабинет</span></a>
                <?php  }
                if ( is_user_logged_in() && in_array( 'role_rekruter', $user_roles, true ) ) { ?>
                    <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
                    <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
                    <a href="<?php echo esc_url(site_url('/rekruter'))  ?>"><span <?php if (is_page('rekruter')) echo 'class = "menu_act"'; ?>>Особистий кабинет</span></a>
                <?php  }
                if ( is_user_logged_in() && in_array( 'freelancer', $user_roles, true ) ) { ?>
                    <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
                    <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
                    <a href="<?php echo esc_url(site_url('/kabinet'))  ?>"><span <?php if (is_page('kabinet')) echo 'class = "menu_act"'; ?>>Особистий кабинет</span></a>
                <?php  }
                if ( is_user_logged_in() && in_array( 'client', $user_roles, true ) ) { ?>
                    <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
                    <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
                    <a href="<?php echo esc_url(site_url('/cabinet'))  ?>"><span <?php if (is_page('cabinet')) echo 'class = "menu_act"'; ?>>Особистий кабинет</span></a>
                <?php  }
                $user5 = wp_get_current_user();
                if (is_user_logged_in() && current_user_can('editor') || current_user_can('administrator')) {
                    ?>
                    <!-- <a href="<?php echo esc_url(site_url('/kabinet'))  ?>"><span <?php if (is_page('kabinet')) echo 'class = "menu_act"'; ?>>Фрилансер</span></a>
                <a href="<?php echo esc_url(site_url('/cabinet'))  ?>"><span <?php if (is_page('cabinet')) echo 'class = "menu_act"'; ?>>Клиент</span></a> -->

                    <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board?board_id=1')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
                    <a href="<?php echo esc_url(site_url('/baza-kandidatov'))  ?>"><span <?php if (is_page('baza-kandidatov')) echo 'class = "menu_act"'; ?>>База кандидатів</span></a>
                    <a href="<?php echo esc_url(site_url('/sotrudniki'))  ?>"><span <?php if (is_page('sotrudniki')) echo 'class = "menu_act"'; ?>>Працівники</span></a>
                    <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
                    <a href="<?php echo esc_url(site_url('/rekruter'))  ?>"><span <?php if (is_page('rekruter')) echo 'class = "menu_act"'; ?>>Адмін</span></a>
                <?php  }

                if (!is_user_logged_in()) { ?>
                    <a href="<?php echo wp_login_url(); ?>" class="dp_login">Увійти</a>
                    <a href="<?php echo wp_registration_url(); ?>" class="dp_register">Реєстрація</a>
                    <!--                <a href="--><?php //echo esc_url(site_url('/wp-signup.php')); ?><!--" class="dp_register">Register</a>-->
                    <!--                <a href="--><?php //echo wp_registration_url(); ?><!--">Войти</a>-->
                <?php } ?>
                <!--            <a href="--><?php //echo esc_url(site_url('/rekomendacziya'))  ?><!--">Ваши Рекомендации</a>-->
                <!--            <a href="--><?php //echo esc_url(site_url('/wp-signup.php')); ?><!--">login</a>-->
                <!--            <a href="--><?php //echo wp_registration_url(); ?><!--">Зарегистрироваться</a>-->
            </nav>
        </div>
    </div>
</header>