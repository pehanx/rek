<?php
/**
 * The template for displaying archive pages
 *
 * @package octotemplate
 */

get_header();
?>

<?php if ( have_posts() ) : ?>
	<div class="put-here">
		<?php while ( have_posts() ) : the_post(); ?>
			<?= get_template_part('parts/'.get_post_type()); ?>
		<?php endwhile ?>
	</div>
<?php endif ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
	<script>
		var action = 'loadmore';
		var ajaxurl = '<?= site_url() ?>/wp-admin/admin-ajax.php';
		var loadmore_posts = '<?= serialize($wp_query->query_vars); ?>';
		var current_page = <?= (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
		var max_pages = '<?= $wp_query->max_num_pages; ?>';
	</script>
	<a id="loadmore" href="javascript:;">Loadmore</a>
<?php endif; ?>

<?php
get_footer();
