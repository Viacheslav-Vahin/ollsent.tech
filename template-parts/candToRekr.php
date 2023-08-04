<?php  ?>
<div class="rekomFormEdit">                                  
        <h2>Изменить <?php the_field(imya); echo ' '; the_field(familiya); ?><span id="ce1">×</span></h2>
        <?php
            $recomendData = new WP_Query(array(
                'post_type' => 'rekomend',
                'post_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                
                // 'post_id' => the_id()
                // 'ID' => the_id(),
                'meta_query' => array(
                    array(
                        'key' => 'imya',
                        'compare' => '=',
                        'value' => get_field(imya)
                    ),
                    array(
                        'key' => 'familiya',
                        'compare' => '=',
                        'value' => get_field(familiya)
                    )
                )
                // 'post_id' => the_id()
                // 'ID' => the_id(),
            ));
            while ($recomendData->have_posts()) {
                $recomendData->the_post(); ?>
          
            <?php acf_form(array(
                                    'post_title' => true,
                                    'post_content' => true,
                                    'submit_value' => __('Сохранить изменения')
                                )); ?>
            <?php
            }
        
            wp_reset_postdata();
        ?>
    </div>