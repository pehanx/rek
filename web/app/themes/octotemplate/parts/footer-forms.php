<?php 
 if(isAuth()){
    require_once 'wp/wp-load.php';
    global $wpdb;
    $my_id = $_SESSION['user_id'];
    
    $my_user = $wpdb->get_row( " SELECT * FROM wp_clients WHERE id = '$my_id'");
 }

?>
<div class="formbg" id="uploadavatarbg">
    <div class="formup" id="uploadavatar">
        <div class="contact__wrapp">
            <div class="contact__block">
                <div class="contact__blocktitle">
                    <?= pll__('Изменить фото'); ?>
                </div>
                <style>
                    .fl_upld{text-align: center;}
                    #my_image_upload{display:none;}
                    .fl_upld label{
                        width: auto;
                        margin: 0;
                        color: #fff;
                        text-align: center;
                        
                    }
                    .fl_upld label:hover{
                        background:#fff;
                        color: #3465E2;
                    }
                    #fl_nm{
                       margin: 10px 0 20px 0;
                       font-size: 15px; 
                    }
                    #submit_my_image_upload{
                        display: none;
                        margin:0;
                    }
                </style>
                <form id="featured_upload" method="post"  enctype="multipart/form-data">
                    <div class="fl_upld">
                        <label class="btn_blue" style="width: auto;margin: 0">
                            <input class="upload_file" type="file" name="my_image_upload" id="my_image_upload"  accept="image/*"/>
                            Выберите файл
                        </label>
                    </div>
                    <input type="hidden" name="post_id" id="post_id" value="55" />
                    <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
                    <div id="fl_nm">Файл не выбран</div>
                    <input class="btn_blue" id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Загрузить" />
                </form>
            </div>
        </div>
    </div>
</div>
<?php

// Check that the nonce is valid, and the user can edit this post.
if ( 
    isset( $_POST['my_image_upload_nonce'], $_POST['post_id'] ) 
    && wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
    && current_user_can( 'edit_post', $_POST['post_id'] )
) {
    // The nonce was valid and the user has the capabilities, it is safe to continue.

    // These files need to be included as dependencies when on the front end.
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    
    // Let WordPress handle the upload.
    // Remember, 'my_image_upload' is the name of our file input in our form above.
    $attachment_id = media_handle_upload( 'my_image_upload', $_POST['post_id'] );
    
    if ( is_wp_error( $attachment_id ) ) {
        // There was an error uploading the image.
    } else {
        // The image was uploaded successfully!
        update_avatar($attachment_id);
         echo "
        <script>
            window.location = window.location.href;
        </script>

        ";
    }

} else {

    // The security check failed, maybe show the user an error.
}

function update_avatar($id_avatar)
{
    require_once 'wp/wp-load.php';
    global $wpdb;
    
    $my_id = $_SESSION['user_id'];
    $table_clients = $wpdb->get_blog_prefix() . 'clients';
    $wpdb->update($table_clients,
                array(
                    'avatar' => $id_avatar
                ), 
                array(
                    'id' => $my_id
                )
    );
}
?>
<!-- Форма восстановления пароля -->
<div class="formbg" id="forgotpassbg">
    <div class="formup" id="forgotpass">
        <div class="contact__wrapp">
            <div class="contact__block">
                <div class="contact__blocktitle">
                    <?= pll__('Забыли пароль?'); ?>
                </div>
                <p class="form_text">Напишите Вашу электронную почту, и мы вышлем ссылку для восстановления пароля Вам на почту</p>
                <form action="/mail.php" method="post" id="forgotpass_form_mail">
                    <label class="placeholder">
                        <input class="input textup input-email" type="text" name="Почта">
                        <span>E-mail</span>
                        <p class="info"><?= get_field('email_description'); ?></p>
                    </label>
                    <input type="hidden" value="forgotpass" name="type">
                    <button class="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Форма изменения личных данных -->
<div class="formbg" id="changemydatabg">
    <div class="formup" id="changemydata">
        <div class="contact__wrapp">
            <div class="contact__block">
                <div class="contact__blocktitle">
                    <?= pll__('Изменение данных'); ?>
                </div>
                 <form class="change_mydata_form">

                    <label class="placeholder">
                        <input class="input textup input-surname" type="text" name="Фамилия" value="<?=$my_user->surname?>">
                        <span>Фамилия</span>
                    </label>

                    <label class="placeholder">
                        <input class="input textup input-name" type="text" name="Имя" value="<?=$my_user->name?>">
                        <span>Имя</span>
                    </label>

                    <label class="placeholder">
                        <input class="input textup input-patronymic" type="text" name="Отчество" value="<?=$my_user->patronymic?>">
                        <span>Отчество</span>
                    </label>
       
                    <label class="placeholder">
                        <input class="input textup input-tel mask-for-input" type="text" name="Телефон" value="<?=$my_user->tel?>">
                        <span>Телефон</span>
                    </label>           
                    <label class="placeholder">
                        <input class="input textup input-company" type="text" name="Юридическое_лицо" value="<?=$my_user->company?>">
                        <span>Юридическое лицо</span>
                    </label>    
                     <?php if ($my_user->region == 1 ) echo 'selected' ; ?>
                    <label class="placeholder">
                        <select name="Регион" id="region_reg" class="input textup select input-region">
                           <option value=''>Выберите Ваш регион</option>
                            <option <?php if ($my_user->region == "Челябинская область" ) echo 'selected' ; ?>  >Челябинская область</option >
                            <option <?php if ($my_user->region == "Республика" ) echo 'selected' ; ?>  >Республика Башкортостан</option>
                            <option <?php if ($my_user->region == "Республика Адыгея (Адыгея)" ) echo 'selected' ; ?>  >Республика Адыгея (Адыгея)</option>
                            <option <?php if ($my_user->region == "Республика Бурятия" ) echo 'selected' ; ?>  >Республика Бурятия</option>
                            <option <?php if ($my_user->region == "Республика Алтай" ) echo 'selected' ; ?>  >Республика Алтай</option>
                            <option <?php if ($my_user->region == "Республика Дагестан" ) echo 'selected' ; ?>  >Республика Дагестан</option>
                            <option <?php if ($my_user->region == "Республика Ингушетия" ) echo 'selected' ; ?>  >Республика Ингушетия</option>
                            <option <?php if ($my_user->region == "Кабардино-Балкарская Республика" ) echo 'selected' ; ?>  >Кабардино-Балкарская Республика</option>
                            <option <?php if ($my_user->region == "Республика Калмыкия" ) echo 'selected' ; ?>  >Республика Калмыкия</option>
                            <option <?php if ($my_user->region == "Карачаево-Черкесская Республика" ) echo 'selected' ; ?>  >Карачаево-Черкесская Республика</option>
                            <option <?php if ($my_user->region == "Республика Казахстан" ) echo 'selected' ; ?>  >Республика Казахстан</option>
                            <option <?php if ($my_user->region == "Республика Карелия" ) echo 'selected' ; ?>  >Республика Карелия</option>
                            <option <?php if ($my_user->region == "Республика Коми" ) echo 'selected' ; ?>  >Республика Коми</option>
                            <option <?php if ($my_user->region == "Республика Марий" ) echo 'selected' ; ?>  >Республика Марий Эл</option>
                            <option <?php if ($my_user->region == "Республика Мордовия" ) echo 'selected' ; ?>  >Республика Мордовия</option>
                            <option <?php if ($my_user->region == "Республика Саха" ) echo 'selected' ; ?>  >Республика Саха (Якутия)</option>
                            <option <?php if ($my_user->region == "Республика Северная" ) echo 'selected' ; ?>  >Республика Северная Осетия - Алания</option>
                            <option <?php if ($my_user->region == "Республика Татарстан" ) echo 'selected' ; ?>  >Республика Татарстан (Татарстан)</option>
                            <option <?php if ($my_user->region == "Республика Тыва" ) echo 'selected' ; ?>  >Республика Тыва</option>
                            <option <?php if ($my_user->region == "Удмуртская Республика" ) echo 'selected' ; ?>  >Удмуртская Республика</option>
                            <option <?php if ($my_user->region == "Республика Хакасия" ) echo 'selected' ; ?>  >Республика Хакасия</option>
                            <option <?php if ($my_user->region == "Чеченская Республика" ) echo 'selected' ; ?>  >Чеченская Республика</option>
                            <option <?php if ($my_user->region == "Чувашская Республика - Чувашия" ) echo 'selected' ; ?>  >Чувашская Республика - Чувашия</option>
                            <option <?php if ($my_user->region == "Алтайский край" ) echo 'selected' ; ?>  >Алтайский край</option>
                            <option <?php if ($my_user->region == "Краснодарский край" ) echo 'selected' ; ?>  >Краснодарский край</option>
                            <option <?php if ($my_user->region == "Красноярский край" ) echo 'selected' ; ?>  >Красноярский край</option>
                            <option <?php if ($my_user->region == "Приморский край" ) echo 'selected' ; ?>  >Приморский край</option>
                            <option <?php if ($my_user->region == "Ставропольский край" ) echo 'selected' ; ?>  >Ставропольский край</option>
                            <option <?php if ($my_user->region == "Хабаровский край" ) echo 'selected' ; ?>  >Хабаровский край</option>
                            <option <?php if ($my_user->region == "Амурская область" ) echo 'selected' ; ?>  >Амурская область</option>
                            <option <?php if ($my_user->region == "Архангельская область" ) echo 'selected' ; ?>  >Архангельская область</option>
                            <option <?php if ($my_user->region == "Астраханская область" ) echo 'selected' ; ?>  >Астраханская область</option>
                            <option <?php if ($my_user->region == "Белгородская область" ) echo 'selected' ; ?>  >Белгородская область</option>
                            <option <?php if ($my_user->region == "Брянская область" ) echo 'selected' ; ?>  >Брянская область</option>
                            <option <?php if ($my_user->region == "Владимирская область" ) echo 'selected' ; ?>  >Владимирская область</option>
                            <option <?php if ($my_user->region == "Волгоградская область" ) echo 'selected' ; ?>  >Волгоградская область</option>
                            <option <?php if ($my_user->region == "Вологодская область" ) echo 'selected' ; ?>  >Вологодская область</option>
                            <option <?php if ($my_user->region == "Воронежская область" ) echo 'selected' ; ?>  >Воронежская область</option>
                            <option <?php if ($my_user->region == "Ивановская область" ) echo 'selected' ; ?>  >Ивановская область</option>
                            <option <?php if ($my_user->region == "Иркутская область" ) echo 'selected' ; ?>  >Иркутская область</option>
                            <option <?php if ($my_user->region == "Калининградская область" ) echo 'selected' ; ?>  >Калининградская область</option>
                            <option <?php if ($my_user->region == "Калужская область" ) echo 'selected' ; ?>  >Калужская область</option>
                            <option <?php if ($my_user->region == "Камчатский край" ) echo 'selected' ; ?>  >Камчатский край</option>
                            <option <?php if ($my_user->region == "Кемеровская область" ) echo 'selected' ; ?>  >Кемеровская область</option>
                            <option <?php if ($my_user->region == "Кировская область" ) echo 'selected' ; ?>  >Кировская область</option>
                            <option <?php if ($my_user->region == "Костромская область" ) echo 'selected' ; ?>  >Костромская область</option>
                            <option <?php if ($my_user->region == "Курганская область" ) echo 'selected' ; ?>  >Курганская область</option>
                            <option <?php if ($my_user->region == "Курская область" ) echo 'selected' ; ?>  >Курская область</option>
                            <option <?php if ($my_user->region == "Ленинградская область" ) echo 'selected' ; ?>  >Ленинградская область</option>
                            <option <?php if ($my_user->region == "Липецкая область" ) echo 'selected' ; ?>  >Липецкая область</option>
                            <option <?php if ($my_user->region == "Магаданская область" ) echo 'selected' ; ?>  >Магаданская область</option>
                            <option <?php if ($my_user->region == "Московская область" ) echo 'selected' ; ?>  >Московская область</option>
                            <option <?php if ($my_user->region == "Мурманская область" ) echo 'selected' ; ?>  >Мурманская область</option>
                            <option <?php if ($my_user->region == "Нижегородская область" ) echo 'selected' ; ?>  >Нижегородская область</option>
                            <option <?php if ($my_user->region == "Новгородская область" ) echo 'selected' ; ?>  >Новгородская область</option>
                            <option <?php if ($my_user->region == "Новосибирская область" ) echo 'selected' ; ?>  >Новосибирская область</option>
                            <option <?php if ($my_user->region == "Омская область" ) echo 'selected' ; ?>  >Омская область</option>
                            <option <?php if ($my_user->region == "Оренбургская область" ) echo 'selected' ; ?>  >Оренбургская область</option>
                            <option <?php if ($my_user->region == "Орловская область" ) echo 'selected' ; ?>  >Орловская область</option>
                            <option <?php if ($my_user->region == "Пензенская область" ) echo 'selected' ; ?>  >Пензенская область</option>
                            <option <?php if ($my_user->region == "Пермский край" ) echo 'selected' ; ?>  >Пермский край</option>
                            <option <?php if ($my_user->region == "Псковская область" ) echo 'selected' ; ?>  >Псковская область</option>
                            <option <?php if ($my_user->region == "Ростовская область" ) echo 'selected' ; ?>  >Ростовская область</option>
                            <option <?php if ($my_user->region == "Рязанская область" ) echo 'selected' ; ?>  >Рязанская область</option>
                            <option <?php if ($my_user->region == "Самарская область" ) echo 'selected' ; ?>  >Самарская область</option>
                            <option <?php if ($my_user->region == "Саратовская область" ) echo 'selected' ; ?>  >Саратовская область</option>
                            <option <?php if ($my_user->region == "Сахалинская область" ) echo 'selected' ; ?>  >Сахалинская область</option>
                            <option <?php if ($my_user->region == "Свердловская область" ) echo 'selected' ; ?>  >Свердловская область</option>
                            <option <?php if ($my_user->region == "Смоленская область" ) echo 'selected' ; ?>  >Смоленская область</option>
                            <option <?php if ($my_user->region == "Тамбовская область" ) echo 'selected' ; ?>  >Тамбовская область</option>
                            <option <?php if ($my_user->region == "Тверская область" ) echo 'selected' ; ?>  >Тверская область</option>
                            <option <?php if ($my_user->region == "Томская область" ) echo 'selected' ; ?>  >Томская область</option>
                            <option <?php if ($my_user->region == "Тульская область" ) echo 'selected' ; ?>  >Тульская область</option>
                            <option <?php if ($my_user->region == "Тюменская область" ) echo 'selected' ; ?>  >Тюменская область</option>
                            <option <?php if ($my_user->region == "Ульяновская область" ) echo 'selected' ; ?>  >Ульяновская область</option>
                            <option <?php if ($my_user->region == "Забайкальский край" ) echo 'selected' ; ?>  >Забайкальский край</option>
                            <option <?php if ($my_user->region == "Ярославская область" ) echo 'selected' ; ?>  >Ярославская область</option>
                            <option <?php if ($my_user->region == "Москва" ) echo 'selected' ; ?>  >Москва</option>
                            <option <?php if ($my_user->region == "Санкт-Петербург" ) echo 'selected' ; ?>  >Санкт-Петербург</option>
                            <option <?php if ($my_user->region == "Еврейская автономная область" ) echo 'selected' ; ?>  >Еврейская автономная область</option>
                            <option <?php if ($my_user->region == "Ненецкий автономный округ" ) echo 'selected' ; ?>  >Ненецкий автономный округ</option>
                            <option <?php if ($my_user->region == "Ханты-Мансийский автономный округ - Югра" ) echo 'selected' ; ?>  >Ханты-Мансийский автономный округ - Югра</option>
                            <option <?php if ($my_user->region == "Чукотский автономный округ" ) echo 'selected' ; ?>  >Чукотский автономный округ</option>
                            <option <?php if ($my_user->region == "Ямало-Ненецкий автономный округ" ) echo 'selected' ; ?>  >Ямало-Ненецкий автономный округ</option>
                            <option <?php if ($my_user->region == "Республика Крым" ) echo 'selected' ; ?>  >Республика Крым</option>
                            <option <?php if ($my_user->region == "Севастополь" ) echo 'selected' ; ?>  >Севастополь</option>                     
                        </select>
                    </label>
                    <label class="placeholder">
                        <input class="input textup input-sphere" type="text" name="Направление" value="<?=$my_user->sphere?>">
                        <span>Сфера деятельности</span>
                    </label>

                    <label class="placeholder">
                        <select name="Тип_участника" id="typeParty" class="typeParty input textup select input-typeParty">
                           <option value="">Выберите тип участия в клубе</option>
                           <option <?php if ($my_user->typeParty == "Экспортёр" ) echo 'selected'; ?> value="Экспортёр – получает ценные знания и информацию по осуществлению экспортной деятельности">Экспортёр</option>
                           <option <?php if ($my_user->typeParty == "Партнер" ) echo 'selected'; ?> value="Партнер - совместная организация мероприятий, общение с экспортерами">Партнёр</option>
                           <option <?php if ($my_user->typeParty == "Спикер" ) echo 'selected'; ?> value="Спикер - получает аудиторию, популярность">Спикер</option>
                           <option <?php if ($my_user->typeParty == "Инвестор" ) echo 'selected'; ?> value="Инвестор – получает потенциальных клиентов среди экспортеров, консультационную поддержку экспертов">Инвестор</option>
                           <option <?php if ($my_user->typeParty == "Покупатель" ) echo 'selected'; ?> value="Покупатель – импортер не из Российской Федерации">Покупатель</option>                      
                        </select>
                        <p class="info" class="infoTypeParty"></p>
                    </label> 
                    
                    <?php if(empty($my_user->what_buy)): ?>
                        <label class="placeholder" style="display: none;">
                    <?php else:?>
                        <label class="placeholder">
                    <?php endif;?>
                        <input 
                            class="input textup input-what_buy" 
                            type="text" 
                            name="ХочуКупить" 
                            id="buy_reg" 
                            value="<?=$my_user->what_buy?>">
                        <span>Что хотите купить</span>
                        <p class="info">Введите товары, которые вы хотите купить</p>
                    </label>

                    <button class="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Модальное окно alert -->
<div class="formbg" id="modalbg">
    <div class="formup" id="modal">
        <div>
            <div class="contact__block" style="text-align: center;">
                <div class="contact__blocktitle" style="word-break: break-word;">
                </div>
                <p class="form_text"></p>
                <a class="inclub__button close_modal ok_btn" style="cursor: pointer;">OK</a>
            </div>
        </div>
    </div>
</div>
<!-- Модальное окно confirm -->
<div class="formbg" id="confirmmodalbg">
    <div class="formup" id="confirmmodal">
        <div>
            <div class="contact__block" style="text-align: center;">
                <div class="contact__blocktitle" style="word-break: break-word;margin-bottom: 20px">
                </div>
                <!-- <p class="form_text"></p> -->
                <a class="inclub__button ok_confirmmodal ok_btn" style="cursor: pointer;">OK</a>
                <a class="inclub__button otmena_confirmmodal cancel_btn" style="cursor: pointer;">Отмена</a>
            </div>
        </div>
    </div>
</div>
<!-- Cookie форма -->
<div class="cookie_accept_form">
    <div class="text">
        Мы используем cookie-файлы для наилучшего представления нашего сайта. Продолжая использовать этот сайт, вы соглашаетесь с использованием cookie-файлов.
    </div>
    <div style="text-align: center;">
        <a class="cookie_agree_btn">
            ОК
        </a>
    </div>
</div>
<!-- Форма изменения данных запроса -->
<div class="formbg" id="changeinquiriesbg">
    <div class="formup" id="changeinquiries">
        <div class="contact__wrapp">
            <div class="contact__block">
                <div class="contact__blocktitle">
                    Изменение данных запроса
                </div>
                 <form class="change_inquiries_form" id="inquirie_form">
                    <input class="inquirie-id" type="hidden" name="id_inquirie" value="...">
                    <label class="placeholder">
                        <input class="input textup input-text inquirie-name" type="text" name="Имя" value="...">
                        <span>Введите имя</span>
                    </label>
                    <label class="placeholder">
                        <input class="input textup inquirie-country" type="text" name="Страна" value="...">
                        <span>Введите страну запроса</span>
                    </label>
                    <label class="placeholder">
                        <input class="input textup inquirie-contacts" type="text" name="Контакты" value="...">
                        <span>Введите контакты запроса</span>
                    </label>
                    <label class="placeholder">
                        <textarea class="textarea textup input-text inquirie-zapros" name="Запрос">...</textarea>
                        <span>Введите текст запроса</span>
                    </label>

                    <label class="placeholder">
                        <select name="Категория" id="category_inquiries" class="input textup select input-category">
                           <option value=''>Выберите Ваш регион</option>
                            <option>Продукты питания</option>
                            <option>Легкая промышленность</option>
                            <option>Строительные товары</option>
                            <option>Транспорт, техника, запчасти, инструменты</option>
                            <option>Сырьё</option>
                            <option>Химическая промышленность</option>
                            <option>Сельское хозяйство</option>
                            <option>Лесная промышленность</option>
                            <option>Оборудование</option>
                            <option>Расходные материалы</option>
                            <option>Другое</option>
                        </select>
                    </label>
                    <button class="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>    
</div>
<!-- Форма оставления заявки для заказа спикера -->
<div class="formbg" id="speakersbg">
    <div class="formup" id="speakers">
        <div class="contact__wrapp">
            <div class="contact__block">
                <div class="contact__blocktitle">
                    Пригласить спикера
                </div>
                 <form class="order_speakers">
                    <input type="hidden" name="type" value="order_speaker">
                    <label class="placeholder">
                        <input class="input textup input-text input-fio" type="text" name="ФИО заказчика">
                        <span>ФИО</span>
                    </label>
                    
                    <label class="placeholder">
                        <input class="input textup input-mail" type="text" name="E-mail">
                        <span>E-mail</span>
                    </label>
                    
                    <label class="placeholder">
                        <input class="textarea textup input-tel" name="Телефон">
                        <span>Телефон</span>
                    </label>

                    <label class="placeholder">
                        <input class="input textup input-company" type="text" name="Компания">
                        <span>Компания</span>
                    </label>
                    
                    <!-- <label>
                        <div class="checkbox-list" id="clients_checkbox_list">
                            <div style="display: flex; align-items: center;">
                                <input type="checkbox" class="regular-checkbox have_info" style="border-radius: 0">
                                <span>У меня есть информация о мероприятии</span>
                            </div>
                        </div>
                    </label> -->

                    <!-- <div class="hide_div_speakers hide_form"> -->
                        
                        <?php
                            $list_speakers = $wpdb->get_results( " SELECT * FROM wp_speakers");
                        ?>

                        <label class="placeholder">
                            <select name="Спикер" class="input textup select input-speaker">
                                <option value=''>Выберите спикера</option>
                                <?php 
                                    foreach($list_speakers as $item) {
                                        $speaker_fio = $item->surname." ".$item->name." ".$item->patronymic;
                                        echo "<option>".$speaker_fio."</option>";
                                    }
                                ?>
                            </select>
                        </label>

                        <label class="placeholder">
                            <select name="Тип мероприятия" class="input textup select input-type_event">
                                <option value=''>Выберите тип мероприятия</option>
                                <option>Конференция</option>
                                <option>Форум</option>
                                <option>Другое</option>
                            </select>
                        </label>

                        <label class="placeholder">
                            <input class="input textup input-money" type="text" name="Бюджет">
                            <span>Бюджет</span>
                        </label>

                        <label class="placeholder placeholder-active">
                            <input class="input textup input-place" type="text" name="Место проведения">
                            <span>Место проведения</span>
                        </label>

                        <label class="placeholder placeholder-active">
                            <input class="input textup input-date" type="date" name="Дата мероприятия" value="<?php echo date('Y-m-d'); ?>">
                            <span>Дата мероприятия</span>
                        </label>

                         <label class="placeholder placeholder-active">
                            <input class="input textup input-time" type="time" name="Время начала мероприятия" value="<?php echo date('H:i'); ?>">
                            <span>Время начала мероприятия</span>
                        </label>

                        <label class="placeholder placeholder-active">
                            <input class="input textup input-duration" type="time" name="Длительность выступления" value="01:00">
                            <span>Длительность выступления</span>
                        </label>

                        <label class="placeholder placeholder-active">
                            <textarea class="textarea textup input-comment" name="Комментарий"></textarea>
                            <span>Комментарий</span>
                        </label>

                    <!-- </div> -->

                    <button class="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>    
</div>
<!--Форма уведомления-->
<div class="notification__block">
    <span class="notification__close"></span>

    <div class="notification__text notification__no-like-speaker">
        Для того, чтобы добавить эксперта в избранное, Вам необходимо <a class="to_auth_page_of_event" data-type='reg'>зарегистрироваться</a> или <a class="to_auth_page_of_event" data-type='auth'>авторизоваться</a> 
    </div>

    <div class="notification__text notification__no-like-material">
        Для того, чтобы добавить материал в избранное, Вам необходимо <a class="to_auth_page_of_event" data-type='reg'>зарегистрироваться</a> или <a class="to_auth_page_of_event" data-type='auth'>авторизоваться</a> 
    </div>

    <div class="notification__text notification__like-speaker">
        Эксперт был добавлен в избранное<br>
        <a href="/profile/?tab=experts">Перейти</a>
    </div>

    <div class="notification__text notification__like-material">
        Материал был добавлен в избранное<br>
        <a href="/profile/?tab=materials">Перейти</a>
    </div>

    
</div>
