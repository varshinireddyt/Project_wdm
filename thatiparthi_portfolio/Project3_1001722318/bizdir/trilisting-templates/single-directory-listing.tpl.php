<?php
/**
 * The template for displaying single page.
 * 
 * @version 1.0.0
 * @package trilisting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="trilisting-single-listing">
	<?php
	/* translators: %s: Name of current post */
	the_content();
	?>
</div><!-- .trilisting-single-listing -->
