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
        'posts_per_page' => 6,
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
        

            <!-- Вызов функций из speaker-helper.php -->
            <?php $speaker_select_geography_array = material_select_country();?>
            <?php $speaker_select_lang_array = material_select_theme();?>

            <?php if($speaker_select_geography_array || $speaker_select_lang_array):?>
                <form id="form_filter_materials">
                    <div class="speaker_list_geography_block">

                        <?php if($speaker_select_geography_array):?>
                            <div class="speaker_select_geography">
                                <div class="speaker_list_geography_block_icon">
                                    <svg class="icon__map_point" width="19px" height="27px">
                                        <use xlink:href="#map_point"></use>
                                    </svg>
                                    <span class="map_point_text">Страна:</span>
                                </div>
                                
                                <div class="speaker_list_geography_block_select">
                                    <select name="Страна" class="speaker_list_geography_select" id="materials_country_select">
                                        <option value="">Все</option>
                                        <?php foreach($speaker_select_geography_array as $item):?>
                                            <option value="<?=$item->term_id?>"><?= $item->name?></option>
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
                                    <span class="global_text">Тема:</span>
                                </div>

                                
                                <div class="speaker_list_geography_block_select">
                                    <select name="Тема" class="speaker_list_geography_select" id="materials_theme_select">
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
        <div class="materials_list">
        <?php if (have_posts()): ?>
            <div class="usefulpage__container">
                <?php while ( have_posts()): the_post(); ?>

                <?php
                    $post_id  = get_the_ID();
                    //Проверка на наличие эксперта в избранном
                    $is_like_post = (is_like_post($post_id) ?  'active' : '');
                    $is_like_post_for_notify = (is_like_post($post_id) ? ''  : "data-notify='like-material'");
                ?>
                
                <a href="<?= get_permalink(); ?>" class="link-hover-down">
                    <?php
                       
                        $image = get_post_image();
                        if ($image): ?>
                            <?php $url_img = $image['url'] ?>
                        <?php endif; ?>
                    <div class="useful__img" style="position: relative;">
                        <?php if(current_user_can('editor') || current_user_can('administrator')):?>
                            <div class="viewsCount_block">
                                <p class='viewsCount_text'>Просмотров:<strong><?=pvc_get_post_views($post->ID)?></strong></p>
                            </div>
                        <?php endif;?>
                        <img src="<?=$url_img?>" alt="<?= $image['alt']; ?>">
                        <div class="useful__containerbg"></div>
                    </div>
                    <div class="useful__containerdate">
                        <?= get_the_date('j M Y'); ?>


                        <?php if(isAuth()):?>
                            <span class="star_img <?=$is_like_post?>" <?=$is_like_post_for_notify?> data-postid="<?=$post_id?>"></span>
                        <?php else:?>
                            <span class="star_img" data-notify='no-like-material' data-postid="null"></span>
                        <?php endif;?>

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
    </div>
</section>

<?php
wp_reset_query();
?>


<?php
get_template_part('parts/footer', 'archive');
get_footer();
