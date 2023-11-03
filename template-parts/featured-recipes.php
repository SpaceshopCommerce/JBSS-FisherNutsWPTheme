<?php
/**
 * Adds new shortcode "Featured Recipes" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Featured_Recipes_Shortcode' ) ) {

    class VS_Featured_Recipes_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_featured_recipes', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_featured_recipes', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_featured_recipes', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */


            $show_view_all = $atts['show_view_all'];

            $output = "";


            $output .= '<div class="feat-recipes-wrapper">';
            $output .= '<h2>Featured Recipes</h2>';
            $output .= '<div class="feat-recipes-row">';
            $output .= '<div class="recipe-top">';

            $args = array(
                'post_type' => 'recipe',
                'posts_per_page' => 1,
                'meta_query' => array(
                    array(
                        'key' => 'featured_main',
                        'value' => true,
                        'compare' => '=='
                    ),
                ),
            );
            $the_query = new WP_Query( $args );
           if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    $output .= '<a href="'.get_permalink( get_the_ID() ).'">';
                        $output .= '<div class="recipe-top-item">';
                            $output .= '<div class="recipe-image-tag"><p>Top Recipe</p></div>';
                            $output .= '<div class="recipe-feat-img-wrapper">';
                            if ( get_the_post_thumbnail() ) :
                                $output .= get_the_post_thumbnail();
                            endif;
                            $output .= '</div>';
                            $output .= '<h3>' . get_the_title() . '</h3>';
                            $output .= '<p>' . get_the_content() . '</p>';
                        $output .= '</div></a>';
                endwhile;
                wp_reset_postdata();
            endif;
            wp_reset_postdata();
            $output .= '</div>';
            $output .= '<div class="recipes-feat">';

            $args = array(
                'post_type' => 'recipe',
                'posts_per_page' => 6,
                'tax_query' => array(
                  array(
                      'taxonomy' => 'recipe_tag',
                      'field' => 'slug',
                      'terms' => 'featured',
                      'orderby' => 'DESC',
                  ),
              ),
            );

            $the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        $output .= '<a href="'.get_permalink( get_the_ID() ).'">';
                        $output .= '<div class="recipe-feat-item">';
                        $output .= '<div class="recipe-image-tag"><p>' . get_field( 'featured_label' ) . '</p></div>';
                        $output .= '<div class="recipe-feat-img-wrapper">';
                        if ( get_the_post_thumbnail() ) :
                            $output .= get_the_post_thumbnail(null,'recipe-thumb');

                        endif;
                        $output .= '</div>';
                        $output .= '<div class="recipe-feat-content">';
                        $output .= '<h3>' . get_the_title() . '</h3>';
                        $output .= '<p>' . get_the_content() . '</p>';
                        $output .= '</div>';
                        $output .= '</div></a>';
                    endwhile;
                    wp_reset_postdata();
                endif;
				$output .= '</div>';
			$output .= '</div>';
            if($show_view_all == "yes"){
                $output .= '<div class="button-row">';
                    $output .= '<a class="w-btn us-btn-style_1 btn" href="/recipes">VIEW ALL</a>';
                $output .= '</div>';
            }
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
                'name' => esc_html__('Featured Recipes', 'locale'),
                'description' => esc_html__('Shows the Featured Recipes', 'locale'),
                'base' => 'vs_featured_recipes',
                'params' => array(

                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__( 'Show View All?', 'locale' ),
                        'param_name' => 'show_view_all',
                        'value'      => array(
                            esc_html__( 'No', 'locale' )  => 'no',
                            esc_html__( 'Yes', 'locale' ) => 'yes',
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
new VS_Featured_Recipes_Shortcode;