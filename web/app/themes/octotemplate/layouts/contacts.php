<?php
/*
 * Template Name: Контакты
 *
 * Template Post Type: page
 *
 * The template for displaying Contacts page
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
        <?php
        $contacts = get_field('contacts');
        if ($contacts): ?>
            <div class="contact__block">
                <div class="contact__blocktitle">
                    <?= $contacts['title']; ?>
                </div>
                <?php foreach($contacts['sites'] as $site): ?>
                    <a href="<?= $site['value']; ?>">Russianexport.club</a>
                <?php endforeach; ?>

                <?php foreach($contacts['emails'] as $email): ?>
                    <a href="mailto:<?= $email['value']; ?>"><?= $email['value']; ?></a>
                <?php endforeach; ?>

                <?php foreach($contacts['phone_numbers'] as $phone_number): ?>
                    <a href="tel:<?= clear_phone($phone_number['value']); ?>"><?= $phone_number['value']; ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php
        $form_contact_us = get_field('form_contact_us');
        if ($form_contact_us): ?>
            <div class="contact__block">
                <div class="contact__blocktitle">
                    <?= $form_contact_us['title']; ?>
                </div>
                <form action="/mail.php" method="post" class="contact__form">
                    <label class="placeholder">
                        <input class="input textup input-name" type="text" name="<?= pll__('ФИО'); ?>">
                        <span><?= $form_contact_us['name_placeholder']; ?></span>
                        <p class="info"><?= $form_contact_us['name_description']; ?></p>
                    </label>
                    <label class="placeholder">
                        <input class="input textup input-email" type="text" name="<?= pll__('Почта'); ?>">
                        <span><?= $form_contact_us['email_placeholder']; ?></span>
                        <p class="info"><?= $form_contact_us['email_description']; ?></p>
                    </label>
                    <label class="placeholder">
                        <textarea class="textarea textup" name="<?= pll__('Сообщение'); ?>"></textarea>
                        <span><?= $form_contact_us['message_placeholder']; ?></span>
                    </label>
					<input type="hidden" value="contact" name="type">
                    <button class="submit"><?= $form_contact_us['submit_button_text']; ?></button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();