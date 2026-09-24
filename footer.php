<?php if (!defined('ABSPATH')) exit; ?>
<footer class="site-footer">
    <div class="container">
        <div class="widget-area">
            <?php if (is_active_sidebar('sidebar-1')) dynamic_sidebar('sidebar-1'); ?>
        </div>
        <p>&copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>.</p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
