<?php
$footer_menu = getMenu('menu-footer');

if ($footer_menu): ?>
    <div class="footer">
        <div class="footer__wrap">
            <div class="footer__title">
                <div class="footer__logo">
                    <div>
                        <?php
                        $logo = get_field('logo', 'option');
                        if ($logo): ?>
                            <img src="<?= $logo['url']; ?>" alt="<?= $logo['alt']; ?>">
                        <?php endif; ?>
                    </div>
                    <span><?= pll__('Российский экспортный клуб'); ?></span>
                </div>
                <div class="footer__contact">
                    <?php
                    $phone_number = get_field('phone_number', 'option');
                    if ($phone_number): ?>
                        <a href="tel:<?= clear_phone($phone_number); ?>"><?= $phone_number; ?></a>
                    <?php endif; ?>

                    <?php
                    $email = get_field('email', 'option');
                    if ($email): ?>
                        <a href="mailto:<?= $email; ?>"><?= $email; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer__links">
                <div class="footer__blocklink">
                    <?php foreach ($footer_menu as $menu_element): ?>
                        <div>
                            <a href="<?= $menu_element['link']; ?>"><?= $menu_element['title']; ?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="footer__copyright">
                <span><?= pll__('2019 г. Российский экспортный клуб'); ?></span>
                <div class="footer__lang">
                    <?php $language_menu = getMenu('menu-language'); ?>
                    <?php foreach ($language_menu as $menu_item):
                        if ($menu_item['title'] === 'English'): ?>
                            <a href="<?= $menu_item['link']; ?>" class="footer__lang-eng"><?= $menu_item['title']; ?></a>
                        <?php else: ?>
                             <a href="<?= $menu_item['link']; ?>" class="footer__lang-rus"><?= $menu_item['title']; ?></a>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="upscrollpage">
    <svg class="icon__up" width="44px" height="24px">
        <use xlink:href="#up"></use>
    </svg>
</div>