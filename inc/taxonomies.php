<?php
if (!defined('ABSPATH')) exit;
function store_register_taxonomies() {
    register_taxonomy('store_city','post',array(
        'labels'=>array('name'=>'城市','singular_name'=>'城市','menu_name'=>'城市'),
        'public'=>true,'hierarchical'=>true,'show_admin_column'=>true,
        'rewrite'=>array('slug'=>'city','with_front'=>false),
        'show_in_rest'=>true,
    ));
    register_taxonomy('store_type','post',array(
        'labels'=>array('name'=>'店家類型','singular_name'=>'店家類型','menu_name'=>'店家類型'),
        'public'=>true,'hierarchical'=>true,'show_admin_column'=>true,
        'rewrite'=>array('slug'=>'store-type','with_front'=>false),
        'show_in_rest'=>true,
    ));
}
add_action('init','store_register_taxonomies');
