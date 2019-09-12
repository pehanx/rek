<?php
/**
 * @package Fix Paged Page
 * @version 1.0
 */
/*
Plugin Name: Fix Paged Page
Plugin URI: https://github.com/CrashXD/scope-wordpress/blob/master/wp-content/plugins/fix_paged_page.php
Description: Fix bug like /contacts/page/4
Author: Markello
Version: 1.0
Author URI: https://markello.ru
*/

function fix_paged_page() {
	if ((is_page() || is_single() || is_front_page()) && (get_query_var('paged') || get_query_var('page'))) {
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
	}
}
add_action('template_redirect', 'fix_paged_page');

?>
