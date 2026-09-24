<?php
if (!defined('ABSPATH')) exit;
function store_get_tax_names($taxonomy,$post_id=null){ $terms=get_the_terms($post_id ?: get_the_ID(),$taxonomy); if(is_wp_error($terms)||empty($terms)) return array(); return wp_list_pluck($terms,'name'); }
function store_get_primary_tax($taxonomy,$post_id=null){ $names=store_get_tax_names($taxonomy,$post_id); return $names[0] ?? ''; }
function store_primary_meta($post_id=null){ $city=store_get_primary_tax('store_city',$post_id); $type=store_get_primary_tax('store_type',$post_id); return trim($city.($city&&$type?' · ':'').$type); }
function store_has_store_data($post_id=null){ $id=$post_id ?: get_the_ID(); foreach(array('store_address','store_hours','store_phone','store_line','store_website','store_price','store_style') as $key){ if(get_post_meta($id,$key,true)) return true; } return false; }
function store_reading_time($post_id=null){ $content=wp_strip_all_tags(get_post_field('post_content',$post_id ?: get_the_ID())); $words=preg_match_all('/\S+/u',$content,$m); return max(1,(int)ceil($words/350)); }
