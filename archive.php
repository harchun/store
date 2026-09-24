<?php get_header(); ?>
<main class="site-main container section">
<header class="archive-header"><span class="eyebrow">STORE DIRECTORY</span><h1><?php the_archive_title(); ?></h1><?php the_archive_description('<div class="archive-description">','</div>'); ?></header>
<?php if(have_posts()): ?><div class="store-grid"><?php while(have_posts()):the_post(); get_template_part('template-parts/store-card'); endwhile; ?></div><?php the_posts_pagination(array('mid_size'=>1,'prev_text'=>'←','next_text'=>'→')); ?><?php else: ?><p>目前沒有符合條件的店家。</p><?php endif; ?>
</main><?php get_footer(); ?>
