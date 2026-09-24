<?php
if (!defined('ABSPATH')) exit;

function store_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
    add_theme_support('custom-logo', array('height'=>80,'width'=>240,'flex-height'=>true,'flex-width'=>true));

    register_nav_menus(array(
        'primary' => __('主選單', 'store'),
        'footer'  => __('頁尾選單', 'store'),
    ));
}
add_action('after_setup_theme', 'store_setup');

function store_assets() {
    wp_enqueue_style('store-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'store_assets');

function store_widgets() {
    register_sidebar(array(
        'name'=>__('側邊欄','store'),'id'=>'sidebar-1','before_widget'=>'<section class="widget">','after_widget'=>'</section>','before_title'=>'<h2>','after_title'=>'</h2>'
    ));
}
add_action('widgets_init', 'store_widgets');

function store_taxonomies() {
    register_taxonomy('store_city', 'post', array(
        'labels'=>array('name'=>'城市','singular_name'=>'城市'),
        'public'=>true,'hierarchical'=>true,'show_admin_column'=>true,'rewrite'=>array('slug'=>'city')
    ));
    register_taxonomy('store_type', 'post', array(
        'labels'=>array('name'=>'店家類型','singular_name'=>'店家類型'),
        'public'=>true,'hierarchical'=>true,'show_admin_column'=>true,'rewrite'=>array('slug'=>'store-type')
    ));
}
add_action('init','store_taxonomies');

function store_meta_boxes() {
    add_meta_box('store_details','店家資訊','store_details_box','post','normal','high');
}
add_action('add_meta_boxes','store_meta_boxes');

function store_details_box($post) {
    wp_nonce_field('store_details_save','store_details_nonce');
    $fields=array(
        'store_address'=>'地址','store_hours'=>'營業時間','store_phone'=>'電話','store_line'=>'LINE / 聯絡方式',
        'store_style'=>'店家性質','store_system'=>'消費／坐檯模式','store_price'=>'主要消費','store_room'=>'包廂／場地',
        'store_service'=>'服務特色','store_note'=>'消費注意事項'
    );
    echo '<div class="store-admin-grid">';
    foreach($fields as $key=>$label){
        $value=get_post_meta($post->ID,$key,true);
        echo '<p><label><strong>'.esc_html($label).'</strong><br>';
        if(in_array($key,array('store_service','store_note','store_price','store_system'))){
            echo '<textarea style="width:100%;min-height:70px" name="'.esc_attr($key).'">'.esc_textarea($value).'</textarea>';
        } else {
            echo '<input style="width:100%" type="text" name="'.esc_attr($key).'" value="'.esc_attr($value).'">';
        }
        echo '</label></p>';
    }
    echo '</div>';
}

function store_save_details($post_id) {
    if(!isset($_POST['store_details_nonce']) || !wp_verify_nonce($_POST['store_details_nonce'],'store_details_save')) return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(!current_user_can('edit_post',$post_id)) return;
    $keys=array('store_address','store_hours','store_phone','store_line','store_style','store_system','store_price','store_room','store_service','store_note');
    foreach($keys as $key){
        if(isset($_POST[$key])) update_post_meta($post_id,$key,sanitize_textarea_field($_POST[$key]));
    }
}
add_action('save_post','store_save_details');

function store_excerpt_length($length){ return 28; }
add_filter('excerpt_length','store_excerpt_length');

function store_customizer($wp_customize){
    $wp_customize->add_section('store_home',array('title'=>'店鋪首頁設定','priority'=>30));
    $wp_customize->add_setting('store_hero_title',array('default'=>'找到適合你的夜生活店家','sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('store_hero_title',array('label'=>'首頁標題','section'=>'store_home','type'=>'text'));
    $wp_customize->add_setting('store_hero_text',array('default'=>'整理店家資訊、消費模式與特色，讓你在前往之前先看懂怎麼消費。','sanitize_callback'=>'sanitize_textarea_field'));
    $wp_customize->add_control('store_hero_text',array('label'=>'首頁說明','section'=>'store_home','type'=>'textarea'));
}
add_action('customize_register','store_customizer');
