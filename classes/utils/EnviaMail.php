<?php

//include __DIR__ . "/../../vendor/phpmailer/phpmailer/src/Exception.php";
//include __DIR__ . "/../../vendor/phpmailer/phpmailer/src/PHPMailer.php";
//include __DIR__ . "/../../vendor/phpmailer/phpmailer/src/SMTP.php";
require __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class EnviaMail {

    public function Enviar($sender, $sendername, $recipient, $replyto = '', $subject, $message) 
    {
        //$mail = new PHPMailer(true);
        $mail = new PHPMailer();
        try {
            $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL; //SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();
            $mail->Charset   = PHPMailer::CHARSET_UTF8;                                         // Send using SMTP           
            $mail->Host       = 'localhost';                    // Set the SMTP server to send through            
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'contato@megapedigree.com';                     // SMTP username
            $mail->Password   = 'M3g@P3d1gr33';                               // SMTP password
            $mail->SMTPAutoTLS = false;
            $mail->Port       = 25;
            $mail->setFrom($sender, $sendername);
            $mail->addAddress($recipient);   // Name is optional
            if ($replyto != ''){$mail->addReplyTo($replyto);}
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;        
            $mail->send();
        } catch (Exception $e) {
            echo "Mensagem não enviada: {$mail->ErrorInfo}\n";
        }
    }
}