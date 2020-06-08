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
get_header();
if(isAuth()):?>
    <script type="text/javascript">
        window.location.assign("http://"+document.location.host);
    </script>
<?php endif;

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
                $surname_placeholder = get_field('surname_placeholder');
                $name_placeholder = get_field('name_placeholder');
                $patronymic_placeholder = get_field('patronymic_placeholder');
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
                <?php if ($surname_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-surname" type="text" name="Фамилия" id="surname_reg">
                        <span><?= $surname_placeholder; ?></span>
                        <p class="info"><?= get_field('surname_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($name_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-name" type="text" name="Имя" id="name_reg">
                        <span><?= $name_placeholder; ?></span>
                        <p class="info"><?= get_field('name_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($patronymic_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-patronymic" type="text" name="Отчество" id="patronymic_reg">
                        <span><?= $patronymic_placeholder; ?></span>
                        <p class="info"><?= get_field('patronymic_description'); ?></p>
                    </label>
                <?php endif; ?>

                <label class="placeholder">
                    <select name="Тип_участника" id="typeParty" class="input textup select input-typeParty">
                       <option value="">Выберите тип участия в клубе</option>
                       <option value="Экспортёр – получает ценные знания и информацию по осуществлению экспортной деятельности">Экспортёр</option>
                       <option value="Партнер - совместная организация мероприятий, общение с экспортерами">Партнёр</option>
                       <option value="Спикер - получает аудиторию, популярность">Спикер</option>
                       <option value="Инвестор – получает потенциальных клиентов среди экспортеров, консультационную поддержку экспертов">Инвестор</option>    
                       <option value="Покупатель – импортер не из Российской Федерации">Покупатель</option>                  
                    </select>
                    <p class="info" id="infoTypeParty"></p>
                </label>  
				
				<label class="placeholder" style="display: none;">
                    <input class="input textup input-what_buy" type="text" name="ХочуКупить" id="buy_reg" >
                    <span>Что хотите купить*</span>
                    <p class="info">Введите товары, которые вы хотите купить</p>
                </label>

                <?php if ($phone_number_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-tel mask-for-input" type="text" name="Телефон" id="tel_reg">
                        <span><?= $phone_number_placeholder; ?></span>
                        <p class="info"><?= get_field('phone_number_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($email_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-email" type="text" name="Почта" id="email_reg">
                        <span><?= $email_placeholder; ?></span>
                        <p class="info"><?= get_field('email_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($entity_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-company" type="text" name="Юридическое_лицо" id="company_reg">
                        <span><?= $entity_placeholder; ?></span>
                        <p class="info"><?= get_field('entity_description'); ?></p>
                    </label>
                <?php endif; ?>

                <label class="placeholder" style="display: none;">
                    <input class="input textup input-country" type="text" name="Страна" id="country_reg">
                    <span>Страна</span>
                    <p class="info">Введите название вашей страны</p>
                </label>

                <?php if ($region_placeholder): ?>
                    <label class="placeholder">
                        <select name="Регион" id="region_reg" class="input textup select input-region">
                           <option value=''>Выберите Ваш регион*</option>
                            <option>Челябинская область</option>
                            <option>Республика Башкортостан</option>
                            <option>Республика Адыгея (Адыгея)</option>
                            <option>Республика Бурятия</option>
                            <option>Республика Алтай</option>
                            <option>Республика Дагестан</option>
                            <option>Республика Ингушетия</option>
                            <option>Кабардино-Балкарская Республика</option>
                            <option>Республика Калмыкия</option>
                            <option>Карачаево-Черкесская Республика</option>
                            <option>Республика Казахстан</option>
                            <option>Республика Карелия</option>
                            <option>Республика Коми</option>
                            <option>Республика Марий Эл</option>
                            <option>Республика Мордовия</option>
                            <option>Республика Саха (Якутия)</option>
                            <option>Республика Северная Осетия - Алания</option>
                            <option>Республика Татарстан (Татарстан)</option>
                            <option>Республика Тыва</option>
                            <option>Удмуртская Республика</option>
                            <option>Республика Хакасия</option>
                            <option>Чеченская Республика</option>
                            <option>Чувашская Республика - Чувашия</option>
                            <option>Алтайский край</option>
                            <option>Краснодарский край</option>
                            <option>Красноярский край</option>
                            <option>Приморский край</option>
                            <option>Ставропольский край</option>
                            <option>Хабаровский край</option>
                            <option>Амурская область</option>
                            <option>Архангельская область</option>
                            <option>Астраханская область</option>
                            <option>Белгородская область</option>
                            <option>Брянская область</option>
                            <option>Владимирская область</option>
                            <option>Волгоградская область</option>
                            <option>Вологодская область</option>
                            <option>Воронежская область</option>
                            <option>Ивановская область</option>
                            <option>Иркутская область</option>
                            <option>Калининградская область</option>
                            <option>Калужская область</option>
                            <option>Камчатский край</option>
                            <option>Кемеровская область</option>
                            <option>Кировская область</option>
                            <option>Костромская область</option>
                            <option>Курганская область</option>
                            <option>Курская область</option>
                            <option>Ленинградская область</option>
                            <option>Липецкая область</option>
                            <option>Магаданская область</option>
                            <option>Московская область</option>
                            <option>Мурманская область</option>
                            <option>Нижегородская область</option>
                            <option>Новгородская область</option>
                            <option>Новосибирская область</option>
                            <option>Омская область</option>
                            <option>Оренбургская область</option>
                            <option>Орловская область</option>
                            <option>Пензенская область</option>
                            <option>Пермский край</option>
                            <option>Псковская область</option>
                            <option>Ростовская область</option>
                            <option>Рязанская область</option>
                            <option>Самарская область</option>
                            <option>Саратовская область</option>
                            <option>Сахалинская область</option>
                            <option>Свердловская область</option>
                            <option>Смоленская область</option>
                            <option>Тамбовская область</option>
                            <option>Тверская область</option>
                            <option>Томская область</option>
                            <option>Тульская область</option>
                            <option>Тюменская область</option>
                            <option>Ульяновская область</option>
                            <option>Забайкальский край</option>
                            <option>Ярославская область</option>
                            <option>Москва</option>
                            <option>Санкт-Петербург</option>
                            <option>Еврейская автономная область</option>
                            <option>Ненецкий автономный округ</option>
                            <option>Ханты-Мансийский автономный округ - Югра</option>
                            <option>Чукотский автономный округ</option>
                            <option>Ямало-Ненецкий автономный округ</option>
                            <option>Республика Крым</option>
                            <option>Севастополь</option>                     
                        </select>
                        <p class="info"><?= get_field('region_description'); ?></p>
                    </label>
                <?php endif; ?>

                <?php if ($domain_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-sphere" type="text" name="Направление" id="sphere_reg">
                        <span><?= $domain_placeholder; ?></span>
                        <p class="info"><?= get_field('domain_description'); ?></p>
                    </label>
                <?php endif; ?>
               
                <input type="hidden" value="participation" name="type">
                
                <?php if ($login_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-login" type="text" name="Логин" id="login_reg">
                        <span><?= $login_placeholder; ?></span>
                        <p class="info"><?= get_field('login_description'); ?></p>
                    </label>
                <?php endif;?>

                <?php if ($password_placeholder): ?>
                    <label class="placeholder">
                        <input class="input input-forpass textup passwordone input-password" type="password" name="Пароль" id="pass_reg">
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
                    <!-- <button class="submit"><?= $submit_button_text; ?></button> -->
                    <button class="submit">Зарегистрироваться</button>
                <?php endif; ?>
                <span id="show_auth">Войти</span>
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
                        <span>Логин или e-mail</span>
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

                <span id="show_reg">Регистрация</span>
                <span class="forgot_pass_btn">Забыли пароль?</span>
                </form>
        </div>
    </div>
</section>

<?php
get_footer();