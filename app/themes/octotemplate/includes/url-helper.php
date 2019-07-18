<?php
    /**
     * Вернуть урл сайта со страницей
     */
    function get_full_url($with_request = false) {
        $request = (isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'');
        return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . ($with_request?$request:'');
    }

    /**
     * Вернуть урл страницы
     */
    function get_url() {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Есть ли в запросе к сайту переданный параметр с переданным значением
     */
    function in_query($parameter, $value, $default = false) {
        if (isset($_GET[$parameter]) || isset($_POST[$parameter])) {
            if (is_array($_GET[$parameter])) {
                return in_array($value, $_GET[$parameter]);
            }
            if (is_array($_POST[$parameter])) {
                return in_array($value, $_POST[$parameter]);
            }
            return $_GET[$parameter] == $value || $_POST[$parameter] == $value;
        }
        return $default;
    }

    /**
     * Есть ли в запросе к сайту переданный параметр
     */
    function has_parameter($url, $parameter) {
        if (!$url) {
            $url = get_url();
        }
        return preg_match('/('.$parameter.'=.)/', $url);
    }

    /**
     * Есть ли в url запросы
     */
    function has_query($url) {
        return preg_match('/\?/', $url);
    }

    /**
     * Добавить параметр в запрос
     */
    function add_parameter_query($url, $parameter, $value, $change = true) {
        if (!has_query($url)) {
            $url .= '?'.$parameter.'='.$value;
        } else {
            if (has_parameter($url, $parameter)) {
                if ($change) {
                    $url = change_paremeter_query($url, $parameter, $value);
                }
            } else {
                $url .= '&'.$parameter.'='.$value;
            }
        }
        return $url;
    }

    function remove_pagination($url) {
        $url = preg_replace('/page\/\d+\//', '', $url);
        return $url;
    }

    /**
     * Почистить запрос от мусора
     */
    function clear_query($url) {
        $url = preg_replace('/\?$/', '', $url);
        $url = preg_replace('/\&$/', '', $url);
        $url = preg_replace('/\&&/', '&', $url);
        $url = preg_replace('/\?&/', '?', $url);
        return $url;
    }

    /**
     * Удалить параметр из запроса
     */
    function remove_parameter_query($url, $parameter) {
        $url = preg_replace('/('.$parameter.'=.+)/', '', $url);
        $url = clear_query($url);
        return $url;
    }

    /**
     * Удалить параметры запроса и пагинацию
     */
    function remove_query($url = null) {
        if (!$url) {
            $url = get_url();
        }
        $url = preg_replace('/\?.+/', '', $url);
        $url = remove_pagination($url);
        $url = clear_query($url);
        return $url;
    }

    /**
     * Заменить значение параметра в запросе
     */
    function change_paremeter_query($url, $parameter, $value) {
        $url = remove_parameter_query($url, $parameter);
        $url = add_parameter_query($url, $parameter, $value);
        return $url;
    }