<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


include_once 'DotEnv.php';
require_once "vendor/autoload.php";
(New DotEnv(__DIR__ . '/../.env'))->load();

class SendEmailSMTP{

    
    private $host;
    private $userName;
    private $password;
    private $port;
    private $SMTPSecure;

    public $name;
    public $email;
    public $subject;
    public $message;


    public function __construct()
    {
        $this->host = getenv('HOST');
        $this->userName = getenv('USERNAME');
        $this->password = getenv('PASSWORD');
        $this->port = getenv('PORT');
        $this->SMTPSecure = getenv('SMTPSECURE');
    }


    public function send()
    {
        $mail = new PHPMailer(true);

        //Enable SMTP debugging.
        $mail->SMTPDebug = 3;                               
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();            
        //Set SMTP host name                          
        $mail->Host = $this->host;
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;                          
        //Provide username and password     
        $mail->Username = $this->userName;                 
        $mail->Password = $this->password;                           
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = $this->SMTPSecure;                           
        //Set TCP port to connect to
        $mail->Port = $this->port;                                   

        $mail->From = $this->email;
        $mail->FromName = $this->name;

        $mail->addAddress("web@jmelectric.sd", "JM ELetric");

        $mail->isHTML(false);

        $mail->Subject = $this->subject;
        $mail->Body = "<i>" . $this->message . "</i>";
        $mail->AltBody = "This is the plain text version of the email content";

        try {
            $mail->send();
            $returnMessage=array(
                "responseCode" => 100,
                "responseMessage" => "Successfully!",
            );
            print_r(json_encode($returnMessage));
        } catch (Exception $e) {
            $returnMessage=array(
                "responseCode" => 101,
                "responseMessage" => "Faild!",
            );
        }
    }
}

