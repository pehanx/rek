<?php
/*
 * Template Name: Пригласить эксперта
 *
 * Template Post Type: page
 *
 * The template for displaying Registration page
 *
 * @package wptemplate
 *
 */
get_header();?>

<section class="contact">
    <div class="contact__bg"></div>
    <div class="contact__title">
        <?= get_the_title(); ?>
    </div>
    <div class="contact__wrapp invite-speaker_contact__wrapp">
        <div class="contact__block invite-speaker_contact__block">
  
            <?php if(isset($_GET['expert'])) $experts_id = explode(',', $_GET['expert']); ?>

            <!-- Вызов функции из speaker-helper.php -->
            <?php $speakers_list = get_speakers_list();?>            
            
            <form  method="post" id="invite-speakers-form" >
                
                <!-- Контактная информация: -->
                <div class="for-block">
                    Контактная информация: 
                </div>

                <label class="placeholder">
                    <input class="input textup input-fio" type="text" name="ФИО">
                    <span>Фамилия имя отчество*</span>
                </label>

                <label class="placeholder">
                    <input class="input textup input-company" type="text" name="Компания">
                    <span>Компания</span>
                </label>

                <label class="placeholder">
                    <input class="input textup input-email" type="text" name="Почта">
                    <span>E-mail*</span>
                </label>

                
                <label class="placeholder">
                    <input class="input textup input-tel mask-for-input" type="text" name="Телефон">
                    <span>Телефон для связи*</span>
                </label>
                <!--END Контактная информация: -->
                
                <!-- Интересующие эксперты: -->
                <div class="for-block">
                    Интересующие эксперты: 
                </div>
                
                <label class="multiple-select2-placeholder">
                    <!-- <select class="multiple-select2 input textup select input-speakers" name="invite-speakers-list[]" multiple="multiple"> -->
                    <select class="multiple-select2 input textup select input-speakers" multiple="multiple">
                        <?php foreach($speakers_list as $item):?>
                            <option 

                            <?php 
                                if(isset($experts_id)) if( in_array($item['id'], $experts_id)) echo 'selected'; 
                            ?>
                            value="<?= $item['id']?>"><?= $item['name']?></option>
                        <?php endforeach;?>
                    </select>
                </label>
                <!--END Интересующие эксперты: -->

                <!-- Информация о мероприятии: -->
                <div class="for-block">
                    Информация о мероприятии:
                </div>

                <label class="placeholder">
                    <input class="input textup input-company" type="text" name="Бюджет">
                    <span>Бюджет</span>
                </label>

                <label class="placeholder placeholder-input-date">
                    <input class="input textup input-company" type="date" name="Дата мероприятия" min="<?=date('Y-m-d'); ?>" value="<?=date('Y-m-d'); ?>">
                    <span>Дата мероприятия</span>
                </label>

                <label class="placeholder">
                    <input class="input textup input-company" type="number" min="0" name="Количество участников">
                    <span>Количество участников</span>
                </label>

                <label class="placeholder">
                    <input class="input textup input-company" type="text" min="0" name="Длительность выступления">
                    <span>Длительность выступления эксперта(ов)</span>
                </label>

                <label class="placeholder">
                    <input class="input textup input-company" type="text" name="Место проведения">
                    <span>Место проведения</span>
                </label>

                <label class="placeholder comment-placeholder">
                    <textarea class="textarea textup" name="Комментарий"></textarea>
                    <span>Комментарий</span>
                </label>
                <!--END Информация о мероприятии: -->

                <div class="checkbox__block">
                    <div class="checkbox__input">
                        <input type="checkbox"  id="checkbox_terms_invite_speaker">
                        <label for="checkbox_terms_invite_speaker"></label>
                    </div>
                    <span class="checkbox__text">Нажимая кнопку «Отправить», я даю свое согласие на обработку моих персональных данных, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях и для целей, определенных в Согласии на обработку персональных данных</span>
                </div>
                <input type="hidden" value="invite-speakers" name="type">
                <button disabled class="submit">Отправить заявку</button>
            </form>
                
        </div>
    </div>
</section>

<?php
get_footer();