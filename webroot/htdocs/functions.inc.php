<?php
function send_email($email, $type, $id)
{
    include 'Mail.php';
    include 'Mail/mime.php';

    $crlf = "\r\n";
    if ($type == 0) {
        $subject = 'Работа принята на модерацию';
    } elseif ($type == 1) {
        $subject = 'Ваша работа не прошла модерацию';
    } elseif ($type == 2) {
        $subject = 'Ваша работа прошла модерацию';
    }
    $mime_params = array(
            'text_encoding' => '7bit',
            'text_charset'  => 'UTF-8',
            'html_charset'  => 'UTF-8',
            'head_charset'  => 'UTF-8'
    );

    $headers = array(
        'From'          => 'mcdonalds@timeout.ru',
        'Return-Path'   => 'mcdonalds@timeout.ru',
        'Subject'       => $subject,
        'Content-Type'  => 'text/html; charset=UTF-8'
    );

    $mime = new Mail_mime( array( 'eol' => $crlf ) );

    $html = '<!DOCTYPE html>'.$crlf;
    $html .= '<html>'.$crlf;
    $html .= '<head>'.$crlf;
    $html .= '<meta charset="UTF-8">'.$crlf;
    $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.$crlf;
    $html .= '<title>'.$subject.'</title>'.$crlf;
    $html .= ''.$crlf;
    $html .= '</head>'.$crlf;
    $html .= '<body style="margin: 0; padding: 0;">'.$crlf;
    if ($type == 0) {
        $html .= '<p>Спасибо за участие!</p>';
        $html .= '<p>В данный момент наш модератор с увлечением (да, именно так!) читает факт, который вы написали.</p>';
        $html .= '<p>Когда он закончит, мы отправим письмо с подтверждением на этот почтовый ящик.</p>';
        $html .= '<p>Пока что можете поделиться ссылкой на проект в социальных сетях –  за это мы начислим вам 80 баллов.</p>';
    } elseif ($type == 1) {
        $html .= '<p>Упс!</p>';
        $html .= '<p>Факт, который вы написали, не прошел модерацию.</p>';
        $html .= '<p>Возможно, вы не обратили внимания на одно из правил, описанных здесь: <a href="http://mcdonalds.timeout.ru">правила</a></p>';
        $html .= '<p>Попробуйте еще раз.</p>';
    } elseif ($type == 2) {
        $html .= '<p>Ура!</p>';
        $html .= '<p>Факт успешно прошел модерацию и был опубликован на сайте – вам начислено 500 баллов.</p>';
        $html .= '<p>Чтобы полюбоваться на свою работу, перейдите по этой ссылке: <a href="http://mcdonalds.timeout.ru/contest.php?user='.$id.'">ваша работа</a></p>';
        $html .= '<p>Попробуйте еще раз.</p>';
    }
    $html .= ''.$crlf;
    $html .= '</body>'.$crlf;
    $html .= '</html>'.$crlf;

    $mime->setHTMLBody( $html );

    $body = $mime->get( $mime_params );
    $hdrs = $mime->headers( $headers );

    $params = array(
        'host'      => 'ssl://smtp.yandex.ru',
        'port'      => 465,
        'auth'      => true,
        'username'  => 'mcdonalds@timeout.ru',
        'password'  => 'miffivno',
        'timeout'   => 30,
    );
    $mail =& Mail::factory( 'smtp', $params );
    $mail->send( $email, $hdrs, $body );
}
