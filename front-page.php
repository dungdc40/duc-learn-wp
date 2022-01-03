<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 */

get_header();
?> 

<h1>This is the Homepage. Your IP Address: <?php echo do_shortcode('[debugcode]'); ?></h1>
 
 <?php get_footer(); ?>
