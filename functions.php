<?php

// Restore Classic Widgets Editor
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );

// Add Theme Options
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

if ( ! isset( $content_width ) ) {
	$content_width = 400;
}

function seo_grid_styles_scripts() {

		 wp_enqueue_style( 'seo-grid-style', get_stylesheet_uri(), array(),'0.97' );

		 if ( is_singular() && get_option( 'thread_comments' ) ) 
		 	wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'seo_grid_styles_scripts');

function seo_grid_my_menu_args( $args = '' ) {
		 $args['container_class']= 'menu';
		 $args['menu_class']= 'sf-menu';
		 return $args;
}
add_filter('wp_nav_menu_args', 'seo_grid_my_menu_args');

function seo_grid_tag_cloud_widget($args) {
	$args['largest'] = 1; //largest tag
	$args['smallest'] = 1; //smallest tag
	$args['separator'] = ' - ';
	$args['unit'] = 'em'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'seo_grid_tag_cloud_widget' );

function seo_grid_setup() {
	add_theme_support( 'custom-background', array(
		'wp-head-callback' => '_custom_background_cb'
		) );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
	add_theme_support( 'post-thumbnails' ); 
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
    add_editor_style( get_stylesheet_uri() );
	register_nav_menu('header-menu',__( 'Header Menu', 'seo-grid' ));
	load_theme_textdomain('seo-grid', get_template_directory() . '/languages');
	set_post_thumbnail_size( 300, 144 );
	add_image_size( 'seo-grid-featured-img', 300, 144 ); 
}
add_action( 'after_setup_theme', 'seo_grid_setup' );

function seo_grid_is_last_page() {
    global $page, $numpages, $multipage;
    if ( $multipage )  {
        return ( $page === $numpages ) ? true : false ;
    } else {
        return true;
    };
};
function seo_grid_page_number() {
    global $page, $multipage;
    if ( $multipage )  {
        return $page;
    } else {
        return 0;
    };
};

function seo_grid_my_excerpt_password_form( $excerpt ) {
    if ( post_password_required() )
        $excerpt = get_the_password_form();
    return $excerpt;
}
add_filter( 'the_excerpt', 'seo_grid_my_excerpt_password_form' );

function seo_grid_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Homepage Header', 'seo-grid'),
		'id' => 'sidebar-homepage',
		'description' => __( 'This widget appears on the top-right corner of the homepage. RECOMMENDATIONS: this is a great place for unique homepage text to describe your website by using a text widget; only put one widget here.', 'seo-grid'),
		'before_widget' => '<div class="g1">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Sitewide Footer', 'seo-grid'),
		'id' => 'sidebar-footer',
		'description' => __( 'These widgets will appear in the footer of the homepage. RECOMMENDATION: add widgets in multiples of 3.', 'seo-grid'),
		'before_widget' => '<div class="g1">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Sidebar for Page (optional)', 'seo-grid'),
		'id' => 'page-sidebar',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar for Post (optional)', 'seo-grid'),
		'id' => 'post-sidebar',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'seo_grid_widgets_init' );

function seo_grid_custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'seo_grid_custom_excerpt_length', 999 );

function seo_grid_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'seo_grid_excerpt_more' );

//* Remove WP emoji code
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function seo_grid_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
/**
 * CHANGE DEFAULT FOOTER TEXT
 */
function wpst_footer_admin() {
  echo '<span style="text-transform: uppercase; font-size: 0.85em; letter-spacing: 0.2em;">Theme developed by <a style="text-decoration: none;font-weight: bold; color:#555;" target="_blank" href="https://www.johnmcalpin.com">John McAlpin</a></span>';
}
add_filter( 'admin_footer_text', 'wpst_footer_admin' );

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
	  wp_die('No post to duplicate has been supplied!');
	}
	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
	  return;
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
	  /*
	   * new post data array
	   */
	  $args = array(
		'comment_status' => $post->comment_status,
		'ping_status'    => $post->ping_status,
		'post_author'    => $new_post_author,
		'post_content'   => $post->post_content,
		'post_excerpt'   => $post->post_excerpt,
		'post_name'      => $post->post_name,
		'post_parent'    => $post->post_parent,
		'post_password'  => $post->post_password,
		'post_status'    => 'draft',
		'post_title'     => $post->post_title,
		'post_type'      => $post->post_type,
		'to_ping'        => $post->to_ping,
		'menu_order'     => $post->menu_order
	  );
	  /*
	   * insert the post by wp_insert_post() function
	   */
	  $new_post_id = wp_insert_post( $args );
	  /*
	   * get all current post terms ad set them to the new post draft
	   */
	  $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
	  foreach ($taxonomies as $taxonomy) {
		$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
		wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
	  }
	  /*
	   * duplicate all post meta just in two SQL queries
	   */
	  $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
	  if (count($post_meta_infos)!=0) {
		$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
		foreach ($post_meta_infos as $meta_info) {
		  $meta_key = $meta_info->meta_key;
		  if( $meta_key == '_wp_old_slug' ) continue;
		  $meta_value = addslashes($meta_info->meta_value);
		  $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
		}
		$sql_query.= implode(" UNION ALL ", $sql_query_sel);
		$wpdb->query($sql_query);
	  }
	  /*
	   * finally, redirect to the edit post screen for the new draft
	   */
	  wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
	  exit;
	} else {
	  wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
  }
  add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
  /*
   * Add the duplicate link to action list for post_row_actions
   */
  function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
	  $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
  }
  add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
  add_filter( 'page_row_actions', 'rd_duplicate_post_link', 10, 2 );
?>