<?php get_header(); ?>
<main id="primary" class="site-main">
    <section class="hero">
        <div class="container">
            <h1><?php echo esc_html(get_theme_mod('store_hero_title', '探索你的下一件好物')); ?></h1>
            <p><?php echo esc_html(get_theme_mod('store_hero_text', '以簡潔、快速、行動裝置優先的方式呈現你的商品與品牌。')); ?></p>
            <?php if (function_exists('wc_get_page_permalink')) : ?>
                <a class="button" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('立即逛商城', 'store'); ?></a>
            <?php endif; ?>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('最新商品', 'store'); ?></h2>
            <?php if (function_exists('do_shortcode')) echo do_shortcode('[products limit="8" columns="4" orderby="date" order="DESC"]'); ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
