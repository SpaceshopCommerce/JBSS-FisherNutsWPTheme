<?php
/**
 * Adds new shortcode "Image Slide" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Image_Slide_Shortcode' ) ) {

    class VS_Image_Slide_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_image_slide', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_image_slide', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_image_slide', $atts);

            $size = array('600', '600');

            $image_front = wp_get_attachment_image($atts['image_front'], $size);
            $image_back = wp_get_attachment_image($atts['image_back'], $size);
            $mode = $atts['mode'];

            $image_front_url = wp_get_attachment_image_src($atts['image_front'], $size)['0'];
            $image_back_url = wp_get_attachment_image_src($atts['image_back'], $size)['0'];


            $output = "";


            $output .= '<div class="image-slide ' . $mode . '">';
            $output .= '<div class="image-slide-front" style="background-image: url(' . $image_front_url . ')"></div>';
            $output .= '<div class="image-slide-back" style="background-image: url(' . $image_back_url . ')"></div>';
//            $output .= '<div class="image-slide-front background-image: url(' . $image_front_url . ')">' . $image_front . '</div>';
//            $output .= '<div class="image-slide-back background-image: url(' . $image_back_url . ')">' . $image_back . '</div>';
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
                'name' => esc_html__('Image Slide', 'locale'),
                'description' => esc_html__('Shows the Image Slide', 'locale'),
                'base' => 'vs_image_slide',
                'params' => array(

                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Mode', 'locale' ),
                        'param_name' => 'mode',
                        'value'      => array(
                            esc_html__( 'Slide Up', 'locale' )  => 'slide-up',
                            esc_html__( 'Slide Right', 'locale' ) => 'slide-right',
                        ),
                    ),
                    array(
                        'type'       => 'attach_image',
                        'heading'    => esc_html__( 'Front Image', 'locale' ),
                        'param_name' => 'image_front',
                    ),
                    array(
                        'type'       => 'attach_image',
                        'heading'    => esc_html__( 'Back Image', 'locale' ),
                        'param_name' => 'image_back',
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
new VS_Image_Slide_Shortcode;