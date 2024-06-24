<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme
 */

get_header();
?>
    <main id="primary" class="archive archive-reviews">
        <div class="container">
            <div class="page__content">
                <div class="content__main">
                    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if (function_exists('bcn_display')) {
                            bcn_display();
                        } ?>
                    </div>

                    <h1 class="page-title">
                        Отзывы
                    </h1>

                    <div class="archive__wrapper block-margin">
                        <?php if (have_posts()) { ?>

                            <div class="archive__holder">
                                <?php
                                /* Start the Loop */
                                while (have_posts()) :
                                    the_post();

                                    get_template_part('templates/review-card');
                                endwhile; ?>
                            </div>

                            <?php

                            pagination();

                        } else {

                            get_template_part('template-parts/content', 'none');

                        }
                        ?>
                    </div>

                    <?php
                    $footer_form_block = theme('footer_form_block');
                    get_template_part('inc/blocks/form-block/render',
                        null,
                        array(
                            'block_title' => $footer_form_block['block_title'],
                            'block_subtitle' => $footer_form_block['block_subtitle'],
                            'user' => $footer_form_block['user'],
                        ));
                    wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
                    wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2);

                    $footer_callback_block = theme('footer_callback_block');
                    get_template_part('inc/blocks/callback-block/render',
                        null,
                        array(
                            'block_title' => $footer_callback_block['block_title'],
                            'block_subtitle' => $footer_callback_block['block_subtitle'],
                            'btn_text' => $footer_callback_block['btn_text'],
                            'image' => $footer_callback_block['image'],
                        ));
                    wp_enqueue_style('callback-block', get_template_directory_uri() . '/inc/blocks/callback-block/block.css', array(), 2);
                    wp_enqueue_script('callback-block', get_template_directory_uri() . '/inc/blocks/callback-block/block.js', array(), 2);
                    ?>
                </div>

                <div class="content__sidebar sidebar">
                    <?php get_template_part('templates/sidebar', null, ['show' => true]) ?>
                </div>
            </div>
        </div>
    </main><!-- #main -->

<?php
// get_sidebar();
get_footer();
