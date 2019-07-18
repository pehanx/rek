<?php
    /**
     * Добавление пунктов меню
     */
    if (function_exists('acf_add_options_page')) {

        $parent = acf_add_options_page(array(
            'page_title' => 'Настройки шаблона',
            'menu_title' => 'Настройки шаблона',
            'icon_url'   => 'dashicons-art',
            'redirect'   => 'false'
        ));

        acf_add_options_sub_page(array(
            'page_title'  => 'Контакты',
            'menu_title'  => 'Контакты',
            'parent_slug' => $parent['menu_slug'],
        ));

    }

    /**
     * Получить поля настроек
     */
    function get_option_field($field) {
        return get_field($field, 'OPTIONS');
    }

    /**
     * Получить поля категорий
     */
    function get_cat_field($field, $cat = null) {
        if (!$cat) {
            $cat = get_queried_object();
        }
        return get_field($field, $cat->taxonomy.'_'.$cat->term_id);
    }

    /**
     * Синоним функции get_cat_field, для обратной совместимости
     */
    function get_tax_field($field, $tax) {
        return get_cat_field($field, $tax);
    }