<?php
$postID = $post->ID;
$title = get_the_title($post);
$date = get_field('date', $post);
$text = get_field('text', $post);
$images = get_field('images', $post);
?>
<div class="review-card">
    <div class="review-card__head">
        <h5 class="review-card__title"><?= $title; ?></h5>

        <?php if ($date) { ?>
            <div class="review-card__date p3"><?= $date; ?></div>
        <?php } ?>
    </div>

    <?php if ($text) { ?>
        <div class="review-card__text">
            <div class="text-holder p2">
                <?= $text; ?>
            </div>

            <div class="readmore">
                <div class="readmore__text">Читать полностью</div>

                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.75 6H12.25M12.25 6L7.75 1.5M12.25 6L7.75 10.5" stroke="var(--primary)" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    <?php } ?>
    
    <?php if (!empty($images)) {?>
        <div class="review-card__images">
            <?php foreach ($images as $image) { 
                $image_full = wp_get_attachment_image_url($image, 'full');
                $image_wide = wp_get_attachment_image_url($image, 'wide');
                ?>
                <div class="image">
                    <img src="<?= $image_wide; ?>" data-fancybox='review-<?= $postID; ?>' data-src='<?= $image_full; ?>' alt="">
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
