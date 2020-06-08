<div class="contact__block" style="position: relative;">
    <?php if(current_user_can('editor') || current_user_can('administrator')):?>
            <div class="viewsCount_block">
                <p class='viewsCount_text'>Просмотров:<strong><?=pvc_get_post_views($post->ID)?></strong></p>
            </div>
    <?php endif;?>
    <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
        <div class="news__img 
            <?php if(get_field('end_date')):?>
                <?php if(get_field('end_date') < date_i18n('Y-m-d')):?>
                    <?php echo 'filter_gray'; ?>
                <?php endif;?>
            <?php else:?>
                 <?php if(get_field('start_date') < date_i18n('Y-m-d')):?>
                    <?php echo 'filter_gray'; ?>
                <?php endif;?>
           <?php endif;?>">
            <?php
            // $image = get_post_image(get_queried_object_id());
            $image = get_post_image();
            if ($image): ?>
                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
            <?php endif; ?>
            <div class="news__img__bg"></div>
        </div>
        <div class="news__date">
            <?=get_field('event_date'); ?>
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
        </div>
        <?php if(get_field('city')):?>
        <div class="news__city">
             <?="г. ".get_field('city'); ?>
        </div>
        <?php endif;?>

        <div class="news__title title">
            <span class="underline-hover-link">
                <?= get_the_title(); ?>
            </span>
        </div>
    </a>
</div>