<?php
/*
Template Name: Главная
*/
?>
<?php acf_form_head(); get_header();
?>

<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
<section class="grey_bg">
    <div class="dp_cont gb1">
        <p id="demo"></p>
       
        <h1 class="h1a">IT Вакансії для ваших кандидатів</h1>
        <h2 class="h2t">Ollsent-hire - це платформа, на якій ви можете рекомендувати своїх кандидатів та отримувати бонуси у розмірі 30% від місячної зарплати кандидата<span class="rdwrap"><span class="redstar">*</span></span></h2>
        <h3 class="h3t"><span class="rdwrap"><span class="redstar2">*</span></span>Ми сплачуємо вам бонус у розмірі 30% від місячного окладу кандидата, на який його прийняла компанія. Виплати відбуваються у 2 етапи: перші 15% ви отримуєте у перший місяць як він вийшов, решта 15% після закінчення 100 днів з моменту його виходу. Виплати може бути на карту будь-якого банку.</h3>
           
           <?php 
            $cu = get_current_user_id();
            $user = get_userdata( $cu );
            $user_roles = $user->roles;
           if(!is_user_logged_in()) { ?>
            <a class="try_now" href="<?php echo esc_url(site_url('/wp-login.php')); ?>">Добавити кандидата</a>
            <?php  } elseif (is_user_logged_in() && (in_array( 'freelancer', $user_roles, true ) || in_array( 'role_rekruter', $user_roles, true ) || in_array( 'timlid', $user_roles, true ) || in_array( 'administrator', $user_roles, true ) || in_array( 'editor', $user_roles, true ))) { ?>
            <a data-popup="open" class="try_now addc1">Добавити кандидата</a><?php } ?>
        <div class="main_info">
            <div class="hl">
                <h3 class="h3d">У нас ви можете:</h3>    
                <?php the_field('main_info'); ?> 
            </div>
            <div class="hr">
            <div class="himg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/home/attention.svg)"></div>
            <h4 class="">Всі кандидати закріплюються за вами протягом 30 днів, якщо йому знаходять проект ви отримуєте свою винагороду</h4> 
            </div>
        </div>
    </div>
</section>
<section class="why_we">
        <div class="dp_cont">
        <h2>Чому ми?</h2>
        <div class="we">
            <div class="we1">
                <p class="nbr">1</p>
                <h4>Релевантні пропозиції</h4>
                <p>Більше не потрібно шукати по чатах релевантних пропозицій для своїх кандидатів. Позначте їх у нас і ми запропонуємо їм відповідні вакансії</p>
            </div>
            <div class="we1">
                <p class="nbr">2</p>
                <h4>Швидкість та простота</h4>
                <p>Тепер відстежувати пересування ваших кандидатів стало ще простіше і не потрібно щоразу питати рекрутера, все буде під рукою.</p>
            </div>
            <div class="we1">
                <p class="nbr">3</p>
                <h4>Конфіденційність</h4>
                <p>Ми не афішуємо кандидату, хто його порекомендував, якщо ви цього самі не хочете.</p>
            </div>
            <div class="we4">
                <p class="nbr">4</p>
                <h4>Гарантія</h4>
                <p>Усі кандидати, яких ви нам рекомендуєте, закріплюються за вами протягом 30 днів. Якщо протягом цього часу ми беремо його на проект - бонус ваш!</p>
            </div>
        </div>
    </div>
</section>
<section class="how_works">
    <div class="dp_cont">
        <h2>Як це працює?</h2>
        <div class="hw_inn">
            <div class="hw_item">
                <p>1. Знаходите відповідну вакансію</p>
                <div class="himg2" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/home/analyze.svg)"></div>
            </div>
            <div class="hw_item">
                <p>2. Надсилаєте резюме кандидата, який у вас є</p>
                <div class="himg2" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/home/investment.svg)"></div>
            </div>
            <div class="hw_item">
                <p>3. Заходьте в особистий кабінет та дивіться успіхи по кандидату</p>
                <div class="himg2" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/home/selecting.svg)"></div>
            </div>            
        </div>
        <div class="hw_inn2">
            <div class="hw_item">
                <p>4. Ваш кандидат отримує оффер</p>
                <div class="himg2" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/home/partnership.svg)"></div>
            </div>
            <div class="hw_item">
                <p>5. Ви отримуєте свій бонус</p>
                <div class="himg2" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/home/finance.svg)"></div>
            </div>
        </div>
    </div>
</section>
<section class="trust">
    <div class="dp_cont">
        <h2>Нам довіряють</h2>
        <div class="trust_box">
            <div class="tbwrap"><div class="himg3" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/trust/1.jpg)"></div></div>
            <div class="tbwrap"><div class="himg3" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/trust/2.jpg)"></div></div>
            <div class="tbwrap"><div class="himg3" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/trust/3.jpg)"></div></div>
            <div class="tbwrap"><div class="himg3" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/trust/4.jpg)"></div></div>
            <div class="tbwrap"><div class="himg3" style="background-image: url(<?php echo bloginfo('template_url'); ?>/assets/img/trust/5.jpg)"></div></div>
        </div>
    </div>
</section>




<?php
    
    if(is_user_logged_in() && current_user_can('publish_clients')) { ?>
<article class="popup_form addVac">
    <div class="popup_bgr" data-popup="close"></div>
    <div class="popup_box">
        <div class="pop_box_inn">
            <button type="button" class="close-modal" data-popup="close">×</button>
            <h3 class="cloud-title">Створити вакансію</h3>
            <section>
                <div class="customContainer1">
                    <section class="p_form">
                        <?php acf_form(array(
                            'post_title' => true,
                            'post_content' => true,
                            'submit_value' => __('Сохранить изменения')
                        )); ?>
                    </section>

                </div>
        </div>
</article>
<?php }


if (is_user_logged_in() && current_user_can('publish_freelancers')) {
    get_template_part('template-parts/formAddCand');
    get_template_part('template-parts/formAddClient');
}
get_footer(); ?>