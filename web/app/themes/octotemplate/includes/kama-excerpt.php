<?php
    /**
     * Обрезка текста
     */
    function kama_excerpt($size = 160, $post_id = 0)
    {
        global $post;
        $save_post = $post;
        if ($post_id) {
            $post = get_post($post_id);
        }

        $args = '';

        $default = array(
            'maxchar' => $size,   // количество символов.
            'text' => '',    // какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
            // Если есть тег <!--more-->, то maxchar игнорируется и берется все до <!--more--> вместе с HTML
            'autop' => false,  // Заменить переносы строк на <p> и <br> или нет
            'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'
            'more_text' => 'Читать дальше...', // текст ссылки читать дальше
        );

        if (is_array($args)) $_args = $args;
        else                  parse_str($args, $_args);

        $rg = (object)array_merge($default, $_args);
        if (!$rg->text) $rg->text = $post->post_excerpt ?: $post->post_content;
        $rg = apply_filters('kama_excerpt_args', $rg);

        $text = $rg->text;
        $text = preg_replace('~\[/?.*?\](?!\()~', '', $text); // убираем шоткоды, например:[singlepic id=3], markdown +
        $text = trim($text);

        // <!--more-->
        if (strpos($text, '<!--more-->')) {
            preg_match('/(.*)<!--more-->/s', $text, $mm);

            $text = trim($mm[1]);

            $text_append = ' <a href="' . get_permalink($post->ID) . '#more-' . $post->ID . '">' . $rg->more_text . '</a>';
        } // text, excerpt, content
        else {
            $text = trim(strip_tags($text, $rg->save_tags));

            // Обрезаем
            if (mb_strlen($text) > $rg->maxchar) {
                $text = mb_substr($text, 0, $rg->maxchar);
                $text = preg_replace('~(.*)\s[^\s]*$~s', '\\1 ...', $text); // убираем последнее слово, оно 99% неполное
            }
        }

        // Сохраняем переносы строк. Упрощенный аналог wpautop()
        if ($rg->autop) {
            $text = preg_replace(
                array("~\r~", "~\n{2,}~", "~\n~", '~</p><br ?/>~'),
                array('', '</p><p>', '<br />', '</p>'),
                $text
            );
        }

        $text = apply_filters('kama_excerpt', $text, $rg);

        if (isset($text_append)) $text .= $text_append;

        $post = $save_post;

        return ($rg->autop && $text) ? "<p>$text</p>" : $text;
    }