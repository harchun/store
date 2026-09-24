<article class="store-card">
<a class="store-card-image" href="<?php the_permalink(); ?>">
<?php if(has_post_thumbnail()) the_post_thumbnail('medium_large'); else echo '<div class="store-placeholder">STORE</div>'; ?>
</a>
<div class="store-card-body">
<div class="store-meta"><?php $terms=get_the_terms(get_the_ID(),'store_city'); if($terms && !is_wp_error($terms)) echo esc_html($terms[0]->name); ?> <?php $types=get_the_terms(get_the_ID(),'store_type'); if($types && !is_wp_error($types)) echo ' · '.esc_html($types[0]->name); ?></div>
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<p><?php echo esc_html(get_post_meta(get_the_ID(),'store_style',true)); ?></p>
<?php $price=get_post_meta(get_the_ID(),'store_price',true); if($price): ?><div class="card-price"><?php echo esc_html($price); ?></div><?php endif; ?>
</div></article>
