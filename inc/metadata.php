<?php
if (!defined('ABSPATH')) exit;

function store_meta_box() {
    add_meta_box('store_details','店家資訊','store_meta_box_render','post','normal','high');
}
add_action('add_meta_boxes','store_meta_box');

function store_meta_box_render($post) {
    wp_nonce_field('store_meta_save','store_meta_nonce');
    $fields = array(
        'store_address'=>'地址','store_hours'=>'營業時間','store_phone'=>'電話','store_line'=>'LINE / 聯絡方式',
        'store_website'=>'官方網站','store_price'=>'消費區間','store_style'=>'店家性質','store_map'=>'Google Maps 網址'
    );
    echo '<div class="store-admin-grid">';
    foreach ($fields as $key=>$label) {
        $value = get_post_meta($post->ID,$key,true);
        $type = in_array($key,array('store_website','store_map'),true) ? 'url' : 'text';
        echo '<p><label><strong>'.esc_html($label).'</strong><br><input style="width:100%" type="'.esc_attr($type).'" name="'.esc_attr($key).'" value="'.esc_attr($value).'" /></label></p>';
    }
    echo '</div>';
}

function store_meta_save($post_id) {
    if (!isset($_POST['store_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['store_meta_nonce'])),'store_meta_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id) || !current_user_can('edit_post',$post_id)) return;

    $text_fields = array('store_address','store_hours','store_phone','store_line','store_price','store_style');
    $url_fields = array('store_website','store_map');
    foreach ($text_fields as $key) {
        $value = isset($_POST[$key]) ? sanitize_text_field(wp_unslash($_POST[$key])) : '';
        if ($value === '') delete_post_meta($post_id,$key); else update_post_meta($post_id,$key,$value);
    }
    foreach ($url_fields as $key) {
        $value = isset($_POST[$key]) ? esc_url_raw(wp_unslash($_POST[$key])) : '';
        if ($value === '') delete_post_meta($post_id,$key); else update_post_meta($post_id,$key,$value);
    }
}
add_action('save_post_post','store_meta_save');

function store_meta($key,$post_id=null) {
    return get_post_meta($post_id ?: get_the_ID(),$key,true);
}
