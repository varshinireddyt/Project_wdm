<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'bizdir_has_post_type_fields' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @return array
	 */
	function bizdir_has_post_type_fields() {
		if ( ! function_exists( 'get_trilisting_option' ) ) {
			return [];
		}

		$fields = [
			'trilisting_city'                     => false,
			'trilisting_full_address_geolocation' => false,
			'trilisting_company_logo'             => false,
			'trilisting_category'                 => false,
			'trilisting_features'                 => false,
			'trilisting_facebook'                 => false,
			'trilisting_twitter'                  => false,
			'trilisting_youtube'                  => false,
			'trilisting_instagram'                => false,
			'trilisting_tagline'                  => false,
			'trilisting_phone'                    => false,
			'trilisting_site'                     => false,
		];

		$post_type_fields = Trilisting_Widgets_Platform::get_trilisting_option( get_post_type() . '_meta' );
		if ( empty( $post_type_fields ) ) {
			return $fields;
		}

		foreach ( (array) $post_type_fields as $key_field => $field_value ) {
			if ( isset( $fields[ $key_field ] ) && ( 1 != $field_value ) ) {
				$fields[ $key_field ] = true;
			}
		}

		return $fields;
	}
}

if ( ! function_exists( 'bizdir_get_social_fields' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param int $post_id
	 * @param string $prefix
	 * @return array
	 */
	function bizdir_get_value_fields( $post_id, $prefix = '' ) {
		$fields = [
			'company_logo'             => '',
			'facebook'                 => '',
			'twitter'                  => '',
			'youtube'                  => '',
			'instagram'                => '',
			'tagline'                  => '',
			'full_address_geolocation' => '',
			'phone'                    => '',
			'site'                     => '',
		];

		if ( ! function_exists( 'get_field' ) ) {
			return $fields;
		}

		foreach ( $fields as $key_field => $field_value ) {
			$fields[ $key_field ] = get_field( $prefix . $key_field, $post_id );
		}

		return $fields;
	}
}

if ( ! function_exists( 'bizdir_place_parse_url' ) ) {
	/**
	 * @since 1.0.0
	 * 
	 * @param string $url
	 * @return string
	 */
	function bizdir_place_parse_url( $url ) {
		if ( ! $url ) {
			return;
		}

		return parse_url( $url, PHP_URL_HOST );
	}
}
