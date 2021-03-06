<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */

	// Options Framework (https://github.com/devinsays/options-framework-plugin)
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/_/inc/' );
		require_once dirname( __FILE__ ) . '/_/inc/options-framework.php';
	}

	// Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_setup() {
		load_theme_textdomain( 'html5reset', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status' ) );
		register_nav_menus( array(
            'primary'=> __( 'Navigation Menu', 'html5reset' ),
            'social' => __( 'Social Menu', 'html5reset' ),
        ));
		add_theme_support( 'post-thumbnails' );
	}
	add_action( 'after_setup_theme', 'html5reset_setup' );

	// Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_scripts_styles() {
		global $wp_styles;

		// Load Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		// Load Stylesheets
		wp_enqueue_style( 'html5reset-reset', get_template_directory_uri() . '/reset.css' );
		wp_enqueue_style( 'html5reset-style', get_stylesheet_uri() );
        wp_enqueue_style( 'html5reset-style-googlefonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,700|Source+Sans+Pro:400,600,700|Noto+Sans:400,700|Droid+Sans:400,700|PT+Sans:400,700|Oxygen:400,700');
        wp_enqueue_style( 'html5reset-style-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

		// Load IE Stylesheet.
//		wp_enqueue_style( 'html5reset-ie', get_template_directory_uri() . '/css/ie.css', array( 'html5reset-style' ), '20130213' );
//		$wp_styles->add_data( 'html5reset-ie', 'conditional', 'lt IE 9' );

		// Modernizr
		// This is an un-minified, complete version of Modernizr. Before you move to production, you should generate a custom build that only has the detects you need.
		// wp_enqueue_script( 'html5reset-modernizr', get_template_directory_uri() . '/_/js/modernizr-2.6.2.dev.js' );

	}
	add_action( 'wp_enqueue_scripts', 'html5reset_scripts_styles' );

//load the following .js only on the home page
    function my_scripts_method() {
        wp_enqueue_script(
            'custom-script',
            get_template_directory_uri() . '/_/js/custom_script.js',
            array('jquery')
        );
    }
    if( is_front_page ) add_action('wp_enqueue_scripts', 'my_scripts_method');

    //load the following .js only on the project post-types
    function project_scripts_method() {
        wp_enqueue_script(
            'project-script',
            get_template_directory_uri() . '/_/js/project_script.js',
            array('jquery')
        );
    }
    //if(is_page( 'Home' ) ) add_action('wp_enqueue_scripts', 'my_scripts_method');
    //if(is_single( 'Random Letter and Font App' )) add_action('wp_enqueue_scripts', 'project_scripts_method');
    if(is_singular ( 'project' ) ) add_action('wp_enqueue_scripts', 'project_scripts_method');


	// WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

//		 Add the site name.
		$title .= get_bloginfo( 'name' );

//		 Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

//		 Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'html5reset' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'html5reset_wp_title', 10, 2 );




//OLD STUFF BELOW


	// Load jQuery
	if ( !function_exists( 'core_mods' ) ) {
		function core_mods() {
			if ( !is_admin() ) {
				wp_deregister_script( 'jquery' );
				wp_register_script( 'jquery', ( "http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ), false);
				wp_enqueue_script( 'jquery' );
			}
		}
		add_action( 'wp_enqueue_scripts', 'core_mods' );
	}

	// Clean up the <head>, if you so desire.
	//	function removeHeadLinks() {
	//    	remove_action('wp_head', 'rsd_link');
	//    	remove_action('wp_head', 'wlwmanifest_link');
	//    }
	//    add_action('init', 'removeHeadLinks');

	// Custom Menu
	register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );

	// Widgets
	if ( function_exists('register_sidebar' )) {
		function html5reset_widgets_init() {
			register_sidebar( array(
				'name'          => __( 'Sidebar Widgets', 'html5reset' ),
				'id'            => 'sidebar-primary',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
		add_action( 'widgets_init', 'html5reset_widgets_init' );
	}

	// Navigation - update coming from twentythirteen
	function post_navigation() {
		echo '<div class="navigation">';
		echo '	<div class="next-posts">'.get_next_posts_link('&laquo; Older Entries').'</div>';
		echo '	<div class="prev-posts">'.get_previous_posts_link('Newer Entries &raquo;').'</div>';
		echo '</div>';
	}

	// Posted On
	function posted_on() {
		printf( __( '<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_author() )
		);
	}

/**
  * Custom post type for the project pages
  */
add_action( 'init', 'create_my_post_types' );

function create_my_post_types() {
 register_post_type( 'project', 
 array(
      'labels' => array(
      	'name' => __( 'project' ),
      	'singular_name' => __( 'project' ),
      	'add_new' => __( 'Add New' ),
      	'add_new_item' => __( 'Add New project' ),
      	'edit' => __( 'Edit' ),
      	'edit_item' => __( 'Edit project' ),
      	'new_item' => __( 'New project' ),
      	'view' => __( 'View project' ),
      	'view_item' => __( 'View project' ),
      	'search_items' => __( 'Search projects' ),
      	'not_found' => __( 'No projects found' ),
      	'not_found_in_trash' => __( 'No projects found in Trash' ),
      	'parent' => __( 'Parent project' ),
      ),
 'public' => true,
      'menu_position' => 4,
      'rewrite' => array('slug' => 'project'),
      'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
      'taxonomies' => array('category', 'post_tag'),
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
     )
  );
}

/* add link to all post thumbnails */

add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function my_post_image_html( $html, $post_id, $post_image_id ) {
	$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
	return $html;
}

function custom_conference_in_home_loop( $query ) {
 if ( is_home() && $query->is_main_query() )
 //$query->set( 'post_type', array( 'post', 'project') );
 $query->set( 'post_type', array('project') );
 return $query;
 }

add_filter( 'pre_get_posts', 'custom_conference_in_home_loop' );

?>
