<?php
$title = get_the_title($post);
$text = get_field('text', $post);
$link_btn = get_field('link_btn', $post);
$link_btn_link = $link_btn['link'];
$link_btn_text = $link_btn['text'];
?>
<div class="consultation-card">
    <h5 class="consultation-card__title"><?= $title; ?></h5>
    
    <?php if ($text) {?>
        <div class="consultation-card__text p2"><?= $text; ?></div>
    <?php } ?>
    
    <?php if ($link_btn_link && $link_btn_text) {?>
        <a href="<?= $link_btn_link; ?>" class="consultation-card__link link">
            <?= $link_btn_text; ?>
            
            <?= inline('assets/images/link.svg'); ?>
        </a>
    <?php } ?>
</div>
