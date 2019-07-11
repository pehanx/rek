<?php
/**
 * wptemplate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wptemplate
 */

if ( ! function_exists( 'octotemplate_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function octotemplate_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on octotemplate, use a find and replace
         * to change 'octotemplate' to the name of your theme in all the template files.
         */
        //load_theme_textdomain( 'octotemplate', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        // add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif;
add_action( 'after_setup_theme', 'octotemplate_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*function octotemplate_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'octotemplate' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'octotemplate' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'octotemplate_widgets_init' );*/

/**
 * Enqueue scripts and styles.
 */
function octotemplate_scripts() {
    wp_enqueue_style( 'octotemplate-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'octotemplate_scripts' );

/**
 * Изменяет название главной страницы в хлебных крошках
 */
add_filter('bcn_breadcrumb_title', function($title, $type, $id) {
    if ($type[0] === 'home') {
        $title = get_the_title(get_option('page_on_front'));
    }
    return $title;
}, 42, 3);

/**
 * Убираем стандартный каноникал
 */
function seo_filter_canonical( $canonical ) {
    $object = get_queried_object();
    if ( is_archive() ) {
        return '';
    }
    return $canonical;
}
add_filter( 'wpseo_canonical', 'seo_filter_canonical' );

/**
 * Добавляем новый каноникал
 */
function seo_action_head( $head ) {
    $object = get_queried_object();
    if ( is_archive() ) {
        $ulr = get_url();
        $url = remove_pagination($url);
        $url = remove_query($url);
        echo '<link rel="canonical" href="'.$url.'" />'."\n";
    }
}
add_action( 'wp_head', 'seo_action_head' );