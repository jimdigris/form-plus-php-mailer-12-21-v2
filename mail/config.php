<?php
define("HOST", "smtp.yandex.ru");   // SMTP сервера вашей почты
define("LOGIN", "ihailpetr78");     // логин вашей почты
define("PASS", "qsknobwitqvdrfr");  // пароль вашей почты
define("SECURE", "ssl");
define("PORT", "465");

define("SENDERS_EMAIL", "ihailpetr78@yandex.ru");      // почта С которой отправляем
define("SENDERS_NAME", "Имя отправителя");             // имя отправителя
define("RECIPIENTS_EMAIL", "jimdigris@mail.ru");       // почта НА которую отправляем

// -- для нас --
define("TITLE_EMAIL", "Сообщение с сайта");            // заголовок письма
define("BODY_EMAIL", "
    <div style='background: #a9e9ef; padding: 8px; height: 22px; text-align: center; background: -webkit-linear-gradient(127deg, #dd3f45,#92e2e7,#484b53); background: linear-gradient(127deg, #dd3f45,#92e2e7,#484b53);  '>
        <div style='font-weight: bold; font-size: 18px;'>$titleModal</div>
    </div>

    <div style='padding: 12px 18px; background: #fafafa;'>
        <ul>
            <li>ФИО: $name</li>
            <li>Телефон: $phone</li>
            <li>Почта: $email</li>
            <li>Сообщение: $text</li>
        </ul>
    </div>

    <div style='background: #a9e9ef; padding: 4px; height: 16px; text-align: center; font-size: 12px; background: -webkit-linear-gradient(127deg, #dd3f45,#92e2e7,#484b53); background: linear-gradient(127deg, #dd3f45,#92e2e7,#484b53);'>
        Страница с которой отправили запрос: <a style='color: #fff; font-weight: bold; padding-left: 8px;' href='$linkPage'>$titlePage</a>
    </div>
"); 

// -- для клиента --
define("TITLE_CLIENT_EMAIL", "Сообщение с сайта");      // заголовок письма
define("BODY_CLIENT_EMAIL", "
    <div style='background: #a9e9ef; padding: 8px; height: 22px; text-align: center; background: -webkit-linear-gradient(127deg, #dd3f45,#92e2e7,#484b53); background: linear-gradient(127deg, #dd3f45,#92e2e7,#484b53);  '>
        <div style='font-weight: bold; font-size: 18px;'>Дорогой клиент!</div>
    </div>

    <div style='padding: 12px 18px; background: #fafafa;'>
        Вы были на нашем сайте, спасибо!
    </div>

    <div style='background: #a9e9ef; padding: 4px; height: 16px; text-align: center; font-size: 12px; background: -webkit-linear-gradient(127deg, #dd3f45,#92e2e7,#484b53); background: linear-gradient(127deg, #dd3f45,#92e2e7,#484b53);'>
        Описание сайта <a style='color: #fff; font-weight: bold; padding-left: 8px;' href='https://site.ru'>Название сайта</a>
    </div>
"); 