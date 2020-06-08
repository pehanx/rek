<?php
/**
 * The template for displaying all single posts
 *
 * @package octotemplate
 */

// <meta property="og:image" content="https://meduza.io/imgly/share/1573795010/shapito/2019/11/15/vyshla-jedi-fallen-order-priklyuchencheskaya-igra-o-dzhedae-nedouchke" data-rh="true">

get_header();
?>
<div class="status-scrollbar"></div>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post();
        $event_date = get_field('event_date');
        $additional_info = get_field('additional_info');
        $duration = get_field('duration');
        $place = get_field('place');
        $place_link = get_field('place_link');
        $city = get_field('city');
        $start_date = get_post_meta( get_the_ID(), 'start_date', 1 );
        $id_post = get_the_ID();
        if(isAuth()) $id_client = $_SESSION['user_id'];

        $sign_events_clients = $wpdb->get_results( "
            SELECT * 
            FROM wp_sign_events
            INNER JOIN wp_clients on wp_clients.id = wp_sign_events.id_client
            WHERE `id_post` = '$id_post'");

        $footer_info = get_field('footer_info');
        ?>
		<section class="title-news_or_event event">
			<!--add event class for event page-->
			<div class="title-news_or_event-wrapp">
                <?php
                $image = get_post_image(get_queried_object_id());
                if ($image): ?>
                    <div class="img">
                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                    </div>
                <?php endif; ?>
				<div class="description">
					<a href="<?= get_permalink(PAGE_EVENTS_ID); ?>" class="button-underline"><?= get_the_title(PAGE_EVENTS_ID); ?></a>
					<div class="description__text">
						<?= get_the_title(); ?>
					</div>
					<!-- <div class="description__date">
						<?= $event_date; ?>
					</div> -->
                    
                    <!-- <a href="javascript:;"
                       class="button popup-join-open"
                       data-title="<?= get_permalink(); ?>">
                        <?= pll__('Записаться'); ?>
                    </a> -->
                    <?php if($start_date > date('Ymd')):  ?>

                        <?php if(isAuth()):
                            $have_sign_event = $wpdb->get_row( "SELECT * FROM wp_sign_events WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'"); 
                            if(empty($have_sign_event)): ?>
                                <a href="javascript:;"
                                   class="button popup-join-open sign_event_btn"
                                   data-title="<?= get_permalink(); ?>"
                                   data-id-post="<?= get_the_ID()?>">
                                    <?= pll__('Записаться'); ?>
                                </a>
                            <?php else: ?>
                                 <a href="javascript:;"
                                   class="button already_sign_event">
                                    <?= pll__('Вы записаны'); ?>
                                </a>
                            <?php endif;

                            $have_sign_event = $wpdb->get_row( "SELECT * FROM wp_sign_events WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'"); 
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

                        <?php else:?>
                            <a href="javascript:void(0);"
                               class="button to_auth_page_of_event">
                                <?= pll__('Записаться'); ?>
                            </a>
                        <?php endif;?>
                    <?php else:?>
                        <a href="javascript:;" class="button"><?= pll__('Мероприятии окончено'); ?></a>
                        <?php if(isAuth()):
                            $have_sign_event = $wpdb->get_row( "SELECT * FROM wp_sign_events WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'"); 
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
                    <?php endif; ?>
                    
				</div>
			</div>
		</section>

        <?php if ($additional_info || $event_date || $duration): ?>
            <section class="eventpage__title">
                <div class="eventpage__titlewrapp">
                    <?php  
                        $events_clients = count($sign_events_clients);
                        if(isAuth() && $events_clients>0):
                    ?>
                    <div>
                        <div class="eventpage__place">
                            <?=$events_clients?> участников желают<br>посетить это мероприятие
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if ($event_date || $duration): ?>
                        <div>
                            <div class="eventpage__titlehead">
                                <?= pll__('Дата | время'); ?>
                            </div>
                            <?php if ($event_date): ?>
                                <div class="eventpage__titlehead-light">
                                    <?= $event_date; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($duration): ?>
                                <div class="eventpage__titletext">
                                    <?= $duration; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    $field = get_field_object('place');
                    ?>
                    <?php if ($place): ?>
                        <div>
                            <div class="eventpage__titlehead">
                                <?= pll__('Местоположение'); ?>
                            </div>
                            <?php if ($place_link): ?>
                                <a href="<?= $place_link; ?>">
                            <?php endif; ?>

                            <div class="eventpage__place">
                                <?= $place; ?>
                            </div>

                            <?php if ($place_link):?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if($city): ?>
                        <div class="eventpage__titlehead">
                            <?= pll__('Город'); ?>
                        </div>
                        <div class="eventpage__place">
                            <?= $city; ?>
                        </div>
                    <?php endif;?>

					<?if ($additional_info):?>
                    <?php foreach ($additional_info as $info): ?>
                        <div>
                            <div class="eventpage__titlehead">
                                <?= $info['title']; ?>
                            </div>
                            <div class="eventpage__titletext">
                                <?php if ($info['link']): ?>
                                    <a href="<?= $info['link']; ?>">
                                <?php endif; ?>

                                <?= $info['description']; ?>

                                <?php if ($info['link']): ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
					<?endif;?>
                </div>
            </section>
        <?php endif; ?>

        <section class="typical">
            <div class="typical__wrapp">
                <?php if(isAuth() || current_user_can('editor') || current_user_can('administrator')  ):?>
                    <?php the_content(); ?>
                    <div class="share_line"></div>
                    <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,skype,telegram"></div>

                    
                <?php if(current_user_can('editor') || current_user_can('administrator')):?> 
                    <p><a href="http://soc.russianexport.club/blogs/create" target="_blank">Опубликовать в соцсети</a></p>
                    <div class="share_line"></div>
                    
                    <div class="all_block_sign_event" style="margin-top: 30px">
                        <h3 style="text-align: center;">
                            <?=count($sign_events_clients)?> участников на мероприятии
                        </h3>
                        <div class="sign_event_block">
                        <?php foreach ($sign_events_clients as $item):?>
                            <div class="my_events_block">
                                <p>
                                    <?=$item->surname?> <?=$item->name?> <?=$item->patronymic?>
                                </p>
                                <p style="font-size: 14px">
                                    Телефон: <a style="color: #0E8EAB" href="tel:<?=$item->tel?>"><?=$item->tel?></a><br>
                                    Почта: <a style="color: #0E8EAB" href="mailto:<?=$item->email?>"><?=$item->email?></a><br>
                                    Юридическое лицо: <?=$item->company?><br>
                                    Сфера: <?=$item->sphere?><br>
                                    Регион: <?=$item->region?><br>
                                    Тип участия в клубе: <?=$item->typeParty?> 
                                </p>
                                <a class="close-form-btn delete_sign_event_client" 
                                    data-artid="<?=$id_post?>"
                                    data-id_client="<?=$item->id?>"
                                    >
                                    <div class="close-img">
                                        <svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach;?>    
                        </div>
                    </div>
                    
                    <?php
                        $the_ID = get_the_ID();

                        $post_type_text = "события";
                        $post_type = "#события\n";

                        $post_img = get_post_image()['url'];
                        $post_img="<img style='width:100%' src='$post_img'>";

                        $post_title = "<h1>".get_the_title()."</h1>\n";

                        $post_date = "<h3>Дата: ".$event_date."</h3>";

                        $post_content = get_the_content();
                        $post_content = apply_filters('the_content', $post_content);

                        //Весь пост(тип поста с хэштегом, картинка, заголовок, контент)
                        $post_all = $post_type.$post_img.$post_title.$post_date.$post_content;
                        
                        $recdb = new wpdb('usernew','xdcM0IKGYzLP0K6Yvvbl','dbnew','localhost');

                        $check_post_soc = $recdb->get_row("SELECT * 
                                    FROM wp_publish_post_soc 
                                    WHERE id_post_in_rec = '$the_ID' ");

                        if(empty($check_post_soc)): ?>
                            <form method="post">
                                <!-- <button class="inclub__button" type="submit" name="Publish_post">Опубликовать в соцсети</button> -->
                            </form>
                        <?php else:?>
                            <form method="post">
                                <!-- <button class="inclub__button" type="submit" name="Update_post">Обновить в соцсети</button> -->
                            </form>
                        <?php endif;?>
                        
                        <?php
                            if(isset($_POST['Publish_post'])):
                                crosspost_soc($post_all, $the_ID, $post_type_text);
                            endif;

                            if(isset($_POST['Update_post'])):
                                crosspost_soc_update($post_all, $check_post_soc->id_post_in_soc);
                            endif;
                        ?>
                <?php endif;?>

                <?php else:?>
                    <p>
                    Чтобы получить доступ к более подробной информации и к контактам данного мероприятия, Вам необходимо зарегистрироваться/авторизоваться на нашем сайте.
                    <a href="javascript:void(0);" class="to_auth_page_of_event">Вступить</a>
                    </p>
                <?php endif;?>
            </div>
        </section>

        <?php if ($footer_info): ?>
            <section class="eventpage__footer">
                <div class="eventpage__footerwrapp">
                    <?php foreach ($footer_info as $info): ?>
                        <div class="eventpage__footertitle">
                            <?= $info['title']; ?>
                        </div>
                        <?php if ($info['link']): ?>
                            <a href="<?= $info['link']; ?>">
                        <?php endif; ?>
                        <?= $info['description']; ?>
                        <?php if ($info['link']): ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
		<?php get_template_part('parts/footer', 'news'); ?>
	<?php endwhile ?>
<?php endif ?>

<?php
get_footer();
