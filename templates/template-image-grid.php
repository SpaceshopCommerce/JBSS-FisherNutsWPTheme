<?php /* Template Name: Image Grid Template Post Type: recipe-nuts */ ?>






<?php

    $nut_type = get_field('recipe_nut_type');
    $nut_cut = get_field('cut');
    $post_id = get_the_ID();

    $args = array(
        'post_type' => 'recipe-nuts'
    );

    $post_query = new WP_Query($args);

    if($post_query->have_posts() ) {
        $add_dd = false;
        while($post_query->have_posts() ) {
            $post_query->the_post();
            if(get_field('recipe_nut_type') == $nut_type && get_field('cut') == $nut_cut){
//            if(get_field('recipe_nut_type') == $nut_type){
//            if(get_field('cut') == $nut_cut){
                if(!$add_dd){
                    echo '<div class="other-prods">';
                    echo '<h4>Varieties</h4>';
                    echo '<select onChange="window.location.href=this.value">';
                    echo '<option></option>';
                }
                $add_dd = true;
                $title = get_the_title();
                ?>
                <option <?php if($post_id == get_the_ID()) : echo 'selected'; endif; ?> value="<?php echo get_permalink() ?>"><?php echo $title; ?></option>
                <?php
            };
        }
        if($add_dd){
            echo '</select></div>';
        }
    }
    wp_reset_postdata();
?>



<?php
    if( get_field('recipe_nut_type') ) {

    $post_object_cpt2 = get_field('recipe_nut_type');

    if( $post_object_cpt2 ) {
        $post_cpt2 = $post_object_cpt2;
        setup_postdata( $post_cpt2 );
        ?>
        <a href="<?php the_permalink($post_object_cpt2->ID); ?>"><?php if(get_field('description', $post_object_cpt2->ID)) { the_field('description', $post_object_cpt2->ID); } ?></a>
        <?php
    }
}
?>



<div class="badges">
    <?php $logos_values = get_field( 'logos' ); ?>
    <?php if ( $logos_values ) : ?>
        <?php foreach ( $logos_values as $logo ) : ?>
            <?php if( $logo == 'Gluten Free' ) : echo '<div class="badge"><img src="/wp-content/themes/Fisher/images/GlutenFree.svg" alt="Gluten Free"></div>'; endif; ?>
            <?php if( $logo == 'No Preservatives' ) : echo '<div class="badge"><img src="/wp-content/themes/Fisher/images/NoPreservatives.svg" alt="No Preservatives"></div>'; endif; ?>
            <?php if( $logo == 'Vegan' ) : echo '<div class="badge"><img src="/wp-content/themes/Fisher/images/Vegan.svg" alt="Vegan"></div>'; endif; ?>
            <?php if( $logo == 'Origin California' ) : echo '<div class="badge"><img src="/wp-content/themes/Fisher/images/Cali.svg" alt="Origin California"></div>'; endif; ?>
            <?php if( $logo == 'Heart' ) : echo '<div class="badge"><img src="/wp-content/themes/Fisher/images/AHA.svg" alt="AHA"></div>'; endif; ?>
            <?php if( $logo == 'Non GMO' ) : echo '<div class="badge"><img src="/wp-content/themes/Fisher/images/NonGmo.svg" alt="Non GMO"></div>'; endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<div class="nut-extra-info">
    <?php if ( have_rows( 'extra_info' ) ) : ?>
        <?php while ( have_rows( 'extra_info' ) ) : the_row(); ?>
        <div class="nut-info-item">
            <h4><?php echo get_sub_field( 'title' ); ?></h4>
            <p><?php echo get_sub_field( 'content' ); ?></p>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>



<div class="product-images">
    <div class="product-images-grid">
        <ul>
        <?php if ( have_rows( 'images' ) ) : ?>
        <?php $index = 0; ?>
        <?php while ( have_rows( 'images' ) ) : the_row(); ?>
            <?php $image = get_sub_field( 'image' ); ?>
            <?php $size = array('100', '100'); ?>
            <?php if ( $image ) : ?>
                <li class="product-image-item" data-index="<?php echo $index; ?>">
                <?php echo wp_get_attachment_image( $image, $size ); ?>
                <?php $index += 1; ?>
                </li>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
        </ul>
    </div>
    <div class="product-images-image">
        <?php if ( have_rows( 'images' ) ) : ?>
        <?php $index = 0; ?>
        <?php while ( have_rows( 'images' ) ) : the_row(); ?>
            <?php $image = get_sub_field( 'image' ); ?>
            <?php $size = array('764', '764'); ?>
            <?php if ( $image ) : ?>
                <div class="product-image-large <?php if ($index==0) : echo 'active'; endif;?>" data-index="<?php echo $index; ?>">
                <?php echo wp_get_attachment_image( $image, $size ); ?>
                <?php $index += 1; ?>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>




<?php

    $args = array(
        'posts_per_page'  => 4,
        'post_type' => 'recipe-nuts',
        'orderby'   => 'rand',
        'post__not_in' => array( get_queried_object_id() ),
    );
    $post_query = new WP_Query($args);
?>

<div class="related-items">
    <h3>MORE PRODUCTS</h3>
    <div class="related-items-row">

        <?php
        $size = array('200', '200');
        if($post_query->have_posts() ) {
            while($post_query->have_posts() ) {
                $post_query->the_post();

                echo '<a href="' . get_permalink() . '">';
                echo '<div class="related-item">';
                echo get_the_post_thumbnail(get_the_ID(), $size);
                echo '<h4>' . get_the_title() . '</h4>';
                echo '</div>';
                echo '</a>';

            }

        }
        ?>
    </div>
</div>

<?php
    wp_reset_postdata();
?>













<?php if ( have_rows( 'directions' ) ) : ?>
<div class="directions-block">
    <ol class="directions-list">
    <?php while ( have_rows( 'directions' ) ) : the_row(); ?>
        <li>
        <?php the_sub_field( 'direction_text' ); ?>
        </li>
    <?php endwhile; ?>
    </ol>
</div>
<?php endif; ?>



<div class="recipe-share">
    <a href="javascript(0);" class="recipe-print">Print</a>
    <div class="recipe-share-social">
        <a href=""><i class='fab fa-facebook-f'></i></a>
        <a href=""><i class='fab fa-instagram'></i></a>
        <a href=""><i class='fab fa-twitter'></i></a>
    </div>
</div>






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






<?php if ( have_rows( 'recipe_nuts_used' ) ) : ?>
    <div class="prod-used-wrapper">
        <h2>Product Used</h2>
        <div class="prod-used-row">
            <?php while ( have_rows( 'recipe_nuts_used' ) ) : the_row(); ?>
                <div class="prod-used-item">
                <?php $recipe_nut = get_sub_field( 'recipe_nut' ); ?>
                <?php if ( $recipe_nut ) : ?>
                    <?php $post = $recipe_nut; ?>
                    <?php setup_postdata( $post ); ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( get_the_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail(); ?>
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                    </a>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>



<div class="image-slide">
    <div class="image-slide-back"></div>
    <div class="image-slide-front"></div>
</div>