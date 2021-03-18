<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>contact-us</title>
</head>
<body>
<form method="post">
    name:<input type="text" name="name"><br/>
    Email:<input type="email" name="email"><br/>
    Mobile:<input type="text" name="mobile"><br/>
    Message:<textarea name="message" rows="10" cols="50"></textarea>
    <input type="submit" name="submit" value="submit">
</form>

</body>
</html>



<?php

use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';



if(isset($_POST['submit']))

{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];





    $mail = new PHPMailer();


    // email settings
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";



    // disable isSMTP option in deployment.
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '6815ac1df1fda5';   // email address
    $mail->Password = 'c8b42c9354fc77';   // email password
    $mail->Port = 465;
    $mail->SMTPSecure = "tls";



    $subject_email = 'Contact Us Request';



    $mail->setFrom($email,$name);
    $mail->addAddress('eldyir93@gmail.com','webinty');
    $mail->Subject = $subject_email;
    //$mail->Body = 'my name is '.$name. ' and my email is ' .$email. ' and mobile phone is ' .$mobile;

    // when to use email template first_option
    ob_start();
    include "email_template/plain-text.html";
    $message_text = ob_get_clean();
    $mail->msgHTML($message_text);



    // when use html to design email second_option
    //$mail->Body = 'From: '.$email.'<br>'.'Subject: '.$subject_email.'<br>'.'Name: '.$name.'<br>'.'Mobile: '.'<b>'.$mobile.'</b>'.'<br>'.'Message: '.$message;



    if(!$mail->send())
    {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

}
