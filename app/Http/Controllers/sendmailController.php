<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;

class sendmailController extends Controller
{
    //
    public function sendmail($to_email,$subject,$msg)
    {
        /*
        // Create an instance of PHPMailer class  
        $mail = new PHPMailer; 
        
        // SMTP configurations 
        $mail->isSMTP(); 
        $mail->Host        = 'smtp.example.com'; 
        $mail->SMTPAuth = true; 
        $mail->Username = 'user@example.com'; 
        $mail->Password = '******'; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Port        = 587; 
        
        // Sender info  
        $mail->setFrom('sender@example.com', 'SenderName'); 
        
        // Add a recipient  
        $mail->addAddress('recipient@example.com');  
        
        // Add cc or bcc   
        $mail->addCC('cc@example.com');  
        $mail->addBCC('bcc@example.com');  
        
        // Email subject  
        $mail->Subject = 'Send Email via SMTP in Laravel';  
        
        // Set email format to HTML  
        $mail->isHTML(true);  
        
        // Email body content  
        $mailContent = '  
            <h2>Send HTML Email using SMTP Server in Laravel</h2>  
            <p>It is a test email by CodexWorld, sent via SMTP server with PHPMailer in Laravel.</p>  
            <p>Read the tutorial and download this script from <a href="https://www.codexworld.com/">CodexWorld</a>.</p>';  
        $mail->Body = $mailContent;  
        
        // Send email  
        if(!$mail->send()){  
            echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;  
        }else{  
            echo 'Message has been sent.';  
        }
        */
        

        $mail             = new PHPMailer(); // create a n
        
        $mail->IsSMTP();
        $mail->SMTPDebug  = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth   = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host       = "smtp.hostinger.com";
        $mail->Port       = 465; // or 587
        $mail->IsHTML(true);
        //$mail->Username = "info@mycarscentral.app";
        $mail->Username = "esignpro@xcesslogic.info";
        //$mail->Username = "eyehub@xcesslogic.info";
        $mail->Password = "Xcess_123!";
        //$mail->SetFrom("info@mycarscentral.app", 'Esign Lite');
        $mail->SetFrom("esignpro@xcesslogic.info", 'Digital Sign');
        $mail->Subject = $subject;
        $mail->Body    = $msg;
        $mail->AddAddress($to_email, $to_email);
        if ($mail->Send()) {
            return 'Email Sended Successfully';
        } else {
            return 'Failed to Send Email';
        }
        
        //return redirect('sent_doc');
    }
}
