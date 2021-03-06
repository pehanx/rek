<div class="popupbg">
    <?php
    $name_placeholder = get_field('name_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $phone_number_placeholder = get_field('phone_number_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $email_placeholder = get_field('email_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $entity_placeholder = get_field('entity_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $region_placeholder = get_field('region_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $domain_placeholder = get_field('domain_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $login_placeholder = get_field('login_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $password_placeholder = get_field('password_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $password_confirm_placeholder = get_field('password_confirm_placeholder', pll_get_post(PAGE_JOIN_US_ID));
    $submit_button_text = get_field('submit_button_text', pll_get_post(PAGE_JOIN_US_ID));
    $type_member = get_field('type_member', pll_get_post(PAGE_JOIN_US_ID));
    ?>
    <div class="popup">
        <div class="contact__wrapp">
            <div class="contact__block">
                <div class="contact__blocktitle">
                    <?= pll__('Вступление в клуб'); ?>
                </div>
                <form action="/mail.php" class="popup__form">

                    <?/*php if ($name_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup input-name" type="text">
                            <span><?= $name_placeholder; ?></span>
                            <p class="info"><?= get_field('name_placeholder'); ?></p>
                        </label>
                    <?php endif; ?>

                    <?php if ($phone_number_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup input-tel mask-for-input" type="text">
                            <span><?= $phone_number_placeholder; ?></span>
                            <p class="info"><?= get_field('phone_number_placeholder'); ?></p>
                        </label>
                    <?php endif; ?>

                    <?php if ($email_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup input-email" type="text">
                            <span><?= $email_placeholder; ?></span>
                            <p class="info"><?= get_field('email_placeholder'); ?></p>
                        </label>
                    <?php endif; ?>

                    <?php if ($entity_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup input-company" type="text">
                            <span><?= $entity_placeholder; ?></span>
                            <p class="info"><?= get_field('entity_placeholder'); ?></p>
                        </label>
                    <?php endif; ?>

                    <?php if ($region_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup" type="text">
                            <span><?= $region_placeholder; ?></span>
                            <p class="info"><?= get_field('region_placeholder'); ?></p>
                        </label>
                    <?php endif; ?>

                    <?php if ($domain_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup" type="text">
                            <span><?= $domain_placeholder; ?></span>
                            <p class="info"><?= get_field('domain_placeholder'); ?></p>
                        </label>
                    <?php endif; */?>
					
					<?php if ($name_placeholder): ?>
                    <label class="placeholder">
                        <input class="input textup input-name" type="text" name="ФИО">
                        <span><?= $name_placeholder; ?></span>
                        <p class="info"><?= get_field('name_description'); ?></p>
                    </label>
					<?php endif; ?>

					<?php if ($phone_number_placeholder): ?>
						<label class="placeholder">
							<input class="input textup input-tel mask-for-input" type="text" name="Номер телефона">
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
							<input class="input textup input-company" type="text">
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
					<select name="Тип участника" class="input textup select">
					   <option>Выберите тип участия в клубе</option>
					   <option value="Экспортёр">Экспортёр</option>
					   <option value="Партнёр">Партнёр</option>
					   <option value="Спонсор">Спонсор</option>
					   <option value="Инвестор">Инвестор</option>					   
					</select>
					<p class="info"><?= get_field('domain_description'); ?></p>
					</label>
					<input type="hidden" value="participation" name="type">
					<?= get_field('type_member'); ?>

                    <?php if ($submit_button_text): ?>
                        <button class="submit"><?= $submit_button_text; ?></button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="popupsucces">
    <?= pll__('Данные успешно отправлены!'); ?>
</div>

<div class="popupjoin">
    <div class="popupjoinform">
        <?php
        $name_placeholder = get_field('name_placeholder', pll_get_post(PAGE_JOIN_US_ID));
        $phone_number_placeholder = get_field('phone_number_placeholder', pll_get_post(PAGE_JOIN_US_ID));
        $email_placeholder = get_field('email_placeholder', pll_get_post(PAGE_JOIN_US_ID));
        $submit_button_text = get_field('submit_button_text', pll_get_post(PAGE_JOIN_US_ID));
        ?>
        <div class="contact__wrapp">
            <div class="contact__block">
                <div class="contact__blocktitle">
                    <?= pll__('Записаться'); ?>
                </div>
                <form action="/mail.php" class="popup__form">
                    <input type="hidden" value="" class="be-event-title" name="Событие">

                    <?php if ($name_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup input-name" type="text" name="ФИО">
                            <span><?= $name_placeholder; ?></span>
                            <p class="info"><?= get_field('name_placeholder'); ?></p>
                        </label>
                    <?php endif; ?>

                    <?php if ($phone_number_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup input-tel mask-for-input" type="text" name="Телефонный номер">
                            <span><?= $phone_number_placeholder; ?></span>
                            <p class="info"><?= get_field('phone_number_placeholder'); ?></p>
                        </label>
                    <?php endif; ?>

                    <?php if ($email_placeholder): ?>
                        <label class="placeholder">
                            <input class="input textup input-email" type="text" name="Почта">
                            <span><?= $email_placeholder; ?></span>
                            <p class="info"><?= get_field('email_placeholder'); ?></p>
                        </label>
                    <?php endif; ?>
                    <input class="input textup input-company" type="hidden" value="entity">
                    <input class="input textup" type="hidden" value="region">
                    <input class="input textup" type="hidden" value="domain">

                    <?php if ($submit_button_text): ?>
                        <button class="submit"><?= $submit_button_text; ?></button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>