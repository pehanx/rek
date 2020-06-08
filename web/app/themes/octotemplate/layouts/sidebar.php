<?php 
 if(!(isAuth())){
        header("Location: https://russianexport.club/vstuplenie-v-klub/"); 
        exit; 
}
 get_header();
require_once 'wp/wp-load.php';
    global $wpdb;
    $table_clients = $wpdb->get_blog_prefix() . 'clients';
    // $table_sms = $wpdb->get_blog_prefix() . 'sms';
    // $table_forum = $wpdb->get_blog_prefix() . 'forum';
    // $table_forum_comments = $wpdb->get_blog_prefix() . 'forum_comments';
    $table_like_events = $wpdb->get_blog_prefix() . 'like_events';
    $table_posts = $wpdb->get_blog_prefix() . 'posts';
    $table_postmeta = $wpdb->get_blog_prefix() . 'postmeta';
    $table_sign_events = $wpdb->get_blog_prefix() . 'sign_events';
    $table_add_customers = $wpdb->get_blog_prefix() . 'add_customers';
    $table_inquiries = $wpdb->get_blog_prefix() . 'inquiries';

    $my_id = $_SESSION['user_id'];
    
    $my_user = $wpdb->get_row( " SELECT * FROM {$table_clients} WHERE id = '$my_id'");

    // if(isset($_POST["exit"])){
    //     setcookie("id","", time() - 3600, "/", "", 0);
    //     header("Location: http://rec.test/auth/"); 
    //     exit; 
    // }elseif(isset($_POST['up_photo'])) {
    //     $photo = $_FILES['photo']['name'];
    //     $wpdb->get_results("UPDATE {$table_clients} SET `avatar`= '$photo' WHERE `id` = '$my_id';");
    //     move_uploaded_file($_FILES['photo']['tmp_name'], dirname(__DIR__) . '/static/img/avatars/' . $photo);
    // }
     
        





?>
<section class="contact">
    <div class="contact__bg"></div>
    <div class="contact__wrapp1" style="position: relative; margin: 0 auto; align-items: center; display: flex; flex-direction: column; ">
        <div class="profile_view">
            <div class="show_left_sidebar_btn">
                  <svg class="icon__up" width="20px" height="24px">
                    <use xlink:href="#show_sidebar_profile"></use>
                </svg> 
            </div>
            <div class="left_sidebar">
                <div class="close_left_sidebar_btn">
                      <svg class="icon__up" width="20px" height="24px">
                        <use xlink:href="#clousemenu"></use>
                    </svg> 
                </div>
                <div class="my-avatar">
                    <?php $src = wp_get_attachment_url( $my_user->avatar ); ?>
                    <img class="avatar-img" src="<?=$src?>">
                    <div class="change_avatar">
                        <span class="change_avatar_text">Изменить</span>
                    </div>
                </div>
                <p class="data_text">
                    <?=$my_user->surname?> <?=$my_user->name?> <?=$my_user->patronymic?> 
                </p>
            </div>
            <div class="navigation">
                <ul>
                    <li><a href="/profile/">Мой кабинет</a></li>
                   <!--  <li><a href="/sms">Сообщения </a></li>
                    <li><a href="/forum">Форум</a></li>
                    <li><a href="/people">Участники</a></li> -->
                </ul>
            </div>
