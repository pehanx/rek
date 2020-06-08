<?php
/**
 * Инициализация шаблона WP
 */
require get_parent_theme_file_path( '/includes/init.php' );

/**
 * Функции хелперы
 */
require get_parent_theme_file_path( '/includes/helpers.php' );

/**
 * Для более удобной работы с url
 */
require get_parent_theme_file_path( '/includes/url-helper.php' );

/**
 * Для более удобной работы с ACF
 */
require get_parent_theme_file_path( '/includes/acf-helper.php' );

/**
 * Для работы с датами
 */
require get_parent_theme_file_path( '/includes/smart-date.php' );

/**
 * Для работы с меню
 */
require get_parent_theme_file_path( '/includes/menu-helper.php' );

/**
 * Для работы с меню
 */
require get_parent_theme_file_path( '/includes/kama-excerpt.php' );

/**
 * Для вывода пагинации
 */
require get_parent_theme_file_path( '/includes/pagination-helper.php' );
/**
 * Для функций экспертов
 */
require get_parent_theme_file_path( '/includes/speaker-helper.php' );

/**
 * Константы
 */
define('PAGE_404_ID', 123);
define('PAGE_FRONT_ID', 15);
define('PAGE_JOIN_US_ID', 13);
define('PAGE_NEWS_ID', 7);
define('PAGE_EVENTS_ID', 9);
define('PAGE_MATERIALS_ID', 11);
define('PAGE_SPEAKERS_ID', 3343);

define('EVENTS_PER_PAGE', 12);
define('NEWS_PER_PAGE', 12);
define('SPEAKERS_PER_PAGE', 12);

/**
 * Убрать не нужные пункты из админки
 */
function octo_hide_menu() {
	// remove_menu_page( 'users.php' );                                      // Пользователи
	// remove_menu_page( 'edit.php' );                                       // Записи
	// remove_menu_page( 'edit.php?post_type=page' );                        // Страницы
	// remove_menu_page( 'index.php' );                                      // Консоль
	// remove_menu_page( 'upload.php' );                                     // Медиафайлы
	// remove_menu_page( 'edit-comments.php' );                              // Комментарии
	// remove_menu_page( 'themes.php' );                                     // Внешний вид
	// remove_menu_page( 'plugins.php' );                                    // Плагины
	// remove_menu_page( 'tools.php' );                                      // Инструменты
	// remove_menu_page( 'options-general.php' );                            // Параметры
	// remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' ); // Записи\Рубрики
	// remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); // Записи\Метки
}
add_action('admin_menu', 'octo_hide_menu');

/**
 * Подключить к админке пользовательские скрипты/стили
 */
function octo_custom_admin_head() {
	echo '<link rel="stylesheet" href="'.template().'static/css/style-admin.css" />';
	// echo '<script type="text/javascript" src="'.template().'static/js/script-admin.js"></script>';
}
add_action( 'admin_head', 'octo_custom_admin_head' );

/**
 * Количество записей на странице
 */
function custom_posts_per_page($query)
{
	$object = get_queried_object();

	if ($query->is_main_query() && !is_admin()) {

         if (is_search()) {
         	$query->set('posts_per_page', 6);
         }

        // if (is_post_type_archive('portfolio') ) {
        // 	$query->set('posts_per_page', 12);
        // }

        // if ((is_post_type_archive('portfolio') || is_tax('category_product')) ) {
        // 	$query->set('posts_per_page', 8);
        // }

    }
}
add_action('pre_get_posts', 'custom_posts_per_page');

/**
 * Вывод записей только из родительской рубрики
 */
// function octotemplate_only_parent_category($query) {
// 	if (!is_admin() && $query->is_main_query() && is_tax('taxonomy_name')) {
// 		$query->set('post_type', 'post_type_name');
// 		$query->set('posts_per_page', -1);
// 		$query->set('tax_query', array(
// 			'relation' => 'AND',
// 			array(
// 				'taxonomy' => 'taxonomy_name',
// 				'terms' => get_queried_object_id(),
// 				'include_children' => false,
// 			),
// 		));
// 	}
// }
// add_action('pre_get_posts', 'octotemplate_only_parent_category');

/**
 * Loadmore записей
 */
function loadmore()
{
	$args = unserialize(stripslashes($_POST['query']));
	$args['paged'] = $_POST['page'] + 1; // следующая страница
	$args['post_status'] = 'publish';
	$q = new WP_Query($args);

	if ($q->have_posts()): ?>
		<?php while ($q->have_posts()): $q->the_post();
			get_template_part('parts/list_element', 'post');
		endwhile; ?>
	<?php endif;
	wp_reset_postdata();
	wp_die();
}

add_action('wp_ajax_loadmore', 'loadmore');
add_action('wp_ajax_nopriv_loadmore', 'loadmore');

function loadmore_events()
{
	$args = unserialize(stripslashes($_POST['query']));
	$args['paged'] = $_POST['page'] + 1; // следующая страница
	$args['post_status'] = 'publish';
	$q = new WP_Query($args);

	if ($q->have_posts()): ?>
		<?php while ($q->have_posts()): $q->the_post();
			get_template_part('parts/list_element', 'event');
		endwhile; ?>
	<?php endif;
	wp_reset_postdata();
	wp_die();
}
add_action('wp_ajax_loadmore_events', 'loadmore_events');
add_action('wp_ajax_nopriv_loadmore_events', 'loadmore_events');

function loadmore_news()
{
	$args = unserialize(stripslashes($_POST['query']));
	$args['paged'] = $_POST['page'] + 1; // следующая страница
	$args['post_status'] = 'publish';
	$q = new WP_Query($args);
	if ($q->have_posts()): ?>
		<?php while ($q->have_posts()): $q->the_post();
			get_template_part('parts/list_element', 'news');
		endwhile; ?>
	<?php endif;
	wp_reset_postdata();
	wp_die();
}
add_action('wp_ajax_loadmore_news', 'loadmore_news');
add_action('wp_ajax_nopriv_loadmore_news', 'loadmore_news');


/**
 * Размеры изображений
 */
// remove_image_size('thumbnail');
// add_image_size('thumb', 178, 163, true);

/**
 * Объявление меню
 */
function octo_menu() {
	register_nav_menus( array(
	    'menu-header' => esc_html__( 'Верхнее меню', 'octotemplate' ),
	    'menu-footer' => esc_html__('Нижнее меню', 'octotemplate'),
	    'menu-language' => esc_html__('Языковое меню', 'octotemplate'),
	) );
}
add_action( 'after_setup_theme', 'octo_menu' );

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

add_action( 'after_setup_theme', function() {
    add_theme_support( 'pageviews' );
});