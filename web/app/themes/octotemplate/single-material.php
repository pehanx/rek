<?php
/**
 * The template for displaying all single posts
 *
 * @package octotemplate
 */

get_header();
?>
<!-- style="background-image: url('<?=$url_img?>')" -->
<div class="status-scrollbar"></div>
<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); 
        $preview_content = get_field('preview_content');

         
        $post_id  = get_the_ID();
        //Проверка на наличие эксперта в избранном
        $is_like_post = (is_like_post($post_id) ?  'active' : '');
        $is_like_post_for_notify = (is_like_post($post_id) ? ''  : "data-notify='like-material'");
                

    ?>


        <section class="material__title">
            <div class="material__bg"></div>
            <?php $image = get_post_image(get_queried_object_id()); ?>
            <?php $url_img = $image['url'] ?>
            <div class="material__img" style="background-image: url(<?=$url_img?>); background-position: center;">
                <!-- <img src="<?=$url_img?>" alt="<?= $image['alt']; ?>" style="height: 100%; width: 100%; object-fit: contain;">  -->
            </div>
            <div class="material__description">
                <a href="<?= get_permalink(PAGE_MATERIALS_ID); ?>">
                    <?= get_the_title(PAGE_MATERIALS_ID); ?>
                </a>
                <div class="material__head">
                    <?= get_the_title(); ?>
                </div>
                <div class="material__date">
                    <?= get_the_date('j F Y'); ?>
                </div>
                
                <?php if(isAuth()):?>
                    <button class="speaker-btn btn-white like_event_btn" <?=$is_like_post_for_notify?> data-postid="<?=$post_id?>">
                        <?=($is_like_post ? 'В избранном' : 'Запомнить')?>
                    </button>
                <?php else:?>
                    <button class="speaker-btn btn-white like_event_btn" data-notify='no-like-material' data-postid="null">
                        Запомнить
                    </button>
                <?php endif;?>

            </div>
        </section>

        <section class="typical">
            <div class="typical__wrapp">

                <?php if(isAuth() || current_user_can('editor') || current_user_can('administrator') || !$preview_content):?>

                    <?php the_content(); ?>

                    <div class="share_line"></div>
                    <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,skype,telegram"></div>

                
                <!-- <?php// if(current_user_can('editor') || current_user_can('administrator')):?> -->
                    <!-- <a href="http://soc.russianexport.club/blogs/create" target="_blank">Опубликовать в соцсети</a> -->
                    <!-- <?php/* -->
                        $the_ID = get_the_ID();

                        $post_type_text = "материалы";
                        $post_type = "#материалы\n";

                        $post_img = get_post_image()['url'];
                        $post_img="<img style='width:100%' src='$post_img'>";

                        $post_title = "<h1>".get_the_title()."</h1>\n";

                        $post_content = get_the_content();
                        $post_content = apply_filters('the_content', $post_content);

                        //Весь пост(тип поста с хэштегом, картинка, заголовок, контент)
                        $post_all = $post_type.$post_img.$post_title.$post_content;
                        
                        $recdb = new wpdb('usernew','xdcM0IKGYzLP0K6Yvvbl','dbnew','localhost');

                        $check_post_soc = $recdb->get_row("SELECT * 
                                    FROM wp_publish_post_soc 
                                    WHERE id_post_in_rec = '$the_ID' ");

                        if(empty($check_post_soc)): ?>
                            <form method="post">
                                <!-- <button class="inclub__button" type="submit" name="Publish_post">Опубликовать в соцсети</button> -->
                            </form>
                        <?php else:?>
                            <form method="post">
                                <!-- <button class="inclub__button" type="submit" name="Update_post">Обновить в соцсети</button> -->
                            </form>
                        <?php endif;?>
                        
                        <?php
                            if(isset($_POST['Publish_post'])):
                                crosspost_soc($post_all, $the_ID, $post_type_text);
                            endif;

                            if(isset($_POST['Update_post'])):
                                crosspost_soc_update($post_all, $check_post_soc->id_post_in_soc);
                            endif;
                            */
                        ?>
                <!-- <?php //endif;?> -->


                <?php elseif($preview_content):?>
                    <?= $preview_content; ?>
                    <p>
                    Чтобы получить доступ к более подробной информации, Вам необходимо зарегистрироваться/авторизоваться на нашем сайте.
                    <a href="javascript:void(0);" class="to_auth_page_of_event">Вступить</a>
                    </p>
                <?php endif;?>
            </div>
        </section>
        <?php
        get_template_part('parts/footer', 'material'); ?>
    <?php endwhile ?>
<?php endif ?>

<?php
get_footer();
