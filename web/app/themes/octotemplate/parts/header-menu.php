<?php
$header_menu = getMenu('menu-header');
if ($header_menu): ?>
<section class="<?= is_front_page() ? 'menu' : 'menuother'; ?> menujs">
    <div class="menu__wrapp">
        <a href="//russianexport.club" class="menu__logo">
            <div>
                <?php
                $logo = get_field('logo', 'option');
                if ($logo): ?>
                    <img src="<?= $logo['url']; ?>" alt="<?= $logo['alt']; ?>">
                <?php endif; ?>
            </div>
            <span><?= pll__('Российский экспортный клуб'); ?></span>
        </a>
        <div class="searchforheader">
            <form action="/<?= pll_current_language() === 'ru' ? '' : pll_current_language() . '/'; ?>" method="get">
                <input type="text" name="s" placeholder="<?= pll__('Что вы ищете?'); ?>">
                <button>
                    <svg class="icon__search" width="31px" height="31px">
                        <use xlink:href="#search"></use>
                    </svg>
                </button>
            </form>
        </div>
        <div class="menu__links">
            <?php foreach ($header_menu as $menu_element): ?>
            <?php if(isAuth())
                    if($menu_element['title']=="ВСТУПИТЬ")
                        continue;?>
                <a href="<?= $menu_element['link']; ?>"
                   class="menu__link<?=
                   $menu_element['active'] ? ' active' : ''; ?><?=
                   get_field('show_underline', $menu_element['item']) ? ' active-login' : '';
                   ?>">
                    <?= $menu_element['title']; ?>
                </a>
            <?php endforeach; ?>
            
            <?php if(isAuth()):?>
                <a href="javascript:void(0);" class="menu__link exit_from_site">ВЫЙТИ</a>
            <?php endif;?>

            <!--add class active-red for red font color-->
            <a href="" class="search-open">
                <svg class="icon__search" width="31px" height="31px">
                    <use xlink:href="#search"></use>
                </svg>
            </a>
            <a href="" class="mobile-menu">
                <svg class="icon__menuicon" width="31px" height="31px">
                    <use xlink:href="#menuicon"></use>
                </svg>
            </a>
            <a href="" class="mobile-menu-clouse">
                <svg class="icon__clousemenu" width="31px" height="31px">
                    <use xlink:href="#clousemenu"></use>
                </svg>
            </a>
        </div>
    </div>
</section>
<div class="dropdown">
    <?php foreach ($header_menu as $menu_element): ?>
        <?php if(isAuth())
                if($menu_element['title']=="ВСТУПИТЬ")
                    continue;?>
        <a href="<?= $menu_element['link']; ?>" class="<?= $menu_element['active'] ? ' active' : ''; ?>"><?= $menu_element['title']; ?></a>
    <?php endforeach; ?>
    <?php if(isAuth()):?>
        <a href="javascript:void(0);" class="exit_from_site">ВЫЙТИ</a>
    <?php endif;?>

</div>
<?php endif; ?>