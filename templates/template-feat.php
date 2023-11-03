<?php /* Template Name: Featured Products Dev */ ?>

<?php

    $args = array(
        'post_type' => 'recipe-nuts',
        'posts_per_page' => 4,
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

<div class="feat-wrapper">
    <h2>Featured Products</h2>
    <div class="feat-row">
        <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="feat-item">
                    <?php if ( get_the_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail(); ?>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
        <div class="w-btn-wrapper align_center feat-button">
            <a class="w-btn us-btn-style_1" href="#"><span class="w-btn-label">Locate a Store</span></a>
        </div>
</div>