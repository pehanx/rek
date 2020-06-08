<?php
/*
 * Template Name: Политика конфиденциальности
 *
 * Template Post Type: page
 *
 * The template for displaying Contacts page
 *
 * @package wptemplate
 *
 */
get_header();
?>

<div class="status-scrollbar"></div>
<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <section class="typical" style="margin-top: 70px;">
             <div class="contact__title">
                <?= get_the_title(); ?>
            </div>
            <div class="typical__wrapp">
                <?php the_content(); ?>
            </div>
        </section>
    <?php endwhile ?>
<?php endif ?>

<?php
get_footer();