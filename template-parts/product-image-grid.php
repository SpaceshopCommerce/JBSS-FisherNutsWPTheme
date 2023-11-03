<?php
/**
 * Adds new shortcode "Product Image Grid" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Product_Image_Grid_Shortcode' ) ) {

    class VS_Product_Image_Grid_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_product_image_grid', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_product_image_grid', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_product_image_grid', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */

            $output = "";


            $output .= '<div class="product-images">';
            $output .= '<div class="product-images-grid">';
            $output .= '<ul>';
            if ( have_rows( 'images' ) ) :
                $index = 0;
                while ( have_rows( 'images' ) ) : the_row();
                    $image = get_sub_field( 'image' );
                    $size = array('100', '100');
                    if ( $image ) :
                        $output .= '<li class="product-image-item" data-index="' . $index . '">';
                        $output .= wp_get_attachment_image( $image, $size );
					$index += 1;
						$output .= '</li>';
                    endif;
                endwhile;
            endif;
            $output .= '</ul>';
            $output .= '</div>';
            $output .= '<div class="product-images-image">';
            if ( have_rows( 'images' ) ) :
                $index = 0;
                while ( have_rows( 'images' ) ) : the_row();
                    $image = get_sub_field( 'image' );
                    $size = array('764', '764');
                    if ( $image ) :
                        $output .= '<div class="product-image-large ';
                        if ($index==0) : $output .= 'active'; endif;
                        $output .='" data-index="' . $index . '">';
                        $output .= wp_get_attachment_image( $image, $size );
					$index += 1;
						$output .= '</div>';
                    endif;
                endwhile;
            endif;
            $output .= '</div>';
            $output .= '</div>';
            $output .= '';



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
                'name' => esc_html__('Product Image Grid', 'locale'),
                'description' => esc_html__('Shows the Product Image Grid', 'locale'),
                'base' => 'vs_product_image_grid',
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
new VS_Product_Image_Grid_Shortcode;