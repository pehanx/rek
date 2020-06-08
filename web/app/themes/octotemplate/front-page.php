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
                                    <!-- <a href="" class="popupopen"><?= $block['button_text']; ?></a> -->
                                    <a href="javascript:void(0);" class="to_auth_page"><?= $block['button_text']; ?></a>
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
                        </section>
                    <?php elseif ($block['acf_fc_layout'] === 'news' && !$block['hide']): ?>
                        <?php
                            $news_query = new WP_Query([
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'posts_per_page' => 6,
                            ]);
                        ?>
                        <section class="ourevents">
                            <!-- <div class="news__bg"></div> -->
                            <div class="news__maintitle">
                                <h2 class="title"><?= $block['title']; ?></h2>
                                <!-- <a href="<?= get_permalink(PAGE_NEWS_ID); ?>" class="link-text"><?= $block['archive_link_text']; ?></a> -->
                            </div>
                               <?php if ( $news_query->have_posts() ) : ?>
                                <div class="result__main events_list">
                            <div class="news__titlecontainer owl-carousel owl-theme" style="margin-top: 70px">
                                 <?php while ( $news_query->have_posts()) :
                                     $news_query->the_post();?>
                                    <div class="contact__block" style="margin-bottom: 0">
                                        <a href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>" class="news__item link-hover-down">
                                            <div class="news__img">
                                                <?php
                                                // $image = get_post_image(get_queried_object_id());
                                                $image = get_post_image();
                                                if ($image): ?>
                                                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                                <?php endif; ?>
                                                <div class="news__img__bg"></div>
                                            </div>
                                            <div class="news__date">
                                                <?= get_the_date('j M Y'); ?>
                                            </div>
                                            <?php if(get_field('city')):?>
                                            <div class="news__city">
                                                 <?="г. ".get_field('city'); ?>
                                            </div>
                                            <?php endif;?>

                                            <div class="news__title title">
                                                <div class="underline-hover-link" 
                                                    style="overflow: hidden;
                                                            white-space: nowrap;
                                                            text-overflow: ellipsis;">
                                                    <?= get_the_title(); ?>
                                                </div>
                                               <!--  <span class="underline-hover-link">
                                                    <?php 
                                                    $count = 30;
                                                    $after = "...";
                                                    $title = get_the_title();
                                                    if (mb_strlen($title) > $count) $title = mb_substr($title,0,$count);
                                                    else $after = '';
                                                    echo $title . $after;
                                                    ?>
                                                </span> -->
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <?php endif;?>
                        </section>
                        

                    <?php elseif ($block['acf_fc_layout'] === 'events' && !$block['hide']): ?>
                        <?php
                            $events_query = new WP_Query([
                                'post_type' => 'event',
                                'posts_per_page' => 6,
                                'meta_query'    => array(
                                array(
                                    'relation' => 'AND',
                                    'date' => array(
                                        'key' => 'start_date',
                                        'value' => date('Ymd'),
                                        'compare' => '>'
                                    ),
                                    'sticky' => array(
                                        'key'       => 'sticky_event',
                                        'compare'   => 'EXISTS',
                                    ),
                                )),
                                'orderby' => array(
                                    'sticky'     => 'DESC',
                                    'date'       => 'ASC',
                                )
                            ]);
                        ?>
                        <section class="ourevents">
                            <div class="ourevents__title">
                                <h2 class="title"><?= $block['title']; ?></h2>
                                <!-- <a href="<?= get_permalink(PAGE_EVENTS_ID); ?>" class="link-text"><?= $block['archive_link_text']; ?></a> -->
                            </div>
                            
                            <?php if ( $events_query->have_posts() ) : ?>
                                <div class="result__main events_list">
                            <div class="news__titlecontainer owl-carousel owl-theme" style="margin-top: 70px">
                                 <?php while ( $events_query->have_posts()) :
                                     $events_query->the_post();?>
                                    <div class="contact__block" style="margin-bottom: 0">
                                        <a href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>" class="news__item link-hover-down">
                                            <div class="news__img 
                                                <?php if(get_field('end_date')):?>
                                                    <?php if(get_field('end_date') < date_i18n('Y-m-d')):?>
                                                        <?php echo 'filter_gray'; ?>
                                                    <?php endif;?>
                                                <?php else:?>
                                                     <?php if(get_field('start_date') < date_i18n('Y-m-d')):?>
                                                        <?php echo 'filter_gray'; ?>
                                                    <?php endif;?>
                                               <?php endif;?>">
                                                <?php
                                                // $image = get_post_image(get_queried_object_id());
                                                $image = get_post_image();
                                                if ($image): ?>
                                                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                                <?php endif; ?>
                                                <div class="news__img__bg"></div>
                                            </div>
                                            <div class="news__date">
                                                 <?=get_field('event_date'); ?>
                                            </div>
                                            
                                            <div class="news__city" style="min-height: 20px">
                                                <?php if(get_field('city')):?>
                                                 <?="г. ".get_field('city'); ?>
                                                <?php endif;?>
                                            </div>

                                            <div class="news__title title">
                                                <div class="underline-hover-link" 
                                                    style="overflow: hidden;
                                                            white-space: nowrap;
                                                            text-overflow: ellipsis;">
                                                    <?= get_the_title(); ?>
                                                </div>
                                               <!--  <span class="underline-hover-link">
                                                    <?php 
                                                    $count = 30;
                                                    $after = "...";
                                                    $title = get_the_title();
                                                    if (mb_strlen($title) > $count) $title = mb_substr($title,0,$count);
                                                    else $after = '';
                                                    echo $title . $after;
                                                    ?>
                                                </span> -->
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <?php endif;?>
                        </section>

                    <?php elseif ($block['acf_fc_layout'] === 'blue_line_popup' && !$block['hide']): ?>
                        <section class="inclub" style="margin-bottom: 0;">
                            <div class="inclub__wrapp">
                                <div class="inclub__text">
                                    <?= $block['title']; ?>
                                </div>
                                <a href="javascript:void(0);" class="inclub__button to_auth_page"><?= $block['button_text']; ?></a>
                            </div>
                        </section>

                    <?php elseif ($block['acf_fc_layout'] === 'materials' && !$block['hide']): ?>
                       <?php
                            $materials_query = new WP_Query([
                                'post_type' => 'material',
                                'post_status' => 'publish',
                                'posts_per_page' => 6,
                            ]);
                        ?>
                        <section class="ourevents">
                            <!-- <div class="news__bg"></div> -->
                            <div class="news__maintitle">
                                <h2 class="title"><?= $block['title']; ?></h2>
                                <!-- <a href="<?= get_permalink(PAGE_NEWS_ID); ?>" class="link-text"><?= $block['archive_link_text']; ?></a> -->
                            </div>
                               <?php if ( $materials_query->have_posts() ) : ?>
                                <div class="result__main events_list">
                            <div class="news__titlecontainer owl-carousel owl-theme" style="margin-top: 70px">
                                 <?php while ( $materials_query->have_posts()) :
                                     $materials_query->the_post();?>
                                    <div class="contact__block" style="margin-bottom: 0">
                                        <a href="<?= get_permalink(); ?>" title="<?= get_the_title(); ?>" class="news__item link-hover-down">
                                            <div class="news__img">
                                                <?php
                                                // $image = get_post_image(get_queried_object_id());
                                                $image = get_post_image();
                                                if ($image): ?>
                                                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                                <?php endif; ?>
                                                <div class="news__img__bg"></div>
                                            </div>
                                            <div class="news__date">
                                                <?= get_the_date('j M Y'); ?>
                                            </div>
                                            <?php if(get_field('city')):?>
                                            <div class="news__city">
                                                 <?="г. ".get_field('city'); ?>
                                            </div>
                                            <?php endif;?>

                                            <div class="news__title title">
                                                <div class="underline-hover-link" 
                                                    style="overflow: hidden;
                                                            white-space: nowrap;
                                                            text-overflow: ellipsis;">
                                                    <?= get_the_title(); ?>
                                                </div>
                                               <!--  <span class="underline-hover-link">
                                                    <?php 
                                                    $count = 30;
                                                    $after = "...";
                                                    $title = get_the_title();
                                                    if (mb_strlen($title) > $count) $title = mb_substr($title,0,$count);
                                                    else $after = '';
                                                    echo $title . $after;
                                                    ?>
                                                </span> -->
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <?php endif;?>
                        </section>

                        <?php elseif ($block['acf_fc_layout'] === 'mobile_apps' && !$block['hide']): ?>
                            <style>
                                .logos_apps{
                                    display: flex;
                                    flex-direction: row;
                                }
                                .img_logo{
                                    height:50px !important;
                                    margin: 5px;
                                }
                             

                            @media only screen and (max-width: 600px) {
                                .logos_apps{
                                    display: flex;
                                    flex-direction: column;
                                }
                                 .img_logo{
                                    height:auto !important;
                                    width: 150px !important
                                }
                            }
                            </style>
                        <section class="ourevents">

                            <div class="news__maintitle">
                                <h2 class="title"><?= $block['title']; ?></h2>
                            </div>
                            <div class="result__main events_list">
                                <div class="news__titlecontainer" style="margin-top: 70px;justify-content: center;">
                                    <div class="contact__block" style="margin-bottom: 0; width: 40%;display: flex;justify-content: center;align-items: center;margin-top: 10px;flex-direction: column;">
                                            <div class="news__img" style="height: auto;">
                                                <?php
                                                $image = get_post_image();
                                                if ($image): ?>
                                                    <img src="<?= $block['images_apps']; ?>" style="border-radius: 20px;">
                                                <?php endif; ?>
                                                <div class="news__img__bg"></div>
                                            </div>
                                            <div class="typical__wrapp" style="width: auto;">
                                                <p>Доступно в GooglePlay и AppStore</p>
                                                <div class="logos_apps" style="margin-bottom:10px">
                                                    <a style="margin-bottom: 0" target="_blank" href="https://apps.apple.com/ru/app/%D1%80%D0%BE%D1%81%D1%81%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B9-%D1%8D%D0%BA%D1%81%D0%BF%D0%BE%D1%80%D1%82%D0%BD%D1%8B%D0%B9-%D0%BA%D0%BB%D1%83%D0%B1/id1490232250">
                                                       <img class="img_logo" src="https://russianexport.club/app/uploads/2020/01/Download_on_the_App_Store_Badge_RU_RGB_blk_100317-1.png" alt=""> 
                                                    </a>
                                                    <a style="margin-bottom: 0"  target="_blank" href="https://play.google.com/store/apps/details?id=com.g2rcompany">
                                                       <img class="img_logo" src="https://russianexport.club/app/uploads/2020/01/google-play-badge-e1580302537769.png" alt=""> 
                                                    </a>
                                                </div>
                                                *Для входа в приложение используйте Ваш электронный адрес и пароль, которые вы используете на сайте Российского Экспортного Клуба
                                            </div>
                                    </div>
                                    <div class="contact__block" style="margin-bottom: 0; width: 40%;margin-top: 10px">
                                        <div class="typical__wrapp" style="width: auto;">
                                            <ul style="margin-top: 30px;">
                                                <li style="width: auto;">
                                                    Будьте в курсе мероприятий и событий в общественной жизни Российского Экспортного Клуба в режиме реального времени
                                                </li>
                                                <li style="width: auto;">
                                                    Общайтесь, с экспортерами со всей России, и не только, меняйся опытом и знаниями
                                                </li>
                                                <li style="width: auto;">
                                                    Получайте полный доступ к полезным материалам и вебинарам
                                                </li>
                                                <li style="width: auto;">
                                                    Используйте возможности мобильного приложения Российский Экспортный Клуб для бизнеса и повседневной жизни
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    <?php endif; ?>
                <?php endforeach;
            endif; ?>
        <?php endwhile ?>
    <?php endif ?>

<?php get_footer(); ?>
