<?php
/**
 * Adds new shortcode "Recipe Product Used" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Recipe_Product_Used_Shortcode' ) ) {

    class VS_Recipe_Product_Used_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_recipe_product_used', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_recipe_product_used', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_recipe_product_used', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */

            $output = "";

            $size = array('400', '400');

            if ( have_rows( 'recipe_nuts_used' ) ) :
                $output .= '<div class="prod-used-wrapper">';
//                $output .= '<h2>Product Used</h2>';
                $output .= '<div class="prod-used-row">';
                while ( have_rows( 'recipe_nuts_used' ) ) : the_row();
                    $output .= '<div class="prod-used-item">';
                    $recipe_nut = get_sub_field( 'recipe_nut' );
                    if ( $recipe_nut ) :
                        setup_postdata( $GLOBALS['post'] =& $recipe_nut );
                        $output .= '<a href="' . get_the_permalink() . '">';
                        $output .= get_the_post_thumbnail(get_the_ID(), $size);
                        $output .= '<h4>' . get_the_title() . '</h4>';
                        $output .= '</a>';
                        wp_reset_postdata();
                    endif;
                    $output .= '</div>';
                endwhile;
                $output .= '</div>';
                $output .= '</div>';
            endif;



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
                'name' => esc_html__('Recipe Product Used', 'locale'),
                'description' => esc_html__('Shows the Recipe Product Used', 'locale'),
                'base' => 'vs_recipe_product_used',
                'params' => array(

                    /*
                    array(
                        'type'       => 'attach_image',
                        'heading'    => esc_html__( 'Image 1', 'locale' ),
                        'param_name' => 'image_1',
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Text 1', 'locale' ),
                        'param_name' => 'text_1',
                    ),
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Link 1', 'locale' ),
                        'param_name' => 'link_1',
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Show Heading?', 'locale' ),
                        'param_name' => 'show_heading',
                        'value'      => array(
                            esc_html__( 'No', 'locale' )  => 'no',
                            esc_html__( 'Yes', 'locale' ) => 'yes',
                        ),
                    ),
                   array(
                        'type'       => 'textarea_html',
                        'heading'    => esc_html__( 'Custom Text', 'locale' ),
                        'param_name' => 'content',
                    ),

                    */
                )
            );

        }





    }

}
new VS_Recipe_Product_Used_Shortcode;