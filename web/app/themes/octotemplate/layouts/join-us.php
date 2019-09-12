<?php
/*
 * Template Name: Вступить
 *
 * Template Post Type: page
 *
 * The template for displaying Registration page
 *
 * @package wptemplate
 *
 */
if(isset($_COOKIE['id'])){
    header("Location: http://".$_SERVER['SERVER_NAME']."/404"); 
    exit; 
}

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
            <form  method="post" id="reg_send" class="hide_form">
                <div class="contact__blocktitle">
                    Регистрация
                </div>
                <?php
                $name_placeholder = get_field('name_placeholder');
                $phone_number_placeholder = get_field('phone_number_placeholder');
                $email_placeholder = get_field('email_placeholder');
                $entity_placeholder = get_field('entity_placeholder');
                $region_placeholder = get_field('region_placeholder');
                $domain_placeholder = get_field('domain_placeholder');
                $login_placeholder = get_field('login_placeholder');
                $password_placeholder = get_field('password_placeholder');
                $password_confirm_placeholder = get_field('password_confirm_placeholder');
                $submit_button_text = get_field('submit_button_text');
                ?>

                <?php if ($name_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-name" type="text" name="ФИО">
                        <span><?= $name_placeholder; ?></span>
                        <p class="info"><?= get_field('name_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($phone_number_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-tel mask-for-input" type="text" name="Телефон">
                        <span><?= $phone_number_placeholder; ?></span>
                        <p class="info"><?= get_field('phone_number_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($email_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-email" type="text" name="Почта">
                        <span><?= $email_placeholder; ?></span>
                        <p class="info"><?= get_field('email_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($entity_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-company" type="text" name="Юридическое_лицо">
                        <span><?= $entity_placeholder; ?></span>
                        <p class="info"><?= get_field('entity_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($region_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup" type="text" name="Регион">
                        <span><?= $region_placeholder; ?></span>
                        <p class="info"><?= get_field('region_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($domain_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup" type="text" name="Направление">
                        <span><?= $domain_placeholder; ?></span>
                        <p class="info"><?= get_field('domain_description'); ?></p>
                    </label>
                <?php endif; ?>
				
                <label class="placeholder">
                    <select name="Тип_участника" id="typeParty" class="input textup select">
                       <option value="">Выберите тип участия в клубе</option>
                       <option value="Экспортёр – получает ценные знания и информацию по осуществлению экспортной деятельности">Экспортёр</option>
                       <option value="Партнер - совместная организация мероприятий, общение с экспортерами">Партнёр</option>
                       <option value="Спикер - получает аудиторию, популярность">Спикер</option>
                       <option value="Инвестор – получает потенциальных клиентов среди экспортеров, консультационную поддержку экспертов">Инвестор</option>                    
                    </select>
                    <p class="info" id="infoTypeParty"></p>
                </label>  
				<input type="hidden" value="participation" name="type">

                <?php if ($login_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-login" type="text" name="Логин">
                        <span><?= $login_placeholder; ?></span>
                        <p class="info"><?= get_field('login_description'); ?></p>
                    </label>
                <?php endif;?>

                <?php if ($password_placeholder): ?>
                    <label class="placeholder">
                        <input class="input input-forpass textup passwordone input-password" type="password" name="Пароль">
                        <span><?= $password_placeholder; ?></span>
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
                        <p class="info"><?= get_field('password_description'); ?></p>
                    </label>
                <?php endif;?>

                <?php if ($password_confirm_placeholder): ?>
                    <label class="placeholder">
                        <input class="input input-forpass textup passwordtwo input-passwordtoo" type="password" name="Подтверждение пароля">
                        <span><?= $password_confirm_placeholder; ?></span>
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
                        <p class="succes"><?= get_field('password_confirm_description'); ?></p>
                    </label>
                <?php endif;?>

                <?php if ($submit_button_text): ?>
                    <button class="submit"><?= $submit_button_text; ?></button>
                <?php endif; ?>
                <span id="show_auth" style="margin-top: 20px; font-size: 18px; cursor: pointer;">Войти</span>
                </form>
                
                
                <!-- <form action="/mail.php" method="post" class="reg reg__form" style=""> -->
                <form  method="post" id="auth_send">
                <div class="contact__blocktitle">
                    Вход
                </div>
                <?php
                $name_placeholder = get_field('name_placeholder');
                $phone_number_placeholder = get_field('phone_number_placeholder');
                $email_placeholder = get_field('email_placeholder');
                $entity_placeholder = get_field('entity_placeholder');
                $region_placeholder = get_field('region_placeholder');
                $domain_placeholder = get_field('domain_placeholder');
                $login_placeholder = get_field('login_placeholder');
                $password_placeholder = get_field('password_placeholder');
                $password_confirm_placeholder = get_field('password_confirm_placeholder');
                $submit_button_text = get_field('submit_button_text');
                ?>

                <input type="hidden" value="participation" name="type">

                <?php if ($login_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-login" type="text" name="Логин">
                        <span>Логин</span>
                        <!-- <span><?= $login_placeholder; ?></span> -->
                        <!-- <p class="info"><?= get_field('login_description'); ?></p> -->
                    </label>
                <?php endif;?>

                <?php if ($password_placeholder): ?>
                    <label class="placeholder">
                        <input class="input input-forpass textup passwordone input-password" type="password" name="Пароль">
                        <span>Пароль</span>
                        <!-- <span><?= $password_placeholder; ?></span> -->
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
                        <!-- <p class="info"><?= get_field('password_description'); ?></p> -->
                    </label>
                <?php endif;?>

                <?php if ($submit_button_text): ?>
                    <!-- <button class="submit"><?= $submit_button_text; ?></button> -->
                    <button class="submit">Войти</button>
                <?php endif; ?>
                <span id="show_reg" style="margin-top: 20px; font-size: 18px; cursor: pointer;">Регистрация</span>
                </form>
        </div>
    </div>
</section>

<?php
get_footer();