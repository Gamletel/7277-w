<?php
$classes = isset($block['className']) ? $block['className'] : '';
$align = (isset($block['align']) && !empty($block['align'])) ? 'align' . $block['align'] : '';

$block_title = get_field('block_title');
$addresses = @settings('addresses');
$phones = @settings('phones');
$emails = @settings('emails');
$times = @settings('times');
$socials = @settings('socials');
$show_map = get_field('show_map');
?>
<div id="contacts-block" class="block-margin <?= $classes; ?> <?= $align; ?>">
    <?php if ($block_title) { ?>
        <h2 class="block-title"><?= $block_title; ?></h2>
    <?php } ?>

    <div class="contacts">
        <div class="contacts__links">
            <?php if (!empty($addresses)) { ?>
                <?php foreach ($addresses as $item) {
                    $name = $item['name'];
                    $value = $item['value'];
                    ?>
                    <div class="contact">
                        <div class="contact__icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.16797 8.26925C4.16797 12.3124 7.70503 15.656 9.27063 16.9379L9.27125 16.9384C9.49574 17.1222 9.60802 17.2141 9.77534 17.2612C9.90551 17.2979 10.097 17.2979 10.2271 17.2612C10.3946 17.2141 10.5072 17.122 10.7321 16.9379C12.2977 15.656 15.8346 12.3124 15.8346 8.26922C15.8346 6.73913 15.2201 5.27171 14.1261 4.18977C13.0321 3.10783 11.5484 2.5 10.0013 2.5C8.45424 2.5 6.97047 3.10782 5.87651 4.18976C4.78255 5.2717 4.16797 6.73915 4.16797 8.26925Z"
                                      stroke="#015C91" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12.3346 8.33333C12.3346 9.622 11.29 10.6667 10.0013 10.6667C8.71264 10.6667 7.66797 9.622 7.66797 8.33333C7.66797 7.04467 8.71264 6 10.0013 6C11.29 6 12.3346 7.04467 12.3346 8.33333Z"
                                      stroke="#015C91" stroke-width="2"/>
                            </svg>
                        </div>

                        <div class="contact__wrapper">
                            <?php if ($name) { ?>
                                <div class="contact__name p3"><?= $name; ?></div>
                            <?php } ?>

                            <?php if ($value) { ?>
                                <div class="contact__items">
                                    <div class="item">
                                        <?= $value; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>

            <?php if (!empty($phones)) { ?>
                <div class="contact">
                    <div class="contact__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.91912 3.54768C7.66602 2.91492 7.05317 2.5 6.37166 2.5H4.07895C3.20692 2.5 2.5 3.20695 2.5 4.07898C2.5 11.4912 8.50898 17.5 15.9212 17.5C16.7933 17.5 17.5 16.7931 17.5 15.9211L17.4999 13.6284C17.4999 12.9468 17.0849 12.3341 16.4522 12.0809L14.2559 11.2024C13.6876 10.975 13.0404 11.0775 12.5702 11.4694L12.0026 11.9423C11.3404 12.4941 10.3666 12.45 9.75712 11.8405L8.15947 10.2429C7.54994 9.63339 7.50602 8.65961 8.05786 7.9974L8.53068 7.42998C8.92258 6.95969 9.02502 6.31244 8.79766 5.74405L7.91912 3.54768Z"
                                  stroke="#015C91" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="contact__wrapper">
                        <div class="contact__name p3">Номер телефона</div>

                        <div class="contact__items">
                            <?php foreach ($phones as $item) {
                                $name = $item['name'];
                                $value = $item['value'];
                                ?>
                                <?php if ($value && $name) { ?>
                                    <a href="tel:<?= $value; ?>" class="item">
                                        <?= $name; ?>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($emails)) { ?>
                <div class="contact">
                    <div class="contact__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.33333 8.33332L10.1905 13.3333L16.6666 8.33332M5.16683 17.5H14.8335C15.7669 17.5 16.2333 17.5 16.5898 17.3183C16.9034 17.1585 17.1587 16.9035 17.3185 16.5899C17.5002 16.2334 17.5 15.7668 17.5 14.8333V9.61435C17.5 9.14392 17.5 8.90868 17.4402 8.6915C17.3872 8.49909 17.2999 8.31772 17.1828 8.15611C17.0507 7.97368 16.8674 7.82663 16.5002 7.53261L11.8343 3.79688C11.255 3.33303 10.9651 3.10119 10.6429 3.00912C10.3587 2.92789 10.0581 2.92369 9.77169 2.99702C9.44711 3.08013 9.15113 3.30399 8.55917 3.75162L3.55835 7.5331C3.17024 7.82658 2.97603 7.97327 2.8361 8.15873C2.71217 8.323 2.61981 8.50882 2.56354 8.70675C2.5 8.93022 2.5 9.17344 2.5 9.66002V14.8332C2.5 15.7667 2.5 16.2334 2.68166 16.5899C2.84144 16.9035 3.09623 17.1585 3.40983 17.3183C3.76635 17.5 4.23341 17.5 5.16683 17.5Z"
                                  stroke="#015C91" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="contact__wrapper">
                        <div class="contact__name p3">Электронная почта</div>

                        <div class="contact__items">
                            <?php foreach ($emails as $item) {
                                $name = $item['name'];
                                $value = $item['value'];
                                ?>
                                <?php if ($value && $name) { ?>
                                    <a href="mailto:<?= $value; ?>" class="item">
                                        <?= $name; ?>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($times)) { ?>
                <div class="contact">
                    <div class="contact__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 5.83333V10H14.1667M10 17.5C5.85786 17.5 2.5 14.1421 2.5 10C2.5 5.85786 5.85786 2.5 10 2.5C14.1421 2.5 17.5 5.85786 17.5 10C17.5 14.1421 14.1421 17.5 10 17.5Z"
                                  stroke="#015C91" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="contact__wrapper">
                        <div class="contact__name p3">Режим работы</div>

                        <div class="contact__items">
                            <?php foreach ($times as $item) {
                                $value = $item['value'];
                                ?>
                                <?php if ($value) { ?>
                                    <div class="item">
                                        <?= $value; ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($socials)) { ?>
                <div class="socials">
                    <div class="socials__head">
                        <div class="socials__icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.3333 6.66665H16.6667C17.1269 6.66665 17.5 7.03974 17.5 7.49998V16.6666L14.7221 14.359C14.5725 14.2347 14.3844 14.1666 14.1899 14.1666H7.5C7.03976 14.1666 6.66667 13.7936 6.66667 13.3333V10.8333M12.5 3.33331C12.9602 3.33331 13.3333 3.70641 13.3333 4.16665V9.99998C13.3333 10.4602 12.9602 10.8333 12.5 10.8333H5.81014C5.61563 10.8333 5.42753 10.9014 5.27791 11.0257L2.5 13.3333V4.16665C2.5 3.70641 2.8731 3.33331 3.33333 3.33331H12.5Z"
                                      stroke="#015C91" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <div class="contact__name p3">мы в социальных сетях</div>
                    </div>

                    <div class="socials__items">
                        <?php foreach ($socials as $item) {
                            $value = $item['value'];
                            $icon = wp_get_attachment_image_url($item['icon'], 'wide');
                            ?>
                            <?php if ($value) { ?>
                                <a href="<?= $value; ?>" target="_blank" class="social">
                                    <img src="<?= $icon; ?>" alt="" class="style-svg">
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if ($show_map) { ?>
            <div class="contacts__map">
                <?php render_map() ?>
            </div>
        <?php } ?>
    </div>
</div>