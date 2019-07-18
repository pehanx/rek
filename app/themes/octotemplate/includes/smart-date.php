<?php
    /**
     * Возвращает дату в текстовом виде
     */
    function smart_date($date) {
        if (is_yesterday($date)) {
            return 'Вчера';
        } elseif (is_today($date)) {
            return 'Сегодня';
        } elseif (is_now_year($date)) {
            return rdate('d F', strtotime($date));
        } else {
            return date('d.m.Y', strtotime($date));
        }
    }

    function is_yesterday($date) {
        $date = date('d.m.Y', strtotime($date));
        return $date == date('d.m.Y', strtotime(date('d.m.Y').' - 1 Day'));
    }

    function is_today($date) {
        $date = date('d.m.Y', strtotime($date));
        return $date == date('d.m.Y');
    }

    function is_now_year($date) {
        $date = date('Y', strtotime($date));
        return $date == date('Y');
    }

    /**
     * Возвращает дату на русском языке
     */
    function rdate($param, $time = 0)
    {
        if (intval($time) == 0) $time = time();
        $monthFullNames = array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
        $monthNames = array("Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек");
        $dayNames = array("Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота");
        if (strpos($param, 'F') === false &&
            strpos($param, 'M') === false &&
            strpos($param, 'l') === false) {
            return date($param, $time);
        } else {
            $param = str_replace('F', $monthFullNames[date('n', $time) - 1], $param);
            $param = str_replace('M', $monthNames[date('n', $time) - 1], $param);
            $param = str_replace('l', $dayNames[date('w', $time)], $param);
            return date($param, $time);
        }
    }