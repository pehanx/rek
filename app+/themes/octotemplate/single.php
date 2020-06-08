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
				</div>
			</div>
		</section>
		<section class="typical">
			<div class="typical__wrapp">
				<?php the_content(); ?>
			</div>
		</section>
		<?php
		get_template_part('parts/footer', 'news'); ?>
	<?php endwhile ?>
<?php endif ?>

<?php
get_footer();
