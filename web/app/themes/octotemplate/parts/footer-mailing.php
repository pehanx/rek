<div class="mailingbg">
    <div class="mailup">
        <div class="contact__wrapp">
            <div class="contact__block">
                <form action="/mail.php" method="post" class="reg mailing__form" >
                    <div class="descript-mailing">
                        <span class="text">Подпишитесь на нашу рассылку и получайте приглашение на все мероприятия,<br> проводимые Российским Экспортным Клубом:</span>
                        <span class="close-modal">&#10006;</span>
                    </div>
                    <label class="placeholder">
                        <input class="input textup input-email" type="text" name="Почта">
                        <span>E-mail</span>
                        <p class="info">Укажите вашу электронную почту</p>
                    </label>
                    <input type="hidden" value="participation" name="type">
                    <button class="submit">Подписаться</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="popupsucces">
    <?= pll__('Данные успешно отправлены!'); ?>
</div>