<?php
/**
 * Adds new shortcode "Nut Badges" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Nut_Badges_Shortcode' ) ) {

    class VS_Nut_Badges_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_nut_badges', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_nut_badges', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_nut_badges', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */

            $output = "";


            $output .= '<div class="badges">';
            $logos_values = get_field( 'logos' );
            if ( $logos_values ) :
                foreach ( $logos_values as $logo ) :
                    if( $logo == 'Gluten Free' ) : $output .= '<div class="badge"><img src="/wp-content/themes/Fisher/images/GlutenFree.svg" alt="Gluten Free"></div>'; endif;
                    if( $logo == 'No Preservatives' ) : $output .= '<div class="badge"><img src="/wp-content/themes/Fisher/images/NoPreservatives.svg" alt="No Preservatives"></div>'; endif;
                    if( $logo == 'Vegan' ) : $output .= '<div class="badge"><img src="/wp-content/themes/Fisher/images/Vegan.svg" alt="Vegan"></div>'; endif;
                    if( $logo == 'Origin California' ) : $output .= '<div class="badge"><img src="/wp-content/themes/Fisher/images/Cali.svg" alt="Origin California"></div>'; endif;
                    if( $logo == 'Heart' ) : $output .= '<div class="badge"><img src="/wp-content/themes/Fisher/images/AHA.svg" alt="AHA"></div>'; endif;
                    if( $logo == 'Non GMO' ) : $output .= '<div class="badge"><img src="/wp-content/themes/Fisher/images/NonGmo.svg" alt="Non GMO"></div>'; endif;
                endforeach;
            endif;
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
                'name' => esc_html__('Nut Badges', 'locale'),
                'description' => esc_html__('Shows the Nut Badges', 'locale'),
                'base' => 'vs_nut_badges',
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
new VS_Nut_Badges_Shortcode;