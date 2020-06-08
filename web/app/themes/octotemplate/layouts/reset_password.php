<?php
    if(isset($_GET['token']) && !empty($_GET['token']) && isset($_GET['email']) && !empty($_GET['email'])){
        $token = $_GET['token'];
        $email = $_GET['email'];
        require_once 'wp/wp-load.php';
        global $wpdb;
        $check_token_email = $wpdb->get_row( " SELECT * FROM wp_clients WHERE reset_password_token = '$token' AND email = '$email'");

        if(empty($check_token_email) && $token !=  $check_token_email['reset_password_token']){
            header("Location: https://russianexport.club"); 
            exit; 
        }
    }else{
        header("Location: https://russianexport.club"); 
        exit;  
    }
    
/*
 * Template Name: Сброс пароля
 *
 * Template Post Type: page
 *
 * The template for displaying Registration page
 *
 * @package wptemplate
 *
 */
get_header();

?>
<section class="contact">
    <div class="contact__bg"></div>
    <div class="contact__title">
        <?= get_the_title(); ?>
    </div>
    <div class="contact__wrapp">
        <div class="contact__block">
            
            <!-- <form action="/mail.php" method="post" class="reg reg__form"> -->
            <form method="post" id="forgotpass_form">
                    <label class="placeholder">
                        <input class="input input-forpass textup passwordone input-password" type="password" name="Пароль" id="pass_reg">
                        <span>Пароль</span>
                        <div class="eye">
                            <svg class="icon__eyepass" width="20px" height="20px">
                                <use xlink:href="#eyepass"></use>
                            </svg>
                        </div>
                        <div class="eyenot eye_active">
                            <svg class="icon__eyepassnot" width="20px" height="20px">
                                <use xlink:href="#eyepassnot"></use>
                            </svg>
                        </div>
                        <p class="info">Не короче 8 букв и цифр. Только латинские буквы.</p>
                    </label>
                    <input type="hidden" name="token" value="<?=$token?>">
                    <input type="hidden" name="email" value="<?=$email?>">
                    <label class="placeholder">
                        <input class="input input-forpass textup passwordtwo input-passwordtoo" type="password" name="Подтверждение пароля">
                        <span>Подтверждение пароля</span>
                        <div class="eye">
                            <svg class="icon__eyepass" width="20px" height="20px">
                                <use xlink:href="#eyepass"></use>
                            </svg>
                        </div>
                        <div class="eyenot eye_active">
                            <svg class="icon__eyepassnot" width="20px" height="20px">
                                <use xlink:href="#eyepassnot"></use>
                            </svg>
                        </div>
                        <p class="succes">Пароли совпадают</p>
                    </label>
                    <button class="submit">Отправить</button>
                </form>
        </div>
    </div>
</section>

<?php
get_footer();