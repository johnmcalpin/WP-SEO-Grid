<?php
/*
Template Name: Archives
*/
get_header(); ?>

<section class="auto-grid">
<?php
                // loop through the rows of data
                while (have_posts() ) : the_post();
            ?>
<div class="grid-item blog">
	<?php if ( has_post_thumbnail()) : ?>
    <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail(); ?>
    </a>
<?php endif; ?>
<a href="<?php the_permalink(); ?>"><h2 class="entry-title"><?php the_title(); ?></h2></a>
<p class="details"><?php echo( get_the_date('F j, Y') . ' by ' . get_the_author()); ?></p>
		<p><?php the_field('intro_text'); ?></p>
</div>
<?php
            endwhile;
            ?>
</section>

<?php get_footer(); ?>