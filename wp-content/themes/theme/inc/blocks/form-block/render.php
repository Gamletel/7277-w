<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$block_subtitle = $args['block_subtitle'] ?? get_field('block_subtitle');
$user = $args['user'] ?? get_field('user');
$user_image = wp_get_attachment_image_url($user['image'], 'wide');
$user_name = $user['name'];
$user_subtitle = $user['subtitle'];
?>
<div id="form-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
    <div class="block__additional">
        <?php if ($block_title) { ?>
            <h2 class="block-title">
                <?= $block_title; ?>
            </h2>
        <?php } ?>

        <?php if ($block_subtitle) { ?>
            <div class="block__subtitle"><?= $block_subtitle; ?></div>
        <?php } ?>

        <?php if ($user_image && $user_name) { ?>
            <div class="block__user">
                <div class="user__image">
                    <div class="image">
                        <img src="<?= $user_image; ?>" alt="">
                    </div>

                    <div class="circle">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15" cy="15" r="12.5" fill="#25D366" stroke="#F2F7F9" stroke-width="5"/>
                        </svg>
                    </div>
                </div>

                <div class="user__content">
                    <h5 class="user__name"><?= $user_name; ?></h5>

                    <?php if ($user_subtitle) { ?>
                        <div class="user__subtitle p3">
                            <?= $user_subtitle; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="block__form">
        <?php get_form('question') ?>
    </div>
</div>