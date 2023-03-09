<?php

namespace Inc\Classes;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail{
 
    public function newOrderCustomer($customerEmail, $customerName, $cpf, $total,$adminEmail, $nameSite, $orderId){
        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";
        $mail->Username = 'noreply@mlovi.com.br';
        $mail->Password = 'Mlwebpass0110!@#';                       //SMTP password


        try {
            $message = file_get_contents(TEMPLATE_PATH . 'new-order.php');
            $message = str_replace('%customerName%', $customerName, $message); 
            $message = str_replace('%orderId%', $orderId, $message);
            $message = str_replace('%cpf%', $cpf, $message);
            $message = str_replace('%total%', $total, $message);
            $message = str_replace('%nameSite%', $nameSite, $message); 
 
 
            //Recipients
            $mail->setFrom('noreply@mlovi.com.br', $nameSite);
            $mail->addAddress($customerEmail);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Pedido confirmado - {$orderId}";
            $mail->Body    =  $mail->MsgHTML($message);
            $mail->AltBody = " Olá, {$customerName}!
                Recebemos a confirmação do seu pedido.
                Nome Completo: {$customerName}
                Pedido: #{$orderId}. 
                Valor Pago: {$total} .
                
                Até Breve!"
            ;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            file_put_contents(MP_PATH.'log/notification.log', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}", PHP_EOL, FILE_APPEND);

        }
    }



    public function newOrderAdmin($customerEmail, $customerName, $cpf, $total,$adminEmail, $nameSite, $orderId){

        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";
        $mail->Username = 'noreply@mlovi.com.br';
        $mail->Password = 'Mlwebpass0110!@#';                       //SMTP password


        try {
            $message = file_get_contents(TEMPLATE_PATH . 'new-order-admin.php');
            $message = str_replace('%customerName%', $customerName, $message); 
            $message = str_replace('%orderId%', $orderId, $message);
            $message = str_replace('%cpf%', $cpf, $message);
            $message = str_replace('%total%', $total, $message);
            $message = str_replace('%nameSite%', $nameSite, $message); 
 
 
            //Recipients
            $mail->setFrom('noreply@mlovi.com.br', "Site - {$nameSite}");
            $mail->addAddress($adminEmail);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Pedido confirmado - {$orderId}";
            $mail->Body    =  $mail->MsgHTML($message);
            $mail->AltBody = " Olá, {$nameSite}!
                Você recebeu uma nova confirmação de pedido no site.
                Cliente: {$customerName}
                Pedido: #{$orderId}. 
                Valor Pago: {$total} .
                
                Para mais informação acesse seu painel administrativo e busque pelo número do pedido.
                Até Breve!"
            ;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            file_put_contents(MP_PATH.'log/notification.log', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}", PHP_EOL, FILE_APPEND);

        }
    }

    


}