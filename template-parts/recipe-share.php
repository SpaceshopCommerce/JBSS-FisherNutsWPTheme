<?php
/**
 * Adds new shortcode "Recipe Share" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Recipe_Share_Shortcode' ) ) {

    class VS_Recipe_Share_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_recipe_share', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_recipe_share', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_recipe_share', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */

            $output = "";


            $output .= '<div class="recipe-share">';
            $output .= '<a href="#" onclick="window.print();return false;" class="recipe-print">Print</a>';
            $output .= '<div class="recipe-share-social">';
            $output .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '"><i class="fab fa-facebook-f"></i></a>';
//				$output .= '<a href="https://twitter.com/intent/tweet?text=' . get_permalink() . '"><i class="fab fa-instagram"></i></a>';
				$output .= '<a href="https://twitter.com/intent/tweet?text=' . get_permalink() . '"><i class="fab fa-twitter"></i></a>';
			$output .= '</div>';
		$output .= '</div>';



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
                'name' => esc_html__('Recipe Share', 'locale'),
                'description' => esc_html__('Shows the Recipe Share', 'locale'),
                'base' => 'vs_recipe_share',
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
new VS_Recipe_Share_Shortcode;