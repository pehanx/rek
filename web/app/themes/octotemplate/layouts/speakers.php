<?php
/*
 * Template Name: Спикеры
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
        'post_type' => 'speaker',
        'posts_per_page' => SPEAKERS_PER_PAGE,
        'paged' => $paged,
]);
$counter = 0;

?>
<section class="usefulpage">
    <div class="usefulpage__bg speakerfullpage__bg"></div>
    <div class="usefulpage__wrapp">
        <h1 class="usefulpage__title speakerfullpage__title">
            <?= get_the_title(); ?>
        </h1>
        <div class="usefulpage__container speakerfullpage__container">
            <a class="speakerfullpage__img__link">
                <div class="useful__img">
                    <img src="https://russianexport.club/app/uploads/2020/05/naujiena-c01f034d209b54286a898408a6a67a501.jpg" alt="">
                </div>
            </a>

            <!-- Вызов функций из speaker-helper.php -->
            <?php $speaker_select_geography_array = speaker_select_geography();?>
            <?php $speaker_select_lang_array = speaker_select_lang();?>

            <?php if($speaker_select_geography_array || $speaker_select_lang_array):?>
                <form id="form_show_speakers">
                <div class="speaker_list_geography_block">

                    <?php if($speaker_select_geography_array):?>
                        <div class="speaker_select_geography">
                            <div class="speaker_list_geography_block_icon">
                                <svg class="icon__map_point" width="19px" height="27px">
                                    <use xlink:href="#map_point"></use>
                                </svg>
                                <span class="map_point_text">География:</span>
                            </div>
                            
                            <div class="speaker_list_geography_block_select">
                                <select name="География" class="speaker_list_geography_select" id="speakers_geography_select">
                                    <option value="">Все</option>
                                    <?php foreach($speaker_select_geography_array as $item):?>
                                        <option><?= $item?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    <?php endif;?>
                    
                    <?php if($speaker_select_lang_array):?>
                        <div class="speaker_select_lang">
                            <div class="speaker_list_geography_block_icon">
                                <svg class="icon__global" width="27px" height="27px">
                                    <use xlink:href="#global"></use>
                                </svg>
                                <span class="global_text">Язык:</span>
                            </div>

                            
                            <div class="speaker_list_geography_block_select">
                                <select name="Язык" class="speaker_list_geography_select" id="speakers_lang_select">
                                    <option value="">Все</option>
                                    <?php foreach($speaker_select_lang_array as $item):?>
                                        <option value="<?=$item->term_id?>"><?= $item->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    <?php endif;?>

                </div>
                </form>
            <?php endif;?>

            <div class="result__main">
                <?php if ( have_posts() ) : ?>
                    <div class="speaker_list be-ajax-loadmore-container">
                        <?php while ( have_posts()) :
                                the_post();
                                get_template_part('parts/list_element', 'speaker');  
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
        </div>
    </div>
</section>


<?php
wp_reset_query();
get_template_part('parts/footer', 'archive');
get_footer();
