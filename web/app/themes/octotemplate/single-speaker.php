<?php
/**
 * The template for displaying all single posts
 *
 * @package octotemplate
 */

// <meta property="og:image" content="https://meduza.io/imgly/share/1573795010/shapito/2019/11/15/vyshla-jedi-fallen-order-priklyuchencheskaya-igra-o-dzhedae-nedouchke" data-rh="true">

get_header();
?>
<div class="status-scrollbar"></div>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); 
        
        $langs = array();                                       //Языки
        foreach( get_the_category() as $category ){ 
            $langs[] = $category->name;
        } 

        $biography          = get_field('biography');           //Биография
        $geography          = get_field('geography');           //География
        $topics_conference  = get_field('topics_conference');   //Темы выступлений / конференций
        $photos_speaker     = get_field('photos_speaker');      //Фотографии
        $video_blocks       = get_field('video_speaker_block'); //Видео список
        $post_id            = get_the_ID();                     //ID эксперта

        
        //Проверка на наличие эксперта в избранном
        $is_like_post = (is_like_post($post_id) ?  'active' : '');
        $is_like_post_for_notify = (is_like_post($post_id) ? ''  : "data-notify='like-speaker'");

        ?>
		<section class="speaker__container">
			
			<div class="speaker__header title-news_or_event-wrapp">
                <?php
                $image = get_post_image(get_queried_object_id());
                if ($image): ?>
                    <div class="speaker__image">
                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                    </div>
                <?php endif; ?>

				<div class="speaker__description">

					<a href="<?= get_permalink(PAGE_SPEAKERS_ID); ?>" class="button-underline"><?= get_the_title(PAGE_SPEAKERS_ID); ?></a>

					<div class="speaker__name">
						<?= get_the_title(); ?>
					</div>
                    
                    <div class="speaker__about">
                        <?php the_content(); ?>
                    </div>
                    
                    <div class="speaker__buttons">

                        <a href="/invite-expert/?expert=<?=$post_id?>" class="speaker-btn btn-blue ">
                            Пригласить эксперта
                        </a>
                        
                        <?php if(isAuth()):?>
                            <button class="speaker-btn btn-white like_event_btn" <?=$is_like_post_for_notify?> data-postid="<?=$post_id?>">
                                <?=($is_like_post ? 'В избранном' : 'Запомнить')?>
                            </button>
                        <?php else:?>
                            <button class="speaker-btn btn-white like_event_btn" data-notify='no-like-speaker' data-postid="null">
                                Запомнить
                            </button>
                        <?php endif;?>


                    </div>
                    
				</div>
			</div>
		</section>

        <section class="speaker__info">
            <div class=" speaker__wrapp">

                <!--Меню с выбором информации о спикере-->
                <div class="container-fluid spec">
                    <div class="speaker-tabs">
                        <div id="specifications" class="spek-tab"><a>Об эксперте</a></div>

                        <?php if($photos_speaker):?>
                            <span class="spek-tab spek-tab-slash">/</span>
                            <div id="gallery" class="spek-tab"><a>Фотографии</a></div> 
                        <?php endif?>
                        
                        <?php if ($video_blocks):?>
                            <span class="spek-tab-slash">/</span>
                            <div id="video" class="spek-tab"><a>Видео</a></div>
                        <?php endif?>
                    </div>
                </div>
                <!--/Меню с характеристиками и описанием-->

                <div class="sections-group">
                    <section class="specifications-section d-none">

                        
                        <div class="geography_speaker">
                            <?php if($geography):?>
    	                        <div>
    	                            <svg class="icon__map_point-blue" width="17px" height="24px">
    	                                <use xlink:href="#map_point-blue"></use>
    	                            </svg>
    	                            <span class="map_point_text">Россия</span>
    	                        </div>
                            <?php endif;?>
	                        
                            <?php if($langs):?>
    	                        <div>
    	                            <svg class="icon__global-blue" width="24px" height="24px">
    	                                <use xlink:href="#global-blue"></use>
    	                            </svg>
    	                            <span class="global_text">
                                        <?= implode(", ", $langs); ?>        
                                    </span>
    	                        </div>
                            <?php endif;?>
	                    </div>
                        

                        <?php if($biography):?>
                            <div class="spoiler-wrap  active">
                                <div class="spoiler-head">
                                    Биография
                                    <!-- biography -->
                                    <svg class="icon__small_arrow" width="12px" height="7px">
                                        <use xlink:href="#up"></use>
                                    </svg>
                                </div>
                                <div class="spoiler-body">
                                	<div class="speaker__wrapp__content">
                                    	<?= $biography; ?>
                                	</div>
                                </div>
                            </div>
                        <?php endif?>
                        
                        <?php if($topics_conference):?>
                            <div class="spoiler-wrap disabled">
                                <div class="spoiler-head">
                                    Темы выступлений / конференций
                                    <svg class="icon__small_arrow" width="12px" height="7px">
                                        <use xlink:href="#up"></use>
                                    </svg>
                                </div>
                                <div class="spoiler-body">
                                	<div class="speaker__wrapp__content">
                                    	<?= $topics_conference; ?>
                                	</div>
                                </div>
                            </div>
                        <?php endif?>
                    </section>
                    
                    <?php if($photos_speaker):?>
                        <section class="gallery-section d-none">
                            <?= $photos_speaker; ?>
                        </section>
                    <?php endif?>
                    
                    <?php if ($video_blocks):?>
                        <section class="video-section d-none">
                        <?php 
                        $counter = 0;
                        foreach ($video_blocks as $video):
                            if (!is_array($video)) {
                                continue;
                            }
                            if ($video['acf_fc_layout'] === 'block_video' && !$video['hide']):

                                $counter++;
                                if($counter > 1):?>
                                    <hr>
                                <?php endif?>


                                <p class="video_speaker_title"><?= $video['video_speaker_title']; ?></p>
                                <p class="video_speaker_description"><?= $video['video_speaker_description']; ?></p>
                                <div class="video_speaker_container">
                                    <div class="video_speaker_iframe__container">
                                        <?= $video['video_speaker_iframe']; ?>
                                    </div>
                                    <p class="video_speaker_date"><?= $video['video_speaker_date']; ?></p>
                                </div>
                            <?php endif;
                        endforeach;?>
                         </section>
                    <?php endif;?>
                   
                </div>

                
            </div>
        </section>
	<?php endwhile ?>
<?php endif ?>

<?php
get_footer();
