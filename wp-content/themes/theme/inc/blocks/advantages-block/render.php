<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$sections = get_field('sections');
?>
<?php if (!empty($sections)) { ?>
    <div id="advantages-block" class="block-margin block-padding <?= $classes; ?> <?= $align; ?>">
        <?php if ($block_title) { ?>
            <h2 class="block-title"><?= $block_title; ?></h2>
        <?php } ?>

        <div class="sections">
            <?php foreach ($sections as $section) {
                $title = $section['title'];
                $advantages = $section['advantages'];
                ?>
                <div class="section">
                    <?php if ($title) { ?>
                        <h4 class="section__title"><?= $title; ?></h4>
                    <?php } ?>

                    <?php if (!empty($advantages)) { ?>
                        <div class="section__advantages">
                            <?php foreach ($advantages as $advantage) { 
                                $text = $advantage['text'];
                                ?>
                                <div class="advantage p2">
                                    <?= $text; ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
