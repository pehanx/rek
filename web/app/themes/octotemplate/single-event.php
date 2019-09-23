<?php
/**
 * The template for displaying all single posts
 *
 * @package octotemplate
 */

get_header();
?>
<div class="status-scrollbar"></div>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post();
        $event_date = get_field('event_date');
        $additional_info = get_field('additional_info');
        $duration = get_field('duration');
        $place = get_field('place');
        $place_link = get_field('place_link');

        $footer_info = get_field('footer_info');
        ?>
		<section class="title-news_or_event event">
			<!--add event class for event page-->
			<div class="title-news_or_event-wrapp">
                <?php
                $image = get_post_image(get_queried_object_id());
                if ($image): ?>
                    <div class="img">
                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                    </div>
                <?php endif; ?>
				<div class="description">
					<a href="<?= get_permalink(PAGE_EVENTS_ID); ?>" class="button-underline"><?= get_the_title(PAGE_EVENTS_ID); ?></a>
					<div class="description__text">
						<?= get_the_title(); ?>
					</div>
					<div class="description__date">
						<?= $event_date; ?>
					</div>
                    <a href="javascript:;"
                       class="button popup-join-open"
                       data-title="<?= get_the_title(); ?>">
                        <?= pll__('Записаться'); ?>
                    </a>

                    
				</div>
			</div>
		</section>

        <?php if ($additional_info || $event_date || $duration): ?>
            <section class="eventpage__title">
                <div class="eventpage__titlewrapp">
                    <?php if ($event_date || $duration): ?>
                        <div>
                            <div class="eventpage__titlehead">
                                <?= pll__('Дата | время'); ?>
                            </div>
                            <?php if ($event_date): ?>
                                <div class="eventpage__titlehead-light">
                                    <?= $event_date; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($duration): ?>
                                <div class="eventpage__titletext">
                                    <?= $duration; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    $field = get_field_object('place');
                    ?>
                    <?php if ($place): ?>
                        <div>
                            <div class="eventpage__titlehead">
                                <?= pll__('Местоположение'); ?>
                            </div>
                            <?php if ($place_link): ?>
                                <a href="<?= $place_link; ?>">
                            <?php endif; ?>

                            <div class="eventpage__place">
                                <?= $place; ?>
                            </div>

                            <?php if ($place_link):?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

					<?if ($additional_info):?>
                    <?php foreach ($additional_info as $info): ?>
                        <div>
                            <div class="eventpage__titlehead">
                                <?= $info['title']; ?>
                            </div>
                            <div class="eventpage__titletext">
                                <?php if ($info['link']): ?>
                                    <a href="<?= $info['link']; ?>">
                                <?php endif; ?>

                                <?= $info['description']; ?>

                                <?php if ($info['link']): ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
					<?endif;?>
                </div>
            </section>
        <?php endif; ?>

        <section class="typical">
            <div class="typical__wrapp">
                <?php if(isAuth()):?>
                    <?php the_content(); ?>
                <?php else:?>
                    <p>
                    Что бы получить доступ к более подробной информации и к контактам данного мероприятия, Вам необходимо зарегистрироваться/авторизоваться на нашем сайте. И стать полноценным членом Российского Экспортного Клуба. 
                    <a href="javascript:void(0);" class="to_auth_page_of_event">Вступить</a>
                    </p>
                <?php endif;?>
            </div>
        </section>

        <?php if ($footer_info): ?>
            <section class="eventpage__footer">
                <div class="eventpage__footerwrapp">
                    <?php foreach ($footer_info as $info): ?>
                        <div class="eventpage__footertitle">
                            <?= $info['title']; ?>
                        </div>
                        <?php if ($info['link']): ?>
                            <a href="<?= $info['link']; ?>">
                        <?php endif; ?>
                        <?= $info['description']; ?>
                        <?php if ($info['link']): ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
		<?php get_template_part('parts/footer', 'news'); ?>
	<?php endwhile ?>
<?php endif ?>

<?php
get_footer();
