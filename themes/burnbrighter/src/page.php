<?php
/**
 * Plant Blog
 *
 * @author  Lorie Ransom
 * @license GPL-2.0+
 * @link    http://tinywhalecreative.com
 */
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

genesis();
