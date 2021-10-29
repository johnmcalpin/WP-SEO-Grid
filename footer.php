<footer style="background:<?php the_field('footer_background_color', 'option'); ?>; color:<?php the_field('footer_font_color', 'option'); ?>;">
    <div class="inner">
        <div id="bottom" class="cf">
            <?php if ( ! dynamic_sidebar('sidebar-footer') ): ?>
            <?php endif; ?>
        </div>

        <small>&copy; <?php echo date('Y');?> <?php bloginfo('name') ?>.</small>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>