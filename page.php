<?php get_header(); ?>
<main id="primary" class="site-main container section">
<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
    </article>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
