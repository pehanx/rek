<?php
/*
 * Template Name: Прошедшие обытия
 *
 * Template Post Type: page
 *
 * The template for displaying Events page
 *
 * @package wptemplate
 *
 */

get_header();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$query1 = new WP_Query([
    'post_type' => 'event',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'start_date',
            'value' => date('Ymd'),
            'compare' => '<='
        ),
    )
]);

?>
    <section class="news__titleblock">
    <div class="news__titleblockwrapp">
    <h1 class="news__titletitle title">
        <?= get_the_title(); ?>
    </h1>
    
    <?php if($paged === 1):?>
        <div class="btn_calendar">
            <a href="" class="calendaropen">Календарь</a>
            <br>
            <?php echo $sas = isAuth(); ?>
        </div>

        <?php 
        $events_cal = '['; 
           if($query1->have_posts()){
               while($query1->have_posts()){
                   $query1->the_post();
                   $events_cal .= '{ "date": "'.get_field('start_date').' 00:00:00", "title": "'.get_the_title().'", "description": "" , "url": "'.get_permalink().'"
                       },';
               }
          }
        $events_cal .= ']';
        ?>
        <div class="calendar_bg">
            <div id="eventCalendar" class="Calendar">
            </div>
        </div>

        <?php
                $added = array();
                $args = array(
                    'post_type' => 'event',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        'key1' => array(
                            'key' => 'start_date',
                            'value' => date('Ymd'),
                            'compare' => '<='
                        ),
                        'key2' => array(
                            'key' => 'place',
                        ),
                    ),
                );      

                $query_select_events = new WP_Query( $args ); 
        ?>

        
                <?php if($query_select_events->have_posts()):?>
                    <div class="contact__wrapp">
                    <div class="contact__block" style="margin-bottom: 0px; padding: 30px">                                            
                    <form id="form_show_past_events">
                        <label class="placeholder" style="margin-bottom: 20px;">
                            <select name="Местоположение" id="place_past_event" class="input textup select" style="padding-top: 15px; padding-bottom: 15px">
                            <option value="">Выберите регион</option>
                        <?php
                        while($query_select_events->have_posts()):
                            $query_select_events->the_post();
                            if(empty(get_field('place')))
                                continue;
                                $country = get_field('place');

                            if( in_array($country, $added) )
                            {
                                continue;
                            }

                            $added[] = $country;
                            echo "<option>".$country."</option>";
                        endwhile;
                    endif;
                ?>
                </select>
            </label> 
            <div class="checkbox-list" id="past_events_checkbox_list">
                <div style="display: flex; align-items: center;">
                    <input value="25" type="checkbox" name="show_events_type[]" class="regular-checkbox" />
                    <span>Бизнес-миссии</span>
                </div>
                <div style="display: flex; align-items: center;">
                    <input value="23" type="checkbox" name="show_events_type[]" class="regular-checkbox" />
                    <span>Конференции</span>
                </div>
                <div style="display: flex; align-items: center;">
                    <input value="27" type="checkbox" name="show_events_type[]" class="regular-checkbox" />
                    <span>Выставки</span>
                </div>
                <div style="display: flex; align-items: center;">
                    <input value="29" type="checkbox" name="show_events_type[]" class="regular-checkbox" />
                    <span>Семинары</span>
                </div>
                <div style="display: flex; align-items: center;">
                    <input value="31" type="checkbox" name="show_events_type[]" class="regular-checkbox" />
                    <span>Вебинары</span>
                </div>
            </div>
        </form>
        </div>
        </div>
    <?php endif;?>


    </div>
    </section>
    <section class="news__news past_events_list">
    
    <?php
    

    $wp_query = new WP_Query([
        'post_type' => 'event',
        'posts_per_page' => EVENTS_PER_PAGE,
        'paged' => $paged,
        'meta_query' => array(
            array(
                'key' => 'start_date',
                'value' => date('Ymd'),
                'compare' => '<='
            ),
        ),
        'meta_key' => 'start_date',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    ]);
    $counter = 0;?>

    <?php if ( have_posts() ) : ?>
        <!-- <div class="news__titlecontainer"> -->
            <div class="news__container" style="margin-top: 70px">
        <?php while ( have_posts()) :
            if ($counter < 1):
                the_post();
                $counter++;
                ?>
                <div>
                    <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
                       
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
                            $image = get_post_image(get_queried_object_id());
                            if ($image): ?>
                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                            <?php endif; ?>
                            <div class="news__img__bg"></div>
                        </div>
                        <!-- <div class="news__date">
                             <?=get_field('event_date'); ?>
                        </div> -->
                        <div class="news__title title">
                            <div>
                                <span class="news__date">
                                     <?=get_field('event_date'); ?>
                                </span>
                                <br>
                                <span class="underline-hover-link">
                                    <?= get_the_title(); ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
             </div>
                    <!-- </div>
                </section> -->
                <!-- <section class="news__news"> -->
                        <!-- <div class="news__container"> -->
                        <div class="news__titlecontainer" >
            <?php elseif (($counter === 1) or ($counter === 2) ):
                $counter++;
                the_post(); ?>
                        <div>
                            <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
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
                                    $image = get_post_image(get_queried_object_id());
                                    if ($image): ?>
                                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                    <?php endif; ?>
                                    <div class="news__img__bg"></div>
                                </div>
                                <div class="news__date">
                                     <?=get_field('event_date'); ?>
                                </div>
                                <div class="news__title title">
                                                <span class="underline-hover-link">
                                                    <?= get_the_title(); ?>
                                                </span>
                                </div>
                            </a>
                        </div>
             <?php elseif ($counter === 3):?>
                <?php
                $counter++;?>
                </div>
                <div class="news__container">
                <div></div>   
            <?php else:
                $counter++;
                the_post(); ?>
                <div>
                    <a href="<?= get_permalink(); ?>" class="news__item link-hover-down">
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
                            $image = get_post_image(get_queried_object_id());
                            if ($image): ?>
                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                            <?php endif; ?>
                            <div class="news__img__bg"></div>
                        </div>
                        <div class="news__date">
                             <?=get_field('event_date'); ?>
                        </div>
                        <div class="news__title title">
                                <span class="underline-hover-link">
                                    <?= get_the_title(); ?>
                                </span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
        </div>
    <?php endif;?> 
    </div>
    <?php if ($wp_query->max_num_pages > 1) :
        pagination($wp_query->max_num_pages, 3); ?>
    <?php endif; ?>
    </section>
    <div class="news__containerpaggination">
        <span id="to_events" style="cursor: pointer;">
            <a>События</a>
        </span>
    </div>
<script type="text/javascript">
       var data_cal = <?php echo $events_cal; ?>
   </script>
   <script src="<?= template(); ?>static/js/be.js"></script>
 
    

<?php
wp_reset_query();
get_template_part('parts/footer', 'archive');
get_footer();
