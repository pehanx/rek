<?php
    /**
     * Активный ли пункт меню
     */
    function isActivePage($menu_item) {
        $object = get_queried_object();

        if ($object) {
            switch ($menu_item->type) {
                case 'post_type':
                    if ($menu_item->object == $object->post_type) {
                        if ($menu_item->object_id == $object->ID) {
                            return true;
                        }
                    }
                    break;
                case 'post_type_archive':
                    if ($menu_item->object == $object->name) {
                        return true;
                    }
                    break;
                case 'taxonomy':
                    if ($menu_item->object == $object->taxonomy) {
                        if ($menu_item->object_id == $object->term_id) {
                            return true;
                        }
                    } else {
                        $category = get_first_category(0, $menu_item->object);
                        if (is_array($category)) {
                            if ($menu_item->object_id == $category['id']) {
                                return true;
                            }
                        }
                    }
                    break;
                case 'custom':
                    if ($menu_item->url == $_SERVER['REQUEST_URI'] || preg_match('~^' . $menu_item->url . '~', $_SERVER['REQUEST_URI'])) {
                        return true;
                    }
                    break;
            }
        }

        return false;
    }

    /**
     * Получить пункты меню
     */
    function getMenu($menu_slug, $parent = 0, $level = 0)
    {
        $menu_list = array();
        if (($locations = get_nav_menu_locations()) && isset($locations[$menu_slug])) {
            $menu = wp_get_nav_menu_object($locations[$menu_slug]);
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            foreach ($menu_items as $menu_item) {
                if ($menu_item->menu_item_parent == $parent) {
                    $subparent = $menu_item->ID;
                    $sub_menu_list = getMenu($menu_slug, $subparent, $level + 1);
                    $title = $menu_item->title;
                    $link = $menu_item->url;
                    $active = isActivePage($menu_item);
                    $menu_list[] = [
                        'active'  => $active,
                        'title'    => $title,
                        'link'    => $link,
                        'submenu' => $sub_menu_list,
                        'item' => $menu_item,
                    ];
                }
            }
        }
        return $menu_list;
    }