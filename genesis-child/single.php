<?php
/**
* Template Name: Profile Page
* Description: Inidivdual clients showcase page
*/
// Add our custom loop


add_action('genesis_before_content_sidebar_wrap','return_nav');

function return_nav() {
    $referer = $_SERVER['HTTP_REFERER'];
   if (!$referer == '') {
      echo '<div class="back-button"><a href="' . $referer . '" title="Return to the previous page">Take Me Back!</a></div>';
   } else {
      echo '<div class="back-button"><a href="javascript:history.go(-1)" title="Return to the previous page">Take Me Back!</a></div>';
   }
}

add_action('genesis_before_entry','featured_main');

function featured_main() {
    echo '<div class="half-image">';
        echo genesis_get_image();
    echo '</div>';
}

add_action('genesis_entry_header','profile_name');

function profile_name() {
    
    echo  '<h1>' . get_the_title() . '</h4>';
}

remove_action('genesis_entry_footer','entry_meta');

/*add_action('genesis_entry_footer','profile_taxonomy');

function profile_taxonomy() {
    echo '<div class="profile-foot">';

    echo '<h5>CATEGORY</h5>';
    
        foreach(get_the_category() as $category) {
                echo $category->name . ' ';} 
    
    

    echo '</div>';
}*/

genesis();
