<?php

// the_post();
get_header();

$item = get_queried_object();
$taxonomy = $item->taxonomy;
$term_id = $item->term_id;
$termSlug = $item->slug;

$terms = get_terms('works_categories', [
    'hide_empty' => false,
]);

$archive_link = get_post_type_archive_link('works');
?>
    <main id="primary" class="archive archive-works">
        <div class="container">
            <div class="page__content">
                <div class="content__main">
                    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if (function_exists('bcn_display')) {
                            bcn_display();
                        } ?>
                    </div>

                    <h1 class="page-title">
                        Наши работы
                    </h1>

                    <?php if (!empty($terms)) { ?>
                        <div class="tabs">
                            <a href="<?= $archive_link; ?>" class="tab">
                                Все
                            </a>

                            <?php foreach ($terms as $term) {
                                $link = get_term_link($term);
                                $name = $term->name;
                                $id = $term->term_id;
                                ?>
                                <a href="<?= $link; ?>" class="tab<?php if($id == $term_id){echo ' active';} ?>">
                                    <?= $name; ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (have_posts()) { ?>

                        <div class="archive__holder">
                            <?php
                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();
                                get_template_part('templates/work-card');

                            endwhile; ?>
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
<?php get_footer(); ?>