<?php
/*
 * Template Name: События
 *
 * Template Post Type: page
 *
 * The template for displaying Events page
 *
 * @package wptemplate
 *
 */

get_header();
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$wp_query = new WP_Query([
    'post_type' => 'event',
    'posts_per_page' => EVENTS_PER_PAGE,
    'paged' => $paged,
]);
$counter = 0;
?>
    <section class="news__titleblock">
    <div class="news__titleblockwrapp">
    <h1 class="news__titletitle title">
        <?= get_the_title(); ?>
    </h1>
    <?php if ( have_posts() ) : ?>
        <div class="news__titlecontainer">
        <?php while ( have_posts()) :
            if ($counter < 2):
                the_post();
                $counter++;
                ?>
                <div>
                    <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
                        <div class="news__img">
                            <?php
                            $image = get_post_image(get_queried_object_id());
                            if ($image): ?>
                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                            <?php endif; ?>
                            <div class="news__img__bg"></div>
                        </div>
                        <div class="news__date">
                            <?= get_the_date('j M Y'); ?>
                        </div>
                        <div class="news__title title">
                                            <span class="underline-hover-link">
                                                <?= get_the_title(); ?>
                                            </span>
                        </div>
                    </a>
                </div>
            <?php elseif ($counter === 2):
                $counter++;
                the_post(); ?>
                        </div>
                    </div>
                </section>
                <section class="news__news">
                    <div class="news__container">
                        <div>
                            <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
                                <div class="news__img">
                                    <?php
                                    $image = get_post_image(get_queried_object_id());
                                    if ($image): ?>
                                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                    <?php endif; ?>
                                    <div class="news__img__bg"></div>
                                </div>
                                <div class="news__date">
                                    <?= get_the_date('j M Y'); ?>
                                </div>
                                <div class="news__title title">
                                                <span class="underline-hover-link">
                                                    <?= get_the_title(); ?>
                                                </span>
                                </div>
                            </a>
                        </div>
            <?php else:
                $counter++;
                the_post(); ?>
                <div>
                    <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
                        <div class="news__img">
                            <?php
                            $image = get_post_image(get_queried_object_id());
                            if ($image): ?>
                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                            <?php endif; ?>
                            <div class="news__img__bg"></div>
                        </div>
                        <div class="news__date">
                            <?= get_the_date('j M Y'); ?>
                        </div>
                        <div class="news__title title">
                                <span class="underline-hover-link">
                                    <?= get_the_title(); ?>
                                </span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
    </div>
    <?php if ($wp_query->max_num_pages > 1) :
        pagination($wp_query->max_num_pages, 3); ?>
    <?php endif; ?>
</section>


<?php
wp_reset_query();
get_template_part('parts/footer', 'archive');
get_footer();
