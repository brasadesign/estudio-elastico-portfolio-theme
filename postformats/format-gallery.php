<?php 
	echo do_shortcode(get_post_meta( $post->ID, '_cmb_the_gallery_shortcode', true ));