<?php /* Template Name: FAQ Dev */ ?>

<div class="faq-wrapper">
    <?php if ( have_rows( 'categories' ) ) : ?>
        <?php while ( have_rows( 'categories' ) ) : the_row(); ?>
        <div class="faq-cat">
            <h2><?php the_sub_field( 'category_name' ); ?></h2>
            <div class="faq-grid">
            <?php if ( have_rows( 'questions' ) ) : ?>
                <?php while ( have_rows( 'questions' ) ) : the_row(); ?>
                <div class="faq-item">
                    <a  href="javascript:void(0);"><div class="faq-item-q"><h3><?php the_sub_field( 'question' ); ?></h3> <i class="fa-solid fa-plus"></i></div></a>
                    <div class="faq-item-a" style="display: none;"><p><?php the_sub_field( 'answer' ); ?></p></div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>




<?php if ( have_rows( 'tips' ) ) : ?>
    <?php while ( have_rows( 'tips' ) ) : the_row(); ?>
        <?php the_sub_field( 'name' ); ?>
        <?php the_sub_field( 'tip' ); ?>
    <?php endwhile; ?>

<?php endif; ?>