<?php
if (!defined('ABSPATH')) exit;

function store_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
    add_theme_support('custom-logo', array(
        'height' => 80,
        'width' => 240,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'store'),
        'footer'  => __('Footer Menu', 'store'),
    ));
}
add_action('after_setup_theme', 'store_setup');

function store_enqueue_assets() {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('store-style', get_stylesheet_uri(), array(), $version);
}
add_action('wp_enqueue_scripts', 'store_enqueue_assets');

function store_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'store'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar.', 'store'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'store_widgets_init');

function store_woocommerce_wrapper_start() {
    echo '<main id="primary" class="site-main container">';
}
function store_woocommerce_wrapper_end() {
    echo '</main>';
}
add_action('woocommerce_before_main_content', 'store_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'store_woocommerce_wrapper_end', 10);

function store_customize_register($wp_customize) {
    $wp_customize->add_section('store_home', array(
        'title' => __('Store Homepage', 'store'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('store_hero_title', array(
        'default' => __('探索你的下一件好物', 'store'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('store_hero_title', array(
        'label' => __('Hero Title', 'store'),
        'section' => 'store_home',
        'type' => 'text',
    ));
    $wp_customize->add_setting('store_hero_text', array(
        'default' => __('以簡潔、快速、行動裝置優先的方式呈現你的商品與品牌。', 'store'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('store_hero_text', array(
        'label' => __('Hero Text', 'store'),
        'section' => 'store_home',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'store_customize_register');
