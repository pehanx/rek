<?php if(isAuth()):?>
<div class="updatesitebg">
    <div class="updatesiteup">
        <div class="contact__wrapp">
            <div class="contact__block">
                <div class="contact__blocktitle">
                    <?= pll__('Улучшение сайта'); ?>
                </div>
                <form action="/mail.php" method="post" class="reg updatesite__form" >
                    <label class="placeholder">
                        <input class="input textup input-name" type="text" name="<?= pll__('ФИО'); ?>">
                        <span>Фамилия, имя и отчество</span>
                        <p class="info">Укажите ваше фамилия, имя и отчество</p>
                    </label>
                    <label class="placeholder">
                        <input class="input textup input-email" type="text" name="<?= pll__('Почта'); ?>">
                        <span>E-mail</span>
                        <p class="info">Укажите вашу электронную почту</p>
                    </label>
                    <label class="placeholder">
                        <textarea class="textarea textup input-text" name="<?= pll__('Сообщение'); ?>"></textarea>
                        <span>Ваши предложения по улучшению сайта</span>
                    </label>
                    <input type="hidden" value="updatesite" name="type">
                    <button class="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif;?>

<div class="popupsucces">
    <?= pll__('Данные успешно отправлены!'); ?>
</div>