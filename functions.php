<?php
/**
 * gh functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gh
 */

if ( ! function_exists( 'gh_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gh_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on gh, use a find and replace
	 * to change 'gh' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'gh', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'gh' ),
	) );

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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gh_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'gh_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gh_content_width', 640 );
}
add_action( 'after_setup_theme', 'gh_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gh_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gh' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gh' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gh_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gh_scripts() {

    /*Add Google Fonts*/
    wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700');

    wp_enqueue_style( 'googleFonts');

    /*Add bootstrap styles*/
    wp_register_style('bootstrap', get_template_directory_uri() . '/vendors/bootstrap/dist/css/bootstrap.min.css' );

    wp_enqueue_style('bootstrap');



    /*Default style.css file*/
	wp_enqueue_style( 'gh-style', get_stylesheet_uri() );


    wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'gh-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'gh-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	/*Add vendors scripts*/
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/vendors/bootstrap/dist/js/bootstrap.min.js' );

    wp_enqueue_script( 'Awesome', 'https://use.fontawesome.com/34414cec8f.js' );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gh_scripts' );

/**
 * Add custom post type
 */

/*function add_post_type() {  // change function name
    register_post_type( 'post-type-name', // add your post type name (for all fields array)
        array(
            'labels' => array(
                'name' => 'post-type-name',
                'singular_name' => 'post-type-name',
                'add_new' => 'Add New',
                'add_new_item' => 'Add post-type-name',
                'edit' => 'Edit',
                'edit_item' => 'Edit post-type-name',
                'new_item' => 'New post-type-name',
                'view' => 'View',
                'view_item' => 'View post-type-name',
                'search_items' => 'Search',
                'not_found' => 'No found',
                'not_found_in_trash' => 'No in Trash',
                'parent' => 'Parent'
            ),
            'public' => true,
            'menu_position' => 8, // Admin menu position
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
            'has_archive' => true
        )
    );
    flush_rewrite_rules();
}

add_action( 'init', 'add_post_type' );*/

/**
* Custom words count in preview posts
 */


/*function new_excerpt_length($length) {  // change words number in preview posts
    return 7;
}
add_filter('excerpt_length', 'new_excerpt_length');


add_filter('excerpt_more', function($more) {  //remove [...] in the_excerpt
    return '';
});*/



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
