<?php get_header(); ?>
<main class="site-main container section">
<header class="archive-header"><span class="eyebrow">SEARCH</span><h1>搜尋店家</h1><form class="store-search store-search-inline" method="get" action="<?php echo esc_url(home_url('/')); ?>"><input name="s" type="search" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="搜尋店家名稱、城市或關鍵字"><button type="submit">搜尋</button></form></header>
<?php if(have_posts()): ?><div class="store-grid"><?php while(have_posts()):the_post(); get_template_part('template-parts/store-card'); endwhile; ?></div><?php the_posts_pagination(array('mid_size'=>1,'prev_text'=>'←','next_text'=>'→')); ?><?php else: ?><p>找不到符合「<?php echo esc_html(get_search_query()); ?>」的店家。</p><?php endif; ?>
</main><?php get_footer(); ?>
