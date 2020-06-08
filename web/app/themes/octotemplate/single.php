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
	<?php while ( have_posts() ) : the_post(); ?>
		<section class="title-news_or_event">
			<!--add event class for event page-->
			<div class="title-news_or_event-wrapp">
				<div class="img">
					<img src="<?= get_post_image()['url']; ?>" alt="">
				</div>
				<div class="description">
					<a href="<?= get_permalink(PAGE_NEWS_ID); ?>" class="button-underline"><?= get_the_title(PAGE_NEWS_ID); ?></a>
					<div class="description__text">
						<?= get_the_title(); ?>
					</div>
					<div class="description__date">
						<?= get_the_date(); ?>
					</div>
					<?php if(isAuth()):
                        $id_client = $_SESSION['user_id'];
                        $id_post = get_the_ID();

                        $have_like_event = $wpdb->get_row( "SELECT * FROM wp_like_events WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'"); 
                        if(empty($have_like_event)): ?>
                            <button class="like_event inclub__button" style="margin-top: 20px" data-artid="<?=$id_post;?>">
                                Добавить в избранное
                            </button>
                        <?php else: ?>
                            <button class="like_event inclub__button" style="margin-top: 20px" data-artid="<?=$id_post;?>">
                                В избранном
                            </button>
                        <?php endif; ?>

                    <?php endif;?>
				</div>
			</div>
		</section>
		<section class="typical">
			<div class="typical__wrapp">
				<?php if(
					current_user_can('editor') || 
					current_user_can('administrator') || 
					( get_field('restrict_view') && isAuth() ) ||
					!get_field('restrict_view')
				):?>
					<?php 
					the_content();?>
					<div class="share_line"></div>
					<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
					<script src="https://yastatic.net/share2/share.js"></script>
					<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,skype,telegram"></div>
                <?php else:?>
                    <p>
                    Чтобы получить доступ к более подробной информации, Вам необходимо зарегистрироваться/авторизоваться на нашем сайте.
                    <a href="javascript:void(0);" class="to_auth_page_of_event">Вступить</a>
                    </p>
                <?php endif;?>

                <?php if(current_user_can('editor') || current_user_can('administrator')):?> 
					<a href="http://soc.russianexport.club/blogs/create" target="_blank">Опубликовать в соцсети</a>
	            <?php endif;?>
			</div>
		</section>
		<?php
		get_template_part('parts/footer', 'news'); ?>
	<?php endwhile ?>
<?php endif ?>

<?php
get_footer();

