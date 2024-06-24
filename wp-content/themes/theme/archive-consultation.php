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

    <main id="primary" class="archive archive-consultation">
        <div class="container">
            <div class="page__content">
                <div class="content__main">
                    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if (function_exists('bcn_display')) {
                            bcn_display();
                        } ?>
                    </div>

                    <h1 class="page-title">
                        Консультация специалистов
                    </h1>

                    <?php
                    $archive_consultation_form_block = theme('archive_consultation_form_block');
                    get_template_part('inc/blocks/form-block/render',
                        null,
                        array(
                            'block_title' => $archive_consultation_form_block['block_title'],
                            'block_subtitle' => $archive_consultation_form_block['block_subtitle'],
                            'user' => $archive_consultation_form_block['user'],
                        ));
                    wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
                    wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2); ?>

                    <div class="archive__wrapper block-margin">
                        <?php if (have_posts()) { ?>

                            <div class="archive__holder">
                                <?php
                                /* Start the Loop */
                                while (have_posts()) :
                                    the_post();
                                    get_template_part('templates/consultation-card');

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
                    $archive_consultation_form_block_2 = theme('archive_consultation_form_block_2');
                    get_template_part('inc/blocks/form-block/render',
                        null,
                        array(
                            'block_title' => $archive_consultation_form_block_2['block_title'],
                            'block_subtitle' => $archive_consultation_form_block_2['block_subtitle'],
                            'user' => $archive_consultation_form_block_2['user'],
                        ));
                    wp_enqueue_style('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.css', array(), 2);
                    wp_enqueue_script('form-block', get_template_directory_uri() . '/inc/blocks/form-block/block.js', array(), 2);

                    $archive_consultation_callback_block = theme('archive_consultation_callback_block');
                    get_template_part('inc/blocks/callback-block/render',
                        null,
                        array(
                            'block_title' => $archive_consultation_callback_block['block_title'],
                            'block_subtitle' => $archive_consultation_callback_block['block_subtitle'],
                            'btn_text' => $archive_consultation_callback_block['btn_text'],
                            'image' => $archive_consultation_callback_block['image'],
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
