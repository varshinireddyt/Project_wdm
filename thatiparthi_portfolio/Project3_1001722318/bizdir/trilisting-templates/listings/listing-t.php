<?php
/**
 * View templates a.
 *
 * @version 1.0.0
 * @package trilisting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_classes = get_post_class( '', $this->post->ID );
$sticky_class = $this->is_sticky_class();
array_push( $post_classes, 'article-wrapper trilisting_widget_item_1', $sticky_class );
$post_classes = implode( ' ', $post_classes );
?>

<article class="<?php echo esc_attr( $post_classes ); ?>">
	<div class="trilisting-item<?php echo esc_attr( ( '' != $item_type ? ' trilisting-item-' . $item_type : '' ) );  ?>">
		<div class="trilisting-item-details">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="trilisting-block-main">
						<?php
						if ( ( 'post' === $this->current_post_type ) && 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.category' ) ) {
							echo $this->render_category();
						}
						?>
						<div class="trilisting-item-tile-wrap">
							<?php
							echo $this->is_sticky();
							echo $this->render_title();
							?>
						</div>

						<?php
						if ( function_exists( 'trilisting_display_average_rating' ) && trilisting_check_insert_rating( $this->current_post_type ) && 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.reviews' ) ) {
							echo trilisting_display_average_rating( $this->post->ID );
						}
						?>
					</div>

					<div class="trilisting-block-meta trilisting-meta">
						<div class="trilisting-block-meta-inner">
							<?php
							if ( 'post' === $this->current_post_type ) {
								$date = get_the_time( 'U', $this->post->ID );
								$author_id = esc_attr( $this->post->post_author );
								?>
								<div class="trilisting-left-meta">
									<a class="trilisting-author-meta" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
										<div class="trilisting-author-inner">
											<span class="trilisting-autor-name"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></span>
											<time class="trilisting-meta-date" datetime="<?php echo esc_attr( date( DATE_W3C, $date ) ) ?>">
												<?php echo esc_html( get_the_time( get_option( 'date_format' ), $this->post->ID ) ); ?>
											</time>
										</div>
									</a>
								</div>
								<?php
							} else {
								if ( 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.date' ) ) {
									echo $this->render_date();
								}
								if ( 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.comments' ) ) {
									echo $this->render_comments( true, '<i class="fas fa-comment" aria-hidden="true"></i>' );
								}
								echo $this->render_fields();
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- .trilisting-item -->
</article>
