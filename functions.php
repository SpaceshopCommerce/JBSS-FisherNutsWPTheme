<?php
require_once 'template-parts/featured-products.php';
require_once 'template-parts/faqs.php';
require_once 'template-parts/tips.php';
require_once 'template-parts/tips-mini.php';
require_once 'template-parts/product-image-grid.php';
require_once 'template-parts/recipe-nut-options.php';
require_once 'template-parts/nut-badges.php';
require_once 'template-parts/nut-extra-info.php';
require_once 'template-parts/more-products.php';
require_once 'template-parts/snack-options.php';
require_once 'template-parts/recipe-numbers.php';
require_once 'template-parts/recipe-directions.php';
require_once 'template-parts/recipe-share.php';
require_once 'template-parts/recipe-product-used.php';
require_once 'template-parts/more-recipes.php';
require_once 'template-parts/featured-recipes.php';
require_once 'template-parts/image-slide.php';

    function my_admin_scripts()
    {
        wp_enqueue_style('slickcss', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), false, 'all');
        wp_enqueue_style('slickthemecss', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', array(), false, 'all');


        wp_enqueue_style('maincss', get_stylesheet_directory_uri() . '/css/styles.css?v=' . time(), array(), false, 'all');
        wp_enqueue_style('fontscss', get_stylesheet_directory_uri() . '/css/fonts.css?v=' . time(), array(), false, 'all');
        wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-3.6.3.min.js', null, null, true );
        wp_enqueue_script('jQuery');

        wp_register_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', null, null, true );
        wp_enqueue_script('slick');

        wp_register_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js?v=' . time(), null, null, true );
        wp_enqueue_script('scripts');
    }

function year_shortcode () {
    $year = date_i18n ('Y');
    return $year;
}
add_shortcode ('year', 'year_shortcode');
add_action( 'wp_enqueue_scripts', 'my_admin_scripts' );

// register a new post thumbnail that is always 600px square
add_image_size( 'recipe-thumb', 600, 600, true ); // 600px wide and 600px high, cropped


//add_filter( 'site_status_tests', 'revert_async_loopback_requests_test', 10, 1 );
//
//function revert_async_loopback_requests_test( $test_type ) {
//    $test_type['async']['loopback_requests']['test'] = 'loopback_requests';
//    $test_type['async']['loopback_requests']['has_rest'] = false;
//
//    return $test_type;
//}



?>