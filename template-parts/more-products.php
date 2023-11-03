<?php
/**
 * Adds new shortcode "More Products" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_More_Products_Shortcode' ) ) {

    class VS_More_Products_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_more_products', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_more_products', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_more_products', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */

            $output = "";


            $mode = $atts['product_types'];
            $moduleSize = $atts['size'];

//            $output .= $mode;


            $post_count = 4;
            $title = "MORE PRODUCTS";
            $more_link = "recipe-nuts";

            if($moduleSize == 'size-mini'){
                $post_count = 2;
                $title = "PRODUCTS";
            }
            if($mode == 'snacks'){
                $more_link = 'snacks';
            }


            $args = array(
                'posts_per_page'  => $post_count,
                'post_type' =>  $mode,
                'orderby'   => 'rand',
                'post__not_in' => array( get_queried_object_id() ),
            );



            $post_query = new WP_Query($args);



            $output .= '<div class="related-items " ' . $moduleSize .  ' >';
                $output .= '<h3>' . $title . '</h3>';
                $output .= '<div class="related-items-row">';
            $output .= '';

                    $size = array('300', '300');
                    if($post_query->have_posts() ) {
                        while ($post_query->have_posts()) {
                            $post_query->the_post();

                            $output .= '<a href="' . get_permalink() . '">';
                            $output .= '<div class="related-item">';
                            $output .= get_the_post_thumbnail(get_the_ID(), $size);
                            $output .= '<h4>' . get_the_title() . '</h4>';
                            $output .= '</div>';
                            $output .= '</a>';
                        }
                    }
                $output .= '</div>';
                $output .= '<div class="button-row">';
                    $output .= '<a class="w-btn us-btn-style_1 btn" href="/' . $more_link . '">VIEW ALL</a>';
                $output .= '</div>';
            $output .= '</div>';

            wp_reset_postdata();



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
                'name' => esc_html__('More Products', 'locale'),
                'description' => esc_html__('Shows the More Products', 'locale'),
                'base' => 'vs_more_products',
                'params' => array(

                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Product Types', 'locale' ),
                        'param_name' => 'product_types',
                        'value'      => array(
                            esc_html__( 'Recipe Nuts', 'locale' )  => 'recipe-nuts',
                            esc_html__( 'Snacks', 'locale' ) => 'snacks',
                        ),
                    ), array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Size', 'locale' ),
                        'param_name' => 'size',
                        'value'      => array(
                            esc_html__( 'Full', 'locale' )  => 'size-full',
                            esc_html__( 'Mini', 'locale' ) => 'size-mini',
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
new VS_More_Products_Shortcode;