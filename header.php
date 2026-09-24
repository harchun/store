<?php if (!defined('ABSPATH')) exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <div class="container header-inner">
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
            <?php endif; ?>
        </div>
        <nav class="main-navigation" aria-label="<?php esc_attr_e('Primary menu', 'store'); ?>">
            <?php wp_nav_menu(array('theme_location'=>'primary','fallback_cb'=>false)); ?>
        </nav>
        <div class="site-actions">
            <?php if (function_exists('wc_get_cart_url')) : ?>
                <a class="button" href="<?php echo esc_url(wc_get_cart_url()); ?>"><?php esc_html_e('購物車', 'store'); ?></a>
            <?php endif; ?>
        </div>
    </div>
</header>
