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
$def_thumb_img = $this->platform->get_option( 'def_thumb_img' );
$opt_cat = $this->get_inner_option( 'meta_' . $this->current_post_type . '.category' );
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
	<div class="trilisting-item<?php echo esc_attr( ( '' != $item_type ? ' trilisting-item-' . $item_type : '' ) . esc_attr( $no_img_class ) );  ?>" data-post-id="<?php echo $this->post->ID; ?>">
		<?php if ( false === $no_img_class_bool && 'none' !== $img_layout && '' !== $img_layout ) : ?>
			<div class="trilisting-wrap-badge-img trilisting-item-img">
				<?php
				echo $this->render_image( $img_layout, true, $data = '' );
				if ( 1 == $opt_cat ) {
					switch ( $this->current_post_type ) {
						case 'trilisting_places' :
							echo $this->render_category( 1, 'trilisting_category', 'tax_category_icons' );
							break;
					}
				}
				?>
			</div>
		<?php endif; ?>

		<div class="trilisting-item-details">
			<div class="trilisting-block-main">
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
					$date_opt = $this->get_inner_option( 'meta_' . $this->current_post_type . '.date' );
					$comments_opt = $this->get_inner_option( 'meta_' . $this->current_post_type . '.comments' );
					$author_opt = $this->get_inner_option( 'meta_' . $this->current_post_type . '.author' );
					$date = get_the_time( 'U', $this->post->ID );
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
					if ( 'trilisting_places' === $this->current_post_type && 1 == $opt_cat ) {
						echo $this->render_category( 1, 'trilisting_location' );
					}
					?>

					<?php echo $this->render_fields(); ?>
					<?php if ( 1 == $this->get_inner_option( 'meta_' . $this->current_post_type . '.comments' ) ) : ?>
						<div class="trilisting-right-meta">
							<?php echo $this->render_comments( true, '<i class="fas fa-comment" aria-hidden="true"></i>' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div> <!-- .trilisting-item -->
</article>
