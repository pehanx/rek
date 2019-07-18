<?php
$prev_post = get_previous_post();
if ($prev_post):
    $prev_post_link = get_permalink($prev_post->ID);
    ?>
    <section class="material__footer">
        <div class="material__footerwrapp">
            <div class="material__footerimg">
                <a href="<?= $prev_post_link; ?>">
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
            </div>
            <div class="material__footerdescription">
                <a href="<?= $prev_post_link; ?>" class="material__footertitle"><?= get_field('readmore_text', PAGE_MATERIALS_ID); ?></a>
                <span>
                    <?= get_the_date('j F Y', $prev_post->ID); ?>
                </span>
                <a href="<?= $prev_post_link; ?>" class="link-hover-down">
                    <span class="underline-hover-link"><?= get_the_title($prev_post->ID); ?></span>
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>