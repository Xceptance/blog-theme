<?php
function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1038, 576, array( 'top', 'left') );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

/* Remove Google Lato */

function mytheme_dequeue_fonts() {
	wp_dequeue_style( 'twentyfourteen-fonts' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );


/* Enqueue New Google Fonts */

function load_new_fonts() {

	wp_enqueue_style( 'load_new_fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,700|Merriweather:300italic,700italic,400', array(), null, 'screen' );
	
}
add_action('wp_enqueue_scripts', 'load_new_fonts');


function featured_posts_customize_register() { 
	global $wp_customize; 
	$wp_customize->add_setting( 'num_posts_grid', array( 'default' => '6' ) ); 
	$wp_customize->add_setting( 'num_posts_slider', array( 'default' => '6' ) ); 
	$wp_customize->add_setting( 'layout_mobile', array( 'default' => 'grid' ) ); 
	$wp_customize->add_control( 'num_posts_grid', array( 'label' => __( 'Number of posts for grid', 'text-domain'), 'section' => 'featured_content', 'settings' => 'num_posts_grid', ) ); 
	$wp_customize->add_control( 'num_posts_slider', array( 'label' => __( 'Number of posts for slider', 'text-domain'), 'section' => 'featured_content', 'settings' => 'num_posts_slider', ) ); 
	$wp_customize->add_control( 'layout_mobile', array( 'label' => __( 'Layout for mobile devices', 'text-domain'), 'section' => 'featured_content', 'settings' => 'layout_mobile', 'type' => 'select', 'choices' => array( 'grid' => 'Grid', 'slider' => 'Slider', ), ) ); } add_action( 'customize_register', 'featured_posts_customize_register' );
	
function custom_theme_mod( $value ) { 
	if ( wp_is_mobile() ){ 
		return get_theme_mod( 'layout_mobile', 'grid' ); } 
	else { 
		return $value; } 
	} add_filter( 'theme_mod_featured_content_layout', 'custom_theme_mod' );
?>