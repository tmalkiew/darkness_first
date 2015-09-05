<?php
/**
 * The Template for displaying all single posts
 *
 *@package darkness
 *@since darkness 0.1
 */
 
 get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		<?php //Start The Loop 
			while( have_posts() ) : the_post(); ?>
			<?php darkness_content_nav( 'nav-above' ); ?>
			<?php get_template_part( 'content','single'); ?>
			<?php darkness_content_nav( 'nav-below' ); ?>
			<?php //If comments are open or we have at least one comment, load up the comments
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
			?>
		<?php endwhile; //End of The Loop ?>
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
<?php get_Sidebar(); ?>
<?php get_footer(); ?>	
