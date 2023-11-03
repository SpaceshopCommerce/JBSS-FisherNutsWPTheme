<?php /* Template Name: Recipe Template Post Type: recipes */ ?>








<div class="recipe-details">
    <?php
        function getValue($field, $index)
        {
            $detail = get_the_field($field);
            if (strpos($detail, " ")) {
                return explode(" ", $detail)[$index];
            }
            return "";
        }
    ?>

    <?php if (get_the_field( 'prep_time' )) : ?>
        <div class="recipe-detail">
            <span class="detail-title">prep</span>
            <?php echo getValue('prep_time', 0) ?>
            <span class="detail-suffix">
                <?php echo getValue('prep_time', 1) ?>
            </span>
        </div>
    <?php endif; ?>


    <?php if (get_the_field( 'cook_time' )) : ?>
        <div class="recipe-detail">
            <span class="detail-title">cook</span>
            <?php echo getValue('cook_time', 0) ?>
            <span class="detail-suffix">
                <?php echo getValue('cook_time', 1) ?>
            </span>
        </div>
    <?php endif; ?>


    <?php if (get_the_field( 'make_amount' )) : ?>
        <div class="recipe-detail">
            <span class="detail-title">cook</span>
            <?php echo getValue('make_amount', 0) ?>
            <span class="detail-suffix">
                <?php echo getValue('make_amount', 1) ?>
            </span>
        </div>
    <?php endif; ?>
</div>