<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';


$block_title = get_field('block_title');
$sections = get_field('sections');
$text = get_field('text');
?>
<?php if (!empty($sections)) { ?>
    <div id="text-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>
        
        <?php if ($text) {?>
            <div class="text-block p2"><?= $text; ?></div>
        <?php } ?>

        <div class="sections">
            <?php foreach ($sections as $key => $section) {
                $title = $section['title'];
                $text = $section['text'];
                $image = wp_get_attachment_image_url($section['image'], 'wide');
                
                if ($text) { ?>
                    <div class="section<?php if($key % 2 == 0){echo 'section-reversed';} ?>">
                        <?php if ($title) { ?>
                            <div class="section__title">
                                <div class="text-block p2"><?= $title; ?></div>
                            </div>
                        <?php } ?>
                        
                        <div class="section__wrapper">
                            <div class="section__text text-block p2"><?= $text; ?></div>
                            
                            <?php if ($image) {?>
                                <div class="section__image">
                                    <img src="<?= $image; ?>" alt="">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
<?php } ?>
