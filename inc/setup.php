<?php
if (!defined('ABSPATH')) exit;

function store_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('custom-background');
    add_theme_support('custom-header');
    add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
    add_theme_support('custom-logo', array('height'=>80,'width'=>240,'flex-height'=>true,'flex-width'=>true));
    register_nav_menus(array('primary'=>__('主選單','store'),'footer'=>__('頁尾選單','store')));
}
add_action('after_setup_theme','store_theme_setup');
