<footer style="background:<?php the_field('footer_background_color', 'option'); ?>; color:<?php the_field('footer_font_color', 'option'); ?>;">
    <div class="inner-footer">
        <div id="bottom" class="cf">
            <?php if ( ! dynamic_sidebar('sidebar-footer') ): ?>
            <div id="search" class="widget-container widget_search g1">
                <h3 class="widget-title"><?php _e('Search', 'seo-grid'); ?></h3>
                <?php get_search_form(); ?>
            </div>
            <div class="g1">
                <h3 class="widget-title"><?php _e('Categories', 'seo-grid'); ?></h3>
                <ul>
                    <?php wp_list_categories(array('title_li' => '')); ?>
                </ul>
            </div>
            <div class="g1">
                <h3 class="widget-title"><?php _e('Tags', 'seo-grid'); ?></h3>
                <?php wp_tag_cloud(); ?>
            </div>

            <?php endif; ?>
        </div>

        <small>&copy; <?php echo date('Y');?> <?php bloginfo('name') ?>.</small>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>