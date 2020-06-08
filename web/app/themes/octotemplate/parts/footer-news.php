<?php
// $prev_post = get_previous_post();
$prev_post = get_next_post();
if ($prev_post):
    $prev_post_link = get_permalink($prev_post->ID);
    ?>
    <section class="next-news_or_event">
        <div class="next-news_or_event-wrapp">
            <a href="<?= $prev_post_link; ?>" class="img">
                <?php
                $image = get_post_image($prev_post->ID);
                if ($image): ?>
                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                    <div class="img__bg">
                        <svg class="icon__eye" width="45px" height="45px">
                            <use xlink:href="#eye"></use>
                        </svg>
                    </div>
                <?php endif; ?>
            </a>
            <div class="description">
                <a href="<?= $prev_post_link; ?>" class="next__news">
                    <?= pll__('Следующая новость'); ?>
                </a>
                <div class="next__newsdata">
                     <?= get_field('event_date', $prev_post->ID); ?>
                </div>
                <a href="<?= $prev_post_link; ?>" class="next__newstitle link-hover-down">
                    <span class="underline-hover-link">
                        <?= get_the_title($prev_post->ID); ?>
                    </span>
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>