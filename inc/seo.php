<?php
if (!defined('ABSPATH')) exit;

function store_schema(){
    if (!is_singular('post')) return;

    $data = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => wp_strip_all_tags(get_the_title()),
        'url' => get_permalink(),
        'datePublished' => get_the_date('c'),
        'dateModified' => get_the_modified_date('c'),
        'author' => array('@type'=>'Person','name'=>get_the_author())
    );

    if (has_post_thumbnail()) {
        $data['image'] = get_the_post_thumbnail_url(get_the_ID(), 'full');
    }

    $address = store_meta('store_address');
    if ($address) {
        $data['about'] = array(
            '@type' => 'LocalBusiness',
            'name' => wp_strip_all_tags(get_the_title()),
            'address' => array('@type'=>'PostalAddress','streetAddress'=>$address)
        );
        $phone = store_meta('store_phone');
        $website = store_meta('store_website');
        if ($phone) $data['about']['telephone'] = $phone;
        if ($website && filter_var($website, FILTER_VALIDATE_URL)) $data['about']['url'] = esc_url_raw($website);
    }

    echo '<script type="application/ld+json">'.wp_json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES).'</script>';
}
add_action('wp_head','store_schema',20);
