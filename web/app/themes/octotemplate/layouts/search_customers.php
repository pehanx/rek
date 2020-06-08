<?php
/*
 * Template Name: Поиск покупателей
 *
 * Template Post Type: page
 *
 * The template for displaying Profile page
 *
 * @package wptemplate
 *
 */
// require_once 'wp/wp-load.php';
// global $wpdb;
// $table_add_customers = $wpdb->get_blog_prefix() . 'add_customers';
 ?>
            <?php include('sidebar.php') ?>
            <div class="profile_content">
                <div class="nav">
                    <div>
                        <a href='javascript:;' style="cursor: pointer;">Поиск покупателей</a>
                    </div>
                </div>
                <div class="my_events contact__wrapp">
                    <div style="width: 100%">
                    <form method="post" style="width: 100%;">
                        <label class="placeholder" style="margin-bottom: 20px">
                            <input class="input textup input-name" type="text" value="<?=@$_POST['Zapros']?>" name="Zapros" id="fio_reg" style="background-color: #EFEFEF">
                            <span style="font-size: 14px">Запрос</span>
                            <p class="info">Введите запрос на поиск организаций</p>
                        </label>
                        <button class="submit">Поиск</button>
                    </form>
                    </div>
                </div>
                <div class="typical__wrapp my_events">

                    <?php if(isset($_POST['Zapros'])){
                        $text_zapros = $_POST['Zapros'];
                        if( strlen(trim($text_zapros)) > 0 ){ 
                            $id_pars = nikite($text_zapros);
                            nikite2($id_pars, 1);
                        }else{
                            echo "<script>alert('Введите запрос');</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>   
<?php

get_footer();  
   
