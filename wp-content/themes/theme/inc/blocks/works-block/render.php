<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align   = (isset($block['align']) && !empty($block['align'])) ? 'align'.$block['align'] : '';

$block_title = $args['block_title'] ?? get_field('block_title');
$show_all = $args['show_all'] ?? get_field('show_all');
if ($show_all){
    $works = get_posts([
            'numberposts'=>-1,
        'post_type'=>'works'
    ]);
}else{
    $works = $args['works'] ?? get_field('works');
}
?>
<div id="works-block" class="block-margin <?=$classes;?> <?=$align;?>">
    <?php if ($block_title) {?>
        <h2 class="block-title"><?= $block_title; ?></h2>
    <?php } ?>

    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ($works as $work) {
                setup_postdata($work);
                ?>
                <div class="swiper-slide">
                    <?php get_template_part('templates/work-card') ?>
                </div>
            <?php }
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <div class="swiper-additionals">
        <div class="swiper-btns">
            <div class="swiper-btn-prev"><?= inline('assets/images/swiper-btn.svg'); ?></div>
            <div class="swiper-btn-next"><?= inline('assets/images/swiper-btn.svg'); ?></div>
        </div>

        <div class="swiper-pagination"></div>
    </div>
</div>