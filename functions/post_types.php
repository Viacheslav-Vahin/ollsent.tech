<?php
function admin_menu() {
    register_post_type('adminmenu', array(
        'supports' => [ 'title', 'editor' ],
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Admin Menu',
            'add_new_item' => 'Добавити Menu',
            'edit_item' => 'Редагувати Menu',
            'all_items' => 'Усі Menu',
            'singular_name' => 'adminmenu'
        ),
        'menu_icon' => 'dashicons-admin-menu'
    ));
}
function mova_type() {
    register_post_type('mova', array(
        'supports' => array('title', 'editor'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Мови',
            'add_new_item' => 'Додати мову.',
            'edit_item' => 'Редагувати мову.',
            'all_items' => 'Усі мови.',
            'singular_name' => 'mova'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-html'
    ));
}
function contacts_type() {
    register_post_type('contacts', array(
        'supports' => array('title', 'editor'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Контакти',
            'add_new_item' => 'Додати контакт.',
            'edit_item' => 'Редагувати контакт.',
            'all_items' => 'Усі контакти.',
            'singular_name' => 'contacts'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-html'
    ));
}
function tags_type() {
    register_post_type('tagstype', array(
        'supports' => array('title', 'editor'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Теги',
            'add_new_item' => 'Додати тег.',
            'edit_item' => 'Редагувати тег.',
            'all_items' => 'Усі теги.',
            'singular_name' => 'tagstype'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-html'
    ));
}
function noitposts_type() {
    register_post_type('noitposts', array(
        'supports' => array('title', 'editor'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Інше',
            'add_new_item' => 'Додати інше.',
            'edit_item' => 'Редагувати інше.',
            'all_items' => 'Усі інше.',
            'singular_name' => 'noitposts'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-html'
    ));
}
function language_type() {
    register_post_type('language', array(
        'supports' => array('title', 'editor'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Розробка',
            'add_new_item' => 'Добавити мову прогр.',
            'edit_item' => 'Редагувати мову прогр.',
            'all_items' => 'Усі мови прогр.',
            'singular_name' => 'language'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-html'
    ));

    register_taxonomy('php', ['language'], [
        'label' => __('PHP', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'php'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('PHP', 'language'),
            'all_items' => __('All PHPs', 'language'),
            'edit_item' => __('Edit PHP', 'language'),
            'view_item' => __('View PHP', 'language'),
            'update_item' => __('Update PHP', 'language'),
            'add_new_item' => __('Add New PHP', 'language'),
            'new_item_name' => __('New PHP Name', 'language'),
            'search_items' => __('Search PHPs', 'language'),
            'popular_items' => __('Popular PHPs', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used PHPs', 'language'),
            'not_found' => __('No PHPs found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('php', 'language');
    register_taxonomy('js', ['language'], [
        'label' => __('JavaScript', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'js'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('JavaScript', 'language'),
            'all_items' => __('All JavaScript', 'language'),
            'edit_item' => __('Edit JavaScript', 'language'),
            'view_item' => __('View JavaScript', 'language'),
            'update_item' => __('Update JavaScript', 'language'),
            'add_new_item' => __('Add New JavaScript', 'language'),
            'new_item_name' => __('New JavaScript Name', 'language'),
            'search_items' => __('Search JavaScript', 'language'),
            'popular_items' => __('Popular JavaScript', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used JavaScript', 'language'),
            'not_found' => __('No JavaScript found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('java', 'language');
    register_taxonomy('java', ['language'], [
        'label' => __('Java', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'java'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Java', 'language'),
            'all_items' => __('All Java', 'language'),
            'edit_item' => __('Edit Java', 'language'),
            'view_item' => __('View Java', 'language'),
            'update_item' => __('Update Java', 'language'),
            'add_new_item' => __('Add New Java', 'language'),
            'new_item_name' => __('New Java Name', 'language'),
            'search_items' => __('Search Java', 'language'),
            'popular_items' => __('Popular Java', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Java', 'language'),
            'not_found' => __('No Java found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('Android', 'language');
    register_taxonomy('android', ['language'], [
        'label' => __('Android', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'android'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Android', 'language'),
            'all_items' => __('All Android', 'language'),
            'edit_item' => __('Edit Android', 'language'),
            'view_item' => __('View Android', 'language'),
            'update_item' => __('Update Android', 'language'),
            'add_new_item' => __('Add New Android', 'language'),
            'new_item_name' => __('New Android Name', 'language'),
            'search_items' => __('Search Android', 'language'),
            'popular_items' => __('Popular Android', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Android', 'language'),
            'not_found' => __('No Android found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('android', 'language');
    register_taxonomy('c-embedded', ['language'], [
        'label' => __('C/C++/Embedded', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'cembedded'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('C/C++/Embedded', 'language'),
            'all_items' => __('All C/C++/Embedded', 'language'),
            'edit_item' => __('Edit C/C++/Embedded', 'language'),
            'view_item' => __('View C/C++/Embedded', 'language'),
            'update_item' => __('Update C/C++/Embedded', 'language'),
            'add_new_item' => __('Add New C/C++/Embedded', 'language'),
            'new_item_name' => __('New C/C++/Embedded Name', 'language'),
            'search_items' => __('Search C/C++/Embedded', 'language'),
            'popular_items' => __('Popular C/C++/Embedded', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used C/C++/Embedded', 'language'),
            'not_found' => __('No C/C++/Embedded found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('c-embedded', 'language');
    register_taxonomy('c-net', ['language'], [
        'label' => __('C# / .NET', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'cnet'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('C# / .NET', 'language'),
            'all_items' => __('All C# / .NET', 'language'),
            'edit_item' => __('Edit C# / .NET', 'language'),
            'view_item' => __('View C# / .NET', 'language'),
            'update_item' => __('Update C# / .NET', 'language'),
            'add_new_item' => __('Add New C# / .NET', 'language'),
            'new_item_name' => __('New C# / .NET Name', 'language'),
            'search_items' => __('Search C# / .NET', 'language'),
            'popular_items' => __('Popular C# / .NET', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used C# / .NET', 'language'),
            'not_found' => __('No C# / .NET found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('c-net', 'language');
    register_taxonomy('ios', ['language'], [
        'label' => __('iOS', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'ios'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('iOS', 'language'),
            'all_items' => __('All iOS', 'language'),
            'edit_item' => __('Edit iOS', 'language'),
            'view_item' => __('View iOS', 'language'),
            'update_item' => __('Update iOS', 'language'),
            'add_new_item' => __('Add New iOS', 'language'),
            'new_item_name' => __('New iOS Name', 'language'),
            'search_items' => __('Search iOS', 'language'),
            'popular_items' => __('Popular iOS', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used iOS', 'language'),
            'not_found' => __('No iOS found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('clojure', 'language');
    register_taxonomy('clojure', ['language'], [
        'label' => __('Clojure', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'clojure'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Clojure', 'language'),
            'all_items' => __('All Clojure', 'language'),
            'edit_item' => __('Edit Clojure', 'language'),
            'view_item' => __('View Clojure', 'language'),
            'update_item' => __('Update Clojure', 'language'),
            'add_new_item' => __('Add New Clojure', 'language'),
            'new_item_name' => __('New Clojure Name', 'language'),
            'search_items' => __('Search Clojure', 'language'),
            'popular_items' => __('Popular Clojure', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Clojure', 'language'),
            'not_found' => __('No Clojure found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('clojure', 'language');
    register_taxonomy('flutter', ['language'], [
        'label' => __('Flutter', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'flutter'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Flutter', 'language'),
            'all_items' => __('All Flutter', 'language'),
            'edit_item' => __('Edit Flutter', 'language'),
            'view_item' => __('View Flutter', 'language'),
            'update_item' => __('Update Flutter', 'language'),
            'add_new_item' => __('Add New Flutter', 'language'),
            'new_item_name' => __('New Flutter Name', 'language'),
            'search_items' => __('Search Flutter', 'language'),
            'popular_items' => __('Popular Flutter', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Flutter', 'language'),
            'not_found' => __('No Flutter found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('flutter', 'language');
    register_taxonomy('golang', ['language'], [
        'label' => __('Golang', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'golang'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Golang', 'language'),
            'all_items' => __('All Golang', 'language'),
            'edit_item' => __('Edit Golang', 'language'),
            'view_item' => __('View Golang', 'language'),
            'update_item' => __('Update Golang', 'language'),
            'add_new_item' => __('Add New Golang', 'language'),
            'new_item_name' => __('New Golang Name', 'language'),
            'search_items' => __('Search Golang', 'language'),
            'popular_items' => __('Popular Golang', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Golang', 'language'),
            'not_found' => __('No Golang found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('golang', 'language');
    register_taxonomy('magento', ['language'], [
        'label' => __('Magento', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'magento'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Magento', 'language'),
            'all_items' => __('All Magento', 'language'),
            'edit_item' => __('Edit Magento', 'language'),
            'view_item' => __('View Magento', 'language'),
            'update_item' => __('Update Magento', 'language'),
            'add_new_item' => __('Add New Magento', 'language'),
            'new_item_name' => __('New Magento Name', 'language'),
            'search_items' => __('Search Magento', 'language'),
            'popular_items' => __('Popular Magento', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Magento', 'language'),
            'not_found' => __('No Magento found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('magento', 'language');
    register_taxonomy('node-js', ['language'], [
        'label' => __('Node.js', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'node-js'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Node.js', 'language'),
            'all_items' => __('All Node.js', 'language'),
            'edit_item' => __('Edit Node.js', 'language'),
            'view_item' => __('View Node.js', 'language'),
            'update_item' => __('Update Node.js', 'language'),
            'add_new_item' => __('Add New Node.js', 'language'),
            'new_item_name' => __('New Node.js Name', 'language'),
            'search_items' => __('Search Node.js', 'language'),
            'popular_items' => __('Popular Node.js', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Node.js', 'language'),
            'not_found' => __('No Node.js found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('node-js', 'language');
    register_taxonomy('python', ['language'], [
        'label' => __('Python', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'python'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Python', 'language'),
            'all_items' => __('All Python', 'language'),
            'edit_item' => __('Edit Python', 'language'),
            'view_item' => __('View Python', 'language'),
            'update_item' => __('Update Python', 'language'),
            'add_new_item' => __('Add New Python', 'language'),
            'new_item_name' => __('New Python Name', 'language'),
            'search_items' => __('Search Python', 'language'),
            'popular_items' => __('Popular Python', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Python', 'language'),
            'not_found' => __('No Python found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('python', 'language');
    register_taxonomy('ruby', ['language'], [
        'label' => __('Ruby', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'ruby'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Ruby', 'language'),
            'all_items' => __('All Ruby', 'language'),
            'edit_item' => __('Edit Ruby', 'language'),
            'view_item' => __('View Ruby', 'language'),
            'update_item' => __('Update Ruby', 'language'),
            'add_new_item' => __('Add New Ruby', 'language'),
            'new_item_name' => __('New Ruby Name', 'language'),
            'search_items' => __('Search Ruby', 'language'),
            'popular_items' => __('Popular Ruby', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Ruby', 'language'),
            'not_found' => __('No Ruby found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('ruby', 'language');
    register_taxonomy('rust', ['language'], [
        'label' => __('Rust', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'rust'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Rust', 'language'),
            'all_items' => __('All Rust', 'language'),
            'edit_item' => __('Edit Rust', 'language'),
            'view_item' => __('View Rust', 'language'),
            'update_item' => __('Update Rust', 'language'),
            'add_new_item' => __('Add New Rust', 'language'),
            'new_item_name' => __('New Rust Name', 'language'),
            'search_items' => __('Search Rust', 'language'),
            'popular_items' => __('Popular Rust', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Rust', 'language'),
            'not_found' => __('No Rust found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('rust', 'language');
    register_taxonomy('salesforce', ['language'], [
        'label' => __('Salesforce', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'salesforce'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Salesforce', 'language'),
            'all_items' => __('All Salesforce', 'language'),
            'edit_item' => __('Edit Salesforce', 'language'),
            'view_item' => __('View Salesforce', 'language'),
            'update_item' => __('Update Salesforce', 'language'),
            'add_new_item' => __('Add New Salesforce', 'language'),
            'new_item_name' => __('New Salesforce Name', 'language'),
            'search_items' => __('Search Salesforce', 'language'),
            'popular_items' => __('Popular Salesforce', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Salesforce', 'language'),
            'not_found' => __('No Salesforce found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('salesforce', 'language');
    register_taxonomy('scala', ['language'], [
        'label' => __('Scala', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'scala'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Scala', 'language'),
            'all_items' => __('All Scala', 'language'),
            'edit_item' => __('Edit Scala', 'language'),
            'view_item' => __('View Scala', 'language'),
            'update_item' => __('Update Scala', 'language'),
            'add_new_item' => __('Add New Scala', 'language'),
            'new_item_name' => __('New Scala Name', 'language'),
            'search_items' => __('Search Scala', 'language'),
            'popular_items' => __('Popular Scala', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Scala', 'language'),
            'not_found' => __('No Scala found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('scala', 'language');
    register_taxonomy('shopify', ['language'], [
        'label' => __('Shopify', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'shopify'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('Shopify', 'language'),
            'all_items' => __('All Shopify', 'language'),
            'edit_item' => __('Edit Shopify', 'language'),
            'view_item' => __('View Shopify', 'language'),
            'update_item' => __('Update Shopify', 'language'),
            'add_new_item' => __('Add New Shopify', 'language'),
            'new_item_name' => __('New Shopify Name', 'language'),
            'search_items' => __('Search Shopify', 'language'),
            'popular_items' => __('Popular Shopify', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used Shopify', 'language'),
            'not_found' => __('No Shopify found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('shopify', 'language');
    register_taxonomy('wordpress', ['language'], [
        'label' => __('WordPress', 'language'),
        'hierarchical' => false,
        'rewrite' => ['slug' => 'wordpress'],
        'show_admin_column' => true,
        'labels' => [
            'singular_name' => __('WordPress', 'language'),
            'all_items' => __('All WordPress', 'language'),
            'edit_item' => __('Edit WordPress', 'language'),
            'view_item' => __('View WordPress', 'language'),
            'update_item' => __('Update WordPress', 'language'),
            'add_new_item' => __('Add New WordPress', 'language'),
            'new_item_name' => __('New WordPress Name', 'language'),
            'search_items' => __('Search WordPress', 'language'),
            'popular_items' => __('Popular WordPress', 'language'),
            'separate_items_with_commas' => __('Separate with comma', 'language'),
            'choose_from_most_used' => __('Choose from most used WordPress', 'language'),
            'not_found' => __('No WordPress found', 'language'),
        ]
    ]);
    register_taxonomy_for_object_type('wordpress', 'language');
}
function additional_language_type() {
    register_post_type('additional-lang', array(
        'supports' => array('title', 'editor'),
        'public' => true,
        'labels' => array(
            'name' => 'Ще технічні',
            'add_new_item' => 'Дадати ще технічні',
            'edit_item' => 'Редагувати ще технічні',
            'all_items' => 'Усі ще технічні',
            'singular_name' => 'additional-lang'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-html'
    ));
}
function technology_type() {
    register_post_type('tech-lang', array(
        'supports' => array('title','custom-fields','page-attributes'),
        'public' => true,
        'labels' => array(
            'name' => 'Технології',
            'add_new_item' => 'Дадати ще Технології',
            'edit_item' => 'Редагувати ще Технології',
            'all_items' => 'Усі ще Технології',
            'singular_name' => 'tech-lang'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-html'
    ));
}
function non_technical_type() {
    register_post_type('nontech', array(
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'Нетехнічні',
            'add_new_item' => 'Добавити Нетехнічні',
            'edit_item' => 'Редактировати Нетехнічні',
            'all_items' => 'Усі Нетехнічні',
            'singular_name' => 'Нетехнічні'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-money-alt'
    ));
}
function language_order($query) {
    if($query->is_admin) {

        if ($query->get('post_type') == 'language' || $query->get('post_type') == 'cities')
        {
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
        if ($query->get('post_type') == 'work_format')
        {
//            'orderby' => 'date',
//        'order' => 'DESC',
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
        }
    }
    return $query;
}
add_filter('pre_get_posts', 'language_order');
function specialty_type() {
    register_post_type('specialty', array(
        'public' => true,
        'labels' => array(
            'name' => 'Фреймв., CMS',
            'add_new_item' => 'Добавити Фреймворки и CMS',
            'edit_item' => 'Редагувати Фреймворки и CMS',
            'all_items' => 'Усі Фреймворки и CMS',
            'singular_name' => 'specialty'
        ),
        'menu_icon' => 'dashicons-superhero'
    ));
}
function specialty_order($query) {
    if($query->is_admin) {

        if ($query->get('post_type') == 'specialty')
        {
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
    }
    return $query;
}
add_filter('pre_get_posts', 'specialty_order');
function vac_type() {
    register_post_type('vacancy', array(
        'supports' => [ 'title', 'editor' ],
        'capability_type' => 'vacancy',
        'map_meta_cap' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Вакансії',
            'add_new_item' => 'Добавити вакансію',
            'edit_item' => 'Редагувати вакансію',
            'all_items' => 'Усі вакансії',
            'singular_name' => 'vacancy'
        ),
//        'menu_icon' => 'dashicons-businessperson'
        'menu_icon' => 'dashicons-admin-multisite'
    ));
}
function candidate_type() {
    register_post_type('candidate', array(
        'capability_type' => 'candidate',
        'map_meta_cap' => true,
//        'show_ui' => true,
        'supports' => [ 'title', 'editor', 'revisions' ],
        'public' => true,
        'labels' => array(
            'name' => 'База кандидатів',
            'add_new_item' => 'Добавити кандидата',
            'edit_item' => 'Редагувати кандидата',
            'all_items' => 'Усі кандидати',
            'singular_name' => 'candidate'
        ),
        'menu_icon' => 'dashicons-businessperson',
        'show_in_rest' => true
    ));
}
function rekomend_type() {
    register_post_type('rekomend', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'capability_type' => 'rekomend',
        'map_meta_cap' => true,
        'public' => true,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Pipeline',
            'add_new_item' => 'Добавити рекомендацію',
            'edit_item' => 'Редагувати рекомендацію',
            'all_items' => 'Усі рекомендації',
            'singular_name' => 'rekomend'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog'
    ));
}
function client_type() {
    register_post_type('client', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'capability_type' => 'client',
        'map_meta_cap' => true,
        'public' => true,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Клієнти',
            'add_new_item' => 'Добавити клієнта',
            'edit_item' => 'Редагувати клієнта',
            'all_items' => 'Усі клієнти',
            'singular_name' => 'client'
        ),
        'menu_icon' => 'dashicons-businessperson'
    ));
}
//function clvac_type() {
//    register_post_type('clvacancy', array(
//        'supports' => array('title'),
//        'map_meta_cap' => true,
//        'show_in_rest' => true,
//        'public' => true,
//        'capability_type' => 'clvacancy',
//        'labels' => array(
//            'name' => 'Вакансії',
//            'add_new_item' => 'Додати Вакансії.',
//            'edit_item' => 'Редагувати Вакансії.',
//            'all_items' => 'Усі Вакансії.',
//            'singular_name' => 'clvacancy'
//        ),
//        'menu_icon' => 'dashicons-html'
//    ));
//}
function sotrudniki_type() {
    register_post_type('sotrudniki', array(
        'capability_type' => 'sotrudniki',
        'map_meta_cap' => true,
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'Співпрацівники',
            'add_new_item' => 'Добавити Співпрацівника',
            'edit_item' => 'Редагувати Співпрацівника',
            'all_items' => 'Усі Співпрацівника',
            'singular_name' => 'sotrudnik'
        ),
        'menu_icon' => 'dashicons-car'
    ));
}
function sotrud_general_type() {
    register_post_type('sotrgeneral', array(
//        'capability_type' => 'freelancer',
//        'map_meta_cap' => true,
//        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Співпрацівники загальна',
            'add_new_item' => 'Добавити Співпрацівника загальну',
            'edit_item' => 'Редактировати Співпрацівника загальну',
            'all_items' => 'Співпрацівника загальна',
            'singular_name' => 'Співпрацівника загальна'
        ),
        'menu_icon' => 'dashicons-media-document'
    ));
}
function work_format_type() {
    register_post_type('work_format', array(
        'public' => true,
        'supports' => array('title'),
        'labels' => array(
            'name' => 'Формат роботи',
            'add_new_item' => 'Добавити Формат роботи',
            'edit_item' => 'Редагувати Формат роботи',
            'all_items' => 'Усі Формат роботи',
            'singular_name' => 'work_format'
        ),
        'menu_icon' => 'dashicons-admin-home'
    ));
}
function cities_type() {
    register_post_type('cities', array(
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'Міста',
            'add_new_item' => 'Добавити місто',
            'edit_item' => 'Редагувати місто',
            'all_items' => 'Усі міста',
            'singular_name' => 'cities'
        ),
        'menu_icon' => 'dashicons-admin-site-alt3'
    ));
}
function likes_type() {
    register_post_type('likes', array(
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'Голосовання',
            'add_new_item' => 'Проголосувати',
            'edit_item' => 'Редагувати',
            'all_items' => 'All likes',
            'singular_name' => 'Голосування'
        ),
        'menu_icon' => 'dashicons-heart'
    ));
}
function vstar_type() {
    register_post_type('vstar', array(
        'supports' => array('title'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Мої Вакансії',
            'add_new_item' => 'Добавити Мої Вакансії',
            'edit_item' => 'Редавати Мої Вакансії',
            'all_items' => 'Мої Вакансії',
            'singular_name' => 'МоїВакансиї'
        ),
        'menu_icon' => 'dashicons-star-filled'
    ));
}
function rstar_type() {
    register_post_type('rstar', array(
        'supports' => array('title'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Мої Реком-ї',
            'add_new_item' => 'Добавити Рекомендацію',
            'edit_item' => 'Редагувати Рекомендацію',
            'all_items' => 'Мої Рекомендації',
            'singular_name' => 'МоїРекомендації'
        ),
        'menu_icon' => 'dashicons-star-filled'
    ));
}
function freelcr_type() {
    register_post_type('freelcr', array(
        'capability_type' => 'freelancer',
        'map_meta_cap' => true,
       'supports' => array('title', 'editor', 'thumbnail'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Фрілансери',
            'add_new_item' => 'Добавити Фрілансера',
            'edit_item' => 'Редагувати Фрілансера',
            'all_items' => 'Фрілансери',
            'singular_name' => 'Фрілансери'
        ),
        'menu_icon' => 'dashicons-id-alt'
    ));
}
function notif_type() {
    register_post_type('notification', array(
//        'capability_type' => 'freelancer',
//        'map_meta_cap' => true,
//        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Повідомлення',
            'add_new_item' => 'Добавити Повідомлення',
            'edit_item' => 'Редагувати Повідомлення',
            'all_items' => 'Повідомлення',
            'singular_name' => 'Повідомлення'
        ),
        'menu_icon' => 'dashicons-fullscreen-alt'
    ));
}
function notif_ajax_type() {
    register_post_type('notiajax', array(
        'show_in_rest' => true,
       'supports' => array('title'),
        'public' => false,
         'show_ui' => true,
        'labels' => array(
            'name' => 'Повідомл kanban',
            'add_new_item' => 'Добавити ajax Повідомлення',
            'edit_item' => 'Редагувати ajax Повідомлення',
            'all_items' => 'Повідомлення ajax',
            'singular_name' => 'Повідомлення kanban'
        ),
        'menu_icon' => 'dashicons-admin-tools'
    ));
}
function notif_hot_type() {
    register_post_type('notiHot', array(
        'show_in_rest' => true,
       'supports' => array('title'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Повідомл hot',
            'add_new_item' => 'Добавити hot Повідомлення',
            'edit_item' => 'Редагувати hot Повідомлення',
            'all_items' => 'Повідомлення hot',
            'singular_name' => 'Повідомлення hot'
        ),
        'menu_icon' => 'dashicons-admin-tools'
    ));
}
function rekruter_type() {
    register_post_type('rekruter', array(
//        'capability_type' => 'freelancer',
//        'map_meta_cap' => true,
//        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => false,
        'show_ui' => true,
       // 'show_in_rest' => true,
        'labels' => array(
            'name' => 'Рекрутери',
            'add_new_item' => 'Добавити Рекрутера',
            'edit_item' => 'Редагувати Рекрутера',
            'all_items' => 'Рекрутери',
            'singular_name' => 'Рекрутери'
        ),
        'menu_icon' => 'dashicons-airplane'
    ));
}
function calendar_type() {
    register_post_type('gc', array(
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'Календар',
            'add_new_item' => 'Добавити Таск',
            'edit_item' => 'Редагувати Таск',
            'all_items' => 'Усі Таски',
            'singular_name' => 'Календар'
        ),
        'menu_icon' => 'dashicons-admin-tools'
    ));
}
function faq_type(){
    register_post_type('faq', array(
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'FAQ',
            'add_new_item' => 'Добавити FAQ',
            'edit_item' => 'Редагувати FAQ',
            'all_items' => 'Усі FAQ',
            'singular_name' => 'FAQ'
        ),
        'menu_icon' => 'dashicons-admin-tools'
    ));
}
function history_type() {
    register_post_type('history', array(
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'Співбесіди',
            'add_new_item' => 'Добавити співбесіду',
            'edit_item' => 'Редагувати співбесіду',
            'all_items' => 'Усі співбесіди',
            'singular_name' => 'співбесіди'
        ),
        'menu_icon' => 'dashicons-format-chat'
    ));
}
function id_events_type() {
    register_post_type('id_events', array(
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'IDs Events',
            'add_new_item' => 'Добавити ID Event',
            'edit_item' => 'Редагувати ID Event',
            'all_items' => 'ID Event',
            'singular_name' => 'IDs Кандидатів'
        ),
        'menu_icon' => 'dashicons-database-add'
    ));
}
function countries_type() {
    register_post_type('countries', array(
        'supports' => array('title'),
        'show_in_rest' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Країни',
            'add_new_item' => 'Добавити країну',
            'edit_item' => 'Редагувати країну',
            'all_items' => 'Усі країни',
            'singular_name' => 'countries'
        ),
        'menu_icon' => 'dashicons-admin-site-alt3'
    ));
}

function cust_post_types() {
    vac_type();
    admin_menu();
    language_type();
    additional_language_type();
    technology_type();
    specialty_type();
    non_technical_type();
    work_format_type();
    cities_type();
    candidate_type();
    rekomend_type();
    client_type();
    mova_type();
    noitposts_type();
    contacts_type();
    tags_type();
//    clvac_type();
//    likes_type();
    vstar_type();
    rstar_type();
    notif_type();
    notif_ajax_type();
    notif_hot_type();
    freelcr_type();
//    rekruter_type();
    sotrudniki_type();
    sotrud_general_type();
    faq_type();
    history_type();
    id_events_type();
   // send_cand_type();
    calendar_type();
    countries_type();
}
add_action('init', 'cust_post_types');




