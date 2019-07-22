<?php
/**
 * The template for displaying front page
 *
 * @package octotemplate
 */

get_header();
?>
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post();
            $blocks = get_field('blocks');
            if ($blocks):
                foreach ($blocks as $block):
                    if (!is_array($block)) {
                        continue;
                    }
                    if ($block['acf_fc_layout'] === 'with_background_image' && !$block['hide']): ?>
                        <section class="headblock">
                            <div class="headblock__wrapp">
                                <div class="headblock__title">
                                    <h1 class="title"><?= $block['title']; ?></h1>
                                    <p class="text"><?= $block['description']; ?></p>
                                    <a href="" class="popupopen"><?= $block['button_text']; ?></a>
                                </div>
                                <?php
                                $background_image = $block['background_image'];
                                if ($background_image): ?>
                                    <div class="headblock__img">
                                        <img src="<?= $background_image['url']; ?>" alt="<?= $background_image['alt']; ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>

                    <?php elseif ($block['acf_fc_layout'] === 'features' && !$block['hide']): ?>
                        <section class="aboutclub">
                            <div class="aboutclub__title">
                                <h2 class="title"><?= $block['title']; ?></h2>
                            </div>
                            <?php if ($block['list']): ?>
                                <div class="aboutclub__items">
                                    <?php foreach ($block['list'] as $element): ?>
                                        <div class="aboutclub__item">
                                            <div class="aboutclub__img">
                                                <img src="<?= $element['image']['url']; ?>" alt="<?= $element['image']['alt']; ?>">
                                            </div>
                                            <div class="aboutclub__description">
                                                <p class="bold-text"><?= $element['title']; ?></p>
                                                <p class="text"><?= $element['description'] ?></p>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                    <!-- EMAIL рассылка -->
                        <!-- <div class="aboutclub__item">
                            <div class="contact__wrapp">
                                <form action="/mail.php" method="post" class="regs mailing__form" >
                                    <span class="text" style="margin-right: 40px; font-size: 14px;)">Подпишитесь на нашу рассылку и получайте приглашение на все мероприятия,<br> проводимые Российским Экспортным Клубом:</span>
                                    <label class="placeholder">
                                        <input class="input textup input-email" type="text" name="Почта">
                                        <span>E-mail</span>
                                        <p class="info">Укажите вашу электронную почту</p>
                                    </label>
                                    <input type="hidden" value="participation" name="type">
                                    <button class="submit">Подписаться</button>
                                </form>
                            </div>
                        </div> -->
                        </section>
                    <?php elseif ($block['acf_fc_layout'] === 'news' && !$block['hide']): ?>
                        <section class="news">
                            <div class="news__bg"></div>
                            <div class="news__maintitle">
                                <h2 class="title"><?= $block['title']; ?></h2>
                                <a href="<?= get_permalink(PAGE_NEWS_ID); ?>" class="link-text"><?= $block['archive_link_text']; ?></a>
                            </div>
                            <div class="news__items">
                                <div>
                                    <a href="<?= get_permalink($block['news'][0]->ID); ?>" class="news__item">
                                        <div class="news__img">
                                            <?php
                                            $image = get_post_image($block['news'][0]->ID);
                                            if ($image): ?>
                                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                            <?php endif; ?>
                                            <div class="news__img__bg"></div>
                                        </div>
                                        <div class="news__date">
                                            <?= get_the_date('j M Y', $block['news'][0]->ID); ?>
                                        </div>
                                        <div class="news__title title">
                                            <?= get_the_title($block['news'][0]->ID); ?>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a class="news__item"></a>
                                    <a class="news__item"></a>
                                    <a href="<?= get_permalink($block['news'][1]->ID); ?>" class="news__item">
                                        <div class="news__img">
                                            <?php
                                            $image = get_post_image($block['news'][1]->ID);
                                            if ($image): ?>
                                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                            <?php endif; ?>
                                            <div class="news__img__bg"></div>
                                        </div>
                                        <div class="news__date">
                                            <?= get_the_date('j M Y', $block['news'][1]->ID); ?>
                                        </div>
                                        <div class="news__title title">
                                            <?= get_the_title($block['news'][1]->ID); ?>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                $rest_news = array_chunk(array_slice($block['news'], 2), 4);
                                if ($rest_news):
                                    foreach ($rest_news as $key => $news_sublist):
                                        if ($key % 2 === 0): ?>
                                            <div>
                                                <?php foreach (array_slice($news_sublist, 0, 3) as $news): ?>
                                                    <a href="<?= get_permalink($news->ID); ?>" class="news__item">
                                                        <div class="news__img">
                                                            <?php
                                                            $image = get_post_image($news->ID);
                                                            if ($image): ?>
                                                            <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                                            <?php endif; ?>
                                                            <div class="news__img__bg"></div>
                                                        </div>
                                                        <div class="news__date">
                                                            <?= get_the_date('j M Y', $news->ID); ?>
                                                        </div>
                                                        <div class="news__title title">
                                                            <?= shorten_text(get_the_title($news->ID)); ?>
                                                        </div>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if (isset($news_sublist[3])): ?>
                                                <div>
                                                    <a href="<?= get_permalink($news_sublist[3]->ID); ?>" class="news__item">
                                                        <div class="news__img">
                                                            <?php
                                                            $image = get_post_image($news_sublist[3]->ID);
                                                            if ($image): ?>
                                                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                                            <?php endif; ?>
                                                            <div class="news__img__bg"></div>
                                                        </div>
                                                        <div class="news__date">
                                                            <?= get_the_date('j M Y', $news_sublist[3]->ID); ?>
                                                        </div>
                                                        <div class="news__title title">
                                                            <?= shorten_text(get_the_title($news_sublist[3]->ID)); ?>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div>
                                                <a href="<?= get_permalink($news_sublist[0]->ID); ?>" class="news__item">
                                                    <div class="news__img">
                                                        <?php
                                                        $image = get_post_image($news_sublist[0]->ID);
                                                        if ($image): ?>
                                                            <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                                        <?php endif; ?>
                                                        <div class="news__img__bg"></div>
                                                    </div>
                                                    <div class="news__date">
                                                        <?= get_the_date('j M Y', $news_sublist[0]->ID); ?>
                                                    </div>
                                                    <div class="news__title title">
                                                        <?= shorten_text(get_the_title($news_sublist[0]->ID)); ?>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                            $news_triplet = array_slice($news_sublist, 1, 3);
                                            if ($news_triplet): ?>
                                                <div>
                                                    <?php foreach ($news_triplet as $news): ?>
                                                        <a href="<?= get_permalink($news->ID); ?>" class="news__item">
                                                            <div class="news__img">
                                                                <?php
                                                                $image = get_post_image($news->ID);
                                                                if ($image): ?>
                                                                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                                                <?php endif; ?>
                                                                <div class="news__img__bg"></div>
                                                            </div>
                                                            <div class="news__date">
                                                                <?= get_the_date('j M Y', $news->ID); ?>
                                                            </div>
                                                            <div class="news__title title">
                                                                <?= shorten_text(get_the_title($news->ID)); ?>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif;
                                    endforeach;
                                endif; ?>
                            </div>
                        </section>

                    <?php elseif ($block['acf_fc_layout'] === 'events' && !$block['hide']): ?>
                        <section class="ourevents">
                            <div class="ourevents__title">
                                <h2 class="title"><?= $block['title']; ?></h2>
                                <a href="<?= get_permalink(PAGE_EVENTS_ID); ?>" class="link-text"><?= $block['archive_link_text']; ?></a>
                            </div>
                            <div class="ourevents__container">
                                <?php foreach ($block['events'] as $event): ?>
                                    <div>
                                        <div class="ourevents__img">
                                            <?php
                                            $image = get_post_image($event->ID);
                                            if ($image): ?>
                                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                            <?php endif; ?>
                                            <div class="ourevents__imgbg"></div>
                                        </div>
                                        <div class="ourevents__description">
                                            <div class="ourevents__title bold-text">
                                                <?= get_the_title($event->ID); ?>
                                            </div>
                                            <div class="ourevents__location text">
                                                <?php
                                                $event_date = get_field('event_date', $event->ID);
                                                $place = get_field('place', $event->ID);
                                                if ($event_date) {
                                                    echo $event_date . '<br>';
                                                }
                                                if ($place) {
                                                    echo $place . '<br>';
                                                }
                                                ?>

                                            </div>
                                            <div class="ourevents__buttons">
                                                <a href="javascript:;" class="button popup-join-open" data-title="<?= get_the_title($event->ID); ?>"><?= pll__('Записаться'); ?></a>
                                                <a href="<?= get_permalink($event->ID); ?>" class="button-underline"><?= pll__('Подробнее'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>

                    <?php elseif ($block['acf_fc_layout'] === 'blue_line_popup' && !$block['hide']): ?>
                        <section class="inclub">
                            <div class="inclub__wrapp">
                                <div class="inclub__text">
                                    <?= $block['title']; ?>
                                </div>
                                <a href="javascript:;" class="inclub__button popupopen"><?= $block['button_text']; ?></a>
                            </div>
                        </section>

                    <?php elseif ($block['acf_fc_layout'] === 'materials' && !$block['hide']): ?>
                        <section class="useful">
                            <div class="useful__wrapp">
                                <div class="useful__title">
                                    <h2 class="title"><?= $block['title']; ?></h2>
                                    <a href="<?= get_permalink(PAGE_MATERIALS_ID); ?>" class="link-text"><?= $block['archive_link_text']; ?></a>
                                </div>
                                <?php if ($block['materials']): ?>
                                    <div class="useful__container">
                                        <?php foreach ($block['materials'] as $material): ?>
                                            <a href="<?= get_permalink($material->ID); ?>" class="link-hover-down">
                                                <?php
                                                $image = get_post_image($material->ID);
                                                if ($image): ?>
                                                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                                <?php endif; ?>
                                                <div class="useful__containerbg"></div>
                                                <div class="useful__containertitle text">
                                                    <?= pll__('Статья'); ?>
                                                </div>
                                                <div class="useful__containertext bold-text">
                                                    <span class="underline-hover-link">
                                                        <?= get_the_title($material->ID); ?>
                                                    </span>
                                                </div>
                                                <div class="useful__containerdate link-text">
                                                    <?= get_the_date('j M Y', $material->ID); ?>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>

                    <?php endif; ?>
                <?php endforeach;
            endif; ?>
        <?php endwhile ?>
    <?php endif ?>

<?php get_footer(); ?>
