<?php /* Template Name: Featured Recipes Dev */ ?>

<?php

//    $args = array(
//        'post_type' => 'recipes',
//        'posts_per_page' => 6,
//        'meta_query' => array(
//            array(
//                'key' => 'featured',
//                'value' => true,
//                'compare' => '=='
//            ),
//        ),
//    );
//    $the_query = new WP_Query( $args );

?>

<div class="feat-recipes-wrapper">
    <h2>Featured Recipes</h2>
    <div class="feat-recipes-row">
        <div class="recipe-top">
            <?php
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
            ?>

            <?php if ( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="recipe-top-item">
                        <div class="recipe-image-tag"><p>Top Recipe</p></div>
                        <?php if ( get_the_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail(); ?>
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_content(); ?></p>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

        </div>
        <div class="recipes-feat">
            <?php
            $args = array(
                'post_type' => 'recipe',
                'posts_per_page' => 6,
                'meta_query' => array(
                    array(
                        'key' => 'featured',
                        'value' => true,
                        'compare' => '=='
                    ),
                ),
            );
            $the_query = new WP_Query( $args );
            ?>
            <?php if ( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="recipe-feat-item">
                        <div class="recipe-image-tag"><p><?php the_field( 'featured_label' ); ?></p></div>
                        <?php if ( get_the_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail(); ?>
                        <?php endif; ?>
                        <div class="recipe-feat-content">
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>