<?php
    //Функция для получения списка географии экспертов
    function speaker_select_geography(){
        $args = array(
            'post_type' => 'speaker',
            'posts_per_page' => -1,
            'meta_query' => array(
                'key1' => array(
                    'key' => 'geography',
                ),
            ),
        );     
        $query = new WP_Query( $args ); 

        $geography_array =  array();

        //Удаление повторяющихся элементов
        if($query->have_posts()):
            while($query->have_posts()):
                $query->the_post();
                if(empty(get_field('geography')))
                    continue;
                    $geography = get_field('geography');

                if( in_array($geography, $geography_array) )
                {
                    continue;
                }

                $geography_array[] = $geography;
            endwhile;
        endif;

        //Сортировка по алфавиту
        sort($geography_array);
        foreach($geography_array as $element) {
            $result[] = str_pad($element, 9);
        }

        return $result;
    }

    //Функция для получения списка языков экспертов
    function speaker_select_lang(){

        $categories = get_categories( [
            'taxonomy' => 'category',
            'parent'   => '42',
            'orderby'  => 'name',
            'order'    => 'ASC',
        ] );

        return $categories;
    }

    //Функция для получения списка экспертов для select2 на странице "Пригласить спикера"
    function get_speakers_list(){
        
        $speakers_list = new WP_Query([
            'post_type' => 'speaker',
            'posts_per_page' => -1
        ]);

        $speakers_list_array =  array();
               
        if ( $speakers_list->have_posts() ) :
            while ( $speakers_list->have_posts()) :
                $speakers_list->the_post();

                $speakers_list_array[] = array( 
                    "name" => get_the_title(), 
                    "id" => get_the_ID()
                );

            endwhile; 
        endif;

        return $speakers_list_array;
        
    }

    //Функция для проверки на наличие поста в избранном 
    function is_like_post( $id_post ){
        if(isAuth()){
            global $wpdb;
            $id_client = $_SESSION['user_id'];
            $have_like_event = $wpdb->get_row("
                SELECT * 
                FROM wp_like_events 
                WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'
            ");
            if(empty($have_like_event)){
                return false;
            }else{
                return true;
            }
        }else{
           return true; 
        }
    }

    //Функция для проверки на наличие эксперта в избранном
    function is_like_material( $id_post ){
        if(isAuth()){
            global $wpdb;
            $id_client = $_SESSION['user_id'];
            $have_like_event = $wpdb->get_row("
                SELECT * 
                FROM wp_like_events 
                WHERE `id_client` = '$id_client'  AND `id_post` = '$id_post'
            ");
            if(empty($have_like_event)){
                return false;
            }else{
                return true;
            }
        }else{
           return true; 
        }
    }

    //Функция для получения списка стран материала
    function material_select_country(){

        $categories = get_categories( [
            'taxonomy' => 'category',
            'parent'   => '54',
            'orderby'  => 'name',
            'order'    => 'ASC',
        ] );

        return $categories;
    }

    //Функция для получения списка темы материала
    function material_select_theme(){

        $categories = get_categories( [
            'taxonomy' => 'category',
            'parent'   => '66',
            'orderby'  => 'name',
            'order'    => 'ASC',
        ] );

        return $categories;
    }
?>