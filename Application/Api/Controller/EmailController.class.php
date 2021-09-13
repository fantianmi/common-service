<?php

namespace Api\Controller;

class EmailController extends CommonController
{
    public function send($smtpHost, $smtpPort, $smtpEmail, $smtpName, $smtpUser, $smtpPass, $receiveEmail, $subject, $content)
    {
        Vendor('PHPMailer.PHPMailerAutoload');
        $mail = new \PHPMailer();
        $mail->SMTPDebug = 0;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $smtpHost;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->CharSet = 'UTF-8';
        $mail->Username = $smtpUser;                 // SMTP username
        $mail->Password = $smtpPass;                           // SMTP password
        if ($smtpHost == 'smtp.qq.com' || $smtpHost == 465) {
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        }
        $mail->Port = $smtpPort;                                    // TCP port to connect to
        $mail->setFrom($smtpEmail, $smtpName);
        $mail->addAddress($receiveEmail);               // Name is optional
        $mail->AddReplyTo($smtpEmail, $smtpName);
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if ($mail->Send()) {
            $this->jsuccess();
        } else {
            $this->jerror($mail->ErrorInfo);
        }
    }
}