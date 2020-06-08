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
                
                <?php if(isAuth()):?>
                <div class="footer__blocklink">
                    <div>
                        <a href="javascript:;" class="update_site_open">Ваши предложения по улучшению сайта</a>
                    </div>
                </div>
                <?php endif;?>
                <span><?= pll__('2019 г. Российский экспортный клуб'); ?></span>
                <!-- <div class="footer__lang">
                    <?php $language_menu = getMenu('menu-language'); ?>
                    <?php foreach ($language_menu as $menu_item):
                        if ($menu_item['title'] === 'English'): ?>
                            <a href="<?= $menu_item['link']; ?>" class="footer__lang-eng"><?= $menu_item['title']; ?></a>
                        <?php else: ?>
                             <a href="<?= $menu_item['link']; ?>" class="footer__lang-rus"><?= $menu_item['title']; ?></a>
                        <?php endif;
                    endforeach; ?>
                </div> -->
            </div>
            <div class="footer__copyright">
                <span>
                    <a href="https://russianexport.club/privacy-policy/">Согласие на обработку персональных данных</a>
                </span>
            </div>
            <?php if(current_user_can('editor') || current_user_can('administrator')):?> 
                <div class="footer__copyright">
                    <span>
                        <a href="/uchastniki/">Участники клуба</a>
                    </span>
                </div>
            <?php endif;?>
        </div>
    </div>
<?php endif; ?>
<div class="upscrollpage">
    <svg class="icon__up" width="44px" height="24px">
        <use xlink:href="#up"></use>
    </svg>
</div>
<?php if(isAuth()):?>
<div class="update_site_button update_site_open">
    <svg class="icon__up" width="20px" height="24px">
        <use xlink:href="#icon-pencil"></use>
    </svg>
</div>
<?php endif;?>