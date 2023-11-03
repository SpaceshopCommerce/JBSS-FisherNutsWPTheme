<?php /* Template Name: Tips Dev */ ?>


<div class="tips-wrapper">

    <div class="tips-buttons">
        <a href="javascript(0);" class="tip-button tip-button-how-to">HOW-TO</a>
        <a href="javascript(0);" class="tip-button tip-button-hacks">HACKS</a>
    </div>

    <div class="tip-section how-to-section">
        <?php if ( have_rows( 'how-tos' ) ) : ?>
            <h2>How-To</h2>
            <div class="how-to-grid tips-grid">
                <?php while ( have_rows( 'how-tos' ) ) : the_row(); ?>
                    <div class="how-to-item grid-item">
                        <div class="grid-image">
                            <?php $image = get_sub_field( 'image' ); ?>
                            <?php $size = 'full'; ?>
                            <?php if ( $image ) : ?>
                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                            <?php endif; ?>
                        </div>

                        <h2><?php the_sub_field( 'name' ); ?></h2>
                        <p><?php the_sub_field( 'text' ); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="tip-section hacks-section">
        <?php if ( have_rows( 'hacks' ) ) : ?>
            <h2>Hacks</h2>
            <div class="how-to-grid tips-grid">
                <?php while ( have_rows( 'hacks' ) ) : the_row(); ?>
                    <div class="how-to-item grid-item">
                        <div class="grid-image">
                            <?php $image = get_sub_field( 'image' ); ?>
                            <?php $size = 'full'; ?>
                            <?php if ( $image ) : ?>
                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                            <?php endif; ?>
                        </div>

                        <h2><?php the_sub_field( 'name' ); ?></h2>
                        <p><?php the_sub_field( 'text' ); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="tip-section tip-links-section">
        <?php if ( have_rows( 'tips' ) ) : ?>
            <div class="tip-link-grid tips-grid">
            <?php while ( have_rows( 'tips' ) ) : the_row(); ?>
                <div class="tip-link grid-item">
                    <div class="grid-image">
                        <?php $image = get_sub_field( 'image' ); ?>
                        <?php $size = 'full'; ?>
                        <?php if ( $image ) : ?>
                            <?php echo wp_get_attachment_image( $image, $size ); ?>
                        <?php endif; ?>
                    </div>
                    <h2><?php the_sub_field( 'name' ); ?></h2>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if ( have_rows( 'tips' ) ) : ?>
        <?php while ( have_rows( 'tips' ) ) : the_row(); ?>
            <div class="tip-section tips-section">
                <div class="tip-image">
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php $size = 'full'; ?>
                    <?php if ( $image ) : ?>
                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                    <?php endif; ?>
                </div>
                <h2><?php the_sub_field( 'name' ); ?></h2>
                <div class="tip-link-grid tips-grid">
                    <?php if ( have_rows( 'tips-child' ) ) : ?>
                        <?php while ( have_rows( 'tips-child' ) ) : the_row(); ?>
                            <div class="tip-link grid-item">
                                <h3><?php the_sub_field( 'name' ); ?></h3>
                                <p><?php the_sub_field( 'tip' ); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

</div>