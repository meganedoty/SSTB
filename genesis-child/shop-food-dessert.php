<?php
/**
* Template Name: Shop Our Clients (SUBCATEGORIES)
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Genesis Office Hours" category
*/
// Add our custom loop


add_action( 'genesis_before_content_sidebar_wrap', 'profile_slides' );
    
function profile_slides() { 
    echo do_shortcode("[metaslider id=1263]");
}

    
add_action( 'genesis_before_content','category_nav');

function category_nav() {
    wp_nav_menu( array( 'theme_location' => 'category-menu' ) );
}

add_action ( 'gensis_before_content','shop_search');
    
function search_shop() {
    echo '<div id="cta"><div class="wrap">';
    genesis_widget_area( 'shop_search' );            
    echo '</div></div>';
		
    }
add_action( 'genesis_before_loop','services_title');

function services_title() {
    echo '<h1>' .  get_the_title() . '</h1>';
}

/*add_action( 'genesis_loop', 'profile_thumbs');

function profile_thumbs() {
    echo do_shortcode("[pt_view id=302029b633]");
}*/

add_action( 'genesis_loop', 'profile_loop');

function profile_loop() {
    //$page-cat = get_the_category();
    if (is_page( 1719 ) ) {
        $cat_name = "dessert-baked-goods";
    } elseif (is_page( 'full-service-meals' )) {
        $cat_name = "full-service-meals";
    } elseif (is_page( 'juice-health-food' )) {
        $cat_name = "juice-health-food";
    } elseif (is_page( 'other-specialty-items' )) {
        $cat_name = "other-specialty-items";
    } elseif (is_page( 'chocolate-confections' )) {
        $cat_name = "chocolate-confections";
    } elseif (is_page( 'clothing-jewelry-accessories')) {
        $cat_name = "clothing-jewelry-accessories";
    } elseif (is_page( 'electronics-technology' )) {
        $cat_name = "electronics-technology";
    } elseif (is_page( 'arts-media' )) {
        $cat_name = "arts-media";
    } elseif (is_page( 'business-legal' )) {
        $cat_name = "business-legal";
    } elseif (is_page( 'children-education' )) {
        $cat_name = "children-education";
    } elseif (is_page( 'health-personal-care' )) {
        $cat_name = "health-personal-care";
    } elseif (is_page( 'home-garden' )) {
        $cat_name = "home-garden";
    } elseif (is_page( 'internet-social-media' )) {
        $cat_name = "internet-social-media";
    } elseif (is_page( 'other' )) {
        $cat_name = "other";
    } elseif (is_page( 'pets' )) {
        $cat_name = "pets";
    } 

    $args = array(
        'category_name' => $cat_name,
		'orderby'       => 'title',
		'order'         => 'ASC',
		'posts_per_page'=> '-1', // overrides posts per page in theme settings
	);
    
    $loop = new WP_Query( $args );
	if( $loop->have_posts() ) {
		// loop through posts
		while( $loop->have_posts() ): $loop->the_post();
        
            foreach(get_the_category() as $category) { 
                if($category->name == 'goods' || $category->name == 'food and restaurants' || $category->name == 'services' ){

                echo '<a href="' . get_permalink() . '">';        
                echo '<div class="profile-thumb">';
                echo  '<a href="' . get_permalink() . '" target="_blank">' . the_post_thumbnail() . '</a>';
                echo '<a href="' . get_permalink() . '">';
                echo '<div class="' . str_replace(" ","-",$category->name) . ' ' . ' profile-title">';
                echo $category->name ;
                echo  '<h4>' . get_the_title() . '</h4>';

                echo '</div></div></a></a>';
                }
        }
		endwhile;
	} else {
        echo '<p>It looks like there is nothing here!</p>';
    }
	wp_reset_postdata();
}



genesis();