<?php get_header(); ?>
<main id="primary" class="site-main container section">
<?php while(have_posts()): the_post(); ?>
<article <?php post_class('store-single'); ?>>
<header class="store-single-header">
<div class="store-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">首頁</a> / <?php echo esc_html(store_primary_meta()); ?></div>
<h1><?php the_title(); ?></h1>
<div class="store-taxonomies"><?php foreach(array_merge(store_get_tax_names('store_city'),store_get_tax_names('store_type')) as $term): ?><span><?php echo esc_html($term); ?></span><?php endforeach; ?></div>
</header>
<?php if(has_post_thumbnail()): ?><div class="store-cover"><?php the_post_thumbnail('full',array('fetchpriority'=>'high')); ?></div><?php endif; ?>
<div class="store-layout">
<div class="store-content">
<?php $info=array('store_address'=>'地址','store_hours'=>'營業時間','store_style'=>'店家性質','store_price'=>'消費區間','store_phone'=>'電話','store_line'=>'聯絡方式'); $has=false; foreach($info as $key=>$label){ if(store_meta($key)){ $has=true; break; }} if($has): ?><section class="store-info-grid"><?php foreach($info as $key=>$label): $value=store_meta($key); if($value): ?><div class="info-item"><span><?php echo esc_html($label); ?></span><strong><?php echo nl2br(esc_html($value)); ?></strong></div><?php endif; endforeach; ?></section><?php endif; ?>
<section class="store-section store-article"><h2>店家介紹</h2><?php the_content(); ?></section>
</div>
<aside class="store-sidebar">
<div class="contact-card"><h2>店家資訊</h2><?php if(store_meta('store_address')): ?><p><span>地址</span><?php echo esc_html(store_meta('store_address')); ?></p><?php endif; ?><?php if(store_meta('store_phone')): ?><p><span>電話</span><?php echo esc_html(store_meta('store_phone')); ?></p><?php endif; ?><?php if(store_meta('store_website')): ?><a class="button" href="<?php echo esc_url(store_meta('store_website')); ?>" target="_blank" rel="noopener">官方網站</a><?php endif; ?><?php if(store_meta('store_map')): ?><a class="button button-outline" href="<?php echo esc_url(store_meta('store_map')); ?>" target="_blank" rel="noopener">查看地圖</a><?php endif; ?></div>
</aside>
</div>
</article>
<?php endwhile; ?>
</main><?php get_footer(); ?>
