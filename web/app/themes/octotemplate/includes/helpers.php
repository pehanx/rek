<?php

/**
 * Синоним get_template_directory_uri
 */
function template()
{
    return get_template_directory_uri() . '/';
}

/**
 * Синоним функции проверки залогинен ли пользователь
 */
function auth() {
    return is_user_logged_in();
}

/**
 * Вернуть перевод
 */
function trans($key) {
    require get_template_directory() . '/languages/language-'.qtrans_getLanguage().'.php';
    return $_[$key];
}

/**
 * Вернуть 404 страницу
 */
function abort404(){
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 );
    exit;
}

/**
 * Получить url изображения записи
 */
function get_post_image_url($post = 0, $image_id = 0, $size = 'full')
{
    $image = get_post_image($post, $image_id, $size);
    return $image['url'];
}

/**
 * Получить alt изображения записи
 */
function get_post_image_alt($post = 0, $image_id = 0, $size = 'full')
{
    $image = get_post_image($post, $image_id, $size);
    return $image['alt'];
}

/**
 * Получить изображение записи
 */
function get_post_image($post = 0, $image_id = 0, $size = 'full')
{
    if (!$post) {
        $post = get_the_ID();
    }
    if ($image_id == 0) {
        $image_id = get_post_thumbnail_id($post);
    }
    $image['url'] = wp_get_attachment_image_url($image_id, $size);
    $image['alt'] = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
    return $image;
}

/**
 * Получаем первую категорию к которой относится запись
 */
function get_first_category($post_id = null, $taxonomy = 'category')
{
    $categories = get_all_category($post_id, $taxonomy);
    if (isset($categories[0])) {
        return $categories[0];
    }
}

/**
 * Получить все категории к которым относится запись
 */
function get_all_category($post_id = null, $taxonomy = 'category')
{
    if ($post_id == null) {
        $post_id = get_queried_object_id();
    }
    $categories = get_the_terms($post_id, $taxonomy);
    return $categories;
}

/**
 * Разбить категории на родительские и дочерние
 */
function sort_categories($categories) {
    if ($categories) {
        foreach ($categories as $key => $category) {
            if ($category->parent == 0) {
                $categories[$key]->childrens = m_get_subcategories($category->term_id, $categories);
            } else {
                unset($categories[$key]);
            }
        }
    }
    return $categories;
}

/**
 * Получить дочерние категории
 */
function m_get_subcategories($parent, $categories) {
    $childs = array();
    foreach ($categories as $category) {
        if ($category->parent == $parent) {
            $childs[] = $category;
        }
    }
    if ($childs) {
        foreach ($childs as $key => $child) {
            $childs[$key]->childrens = m_get_subcategories($child->term_id, $categories);
        }
    }
    return $childs;
}

/**
 * Вернуть расширенный заголовок или стандартный
 */
function my_title($post_id = null) {
    return get_field('title', $post_id) ? get_field('title', $post_id) : get_the_title($post_id);
}

/**
 * Pretty print
 */ 
function pp($values, $continue = false) {
    echo '<pre>';
    print_r([$values]);
    echo '</pre>';

    if ($continue) {
        return;
    }
    die();
}

function clear_phone($phone_number) {
    return preg_replace('/[^\d\+]/', '', $phone_number);
}

function shorten_text($text, $max_length = 140, $cut_off = '...', $keep_word = true)
{
    if(strlen($text) <= $max_length) {
        return $text;
    }

    if(strlen($text) > $max_length) {
        if($keep_word) {
            $text = substr($text, 0, $max_length + 1);

            if($last_space = strrpos($text, ' ')) {
                $text = substr($text, 0, $last_space);
                $text = rtrim($text);
                $text .=  $cut_off;
            }
        } else {
            $text = substr($text, 0, $max_length);
            $text = rtrim($text);
            $text .=  $cut_off;
        }
    }

    return $text;
}

/**
 * Проверка авторизован ли пользователь
 */
function isAuth() {
    if(isset($_SESSION['user_id'])){   
        return true;
    }else{
        return false;
    }
}

/**
 * Функция кросспостинга в соцсети
 */
function add_blog_soc($text, $the_id, $type_post){
    
}

function crosspost_soc($text, $the_id, $type_post){

    $recdb = new wpdb('usernew','xdcM0IKGYzLP0K6Yvvbl','dbnew','localhost');
    
    $socdb = new wpdb('usersoc','HisMgqiRI8EG74XlyMPX','dbsoc','localhost');

    $date_now = date('Y-m-d H:i:s');

    //Вставить в таблицу engine4_activity_actions
    //Вставить в таблицу engine4_sesadvancedactivity_details
    //Вставить в таблицу engine4_activity_stream
    $socdb->insert('engine4_activity_actions', array(
        'type' => 'post',
        'subject_type' => 'user',
        'subject_id' => 1,
        'object_type' => 'sesgroup_group',
        'object_id' => 1,
        'body' => $text,
        'params' => '[]',
        'date' => $date_now,
        'modified_date' => $date_now,
        'privacy' => 'everyone'
    ));

    $action_id = $socdb->insert_id;

    $recdb->insert('wp_publish_post_soc', array(
        'id_post_in_soc' => $action_id,
        'id_post_in_rec' => $the_id
    ));

    $socdb->insert('engine4_sesadvancedactivity_details', array(
        'action_id' => $action_id,
        'sesresource_id' => 1,
        'sesresource_type' => 'sesgroup_group'
    ));

    //Вставить хэштег
    $socdb->insert('engine4_sesadvancedactivity_hashtags', array(
        'action_id' => $action_id,
        'title' 	=> $type_post
    ));

    //1
    $socdb->insert('engine4_activity_stream', array(
        'target_type' => 'registered',
        'target_id' => 0,
        'subject_type' => 'user',
        'subject_id' => 1,
        'object_type' => 'sesgroup_group',
        'object_id' => 1,
        'type' => 'post',
        'action_id' => $action_id
    ));
    //2
    $socdb->insert('engine4_activity_stream', array(
        'target_type' => 'members',
        'target_id' => 1,
        'subject_type' => 'user',
        'subject_id' => 1,
        'object_type' => 'sesgroup_group',
        'object_id' => 1,
        'type' => 'post',
        'action_id' => $action_id
    ));
    //3
    $socdb->insert('engine4_activity_stream', array(
        'target_type' => 'parent',
        'target_id' => 1,
        'subject_type' => 'user',
        'subject_id' => 1,
        'object_type' => 'sesgroup_group',
        'object_id' => 1,
        'type' => 'post',
        'action_id' => $action_id
    ));
    //4
    $socdb->insert('engine4_activity_stream', array(
        'target_type' => 'owner',
        'target_id' => 1,
        'subject_type' => 'user',
        'subject_id' => 1,
        'object_type' => 'sesgroup_group',
        'object_id' => 1,
        'type' => 'post',
        'action_id' => $action_id
    ));
    //5
    $socdb->insert('engine4_activity_stream', array(
        'target_type' => 'everyone',
        'target_id' => 0,
        'subject_type' => 'user',
        'subject_id' => 1,
        'object_type' => 'sesgroup_group',
        'object_id' => 1,
        'type' => 'post',
        'action_id' => $action_id
    ));
}

/**
 * Функция обновления кросспостинга в соцсети
 */
function crosspost_soc_update($text, $id_soc){
    
    $socdb = new wpdb('usersoc','HisMgqiRI8EG74XlyMPX','dbsoc','localhost');

    $date_now = date('Y-m-d H:i:s');

    //Обновить таблицу engine4_activity_actions
    $socdb->update('engine4_activity_actions', array(
            'body' => $text,
            'modified_date' => $date_now
        ),
        array(
            'action_id' => $id_soc
        )
    );
}