<div>

    <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
        <div class="news__img">
            <?php
            $image = get_post_image(get_queried_object_id());
            if ($image): ?>
                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
            <?php endif; ?>
            <div class="news__img__bg"></div>
        </div>
        <div class="news__date">
            <?= get_the_date('j M Y'); ?>
        </div>
        <div class="news__title title">
            <span class="underline-hover-link">
                <?= get_the_title(); ?>
            </span>
        </div>
    </a>
</div>