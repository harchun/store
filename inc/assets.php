<?php
if (!defined('ABSPATH')) exit;
function store_enqueue_assets() {
    $v = wp_get_theme()->get('Version');
    wp_enqueue_style('store-style', get_stylesheet_uri(), array(), $v);
    wp_enqueue_script('store-theme', get_template_directory_uri().'/assets/js/store.js', array(), $v, true);
}
add_action('wp_enqueue_scripts','store_enqueue_assets');
