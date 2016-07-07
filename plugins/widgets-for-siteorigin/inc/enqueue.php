<?php

// Enqueueing Backend CSS File
function wpinked_so_admin_style() {
	wp_enqueue_style( 'iw-admin-style', plugin_dir_url( __FILE__ ) . '../statics/admin.css', array(), INKED_SO_WIDGETS );
}
add_action('admin_enqueue_scripts', 'wpinked_so_admin_style' );

// Register style sheet.
function wpinked_so_register_styles() {
	// Registering Javascript Files
	wp_register_script( 'iw-mixitup-js', plugin_dir_url(__FILE__) . '../statics/mixitup.min.js', array( 'jquery' ), INKED_SO_WIDGETS, true );
	wp_register_script( 'iw-modernizr-js', plugin_dir_url(__FILE__) . '../statics/modernizr.js', array( ), INKED_SO_WIDGETS, false );
	wp_register_script( 'iw-foundation-js', plugin_dir_url(__FILE__) . '../statics/foundation.js', array( 'jquery', 'iw-modernizr-js' ), INKED_SO_WIDGETS, true );
	wp_register_script( 'iw-equalizer-js', plugin_dir_url(__FILE__) . '../statics/equalizer.js', array( 'iw-foundation-js' ), INKED_SO_WIDGETS, true );
	wp_register_script( 'iw-waypoint-js', plugin_dir_url(__FILE__) . '../statics/waypoints.js', array( 'jquery' ), INKED_SO_WIDGETS, true );
	wp_register_script( 'iw-countto-js', plugin_dir_url(__FILE__) . '../statics/countto.js', array( 'jquery' ), INKED_SO_WIDGETS, true );

	// Enqueueing CSS Files
	wp_enqueue_style( 'iw-defaults', plugin_dir_url(__FILE__) . '../statics/defaults.css', array(), INKED_SO_WIDGETS );
}
add_action( 'wp_enqueue_scripts', 'wpinked_so_register_styles' );
