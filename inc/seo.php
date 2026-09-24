<?php
if (!defined('ABSPATH')) exit;
function store_schema(){
    if(!is_single() || get_post_type()!=='post') return;
    $data=array('@context'=>'https://schema.org','@type'=>'Article','headline'=>get_the_title(),'url'=>get_permalink(),'datePublished'=>get_the_date('c'),'dateModified'=>get_the_modified_date('c'),'author'=>array('@type'=>'Person','name'=>get_the_author()));
    if(has_post_thumbnail()) $data['image']=get_the_post_thumbnail_url(get_the_ID(),'full');
    $address=store_meta('store_address');
    if($address){
        $data['about']=array('@type'=>'LocalBusiness','name'=>get_the_title(),'address'=>$address);
        if(store_meta('store_phone')) $data['about']['telephone']=store_meta('store_phone');
        if(store_meta('store_website')) $data['about']['url']=esc_url_raw(store_meta('store_website'));
    }
    echo '<script type="application/ld+json">'.wp_json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).'</script>';
}
add_action('wp_head','store_schema',20);
