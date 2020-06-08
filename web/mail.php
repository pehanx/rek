<?php
    require_once 'wp/wp-load.php';

    $to = "info@russianexport.club" ;//get_bloginfo('admin_email');
    $test_mail = "nikitos.0@list.ru";
    $from = "<info@russianexport.club>";
    $site = "РЭК";
    $subject = "";

    // $utm_source = trim($_POST["utm_source"]);
    // $utm_medium = trim($_POST["utm_medium"]);
    // $utm_campaign = trim($_POST["utm_campaign"]);
    // $utm_term = trim($_POST["utm_term"]);
    // $utm_content = trim($_POST["utm_content"]);
    // $cm_title = trim($_POST["cm_title"]);

    // $ip_client = $_SERVER['REMOTE_ADDR'];

    // **********************************************

	$typeMessage = 'Заявка с сайта';
	if ($_POST['type'] == 'participation'){
		$typeMessage = 'Заявка на участие в клубе';
	} else if ($_POST['type'] == 'contact') {
		$typeMessage = 'Сообщение из формы обратной связи';
	}else if ($_POST['type'] == 'subscription') {
        $typeMessage = 'Подписка на рассылку';
    }else if ($_POST['type'] == 'register') {
        $typeMessage = 'Регистрация в экспортном клубе';
    }else if ($_POST['type'] == 'sign_event') {
        $typeMessage = 'Запись на событие';
        $to_export = "export@g2r.ru";
    }else if ($_POST['type'] == 'updatesite') {
        $typeMessage = 'Предложение об улучшении сайта';
    }else if ($_POST['type'] == 'forgotpass') {
        $to = $_POST['Почта'];
        $typeMessage = 'Восстановление пароля';
    }else if ($_POST['type'] == 'order_speaker') {
        $typeMessage = 'Заказ спикера';
    }else if ($_POST['type'] == 'invite-speakers') {
        $typeMessage = 'Заявка на приглашение эксперта';
        $to = $test_mail;
    }else if ($typeMessage == 'Заявка с сайта') {
        exit();
    }
	
	unset($_POST['type']);
    unset($_POST['Логин']);
    unset($_POST['Пароль']);
    unset($_POST['Подтверждение_пароля']);
    unset($_POST['ID_события']);
	
    if (empty($_POST['js'])) {

        if($typeMessage == 'Восстановление пароля'){
            global $wpdb;
            //Проверка на существование пользователя
            $check_login_pass = $wpdb->get_row( " SELECT * FROM wp_clients WHERE email = '$to'");

            if(!empty($check_login_pass)){

                $email = $_POST['Почта'];
                $token = md5($email.time());

                $wpdb->update( 
                    'wp_clients', 
                    array( 
                        'reset_password_token' => $token 
                    ), 
                    array( 'email' => $email )
                );

                

                $link_reset_password = 'https://'.$_SERVER['HTTP_HOST'].'/'."reset-password".'/'."?email=$email&token=$token";

                $mes = 'Здравствуйте! <br/> <br/> Для восстановления пароля от сайта <a href="https://'.$_SERVER['HTTP_HOST'].'"> '.$_SERVER['HTTP_HOST'].' </a>, перейдите по этой <a href="'.$link_reset_password.'">ссылке</a>.';

            }else{
                echo "Пользователь с таким email не найден";
                exit();
            }
            
        }
        else{
            $mes= "<table style='width: 100%; background-color: #f8f8f8;'>";

            foreach ( $_POST as $key => $value ) {
                if (strpos($key, '???') !== false) exit();
                if ($value != "" && $key != "utm_source" && $key != "utm_medium" && $key != "utm_campaign" && $key != "utm_term" && $key != "utm_content" && $key != "cm_title" && $key != "usr_file") {
                    $mes.= "
                    <tr>
                        <td style='padding: 10px; border: #e9e9e9 1px solid;'>".preg_replace("/_/", " ", $key)."</td>
                        <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
                    </tr>";
                }
            }

            $mes.= "</table>";
        }

        $subject .= "{$typeMessage}";
        $subject = "=?utf-8?b?" . base64_encode($subject) . "?=";

        $boundary = "--".md5(uniqid(time()));


        // $mailheaders = "MIME-Version: 1.0;\r\n";
        // $mailheaders .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
        $mailheaders .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
        $mailheaders .= "From: РЭК {$from} \r\n";

        // $multipart = "--$boundary\r\n";
        // $multipart .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
        // $multipart .= "Content-Transfer-Encoding: 7bit\r\n";
        // $multipart .= "\r\n";
        $multipart = $mes;

        // $message_part = '';
        // if (is_uploaded_file($_FILES['usr_file']['tmp_name'])) {
        //     $filename = $_FILES['usr_file']['name'];
        //     $filetype = $_FILES['usr_file']['type'];
        //     $filesize = $_FILES['usr_file']['size'];

        //     $message_part = "\r\n--$boundary\r\n";
        //     $message_part .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
        //     $message_part .= "Content-Transfer-Encoding: base64\r\n";
        //     $message_part .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";
        //     $message_part .= "\r\n";
        //     $message_part .= chunk_split(base64_encode(file_get_contents($_FILES['usr_file']['tmp_name'])));
        //     $message_part .= "\r\n--$boundary--\r\n";
        // }
        // $multipart .= $message_part;

        // if ($filesize < 26214400) {
            if (mail($to, $subject, $multipart, $mailheaders)) {
                echo "Отправлено";
            }else{
                echo "Не отправлено";
            }
            if(isset($to_export)){
              if (mail($to_export, $subject, $multipart, $mailheaders)) {
                echo "Отправлено";
                }else{
                    echo "Не отправлено";
                }  
            }
            // if (mail($to_g2r_ru, $subject, $multipart, $mailheaders)) {
            //     echo "Отправлено";
            // }else{
            //     echo "Не отправлено";
            // }
        // }
        // else {
        //     echo "Размер всех файлов превышает 25 МБ";
        // }
    }

?>
