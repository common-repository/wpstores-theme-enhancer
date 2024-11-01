<?php
/*
Plugin Name: WPStores Theme Enhancer
Plugin URI: http://www.wpstores.net/wpstores-theme-enhancer/
Description: A plugin to enhance the functionalities of WPStores Themes
Version: 1.0
Author: Abhik
Author URI: http://www.itsabhik.com
License: GPL3
*/

/* Enqueue Our Stylesheet */
function wpstores_enqueue() {
	wp_enqueue_style( 'wpstores-te', plugins_url( 'lib/style.css' , __FILE__ ), '', '1.0', 'all' );
	wp_enqueue_style( 'ubuntu-te', '//fonts.googleapis.com/css?family=Ubuntu', '', '1.0', 'all' );
	wp_enqueue_script( 'cloudymag-tabber', plugins_url( 'lib/js/tabber.js' , __FILE__ ), '', '2.1' );
}
add_action( 'wp_enqueue_scripts', 'wpstores_enqueue' );

/**
 * Special Case Function
 * To Hide Tab Content as plain HTML
**/
function wpstores_hide_tabber() { ?>
		<script type="text/javascript">
			document.write('<style type="text/css">.tabber{display:none;}<\/style>');
		</script>
<?php }
add_action( 'wp_head', 'wpstores_hide_tabber', 1);

/**
 * Get Option.
 *
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 */

if ( ! function_exists( 'wpstores_option' ) ) {

	function wpstores_option( $name, $default = false ) {
		$config = get_option( 'optionsframework' );

		if ( ! isset( $config['id'] ) ) {
			return $default;
		}

		$options = get_option( $config['id'] );

		if ( isset( $options[$name] ) ) {
			return $options[$name];
		}

		return $default;
	}
}

/* Include Required Files */
include 'lib/social.php';
include 'lib/seo.php';
include 'lib/opengraph.php';
include 'lib/author.php';
include 'lib/sidebar.php';
?>