<?php if (!defined('ABSPATH')) exit; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#0f172a">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if (function_exists('wp_body_open')) wp_body_open(); ?>
<header class="site-header">
<div class="container header-inner">
<div class="site-branding">
<?php if (function_exists('has_custom_logo') && has_custom_logo()): the_custom_logo(); else: ?>
<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
<?php endif; ?>
</div>
<button class="menu-toggle" type="button" data-menu-toggle aria-label="開啟選單" aria-expanded="false">☰</button>
<nav class="main-navigation" data-mobile-nav aria-label="主選單">
<?php wp_nav_menu(array('theme_location'=>'primary','fallback_cb'=>false)); ?>
</nav>
<div class="header-search">
<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
<input name="s" type="search" placeholder="搜尋店家" aria-label="搜尋店家">
</form>
</div>
</div>
</header>
