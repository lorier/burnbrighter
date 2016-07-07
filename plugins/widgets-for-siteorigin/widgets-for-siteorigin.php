<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Widgets for SiteOrigin
 * Plugin URI:        https://wpinked.com/
 * Description:       A few more widgets to play around with. Built on top of the SiteOrigin Widgets Bundle.
 * Version:           1.2.2
 * Author:            wpinked
 * Author URI:        wpinked.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpinked-widgets
 * Domain Path:       /languages
 *
 * @link              wpinked.com
 * @since             1.0.0
 * @package           Widgets_For_SiteOrigin
 *
 */

define('INKED_SO_WIDGETS', '1.2.2');

require_once ( 'inc/visibility.php' );

require_once ( 'inc/enqueue.php' );

require_once ( 'inc/functions.php' );

// Widgets.... Come out and play!
function wpinked_so_widgets_collection($folders){
	$folders[] = plugin_dir_path(__FILE__) . '/widgets/';
	return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'wpinked_so_widgets_collection');

// Placing all widgets under the 'Widgets for SiteOrigin' Tab
function wpinked_so_add_widget_tabs($tabs) {
	$tabs[] = array(
		'title' => __('Widgets for SiteOrigin', 'wpinked-widgets'),
		'filter' => array(
			'groups' => array('widgets-for-so')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'wpinked_so_add_widget_tabs', 20);

// Adding Icon for all Widgets
function wpinked_so_widget_add_bundle_groups($widgets){
	foreach( $widgets as $class => &$widget ) {
		if( preg_match('/Inked_(.*)_SO_Widget/', $class, $matches) ) {
			$widget['icon'] = 'wpinked-widget dashicons dashicons-editor-code';
			$widget['groups'] = array('widgets-for-so');
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'wpinked_so_widget_add_bundle_groups', 11);

// Making the plugin translation ready
function wpinked_so_translation() {
	load_plugin_textdomain( 'wpinked_widgets', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'wpinked_so_translation');

/**
 * This clears the file cache.
 *
 * @action admin_init
 */
function wpinked_so_plugin_version_check(){

	$active_version = get_option( 'wpinked_so_widgets_version' );

	if( empty($active_version) || version_compare( $active_version, INKED_SO_WIDGETS, '<' ) ) {
		// If this is a new version, then clear the cache.
		update_option( 'wpinked_so_widgets_version', INKED_SO_WIDGETS );

		// Remove all cached CSS for SiteOrigin Widgets
		if( function_exists('WP_Filesystem') && WP_Filesystem() ) {
			global $wp_filesystem;
			$upload_dir = wp_upload_dir();

			// Remove any old widget cache files, if they exist.
			$list = $wp_filesystem->dirlist( $upload_dir['basedir'] . '/siteorigin-widgets/' );
			if( !empty($list) ) {
				foreach($list as $file) {
					// Delete the file
					$wp_filesystem->delete( $upload_dir['basedir'] . '/siteorigin-widgets/' . $file['name'] );
				}
			}
		}

		// An action to let widgets handle the updates.
		do_action( 'siteorigin_widgets_version_update', INKED_SO_WIDGETS, $active_version );
	}

}
add_action( 'admin_init', 'wpinked_so_plugin_version_check' );
