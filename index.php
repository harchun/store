<?php get_header(); ?>
<main id="primary" class="site-main container section">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            <?php the_post_thumbnail('large'); ?>
            <div><?php the_content(); ?></div>
        </article>
    <?php endwhile; else : ?>
        <p><?php esc_html_e('目前沒有內容。', 'store'); ?></p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
