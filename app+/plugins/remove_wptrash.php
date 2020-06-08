<?php
/**
 * @package Remove WP Trash
 * @version 1.0
 */
/*
Plugin Name: Remove WP Trash
Plugin URI: https://github.com/CrashXD/scope-wordpress/blob/master/wp-content/plugins/remove_wptrash.php
Description: Remove WP Trash like
Author: Markello
Version: 1.0
Author URI: https://markello.ru
*/

/**
 * Отключение ревизий
 */
function my_revisions_to_keep( $revisions ) {
    return 0;
}
add_filter( 'wp_revisions_to_keep', 'my_revisions_to_keep' );

/*
 * Скрыть версию WordPress
 */
function remove_wp_version() {
    return '';
}
add_filter('the_generator', 'remove_wp_version');

/**
 * Убрать версию WordPress из заголовка страницы:
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Убрать вывод ссылок на предыдущую / следующую запись:
 */
//remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

/**
 * Удаление смайликов из шапки
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Отключение RSS лент
 */
function fb_disable_feed() {
    wp_die( __('No feed available, please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}
add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'fb_disable_feed', 1);
add_action('do_feed_atom_comments', 'fb_disable_feed', 1);

/*
 * Убрать вывод ссылок на основную и дополнительную ленту:
 */
remove_action('wp_head','feed_links_extra', 3);

/**
 * Отключение REST API
 */
add_filter('rest_enabled', '__return_false');

/**
 * Отключение фильтров REST API
 */
//add_filter('xmlrpc_enabled', '__return_false');
remove_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
remove_action( 'wp_head',                    'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect',          'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

/**
 * Отключение событий REST API
 */
remove_action( 'init',          'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
remove_action( 'parse_request', 'rest_api_loaded' );

/**
 * Отключение Embeds связанные с REST API
 */
remove_action( 'rest_api_init',          'wp_oembed_register_route'              );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// если собираетесь выводить вставки из других сайтов на своем, то закомментируйте след. строку.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

/*
 * Убрать вывод ссылки REST API:
 */
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');

/**
 * Убрать ссылку для редактирования клиентом Windows Live Writer:
 */
remove_action( 'wp_head', 'wlwmanifest_link' );

/**
 * Убрать ссылку для редактирования внешними сервисами:
 */
remove_action( 'wp_head', 'rsd_link' );

/**
 * Удалить из шапки короткую ссылку на статью
 */
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

?>
