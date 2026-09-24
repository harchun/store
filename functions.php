<?php
if (!defined('ABSPATH')) exit;
require_once get_template_directory().'/inc/setup.php';
require_once get_template_directory().'/inc/assets.php';
require_once get_template_directory().'/inc/taxonomies.php';
require_once get_template_directory().'/inc/metadata.php';
require_once get_template_directory().'/inc/helpers.php';
require_once get_template_directory().'/inc/seo.php';

function store_widgets_init(){ register_sidebar(array('name'=>__('側邊欄','store'),'id'=>'sidebar-1','before_widget'=>'<section class="widget">','after_widget'=>'</section>','before_title'=>'<h2>','after_title'=>'</h2>')); }
add_action('widgets_init','store_widgets_init');

function store_excerpt_length($length){ return 28; }
add_filter('excerpt_length','store_excerpt_length');

function store_customize_register($wp_customize){
    $wp_customize->add_section('store_home',array('title'=>'首頁設定','priority'=>30));
    $wp_customize->add_setting('store_hero_title',array('default'=>'探索店家資訊與消費方式','sanitize_callback'=>'sanitize_text_field'));
    $wp_customize->add_control('store_hero_title',array('label'=>'首頁標題','section'=>'store_home','type'=>'text'));
    $wp_customize->add_setting('store_hero_text',array('default'=>'每一篇文章就是一家店，完整呈現店家介紹、消費方式與實際資訊。','sanitize_callback'=>'sanitize_textarea_field'));
    $wp_customize->add_control('store_hero_text',array('label'=>'首頁說明','section'=>'store_home','type'=>'textarea'));
}
add_action('customize_register','store_customize_register');
