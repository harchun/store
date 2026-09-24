<?php get_header(); ?>
<main id="primary" class="site-main container section">
<?php while(have_posts()):the_post(); ?>
<article <?php post_class('store-single'); ?>>
<header class="store-single-header">
<div class="store-breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">首頁</a> / 店家介紹</div>
<h1><?php the_title(); ?></h1>
<div class="store-taxonomies"><?php $terms=get_the_terms(get_the_ID(),'store_city'); if($terms && !is_wp_error($terms)) foreach($terms as $term) echo '<span>'.esc_html($term->name).'</span>'; $types=get_the_terms(get_the_ID(),'store_type'); if($types && !is_wp_error($types)) foreach($types as $term) echo '<span>'.esc_html($term->name).'</span>'; ?></div>
</header>
<?php if(has_post_thumbnail()): ?><div class="store-cover"><?php the_post_thumbnail('full'); ?></div><?php endif; ?>
<div class="store-layout">
<div class="store-content">
<section class="store-info-grid">
<?php $info=array('store_address'=>'地址','store_hours'=>'營業時間','store_style'=>'店家性質','store_system'=>'消費／坐檯模式','store_price'=>'主要消費','store_room'=>'包廂／場地'); foreach($info as $key=>$label): $value=get_post_meta(get_the_ID(),$key,true); if($value): ?><div class="info-item"><span><?php echo esc_html($label); ?></span><strong><?php echo nl2br(esc_html($value)); ?></strong></div><?php endif; endforeach; ?>
</section>
<?php $service=get_post_meta(get_the_ID(),'store_service',true); if($service): ?><section class="store-section"><h2>店家特色</h2><div><?php echo nl2br(esc_html($service)); ?></div></section><?php endif; ?>
<section class="store-section"><h2>店家介紹</h2><?php the_content(); ?></section>
<?php $note=get_post_meta(get_the_ID(),'store_note',true); if($note): ?><section class="store-note"><h2>消費提醒</h2><div><?php echo nl2br(esc_html($note)); ?></div></section><?php endif; ?>
</div>
<aside class="store-sidebar">
<div class="contact-card"><h2>店家資訊</h2><?php $phone=get_post_meta(get_the_ID(),'store_phone',true); $line=get_post_meta(get_the_ID(),'store_line',true); if($phone): ?><p><span>電話</span><?php echo esc_html($phone); ?></p><?php endif; if($line): ?><p><span>聯絡方式</span><?php echo esc_html($line); ?></p><?php endif; ?><a class="button" href="#store-contact">聯絡／預約</a></div>
</aside>
</div></article>
<?php endwhile; ?>
</main><?php get_footer(); ?>
