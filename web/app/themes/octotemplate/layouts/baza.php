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
<div style="margin-top: 170px"></div>
<?php

    $arr = array(
        array(
            'date'      => '2017-10-02',
            'name'      => 'Иван',
            'age'       => 30,
            'username'  => 'Ivan',
            'balance'   => 1000
        ),
        array(
            'date'      => '2017-10-03',
            'name'      => 'Михаил',
            'age'       => 32,
            'username'  => 'Misha',
            'balance'   => 1200
        ),
        array(
            'date'      => '2017-10-04',
            'name'      => 'Павел',
            'age'       => 28,
            'username'  => 'Pasha',
            'balance'   => 1100
        ),
        array(
            'date'      => '2017-10-05',
            'name'      => 'Андрей',
            'age'       => 23,
            'username'  => 'Andrew',
            'balance'   => 700
        ),
        array(
            'date'      => '2017-10-06',
            'name'      => 'Игорь',
            'age'       => 19,
            'username'  => 'Ingvar',
            'balance'   => 500
        ),
    );

    $titles = array(
        array(
            'name'  => 'Дата',
            'cell'  => 'A'
        ),
        array(
            'name'  => 'Имя',
            'cell'  => 'B'
        ),
        array(
            'name'  => 'Возраст',
            'cell'  => 'C'
        ),
        array(
            'name'  => 'Логин',
            'cell'  => 'D'
        ),
        array(
            'name'  => 'Баланс',
            'cell'  => 'E'
        ),
    );
	// require get_parent_theme_file_path( '/includes/vendor/autoload.php' );
	// require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

	// use PhpOffice\PhpSpreadsheet\Spreadsheet;
	// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	// $spreadsheet = new Spreadsheet();
	// $sheet = $spreadsheet->getActiveSheet();
	// $sheet->setCellValue('A1', 'Hello World !');

	// $writer = new Xlsx($spreadsheet);
	// $writer->save('hello world.xlsx');


?>
<div style="margin-top: 170px"></div>
<!-- /uni&q=запрос&m=почта&c=страны&ch=выбор -->
<form method="post" style="margin: 10px 40px">
    <input type="text" name="Zapros" placeholder="Введите запрос на поиск">
    <input type="submit" value="Поиск">
</form>

<?php 

    if(isset($_POST['Zapros'])){
        $text_zapros = $_POST['Zapros'];
        // $id_pars = nikite($text_zapros);
        // nikite2($id_pars, 1);

        nikite2($text_zapros, 1);
    }


    function zapros(){
        $query = "honey";
        $email = "nikitos.0@list.ru";
        $country = "ALL";
        $choosen = ",facebook,tender,adverts,import,events,";

        $authtoken = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ5ODAwMjVjYzA1OWE3ZmY1NDk0MmVjMGNlNDZjNDJmZGVhYTc5ZDU5';
        $link = "http://176.99.5.64/upapi/uni&q=$query&m=$email&c=$country&ch=$choosen";
        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: spider.g2r.su',$authtoken));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($curl, CURLOPT_TIMEOUT, 4);
        $html = curl_exec($curl);
        preg_match('/\[parserid\] \=\> (.*)/',$html,$parser_id);
        return $parser_id[1];
    }

    function nikite($zapros){ // функция запуска поиска
        // $query = $_POST['Zapros']; //Запрос
        $query = $zapros;
        $authtoken = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ5ODAwMjVjYzA1OWE3ZmY1NDk0MmVjMGNlNDZjNDJmZGVhYTc5ZDU5'; //токен
        $link = "http://176.99.5.64/upapi/kzshow&q=$query";
        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: spider.g2r.su',$authtoken));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $html = curl_exec($curl);
        $html = strip_tags($html);
        preg_match('/(.*)/',$html,$mark);
        $parser_id = $mark[0]; // id запроса, который лучше хранить в базе
        return $parser_id;
    }
    function nikite2($mark_kz, $page){ // функция просмотра поиска, где $mark_kz - Это $parser_id из прошлой функции, а $page - это номер страницы, например начнём с первой (1)
        $country = 'ALL';
        $query = $mark_kz;

        $authtoken = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ5ODAwMjVjYzA1OWE3ZmY1NDk0MmVjMGNlNDZjNDJmZGVhYTc5ZDU5';
    // $link = "http://176.99.5.64/upapi/kzopen&m=$mark_kz"; //Казахстан
    // $link = "http://176.99.5.64/upapi/kgshow&q=$mark_kz"; //Киргизия
    // $link = "http://176.99.5.64/upapi/itshow&q=$mark_kz"; //Беларусь
    // $link = "http://176.99.5.64/upapi/indshow&q=$mark_kz";//Индийские импортёры
    // $link = "http://176.99.5.64/upapi/niirshow&q=$mark_kz";//Индийские компании
    // $link = "http://176.99.5.64/upapi/ofshow&q=$mark_kz&c=$country"; //Food1
       $link = "http://176.99.5.64/upapi/top&q=$query&id=$str&country=$country";




    $curl = curl_init($link);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: spider.g2r.su',$authtoken));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $html = curl_exec($curl);
    $html = json_decode($html,true);

        echo '<pre>',print_r($html,1),'</pre>';

      
        

        echo "
        <style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
          padding: 5px;
          text-align: left;
        }
        </style>
          <table style='margin:10px 40px'>
              <tr>
                <th>Номер</th>
                <th>Компания</th>
                <th>Информация</th>
              </tr>
            ";
        $i = 0;
        foreach($html as $html){
            $i++;
            echo "<tr>";
                echo "<td>".$i."</td>"; 
                echo "<td>".$html['company']."</td>"; 
                echo "<td>".$html['info']."</td>";
            echo "</tr>";

            // $company_name = $html['company'];
            // $company_info = $html['info'];
            // require_once 'wp/wp-load.php';
            // global $wpdb;
            // $table_parser = $wpdb->get_blog_prefix() . 'parser';
            // $check_parser_company = $wpdb->get_row( " SELECT * FROM {$table_parser} 
            //                                             WHERE company = '$company_name' 
            //                                             AND info = '$company_info'");
            // if(empty($check_parser_company)){
            //     $wpdb->insert($table_parser, array(
            //         'company' => $html['company'],
            //         'info' => $html['info'],
            //         'parser_id' => $mark_kz,
            //         'zapros' => $zapros
            //         ));
            // }
        }
        echo "</table>";  
    }


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
        $html = curl_exec($curl);echo $html;
        $html = json_decode($html,true);
        $response = $html['results'];
        echo "
        <style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
          padding: 5px;
          text-align: left;
        }
        </style>
          <table style='width:100%; margin-top:100px'>
              <tr>
                <th>Номер</th>
                <th>Откуда</th>
                <th>Телефон</th>
                <th>Почта</th>
                <th>Город</th>
              </tr>
            ";
            $i = 0;
        foreach($response as $response){
            $i++;
            echo "<tr>";
                echo "<td>".$i."</td>"; //номер
                echo "<td>".$response['from']."</td>"; //откуда контакт
                echo "<td>".$response['phone']."</td>"; //телефон
                echo "<td>".$response['email']."</td>"; //почта
                echo "<td>".$response['city']."</td>"; //город
            echo "</tr>";
        }
        echo "</table>";

    }
    // zapros();
?>

<?php
wp_reset_query();
?>


<?php
get_template_part('parts/footer', 'archive');
get_footer();
