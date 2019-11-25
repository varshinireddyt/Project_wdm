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
array_push( $post_classes, 'article-wrapper trilisting_widget_item_1' );
$post_classes = implode( ' ', $post_classes );
$def_thumb_img = $this->platform->get_option( 'def_thumb_img' );
$no_img_class = '';
$no_img_class_bool = false;
if ( empty( $this->post_thumb_id ) && empty( $def_thumb_img['url'] ) ) {
	$no_img_class_bool = true;
	$no_img_class = ' trilisting-item-no-img';
}

$tagline = '';
if ( function_exists( 'get_field' ) ) {
	$tagline = get_field( 'trilisting_tagline', $this->post->ID );
}
?>

<article class="<?php echo esc_attr( $post_classes ); ?>">
	<div class="trilisting-item<?php echo esc_attr( ( '' != $item_type ? ' trilisting-item-' . $item_type : '' ) . esc_attr( $no_img_class ) );  ?>">
		<?php if ( false === $no_img_class_bool && 'none' !== $img_layout && '' !== $img_layout ) : ?>
			<div class="trilisting-wrap-badge-img trilisting-item-img">
				<?php
				echo $this->render_image( $img_layout, true, $data = '' );
				echo $this->render_category( 1, 'trilisting_category', 'tax_category_icons' );
				?>
			</div>
		<?php endif; ?>

		<div class="trilisting-item-details">
			<div class="trilisting-block-main">
				<div class="trilisting-item-tile-wrap">
					<?php
					echo $this->is_sticky();
					echo $this->render_title();
					?>
				</div>

				<div class="trilisting-item-description">
					<?php
					echo esc_html( $tagline );
					if (
						function_exists( 'trilisting_display_average_rating' )
						&& trilisting_check_insert_rating( $this->current_post_type )
						&& 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.reviews' )
					) {
						echo trilisting_display_average_rating( $this->post->ID );
					}
					?>
				</div>
			</div>

			<div class="trilisting-block-meta trilisting-meta">
				<div class="trilisting-block-meta-inner">
					<?php
					$date_opt = $this->get_inner_option( 'meta_' . $this->current_post_type . '.date' );
					$comments_opt = $this->get_inner_option( 'meta_' . $this->current_post_type . '.comments' );
					$author_opt = $this->get_inner_option( 'meta_' . $this->current_post_type . '.author' );

					$date      = get_the_time( 'U', $this->post->ID );
					$author_id = esc_attr( $this->post->post_author );
					?>
					<?php if ( 1 == $author_opt || 1 == $date_opt ) : ?>
						<div class="trilisting-left-meta">
							<?php if ( 1 == $author_opt ) : ?>
								<a class="trilisting-author-meta" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
								<?php echo get_avatar( get_the_author_meta( 'email', $author_id ), '40' ); ?>
							<?php endif; ?>
							<div class="trilisting-author-inner">
								<?php if ( 1 == $author_opt ) : ?>
									<span class="trilisting-autor-name"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></span>
								<?php endif; ?>
								<?php
								if ( 1 == $date_opt ) {
									echo $this->render_date();
								}
								?>
							</div>
							<?php if ( 1 == $author_opt ) : ?>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php
					if ( 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.category' ) ) {
						echo $this->render_category( 1, 'trilisting_location' );
					}
					?>

					<?php if ( 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.comments' ) ) : ?>
						<div class="trilisting-right-meta">
							<?php echo $this->render_comments( true, '<i class="fas fa-comment" aria-hidden="true"></i>' ); ?>
						</div>
					<?php endif; ?>

					<?php echo $this->render_fields(); ?>
				</div>
			</div>
		</div>
	</div> <!-- .trilisting-item -->
</article>
