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
        <section class="material__title">
            <div class="material__bg"></div>
            <div class="material__img">
                <?php
                $image = get_post_image(get_queried_object_id());
                if ($image): ?>
                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                <?php endif; ?>
                <div><?= pll__('Статья'); ?></div>
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
                <p><?= get_field('excerpt'); ?></p>
            </div>
        </section>

		<section class="typical">
			<div class="typical__wrapp">
				<?php the_content(); ?>
			</div>
		</section>
		<?php
		get_template_part('parts/footer', 'material'); ?>
	<?php endwhile ?>
<?php endif ?>

<?php
get_footer();
