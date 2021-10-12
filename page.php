<?php get_header();?>
<div>
    <section>
        <?php if( have_rows('content') ): ?>
        <!-- Checking for Page flexible content -->
        <?php while( have_rows('content') ): the_row(); ?>
        <!-- Checking If Flexible Content has rows | If True - start Switch, in other case just return message -->
        <?php 

        //One Column Content (Full-Width)
        if( get_row_layout() == 'one_column_fw' ): ?>
        <section class="auto-grid"
            <?php if( get_sub_field('background_color') ): ?>style="background-color:<?php the_sub_field('background_color'); ?>"
            <?php endif; ?>>
            <div class="grid-item">
                <?php the_sub_field('content'); ?>
            </div>
            </section>

        <?php 

        //Two Column Text
        elseif( get_row_layout() == 'two_column_text' ): ?>
        <section class="auto-grid"
            <?php if( get_sub_field('background_color') ): ?>style="background-color:<?php the_sub_field('background_color'); ?>"
            <?php endif; ?>>
            <div class="grid-item">
                    <?php the_sub_field('left_column_content'); ?>
            </div>
                    <div class="grid-item">
                    <?php the_sub_field('right_column_content'); ?>
                </div>
            </div>
            </section>
        <?php 

        //Left Image & Text
        elseif( get_row_layout() == 'left_image_text' ): ?>
     <section class="auto-grid"
            <?php if( get_sub_field('background_color') ): ?>style="background-color:<?php the_sub_field('background_color'); ?>"
            <?php endif; ?>>
            <div class="grid-item">
                <img src="<?php the_sub_field('image_left'); ?>"> </div>
                <div class="grid-item">
                <?php the_sub_field('text_right'); ?>
            </div>
            </section>

        <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
    </section>
</div>
<?php get_footer(); ?>