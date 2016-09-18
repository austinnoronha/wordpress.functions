<?php
# Wordpress functions:
# note: your can replace the app_ with your theme extension
# get_stylesheet_uri() - stylesheet uri
# get_template_directory_uri() - templates dir uri
# enqueue styles - wp_enqueue_style( string $handle, string $src = false, array $deps = array(), string|bool|null $ver = false, string $media = 'all' )
# Add style data - wp_style_add_data( string $handle, string $key, mixed $value ) - Possible values for $key and $value: ‘conditional’ string Comments for IE 6, lte IE 7 etc. 


/* -------------------------------------------------------------- */

/**
 * @func Update Post URLs 
 * @desc This must be used when you want to update the site URLs once gone on production
 * @param (string) $url
 * @return (boolean) true
*/
function app_update_post_urls($url=""){
	if(empty($url)) return false;
	update_option('siteurl',$url);
	update_option('home',$url);
	return true;
}


/* -------------------------------------------------------------- */

/**
 * App setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is the proper hook to use when enqueuing items 
 * that are meant to appear on the front end. Despite the name, it is used for enqueuing both scripts and styles.
 */
if ( ! function_exists( 'app_setup' ) ) :
	function app_setup() {
		//Load our main stylesheet.
		wp_enqueue_style( 'app-style-com', get_template_directory_uri() . '/css/wpcommon.php', array(), '20160912' );
		
		// Load the Internet Explorer specific stylesheet.
		wp_enqueue_style( 'app-ie', get_template_directory_uri() . '/css/ie.css', array( 'app-style'), '20160912' );
		wp_style_add_data( 'app-ie', 'conditional', 'lt IE 9' );

		wp_enqueue_script('jquery');
		wp_enqueue_script( 'app-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160912', true );
	}
endif; //app_setup
add_action( 'after_setup_theme', 'app_setup' );

/* -------------------------------------------------------------- */

/**
 * App Scriprs
 *
 * Set up theme scripts and styles 
 *
 * Note that this function is hooked into the wp_enqueue_scripts hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 */
if ( ! function_exists( 'app_scripts' ) ) :
	function app_scripts() {
		//This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'css/wpcommon.css' ) );

		//Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		// Enable support for HTML5 markup.
		add_theme_support( 'html5', array(
											'comment-list',
											'search-form',
											'comment-form',
											'gallery',
											));
	}
endif; //app_setup
add_action( 'wp_enqueue_scripts', 'app_scripts' );

/* -------------------------------------------------------------- */

/**
 * @func Wordpress Custom Title
 * @desc Create a nicely formatted and more specific title element text for output
 *			in head of document, based on current view.
 * @param (string) $title Default title text for current view.
 * @param (string) $sep Optional separator.
 * @return (string) The filtered title.
*/
function app_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'app' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'app_wp_title', 10, 2 );

/* -------------------------------------------------------------- */

/**
 * @func Custom Favicon
 * @desc -
 * @return (string) Meta HTML
*/
function app_site_favicon() {
	$tmp = '<link rel="shortcut icon" href="' . get_bloginfo('template_directory') . '/images/iconified/favicon.ico" type="image/x-icon" />
			<link rel="apple-touch-icon" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon.png" />
			<link rel="apple-touch-icon" sizes="57x57" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-57x57.png" />
			<link rel="apple-touch-icon" sizes="72x72" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-72x72.png" />
			<link rel="apple-touch-icon" sizes="76x76" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-76x76.png" />
			<link rel="apple-touch-icon" sizes="114x114" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-114x114.png" />
			<link rel="apple-touch-icon" sizes="120x120" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-120x120.png" />
			<link rel="apple-touch-icon" sizes="144x144" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-144x144.png" />
			<link rel="apple-touch-icon" sizes="152x152" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-152x152.png" />';

	echo $tmp;
}
add_action('wp_head', 'app_site_favicon');

/* -------------------------------------------------------------- */
 
/**
 * @func Custom Admin Favicon
 * @desc -
 * @return (string) Meta HTML
*/
function app_admin_favicon() {
	$tmp = '<link rel="shortcut icon" href="' . get_bloginfo('template_directory') . '/images/iconified/favicon.ico" type="image/x-icon" />
			<link rel="apple-touch-icon" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon.png" />
			<link rel="apple-touch-icon" sizes="57x57" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-57x57.png" />
			<link rel="apple-touch-icon" sizes="72x72" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-72x72.png" />
			<link rel="apple-touch-icon" sizes="76x76" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-76x76.png" />
			<link rel="apple-touch-icon" sizes="114x114" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-114x114.png" />
			<link rel="apple-touch-icon" sizes="120x120" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-120x120.png" />
			<link rel="apple-touch-icon" sizes="144x144" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-144x144.png" />
			<link rel="apple-touch-icon" sizes="152x152" href="' . get_bloginfo('template_directory') . '/images/iconified/apple-touch-icon-152x152.png" />';

	echo $tmp;
}
add_action('admin_head', 'app_admin_favicon');

/* -------------------------------------------------------------- */

/**
 * @func Customize admin footer text
 * @desc -
 * @return (string) Meta HTML
*/
function app_custom_admin_footer() {
        echo 'Blog by <a href="https://wordpress.org/">Wordpress</a> and customized by <a href="#">Austin</a>';
} 
add_filter('admin_footer_text', 'app_custom_admin_footer');

/* -------------------------------------------------------------- */

/**
 * @func Displays the no.of mysql queries and its performance
 * @desc This will show the Mysql Stat and memory info. in HTML Comments only in Admin loggedin
 * @return (string) HTML
*/
function app_performance( $visible = false ) {

    $stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
        get_num_queries(),
        timer_stop( 0, 3 ),
        memory_get_peak_usage() / 1024 / 1024
        );

    echo $visible ? $stat : "<!-- {$stat} -->" ;
}

if ( is_user_logged_in() && is_admin_bar_showing() ) {
	add_action( 'wp_footer', 'app_performance', 20, true );
}

/* -------------------------------------------------------------- */

/**
 * @func Google Analytcs
 * @desc Add Google Analytics Tracking Code at footer
 * @return (string) HTML
*/
function app_google_analytics() { ?>

<?php }
add_action('wp_footer', 'app_google_analytics');

/* -------------------------------------------------------------- */

/**
 * @func Set Real IP
 * @desc Gets the user's real IP address
 * @return (string) IP
*/
function app_get_real_ip_address( $validate = true ) {
    if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ips[count($ips) - 1]);
    } elseif ( isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP']) ) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    } elseif ( isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) ) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if ( $validate && function_exists('filter_var') &&  filter_var($ip, FILTER_VALIDATE_IP, array('flags' => FILTER_FLAG_IPV4, FILTER_FLAG_NO_PRIV_RANGE, FILTER_FLAG_NO_RES_RANGE)) )
        return $ip;
    elseif ( $validate )
        return long2ip(ip2long($ip));

    return $ip;
}
//$_SERVER['REMOTE_ADDR'] = app_get_real_ip_address();

/* -------------------------------------------------------------- */

/**
 * @func Set Custom Logo
 * @desc -
 * @return (string) Style CSS
*/
function app_custom_admin_logo() {
    echo '
        <style type="text/css">
            #header-logo { background-image: url('.get_bloginfo('template_directory').'/img/logo.jpg) !important; }
        </style>
    ';
}
add_action('admin_head', 'app_custom_admin_logo');

/* -------------------------------------------------------------- */

/**
 * @func Set Custom Logo in login page
 * @desc -
 * @return (string) Style CSS
*/
function app_custom_login_logo() {
    echo '<style type="text/css">
        .login h1 a { background-image:url('.get_bloginfo('template_directory').'/img/logo.jpg) !important; background-size: auto !important; width: 228px !important; height: 53px !important; }
    </style>';
}
add_action('login_head', 'app_custom_login_logo');

/* -------------------------------------------------------------- */

/**
 * @func Set Custom Url Title in login page
 * @desc -
 * @return (string)
*/
function app_login_logo_url_title() {
    return 'Custom Website Name - Blog';
}
add_filter( 'login_headertitle', 'app_login_logo_url_title' );
 
/* -------------------------------------------------------------- */

/**
 * @func Set Custom Gravatar
 * @desc Replace Default Gravatar with Custom Image
 * @return (string) Image
*/
function app_custom_gravatar($avatar_defaults) {
    $logo = get_bloginfo('template_directory') . '/images/iconified/favicon.ico'; //Change to whatever path you like.
    $avatar_defaults[$logo] = get_bloginfo('name');
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'app_custom_gravatar' );

/* -------------------------------------------------------------- */

/**
 * @func Set Featured Image
 * @desc Adding Featured Image Support to Your Theme
 * @return -
*/
function app_featured_image_theme_support() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'app_featured_image_theme_support' );

/* -------------------------------------------------------------- */

/**
 * @func Set nav menu config
 * @desc This theme uses wp_nav_menu() in one location.
 * @return -
*/
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'app' ),
	'secondary-sub-nav' => __( 'Secondary Menu', 'app' ),
	'left-bar-nav' => __( 'Left Bar Menu', 'app' ),
	'footer-links' => __( 'Footer Links', 'app' ) // secondary nav in footer

) );

/* -------------------------------------------------------------- */

/**
 * @func Register widgets
 * @desc Register widgetized area and update sidebar with default widgets.
 * @return -
*/
function app_widgets_init() {
  	register_sidebar( array(
  		'name'          => __( 'Sidebar', 'app' ),
  		'id'            => 'sidebar-1',
  		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  		'after_widget'  => '</aside>',
  		'before_title'  => '<h3 class="widget-title">',
  		'after_title'   => '</h3>',
  	) );

    register_sidebar(array(
    	'id' => 'home-widget-1',
    	'name' => __( 'Homepage Widget 1', 'app' ),
    	'description' => __( 'Displays on the Home Page', 'app' ),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgettitle">',
    	'after_title' => '</h3>',
    ));

    register_sidebar(array(
    	'id' => 'footer-widget-1',
    	'name' =>  __( 'Footer Widget 1', 'app' ),
    	'description' =>  __( 'Used for footer widget area', 'app' ),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="widgettitle">',
    	'after_title' => '</h3>',
    ));
}
add_action( 'widgets_init', 'app_widgets_init' );

/* -------------------------------------------------------------- */

/**
 * @func Excerpt Ending
 * @desc -
 * @return (string) 
*/
function app_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'app_excerpt_more');

