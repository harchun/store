<article <?php post_class('store-card'); ?>>
<a class="store-card-image" href="<?php the_permalink(); ?>">
<?php if(has_post_thumbnail()): the_post_thumbnail('medium_large',array('loading'=>'lazy')); else: ?><span class="store-placeholder">STORE</span><?php endif; ?>
</a>
<div class="store-card-body">
<div class="store-meta"><?php echo esc_html(store_primary_meta()); ?></div>
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<p><?php echo esc_html(wp_trim_words(get_the_excerpt(),24)); ?></p>
<?php if(store_meta('store_price')): ?><div class="card-price">消費：<?php echo esc_html(store_meta('store_price')); ?></div><?php endif; ?>
</div>
</article>
