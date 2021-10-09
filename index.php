<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once './Controller/SendEmailSMTP.php';

$data = json_decode(file_get_contents("php://input"));


// try {
    $sendEmailSMTP = new SendEmailSMTP();
    $sendEmailSMTP->name = $data->name;
    $sendEmailSMTP->email = $data->email;
    $sendEmailSMTP->subject = $data->subject;  
    $sendEmailSMTP->message = $data->message;  

    $db = $sendEmailSMTP->send();
    echo $db;
// } catch (\Throwable $th) {
//     $returnMessage=array(
//         "responseCode" => 101,
//         "responseMessage" => "Faild",
//     );
//     print_r(json_encode($th));
// }


