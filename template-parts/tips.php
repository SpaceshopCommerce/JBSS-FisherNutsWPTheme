<?php
/**
 * Adds new shortcode "TIPS" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_TIPS_Shortcode' ) ) {

    class VS_TIPS_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_tips', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_tips', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_tips', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */

            $output = "";


            $output .= '<div class="tips-wrapper">';
            $output .= '';
            $output .= '<div class="tips-buttons">';
            $output .= '<a href="javascript:void(0);" class="tip-button tip-button-how-to">HOW-TO</a>';
            $output .= '<a href="javascript:void(0);" class="tip-button tip-button-hacks">HACKS</a>';
            $output .= '</div>';
            $output .= '';
            $output .= '<div class="tip-section how-to-section">';
            if ( have_rows( 'how-tos' ) ) :
                $output .= '<h2>How-To</h2>';
                $output .= '<div class="how-to-grid tips-grid">';
                while ( have_rows( 'how-tos' ) ) : the_row();
                    $output .= '<div class="how-to-item grid-item">';
                    $output .= '<div class="grid-image">';
                    $image = get_sub_field( 'image' );
                    $size = 'full';
                    if ( $image ) :
                        $output .= wp_get_attachment_image( $image, $size );
                    endif;
                    $output .= '</div>';
                    $output .= '';
                    $output .= '<h2>' . get_sub_field( 'name' ) . '</h2>';
                    $output .= '<p>' . get_sub_field( 'text' ) . '</p>';
                    $output .= '</div>';
                endwhile;
                $output .= '</div>';
            endif;
            $output .= '</div>';
            $output .= '';
            $output .= '<div class="tip-section hacks-section">';
            if ( have_rows( 'hacks' ) ) :
                $output .= '<h2>Hacks</h2>';
                $output .= '<div class="how-to-grid tips-grid">';
                while ( have_rows( 'hacks' ) ) : the_row();
                    $output .= '<div class="how-to-item grid-item">';
                    $output .= '<div class="grid-image">';
                    $image = get_sub_field( 'image' );
                    $size = 'full';
                    if ( $image ) :
                        $output .= wp_get_attachment_image( $image, $size );
                    endif;
                    $output .= '</div>';
                    $output .= '';
                    $output .= '<h2>' . get_sub_field( 'name' ) . '</h2>';
                    $output .= '<p>' . get_sub_field( 'text' ) . '</p>';
                    $output .= '</div>';
                endwhile;
                $output .= '</div>';
            endif;
            $output .= '</div>';
            $output .= '';
            $output .= '<div class="tip-section tip-links-section">';
            if ( have_rows( 'tips' ) ) :
                $output .= '<div class="tip-link-grid tips-grid">';
                while ( have_rows( 'tips' ) ) : the_row();
                    $output .= '<div class="tip-link grid-item"><a href="#'. get_sub_field( 'name' ) . '">';
                    $output .= '<div class="grid-image">';
                    $image = get_sub_field( 'image' );
                    $size = 'full';
                    if ( $image ) :
                        $output .= wp_get_attachment_image( $image, $size );
                    endif;
                    $output .= '</div>';
                    $output .= '<h2>' . get_sub_field( 'name' ) . '</h2>';
                    $output .= '</div></a>';
                endwhile;
                $output .= '</div>';
            endif;
            $output .= '</div>';
            $output .= '';
            if ( have_rows( 'tips' ) ) :
                while ( have_rows( 'tips' ) ) : the_row();
                    $output .= '<div class="tip-section tips-section">';
                    $output .= '<div id="' . get_sub_field( 'name' ) . '" class="tip-image">';
                    $image = get_sub_field( 'image' );
                    $size = 'full';
                    if ( $image ) :
                        $output .= wp_get_attachment_image( $image, $size );
                    endif;
                    $output .= '</div>';
                    $output .= '<h2>' . get_sub_field( 'name' ) . '</h2>';
                    $output .= '<div class="tip-link-grid tips-grid">';
                    if ( have_rows( 'tips-child' ) ) :
                        while ( have_rows( 'tips-child' ) ) : the_row();
                            $output .= '<div class="tip-link grid-item">';
                            $output .= '<h3>' . get_sub_field( 'name' ) . '</h3>';
                            $output .= '<p>' . get_sub_field( 'tip' ) . '</p>';
                            $output .= '</div>';
                        endwhile;
                    endif;
                    $output .= '</div>';
                    $output .= '</div>';
                endwhile;
            endif;
            $output .= '';
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
                'name' => esc_html__('TIPS', 'locale'),
                'description' => esc_html__('Shows the TIPS', 'locale'),
                'base' => 'vs_tips',
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
new VS_TIPS_Shortcode;