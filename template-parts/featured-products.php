<?php
/**
 * Adds new shortcode "Featured Products" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Featured_Products_Shortcode' ) ) {

    class VS_Featured_Products_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {

            // Registers the shortcode in WordPress
            add_shortcode('vs_feat_products', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_feat_products', __CLASS__ . '::map');
            }

        }

        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_feat_products', $atts);

            $args = array(
                'post_type' => 'recipe-nuts',
                'posts_per_page' => 4,
                'meta_query' => array(
                    array(
                        'key' => 'featured',
                        'value' => true,
                        'compare' => '=='
                    ),
                ),
            );
            $the_query = new WP_Query($args);

            $size = array('250', '250');

            $output = '<div class="feat-wrapper">';
            $output .= '<h3 style="margin-bottom: 60px; font-weight: 700">Featured Products</h3>';
            $output .= '<div class="feat-row">';
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
                    $output .= '<a href="'.get_permalink( get_the_ID() ).'">';
                    $output .= '<div class="feat-item">';
                    if (get_the_post_thumbnail()) :
                        $output .= get_the_post_thumbnail(get_the_ID(), $size);
                    endif;
                    $output .= '<h4>' . get_the_title() . '</h4>';
                    $output .= '</div>';
                    $output .= '</a>';
                endwhile;
            endif;
            wp_reset_postdata();
            $output .= '</div>';
            $output .= '<div class="w-btn-wrapper align_center feat-button">';
            $output .= '<a class="w-btn us-btn-style_1" href="#"><span class="w-btn-label">View All</span></a>';
            $output .= '</div>';

            $output .= '</div>'; //Feat Wrapper
            return $output;
        }

        /**
         * Map shortcode to WPBakery
         *
         * This is an array of all your settings which become the shortcode attributes ($atts)
         * for the output. See the link below for a description of all available parameters.
         *
         * @since 1.0.0
         * @link  https://kb.wpbakery.com/docs/inner-api/vc_map/
         */
        public static function map()
        {
            return array(
                'name' => esc_html__('Featured Products', 'locale'),
                'description' => esc_html__('Shows the Featured Products', 'locale'),
                'base' => 'vs_feat_products',
                'params' => array()
            );

        }
    }
}
new VS_Featured_Products_Shortcode;