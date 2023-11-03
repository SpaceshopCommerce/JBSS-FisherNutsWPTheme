<?php
/**
 * Adds new shortcode "FAQ" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_FAQ_Shortcode' ) ) {

    class VS_FAQ_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_faq', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_faq', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_faq', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */

            $output = "";


            $output .= '<div class="faq-wrapper">';
            if ( have_rows( 'categories' ) ) :
                while ( have_rows( 'categories' ) ) : the_row();
                    $output .= '<div class="faq-cat">';
                    $output .= '<h2>' . get_sub_field( 'category_name' ) . '</h2>';
                    $output .= '<div class="faq-grid">';
                    if ( have_rows( 'questions' ) ) :
                        while ( have_rows( 'questions' ) ) : the_row();
                            $output .= '<div class="faq-item">';
                            $output .= '<a  href="javascript:void(0)"><div class="faq-item-q"><h3>' . get_sub_field( 'question' ) . '</h3> <i class="fa fa-plus"></i></div></a>';
                            $output .= '<div class="faq-item-a" style="display: none"><p>' . get_sub_field( 'answer' ) . '</p></div>';
                            $output .= '</div>';
                        endwhile;
                    endif;
                    $output .= '</div>';
                    $output .= '</div>';
                endwhile;
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
                'name' => esc_html__('FAQ', 'locale'),
                'description' => esc_html__('Shows the FAQ', 'locale'),
                'base' => 'vs_faq',
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
new VS_FAQ_Shortcode;