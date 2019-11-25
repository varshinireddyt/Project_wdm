<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'BizDir' ) ) {
	return;
}

class BizDir {
	/**
	 * Current theme version.
	 * 
	 * @static
	 * @access public
	 * @var string
	 */
	public static $version;

	/**
	 * Topic title specified in the style.css.
	 * 
	 * @static
	 * @access public
	 * @var string
	 */
	public static $theme_name;

	/**
	 * Retrieves the absolute path to the directory of the current theme.
	 * 
	 * @static
	 * @access public
	 * @var string
	 */
	public static $path;

	/**
	 * @static
	 * @access private
	 * @var self
	 */
	private static $_instance;

	/**
	 * Add functions to hooks.
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function init_hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ], 10 );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ], 95 );
		add_action( 'after_switch_theme', [ $this, 'after_switch_theme' ] );
		add_action( 'after_setup_theme', [ $this, 'bizdir_setup' ] );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function bizdir_setup() {
		/*
		* Make theme available for translation.
		*/
		load_theme_textdomain( 'bizdir', get_stylesheet_directory() . '/languages' );
	}

	/**
	 * Main BizDir Instance.
	 *
	 * Ensures only one instance of BizDir is loaded or can be loaded.
	 *
	 * @return BizDir Main instance.
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance  = new self();
			$theme            = wp_get_theme();
			self::$version    = $theme->get( 'Version' );
			self::$theme_name = $theme->get( 'Name' );
			self::$path       = get_stylesheet_directory();
			self::$_instance->init();
		}

		return self::$_instance;
	}

	/**
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function init() {
		$this->init_hooks();
		$this->includes();
	}

	/**
	 * Get data from method of property.
	 *
	 * @since 1.0.0
	 * 
	 * @param string $key
	 * @return bool|mixed
	 */
	public function get( $key ) {
		if ( method_exists( $this, 'get_' . $key ) ) {
			return call_user_func_array( [ $this, 'get_' . $key ], [] );
		} elseif ( property_exists( $this, $key ) ) {
			return $this->{$key};
		}

		return false;
	}

	/**
	 * @since 1.0.0
	 */
	public function after_switch_theme () {
		$old_options = (array) get_option( 'theme_mods_bizdir' );
		$old_options['trilisting_places_sidebar_layout'] = 'content';
		$old_options['posts_archives_sidebar_layout'] = 'content';
		update_option( 'theme_mods_bizdir', $old_options );

		if ( function_exists( 'get_trilisting_option' ) ) {
			$search_page_id =  absint( get_trilisting_option( 'trilisting_placessearch_page_theme' ) );
			if ( $search_page_id ) {
				update_post_meta( $search_page_id, '_customify_content_layout', 'full-stretched' );
				update_post_meta( $search_page_id, '_wp_page_template', 'page-full-width.php' );
				update_post_meta( $search_page_id, '_customify_sidebar', 'content' );
			}
		}
	}

	/**
	 * Get asset suffix `.min` or empty if WP_DEBUG enabled.
	 * 
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_asset_suffix() {
		return '';
	}

	/**
	 * Get theme style.css url.
	 *
	 * @since 1.0.0
	 * 
	 * @return string
	 */
	public function get_style_uri() {
		$suffix     = $this->get_asset_suffix();
		$style_dir  = get_stylesheet_directory();
		$suffix_css = $suffix;
		$css_file   = false;
		$min_file   = $style_dir . '/style' . $suffix_css . '.css';
		if ( file_exists( $min_file ) ) {
			$css_file = esc_url( get_stylesheet_directory_uri() ) . '/style' . $suffix_css . '.css';
		}

		return $css_file;
	}

	/**
	 * Enqueue styles.
	 * 
	 * @since 1.0.0
	 * 
	 * @param array $css_files
	 * @return void
	 */
	public function enqueue_styles( array $css_files ) {
		if ( empty( $css_files ) ) {
			return;
		}

		foreach ( $css_files as $id => $url ) {
			$deps = [];
			if ( is_array( $url ) ) {
				$arg = wp_parse_args(
					$url,
					[
						'deps' => [],
						'url'  => '',
						'ver'  => self::$version,
					]
				);
				wp_enqueue_style( 'bizdir-' . $id, $arg['url'], $arg['deps'], $arg['ver'] );
			} elseif ( $url ) {
				wp_enqueue_style( 'bizdir-' . $id, $url, $deps, self::$version );
			}
		}
	}

	/**
	 * Enqueue scripts.
	 * 
	 * @since 1.0.0 
	 * 
	 * @param array $js_files
	 * @return void
	 */
	public function enqueue_scripts( array $js_files ) {
		if ( empty( $js_files ) ) {
			return;
		}

		foreach ( $js_files as $id => $arg ) {
			$deps = [];
			$ver  = '';
			if ( is_array( $arg ) ) {
				$arg = wp_parse_args(
					$arg,
					[
						'deps' => '',
						'url'  => '',
						'ver'  => '',
					]
				);

				$deps = $arg['deps'];
				$url  = $arg['url'];
				$ver  = $arg['ver'];
			} else {
				$url = $arg;
			}

			if ( ! $ver ) {
				$ver = self::$version;
			}

			wp_enqueue_script( $id, $url, $deps, $ver, true );
		}
	}

	/**
	 * Enqueue scripts and styles.
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function scripts() {
		$suffix = $this->get_asset_suffix();
		$css_files = [ 'style' => $this->get_style_uri() ];
		$this->enqueue_styles( $css_files );

		if ( wp_style_is( 'font-awesome' ) ) {
			wp_deregister_style( 'font-awesome' );
		}

		$js_files = [
			'bizdir-themejs' => [
				'url' => esc_url( get_stylesheet_directory_uri() ) . '/assets/js/theme' . $suffix . '.js',
				'ver' => self::$version,
			],
		];
		$this->enqueue_scripts( $js_files );
	}

	/**
	 * Enqueue scripts and styles.
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function admin_scripts() {
		wp_enqueue_style(
			'bizdir-admin',
			esc_url( get_stylesheet_directory_uri() ) . '/assets/css/admin.css',
			[],
			self::$version
		);
	}

	/**
	 * Include files.
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	private function includes() {
		$files = [
			'/inc/compatibility/trilisting.php',
			'/inc/tgm/functions.php',
			'/inc/functions.php',
		];

		foreach ( $files as $file ) {
			require_once self::$path . $file;
		}
	}
}
