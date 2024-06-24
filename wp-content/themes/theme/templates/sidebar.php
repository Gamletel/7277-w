<?php
$show_sidebar = $args['show'] ?? get_field('show_sidebar', $args['item']);
if ($show_sidebar) {
    $style = $args['style'] ?? get_field('style') ?? 'show';
    $sidebar = theme('sidebar');
    $title = $sidebar['title'];
    $links = $sidebar['links'];
}
if ($show_sidebar && !empty($links)) {
    ?>
    <div class="sidebar-links">
        <div class="items">
            <?php foreach ($links as $item) {
                $type = $item['type'];
                if ($type == 'link') {
                    $link = $item['link'];
                }
                $icon = wp_get_attachment_image_url($item['icon'], 'wide');
                $name = $item['name'];
                ?>
                <?php switch ($type) {
                    case 'link':
                        ?>
                        <a href="<?= $link; ?>" class="item">
                            <div class="item__content">
                                <?php if ($icon) { ?>
                                    <div class="item__icon">
                                        <img src="<?= $icon; ?>" alt="" class="style-svg">
                                    </div>
                                <?php } ?>

                                <h6 class="item__name"><?= $name; ?></h6>
                            </div>
                        </a>
                        <?php
                        break;
                    case 'modal':
                        ?>
                        <div class="item" data-modal="callback">
                            <div class="item__content">
                                <?php if ($icon) { ?>
                                    <div class="item__icon">
                                        <img src="<?= $icon; ?>" alt="" class="style-svg">
                                    </div>
                                <?php } ?>

                                <h6 class="item__name"><?= $name; ?></h6>
                            </div>
                        </div>
                        <?php break;
                }
            } ?>
        </div>
    </div>
<?php } ?>