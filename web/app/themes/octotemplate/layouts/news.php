<?php
/*
 * Template Name: Новости
 *
 * Template Post Type: page
 *
 * The template for displaying News page
 *
 * @package wptemplate
 *
 */

get_header();
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$wp_query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => NEWS_PER_PAGE,
        'paged' => $paged,
]);
$counter = 0;
?>
<section class="news__titleblock">
    <div class="news__titleblockwrapp">
        <h1 class="news__titletitle title">
            <?= get_the_title(); ?>
        </h1>
    </div>
</section>
<section class="news__news">
    <div class="result__main bg_events events_list">
        <?php if ( have_posts() ) : ?>
            <div class="news__titlecontainer be-ajax-loadmore-container" style="margin-top: 70px">
                <?php while ( have_posts()) :
                        the_post();
                        get_template_part('parts/list_element', 'news');  
                endwhile; ?>
            </div>
        <?php endif;?>
        <?php
            if ($wp_query->max_num_pages > 1) : ?>
                <script>
                    var action = 'loadmore_news';
                    var ajaxurl = '<?= site_url() ?>/wp-admin/admin-ajax.php';
                    var loadmore_posts = '<?= addcslashes(serialize($wp_query->query_vars), "'"); ?>';
                    var current_page = <?= (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    var max_pages = '<?= $wp_query->max_num_pages; ?>';
                </script>

                <a href="javascript:;" id="loadmore" class="more-material result__button">Показать еще</a>
                <script src="<?= template(); ?>static/js/be.js"></script>
        <?php endif; ?>
</div>
    <!-- <?php if ($wp_query->max_num_pages > 1) :
        pagination($wp_query->max_num_pages, 3); ?>
    <?php endif; ?> -->
</section>


<?php
wp_reset_query();
get_template_part('parts/footer', 'archive');
get_footer();
