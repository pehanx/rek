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

              <div class="filters_events">
                <?php if($query_select_events->have_posts()):?>
                    <div class="contact__wrapp">
                    <div class="contact__block" style="margin-bottom: 0px; padding: 30px;height:350px">                          
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
                        endwhile;?>
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
                            <div style="display: flex; align-items: center;">
                                <input value="33" type="checkbox" name="show_events_type[]" class="regular-checkbox" />
                                <span>Форумы</span>
                            </div>
                        </div>
                    </form>
                    </div>
                    </div>
                <?php endif; ?>
    <?php endif;?>
    <div class="contact__wrapp_calendar">
        <div class="contact__block" style="margin-bottom: 0px; padding: 30px">
            <div class="calendar_bg">
                <div id="eventCalendar" class="Calendar">
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </section>
    <section class="news__news">
    
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
    $counter = 1;?>

      <div class="result__main bg_events past_events_list">
    <?php if ( have_posts() ) : ?>
            <div class="news__titlecontainer be-ajax-loadmore-container" style="margin-top: 70px">
        <?php while ( have_posts()) :
            the_post();
            get_template_part('parts/list_element', 'event');  
            endwhile; ?>
        </div>
    <?php endif;?> 
    <?php
        if ($wp_query->max_num_pages > 1) : ?>
            <script>
                var action = 'loadmore_events';
                var ajaxurl = '<?= site_url() ?>/wp-admin/admin-ajax.php';
                var loadmore_posts = '<?= addcslashes(serialize($wp_query->query_vars), "'"); ?>';
                var current_page = <?= (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                var max_pages = '<?= $wp_query->max_num_pages; ?>';
            </script>

            <a href="javascript:;" id="loadmore" class="more-material result__button">Показать еще</a>
            <script src="<?= template(); ?>static/js/be.js"></script>
    <?php endif; ?>
</div>
    <!-- <?php if ($wp_query->max_num_pages > 1) :
        pagination($wp_query->max_num_pages, 3); ?>
    <?php endif; ?> -->
    </section>
    <div class="news__containerpaggination">
        <span id="to_events" style="cursor: pointer;">
            <a>События</a>
        </span>
    </div>
    <script type="text/javascript">
       var data_cal = <?php echo $events_cal; ?>
   </script>
 
    

<?php
wp_reset_query();
get_template_part('parts/footer', 'archive');
get_footer();
