<div class="contact__block" style="position: relative;">
    <?php if(current_user_can('editor') || current_user_can('administrator')):?>
            <div class="viewsCount_block">
                <p class='viewsCount_text'>Просмотров:<strong><?=pvc_get_post_views($post->ID)?></strong></p>
            </div>
    <?php endif;?>
    <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
        <div class="news__img">
            <?php
            $image = get_post_image(get_queried_object_id());
            if ($image): ?>
                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
            <?php endif; ?>
            <div class="news__img__bg"></div>
        </div>
        <!-- <div class="news__date">
            <?= get_the_date('j M Y'); ?>
        </div> -->
        <div class="news__title title" style=""> 
            <div style="position: relative;">
                <span class="news__date" style="position: static;">
                     <?= get_the_date('j M Y'); ?>
                     <?php if(isAuth()):
                        $id_client = $_SESSION['user_id'];
                        $id_post = get_the_ID();

                        $have_like_event = $wpdb->get_row( "SELECT * FROM wp_like_events WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'"); 
                        if(empty($have_like_event)){
                            $src = "https://russianexport.club/app/uploads/2019/11/star_no.png";
                        }else{
                            $src = "https://russianexport.club/app/uploads/2019/11/star.png";
                        }?>
                        <img class="star_img like_event" data-artid="<?=$id_post;?>" src="<?=$src;?>">
                    <?php endif;?>
                </span>
                <br>
                <span class="underline-hover-link">
                    <?= get_the_title(); ?>
                </span>
            </div>
        </div>
    </a>
</div>