<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bizdir_body_class' ) ) {
	/**
	 * Add class for body tags.
	 * 
	 * @since 1.0.0
	 * 
	 * @param $classes
	 * @return array
	 */
	function bizdir_body_class( $classes ) {
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		if ( is_archive() && ( 'trilisting_places' === get_post_type() ) ) {
			$classes[] = 'trilisting-archive-page';
		}

		if ( is_search() ) {
			$classes[] = 'trilisting-search-result';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'bizdir_body_class' );

if ( ! function_exists( 'bizdir_set_page_template' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	function bizdir_set_page_template() {
		if ( function_exists( 'get_trilisting_option' ) ) {
			$dashboard_page = get_trilisting_option( 'dashboard_page_theme' );
			$search_page = get_trilisting_option( 'trilisting_placessearch_page_theme' );

			update_post_meta( absint( $dashboard_page ), '_wp_page_template', 'page-full-width.php' );
			update_post_meta( absint( $search_page ), '_wp_page_template', 'page-full-width.php' );
		}
	}
}
add_action( 'init', 'bizdir_set_page_template' );

if ( ! function_exists( 'bizdir_taxonomy_tpl' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param array  $select
	 * @param string $view_template
	 * @return array
	 */
	function bizdir_taxonomy_tpl( $select, $view_template ) {
		$select_featured = ( 'featured' == $view_template ) ? 'selected="selected"' : '';
		$select['featured'] = '<option value="featured"' . $select_featured . '>' . esc_html__( 'Featured 1', 'bizdir' ) . '</option>';
		return $select;
	}
}
add_filter( 'trilisting/filter/widgets/admin/taxonomy_templates', 'bizdir_taxonomy_tpl', 10, 2 );

if ( ! function_exists( 'bizdir_taxonomy_html' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param string $html
	 * @return string
	 */
	function bizdir_taxonomy_html( $html ) {
		return '<span class="trilisitng-single-icons trilisitng-single-icons-city"><i class="fas fa-map-marker-alt"></i></span>';
	}
}
add_filter( 'trilisting/single/taxonomy/html_before', 'bizdir_taxonomy_html' );

if ( ! function_exists( 'bizdir_number_field' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param array $atts
	 * @return array
	 */
	function bizdir_number_field( $atts ) {
		if ( isset( $atts['value'] ) && is_numeric( $atts['value'] ) ) {
			$atts['value'] = number_format( $atts['value'], 0, '',' ' );
		}

		return $atts;
	}
}
add_filter( 'trilisting/filters/acf/number_field', 'bizdir_number_field' );

if ( ! function_exists( 'bizdir_maps_icons_directions' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param string $icons
	 * @return string
	 */
	function bizdir_maps_icons_directions( $icons ) {
		return '<i class="fas fa-location-arrow"></i>';
	}
}
add_filter( 'trilisting/fields/maps/directions', 'bizdir_maps_icons_directions' );

if ( ! function_exists( 'bizdir_dashboard_thumb_size' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param string $size
	 * @return string
	 */
	function bizdir_dashboard_thumb_size( $size ) {
		return 'trilisting-post-gallery-2-col';
	}
}
add_filter( 'trilisting/dashboard/thumbnail/size', 'bizdir_dashboard_thumb_size' );

if ( ! function_exists( 'bizdir_styling_secondary_color' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param string $size
	 * @return string
	 */
	function bizdir_styling_secondary_color( $classes ) {
		$classes .= ' .type-trilisting_places .trilisting-item-img .trilisting-term-link { background-color: {{value}}; }';
		return $classes;
	}
}
add_filter( 'customify/styling/secondary-color', 'bizdir_styling_secondary_color', 1, 10 );

if ( ! function_exists( 'bizdir_search_widget_view' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param string $widget
	 * @return string
	 */
	function bizdir_search_widget_view( $widget ) {
		return 'trilisting_widget_standard_1';
	}
}
add_filter( 'trilisting/search/widget_view', 'bizdir_search_widget_view' );

if ( ! function_exists( 'bizdir_rating_stars_font_size' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param int $fs
	 * @return int
	 */
	function bizdir_rating_stars_font_size( $fs ) {
		return 15;
	}
}
add_filter( 'trilisting/ratings/stars/font_size', 'bizdir_rating_stars_font_size' );

if ( ! function_exists( 'bizdir_rating_comment_text' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param bool $show_text
	 * @return bool
	 */
	function bizdir_rating_comment_text( $show_text ) {
		return false;
	}
}
add_filter( 'trilisting/action/rating/comment_text', 'bizdir_rating_comment_text' );

if ( ! function_exists( 'bizdir_dashboard_column_category' ) && class_exists( '\TRILISTING\Trilisting_Helpers' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param object $query
	 * @return void
	 */
	function bizdir_dashboard_column_category( $query ) {
		$taxonomy = \TRILISTING\Trilisting_Helpers::render_taxonomy( 'trilisting_category', $query->ID );
		if ( ! empty( $taxonomy ) ) {
			echo $taxonomy;
		}
	}
}
add_action( 'trilisting/action/dashboard/column_post_title_before', 'bizdir_dashboard_column_category' );

if ( ! function_exists( 'bizdir_tax_cat_html' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	function bizdir_tax_cat_html() {
		echo '<span class="trilisitng-item-icons"><i class="fas fa-map-marker-alt"></i></span>';
	}
}
add_action( 'trilisting/taxonomy/trilisting_location/before_html', 'bizdir_tax_cat_html' );

if ( ! function_exists( 'bizdir_search_before_form' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	function bizdir_search_before_form() {
		if ( ( is_archive() || is_page() ) && ! is_front_page() ) {
			require get_stylesheet_directory() . '/templates/search/search-before-form.tpl.php';
		}
	}
}
add_action( 'trilisting/search/before_form', 'bizdir_search_before_form' );

if ( ! function_exists( 'bizdir_search_after_form' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	function bizdir_search_after_form() {
		if ( ( is_archive() || is_page() ) && ! is_front_page() ) {
			require get_stylesheet_directory() . '/templates/search/search-after-form.tpl.php';
		}
	}
}
add_action( 'trilisting/search/after_form', 'bizdir_search_after_form' );

if ( ! function_exists( 'bizdir_search_after_widget' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	function bizdir_search_after_widget() {
		if ( ( is_archive() || is_page() ) && ! is_front_page() ) {
			echo '</div>'; // End class - trilisitng-search-archive
		}
	}
}
add_action( 'trilisting/search/after_widget', 'bizdir_search_after_widget' );

if ( ! function_exists( 'bizdir_user_panel_after_html' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	function bizdir_user_panel_after_html() {
		if ( ! is_front_page() && is_active_sidebar( 'tril-search-popup' ) ) {
			echo '<div class="trilisting-search-wrap"><span class="trilisting-search-btn"><i class="fas fa-search"></i></span></div>';
		}
	}
}
add_action( 'trilisting/user_panel/after_html', 'bizdir_user_panel_after_html' );

if ( ! function_exists( 'bizdir_search_before_render_widget' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	function bizdir_search_before_render_widget() {
		$search_title = esc_html__( 'search results', 'bizdir' );
		if ( is_archive() ) {
			$search_title = single_cat_title( '', false );
		} else {
			if ( isset( $_GET['_trl_search'] ) && ! empty( $_GET['_trl_search'] ) ) {
				$search_title = $_GET['_trl_search'];
			} elseif ( isset( $_GET['_trl_trilisting_category'] ) && 0 != $_GET['_trl_trilisting_category'] ) {
				$search_title = get_term( $_GET['_trl_trilisting_category'], 'trilisting_category' );
				$search_title = is_object( $search_title ) ? $search_title->name : '';
			} elseif ( isset( $_GET['_trl_trilisting_location'] ) && 0 != $_GET['_trl_trilisting_location'] ) {
				$search_title = get_term( $_GET['_trl_trilisting_location'], 'trilisting_location' );
				$search_title = is_object( $search_title ) ? $search_title->name : '';
			}
		}

		if ( ! empty( $search_title ) ) {
			echo '<h3 class="trilisting-search-title">' .  esc_html( $search_title ) . '</h3>';
		}
	}
}
add_action( 'trilisting/search/before_render_widget', 'bizdir_search_before_render_widget' );
