<?php
$postID = $post->ID;
$title = get_the_title($post);
$thumbnail = get_the_post_thumbnail_url($post, 'wide');
$date = get_field('date', $post);
$gallery = get_field('gallery', $post);
?>
<div class="work-card">
    <div class="work-card__thumbnail" data-fancybox='gallery-work-<?= $postID; ?>' data-src="<?= $thumbnail; ?>">
        <?php foreach ($gallery as $image) {
            $image_full = wp_get_attachment_image_url($image, 'full');
            ?>
            <div class="image" style="display: none;" data-fancybox='gallery-work-<?= $postID; ?>'
                 data-src='<?= $image_full; ?>'></div>
        <?php } ?>
        <?php if (!empty($gallery)) { ?>
            <div class="work-card__gallery">
                <div class="gallery__icon">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 10.3334L4.17865 6.62494C4.46116 6.29535 4.60215 6.13058 4.7698 6.07115C4.91691 6.01899 5.07824 6.02013 5.22461 6.07432C5.39142 6.13608 5.53004 6.30277 5.80794 6.63625L7.58556 8.76939C7.84491 9.08061 7.97432 9.23622 8.13204 9.29879C8.27059 9.35374 8.42409 9.36067 8.56706 9.31848C8.72979 9.27046 8.87304 9.12722 9.15951 8.84076L9.49089 8.50938C9.78255 8.21772 9.92838 8.07191 10.0934 8.02427C10.2384 7.98243 10.3931 7.99101 10.5326 8.0486C10.6913 8.11418 10.8205 8.27526 11.0781 8.59735L13.0003 11.0001M13 3.79999V10.2C13 10.9467 13.0001 11.3202 12.8548 11.6054C12.727 11.8563 12.5227 12.0602 12.2719 12.188C11.9866 12.3333 11.6135 12.3334 10.8668 12.3334H3.13346C2.38673 12.3334 2.01308 12.3333 1.72786 12.188C1.47698 12.0602 1.27316 11.8563 1.14532 11.6054C1 11.3202 1 10.9467 1 10.2V3.79999C1 3.05325 1 2.67993 1.14532 2.39471C1.27316 2.14383 1.47698 1.93984 1.72786 1.81201C2.01308 1.66669 2.38673 1.66669 3.13346 1.66669H10.8668C11.6135 1.66669 11.9866 1.66669 12.2719 1.81201C12.5227 1.93984 12.727 2.14383 12.8548 2.39471C13.0001 2.67993 13 3.05325 13 3.79999ZM9 5.66669C8.63181 5.66669 8.33333 5.36821 8.33333 5.00002C8.33333 4.63183 8.63181 4.33335 9 4.33335C9.36819 4.33335 9.66667 4.63183 9.66667 5.00002C9.66667 5.36821 9.36819 5.66669 9 5.66669Z"
                              stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <div class="gallery__count">
                    +<?= count($gallery); ?>
                </div>
            </div>
        <?php } ?>

        <img src="<?= $thumbnail; ?>" alt="">
    </div>

    <div class="work-card__body">
        <?php if ($date) { ?>
            <div class="work-card__date p3"><?= $date; ?></div>
        <?php } ?>

        <h3 class="work-card__title"><?= $title; ?></h3>
    </div>
</div>
