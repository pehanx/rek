<?php
/*
 * Template Name: База
 *
 * Template Post Type: page
 *
 * The template for displaying Materials page
 *
 * @package wptemplate
 *
 */

get_header();
?>
<?php
function sas(){
      $type = 'type'; //колонка из таблицы
        $param = 'place'; //значение колонки
        $sort = 'id'; //отсортировать по параметру на возрастание
        $page = '1'; //страница, по умолчанию показывается 100 результатов для каждой страницы 

        $authtoken = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ5ODAwMjVjYzA1OWE3ZmY1NDk0MmVjMGNlNDZjNDJmZGVhYTc5ZDU5';
        $link = "http://176.99.5.64/upapi/slct&type=$type&param=$param&sort=$sort&page=$page";
        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: spider.g2r.su',$authtoken));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $html = curl_exec($curl);
        $html = json_decode($html,true);
        $response = $html['results'];
        foreach($response as $response){
        print_r($response['from']); //откуда контакт
        print_r($response['phone']); //телефон
        print_r($response['email']); //почта
        print_r($response['city']); //город
        }

    }
sas();
?>

<?php
wp_reset_query();
?>


<?php
get_template_part('parts/footer', 'archive');
get_footer();
