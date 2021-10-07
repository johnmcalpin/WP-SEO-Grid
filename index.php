<?php get_header();?>
<div>
    <section>
    <div class="blog-content">
				<h1><?php the_title();?></h1>

				<div>
					<?php the_content(); ?>
				</div>
			</div>
    </section>
</div>
<?php get_footer(); ?>