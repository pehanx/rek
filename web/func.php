<?php
require_once 'wp/wp-load.php';
    global $wpdb;

    if(isset($_COOKIE['id'])){
        $my_id = $_COOKIE['id'];
    }
    

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
            // $company = $_POST['Компания'];
            $company = $_POST['Юридическое_лицо'];
            // $job = $_POST['Должность'];
            $region = $_POST['Регион'];
            $sphere = $_POST['Направление'];
            $typeParty = $_POST['Тип_участника'];
            $login = $_POST['Логин'];
            $pass = $_POST['Пароль'];

            require_once 'wp/wp-load.php';
            global $wpdb;
            $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

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
            }elseif(!empty($check_email)){
                echo "Пользователь с такой почтой уже зарегистрирован";
            }else{
                // Вставить в таблицу
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
            }
        break;

        //Авторизация
        case 'authorization':
            $login = $_POST['Логин'];
            $pass = $_POST['Пароль'];
            require_once 'wp/wp-load.php';
            global $wpdb;

            //Проверка на существование пользователя
            $check_login_pass = $wpdb->get_row( " SELECT * FROM {$table_clients} WHERE login = '$login' AND pass = '$pass'");

            if(empty($check_login_pass)){
                echo "Вы неправильно ввели логин или пароль";
            }else{
                setcookie("id", $check_login_pass->id, time()+3600*30, "/"); 
            }

        break;

        //Выход из сайта
        case 'exit_from_site':

            setcookie("id","", time() - 3600, "/", "", 0);
            header("Location: http://rec.test/auth/"); 
            break;
    }   
}
  
?>
