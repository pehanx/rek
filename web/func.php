<?php
require_once 'wp/wp-load.php';
    global $wpdb;
    session_start();


    // if(isset($_COOKIE['user_id'])){
    //     $my_id = $_COOKIE['user_id'];
    // }
    

    $table_clients = $wpdb->get_blog_prefix() . 'clients';
    // $table_clients = $wpdb->get_blog_prefix() . 'clients';
    // $table_sms = $wpdb->get_blog_prefix() . 'sms';
    // $table_forum = $wpdb->get_blog_prefix() . 'forum';
    // $table_forum_comments = $wpdb->get_blog_prefix() . 'forum_comments';
    // $table_like_events = $wpdb->get_blog_prefix() . 'like_events';
    // $table_posts = $wpdb->get_blog_prefix() . 'posts';
    // $table_postmeta = $wpdb->get_blog_prefix() . 'postmeta';
    // $table_sign_events = $wpdb->get_blog_prefix() . 'sign_events';

    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

if(isset($_GET['func'])){
    switch ($_GET['func']) 
    {

        //Регистрация
        case 'register':
            $fio = $_POST['ФИО'];
            $tel = $_POST['Телефон'];
            $email = $_POST['Почта'];
            $company = $_POST['Юридическое_лицо'];
            $region = $_POST['Регион'];
            $sphere = $_POST['Направление'];
            $typeParty = $_POST['Тип_участника'];
            $login = $_POST['Логин'];
            $pass = $_POST['Пароль'];

            $words_typeParty = explode(" ", $typeParty);
            $typeParty = $words_typeParty[0];

            $pass = password_hash($pass, PASSWORD_DEFAULT);

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            $sql = "CREATE TABLE {$table_clients} (
                id int(11) unsigned NOT NULL auto_increment,
                fio varchar(255) NOT NULL default '',
                tel varchar(255) NOT NULL default '',
                email varchar(255) NOT NULL default '',
                company varchar(255) NOT NULL default '',
                region varchar(255) default '',
                sphere varchar(255) default '',
                typeParty varchar(255) default '',
                login varchar(255) NOT NULL default '',
                pass varchar(255) NOT NULL default '',
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
                //Вставить в таблицу
                $wpdb->insert($table_clients, array(
                'fio' => $fio,
                'tel' => $tel,
                'email' => $email,
                'company' => $company,
                'region' => $region,
                'sphere' => $sphere,
                'typeParty' => $typeParty,
                'login' => $login,
                'pass' => $pass
                ));

                //Отправить на почту

            }
        break;

        //Авторизация
        case 'authorization':
            $login = $_POST['Логин'];
            $pass = $_POST['Пароль'];
            require_once 'wp/wp-load.php';
            global $wpdb;

            //Проверка на существование пользователя
            $check_login_pass = $wpdb->get_row( " SELECT * FROM {$table_clients} WHERE login = '$login'");

            if(empty($check_login_pass)){
                echo "Вы неправильно ввели логин или пароль";
            }else{
                if (password_verify($pass, $check_login_pass->pass)){
                    $_SESSION["user_id"] = $check_login_pass->id; 
                }else{
                   echo "Вы неправильно ввели логин или пароль"; 
                }
                
            }
        break;

        //Выход из сайта
        case 'exit_from_site':
            // setcookie("user_id","", time() - (86400 * 30), "/", "", 0);
            unset($_SESSION["user_id"]);
            setcookie("event_link","", time() - (1800), "/", "", 0);
        break;

        //Фильтр для событий
        case 'show_events_list':

            $place = $_POST['Местоположение'];

            if(isset($_POST['show_events_type'])){
                $type_event_array = $_POST['show_events_type'];
            }else{
                if(!empty($place)){
                    $type_event_array = array(23,25,27,29,31);
                }else{
                    break;
                }
            }
                $wp_query = new WP_Query([
                    'post_type' => 'event',
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
                        'date'       => 'ASC',
                    )
                ]);

                if( have_posts() ) : ?>
                    <div class="news__container" style="margin-top: 70px">
                    <?php 
                        while ( have_posts()) :
                            the_post();
                            event_list_by_place();
                        endwhile; 
                    ?>
                    </div>
                <?php endif;?> 
        <?php
        break;

        //Фильтр для прошедших событий
        case 'show_past_events_list':
            $place_past = $_POST['Местоположение'];

            if(isset($_POST['show_events_type'])){
                $type_event_array = $_POST['show_events_type'];
            }else{
                if(!empty($place_past)){
                    $type_event_array = array(23,25,27,29,31);
                }else{
                    break;
                }
            }

                $wp_query = new WP_Query([
                    'post_type' => 'event',
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
                        ),
                    )
                ),
                    'orderby' => array(
                        'date'       => 'ASC',
                    )
                ]);

                if( have_posts() ) : ?>
                    <div class="news__container" style="margin-top: 70px">
                    <?php 
                        while ( have_posts()) :
                            the_post();
                            event_list_by_place();
                        endwhile; 
                    ?>
                    </div>
                <?php endif;?> 
        <?php
        break;

        //Установка cookie для перехода к событию после авторизацию
        case 'set_event_link':
            $event_link_to = $_POST['event_link_to'];
            setcookie("event_link", $event_link_to, time() + (1800), "/"); 
            $host = $_POST['host'];
            echo "http:/".$host."/vstuplenie-v-klub/";
        break;

        //Проверка зарегистрирован ли пользователь при нажатии на кнопку "Вступить в клуб"
        case 'check_auth':
            if(isAuth())
            {
                echo "Вы уже вступили в клуб";
            }
            break;
  
    }   
}
  
?>

<?php 
//functions
function event_list_by_place(){
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
            // $image = get_post_image(get_queried_object_id());
            $image = get_post_image();
            if ($image): ?>
                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
            <?php endif; ?>
            <div class="news__img__bg"></div>
        </div>
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
<?php
}
?>
