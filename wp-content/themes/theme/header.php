<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme
 */

$logo = wp_get_attachment_image_url(theme('logo_header'), 'full');
$logo_text = theme('logo_text_header');
$phones = @settings('phones');
$emails = theme('emails_header');
$socials = @settings('socials');
$header_socials = theme('socials_header');
$times = @settings('times');
$additional_header = theme('additional_header');
$additional_header_name = $additional_header['name'];
$additional_header_value = $additional_header['value'];
$additional_header_value_array = str_split($additional_header_value);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="site-header">
    <div class="header">
        <div class="header__top">
            <div class="container">
                <div class="header__top-wrapper">
                    <div class="header__top-top">
                        <?php if ($logo || $logo_text) { ?>
                            <a href="/" class="logo">
                                <?php if ($logo) { ?>
                                    <div class="logo__image">
                                        <img src="<?= $logo; ?>" alt="">
                                    </div>
                                <?php } ?>

                                <?php if ($logo_text) { ?>
                                    <span class="logo__text"><?= $logo_text; ?></span>
                                <?php } ?>
                            </a>
                        <?php } ?>

                        <?php if (!empty($phones)) { ?>
                            <div class="phones items">
                                <?php foreach ($phones as $item) {
                                    $value = $item['value'];
                                    $name = $item['name'];
                                    ?>
                                    <a href="tel:<?= $value; ?>" class="item phone">
                                        <div class="item__icon">
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.7939 1.69291C5.5661 1.12343 5.01454 0.75 4.40118 0.75H2.33774C1.55291 0.75 0.916687 1.38626 0.916687 2.17108C0.916687 8.8421 6.32477 14.25 12.9958 14.25C13.7806 14.25 14.4167 13.6138 14.4167 12.829L14.4166 10.7655C14.4166 10.1522 14.0431 9.60065 13.4736 9.37285L11.497 8.58216C10.9855 8.37754 10.4031 8.46976 9.97983 8.82248L9.469 9.24804C8.873 9.7447 7.99667 9.70498 7.44809 9.15641L6.01021 7.71863C5.46163 7.17005 5.4221 6.29365 5.91876 5.69766L6.3443 5.18698C6.69701 4.76372 6.7892 4.1812 6.58458 3.66965L5.7939 1.69291Z"
                                                      stroke="#2C84B6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>

                                        <?= $name; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($emails) || !empty($header_socials)) { ?>
                            <div class="items emails-socials">
                                <?php foreach ($emails as $item) {
                                    $value = $item['value'];
                                    $name = $item['name'];
                                    ?>
                                    <a href="mailto:<?= $value; ?>" class="item email">
                                        <div class="item__icon">
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.33337 6L7.5048 10.5L13.3333 6M2.98352 14.25H11.6835C12.5236 14.25 12.9433 14.25 13.2642 14.0865C13.5465 13.9427 13.7762 13.7132 13.92 13.4309C14.0835 13.1101 14.0834 12.6901 14.0834 11.85V7.15292C14.0834 6.72954 14.0834 6.51782 14.0295 6.32236C13.9819 6.14919 13.9033 5.98596 13.7979 5.84051C13.679 5.67632 13.514 5.54398 13.1835 5.27936L8.98425 1.91721C8.46285 1.49974 8.20193 1.29108 7.91199 1.20822C7.65616 1.13511 7.38565 1.13133 7.12789 1.19733C6.83577 1.27213 6.5694 1.4736 6.03663 1.87647L1.53589 5.2798C1.18659 5.54393 1.0118 5.67595 0.885864 5.84287C0.774324 5.99071 0.691204 6.15795 0.640557 6.33609C0.583374 6.53721 0.583374 6.75611 0.583374 7.19403V11.8499C0.583374 12.69 0.583374 13.1101 0.746864 13.4309C0.890674 13.7132 1.11998 13.9427 1.40222 14.0865C1.72309 14.25 2.14344 14.25 2.98352 14.25Z"
                                                      stroke="#2C84B6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>

                                        <?= $name; ?>
                                    </a>
                                <?php } ?>

                                <?php foreach ($header_socials as $social) {
                                    $icon = wp_get_attachment_image_url($social['icon'], 'wide');
                                    $value = $social['value'];
                                    $name = $social['name'];
                                    ?>
                                    <a href="<?= $value; ?>" class="item social">
                                        <div class="item__icon">
                                            <img src="<?= $icon; ?>" alt="" class="style-svg">
                                        </div>

                                        <?= $name; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($times)) { ?>
                            <div class="times">
                                <div class="times__icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 4.25V8H11.75M8 14.75C4.27208 14.75 1.25 11.7279 1.25 8C1.25 4.27208 4.27208 1.25 8 1.25C11.7279 1.25 14.75 4.27208 14.75 8C14.75 11.7279 11.7279 14.75 8 14.75Z"
                                              stroke="#2C84B6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <div class="times__items">
                                    <?php foreach ($times as $time) {
                                        $value = $time['value'];
                                        ?>
                                        <div class="item p3">
                                            <?= $value; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="header__top-bottom">
                        <?php if ($additional_header_name && $additional_header_value) { ?>
                            <div class="additional">
                                <div class="additional__name p2">
                                    <?= $additional_header_name; ?>
                                </div>

                                <div class="additional__value">
                                    <?php foreach ($additional_header_value_array as $char) { ?>
                                        <div class="char"><?= $char; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php echo do_shortcode('[fibosearch]'); ?>

                        <div class="btns">
                            <a href="<?= wc_get_favorites_url(); ?>" class="favorite-btn wc-btn btn-box-number">
                                <?php
                                $favCount = WCFAVORITES()->count_items();
                                ?>
                                <div class="btn-box">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 10.243C12.5 4.375 3.75 5 3.75 12.5C3.75 20.0001 15 26.25 15 26.25C15 26.25 26.25 20.0001 26.25 12.5C26.25 5 17.5 4.375 15 10.243Z"
                                              stroke="white" stroke-width="1.5" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <div class="number"><?= WCFAVORITES()->count_items(); ?></div>
                            </a>

                            <a href="<?= wc_get_cart_url(); ?>" class="cart-btn wc-btn btn-box-number">
                                <div class="btn-box">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.75 3.75H4.08543C4.67766 3.75 4.97403 3.75 5.21558 3.85685C5.42854 3.95105 5.61089 4.10287 5.74219 4.2952C5.89111 4.51333 5.94473 4.80458 6.05225 5.38696L8.75005 20.0001L21.7744 20C22.3424 20 22.627 20 22.862 19.8997C23.0693 19.8113 23.2486 19.6685 23.3813 19.4864C23.5319 19.28 23.5954 19.0032 23.7231 18.4496L25.6847 9.94965C25.8778 9.11281 25.9745 8.69452 25.8683 8.36578C25.7752 8.07758 25.5799 7.83293 25.32 7.6774C25.0236 7.5 24.5947 7.5 23.7359 7.5H6.44235M22.5 26.25C21.8096 26.25 21.25 25.6904 21.25 25C21.25 24.3096 21.8096 23.75 22.5 23.75C23.1904 23.75 23.75 24.3096 23.75 25C23.75 25.6904 23.1904 26.25 22.5 26.25ZM10 26.25C9.30964 26.25 8.75 25.6904 8.75 25C8.75 24.3096 9.30964 23.75 10 23.75C10.6904 23.75 11.25 24.3096 11.25 25C11.25 25.6904 10.6904 26.25 10 26.25Z"
                                              stroke="white" stroke-width="1.5" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <div class="number">
                                    <?= WC()->cart->get_cart_contents_count(); ?>
                                </div>
                            </a>

                            <div class="burger open_menu">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header__bottom">
            <div class="container">
                <div class="header__bottom-wrapper">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'mobileMenu',
                        'container' => false,
                        'menu' => 'Главное',
                        'menu_class' => 'menuTop',
                        'echo' => true,
                        'fallback_cb' => 'wp_page_menu',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 2,
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div id="bottom-menu" class="bottom-menu">
        <div class="container">
            <div class="bottom-menu__wrapper">
                <a href="<?= wc_get_favorites_url(); ?>" class="favorite-btn wc-btn btn-box-number">
                    <?php
                    $favCount = WCFAVORITES()->count_items();
                    ?>
                    <div class="btn-box">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10.243C12.5 4.375 3.75 5 3.75 12.5C3.75 20.0001 15 26.25 15 26.25C15 26.25 26.25 20.0001 26.25 12.5C26.25 5 17.5 4.375 15 10.243Z"
                                  stroke="white" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="number"><?= WCFAVORITES()->count_items(); ?></div>
                </a>

                <a href="<?= wc_get_cart_url(); ?>" class="cart-btn wc-btn btn-box-number">
                    <div class="btn-box">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.75 3.75H4.08543C4.67766 3.75 4.97403 3.75 5.21558 3.85685C5.42854 3.95105 5.61089 4.10287 5.74219 4.2952C5.89111 4.51333 5.94473 4.80458 6.05225 5.38696L8.75005 20.0001L21.7744 20C22.3424 20 22.627 20 22.862 19.8997C23.0693 19.8113 23.2486 19.6685 23.3813 19.4864C23.5319 19.28 23.5954 19.0032 23.7231 18.4496L25.6847 9.94965C25.8778 9.11281 25.9745 8.69452 25.8683 8.36578C25.7752 8.07758 25.5799 7.83293 25.32 7.6774C25.0236 7.5 24.5947 7.5 23.7359 7.5H6.44235M22.5 26.25C21.8096 26.25 21.25 25.6904 21.25 25C21.25 24.3096 21.8096 23.75 22.5 23.75C23.1904 23.75 23.75 24.3096 23.75 25C23.75 25.6904 23.1904 26.25 22.5 26.25ZM10 26.25C9.30964 26.25 8.75 25.6904 8.75 25C8.75 24.3096 9.30964 23.75 10 23.75C10.6904 23.75 11.25 24.3096 11.25 25C11.25 25.6904 10.6904 26.25 10 26.25Z"
                                  stroke="white" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="number">
                        <?= WC()->cart->get_cart_contents_count(); ?>
                    </div>
                </a>

                <div id="burger-bottom" class="burger open_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <div id="mobile-mnu">
        <div id="close-mnu">×</div>

        <a href="/" class="logo__holder">
            <img src="<?= $logo; ?>" alt="" class="logo">
        </a>

        <?php
        wp_nav_menu([
            'theme_location' => 'mobileMenu',
            'container' => false,
            'menu' => 'Главное',
            'menu_class' => 'menuTop',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 2,
        ]);
        ?>
        <?php if (!empty($phones)) { ?>
            <div class="phones__holder">
                <?php foreach ($phones as $item) { ?>
                    <a href="tel:<?= $item['value']; ?>" class="phone__item">
                        <?= file_get_contents(TEMPLATEPATH . '/assets/images/phone.svg'); ?>
                        <?= $item['name']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (!empty($emails)): ?>
            <div class="email__holder">
                <?php foreach ($emails as $item) { ?>
                    <a href="mailto:<?= $item['value']; ?>" class="email__item">
                        <?= file_get_contents(TEMPLATEPATH . '/assets/images/mail.svg'); ?>
                        <?php echo $item['name']; ?>
                    </a>
                <?php } ?>
            </div>
        <?php endif ?>
        <?php if (!empty($adresses)): ?>
            <div class="adresses__holder">
                <?php foreach ($adresses as $adress) { ?>
                    <?= $adress['value']; ?>
                <?php } ?>
            </div>
        <?php endif ?>
        <?php if (!empty($socials)): ?>
            <div class="soc__holder">
                <?php foreach ($socials as $item) { ?>
                    <a href="<?= $item['value']; ?>" class="soc__item" target="_blank">
                        <?= get_image($item['icon'], [24, 24]); ?>
                    </a>
                <?php } ?>
            </div>
        <?php endif ?>
    </div>
</header><!-- #masthead -->
