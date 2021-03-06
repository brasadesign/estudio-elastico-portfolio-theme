<?php
	/*
	Template Name: Portfolio Vertical
	*/
	get_header(); 
	the_post();

	/**
	* ebor_open_wrapper hook
	* All actions contained in /ebor_framework/theme_actions.php
	*
	* @hooked ebor_open_wrapper_markup - 10
	*/
	do_action('ebor_open_wrapper');
?>
	
	<div class="gallery-wrapper" id="vertical">
			
		<ul class="gallery vertical  <?php if( get_option('portfolio_animate','1') == 1) echo 'animate'; ?>">
		
			<?php 
				$portfolio_query = new WP_Query('post_type=portfolio&posts_per_page=-1');
				if ( $portfolio_query->have_posts() ) : while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); 
				
				/**
				 * Get the vertical thumbnail.
				 * Gets a secondary featured image assigned for the vertical layout.
				 * Class defined in /ebor_framework/post_thumbnails.php
				 * Escapes loop and moves to next post if no vertical thumbnail is found, prevents dead HTML.
				 */
				if(!( MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'portfolio-vertical') ))
					continue;
			?>
			
				<li <?php post_class(); ?>>
					<a href="<?php the_permalink(); ?>">
						<?php 
							/**
							 * Get the vertical thumbnail.
							 * Gets a secondary featured image assigned for the vertical layout.
							 * Class defined in /ebor_framework/post_thumbnails.php
							 */
							MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'portfolio-vertical'); 
						?>
						<div class="gallery-details">
							<h5 class="small-bottom"><?php the_title(); ?></h5>
							<p class="meta small-bottom"><?php echo the_simple_terms_links(); ?></p>
							<h6 class="remove-bottom"><?php echo get_post_meta( $post->ID, '_cmb_the_subtitle', true ); ?></h6>
						</div>
					</a>
				</li>
				
			<?php endwhile; else: ?>
			  
			  	<p><?php _e('Sorry, no posts matched your criteria.','other'); ?></p>
			  
			<?php 
				endif;
				wp_reset_query(); 
			?>
	
		</ul>
	
	</div>
	
<?php
	/**
	* ebor_close_wrapper hook
	* All actions contained in /ebor_framework/theme_actions.php
	*
	* @hooked ebor_close_wrapper_markup - 10
	*/
	do_action('ebor_close_wrapper');
	
	get_footer();