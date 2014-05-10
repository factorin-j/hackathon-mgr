<?php

class Mail
{
    public static function send($to, $inquiry_id, $message)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'izle.erous@gmail.com';
        $mail->Password = 'maduhfakuh666';
        $mail->SMTPSecure = 'tls';

        $mail->From = 'izle.erous@gmail.com';
        $mail->FromName = 'Information';
        $mail->addAddress($to);
        $mail->addReplyTo('izle.erous@gmail.com', 'Information');
        $mail->isHTML(true);

        $mail->Subject = 'Reply to InquiryID #' . $inquiry_id;
        $mail->Body    = $message;

        if(!$mail->send()) {
            throw new AppException('Message could not be sent. ' . $mail->ErrorInfo);
        }
        return true;
    }
}
