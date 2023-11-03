<?php
/**
 * Adds new shortcode "Recipe Nut Options" and registers it to
 * the Visual Composer plugin
 *
 */
if ( ! class_exists( 'VS_Recipe_Nut_Options_Shortcode' ) ) {

    class VS_Recipe_Nut_Options_Shortcode
    {

        /**
         * Main constructor
         */
        public function __construct()
        {
            // Registers the shortcode in WordPress
            add_shortcode('vs_recipe_nut_options', __CLASS__ . '::output');

            // Map shortcode to WPBakery so you can access it in the builder
            if (function_exists('vc_lean_map')) {
                vc_lean_map('vs_recipe_nut_options', __CLASS__ . '::map');
            }
        }


        /**
         * Shortcode output
         */
        public static function output($atts, $content = null)
        {
            $atts = vc_map_get_attributes('vs_recipe_nut_options', $atts);

            /*
            $image_1 = wp_get_attachment_image_src($atts['image_1'], size: 'full')['0'];
            $link_1 = vc_build_link($atts['link_1'])['url'];
            $text_1 = $atts['text_1'];
            */




            $output = "";

//            $nut_type = get_field('recipe_nut_type');
//            $nut_cut = get_field('cut');
            $post_id = get_the_ID();


//            Get the Nut Type ID
            $list = get_the_terms( $post_id , 'nuts' );
            $taxNut = '';
            foreach ($list as $i){
                $taxNut = ($i->term_id);
            }
//            $output .= ' Nut: ' .$taxNut;

//            Get the Cut ID
            $list = get_the_terms( $post_id , 'cut' );
            $taxCut = '';
            foreach ($list as $i){
                $taxCut = ($i->term_id);
            }
//            $output .= ' Cut: ' . $taxCut;




            $args = array(
                'posts_per_page'  => -1,
                'post_type' => 'recipe-nuts',
                'orderby'   => 'meta_value',
                'order' => 'ASC',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'nuts',
                        'field'    => 'term_id',
                        'terms'    => array( $taxNut ),
                    ),
                    array(
                        'taxonomy' => 'cut',
                        'field'    => 'term_id',
                        'terms'    => array( $taxCut ),
                    ),
                )
            );

            $post_query = new WP_Query($args);

            $optsCount = 0;
            $opts = '';




            if($post_query->have_posts() ) {
                $add_dd = false;
                while($post_query->have_posts() ) {
                    $post_query->the_post();
//                    if(get_field('recipe_nut_type') == $nut_type && get_field('cut') == $nut_cut){
                        $optsCount++;

//            if(get_field('recipe_nut_type') == $nut_type){
//            if(get_field('cut') == $nut_cut){
                        if(!$add_dd){
                            $opts .= '<div class="other-prods">';
                            $opts .= '<h4>Varieties</h4>';
                            $opts .= '<select onChange="window.location.href=this.value">';
                            $opts .= '<option></option>';
                        }
                        $add_dd = true;
                        $title = get_the_title();

                        $opts .= '<option ';
                        if($post_id == get_the_ID()){
                            $opts .= ' selected ';
                        }
                        $opts .= 'value="' . get_permalink() . '">' . $title . '</option>';
//                    };
                }
                if($add_dd){
                    $opts .= '</select></div>';
                }
            }
            if($optsCount > 1){
                $output .= $opts;
            }



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
        'name' => esc_html__('Recipe Nut Options', 'locale'),
        'description' => esc_html__('Shows the Recipe Nut Options', 'locale'),
        'base' => 'vs_recipe_nut_options',
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
new VS_Recipe_Nut_Options_Shortcode;