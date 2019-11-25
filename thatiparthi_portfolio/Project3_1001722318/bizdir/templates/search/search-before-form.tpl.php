<?php
/**
 * This is the template that displays search after wrapped.
 * 
 * @version 1.0.0
 * @package bizdir
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="trilisting-mobile-search-nav-wrap trilisting-mobile-filters-sticky-js">
	<ul class="trilisting-search-mobile-tabs trilisting-archive-tabs">
		<li class="trilisting-search-mobile-tab trilisting-archive-tab trilisting-search-mobile-listing-js active">
			<i class="fas fa-list"></i><span><?php esc_html_e( 'Listing', 'bizdir' ); ?></span>
		</li>
		<li class="trilisting-search-mobile-tab trilisting-archive-tab trilisting-search-mobile-map-js">
			<i class="fas fa-map-marker-alt"></i><span><?php esc_html_e( 'Map', 'bizdir' ); ?></span>
		</li>
		<li class="trilisting-search-mobile-tab trilisting-archive-tab trilisting-search-mobile-filter-js">
			<i class="fas fa-filter"></i><span><?php esc_html_e( 'Filter', 'bizdir' ); ?></span>
		</li>
	</ul>
</div>

<div class="trilisitng-search-archive">
	<div class="trilisting-search-slct-wrap">
		<h4 class="trilisting-search-slct-title"><?php esc_html_e( 'What are you looking for?', 'bizdir' ); ?></h4>
		<div class="trilisting-search-wrap active">
