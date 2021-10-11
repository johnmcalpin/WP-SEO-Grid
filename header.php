<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <?php wp_head(); ?>
	<?php the_field('insert_head'); ?>
	<?php the_field('insert_head', 'option'); ?>
</head>

<body <?php body_class(); ?>>
	<?php the_field('insert_body', 'option'); ?>
    <header id="branding" class="cf" style="background-image: url(<?php the_field('background_image'); ?>); background-repeat: no-repeat, repeat; background-position: center;">
        <?php if ( has_nav_menu( 'header-menu' ) ) { ?>
            <div class="navgrid">
            <div class="navlogo"> <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img width="50px" height="50px" src="<?php the_field('logo', 'option'); ?>"></a></div>
            <div class="gridmenu">
            <nav id="access">
           
                    
            <label for="menuopen"><?php _e(' ', 'seo-grid'); ?></label>
            <input type="checkbox" id="menuopen" />
            <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
        
        </nav></div></div>
        <div class="hero-section">
            <h1 class="hero-h1"><?php the_field('page_title'); ?></h1>
            <p class="hero-intro"><?php the_field('intro_text'); ?></p>
        </div>
    </header>
    <?php } ?>