<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$block_subtitle = $args['block_subtitle'] ?? get_field('block_subtitle');
$btn_text = $args['btn_text'] ?? get_field('btn_text');
$image = $args['image'] ?? get_field('image');
if ($image) {
    $image_url = wp_get_attachment_image_url($image, 'full');
}
?>
<?php if ($btn_text) { ?>
    <div id="callback-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
        <div class="block__content">
            <?php if ($block_title) { ?>
                <h2 class="block-title"><?= $block_title; ?></h2>
            <?php } ?>

            <?php if ($block_subtitle) { ?>
                <div class="block__subtitle p1"><?= $block_subtitle; ?></div>
            <?php } ?>

            <div class="btn" data-modal="callback"><?= $btn_text; ?></div>
        </div>

        <?php if ($image) { ?>
            <div class="block__image">
                <img src="<?= $image_url; ?>" alt="">
            </div>
        <?php } ?>
    </div>
<?php } ?>
