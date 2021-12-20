<?php
// Файлы phpmailer
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';
require 'POP3.php';

// Переменные, которые отправляет форма
$name = $_POST['name'];
$email = (string) $_POST['email'];
$phone = $_POST['phone'];
$text = $_POST['text'];
$titleModal = $_POST['titleModal'];
$linkPage = $_POST['linkPage'];
$titlePage = $_POST['titlePage'];
$keyL = $_POST['keyL'];
$keyP = $_POST['keyP'];
$file = $_FILES['myfile'];

require 'config.php';

// --- подготовка и отправка ---
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = HOST;
    $mail->Username   = $keyL . LOGIN;
    $mail->Password   = $keyP . PASS;
    $mail->SMTPSecure = SECURE;
    $mail->Port       = PORT;
    $mail->setFrom($keyL . SENDERS_EMAIL, SENDERS_NAME);

    // Получатель письма
    $mail->addAddress(RECIPIENTS_EMAIL);

    //Прикрипление файлов к письму
    if (!empty($file['name'][0])) {
        for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
            $filename = $file['name'][$ct];
            if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
                $mail->addAttachment($uploadfile, $filename);
                $rfile[] = "Файл $filename прикреплён";
            } else {
                $rfile[] = "Не удалось прикрепить файл $filename";
            }
        }   
    }

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = TITLE_EMAIL;
    $mail->Body = BODY_EMAIL;    

    // Проверяем отправленность сообщения
    if ($mail->send()) { 
        $result = "success";         
        if ($email != '') { sendMailToClient ($mail, $email); }             // ответное письмо клиенту
    } else { 
        $result = "error";         
        sendReservMail (RECIPIENTS_EMAIL, $name, $phone, $email, $text);    // резервная отправка письма
    }

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";    
    sendReservMail (RECIPIENTS_EMAIL, $name, $phone, $email, $text);        // резервная отправка письма
}

// Отображение результата
echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);

// ответное письмо клиенту
function sendMailToClient ($mail, $email) {
    $mail->clearAddresses();
    $mail->addAddress($email);
    $mail->Subject = TITLE_CLIENT_EMAIL;
    $mail->Body = BODY_CLIENT_EMAIL;
    $mail->send(); 
}

// резервная отправка письма, если не сработала основная
function sendReservMail ($recipientsMail, $name, $phone, $email, $text) {
    mail($recipientsMail, "Сообщение с сайта", " Имя: $name \n Телефон: $phone  \n Почта: $email \n Сообщение: $text"); 
}
