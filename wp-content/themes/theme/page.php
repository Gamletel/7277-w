<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme
 */


get_header();
?>

    <main id="primary" class="site-main">
        <div class="container">
            <div class="page__content">
                <div class="content__main">
                    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if (function_exists('bcn_display')) {
                            bcn_display();
                        } ?>
                    </div>

                    <h1 class="page-title">
                        <?php the_title(); ?>
                    </h1>

                    <div class="content">
                        <?php the_content(); ?>
                    </div>  
                </div>
                
                <div class="content__sidebar sidebar">
                    <?php get_template_part('templates/sidebar', null, ['item'=>$post]) ?>
                </div>
            </div>
        </div>
    </main><!-- #main -->

<?php
get_footer();
