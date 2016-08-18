<?php
/**
* Template Name: Shop Our Clients (ALL)
* Description: Template for loop displaying all Shop Our Clients posts.
*/
// Add our custom loop


add_action( 'genesis_before_content_sidebar_wrap', 'profile_slides' );
    
function profile_slides() { 
    echo do_shortcode("[metaslider id=1263]");
}

add_action( 'genesis_before_content','category_nav');

function category_nav() {
    wp_nav_menu( array( 'theme_location' => 'category-menu' ) );
    get_search_form();
}

add_action ( 'gensis_before_content','search_shop');
    
function search_shop() {
//    wp_nav_menu( array('theme_location' => 'shop_search' ) );

   genesis_widget_area( 'shop_search' )->theme_location == 'category-menu';
            //'before' => '<div id="cta"><div class="wrap">',
			//'after' => '</div></div>',
		
    }
add_action( 'genesis_before_loop','services_title');

function services_title() {
    echo '<h1>Shop Our Clients</h1>';
}

add_action( 'genesis_loop', 'profile_loop');

function profile_loop() {
    $args = array(
        'category_name' => 'shop-our-clients',
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
                    echo $category->name . ' ';
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

