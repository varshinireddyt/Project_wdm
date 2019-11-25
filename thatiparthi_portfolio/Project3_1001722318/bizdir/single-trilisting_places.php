<?php
/**
 * The template for displaying single template.
 * 
 * @package bizdir
 */

$post_id = get_the_ID();
$fields_values = bizdir_get_value_fields( $post_id, 'trilisting_' );
extract( bizdir_has_post_type_fields() );

$add_coments_text = esc_html__( 'Add comment', 'bizdir' );
if ( function_exists( 'trilisting_check_insert_rating' ) && trilisting_check_insert_rating() ) {
	$add_coments_text = esc_html__( 'Add review', 'bizdir' );
}

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
?>

<?php if ( has_post_thumbnail( $post_id ) ) : ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' ); ?>
	<div class="trilisting-item-img trilisting-item-img-single">
		<div class="trilisting-item-bg-img" style="background-image: url('<?php echo $image[0]; ?>')"></div>
	</div>
<?php endif; ?>

<div class="trilisting-single-tabs-wrap">
	<div class="container trilisting-container">
		<div class="row">
			<div class="col-md-12">
				<div class="trilisting-single-block-nav">
					<?php if ( $fields_values['company_logo'] && isset( $fields_values['company_logo']['sizes']['thumbnail'] ) ) : ?>
						<div class="trilisting-company-logo-inner">
							<img src="<?php echo esc_url( $fields_values['company_logo']['sizes']['thumbnail'] ); ?>" alt="<?php esc_html_e( 'Company Logo', 'bizdir' ); ?>" class="trilisitng-company-logo">
						</div>
					<?php endif; ?>

					<div class="trilisting-single-details">
						<div class="trilisting-details-inner">
							<?php the_title('<h1 class="trilisting-single-title">', '</h1>'); ?>
							<?php if ( $trilisting_tagline ) : ?>
								<h4 class="trilisting-single-tagline"><?php echo esc_attr( $fields_values['tagline'] ); ?></h4>
							<?php endif; ?>
						</div>
						<div class="trilisting-single-meta">
							<?php if ( ! empty( $fields_values['phone'] ) && $trilisting_phone ) : ?>
								<a href="tel:<?php echo preg_replace( '/[^0-9]/', '', trim( $fields_values['phone'] ) ); ?>" class="trilisting-single-phone"><i class="fas fa-phone"></i><?php echo $fields_values['phone']; ?></a>
							<?php endif; ?>
							<?php if ( ! empty( $fields_values['site'] ) && $trilisting_site ) : ?>
								<a href="<?php echo esc_url( $fields_values['site'] ); ?>" class="trilisting-single-site"><?php echo bizdir_place_parse_url( $fields_values['site'] ); ?></a>
							<?php endif; ?>
							<?php if ( comments_open( get_the_ID() ) ) : ?>
								<a href="#comment" class="trilisting-single-add-comment"><i class="far fa-comment"></i><?php echo $add_coments_text; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="content trilisting-single-tmpl-1">
	<div class="container trilisting-container">
		<div class="row trilisting-container-post right-sidebar">
			<div class="ac-posts col-xs-12 col-md-12 col-lg-8">
				<div class="trilisting-main-posts">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="trilisting-single">
							<div class="row">
								<div class="col-md-12">
									<div class="trilisting-single-content">
										<div class="trilisting-single-content">
											<?php $content = get_the_content(); ?>
											<?php if ( ! empty( $content ) ) : ?>
												<div class="trilisitng-single-info-box trilisitng-single-description">
													<div class="trilisting-block-title">
														<h4 class="trilisting-title"><?php esc_html_e( 'Description', 'bizdir' ); ?></h4>
													</div>
													<?php echo apply_filters( 'the_content', $content ); ?>
												</div>
											<?php endif; ?>

											<?php $geolocation = TRILISTING\Trilisting_Acf_Fields::get_field( 'trilisting_full_address_geolocation', $post_id ); ?>
											<?php if ( ! empty( $geolocation ) && $trilisting_full_address_geolocation ) : ?>
												<div class="trilisitng-single-info-box trilisitng-single-location">
													<div class="trilisting-block-title">
														<h4 class="trilisting-title"><?php esc_html_e( 'Location', 'bizdir' ); ?></h4>
													</div>
													<?php echo $geolocation; ?>
												</div>
											<?php endif; ?>

											<?php if ( 'trilisting_places' === $post_type ) : ?>
												<?php $city = TRILISTING\Trilisting_Helpers::render_taxonomy( 'trilisting_location' ); ?>
												<?php if ( ! empty( $city ) && $city ) : ?>
													<div class="trilisitng-single-info-box trilisitng-single-city">
														<div class="trilisting-block-title">
															<h4 class="trilisting-title"><?php esc_html_e( 'City', 'bizdir' ); ?></h4>
														</div>
														<div class="trilisting-single-city-block">
															<?php echo $city; ?>
														</div>
													</div>
												<?php endif; ?>
											<?php endif; ?>
										</div><!-- .trilisting-listings -->
									</div>
									<div class="clearfix"></div>
									<div class="trilisting-comments-wrap">
										<?php
										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										endif;
										?>
									</div>
								</div>
							</div>
						</div> <!-- .trilisting-single -->
					</article>
				</div> <!-- .trilisting-main-posts -->
			</div> <!-- .ac-posts -->

			<aside class="col-xs-12 col-md-12 col-lg-4 trilisting-sidebar">
				<div class="trilisting-sidebar-places-wrap">
					<?php
					if ( is_active_sidebar( 'trilisting-single-top' ) ) {
						dynamic_sidebar( 'trilisting-single-top' );
					}
					?>

					<!-- category -->
					<?php $trl_category = TRILISTING\Trilisting_Helpers::render_taxonomy( 'trilisting_category', '', 'tax_category_icons' ); ?>
					<?php if ( ! empty( $trl_category ) && $trilisting_category ) : ?>
						<div class="trilisitng-single-info-box trilisitng-single-category">
							<div class="trilisting-block-title">
								<h4 class="trilisting-title"><?php esc_html_e( 'Categories', 'bizdir' ); ?></h4>
							</div>
							<div class="trilisting-single-category-block">
								<?php echo $trl_category; ?>
							</div>
						</div>
					<?php endif; ?>

					<!-- Features -->
					<?php $trl_features = TRILISTING\Trilisting_Helpers::render_taxonomy( 'trilisting_features', '', 'none' ); ?>
					<?php if ( ! empty( $trl_features ) && $trilisting_features ) : ?>
						<div class="trilisitng-single-info-box trilisitng-single-features">
							<div class="trilisting-block-title">
								<h4 class="trilisting-title"><?php esc_html_e( 'Features', 'bizdir' ); ?></h4>
							</div>
							<div class="trilisting-single-features-block">
								<?php echo $trl_features; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ( ! empty( $fields_values['facebook'] ) && $trilisting_facebook ) || ( ! empty( $fields_values['twitter'] ) && $trilisting_twitter ) || ( ! empty( $fields_values['youtube'] ) && $trilisting_youtube ) || ( ! empty( $fields_values['instagram'] ) && $trilisting_instagram ) ) : ?>
						<!-- follow us -->
						<div class="trilisitng-single-info-box trilisitng-single-follow-us">
							<div class="trilisting-block-title">
								<h4 class="trilisting-title"><?php esc_html_e( 'Follow us', 'bizdir' ); ?></h4>
							</div>
							<div class="trilisting-single-follow-us-block">
								<ul class="trilisting-single-follow-us-links">
									<?php if ( ! empty( $fields_values['facebook'] ) && $trilisting_facebook ) : ?>
										<li class="trilisting-single-follow-link-inner trilisting-single-follow-link-facebook">
											<a href="<?php echo esc_url( $fields_values['facebook'] ); ?>" class="trilisting-single-follow-link"><span class="trilisting-follow-icon"><i class="fab fa-facebook-f"></i></span><?php esc_html_e( 'Facebook', 'bizdir' ); ?></a>
										</li>
									<?php endif; ?>
									<?php if ( ! empty( $fields_values['twitter'] ) && $trilisting_twitter ) : ?>
										<li class="trilisting-single-follow-link-inner trilisting-single-follow-link-twitter">
											<a href="<?php echo esc_url( $fields_values['twitter'] ); ?>" class="trilisting-single-follow-link"><span class="trilisting-follow-icon"><i class="fab fa-twitter"></i></span><?php esc_html_e( 'Twitter', 'bizdir' ); ?></a>
										</li>
									<?php endif; ?>
									<?php if ( ! empty( $fields_values['youtube'] ) && $trilisting_youtube ) : ?>
										<li class="trilisting-single-follow-link-inner trilisting-single-follow-link-youtube">
											<a href="<?php echo esc_url( $fields_values['youtube'] ); ?>" class="trilisting-single-follow-link"><span class="trilisting-follow-icon"><i class="fab fa-youtube"></i></span><?php esc_html_e( 'Youtube', 'bizdir' ); ?></a>
										</li>
									<?php endif; ?>
									<?php if ( ! empty( $fields_values['instagram'] ) && $trilisting_instagram ) : ?>
										<li class="trilisting-single-follow-link-inner trilisting-single-follow-link-instagram">
											<a href="<?php echo esc_url( $fields_values['instagram'] ); ?>" class="trilisting-single-follow-link"><span class="trilisting-follow-icon"><i class="fab fa-instagram"></i></span><?php esc_html_e( 'Instagram', 'bizdir' ); ?></a>
										</li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>

					<?php
					if ( is_active_sidebar( 'trilisting-single-bottom' ) ) {
						dynamic_sidebar( 'trilisting-single-bottom' );
					}
					?>
				</div>
			</aside>
		</div>
	</div>
</div> <!-- .trilisting-single-tmpl-1 -->

<?php
endwhile; // End of the loop.

get_footer();
