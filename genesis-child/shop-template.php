<?php
/* 
Template Name: Shop
*/

//custom hooks below here...
/** Add custom header support */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100, 'textcolor' => '444', 'admin_header_callback' => 'minimum_admin_style' ) );

//* Remove the site title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

//* Unregister primary/secondary navigation menus
remove_theme_support( 'genesis-menus' );

genesis(); // <- everything important: make sure to include this. 

