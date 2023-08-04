<footer>
    <aricle class="foot_cont">
    <a href="<?php echo esc_url(site_url('/'))  ?>" class="logo">Ollsent-hire</a>
    <div class="foot_links">
    <div class="">
        <?php  
         $cu = get_current_user_id();
                     $user = get_userdata( $cu );
                     $user_roles = $user->roles;
            if ( is_user_logged_in() && ( in_array( 'role_rekruter', $user_roles, true ) || in_array( 'timlid', $user_roles, true )) ) { ?>
            <a class="vacancy_menu" href="<?php echo esc_url(site_url('/vacancies')) ?>"><span <?php if (is_page('vacancies')) echo 'class = "menu_act"'; ?>>Вакансиї</span></a>
                 <a class="vacancy_menu" href="<?php echo esc_url(site_url('/pipeline')) ?>"><span <?php if (is_page('pipeline')) echo 'class = "menu_act"'; ?>>Pipeline</span></a>
                 <a class="vacancy_menu"  href="<?php echo esc_url(site_url('/baza-kandidatov'))  ?>"><span <?php if (is_page('baza-kandidatov')) echo 'class = "menu_act"'; ?>>База кандидатів</span></a>
            <?php  }
                             
            ?>
        <?php
        if(!is_user_logged_in()) { ?>
            <?php  } elseif (is_user_logged_in() && (in_array( 'freelancer', $user_roles, true ) || in_array( 'role_rekruter', $user_roles, true ) || in_array( 'timlid', $user_roles, true ) || in_array( 'administrator', $user_roles, true ) || in_array( 'editor', $user_roles, true ))) { ?>
            <?php } elseif (is_user_logged_in() && in_array( 'client', $user_roles, true ) ) { ?>
        <a data-popup="open" class="vacancy_menu addVacClick">Добавити вакансію<span class="cusID dnone"><?php echo get_current_user_id(); ?></span></a>
        <?php }
        ?>
        <nav>            
            <?php
            $cu = get_current_user_id();
            $user = get_userdata( $cu );

            $user_roles = $user->roles;

            // Check if the role you're interested in, is present in the array.
            if ( is_user_logged_in() && in_array( 'timlid', $user_roles, true ) ) { ?>
            <a class="vacancy_menu" href="<?php echo esc_url(site_url('/vacancies')) ?>"><span <?php if (is_page('vacancies')) echo 'class = "menu_act"'; ?>>Вакансії</span></a>
                <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
                <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
                <!-- <a href="<?php echo esc_url(site_url('/timlid'))  ?>"><span <?php if (is_page('timlid')) echo 'class = "menu_act"'; ?>>Личный кабинет</span></a> -->
          <?php  }
            if ( is_user_logged_in() && in_array( 'role_rekruter', $user_roles, true ) ) { ?>
            <a class="vacancy_menu" href="<?php echo esc_url(site_url('/vacancies')) ?>"><span <?php if (is_page('vacancies')) echo 'class = "menu_act"'; ?>>Вакансії</span></a>
                <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board')) echo 'class = "menu_act"'; ?>>Планировщик</span></a>
                <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календарь</span></a>
                <!-- <a href="<?php echo esc_url(site_url('/rekruter'))  ?>"><span <?php if (is_page('rekruter')) echo 'class = "menu_act"'; ?>>Личный кабинет</span></a> -->
            <?php  }
            if ( is_user_logged_in() && in_array( 'freelancer', $user_roles, true ) ) { ?>
            <a class="vacancy_menu" href="<?php echo esc_url(site_url('/vacancies')) ?>"><span <?php if (is_page('vacancies')) echo 'class = "menu_act"'; ?>>Вакансії</span></a>
                <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
                <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
                <!-- <a href="<?php echo esc_url(site_url('/kabinet'))  ?>"><span <?php if (is_page('kabinet')) echo 'class = "menu_act"'; ?>>Личный кабинет</span></a> -->
            <?php  }
            if ( is_user_logged_in() && in_array( 'client', $user_roles, true ) ) { ?>
            <a class="vacancy_menu" href="<?php echo esc_url(site_url('/vacancies')) ?>"><span <?php if (is_page('vacancies')) echo 'class = "menu_act"'; ?>>Вакансії</span></a>
                <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
                <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
                <!-- <a href="<?php echo esc_url(site_url('/cabinet'))  ?>"><span <?php if (is_page('cabinet')) echo 'class = "menu_act"'; ?>>Личный кабинет</span></a> -->
            <?php  }
            $user5 = wp_get_current_user();
            if (is_user_logged_in() && current_user_can('editor') || current_user_can('administrator')) {
                ?>
                <!-- <a href="<?php echo esc_url(site_url('/kabinet'))  ?>"><span <?php if (is_page('kabinet')) echo 'class = "menu_act"'; ?>>Фрилансер</span></a>
                <a href="<?php echo esc_url(site_url('/cabinet'))  ?>"><span <?php if (is_page('cabinet')) echo 'class = "menu_act"'; ?>>Клиент</span></a> -->
                
                <a href="<?php echo esc_url(site_url('/kanban/board'))  ?>"><span <?php if (is_page('/kanban/board?board_id=1')) echo 'class = "menu_act"'; ?>>Планувальник</span></a>
            <a href="<?php echo esc_url(site_url('/baza-kandidatov'))  ?>"><span <?php if (is_page('baza-kandidatov')) echo 'class = "menu_act"'; ?>>База кандидатів</span></a>
            <a href="<?php echo esc_url(site_url('/sotrudniki'))  ?>"><span <?php if (is_page('sotrudniki')) echo 'class = "menu_act"'; ?>>Співпрацівники</span></a>           
            <a href="<?php echo esc_url(site_url('/kalendar'))  ?>"><span <?php if (is_page('kalendar')) echo 'class = "menu_act"'; ?>>Календар</span></a>
            <a href="<?php echo esc_url(site_url('/rekruter'))  ?>"><span <?php if (is_page('rekruter')) echo 'class = "menu_act"'; ?>>Рекрутер</span></a>
            <?php  } ?>           
        </nav>
            </div>
    </div>
    <div class="cont">
        <h3>Контакти:</h3>
        <div class="fcont_det">
            <img  src="<?php echo bloginfo('template_url');?>/assets/img/footer/1.jpg" alt="img 1">
            <span>support@ollsent-hire.com</span>
        </div>
        <div class="fcont_det">
            <img  src="<?php echo bloginfo('template_url');?>/assets/img/footer/2.jpg" alt="img 2">
            <span>@ollsent_hire</span>
        </div>
        <div class="fcont_det">
            <img  src="<?php echo bloginfo('template_url');?>/assets/img/footer/3.jpg" alt="img 3">
            <span>All World</span>
        </div>
    </div>
    </aricle>
</footer>
<?php
wp_footer();
?>
</body>
</html>