<?php
/**
* Template Name: Shop Our Clients (SERVICES)
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
/*
add_action ( 'gensis_before_sidebar_widget_area','search_shop');
    
function search_shop() {
    genesis_widget_area( 'shop_search' );
            //'before' => '<div id="cta"><div class="wrap">',
			//'after' => '</div></div>',
		
    }

*/

add_action( 'genesis_before_loop','services_title');

function services_title() {
    echo '<h1>Services</h1>';
}


/*add_action( 'genesis_loop', 'profile_thumbs');

function profile_thumbs() {
    echo do_shortcode("[pt_view id=363658eb30]");
}*/

add_action( 'genesis_loop', 'profile_loop');

function profile_loop() {
    $args = array(
        'category_name' => 'services',
		'orderby'       => 'title',
		'order'         => 'ASC',
		'posts_per_page'=> '-1', // overrides posts per page in theme settings
	);
    
    $loop = new WP_Query( $args );
	if( $loop->have_posts() ) {
		// loop through posts
		while( $loop->have_posts() ): $loop->the_post();
        
        //$categoryArray = get_the_category();
        
        //$categoryValues = get_the_category();
        //echo $categoryValues[0];
        
        //$category_name = get_the_category();
        
echo '<a href="' . get_permalink() . '">';
        
        echo '<div class="profile-thumb">';
        
            echo  '<a href="' . get_permalink() . '" target="_blank">' . the_post_thumbnail() . '</a>';
        
            foreach(get_the_category() as $category) { 
                echo '<a href="' . get_permalink() . '">';
                echo '<div class="' . str_replace(" ","-",$category->name) . ' profile-title">';
                break;}
        
            foreach(get_the_category() as $category) {
                echo $category->name . ' ';}
        
            echo  '<h4>' . get_the_title() . '</h4>';
            
		echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</a>';
		endwhile;
	}
	wp_reset_postdata();
}

genesis();

