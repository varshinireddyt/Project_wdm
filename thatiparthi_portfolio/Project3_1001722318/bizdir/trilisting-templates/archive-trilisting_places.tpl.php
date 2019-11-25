<?php
/**
 * The template for displaying archive page.
 * 
 * @version 1.0.0
 * @package trilisting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
	<div class="container-fluid trilisting-container trilisting-main">
		<div id="primary" class="content-area trilisting-archive-search-inner row">
			<main id="main" class="site-main trilisting-listings col-xs-12 col-md-12 col-lg-12" role="main">
				<?php echo trilisting_get_archive_shortcodes(); ?>
			</main>
		</div>
	</div><!-- .container-fluid -->
<?php
get_footer();
