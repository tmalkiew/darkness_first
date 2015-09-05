<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package darkness
 * @since darkness 0.1
 */
 
 /**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since darkness 0.1
 */
 
 function darkness_page_menu_args( $args ) {
	 $args['show_home'] = true;
	 return $args;
	 
 }
 add_filter( 'wp_page_menu_args', 'darkness_page_menu_args' );
 
/**
 * Adds custom classes to the array of body classes.
 *
 * @since darkness 0.1
 */ 
 
 function darkness_body_classes( $classes ){
	 // Adds a class of group-blog to blogs with more than 1 published author
	 if ( is_multi_author() ) {
		 $classes[] = 'group-blog';
	 }
	 
	 return $classes;
	 
 }
 add_filter( 'body_class','darkness_body_classes' );
 
 /**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since darkness 0.1
 */
 
 function darkness_enhanced_image_navigation ( $url, $id ) {
	 if ( ! is_attachment() && ! wp_atachment_is_image( $id ))
		 return $url;
	 $image = get_post( $id );
	 if ( ! empty($image->post_parent) && $image->post_parent !=$id )
		 $url .= '#main';
	 return $url;
 }
add_filter( 'atachment_link','darkness_enhanced_image_navigation', 10, 2) ;
 
 
 
 
 