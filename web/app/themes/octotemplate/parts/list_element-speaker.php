<?php

    $post_id    = get_the_ID();
    $geography  = get_field('geography');

    $langs = array();
    foreach( get_the_category() as $category ){ 
        $langs[] = $category->name;
    }

    //Проверка на наличие эксперта в избранном
    $is_like_post = (is_like_post($post_id) ?  'active' : '');
    $is_like_post_for_notify = (is_like_post($post_id) ? ''  : "data-notify='like-speaker'");
    
?>

<div class="element_block">
    <div class="block_element_block">
        <div class="speaker_element_block">
            <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
                <?php $image = get_post_image(); ?>
                <div class="img_element_block" style=" background: url('<?= $image['url']; ?>');" >
                    
                    <!-- <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>"> -->
                </div>

                <div class="desc_element_block"> 
                    <span class="underline-hover-link title_element_block">
                        <?= get_the_title(); ?>
                    </span>
                    
                    <?php if(isAuth()):?>
                        <span class="star_img <?=$is_like_post?>" <?=$is_like_post_for_notify?>  data-postid="<?=$post_id?>"></span>
                    <?php else:?>
                        <span class="star_img" data-notify='no-like-speaker' data-postid="null"></span>
                    <?php endif;?>

                    <?php if($geography || $langs):?>
                        <div class="geography_element_block">

                            <?php if($geography):?>
                                <div>
                                    <svg class="icon__map_point" width="17px" height="24px">
                                        <use xlink:href="#map_point"></use>
                                    </svg>
                                    <span class="map_point_text"><?=$geography?></span>
                                </div>
                            <?php endif;?>
                             
                            
                            <?php if($langs):?>
                                <div>
                                    <svg class="icon__global" width="24px" height="24px">
                                        <use xlink:href="#global"></use>
                                    </svg>
                                    <span class="global_text">
                                        <?= implode(", ", $langs); ?>
                                    </span>
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endif;?>
                    
                </div>
            </a>
        </div><!-- speaker_element_block -->

        <a href="/invite-expert/?expert=<?=$post_id?>" class="invite_speaker_btn">
            Пригласить эксперта
        </a>
    </div><!-- block_element_block -->
</div><!--element_block -->