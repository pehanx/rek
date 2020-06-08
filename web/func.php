<?php
require_once 'wp/wp-load.php';
    global $wpdb;

    if(isAuth())
    {
        $my_id = $_SESSION['user_id'];
    }
    
    $table_clients = $wpdb->get_blog_prefix() . 'clients';
    $table_like_events = $wpdb->get_blog_prefix() . 'like_events';
    // $table_sms = $wpdb->get_blog_prefix() . 'sms';
    // $table_forum = $wpdb->get_blog_prefix() . 'forum';
    // $table_forum_comments = $wpdb->get_blog_prefix() . 'forum_comments';
    $table_posts = $wpdb->get_blog_prefix() . 'posts';
    $table_postmeta = $wpdb->get_blog_prefix() . 'postmeta';
    $table_sign_events = $wpdb->get_blog_prefix() . 'sign_events';
    $table_add_customers = $wpdb->get_blog_prefix() . 'add_customers';
    $table_inquiries = $wpdb->get_blog_prefix() . 'inquiries';
    $table_invite_speakers = $wpdb->get_blog_prefix() . 'invite_speakers';

    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

    if (!defined('PAGE_MATERIALS_ID')) {
        define('PAGE_MATERIALS_ID', 11);
    }

    if (!defined('PAGE_SPEAKERS_ID')) {
        define('PAGE_SPEAKERS_ID', 3343);
    }


    
    

if(isset($_GET['func'])){
    switch ($_GET['func']) 
    {

        //Регистрация
        case 'register':
            $surname = $_POST['Фамилия'];
            $name = $_POST['Имя'];
            $patronymic = $_POST['Отчество'];
            $tel = $_POST['Телефон'];
            $email = $_POST['Почта'];
            $company = $_POST['Юридическое_лицо'];
            $region = $_POST['Регион'];
            $country = $_POST['Страна'];
            $sphere = $_POST['Направление'];
            $typeParty = $_POST['Тип_участника'];
            $what_buy = $_POST['ХочуКупить'];
            $login = $_POST['Логин'];
            $pass = $_POST['Пароль'];
            $avatar = "904";

            if(strlen($region) == 0){
                $region = $country;
            }

            $words_typeParty = explode(" ", $typeParty);
            $typeParty = $words_typeParty[0];

            $company = str_replace('\"','"',$company);
            $sphere = str_replace('\"','"',$sphere);

            $pass = password_hash($pass, PASSWORD_DEFAULT);

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            $sql = "CREATE TABLE {$table_clients} (
                id int(11) unsigned NOT NULL auto_increment,
                surname varchar(255) NOT NULL default '',
                name varchar(255) NOT NULL default '',
                patronymic varchar(255) default '',
                tel varchar(255) NOT NULL default '',
                email varchar(255) NOT NULL default '',
                company varchar(255) NOT NULL default '',
                region varchar(255) default '',
                sphere varchar(255) default '',
                typeParty varchar(255) default '',
                what_buy text default '',
                login varchar(255) NOT NULL default '',
                pass varchar(255) NOT NULL default '',
                avatar varchar(255) NOT NULL default '904',
                reset_password_token varchar(255) NOT NULL default '',  
                count_sign_in bigint(20) unsigned NOT NULL default '0'
                date_registration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                last_sign_in_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
                PRIMARY KEY  (id)
            ) {$charset_collate};";

            // Создать таблицу.
            dbDelta( $sql );

            //Проверка на существование пользователя
            $check_login = $wpdb->get_results( " SELECT * FROM {$table_clients} WHERE login = '$login'");
            //Проверка на существование почты
            $check_email = $wpdb->get_results( " SELECT * FROM {$table_clients} WHERE email = '$email'");

            if(!empty($check_login)){
                echo "Пользователь с таким логином уже существует";
            }else if(!empty($check_email)){
                echo "Пользователь с такой почтой уже зарегистрирован";
            }else{
                //Вставить в таблицу wp_clients
                $wpdb->insert($table_clients, array(
                'surname' => $surname,
                'name' => $name,
                'patronymic' => $patronymic,
                'tel' => $tel,
                'email' => $email,
                'company' => $company,
                'region' => $region,
                'sphere' => $sphere,
                'typeParty' => $typeParty,
                'what_buy' => $what_buy,
                'login' => $login,
                'pass' => $pass
                ));

                $fio = $name." ".$surname;

                //Вставить в таблицу engine4_users
                $socdb = new wpdb('usersoc','HisMgqiRI8EG74XlyMPX','dbsoc','localhost');

                $check_email = $socdb->get_results( " SELECT * FROM `engine4_users` WHERE email = '$email'");

                if(empty($check_email)){
                    $date_now = date('Y-m-d H:i:s');


                    $socdb->insert('engine4_users', array(
                    'email'         => $email, 
                    'displayname'   => $fio,
                    'password'      => $pass,
                    'level_id'      => 4,
                    'creation_date' => $date_now,
                    'modified_date' => $date_now
                    ));

                    $last_id = $socdb->insert_id;

                    //Добавить в друзья Дмитрия Лунева 
                    //только что зарегистрированным пользователям
                    $socdb->insert('engine4_user_membership', array(
                    'resource_id'       => $last_id,
                    'user_id'           => 5,
                    'active'            => 1,
                    'resource_approved' => 1,
                    'user_approved'     => 1
                    ));

                    $socdb->insert('engine4_user_membership', array(
                    'resource_id'       => 5,
                    'user_id'           => $last_id,
                    'active'            => 1,
                    'resource_approved' => 1,
                    'user_approved'     => 1
                    ));
                }

            }
        break;

        //Авторизация
        case 'authorization':
            $login = $_POST['Логин'];
            $pass = $_POST['Пароль'];
            require_once 'wp/wp-load.php';
            global $wpdb;

            //Проверка на существование пользователя
            $check_login_pass = $wpdb->get_row( " SELECT * FROM {$table_clients} WHERE login = '$login' OR email = '$login'");

            if(empty($check_login_pass)){
                echo "Вы неправильно ввели логин или пароль";
            }else{
                if (password_verify($pass, $check_login_pass->pass)){
                    $_SESSION["user_id"] = $check_login_pass->id;
                        $wpdb->update($table_clients, 
                            array( 
                                'count_sign_in' => $check_login_pass->count_sign_in+1, 
                                'last_sign_in_date' => date('Y-m-d H:i:s')),
                            array( 'id' => $check_login_pass->id)
                        );
                }else{
                   echo "Вы неправильно ввели логин или пароль"; 
                }
            }
        break;

        //Выход из сайта
        case 'exit_from_site':
            unset($_SESSION["user_id"]);
            setcookie("event_link","", time() - (1800), "/", "", 0);
        break;

        //Фильтр для событий
        case 'show_events_list':
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            $place = $_POST['Местоположение'];

            if(isset($_POST['show_events_type'])){
                $type_event_array = $_POST['show_events_type'];
            }else{
                if(!empty($place)){
                    $type_event_array = array('25','23','27','29','31','33');
                }else{
                    break;
                }
            }
                $wp_query = new WP_Query([
                    'post_type' => 'event',
                    'posts_per_page' => EVENTS_PER_PAGE,
                    'paged' => $paged,
                    'category__in' => $type_event_array,
                    'meta_query' => array(
                    array(
                        'relation' => 'AND',
                        'date' =>    array(
                            'key' => 'start_date',
                            'value' => date('Ymd'),
                            'compare' => '>'
                        ),
                        'place' => array(
                            'key' => 'place',
                            'value' => $place,
                            'compare' => 'LIKE'
                        ),
                    )
                ),
                    'orderby' => array(
                        'date' => 'ASC',
                    )
                ]);


                if( have_posts() ) : ?>
                    <div class="news__titlecontainer be-ajax-loadmore-container" style="margin-top: 70px">
                    <?php 
                        while ( have_posts()) :
                            the_post();
                            get_template_part('parts/list_element', 'event'); 
                        endwhile; 
                    ?>
                    </div>
                <?php endif;?> 
                <?php
            if($wp_query->max_num_pages > 1) : ?>
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
        <?php
        break;

        //Фильтр для прошедших событий
        case 'show_past_events_list':

           
                $place_past = $_POST['Местоположение'];

                if(isset($_POST['show_events_type'])){
                    $type_event_array = $_POST['show_events_type'];
                }else{
                    if(!empty($place_past)){
                        $type_event_array = array('25','23','27','29','31','33');
                    }else{
                        break;
                    }
                }

                    $wp_query = new WP_Query([
                        'post_type' => 'event',
                        'posts_per_page' => EVENTS_PER_PAGE,
                        'category__in' => $type_event_array,
                        'meta_query' => array(
                        array(
                            'relation' => 'AND',
                            'date' =>    array(
                                'key' => 'start_date',
                                'value' => date('Ymd'),
                                'compare' => '<='
                            ),
                            'place' => array(
                                'key' => 'place',
                                'value' => $place_past,
                                'compare' => 'LIKE'
                            ),
                        )
                    ),
                        'orderby' => array(
                            'date'  => 'ASC',
                        )
                    ]);

                   
                    if( have_posts() ) : ?>
                        <div class="news__titlecontainer be-ajax-loadmore-container" style="margin-top: 70px">
                        <?php 
                            while ( have_posts()) :
                                the_post();
                                get_template_part('parts/list_element', 'event'); 
                            endwhile; 
                        ?>
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
                <?php endif; 
        break;

        //Обновить календарь событий при фильтрации по типу и месту событий
        case 'update_calendar_events':

                $place_past = $_POST['Местоположение'];

                if(isset($_POST['show_events_type'])){
                    $type_event_array = $_POST['show_events_type'];
                }else{
                    if(!empty($place_past)){
                        $type_event_array = array('25','23','27','29','31','33');
                    }else{
                        break;
                    }
                }

                    $wp_query = new WP_Query([
                        'post_type' => 'event',
                        'posts_per_page' => -1,
                        'category__in' => $type_event_array,
                        'meta_query' => array(
                        array(
                            'relation' => 'AND',
                            'date' =>    array(
                                'key' => 'start_date',
                                'value' => date('Ymd'),
                                'compare' => '<='
                            ),
                            'place' => array(
                                'key' => 'place',
                                'value' => $place_past,
                                'compare' => 'LIKE'
                            ),
                        )
                    ),
                        'orderby' => array(
                            'date'  => 'ASC',
                        )
                    ]);

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
                    <script type="text/javascript">
                           var data_cal = <?php echo $events_cal; ?>
                           $("#eventCalendar").eventCalendar({
                                jsonData:data_cal
                            });
                    </script>

                    <div class="contact__block" style="margin-bottom: 0px; padding: 30px">
                        <div class="calendar_bg">
                            <div id="eventCalendar" class="Calendar">
                            </div>
                        </div>
                    </div>

                    <?php                    
        break;

        //Установка cookie для перехода к событию после авторизацию
        case 'set_event_link':

            $event_link_to = $_POST['event_link'];
            $type = $_POST['type'];
            setcookie("event_link", $event_link_to, time() + (1800), "/"); 
            if($type == 'reg'){
                setcookie("auth_register", $type, time() + (1800), "/");
            }

        break;

        //Проверка зарегистрирован ли пользователь при нажатии на кнопку "Вступить в клуб"
        case 'check_auth':
            if(isAuth())
            {
                echo "Вы уже вступили в клуб";
            }
        break;
        
        case 'like_event':
            $id_post = $_POST['id_post'];
            $id_client = $my_id;

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                $sql = "CREATE TABLE IF NOT EXISTS {$table_like_events} (
                    id int(11) unsigned NOT NULL auto_increment,
                    id_post bigint(11) unsigned NOT NULL,
                    id_client int(11) unsigned NOT NULL,
                    FOREIGN KEY (id_post) REFERENCES {$table_posts}(id),
                    FOREIGN KEY (id_client) REFERENCES {$table_clients}(id),
                    PRIMARY KEY  (id)
                ) {$charset_collate};";

                // Создать таблицу.
                dbDelta( $sql );

                $have_like_event = $wpdb->get_row( "SELECT * FROM {$table_like_events} WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'");
                
                if(empty($have_like_event)){
                    // Вставить в таблицу
                    $wpdb->insert($table_like_events, array(
                    'id_post' => $id_post,
                    'id_client' => $id_client,
                    ));
                }else{
                    $wpdb->delete( $table_like_events, array(
                    'id_post' => $id_post,
                    'id_client' => $id_client,
                    ));
                }
        break;

        case 'star_like_event':

            $id_post = $_POST['id_post'];
            $id_client = $my_id;
            $btn_class = $_POST['btn_class'];

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                $sql = "CREATE TABLE IF NOT EXISTS {$table_like_events} (
                    id int(11) unsigned NOT NULL auto_increment,
                    id_post bigint(11) unsigned NOT NULL,
                    id_client int(11) unsigned NOT NULL,
                    FOREIGN KEY (id_post) REFERENCES {$table_posts}(id),
                    FOREIGN KEY (id_client) REFERENCES {$table_clients}(id),
                    PRIMARY KEY  (id)
                ) {$charset_collate};";

                // Создать таблицу.
                dbDelta( $sql );

                $have_like_event = $wpdb->get_row( "SELECT * FROM {$table_like_events} WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'");
                
                // "star_img like_event"
                // "like_event inclub__button"
                if(empty($have_like_event)){
                    // Вставить в таблицу
                    $wpdb->insert($table_like_events, array(
                    'id_post' => $id_post,
                    'id_client' => $id_client,
                    ));
                    if($btn_class == "star_img like_event"){
                        echo "http://russianexport.club/app/uploads/2019/11/star.png";
                    }
                    if($btn_class == "like_event inclub__button"){
                        echo "В избранном";
                    }
                    
                }else{
                    $wpdb->delete( $table_like_events, array(
                    'id_post' => $id_post,
                    'id_client' => $id_client,
                    ));
                    if($btn_class == "star_img like_event"){
                        echo "http://russianexport.club/app/uploads/2019/11/star_no.png";
                    }
                    if($btn_class == "like_event inclub__button"){
                        echo "Добавить в избранное";
                    }
                    
                }
        break;

        case 'delete_like_event':

            $id_post = $_POST['id_post'];
            $type_post = $_POST['type_post'];
            $id_client = $my_id;

            $wpdb->delete( $table_like_events, array(
                    'id_post' => $id_post,
                    'id_client' => $id_client,
                    ));
            switch ($type_post) {
                case 'novosti':
                    $like_events_list = $wpdb->get_results("SELECT *
                                                            FROM {$table_posts} 
                                                            inner join {$table_like_events} on {$table_like_events} .id_post = {$table_posts} .id  
                                                            WHERE id_client = '$my_id' 
                                                            AND post_type = 'post' ");?>
                    <?php if(!empty( $like_events_list)):?>
                        <?php foreach($like_events_list as $item):?>
                             <div class="my_events_block">
                                <a href="/novosti/<?=$item->post_name?>/">
                                    <p class="event_title"><?=$item->post_title?></p>
                                        <a 
                                            class="close-form-btn delete_like_event"
                                            data-artid="<?=$item->ID?>"
                                            data_type_post = "novosti"
                                            >
                                        <div class="close-img">
                                            <svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
                                        </div>
                                    </a>
                                </a>
                            </div>
                        <?php endforeach;?>
                    <?php else: ?>
                        <h1>Ничего не найдено</h1>
                    <?php endif;
                break;

                case 'material':
                    $like_events_list = $wpdb->get_results("SELECT *
                                                            FROM {$table_posts} 
                                                            inner join {$table_like_events} on {$table_like_events} .id_post = {$table_posts} .id  
                                                            WHERE id_client = '$my_id' 
                                                            AND post_type = 'material'
                                                            AND post_status = 'publish' ");?>
                    <?php if(!empty( $like_events_list)):?>
                        <?php foreach($like_events_list as $item):?>
                             <div class="my_events_block">
                                <a href="/material/<?=$item->post_name?>/">
                                    <p class="event_title"><?=$item->post_title?></p>
                                        <a 
                                            class="close-form-btn delete_like_event" 
                                            data-artid="<?=$item->ID?>"
                                            data_type_post = "material"
                                            >
                                        <div class="close-img">
                                            <svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
                                        </div>
                                    </a>
                                </a>
                            </div>
                        <?php endforeach;?>
                    <?php else: ?>
                        <h1>Ничего не найдено</h1>
                    <?php endif;?>
                    <a href="<?= get_permalink(PAGE_MATERIALS_ID); ?>" class="link-page-speakers">Вернуться к материалам →</a>
                    <?php
                break;

                case 'event':
                    $like_events_list = $wpdb->get_results("
                                                    SELECT *
                                                    FROM {$table_posts} 
                                                    inner join {$table_like_events} on {$table_like_events} .id_post = {$table_posts} .id 
                                                    inner join wp_postmeta on wp_postmeta.post_id = {$table_posts} .id 
                                                    WHERE id_client = '$my_id' AND meta_key = 'event_date'");
                    if(!empty( $like_events_list)):
                        foreach($like_events_list as $item):?>
                            <div class="my_events_block">
                                <a href="/event/<?=$item->post_name?>/">
                                    <p><?=$item->meta_value?></p>
                                    <p class="event_title"><?=$item->post_title?></p>
                                        <a 
                                            class="close-form-btn delete_like_event" 
                                            data-artid="<?=$item->ID?>"
                                            data_type_post = "event"
                                            >
                                        <div class="close-img">
                                            <svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
                                        </div>
                                    </a>
                                </a>
                            </div>
                        <?php endforeach;
                    else: 
                        echo "<h1>Ничего не найдено</h1>";
                    endif; 
                break;

                case 'speaker':
                    $like_events_list = $wpdb->get_results("SELECT *
                                                            FROM {$table_posts} 
                                                            inner join {$table_like_events} on {$table_like_events} .id_post = {$table_posts} .id  
                                                            WHERE id_client = '$my_id' 
                                                            AND post_type = 'speaker'
                                                            AND post_status = 'publish' ");?>
                    <?php if(!empty( $like_events_list)):?>
                        <div class="checkbox__block checkbox_select-all-speakers">
                            <div class="checkbox__input">
                                <input type="checkbox"  id="select_all_speakers">
                                <label for="select_all_speakers"></label>
                            </div>
                            <span class="checkbox__text">Выбрать всеx</span>
                        </div>

                        <?php foreach($like_events_list as $item):?>
                            <div class="checkbox__block speaker-checkbox__block">
                                <div class="checkbox__input">
                                    <input type="checkbox"  id="<?=$item->ID?>">
                                    <label for="<?=$item->ID?>"></label>
                                </div>
                               
                                <div class="my_events_block speaker_block">
                                    <a href="/speaker/<?=$item->post_name?>/">
                                        <p><b><?=$item->post_title?></b></p>
                                        <p class="event_title" style="overflow: hidden;
                                                   white-space: nowrap;
                                                   text-overflow: ellipsis;">
                                            <?=$item->post_content?>        
                                        </p>
                                            <a 
                                                class="close-form-btn delete_like_event"
                                                data-artid="<?=$item->ID?>"
                                                data_type_post = "speaker"
                                                >
                                            <div class="close-img">
                                                <svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
                                            </div>
                                        </a>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php else: ?>
                        <h1>Ничего не найдено</h1>
                    <?php endif;?>
                    <a href="<?= get_permalink(PAGE_SPEAKERS_ID); ?>" class="link-page-speakers">Вернуться к экспертам →</a>
                    <?php
                break;
            }
        break;

        case 'change_password':       
            $pass = $_POST['Пароль'];
            $email = $_POST['email'];
            
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $wpdb->update( 
                    $table_clients, 
                    array( 
                        'pass' => $pass,
                        'reset_password_token' => ''
                    ), 
                    array( 
                        'email' => $email
                    )
                );

            //Изменить в таблице engine4_users
            $socdb = new wpdb('usersoc','HisMgqiRI8EG74XlyMPX','dbsoc','localhost');

            $socdb->update('engine4_users', array(
                    'password' => $pass
                ),
                array(
                    'email' => $email
                )
            );

        break;
        
        case 'change_my_data':       
            $surname = $_POST['Фамилия'];
            $name = $_POST['Имя'];
            $patronymic = $_POST['Отчество'];
            $tel = $_POST['Телефон'];
            $company = $_POST['Юридическое_лицо'];
            $region = $_POST['Регион'];
            $sphere = $_POST['Направление'];
            $typeParty = $_POST['Тип_участника'];
            $what_buy = $_POST['ХочуКупить'];

            $words_typeParty = explode(" ", $typeParty);
            $typeParty = $words_typeParty[0];

            $company = str_replace('\"','"',$company);
            $sphere    = str_replace('\"','"',$sphere);

            $wpdb->update($table_clients, array(
                'surname' => $surname,
                'name' => $name,
                'patronymic' => $patronymic,
                'tel' => $tel,
                'company' => $company,
                'region' => $region,
                'sphere' => $sphere,
                'typeParty' => $typeParty,
                'what_buy' => $what_buy
                ),
                array(
                    'id' => $my_id
                )
            );

        break;

        case 'sign_event':

            $id_post = $_POST['ID_события'];
            $id_client = $my_id;

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                $sql = "CREATE TABLE IF NOT EXISTS {$table_sign_events} (
                    id int(11) unsigned NOT NULL auto_increment,
                    id_post bigint(20) unsigned NOT NULL,
                    id_client int(11) unsigned NOT NULL,
                    FOREIGN KEY (id_post) REFERENCES {$table_posts}(id),
                    FOREIGN KEY (id_client) REFERENCES {$table_clients}(id),
                    PRIMARY KEY  (id)
                ) {$charset_collate};";

                // Создать таблицу.
                dbDelta( $sql );

                $have_sign_event = $wpdb->get_row( "SELECT * FROM {$table_sign_events} WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'");

                if(empty($have_sign_event)){
                    // Вставить в таблицу
                    $wpdb->insert($table_sign_events, array(
                        'id_post'   => $id_post,
                        'id_client' => $id_client
                        ));
                }
                $sign_events_clients = $wpdb->get_results( "SELECT * 
                                                                        FROM wp_sign_events
                                                                        INNER JOIN wp_clients on wp_clients.id = wp_sign_events.id_client
                                                                     WHERE `id_post` = '$id_post'");?>
                    <table style=" font-size: 18px; width: 100%; text-align: left;">
                        <caption style="margin-bottom: 20px"><h2 style="text-align: center;"><?=count($sign_events_clients)?> участников</h2></caption>
                        <th style="border-bottom: 1px solid black; padding: 10px">Имя</th>
                        <th style="border-bottom: 1px solid black; padding: 10px">Компания</th>
                        <th style="border-bottom: 1px solid black; padding: 10px">Должность</th>
                        <?php foreach ($sign_events_clients as $item):?>
                            <tr style="border-bottom: 1px solid black">
                                <td style="padding: 10px">
                                    <a target="_blank" href="./profile?client=<?=$item->id_client?>">
                                        <?=$item->fio?>
                                    </a>
                                    <?php if($item->search or $item->suggest):?>
                                        <?php  $my_info = ($_COOKIE['id'] && $_COOKIE['id'] == $item->id_client ? 1:0); ?>
                                            <?php if($my_info):?>
                                    <div style="margin-top: 10px; cursor: pointer;" class="open_change_event_form">
                                            <?php else:?>
                                    <div style="margin-top: 10px;">           
                                            <?php endif;?>
                                        <?php if($item->suggest):?>
                                            <?php if($my_info):
                                                $item_suggest = $item->suggest;
                                            endif; ?>
                                            <p style="font-size: 12px;">Предлагаю: <?=$item->suggest?></p>
                                        <?php endif;?>
                                        <?php if($item->search):?>
                                            <?php if($my_info):
                                                $item_search = $item->search;
                                            endif; ?>
                                            <p style="font-size: 12px;">Ищу: <?=$item->search?></p>
                                        <?php endif;?>
                                    </div>
                                    <?php endif;?>
                                </td>
                                <td style="padding: 10px">
                                    <span><?=$item->company?></span><br>
                                    <span style="font-size: 12px; text-align:center;"><?=$item->sphere?></span>
                                </td>
                                <td style="padding: 10px; "><?=$item->job?></td>
                            </tr>
                        <?php endforeach;?>
                    </table>
                    <?php
            break;

        case 'delete_sign_event_client':

            $id_post = $_POST['id_post'];
            $id_client = $_POST['id_client'];

            $wpdb->delete( $table_sign_events, array(
                    'id_post' => $id_post,
                    'id_client' => $id_client,
            ));

            $sign_events_clients = $wpdb->get_results( "SELECT * 
                                                        FROM wp_sign_events
                                                        INNER JOIN wp_clients on wp_clients.id = wp_sign_events.id_client
                                                        WHERE `id_post` = '$id_post'");?>
            <h3 style="text-align: center;">
                <?=count($sign_events_clients)?> участников на мероприятии
            </h3>
            <div class="sign_event_block">
            <?php foreach ($sign_events_clients as $item):?>
                <div class="my_events_block">
                    <p><?=$item->fio?></p>
                    <p style="font-size: 14px">
                        Телефон: <a href="tel:<?=$item->tel?>"><?=$item->tel?></a><br>
                        Почта: <a href="mailto:<?=$item->email?>"><?=$item->email?></a><br>
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
        <?php
        break;

        case 'add_customer':
            $data_where_search = $_POST['data_where_search'];

            $company   = $_POST['data_company'];
            $info      = $_POST['data_info'];
            $zapros    = $_POST['data_zapros'];
            $id_client = $my_id;

            $company = str_replace('\"','"',$company);
            $info    = str_replace('\"','"',$info);

            switch ($data_where_search) {
                case 'Казахстан':
                    $data_contact1 = $_POST['data_contact1'];
                    $data_contact2 = $_POST['data_contact2'];
                    $data_contact3 = $_POST['data_contact3'];
                    $data_contact4 = $_POST['data_contact4'];
                    $data_contact5 = $_POST['data_contact5'];
                    $data_contact6 = $_POST['data_contact6'];
                    $data_contact7 = $_POST['data_contact7'];
                    break;
                case 'Киргизия':
                    $data_phone   = $_POST['data_phone'];
                    $data_mail    = $_POST['data_mail'];
                    $data_address = $_POST['data_address'];
                    break;
                case 'Беларусь':
                    $data_phone    = $_POST['data_phone'];
                    $data_mail     = $_POST['data_mail'];
                    $data_address  = $_POST['data_address'];
                    $data_category = $_POST['data_category'];
                    break;
                case 'Индийские импортёры':
                    $data_phone    = $_POST['data_phone'];
                    $data_mail     = $_POST['data_mail'];
                    $data_address  = $_POST['data_address'];
                    $data_site     = $_POST['data_site'];
                    break;
                case 'Индийские компании':
                    $data_phone    = $_POST['data_phone'];
                    $data_address  = $_POST['data_address'];
                    $data_site     = $_POST['data_site'];
                    $data_contacts = $_POST['data_contacts'];
                    $data_category = $_POST['data_category'];
                    break;
                case 'Lesprom':
                    $data_phone    = $_POST['data_phone'];
                    $data_mail     = $_POST['data_mail'];
                    $data_site     = $_POST['data_site'];
                    $data_country  = $_POST['data_country'];
                    $data_workers  = $_POST['data_workers'];
                    break;
                case 'Food1':
                    $data_phone    = $_POST['data_phone'];
                    $data_site     = $_POST['data_site'];
                    $data_country  = $_POST['data_country'];
                    break;
                default:
                    exit();
                    break;
            }

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                $sql = "CREATE TABLE IF NOT EXISTS {$table_add_customers} (
                    id int(11) unsigned NOT NULL auto_increment,
                    id_client int(11) unsigned NOT NULL,
                    where_search varchar(55) DEFAULT '' NOT NULL,
                    company text DEFAULT '' NOT NULL,
                    info text DEFAULT '' NOT NULL,
                    note text DEFAULT '' NOT NULL,
                    zapros varchar(55) DEFAULT '' NOT NULL,
                    contact1 text DEFAULT '' NOT NULL,
                    contact2 text DEFAULT '' NOT NULL,
                    contact3 text DEFAULT '' NOT NULL,
                    contact4 text DEFAULT '' NOT NULL,
                    contact5 text DEFAULT '' NOT NULL,
                    contact6 text DEFAULT '' NOT NULL,
                    contact7 text DEFAULT '' NOT NULL,
                    site varchar(55) DEFAULT '' NOT NULL,
                    phone text DEFAULT '' NOT NULL,
                    address text DEFAULT '' NOT NULL,
                    email text DEFAULT '' NOT NULL,
                    category text DEFAULT '' NOT NULL,
                    contacts text DEFAULT '' NOT NULL,
                    country varchar(55) DEFAULT '' NOT NULL,
                    workers text DEFAULT '' NOT NULL,
                    FOREIGN KEY (id_client) REFERENCES {$table_clients}(id),
                    PRIMARY KEY (id)
                ) {$charset_collate};";

            // Создать таблицу.
            dbDelta( $sql );

            switch ($data_where_search) {
                case 'Казахстан':
                     // Вставить в таблицу
                    $wpdb->insert($table_add_customers, array(
                        'id_client' => $id_client,
                        'where_search' => $data_where_search,
                        'company'   => $company,
                        'info'      => $info,
                        'zapros'    => $zapros,
                        'contact1'    => $data_contact1,
                        'contact2'    => $data_contact2,
                        'contact3'    => $data_contact3,
                        'contact4'    => $data_contact4,
                        'contact5'    => $data_contact5,
                        'contact6'    => $data_contact6,
                        'contact7'    => $data_contact7
                    ));

                    echo "
                        <a 
                            class          = 'delete_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info' 
                            data_zapros    = '$zapros' 
                            data_contact1  = '$data_contact1'
                            data_contact2  = '$data_contact2'
                            data_contact3  = '$data_contact3'
                            data_contact4  = '$data_contact4'
                            data_contact5  = '$data_contact5'
                            data_contact6  = '$data_contact6'
                            data_contact7  = '$data_contact7'
                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>убрать
                        </a>
                        ";
                    break;
                case 'Киргизия':
                      // Вставить в таблицу
                    $wpdb->insert($table_add_customers, array(
                        'id_client' => $id_client,
                        'where_search' => $data_where_search,
                        'company'   => $company,
                        'info'      => $info,
                        'zapros'    => $zapros,
                        'phone'     => $data_phone,
                        'address'   => $data_address,
                        'email'     => $data_mail
                    ));

                    echo "
                        <a 
                            class          = 'delete_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info' 
                            data_zapros    = '$zapros' 
                            data_phone     = '$data_phone'
                            data_mail      = '$data_mail'
                            data_address   = '$data_address'
                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>убрать
                        </a>";
                    break;
                case 'Беларусь':
                      // Вставить в таблицу
                    $wpdb->insert($table_add_customers, array(
                        'id_client' => $id_client,
                        'where_search' => $data_where_search,
                        'company'   => $company,
                        'info'      => $info,
                        'zapros'    => $zapros,
                        'phone'     => $data_phone,
                        'address'   => $data_address,
                        'email'     => $data_mail,
                        'category'  => $data_category
                    ));

                    echo "
                        <a 
                            class          = 'delete_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info' 
                            data_zapros    = '$zapros' 
                            data_phone     = '$data_phone'
                            data_mail      = '$data_mail'
                            data_address   = '$data_address'
                            data_category  = '$data_category'
                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>убрать
                        </a>";
                    break;
                case 'Индийские импортёры':
                      // Вставить в таблицу
                    $wpdb->insert($table_add_customers, array(
                        'id_client' => $id_client,
                        'where_search' => $data_where_search,
                        'company'   => $company,
                        'info'      => $info,
                        'zapros'    => $zapros,
                        'phone'     => $data_phone,
                        'address'   => $data_address,
                        'email'     => $data_mail,
                        'site'      => $data_site
                    ));

                    echo "
                        <a 
                            class          = 'delete_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info' 
                            data_zapros    = '$zapros' 
                            data_phone     = '$data_phone'
                            data_mail      = '$data_mail'
                            data_address   = '$data_address'
                            data_site      = '$data_site'
                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>убрать
                        </a>";
                    break;
                case 'Индийские компании':
                      // Вставить в таблицу
                    $wpdb->insert($table_add_customers, array(
                        'id_client' => $id_client,
                        'where_search' => $data_where_search,
                        'company'   => $company,
                        'info'      => $info,
                        'zapros'    => $zapros,
                        'phone'     => $data_phone,
                        'address'   => $data_address,
                        'site'      => $data_site,
                        'contacts'  => $data_contacts,
                        'category'  => $data_category
                    ));

                    echo "
                        <a 
                            class          = 'delete_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info' 
                            data_zapros    = '$zapros' 
                            data_phone     = '$data_phone'
                            data_address   = '$data_address'
                            data_site      = '$data_site'
                            data_contacts  = '$data_contacts'
                            data_category  = '$data_category'
                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>убрать
                        </a>";
                    break;
                case 'Lesprom':
                      // Вставить в таблицу
                    $wpdb->insert($table_add_customers, array(
                        'id_client' => $id_client,
                        'where_search' => $data_where_search,
                        'company'   => $company,
                        'info'      => $info,
                        'zapros'    => $zapros,
                        'phone'     => $data_phone,
                        'email'     => $data_mail,
                        'site'      => $data_site,
                        'country'   => $data_country,
                        'workers'   => $data_workers
                    ));

                    echo "
                        <a 
                            class          = 'delete_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info' 
                            data_zapros    = '$zapros' 
                            data_phone     = '$data_phone'
                            data_mail      = '$data_mail'
                            data_site      = '$data_site'
                            data_country   = '$data_country'
                            data_workers   = '$data_workers'
                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>убрать
                        </a>";
                    break;
                case 'Food1':
                      // Вставить в таблицу
                    $wpdb->insert($table_add_customers, array(
                        'id_client' => $id_client,
                        'where_search' => $data_where_search,
                        'company'   => $company,
                        'info'      => $info,
                        'zapros'    => $zapros,
                        'phone'     => $data_phone,
                        'site'      => $data_site,
                        'country'   => $data_country
                    ));

                    echo "
                        <a 
                            class          = 'delete_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info' 
                            data_zapros    = '$zapros' 
                            data_phone     = '$data_phone'
                            data_site      = '$data_site'
                            data_country   = '$data_country'
                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>убрать
                        </a>";
                    break;
            }

        break;

        //Удалить компанию из поиска у себя в личном кабинете
        case 'delete_customer':
            $data_where_search = $_POST['data_where_search'];

            $company   = $_POST['data_company'];
            $info      = $_POST['data_info'];
            $zapros    = $_POST['data_zapros'];
            $id_client = $my_id;

            $company = str_replace('\"','"',$company);
            $info    = str_replace('\"','"',$info);

            switch ($data_where_search) {
                case 'Казахстан':
                    $data_contact1 = $_POST['data_contact1'];
                    $data_contact2 = $_POST['data_contact2'];
                    $data_contact3 = $_POST['data_contact3'];
                    $data_contact4 = $_POST['data_contact4'];
                    $data_contact5 = $_POST['data_contact5'];
                    $data_contact6 = $_POST['data_contact6'];
                    $data_contact7 = $_POST['data_contact7'];

                    // Удалить из таблицы
                    $wpdb->delete( $table_add_customers, array(
                        'id_client' => $id_client,
                        'company'   => $company
                    ));

                    echo "
                    <a 
                        class          = 'add_customer' 
                        href           = 'javascript:;'
                        data_where_search = '$data_where_search'
                        data_company   = '$company' 
                        data_info      = '$info'
                        data_zapros    = '$zapros' 
                        data_contact1  = '$data_contact1'
                        data_contact2  = '$data_contact2'
                        data_contact3  = '$data_contact3'
                        data_contact4  = '$data_contact4'
                        data_contact5  = '$data_contact5'
                        data_contact6  = '$data_contact6'
                        data_contact7  = '$data_contact7'
                        >
                        <svg class='icon__up' width='12px' height='12px'>
                            <use xlink:href='#icon_plus'></use>
                        </svg>добавить
                    </a>";
                    break;
                case 'Киргизия':
                    $data_phone   = $_POST['data_phone'];
                    $data_mail    = $_POST['data_mail'];
                    $data_address = $_POST['data_address'];

                    // Удалить из таблицы
                    $wpdb->delete( $table_add_customers, array(
                        'id_client' => $id_client,
                        'company'   => $company
                    ));

                    echo "
                    <a 
                        class          = 'add_customer' 
                        href           = 'javascript:;'
                        data_where_search = '$data_where_search'
                        data_company   = '$company' 
                        data_info      = '$info'
                        data_zapros    = '$zapros' 
                        data_phone     = '$data_phone' 
                        data_mail      = '$data_mail' 
                        data_address   = '$data_address'
                        >
                        <svg class='icon__up' width='12px' height='12px'>
                            <use xlink:href='#icon_plus'></use>
                        </svg>добавить
                    </a>";
                    break;
                case 'Беларусь':
                    $data_phone    = $_POST['data_phone'];
                    $data_mail     = $_POST['data_mail'];
                    $data_address  = $_POST['data_address'];
                    $data_category = $_POST['data_category'];

                    // Удалить из таблицы
                    $wpdb->delete( $table_add_customers, array(
                        'id_client' => $id_client,
                        'company'   => $company
                    ));

                    echo "
                    <a 
                        class          = 'add_customer' 
                        href           = 'javascript:;'
                        data_where_search = '$data_where_search'
                        data_company   = '$company' 
                        data_info      = '$info'
                        data_zapros    = '$zapros' 
                        data_phone     = '$data_phone' 
                        data_mail      = '$data_mail' 
                        data_address   = '$data_address'
                        data_category  = '$data_category'
                        >
                        <svg class='icon__up' width='12px' height='12px'>
                            <use xlink:href='#icon_plus'></use>
                        </svg>добавить
                    </a>";
                    break;
                case 'Индийские импортёры':
                    $data_phone    = $_POST['data_phone'];
                    $data_mail     = $_POST['data_mail'];
                    $data_address  = $_POST['data_address'];
                    $data_site     = $_POST['data_site'];

                    // Удалить из таблицы
                    $wpdb->delete( $table_add_customers, array(
                        'id_client' => $id_client,
                        'company'   => $company
                    ));

                    echo "
                    <a 
                        class          = 'add_customer' 
                        href           = 'javascript:;'
                        data_where_search = '$data_where_search'
                        data_company   = '$company' 
                        data_info      = '$info'
                        data_zapros    = '$zapros' 
                        data_phone     = '$data_phone' 
                        data_mail      = '$data_mail' 
                        data_address   = '$data_address'
                        data_site      = '$data_site'
                        >
                        <svg class='icon__up' width='12px' height='12px'>
                            <use xlink:href='#icon_plus'></use>
                        </svg>добавить
                    </a>";
                    break;
                case 'Индийские компании':
                    $data_phone    = $_POST['data_phone'];
                    $data_address  = $_POST['data_address'];
                    $data_site     = $_POST['data_site'];
                    $data_contacts = $_POST['data_contacts'];
                    $data_category = $_POST['data_category'];

                    // Удалить из таблицы
                    $wpdb->delete( $table_add_customers, array(
                        'id_client' => $id_client,
                        'company'   => $company
                    ));

                    echo "
                    <a 
                        class          = 'add_customer' 
                        href           = 'javascript:;'
                        data_where_search = '$data_where_search'
                        data_company   = '$company' 
                        data_info      = '$info'
                        data_zapros    = '$zapros' 
                        data_phone     = '$data_phone' 
                        data_address   = '$data_address'
                        data_site      = '$data_site'
                        data_contacts  = '$data_contacts'
                        data_category  = '$data_category'

                        >
                        <svg class='icon__up' width='12px' height='12px'>
                            <use xlink:href='#icon_plus'></use>
                        </svg>добавить
                    </a>";
                    break;
                case 'Lesprom':
                    $data_phone    = $_POST['data_phone'];
                    $data_mail     = $_POST['data_mail'];
                    $data_site     = $_POST['data_site'];
                    $data_country  = $_POST['data_country'];
                    $data_workers  = $_POST['data_workers'];

                    // Удалить из таблицы
                    $wpdb->delete( $table_add_customers, array(
                        'id_client' => $id_client,
                        'company'   => $company
                    ));

                    echo "
                        <a 
                            class          = 'add_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info'
                            data_zapros    = '$zapros' 
                            data_phone     = '$data_phone'
                            data_mail      = '$data_mail'
                            data_site      = '$data_site'
                            data_country   = '$data_country'
                            data_workers   = '$data_workers'

                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>добавить
                        </a>";
                    break;
                case 'Food1':
                    $data_phone    = $_POST['data_phone'];
                    $data_site     = $_POST['data_site'];
                    $data_country  = $_POST['data_country'];

                    // Удалить из таблицы
                    $wpdb->delete( $table_add_customers, array(
                        'id_client' => $id_client,
                        'company'   => $company
                    ));

                    echo "
                        <a 
                            class          = 'add_customer' 
                            href           = 'javascript:;'
                            data_where_search = '$data_where_search'
                            data_company   = '$company' 
                            data_info      = '$info'
                            data_zapros    = '$zapros' 
                            data_phone     = '$data_phone'
                            data_site      = '$data_site'
                            data_country   = '$data_country'

                            >
                            <svg class='icon__up' width='12px' height='12px'>
                                <use xlink:href='#icon_plus'></use>
                            </svg>добавить
                        </a>";
                    break;
                default:
                    exit();
                    break;
            }
        break;

        //Показать список компаний по выбору их страны
        case 'show_сompany_list_by_country':
            $json_html_food1 = json_decode($_POST['json_html_food1']);
            print_r($json_html_food1);
        break;

        //Фильтр для участников клуба
        case 'show_clients_list':

            $order_by_field = '';
            if(isset($_POST['order_field'])){
                $order_field = $_POST['order_field'];
                if(!empty($order_field)){
                    $words_order = explode("-", $order_field);
                    $ASC_DESC    = $words_order[0];
                    $data_field  = $words_order[1];

                    $order_by_field = ' ORDER BY ';
                    $order_by_field .= $data_field;
                    $order_by_field .= ' '. $ASC_DESC;
                }
            }

            $where_search_text = '';
            if(isset($_POST['Поиск'])){
                $search_text = $_POST['Поиск'];
                $search_text = '%' . $wpdb->esc_like( $search_text ) . '%';
                if(!empty($search_text)){
                    $where_search_text = " AND (
                        `surname`    like %s OR 
                        `name`       like %s OR 
                        `patronymic` like %s OR 
                        `tel`        like %s OR 
                        `patronymic` like %s OR 
                        `email`      like %s OR 
                        `company`    like %s OR 
                        `region`     like %s OR 
                        `sphere`     like %s OR  
                        `typeParty`  like %s)";
                }
            }

            $search_region = $_POST['Регион'];
            $search_region = '%' . $wpdb->esc_like( $search_region ) . '%';

            // $search_forum_sphere = $_POST['search_forum_sphere'];
            // $search_forum_sphere = '%' . $wpdb->esc_like( $search_forum_sphere ) . '%';

            $where_forum_type = '';
            if(isset($_POST['show_typeParty'])){
                $show_typeParty = $_POST['show_typeParty'];
                if(empty($show_typeParty)){
                    echo("Вы не выбрали ни одного типа.");
                }else{
                    $N = count($show_typeParty);

                    $where_forum_type = 'AND (';
                    
                    for($i=0; $i < $N; $i++)
                    {
                      if($i>0){
                       $where_forum_type.= ' OR ';
                      }
                      $show_typeParty[$i] = esc_sql($show_typeParty[$i]);
                      $where_forum_type .= " typeParty = '$show_typeParty[$i]'";
                    }
                    $where_forum_type .= ')';
                }
            }
       
            $all_clients = $wpdb->get_results($wpdb->prepare( "
                
                SELECT *
                FROM {$table_clients}
                WHERE 
                    region like %s
                    $where_forum_type
                    $where_search_text
                    $order_by_field
                    ",
                    $search_region, 
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text
                ));?>

        <?php
         if(!empty( $all_clients)):?>
          <table id="customers">
            <tr>
              <th>№</th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_FIO"
                  data_field = "surname"
                  >ФИО</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_TELEPHONE"
                  data_field = "tel"
                  >Телефон</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_EMAIL"
                  data_field = "email"
                  >Почта</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_COMPANY"
                  data_field = "company"
                  >Компания</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_SPHERE"
                  data_field = "sphere"
                  >Сфера</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_REGION"
                  data_field = "region"
                  >Регион</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_TYPE-PARTY"
                  data_field = "typeParty"
                  >Тип участия</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_COUNT-SIGN-IN"
                  data_field = "count_sign_in"
                  >Входы</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_LAST-SIGN-IN-DATE"
                  data_field = "last_sign_in_date"
                  >Последний вход<br>(по Мгн)</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_DATE-REGISTRATION"
                  data_field = "date_registration"
                  >Дата регистрации<br>(по Мгн)</a></th>
            </tr>
          <?php
            $i = 0; 
            foreach($all_clients as $item):
              
              if($item->date_registration == '0000-00-00 00:00:00'){
                $date_registration = '-'; 
              }else{
                $date_registration = strtotime($item->date_registration)+3600*10;
                $date_registration = date("H:i d.m.Y", $date_registration);
              }

              if($item->last_sign_in_date == '0000-00-00 00:00:00'){
                $date_last_visit = '-'; 
              }else{
                $date_last_visit = strtotime($item->last_sign_in_date) +3600*5;
                $date_last_visit = date("H:i d.m.Y", $date_last_visit);
              }

              $i++;
          ?>
            <tr>
              <td><?=$i?></td>
              <td>
                <?=$item->surname?> 
                <?=$item->name?> 
                <?=$item->patronymic?>    
              </td>
              <td><a href="tel:<?=$item->tel?>"><?=$item->tel?></a></td>
              <td><a href="mailto:<?=$item->email?>"><?=$item->email?></a></td>
              <td><?=$item->company?></td>
              <td><?=$item->sphere?></td>
              <td><?=$item->region?></td>
              <td><?=$item->typeParty?></td>
              <td><?=$item->count_sign_in?></td>
              <td><?=$date_last_visit?></td>
              <td><?=$date_registration?></td>
            </tr>  
          <?php endforeach;?>
          </table>
        <?php else:?>
          <h1 style="text-align: center;font-size: 35px;">Ничего не найдено</h1>
        <?php endif;
        break;

        case 'delete_like_customer':

            $id_post = $_POST['id_post'];
            $id_client = $my_id;

            $wpdb->delete( $table_add_customers, array(
                    'id' => $id_post,
                    'id_client' => $id_client,
                    ));
            $like_events_list = $wpdb->get_results("
                SELECT *, 
                    {$table_add_customers}.company as customer_company,
                    {$table_add_customers}.id as customer_id

                FROM {$table_add_customers} 
                inner join {$table_clients} on {$table_clients}.id = {$table_add_customers}.id_client
                WHERE id_client = '$my_id' ");?>
            <?php if(!empty( $like_events_list)):?>
                <?php foreach($like_events_list as $item):?>
                    <div class="my_events_block">
                        <a href='?customer=<?=$item->customer_id?>' 
                          title='<?=$item->info?>'>
                            <p style="display: flex;">
                                <span style="width: 80%">
                                    <b><?=$item->customer_company?></b>
                                </span>
                                <span style="text-align:right;">
                                    <?php if($item->where_search == 'Lesprom'):
                                        echo "Предприятия лесной отрасли";
                                    elseif($item->where_search == 'Food1'):
                                        echo "Предприятия пищевой промышленности";      
                                    else:
                                        echo $item->where_search;       
                                    endif;?>
                                </span>
                            </p>
                            <p 
                                class="event_title" 
                                style="overflow: hidden;
                                       white-space: nowrap;
                                       text-overflow: ellipsis;
                                       margin-bottom: 10px">
                                <?=$item->info?>        
                            </p>
                            <?php if($item->note):?>
                                <p class="customer_note" style="font-size: 13px;margin-bottom: 0;font-weight: 500;margin-bottom: 0">
                                    Комментарий:
                                </p>
                                <p class="customer_note">
                                    <?=$item->note?>        
                                </p>
                            <?php endif;?>
                                <p class="customer_note" style="font-size: 13px; margin-bottom:0;font-weight: 500;margin-bottom: 0">
                                    Запрос:
                                </p>
                                <p class="customer_note">
                                    <?=$item->zapros?>      
                                </p>
                                <a 
                                    class="close-form-btn delete_like_customer"
                                    data-artid="<?=$item->customer_id?>"
                                    >
                                <div class="close-img">
                                    <svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
                                </div>
                            </a>
                        </a>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <h1>Ничего не найдено</h1>
            <?php endif;
        break;

        case 'add_note_customer':

            $note    = $_POST['Пометка_покупателя'];
            $id_post = $_POST['id_add_customer'];

            //Обновить запись
            $wpdb->update($table_add_customers, 
                array(
                    'note' => $note
                ),
                array(
                    'id' => $id_post
                ));
            $customer_list = $wpdb->get_row("
            SELECT *
            FROM {$table_add_customers} 
            WHERE id = '$id_post'");

            echo $customer_list->note;

        break;

        case 'delete_like_customer_select':

            $id_post = $_POST['id_post'];
            $id_client = $my_id;

            $wpdb->delete( $table_add_customers, array(
                    'id' => $id_post,
                    'id_client' => $id_client,
                ));

        break;

        case 'search_customer_in_my_baza':

            $id_client = $my_id;

            $search_source = $_POST['where_search_customers_by_select'];
            $search_source = '%' . $wpdb->esc_like( $search_source ) . '%';

            $where_search_text = '';
            if(isset($_POST['Поиск_покупателя_в_базе'])){
                $search_text = $_POST['Поиск_покупателя_в_базе'];
                $search_text = '%' . $wpdb->esc_like( $search_text ) . '%';
                if(!empty($search_text)){
                    $where_search_text = " AND (
                        `company`      like %s OR 
                        `info`         like %s OR 
                        `note`         like %s OR 
                        `zapros`       like %s OR
                        `contact1`     like %s OR   
                        `contact2`     like %s OR     
                        `contact3`     like %s OR 
                        `contact4`     like %s OR 
                        `contact5`     like %s OR 
                        `contact6`     like %s OR 
                        `contact7`     like %s OR 
                        `site`         like %s OR 
                        `phone`        like %s OR 
                        `address`      like %s OR 
                        `email`        like %s OR 
                        `category`     like %s OR 
                        `contacts`     like %s OR 
                        `country`      like %s OR 
                        `workers`      like %s 
                    )";
                }
            }

            $like_events_list = $wpdb->get_results($wpdb->prepare( "
                
                SELECT *
                FROM {$table_add_customers}
                WHERE 
                    `id_client` = '$my_id' AND
                    `where_search` like %s
                    $where_search_text
                    ",
                    $search_source,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text,
                    $search_text
                ));?>

            <?php if(!empty( $like_events_list)):?>
                <?php foreach($like_events_list as $item):?>
                    <div class="my_events_block">
                        <a href='?customer=<?=$item->id?>' 
                          title='<?=$item->info?>'>
                            <p style="display: flex;">
                                <span style="width: 80%">
                                    <b><?=$item->company?></b>
                                </span>
                                <span style="text-align:right;">
                                    <?php if($item->where_search == 'Lesprom'):
                                        echo "Предприятия лесной отрасли";
                                    elseif($item->where_search == 'Food1'):
                                        echo "Предприятия пищевой промышленности";      
                                    else:
                                        echo $item->where_search;       
                                    endif;?>
                                </span>
                            </p>
                            <p 
                                class="event_title" 
                                style="overflow: hidden;
                                       white-space: nowrap;
                                       text-overflow: ellipsis;
                                       margin-bottom: 10px">
                                <?=$item->info?>        
                            </p>
                            <?php if($item->note):?>
                                <p class="customer_note" style="font-size: 13px;margin-bottom: 0;font-weight: 500;margin-bottom: 0">
                                    Комментарий:
                                </p>
                                <p class="customer_note">
                                    <?=$item->note?>        
                                </p>
                            <?php endif;?>
                                <p class="customer_note" style="font-size: 13px; margin-bottom:0;font-weight: 500;margin-bottom: 0">
                                    Запрос: 
                                </p>
                                <p class="customer_note">
                                    <?=$item->zapros?>
                                </p>
                            <?php if($_POST['Поиск_покупателя_в_базе'] == '' && $_POST['where_search_customers_by_select'] == ''):?>
                                <a 
                                    class="close-form-btn delete_like_customer"
                                    data-artid="<?=$item->id?>"
                                    >
                                <div class="close-img">
                                    <svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
                                </div>
                            </a>
                            <?php endif;?>
                        </a>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <h1>Ничего не найдено</h1>
            <?php endif;
        break;

        case 'mail_to_clients':
            $tema    = $_POST['Тема'];
            $message = $_POST['Сообщение'];

            $all_clients = $wpdb->get_results("
                SELECT * 
                FROM {$table_clients}"
            );

            // $all_clients1 = array(
            //     'nikitos.0@list.ru',
            //     'nikitosspehin@gmail.com',
            //     'just-sergio-wear@yandex.ru',
            //     'nikita.spekhin@g2r.su');

            $all_clients_size = 0;
            $success_size = 0;
            $errors_size = 0;
            $errors = "";

            foreach($all_clients as $item):

                $all_clients_size++;
                if(wp_mail($item->email, $tema, $message)){
                    $success_size++;
                }else{
                    $errors_size++;
                    $errors .= "<p>E-mail: ".$item."</p>";
                }

            endforeach;

            echo "<br><br><p>Всего участeников: ".$all_clients_size."</p>";
            echo "<p>Успешных отправлений: ".$success_size."</p>";
            if($errors_size > 0){
                echo "<p>Ошибочные отправки: ".$errors_size."</p>";
                echo $errors;
            }
        break;

        case 'add_inquiries':
            $name    = $_POST['Имя'];
            $country = $_POST['Страна'];
            $contacts = $_POST['Контакты'];
            $zapros = $_POST['Запрос'];
            $category = $_POST['Категория'];

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                $sql = "CREATE TABLE IF NOT EXISTS {$table_inquiries} (
                    id int(11) unsigned NOT NULL auto_increment,
                    name varchar(255) NOT NULL default '',
                    country varchar(255) NOT NULL default '',
                    contacts text NOT NULL default '',
                    category varchar(255) NOT NULL default '',
                    zapros text NOT NULL default '',
                    PRIMARY KEY  (id)
                ) {$charset_collate};";

                // Создать таблицу.
                dbDelta( $sql );

                $wpdb->insert($table_inquiries, array(
                    'name' => $name,
                    'country' => $country,
                    'contacts' => $contacts,
                    'category' => $category,
                    'zapros' => $zapros
                ));
        break;

         case 'search_inquiries_in_profile':

            $search_country = $_POST['country_search_inquiries_by_select'];
            $search_country = '%' . $wpdb->esc_like( $search_country ) . '%';

            $search_category = $_POST['category_search_inquiries_by_select'];
            $search_category = '%' . $wpdb->esc_like( $search_category ) . '%';

            $where_search_text = '';
            if(isset($_POST['Поиск_запросов_в_базе'])){
                $search_text = $_POST['Поиск_запросов_в_базе'];
                $search_text = '%' . $wpdb->esc_like( $search_text ) . '%';
                if(!empty($search_text)){
                    $where_search_text = " AND (
                        `category`     like %s OR 
                        `country`      like %s OR 
                        `zapros`       like %s
                    )";
                }
            }

            $like_events_list = $wpdb->get_results($wpdb->prepare("
                SELECT *
                FROM {$table_inquiries}
                WHERE
                    `country` like %s AND
                    `category` like %s
                    $where_search_text
                    ",
                    $search_country,
                    $search_category,
                    $search_text,
                    $search_text,
                    $search_text
                ));?>

            <?php if(!empty( $like_events_list)):?>
                <?php foreach($like_events_list as $item):?>
                    <div class="my_events_block">
                        <p style="display: flex;justify-content: space-between;">
                            <span style="width: 80%">
                                <b><?=$item->category?></b>
                            </span>
                            <span>
                                <?=$item->country;?>
                            </span>
                        </p>
                        <p
                            class="event_title" 
                            style="word-break: break-all;
                                   margin-bottom: 10px">
                            <?=$item->zapros?>      
                        </p>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <h1>Ничего не найдено</h1>
            <?php endif;
        break;

        case 'change_inquiries_data':       
            $id       = $_POST['id_inquirie'];
            $name     = $_POST['Имя'];
            $country  = $_POST['Страна'];
            $contacts = $_POST['Контакты'];
            $zapros   = $_POST['Запрос'];
            $category = $_POST['Категория'];

            $wpdb->update($table_inquiries, array(
                'name' => $name,
                'country' => $country,
                'contacts' => $contacts,
                'zapros' => $zapros,
                'category' => $category),
                array(
                    'id' => $id
                )
            );
        break;

        case 'change_data_for_footer_forms_inquirie_form':

            $id_inquiries = $_POST['id_inquiries'];

            $this_inquiries = $wpdb->get_row( " SELECT * FROM {$table_inquiries} WHERE id = '$id_inquiries'");

            $inquiries_arr = array(
                'id' => $this_inquiries->id,
                'name' => $this_inquiries->name,
                'country' => $this_inquiries->country,
                'contacts' => $this_inquiries->contacts,
                'zapros' => $this_inquiries->zapros,
                'category' => $this_inquiries->category
            );
            echo json_encode($inquiries_arr);
        break;

        case 'delete_inquiries':
            $id_inquiries = $_POST['id_inquiries'];
            $wpdb->delete( $table_inquiries, array(
                'id' => $id_inquiries
            ));
        break;

        //Фильтр для экспертов
        case 'show_speakers_list':
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            $geography = $_POST['География'];
            $lang      = $_POST['Язык'];

            if(!$geography && !$lang){
                $wp_query = new WP_Query([
                    'post_type' => 'speaker',
                    'posts_per_page' => SPEAKERS_PER_PAGE,
                    'paged' => $paged,
                ]);
            }else{
                $wp_query = new WP_Query([
                    'post_type' => 'speaker',
                    'posts_per_page' => SPEAKERS_PER_PAGE,
                    'paged' => $paged,
                    'category__in' => $lang,
                    'meta_query' => array(
                        array(
                            'place' => array(
                                'key' => 'geography',
                                'value' => $geography,
                                'compare' => 'LIKE'
                            ),
                        )
                    ),
                ]);
            }

            if( have_posts() ) : ?>
                <div class="speaker_list be-ajax-loadmore-container">
                <?php 
                    while ( have_posts()) :
                        the_post();
                        get_template_part('parts/list_element', 'speaker'); 
                    endwhile; 
                ?>
                </div>
            <?php else:?>
                <div class="not-found">
                    Ничего не найдено
                </div>
            <?php endif;?> 
            <?php
            if($wp_query->max_num_pages > 1) : ?>
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
        <?php
        break;

        //Пригласить эксперта
        case 'invite-speakers':
            $fio = $_POST['ФИО'];
            $company = $_POST['Компания'];
            $email = $_POST['Почта'];
            $tel = $_POST['Телефон'];            
            $speakers = $_POST['Эксперты'];
            $budget = $_POST['Бюджет'];
            $participants = $_POST['Количество_участников'];
            $duration = $_POST['Длительность_выступления'];
            $location = $_POST['Место_проведения'];
            $comment = $_POST['Комментарий'];

            if(isset($_POST['Дата_мероприятия'])){
                $date_event = htmlentities($_POST['Дата_мероприятия']);
                $date_event = date('Y-m-d', strtotime($date_event));
            }

            $company = str_replace('\"','"',$company);

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            $sql = "CREATE TABLE {$table_invite_speakers} (
                id int(11) unsigned NOT NULL auto_increment,
                fio varchar(255) NOT NULL default '',
                company varchar(255) NOT NULL default '',
                email varchar(255) NOT NULL default '',
                tel varchar(255) NOT NULL default '',
                speakers text default '', -- Список экспертов
                budget varchar(255) NOT NULL default '', -- Бюджет
                date_event date NOT NULL default '0000-00-00', -- Дата мероприятия
                participants bigint(20) unsigned NOT NULL default '0', -- Количество участников
                duration varchar(255) NOT NULL default '',-- Длительность выступления экспертов
                location varchar(255) NOT NULL default '', -- Место проведения
                comment text default '', -- Комментарий
                PRIMARY KEY  (id)
            ) {$charset_collate};";

            // Создать таблицу.
            dbDelta( $sql );

            //Вставить в таблицу invite_speakers
            $wpdb->insert($table_invite_speakers, array(
                'fio' => $fio,
                'company' => $company,
                'email' => $email,
                'tel' => $tel,
                'speakers' => $speakers,
                'budget' => $budget,
                'date_event' => $date_event,
                'participants' => $participants,
                'duration' => $duration,
                'location' => $location,
                'comment' => $comment
            ));
            
        break;

        //Фильтр для материалов
        case 'filter_materials':
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            $country = $_POST['Страна'];
            $theme   = $_POST['Тема'];

            if(!$country && !$theme){
                $wp_query = new WP_Query([
                    'post_type' => 'material',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                ]);
            }elseif($country && !$theme){
                $wp_query = new WP_Query([
                    'post_type' => 'material',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    'category__in' => $country
                ]);
            }elseif(!$country && $theme){
                $wp_query = new WP_Query([
                    'post_type' => 'material',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    'category__in' => $theme
                ]);
            }elseif($country && $theme){
                $wp_query = new WP_Query([
                    'post_type' => 'material',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                    'category__and' => array($country,$theme),
                ]);
            }

            if (have_posts()): ?>
                <div class="usefulpage__container">
                    <?php while ( have_posts()): the_post(); ?>

                    <?php
                        $post_id  = get_the_ID();
                        //Проверка на наличие эксперта в избранном
                        $is_like_material = (is_like_material($post_id) ?  'active' : '');
                    ?>
                    
                    <a href="<?= get_permalink(); ?>" class="link-hover-down">
                        <?php
                            $image = get_post_image();
                            if ($image): ?>
                                <?php $url_img = $image['url'] ?>
                            <?php endif; ?>
                        <div class="useful__img" style="position: relative;">
                            <?php if(current_user_can('editor') || current_user_can('administrator')):?>
                                <div class="viewsCount_block">
                                    <p class='viewsCount_text'>Просмотров:<strong><?=pvc_get_post_views($post->ID)?></strong></p>
                                </div>
                            <?php endif;?>
                            <img src="<?=$url_img?>" alt="<?= $image['alt']; ?>">
                            <div class="useful__containerbg"></div>
                        </div>
                        <div class="useful__containerdate">
                            <?= get_the_date('j M Y'); ?>


                            <?php if(isAuth()):?>
                                <span class="star_img <?=$is_like_material?>" data-postid="<?=$post_id?>"></span>
                            <?php else:?>
                                <span class="star_img" data-typepost='like-material' data-postid="null"></span>
                            <?php endif;?>

                        </div>
                        <div class="useful__containertext">
                            <span class="underline-hover-link">
                                <?= get_the_title(); ?>
                            </span>
                        </div>
                    </a>
                    <?php endwhile; ?>

                    <?php if ($wp_query->max_num_pages > 1) :
                        pagination($wp_query->max_num_pages, 3); ?>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="not-found not-found-materials">
                    Ничего не найдено
                </div>
            <?php endif;?> 
        <?php
        break;


        
    }   
}
  
?>
