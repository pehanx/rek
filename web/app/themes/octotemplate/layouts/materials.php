<?php
/*
 * Template Name: Материалы
 *
 * Template Post Type: page
 *
 * The template for displaying Materials page
 *
 * @package wptemplate
 *
 */

get_header();
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$wp_query = new WP_Query([
        'post_type' => 'material',
        'posts_per_page' => 7,
        'paged' => $paged,
]);
$counter = 0;
?>
<section class="usefulpage">
    <div class="usefulpage__bg"></div>
    <div class="usefulpage__wrapp">
        <div class="usefulpage__title">
            <?= get_the_title(); ?>
        </div>
        <?php if (have_posts()): ?>
            <div class="usefulpage__container">

                <?php while ( have_posts()): the_post(); ?>
                <a href="<?= get_permalink(); ?>" class="link-hover-down">
                    <?php
                        $image = get_post_image(get_queried_object_id());
                        if ($image): ?>
                            <?php $url_img = $image['url'] ?>
                        <?php endif; ?>
                    <div class="useful__img" style="background-image: url('<?=$url_img?>')">
                        
                        <div class="useful__containerbg"></div>
                    </div>
                    <div class="useful__containerdate">
                        <?= get_the_date('j M Y'); ?>
                    </div>
                    <div class="useful__containertext">
                        <span class="underline-hover-link">
                            <?= get_the_title(); ?>
                        </span>
                    </div>
                </a>
                <?php endwhile; ?>

                <?php if ($wp_query->max_num_pages > 1) :
                    pagination($wp_query->max_num_pages, 3); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
wp_reset_query();
?>


<?php
get_template_part('parts/footer', 'archive');
get_footer();
