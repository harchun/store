<?php
if (!defined('ABSPATH')) exit;

function store_track_view() {
    if (!is_singular('post') || is_admin() || wp_doing_ajax()) return;
    $id = get_queried_object_id();
    if (!$id) return;
    $views = (int)get_post_meta($id,'store_views',true);
    update_post_meta($id,'store_views',$views + 1);
}
add_action('template_redirect','store_track_view');

function store_featured_meta_box() {
    add_meta_box('store_featured','店家推薦','store_featured_render','post','side','default');
}
add_action('add_meta_boxes','store_featured_meta_box');

function store_featured_render($post) {
    wp_nonce_field('store_featured_save','store_featured_nonce');
    $featured = get_post_meta($post->ID,'store_featured',true);
    $homepage = get_post_meta($post->ID,'store_homepage_featured',true);
    echo '<p><label><input type="checkbox" name="store_featured" value="1" '.checked($featured,'1',false).'> 編輯推薦</label></p>';
    echo '<p><label><input type="checkbox" name="store_homepage_featured" value="1" '.checked($homepage,'1',false).'> 首頁推薦</label></p>';
}

function store_featured_save($post_id) {
    if (!isset($_POST['store_featured_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['store_featured_nonce'])),'store_featured_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id) || !current_user_can('edit_post',$post_id)) return;
    update_post_meta($post_id,'store_featured',isset($_POST['store_featured']) ? '1' : '0');
    update_post_meta($post_id,'store_homepage_featured',isset($_POST['store_homepage_featured']) ? '1' : '0');
}
add_action('save_post_post','store_featured_save');

function store_ajax_search() {
    check_ajax_referer('store_search','nonce');
    $term = isset($_POST['term']) ? sanitize_text_field(wp_unslash($_POST['term'])) : '';
    $args = array('post_type'=>'post','post_status'=>'publish','posts_per_page'=>12,'s'=>$term,'no_found_rows'=>true);
    $query = new WP_Query($args);
    $items = array();
    while ($query->have_posts()) { $query->the_post(); $items[] = array('title'=>get_the_title(),'url'=>get_permalink(),'image'=>get_the_post_thumbnail_url(get_the_ID(),'medium')); }
    wp_reset_postdata();
    wp_send_json_success($items);
}
add_action('wp_ajax_store_search','store_ajax_search');
add_action('wp_ajax_nopriv_store_search','store_ajax_search');
