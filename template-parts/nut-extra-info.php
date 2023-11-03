<?php
/**
 * Adds new shortcode "Nut Extra Info" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Nut_Extra_Info_Shortcode' ) ) {

    class VS_Nut_Extra_Info_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_nut_extra_info', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_nut_extra_info', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_nut_extra_info', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */

            $mode = $atts['nut_type'];

            $output = "";


            $output .= '<div class="nut-extra-info">';
                $output .= '<div class="nut-info-item">';
                $output .= '<h4>Storage Method</h4>';
                $output .= '<p>To better preserve the freshness and integrity of our products, you may store in the refrigerator up to 3 months. Fisher®️ Chef Naturals can freeze up to 12 months within the best by date guidelines.</p>';

//                if($mode == 'recipe') {
//                    $output .= '<p>Fisher® recipe nuts are a wonderful way to add flavor and texture to any dish without adding preservatives! Just look for our stand-up bag and enjoy the taste and convenience of Fisher®.</p>';
//                }
//                if($mode == 'snack') {
//                    $output .= '<p>Nuts are more than a delicious source of protein, good fats, and important vitamins and minerals, making them a great go-to snack.</p>';
//                }
                $output .= '</div>';

//            if ( have_rows( 'extra_info' ) ) :
//                while ( have_rows( 'extra_info' ) ) : the_row();
//                    $output .= '<div class="nut-info-item">';
//                    $output .= '<h4>' . get_sub_field( 'title' ) . '</h4>';
//					$output .= '<p>' . get_sub_field( 'content' ) . '</p>';
//				$output .= '</div>';
//                endwhile;
//            endif;
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
                'name' => esc_html__('Nut Extra Info', 'locale'),
                'description' => esc_html__('Shows the Nut Extra Info', 'locale'),
                'base' => 'vs_nut_extra_info',
                'params' => array(

                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Type', 'locale' ),
                        'param_name' => 'nut_type',
                        'value'      => array(
                            esc_html__( 'Recipe Nuts', 'locale' )  => 'recipe',
                            esc_html__( 'Snack Nuts', 'locale' ) => 'snack',
                        ),
                    )


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
new VS_Nut_Extra_Info_Shortcode;