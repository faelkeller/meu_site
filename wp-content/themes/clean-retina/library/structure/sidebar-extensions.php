<?php
/**
 * Shows the sidebar content.
 *
 * @package 		Theme Horse
 * @subpackage 	Clean_Retina
 * @since 			Clean Retina 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/clean-retina
 */

add_action( 'cleanretina_sidebar', 'cleanretina_display_side_sidebar', 10 );
/**
 * Show widgets of side sidebar.
 *
 * Shows all the widgets that are dragged and dropped on the Side Sidebar.
 */
function cleanretina_display_side_sidebar() {
	// Calling the right sidebar
	global $options, $array_of_default_settings;
   $options = wp_parse_args( get_option( 'cleanretina_theme_options', array() ), cleanretina_get_option_defaults());
		$content_layout = $options['default_layout'];
	if ( class_exists( 'WooCommerce' ) && is_woocommerce() && $content_layout == 'right-sidebar' ){ 
		echo '<div id="secondary">';
		// Calling the right sidebar
		if ( is_active_sidebar( 'cleanretina_side_sidebar' ) ) :
			dynamic_sidebar( 'cleanretina_side_sidebar' );
		endif;
		echo '</div>';
	}elseif( class_exists( 'WooCommerce' ) && is_woocommerce() && $content_layout == 'left-sidebar' ){
		echo '<div id="secondary">';
		// Calling the left sidebar
		if ( is_active_sidebar( 'cleanretina_side_sidebar' ) ) :
			dynamic_sidebar( 'cleanretina_side_sidebar' );
		endif;
		echo '</div>';
	}
	if(!class_exists( 'WooCommerce' )){
	// Calling the right sidebar
		if ( is_active_sidebar( 'cleanretina_side_sidebar' ) ) :
			dynamic_sidebar( 'cleanretina_side_sidebar' );
		endif;
	}
	if(class_exists( 'WooCommerce' ) && !is_woocommerce()){
	// Calling the right sidebar
		if ( is_active_sidebar( 'cleanretina_side_sidebar' ) ) :
			dynamic_sidebar( 'cleanretina_side_sidebar' );
		endif;
	}
}
?>