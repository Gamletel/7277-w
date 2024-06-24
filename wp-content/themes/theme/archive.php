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

    <main id="primary" class="archive">
        <div class="container">
            <div class="page__content">
                <div class="content__main">
                    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if (function_exists('bcn_display')) {
                            bcn_display();
                        } ?>
                    </div>

                    <h1 class="page-title">
                        Архив
                    </h1>

                    <?php if (have_posts()) { ?>

                        <div class="archive__holder">
                            <?php
                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();

                                ?>

                                <a href="<?= get_permalink(get_the_ID()); ?>" class="archive__item">

                                </a>

                            <?php endwhile; ?>
                        </div>

                        <?php

                        pagination();

                    } else {

                        get_template_part('template-parts/content', 'none');

                    }
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
