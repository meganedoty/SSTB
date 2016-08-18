<?php

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Start Small Think Big' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//*Add support for post thumbnails
add_theme_support( 'post-thumbnails' ); 

//* Add slider after header
add_action( 'genesis_after_header', 'gc_slider_genesis' );

//** Add the featured image section 
add_action( 'genesis_after_header', 'full_featured_image' );
function full_featured_image() {
    if ( is_page(array( 8,139 ) )  && has_post_thumbnail() ){
        echo '<div id="full-image">';
        echo get_the_post_thumbnail($thumbnail->ID, 'header');
        echo '</div>';  
    }    
}

/** Add new image sizes */
add_image_size( 'header', 1600, 9999, TRUE );

/** Register widget areas */
genesis_register_sidebar( array(
'id'    => 'slider-1',
'name'    => __( 'Slider #1', 'gc' ),
'description'    => __( 'This is the slider section.', 'gc' ),
) ); 

function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'shop search',
		'id'            => 'shop_search',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

//* Add support for 4-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

/**
* Add slider support for site.
*
*/

function gc_slider_genesis() {
// Display the slider on the home page
if ( is_front_page()  ) {
    genesis_widget_area( 'slider-1', array(
'before' => '<div id="slider">',
'after' => '</div>',
) ); 
} 
}

//* Add jquery support for flipping cards

  wp_register_script ('flipcards', get_stylesheet_directory_uri() . '/js/flippingcards.js', array( 'jquery' ),'1',true);

  wp_enqueue_script('flipcards');
/*
add_action( 'wp_enqueue_scripts', 'genesis_all_scriptsandstyles' );
*/
//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//disable auto p
remove_filter (‘the_content’, ‘wpautop’);

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
?>
<p><a href="http://www.startsmallthinkbig.org/privacy-policy/" title="privacy policy" target="_blank" >PRIVACY POLICY</a> &copy; Copyright 2015 <a href="http://startsmallthinkbig.org/">Start Small Think Big</a> &middot; All Rights Reserved. &middot; 501(c)(3) organization. Tax identification number: 27-1821066.</p>
<?php
} 

//Script-tac-ulous -> All the Sidr JS and CSS files
function themeprefix_scripts_styles_slidebars() {
    wp_enqueue_script ( 'slidebarsjs' , get_stylesheet_directory_uri() . '/js/slidebars.min.js', array( 'jquery' ), '1', true );
    wp_enqueue_script ( 'slidebarsinit' , get_stylesheet_directory_uri() . '/js/slidebar-init.js', array( 'slidebarsjs' ), '1', true );

    wp_enqueue_style ( 'slidebarscss' , get_stylesheet_directory_uri() . '/css/slidebars.min.css', '', '1', 'all' );

}
add_action( 'wp_enqueue_scripts', 'themeprefix_scripts_styles_slidebars' ); 


//* Add in the required ID attribute for the page
function themeprefix_site_container_id( $attributes ) { 
 $attributes['id'] = 'sb-site';
 return $attributes;
}
add_filter( 'genesis_attr_site-container', 'themeprefix_site_container_id' );

// Register the 2 widgets used for the right and left slideout bars
function slidebars_widgets_init() {
    register_sidebar( array(
    'name'          => __( 'Left Slidebar', 'theme-slug' ),
    'id'            => 'slidebar-left',
    'description'   => __( 'Left SlideBar', 'theme-slug' ),
    'before_widget' => '<div class="">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'slidebars_widgets_init' );


// Position the widget outside of the normal layout
function slidebars_page_position() {
	echo '<div class="sb-slidebar sb-left">';
	dynamic_sidebar( 'slidebar-left' );
	echo '</div>'; 
}
add_action('genesis_before','slidebars_page_position');

function shopsmall_style_sheet() {
if ( is_page_template( 'shop-template.php' ) ) {
wp_enqueue_style( 'shop-styling', get_stylesheet_directory_uri() . '/css/shop_style-2.css' );
}}
add_action('wp_enqueue_scripts', 'shopsmall_style_sheet');

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Add new menu to Shop Our Clients
function register_my_menu() {
  register_nav_menu('category-menu',__( 'Client Category Menu' ));
}
add_action( 'init', 'register_my_menu' );


