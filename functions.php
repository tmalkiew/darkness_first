<?php
/**
 * Darkness First functions and definitions
 *
 * @package Darkness First
 * @since darkness 0.1
 */
 if ( ! isset( $content_width))
	 $content_width = 654; /* pixels */
 
 if ( ! function_exists('darkness_setup')):
 /**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since darkness 0.1
 */
 
 function darkness_setup() {
	 
	 /**
	 * Custom template tags for this theme.
	 */
	 
	 require( get_template_directory() . '/inc/template-tags.php');
	 
	 /**
	 * Custom functions that act independently of the theme templates
	 */
	 
	 require( get_template_directory() . '/inc/tweaks.php');
	 
	 /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on darkness, use a find and replace
     * to change 'darkness' to the name of your theme in all the template files
     */
	 
	 load_theme_textdomain ( 'darkness', get_template_directory() . '/languages');
	 
	 /**
	 * Add default posts and comments RSS feed links to head
	 */
	 
	 add_theme_support( 'automatic-feed-links');
	 
	 /**
	 * Enable support for the Aside Post Format
	 */
	 
	 add_theme_support('post-formats' , array( 'aside') );
	 
	 /**
	 * Enable support for the Post Thumbnails
	 */
	 
	 add_theme_support('post_thumbnails');
	 
	 /**
	 * This theme uses wp_nav_menu() in one location.
	 */
	 register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'darkness' ),
	 ) );
	 
 }
 endif; //darkness_setup
 add_action( 'after_setup_theme', 'darkness_setup' );
 
	 /**
	 * Enqueue scripts and styles
	 */
	function darkness_scripts() {
		wp_enqueue_style( 'style', get_stylesheet_uri() );
	 
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	 
		wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	 
		if ( is_singular() && wp_attachment_is_image() ) {
			wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'darkness_scripts' );
	
	/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since darkness 1.0
 */
function darkness_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Primary Widget Area', 'darkness' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
 
    register_sidebar( array(
        'name' => __( 'Secondary Widget Area', 'darkness' ),
        'id' => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'darkness_widgets_init' );

/**
 * Custom Post Type - Music Reviews
 * @package Darkness
 * @since darkness 0.1
 *
 */
 
 function darkness_music_reviews() {
	 //Set UI labels for music reviews
	 $labels = array (
		'name' 				=> _x('Reviews', 'Post Type General Name', 'darkness'),
		'singular_name' 	=> _x('Review', 'Post Type Singular Name', 'darkness'),
		'menu_name'			=> __('Reviews', 'darkness'),
		'all_items'			=> __('All Reviews', 'darkness'),
		'view_item'			=> __('View Review', 'darkness'),
		'add_new_item'		=> __('Add New Review', 'darkness'),
		'add_new'			=> __('Add New', 'darkness'),
		'edit_item'			=> __('Edit Review', 'darkness'),
		'update_item'		=> __('Update Review', 'darkness'),
		'search_items'		=> __('Search Review', 'darkness'),
		'not_found'			=> __('Review Not Found', 'darkness'),
		'not_found_in_trash'=> __('Review Not Found in Trash', 'darkness'),
	);
	
	//Set other options for music reviews
	
	$args = array (
		'label' 			=> __('reviews', 'darkness'),
		'description'		=> __('Music News and Reviews', 'darkness'),
		'labels'			=> $labels,
		//Features this CPT supports in Post Editor
		'supports'			=> array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom_fileds', 'post_formats',),
		//Enable custom taxonomies
		'taxonomies' 		=> array('reviews','genres', 'bands', ),
		'hierarchical'		=> false,
		'public'			=> true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'	=> true,
		'show_in_admin_bar'	=> true,
		'menu_position'		=> 5,
		'can_export'		=> true,
		'has_archive'		=> true,
		'exclude_from_search' => false,
		'publicly_queryable'=> true,
		'capability_type'	=> 'page',
	);
	 
	 // Registering CPT
	 
	 register_post_type('reviews', $args);
 }
 
 add_action('init', 'darkness_music_reviews',0 );
