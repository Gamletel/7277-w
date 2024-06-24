<?php

class WooThemeFunctions
{
    /*
     * WC GLOBAL
     */
    function change_existing_currency_symbol($currency_symbol, $currency)
    {
        switch ($currency) {
            case 'RUB':
                $currency_symbol = 'руб';
                break;
        }
        return $currency_symbol;
    }

    public function error_fade_out()
    {
        // если находимся не на странице оформления заказа, то ничего не делаем
        if (!is_checkout()) {
            return;
        }

        wc_enqueue_js("
		$( document.body ).on( 'checkout_error', function(){
			setTimeout( function(){
				$('.woocommerce-error').fadeOut( 300 );
			}, 2000);
		})
	");
    }

    public function wc_refresh_mini_cart_count($fragments)
    {
        ob_start();
        $products_count = WC()->cart->get_cart_contents_count();
        if ($products_count > 99) {
            $products_count = '99+';
        }
        ?>
        <div id="cart-count">
            <?php echo $products_count; ?>
        </div>
        <?php
        $fragments['#cart-count'] = ob_get_clean();
        return $fragments;
    }

    public function woo_custom_cart_button_text()
    {
        return __('В корзину', 'woocommerce');
    }

    function custom_sale_price($price, $product)
    {
        if ($product->is_type('variable')) {
            $price = '';
            return $price .= '
<div class="product-price">
    <div class="price">
        <div class="regular-price main-price">
        от ' . wc_price($product->get_price()) . '
        </div>
    </div>
</div>';
        }
        if ($product->is_on_sale()) {
            $sale_price = $product->get_sale_price();
            $regular_price = $product->get_regular_price();
            return '
<div class="product-price">
    <div class="price">
        <div class="regular-price additional-price">' . $regular_price . ' ' . get_woocommerce_currency_symbol() . '</div>
        
        <div class="sale-price main-price">' . $sale_price . ' ' . get_woocommerce_currency_symbol() . '</div>
    </div>
</div>';
        } else {
            $regular_price = $product->get_regular_price();
            return '
<div class="product-price">
    <div class="price">
        <div class="regular-price main-price">' . $regular_price . get_woocommerce_currency_symbol() . '</div>
    </div>
</div>';
        }

        return $price;
    }


    function custom_variable_product_price($price, $product)
    {
        $prices = $product->get_variation_prices('min', true);
        $maxprices = $product->get_variation_price('max', true);
        $min_price = current($prices['price']);
        //$max_price = current( $maxprices['price'] );
        $minPrice = sprintf(__('От %1$s <br>', 'woocommerce'), wc_price($min_price));
        $maxPrice = sprintf(__('до %1$s', 'woocommerce'), wc_price($maxprices));
        return $minPrice . ' ' . $maxPrice;
    }

    public function custom_breadcrumbs()
    {
        ?>
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
            <?php if (function_exists('bcn_display')) {
                bcn_display();
            } ?>
        </div>
    <?php }

    public function register_my_widgets()
    {
        register_sidebar(
            array(
                'name' => 'Фильтр товаров',
                'id' => "sidebar-shop",
                'description' => '',
                'class' => '',
                'before_sidebar' => '',
                'after_sidebar' => '',
            )
        );
    }

    /*
     * CATEGORY-CARD
     */

    public function remove_count()
    {
        $html = '';
        return $html;
    }

    public function add_category_background()
    {
        inline('assets/images/category-bg.svg');
    }

    public function category_image_wrapper($category)
    {
        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
        $image = wp_get_attachment_image_src($thumbnail_id, 'full');
        $image = $image[0];
        $image = str_replace(' ', '%20', $image);
        ?>
        <div class="image-wrapper">
            <img src="<?= esc_url($image); ?>" alt="">
        </div>
        <?php
    }

    public function open_category_content_wrapper()
    {
        ?>
        <div class="category-content">
    <?php }

    public function category_link($category)
    {
        $link = get_category_link($category);
        $terms = get_terms('product_cat', [
            'hide_empty' => false,
            'parent' => $category->term_id,
        ]);
        ?>

        <?php if (!$terms && !is_product_category()) { ?>
        <a href="<?= $link; ?>" class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </a>
    <?php } else if (is_product_category()) { ?>
        <div class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </div>

        <div class="subcats">
            <div class="container">
                <div class="close-subcats">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <g clip-path="url(#clip0_528_41776)">
                            <path d="M11.0518 0L7 4.05177L2.94823 0L0 2.94823L4.0518 7L0 11.0518L2.9482 14L7 9.9482L11.0518 14L14 11.0518L9.9482 6.99997L14 2.9482L11.0518 0Z"
                                  fill="#C9CCCE"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_528_41776">
                                <rect width="14" height="14" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>

                <div class="subcats__wrapper">
                    <?php foreach ($terms as $item) {
                        $link = get_term_link($item);
                        $title = $item->name;
                        $thumbnail_id = get_term_meta($item->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_image_src($thumbnail_id, 'full');
                        $image = $image[0];
                        $image = str_replace(' ', '%20', $image);
                        ?>
                        <a href="<?= $link; ?>" class="subcat">
                            <?php if ($image) { ?>
                                <img src="<?= esc_url($image); ?>" alt="" class="subcat__thumbnail">
                            <?php } ?>

                            <?php if ($title) { ?>
                                <span class="p2 subcat__title">
                                    <?= $title; ?>
                                </span>
                            <?php } ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <a href="<?= $link; ?>" class="link">
            Подробнее

            <?= inline('assets/images/arrow.svg'); ?>
        </a>
    <?php }
    }

    public function close_category_content_wrapper()
    {
        ?>
        </div>
    <?php }

    public function custom_category_top_part($category)
    {
        $shortDescription = get_field('s-description', $category);
        ?>
        <div class="category-top">
            <h4 class="woocommerce-loop-category__title">
                <?php
                echo esc_html($category->name);
                if ($category->count > 0) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html($category->count) . ')</mark>', $category);
                }
                ?>
            </h4>

            <div class="btn-main disabled-color">
                Подробнее
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <?php
            if ($shortDescription) { ?>
                <div class="short-descr">
                    <?php echo $shortDescription; ?>
                </div>
                <?php
            } ?>
        </div>
        <?php
    }

    /*
     * ARCHIVE-PRODUCT
     */
    public function pp_custom_scripts_enqueue()
    {

        $theme = wp_get_theme(); // Get the current theme version numbers for bumping scripts to load

        // Make sure jQuery is being enqueued, otherwise you will need to do this.

        // Register custom scripts
        wp_register_script('woocommerce_load_more', get_theme_file_uri() . '/assets/js/loadmore-products.js', array('jquery'), $theme['Version'], true); // Register script with depenancies and version in the footer

        // Enqueue scripts
        wp_enqueue_script('woocommerce_load_more');


        global $wp_query; // Make sure important query information is available

        // Use wp_localize_script to output some variables in the html of each WordPress page
        // These variables/parameters are accessible to the load_more.js file we enqueued above
        $localize_var_args = array(
            'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages,
            'ajaxurl' => admin_url('admin-ajax.php')

        );
        wp_localize_script('woocommerce_load_more', 'wp_js_vars', $localize_var_args);

    }

    public function pp_loadmore_ajax_handler()
    {

        // prepare our arguments for the query
        $args = json_decode(stripslashes($_POST['query']), true);
        $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
        $args['post_status'] = 'publish';


        query_posts($args);

        if (have_posts()) :

            // run the loop
            while (have_posts()): the_post();

                wc_get_template_part('content', 'product');  // As we are loaded Woocommerce products we use wc_get_template_part
                //echo '<p>'.get_the_title().'</p>'; // for the test purposes comment the line above and uncomment the below one

            endwhile;

        endif;
        die; // Exit the script, wp_reset_query() required!

    }

    public function pp_woocommerce_products_load_more()
    {
        global $wp_query;

        if ($wp_query->max_num_pages > 1) {
            echo '<div id="pp_loadmore_products" class="btn-mini transparent" style="margin: 40px auto 0px;">Показать еще</div>';
        }

    }

    public function products_per_page($cols)
    {
        return 12;
    }

    function wp_kama_woocommerce_show_page_title_filter($title)
    {

        if (is_product_category() || is_product_taxonomy()) {
            return false;
        } else {
            return true;
        }
    }

    public function archive_category_banner()
    {
        if (is_product_taxonomy()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $term_id = $term->term_id;
            $title = $term->name;
            $banner_description = get_field('banner_description', $term);
            $archive_image = wp_get_attachment_image_url(get_field('banner_image', $term), 'wide');
            $banner_btn = get_field('banner_btn', $term);
            $banner_btn_link = $banner_btn['link'];
            $banner_btn_text = $banner_btn['text'];
            $subcategories = get_terms(array(
                'hide_empty' => false,
                'taxonomy' => 'product_cat',
                'parent' => $query_id,
            ));
            ?>
            <div class="header__main-banner alignfull">
                <div class="main-banner__bg">
                    <img src="<?= get_theme_file_uri(); ?>/assets/images/archive-banner-bg.png" alt="">
                </div>
                <div class="main-banner__text">
                    <h1 class="main-banner__title">
                        <?= $title; ?>
                    </h1>

                    <?php if ($banner_description) { ?>
                        <div class="main-banner__description p1">
                            <?= $banner_description; ?>
                        </div>
                    <?php } ?>

                    <?php if ($banner_btn_link && $banner_btn_text) { ?>
                        <a href="<?= $banner_btn_link; ?>"
                           class="main-banner__btn btn-mini"><?= $banner_btn_text; ?></a>
                    <?php } ?>
                </div>

                <?php if ($archive_image) { ?>
                    <div class="main-banner__image">
                        <img src="<?= $archive_image; ?>" alt="">
                    </div>
                <?php } ?>
            </div>


            <?php if (!empty($subcategories)) { ?>
                <div class="header__subcategories block-margin">
                    <?php foreach ($subcategories as $item) {
                        $link = get_term_link($item);
                        $name = $item->name;
                        $thumbnail_id = get_woocommerce_term_meta($item->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);
                        $description = $item->description;
                        ?>
                        <a href="<?= $link; ?>" class="subcategory">
                            <?php if ($image) { ?>
                                <div class="subcategory__thumbnail">
                                    <img src="<?= $image; ?>" alt="" class="style-svg">
                                </div>
                            <?php } ?>

                            <h5 class="subcategory__name">
                                <?php if ($description) {
                                    echo $description;
                                } else {
                                    echo $name;
                                } ?>
                            </h5>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php
        }
    }

    public function archive_categories()
    {
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'parent' => 0
        ]);
        ?>
        <?php if (!is_product_taxonomy()) { ?>
        <?php if (!empty($categories) && is_array($categories)) { ?>
            <div class="archive__categories block-margin">
                <?php foreach ($categories as $item) {
                    get_template_part('templates/product-cat', null, array('item' => $item));
                } ?>
            </div>
        <?php } ?>
    <?php }
    }

    public function archive_subcategories()
    {
        if (!is_shop()) {
            $query_id = get_queried_object_id();
            $term = get_term($query_id);
            $terms = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => $query_id,
                'hide_empty' => false,
            ));

            get_template_part('inc/blocks/categories-block/render',
                null,
                array('terms' => $terms,
                ));
            wp_enqueue_style('categories-block', get_template_directory_uri() . '/inc/blocks/categories-block/block.css', array(), 2);
            wp_enqueue_script('categories-block', get_template_directory_uri() . '/inc/blocks/categories-block/block.js', array(), 2);
        }
    }

    public function archive_products_title()
    {
        echo '<div class="container">
                <h1 class="page-title">
                    Каталог
                </h1>
              </div>';
    }

    public function archive_products_advantages()
    {
        $archive_products_advantages = theme('archive_products_advantages');
        if (is_product_category()) {
            ?>
            <div class="container">
                <?php get_template_part('inc/blocks/advantages-v2-block/render',
                    null,
                    array('advantages' => $archive_products_advantages['advantages'],
                        'image_1' => $archive_products_advantages['image_1'],
                        'image_2' => $archive_products_advantages['image_2'],
                    ));
                wp_enqueue_style('advantages-v2-block', get_template_directory_uri() . '/inc/blocks/advantages-v2-block/block.css', array(), 2);
                wp_enqueue_script('advantages-v2-block', get_template_directory_uri() . '/inc/blocks/advantages-v2-block/block.js', array(), 2);
                ?>
            </div>
            <?php
        }
    }

    public function archive_products_additional_blocks()
    {
        $query_id = get_queried_object_id();
        $term = get_term($query_id);
        $stocks_block = get_field('stocks_block', $term);
        $footer_form_block = theme('footer_form_block');
        $seo_block = get_field('seo_block', $term);
        $seo_block_text = $seo_block['text'];
        ?>
        <div class="catalog__additional-blocks">
            <div class="container">
                <?php
                get_template_part('inc/blocks/stocks-block/render',
                    null,
                    array(
                        'block_title' => $stocks_block['block_title'],
                        'show_all' => $stocks_block['show_all'],
                        'stocks' => $stocks_block['stocks'],
                    ));
                wp_enqueue_style('stocks-block', get_template_directory_uri() . '/inc/blocks/stocks-block/block.css', array(), 2);
                wp_enqueue_script('stocks-block', get_template_directory_uri() . '/inc/blocks/stocks-block/block.js', array(), 2);

                get_template_part('inc/blocks/form-block/render',
                    null,
                    array(
                        'block_title' => $footer_form_block['block_title'],
                        'block_subtitle' => $footer_form_block['block_subtitle'],
                        'image' => $footer_form_block['image'],
                    ));
                wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
                wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2);

                get_template_part('inc/blocks/seo-block/render',
                    null,
                    array(
                        'block_title' => $seo_block['block_title'],
                        'text' => $seo_block['text'],
                        'image' => $seo_block['image'],
                    ));
                wp_enqueue_style('seo-block', get_template_directory_uri() . '/inc/blocks/seo-block/block.css', array(), 2);
                wp_enqueue_script('seo-block', get_template_directory_uri() . '/inc/blocks/seo-block/block.js', array(), 2);
                ?>
            </div>
        </div>
        <?php
    }

    /*
     * PRODUCT-CARD
     */
    public function open_product_card_top_part()
    { ?>
        <div class="product-card__top">
    <?php }

    public function product_card_tags()
    {
        global $product;
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'include' => $product->get_tag_ids()
        ]);
        ?>
        <?php if ($terms) { ?>
        <div class="product-card__tags tags">
            <?php foreach ($terms as $term) {
                $name = $term->name;
                ?>
                <div class="tag"><?= $name; ?></div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php }

    public function close_product_card_top_part()
    { ?>
        </div>
    <?php }

    public function product_card_top_part()
    {
        global $product;
        $tags = $product->tag_ids;
        $thumbnail = woocommerce_get_product_thumbnail('full');
        ?>
        <div class="product-card__top">
            <?php if ($tags) { ?>
                <div class="product-card__tags tags">
                    <?php foreach ($tags as $tag) {
                        $term = get_term($tag);
                        $name = $term->name;
                        $text_color = get_field('text_color', $term);
                        $bg_color = get_field('bg_color', $term);
                        $tag_style = 'style="background-color:' . $bg_color . '; color: var(--card);"';
                        ?>
                        <div class="tag p3" <?= $tag_style; ?>>
                            <?= $name; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="product-card__thumbnail">
                <?= $thumbnail; ?>
            </div>
        </div>
        <?php
    }

    public function product_card_bottom_part()
    {
        global $product;
        $card_additional_text = get_field('card_additional_text', $product->get_id());
        $short_description = $product->get_short_description();
        ?>
        <div class="product-card__bottom">
            <?php woocommerce_template_loop_product_title(); ?>

            <?php if ($card_additional_text) { ?>
                <div class="product-card__additional-text p3"><?= $card_additional_text; ?></div>
            <?php } ?>

            <?php if ($short_description) { ?>
                <div class="product-card__short-description p3"><?= $short_description; ?></div>
            <?php } ?>

            <div class="product-card__price">
                <?= $product->get_price_html(); ?>

                <div class="price__bottom">
                    <?= woocommerce_template_loop_add_to_cart(); ?>

                    <?php $this->add_to_favorite_btn(); ?>
                </div>
            </div>
        </div>
    <?php }

    function wp_kama_woocommerce_product_add_to_cart_text_filter($__, $that)
    {
        global $product;

        if ($product->is_type('simple')) {
            $that = 'В корзину';
        } else {
            $that = 'Перейти';
        }
        return $that;
    }

    /*
     * PRODUCT-PAGE
     */
    public function show_custom_title()
    {
        global $product;
        echo '<h1 class="single-product__title">' . get_the_title($product->get_id()) . '</h1>';
    }

    public function show_nutritional_value()
    {
        global $product;
        $nutritional_value = get_field('nutritional_value', $product->get_id());

        if (!empty($nutritional_value) ?? is_array($nutritional_value)) {
            ?>
            <div class="single-product__nutritional_values">
                <h5 class="nutritional_values__title">Пищевая ценность на 100г продукта:</h5>

                <div class="nutritional_values__wrapper">
                    <?php foreach ($nutritional_value as $item) {
                        $name = $item['name'];
                        $value = $item['value'];
                        ?>
                        <div class="item">
                            <?php if ($name) { ?>
                                <div class="item__name p3"><?= $name; ?></div>
                            <?php } ?>

                            <?php if ($value) { ?>
                                <div class="item__value"><?= $value; ?></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }

    public function show_additional_text()
    {
        global $product;
        $additional_text = get_field('additional_text');
        ?>
        <?php if ($additional_text) { ?>
        <div class="single-product__additional-text p3"><?= $additional_text; ?></div>
    <?php }
    }

    public function show_composition()
    {
        global $product;
        $composition = get_field('composition');
        ?>
        <?php if ($composition) { ?>
        <div class="single-product__composition">
            <h4 class="composition__title">Состав</h4>

            <div class="composition__text p2">
                <?= $composition; ?>
            </div>
        </div>
    <?php }
    }

    public function custom_product_swiper()
    {
        global $product;

        $thumbnail = woocommerce_get_product_thumbnail('full');
        ?>

        <div class="single-product__gallery">
            <?php if ($thumbnail) { ?>
                <div class="image" data-fancybox='gallery-product-thumbnail' data-src='<?= $thumbnail; ?>'>
                    <?= $thumbnail; ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }

    public function open_product_main_info()
    { ?>
        <div class="single-product__main-info">
    <?php }

    public function close_product_main_info()
    {
        ?>
        </div>
    <?php }

    public function product_info()
    {
        global $product;

        ?>
        <div class="single-product__info">
            <div class="single-product__info-bottom">
                <?php if ($product->is_type('simple')) { ?>
                    <div class="single-product__price">
                        <?= $product->get_price_html() ?>
                    </div>
                <?php } ?>

                <div class="single-product__btns <?php if ($product->is_type('simple')) {
                    echo 'single-product__btns-simple';
                } ?>">
                    <?= woocommerce_template_single_add_to_cart(); ?>
                </div>

                <?php /*if ($product->is_type('simple')) { */ ?><!--
                    <?php /*$this->add_to_favorite_btn(); */ ?>
                --><?php /*} */ ?>
            </div>
        </div>
        <?php
    }

    public function top_row()
    {
        global $product;
        $terms = get_terms([
            'taxonomy' => 'product_tag',
            'include' => $product->get_tag_ids()
        ]);
        ?>
        <div class="top-row">
            <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
                <span class="sku_wrapper p3"><?php esc_html_e('SKU:', 'woocommerce'); ?> <span
                            class="sku p3"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span></span>
            <?php endif; ?>

            <?php if ($terms) { ?>
                <div class="tags">
                    <?php foreach ($terms as $term) {
                        $name = $term->name;
                        ?>
                        <div class="tag"><?= $name; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php }

    public function additional_attributes()
    {
        global $product;
        $additional_attributes = get_field('additional_attributes', $product->get_id());
        if ($additional_attributes) { ?>
            <div class="additional-attributes">
                <?php foreach ($additional_attributes as $item) {
                    $icon = wp_get_attachment_image_url($item['icon'], 'full');
                    $value = $item['value'];
                    ?>
                    <div class="additional-attribute">
                        <?php if ($icon) { ?>
                            <img src="<?= $icon; ?>" alt="" class="style-svg">
                        <?php } ?>

                        <?php if ($value) { ?>
                            <div class="p2"><?= $value; ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }

    public function show_additional_options()
    {
        global $product;
        $additional_options = get_field('additional_options', $product->get_id());
        if ($additional_options) { ?>
            <div class="additional-options">
                <div class="p2 additional-options__title">Дополнительные опции</div>

                <div class="additional-options__wrapper">
                    <?php foreach ($additional_options as $key => $option) {
                        $name = $option['name'];
                        ?>
                        <div class="additional-option">
                            <input type="checkbox" name="additional-option" id="additional-option-<?= $key; ?>"
                                   class="additional-option__checkbox">

                            <label class="p2 additional-option__title"
                                   for="additional-option-<?= $key; ?>">
                                <div class="additional-option__checkbox-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="7" viewBox="0 0 9 7"
                                         fill="none">
                                        <path d="M1 3.50002L3.33348 6L8 1" stroke="#34A0E1" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <?= $name; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php }

    public function show_variation_title()
    {
        echo '<div class="p2 variation-price-title">Стоимость</div>';
    }

    public function woocommerce_custom_single_add_to_cart_text()
    {
        return __('Добавить в корзину', 'woocommerce');
    }

    public function add_to_favorite_btn()
    {
        global $product;
        $in_favorites = WCFAVORITES()->check_item($product->get_id());
        $text = get_option('favorites_category_product_text', 'В избранные');
        ?>

        <button type="button" data-product_id="<?= $product->get_id() ?>"
                class="favorites ajax_add_to_favorites btn-circle card <?php if ($in_favorites) {
                    echo 'added';
                } ?>" aria-label="<?= $text ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M19.0714 13.1421L13.4146 18.799C12.6335 19.58 11.3672 19.58 10.5862 18.799L4.92931 13.1421C2.97669 11.1895 2.97669 8.02369 4.92931 6.07107C6.88193 4.11845 10.0478 4.11845 12.0004 6.07107C13.953 4.11845 17.1188 4.11845 19.0714 6.07107C21.0241 8.02369 21.0241 11.1895 19.0714 13.1421Z"
                      stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    <?php }

    public function product_description()
    {
        global $product;

//        $attributes = $product->get_attributes();
        $description = $product->get_description();
//        $services = get_field('services_block', $product->get_id());
//        $related_products = wc_get_related_products($product->get_id(), 6);
        ?>
        <div class="single-product__bottom-block block-margin">
            <div class="content">
                <?php if (!empty($description)) { ?>
                    <div class="single-product__description">
                        <div class="container">
                            <div class="description__content">
                                <h2 class="description__title">Описание</h2>

                                <div class="description__text p2"><?= $description; ?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }

    public function product_additional_blocks()
    {
        global $product;
        $related_products = wc_get_related_products($product->get_id(), 7);
        ?>
        <div class="container">
            <div class="product__additional-blocks">
                <?php
                get_template_part('inc/blocks/products-block/render',
                    null,
                    array('block_title' => 'Другие товары',
                        'products' => $related_products,
                    ));
                wp_enqueue_style('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.css', array(), 2);
                wp_enqueue_script('products-block', get_template_directory_uri() . '/inc/blocks/products-block/block.js', array(), 2);

                $stocks_block = get_field('stocks_block', $product->get_id());
                get_template_part('inc/blocks/stocks-block/render',
                    null,
                    array(
                        'block_title' => $stocks_block['block_title'],
                        'show_all' => $stocks_block['show_all'],
                        'stocks' => $stocks_block['stocks'],
                    ));
                wp_enqueue_style('stocks-block', get_template_directory_uri() . '/inc/blocks/stocks-block/block.css', array(), 2);
                wp_enqueue_script('stocks-block', get_template_directory_uri() . '/inc/blocks/stocks-block/block.js', array(), 2);

                $footer_form_block = theme('footer_form_block');
                get_template_part('inc/blocks/form-block/render',
                    null,
                    array(
                        'block_title' => $footer_form_block['block_title'],
                        'block_subtitle' => $footer_form_block['block_subtitle'],
                        'image' => $footer_form_block['image'],
                    ));
                wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
                wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2);

                $product_seo_block = get_field('product_seo_block');
                get_template_part('inc/blocks/seo-block/render',
                    null,
                    array(
                        'block_title' => $product_seo_block['block_title'],
                        'text' => $product_seo_block['text'],
                        'image' => $product_seo_block['image'],
                    ));
                wp_enqueue_style('seo-block', get_template_directory_uri() . '/inc/blocks/seo-block/block.css', array(), 2);
                wp_enqueue_script('seo-block', get_template_directory_uri() . '/inc/blocks/seo-block/block.js', array(), 2);
                ?>
            </div>
        </div>
    <?php }

    public function if_product_not_stock()
    {
        global $product;

        if ($product->get_price() == '') {
            echo '<p class="stock out-of-stock">Товар отсутсвует</p>';
        }
    }

    public function jk_related_products_args($args)
    {
        $args['posts_per_page'] = 5; // количество "Похожих товаров"
        return $args;
    }

    /*
     * PAGE-CART
     */
    public function custom_cart_item_price($price, $values, $cart_item_key)
    {

        $is_on_sale = $values['data']->is_on_sale();
        $_product = $values['data'];
        $regular_price = $_product->get_regular_price();

        if ($is_on_sale) {
            $sale_price = $_product->get_sale_price();
            $regular_price = $_product->get_regular_price();
            $sale_percent = '-' . 100 - ($sale_price / $regular_price * 100) . '%';

            $price = '
<div class="product-price">
    <div class="main-price regular-price">' . wc_price($regular_price) . '</div>
    
    <div class="sale-percent p3">' . $sale_percent . '</div>
</div>';
        } else {
            $price = '
<div class="product-price">
    <h4 class="main-price">' . wc_price($regular_price) . '</h4>
</div>';
        }

        return $price;
    }

    public function show_product_additional_text($cart_item)
    {
        $additional_text = get_field('additional_text', $cart_item['product_id']);
        ?>
        <?php if ($additional_text) { ?>
        <div class="product-additional-text p3"><?= $additional_text; ?></div>
    <?php } ?>
        <?php
    }

    public function cart_products_amount()
    {
        ?>
        <div class="cart-count">
            <h5 class="count__title">Товаров<br> в корзине</h5>

            <h5 class="count__number"><?= WC()->cart->get_cart_contents_count() ?> шт</h5>
        </div>
        <?php
    }

    public function filter_woocommerce_cart_subtotal($subtotal, $compound, $cart)
    {
        $subtotal = 0;
        foreach (WC()->cart->get_cart() as $key => $cart_item) {
            $subtotal += $cart_item['data']->get_regular_price() * $cart_item['quantity'];
        }
        $subtotal = wc_price($subtotal);
        return $subtotal;
    }

    public function print_cart_weight()
    {
        ?>
        <tr class="order-weight">
            <th class="p1">Общая масса</th>

            <td data-title="Масса"><?= WC()->cart->get_cart_contents_weight(); ?> кг</td>
        </tr>
        <?php
    }

    public function print_cart_volume()
    {
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        $totalVolume = 0;

        foreach ($items as $item => $values) {
            $_product = wc_get_product($values['data']->get_id());
            $volume = get_field('volume', $_product->get_id());
            $quantity = $values['quantity'];
            if ($volume) {
                $totalVolume += $volume * $quantity;
            }
        }
        ?>
        <tr class="order-volume">
            <th class="p1">Объем</th>

            <td data-title="Масса"><?= $totalVolume; ?> м <sup class="number">3</sup>
            </td>
        </tr>
        <?php
    }

    public function custom_woocommerce_empty_cart_action()
    {
        if (isset($_GET['empty_cart']) && 'yes' === esc_html($_GET['empty_cart'])) {
            WC()->cart->empty_cart();

            $referer = wp_get_referer() ? esc_url(remove_query_arg('empty_cart')) : wc_get_cart_url();
            wp_safe_redirect($referer);
        }
    }

    public function custom_woocommerce_empty_cart_button()
    {
        echo '<a href="' . esc_url(add_query_arg('empty_cart', 'yes')) . '" class="clear-cart p3" title="' . esc_attr('Empty Cart', 'woocommerce') . '">
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
  <path d="M7.5 7L17.5 17M7.5 17L17.5 7" stroke="#959595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

Очистить корзину
</a>';
    }

    public function invoice()
    {
        ?>
        <div id="invoice-btn" class="btn invert">Сформировать накладную</div>
        <?php
    }

    /*
     * PAGE-CHECKOUT
     */
    public function carrie_customer_default_shipping_country($value, $customer)
    {
        $value = !empty($value) ? $value : 'RU';
        return $value;
    }

    public function custom_override_checkout_fields($fields)
    {
        unset($fields['billing']['billing_country']); // Отключаем страны оплаты
        unset($fields['shipping']['shipping_country']);// Отключаем страны доставки
        return $fields;
    }

    public function custom_thankyou_text($order, $permission)
    {
        $order = 'Заказ успешно оформлен!';

        return $order;
    }

    public function custom_checkout_order_review()
    {
        ?>
        <div class="cart-count">
            <div class="p2 count__title">Товаров <br> в корзине</div>

            <h6 class="count__number"><?= WC()->cart->get_cart_contents_count() ?></h6>
        </div>
        <?php
    }

    public function open_additional_field_block()
    {
        ?>
        <div class="additional-section__wrapper">
        <h4>Адрес доставки</h4>
        <div class="additional-section__fields">
        <?php
    }

    public function close_additional_field_block()
    {
        ?>
        </div>
        </div>
        <?php
    }

    public function show_shipping_methods()
    {
        ?>
        <div class="shipping-methods-wrapper">
            <h4 class="inputs__title">Способ получения</h4>

            <?php wc_cart_totals_shipping_html(); ?>
        </div>
        <?php
    }

    public function change_cart_shipping_method_full_label($label, $method)
    {
        $price = $method->cost > 0 ? '(+' . $method->cost . ' руб.)' : '(Бесплатно)';
        $label = '
<div class="method__content">
    <div class="method__text">
        <h5 class="method__name">' . $method->get_label() . '</h5>
    
    </div>
    
    <div class="method__price p3">' . $price . '</div>
</div>';

        return $label;
    }

    public function open_payment_methods_block()
    { ?>
        <div class="payment-methods-wrapper">
        <h4 class="inputs__title">Способы оплаты</h4>
    <?php }

    public function close_payment_methods_block()
    { ?>
        </div>
        <?php
    }

    public function second_place_order_button()
    {
        $order_button_text = apply_filters('woocommerce_order_button_text', __("Оформить заказ"));
        echo '<button type="submit" class="button btn alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>';

        wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce');
    }

    /*
     * THANKS
     * */
    public function block_after_thanks_info()
    {
        $after_thanks_title = theme('after_thanks_title');
        $after_thanks_subtitle = theme('after_thanks_subtitle');

        if ($after_thanks_title || $after_thanks_subtitle) { ?>
            <div class="after-thanks block-margin alignfull">
                <div class="after-thanks__bg-left">
                    <img src="<?= get_theme_file_uri(); ?>/assets/images/after-thanks-bg-left.png" alt="">
                </div>
                <div class="after-thanks__bg-center">
                    <img src="<?= get_theme_file_uri(); ?>/assets/images/after-thanks-bg-center.png" alt="">
                </div>
                <div class="after-thanks__bg-right">
                    <img src="<?= get_theme_file_uri(); ?>/assets/images/after-thanks-bg-right.png" alt="">
                </div>

                <div class="container">
                    <div class="after-thanks__content">
                        <?php if ($after_thanks_title) { ?>
                            <div class="after-thanks__title"><?= $after_thanks_title; ?></div>
                        <?php } ?>

                        <?php if ($after_thanks_subtitle) { ?>
                            <div class="after-thanks__subtitle"><?= $after_thanks_subtitle; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php }
    }

    /*
     * PAGE-FAVORITES
     * */

    public function updateFavorites()
    {
        if (WCFAVORITES()->count_items() > 99) {
            echo '99+';
        } else {
            echo WCFAVORITES()->count_items();
        }
        wp_die();
    }

    public function wc_clear_favorite_url()
    {
        if (isset($_REQUEST['clear-fav'])) {
            unset($_COOKIE['WC_FAVORITES']);
        }
    }

    public function custom_favorite_item_price()
    {
        global $product;

        $is_variable = $product->is_type('variable');
        $is_on_sale = $product->is_on_sale();
//        var_dump($is_on_sale);
        $_product = $product;
        $regular_price = $_product->get_regular_price();

        if ($is_variable) {
            ?>
            <div class="product-price">
                <div class="main-price regular-price">от <?= wc_price($product->get_price()); ?></div>
            </div>
            <?php
        } else {
            if ($is_on_sale) {
                $sale_price = $_product->get_sale_price();
                $regular_price = $_product->get_regular_price();
                $sale_percent = '-' . 100 - ($sale_price / $regular_price * 100) . '%';
                ?>
                <div class="product-price">
                    <div class="main-price regular-price"><?= wc_price($regular_price); ?></div>

                    <div class="sale-percent p3"><?= $sale_percent; ?></div>
                </div>
            <?php } else {
                ?>
                <div class="product-price">
                <h4 class="main-price"><?= wc_price($regular_price); ?></h4>
                </div<?php
            }
        }
    }
}