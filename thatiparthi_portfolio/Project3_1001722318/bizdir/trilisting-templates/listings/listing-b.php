<?php
/**
 * View templates b.
 *
 * @version 1.0.0
 * @package trilisting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_classes = get_post_class( '', $this->post->ID );
$sticky_class = $this->is_sticky_class();
array_push( $post_classes, 'article-wrapper', $sticky_class );
$post_classes = implode( ' ', $post_classes );
$opt_cat = $this->get_inner_option( 'meta_' . $this->current_post_type . '.category' );
$tagline = '';
if ( function_exists( 'get_field' ) ) {
	$tagline = get_field( 'trilisting_tagline', $this->post->ID );
}
?>
<article class="<?php echo esc_attr( $post_classes ); ?>">
	<div class="row">
		<div class="col-sm-12">
			<div class="trilisting-item<?php echo esc_attr( ( '' != $item_type ? ' trilisting-item-' . $item_type : '' ) );  ?>" data-post-id="<?php echo $this->post->ID; ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="wrap-trilisting-item-img-meta trilisting-wrap-badge-img trilisting-item-img">
							<?php
							echo $this->render_image( $img_layout, true, $data = '' );
							if ( ( 'trilisting_places' === $this->current_post_type ) && 1 == $opt_cat ) {
								echo $this->render_category( 1, 'trilisting_category', 'tax_category_icons' );
							}
							?>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="trilisting-item-details">
							<div class="sc-block-main">
								<?php
								if ( ( 'post' === $this->current_post_type ) && 1 == $opt_cat ) {
									echo $this->render_category();
								}
								?>

								<div class="trilisting-item-tile-wrap">
									<?php
									echo $this->is_sticky();
									echo $this->render_title();
									?>
								</div>

								<div class="trilisting-item-description">
									<?php if ( 'trilisting_places' === $this->current_post_type ) : ?>
										<?php
										echo esc_html( $tagline );
										if ( function_exists( 'trilisting_display_average_rating' ) && trilisting_check_insert_rating( $this->current_post_type ) && 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.reviews' ) ) {
											echo trilisting_display_average_rating( $this->post->ID );
										}
										?>
									<?php else : ?>
										<?php echo $this->render_post_content(); ?>
										<a class="trilisting-keep-reading" href="<?php echo esc_url( $this->post_link ); ?>"><?php esc_html_e( 'Keep reading', 'bizdir' ); ?></a>
									<?php endif; ?>
								</div>
							</div>

							<div class="trilisting-block-meta trilisting-meta">
								<div class="trilisting-block-meta-inner">
									<?php
									$date = get_the_time( 'U', $this->post->ID );
									$author_id = esc_attr( $this->post->post_author );
									$opt_date = $this->get_inner_option( 'meta_' . $this->current_post_type . '.date' );
									?>
									<?php if ( 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.author' ) || 1 == $opt_date ) : ?>
										<div class="trilisting-left-meta">
											<a class="trilisting-author-meta" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
												<?php echo get_avatar( get_the_author_meta( 'email', $author_id ), '40' ); ?>
												<div class="trilisting-author-inner">
													<?php if ( 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.author' ) ) : ?>
														<span class="trilisting-autor-name"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></span>
													<?php endif; ?>
													<?php if ( 1 == $opt_date ) {
														echo $this->render_date();
													}
													?>
												</div>
											</a>
										</div>
									<?php endif; ?>

									<?php
									if ( function_exists( 'get_field' ) ) {
										$address = get_field( 'trilisting_full_address_geolocation', $this->post->ID );
										$phone = get_field( 'trilisting_phone', $this->post->ID );
									}
									if ( 'trilisting_places' === $this->current_post_type && 1 == $opt_cat ) {
										echo $this->render_category( 1, 'trilisting_location' );
									}
									?>

									<?php echo $this->render_fields(); ?>
									<?php if ( 'post' !== $this->current_post_type && 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.comments' ) ) : ?>
										<div class="trilisting-right-meta">
											<?php echo $this->render_comments( true, '<i class="fas fa-comment" aria-hidden="true"></i>' ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- .col-sm-12 -->
	</div>
</article>
