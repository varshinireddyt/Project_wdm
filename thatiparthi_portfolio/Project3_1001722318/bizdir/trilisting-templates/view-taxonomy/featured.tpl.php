<?php
/**
 * Category API: Trilisting_Category_Walker class
 *
 * @version 1.0.0
 * @package trilisting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Trilisting_Category_Walker_featured' ) ) {
	/**
	 * Template for displaying Categories.
	 */
	class Trilisting_Category_Walker_featured extends Walker_Category {
		/**
		 * What the class handles.
		 *
		 * @since 2.1.0
		 * @var string
		 *
		 * @see Walker::$tree_type
		 */
		public $tree_type = 'category';

		/**
		 * Database fields to use.
		 *
		 * @since 2.1.0
		 * @var array
		 *
		 * @see Walker::$db_fields
		 * @todo Decouple this
		 */
		public $db_fields = array ( 'parent' => 'parent', 'id' => 'term_id', );

		/**
		 * Starts the list before the elements are added.
		 *
		 * @since 2.1.0
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param string $output Used to append additional content. Passed by reference.
		 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
		 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
		 *                       value is 'list'. See wp_list_categories(). Default empty array.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( 'list' != $args['style'] ) {
				return;
			}

			$indent = str_repeat("\t", $depth);
			$output .= "$indent<ul class='children'>\n";
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @since 2.1.0
		 *
		 * @see Walker::end_lvl()
		 *
		 * @param string $output Used to append additional content. Passed by reference.
		 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
		 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
		 *                       value is 'list'. See wp_list_categories(). Default empty array.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			if ( 'list' != $args['style'] ) {
				return;
			}

			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}

		/**
		 * Starts the element output.
		 *
		 * @since 2.1.0
		 *
		 * @see Walker::start_el()
		 *
		 * @param string $output   Used to append additional content (passed by reference).
		 * @param object $category Category data object.
		 * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
		 * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
		 * @param int    $id       Optional. ID of the current category. Default 0.
		 */
		public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
			$cat_name = apply_filters(
				'list_cats',
				esc_attr( $category->name ),
				$category
			);

			// Don't generate an element if the category name is empty.
			if ( ! $cat_name ) {
				return;
			}

			$custom_fields = trilisting_get_taxonomy_fields( $category );
			$link = '<a class="trilisting-link" href="' . esc_url( get_term_link( $category ) ) . '" ';
			if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
				/**
				 * Filters the category description for display.
				 *
				 * @since 1.2.0
				 *
				 * @param string $description Category description.
				 * @param object $category    Category object.
				 */
				$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
			}

			$link .= '>';
			$link .= "$custom_fields\n";

			$count_cat = '';
			if ( ! empty( $args['show_count'] ) ) {
				$count_cat .= '<span class="trilisting-count-category">' . sprintf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s lisitng', '%1$s lisitngs', $category->count, 'lisitngs', 'bizdir' ) ),
					number_format_i18n( $category->count )
				) . '</span>';
			}

			$link .= '<span class="trilisting-tax-wrap"><span class="trilisting-tax-cat-name">' . $cat_name . '</span>' . $count_cat . '</span>' . '</a>';
			if ( 'list' == $args['style'] ) {
				$output .= "\t<li";
				$css_classes = array(
					'cat-item',
					'cat-item-' . $category->term_id,
				);

				if ( ! empty( $args['current_category'] ) ) {
					$_current_terms = get_terms( $category->taxonomy, array(
						'include'    => $args['current_category'],
						'hide_empty' => false,
					) );

					foreach ( $_current_terms as $_current_term ) {
						if ( $category->term_id == $_current_term->term_id ) {
							$css_classes[] = 'current-cat';
						} elseif ( $category->term_id == $_current_term->parent ) {
							$css_classes[] = 'current-cat-parent';
						}
						while ( $_current_term->parent ) {
							if ( $category->term_id == $_current_term->parent ) {
								$css_classes[] =  'current-cat-ancestor';
								break;
							}
							$_current_term = get_term( $_current_term->parent, $category->taxonomy );
						}
					}
				} // End if

				/**
				 * Filters the list of CSS classes to include with each category in the list.
				 *
				 * @since 4.2.0
				 *
				 * @see wp_list_categories()
				 *
				 * @param array  $css_classes An array of CSS classes to be applied to each list item.
				 * @param object $category    Category data object.
				 * @param int    $depth       Depth of page, used for padding.
				 * @param array  $args        An array of wp_list_categories() arguments.
				 */
				$css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

				$output .=  ' class="' . $css_classes . '"';
				$output .= ">$link\n";

			} elseif ( isset( $args['separator'] ) ) {
				$output .= "\t$link" . $args['separator'] . "\n";
			} else {
				$output .= "\t$link<br />\n";
			} // End if
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @since 2.1.0
		 *
		 * @see Walker::end_el()
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param object $page   Not used.
		 * @param int    $depth  Optional. Depth of category. Not used.
		 * @param array  $args   Optional. An array of arguments. Only uses 'list' for whether should append
		 *                       to output. See wp_list_categories(). Default empty array.
		 */
		public function end_el( &$output, $page, $depth = 0, $args = array() ) {
			if ( 'list' != $args['style'] ) {
				return;
			}

			$output .= "</li>\n";
		}

	}
} // End if
