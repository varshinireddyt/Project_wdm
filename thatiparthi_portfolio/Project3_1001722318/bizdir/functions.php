<?php 
/**
 * Include the main BizDir class.
 * 
 * @package bizdir
 */
include_once get_stylesheet_directory() . '/inc/class-bizdir.php';

if ( ! function_exists( 'BizDir' ) ) {
	/**
	 * Main instance of BizDir.
	 *
	 * Returns the main instance of BizDir.
	 *
	 * @return BizDir
	 */
	function BizDir() {
		return BizDir::get_instance();
	}
}

BizDir();
