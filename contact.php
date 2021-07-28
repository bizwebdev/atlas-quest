<?php

function slack($message)
{
    $ch = curl_init("https://slack.com/api/chat.postMessage");
    $data = http_build_query([
        "token" => "xoxp-444859433459-444859433731-467513186016-c050aa539396b6d57975c68fa3175ad4",
    	"channel" => '#queries', //"#mychannel",
    	"text" => $message, //"Hello, Foo-Bar channel message.",
    	"username" => "Contact Us",
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

function sendEmail($to, $from, $subject, $message){
	$headers = 'From: ' . $from . PHP_EOL ;
	mail ( $to, $subject, $message, $headers ) ;
}

function respondToUser($firstName, $email){
    $subject = 'Your query submitted to our support team';
    $body = 'Dear ' . $firstName . '<br/><br/>' .
        'Thanks for contacting us, our support team will get back to you asap. <br/><br/>' .
        'Regards <br/> Team atlas quest';

    $toEmail = $email;
    $fromEmail = 'no-reply@atlasquest.com';

    sendEmail($toEmail, $fromEmail, $subject, $body);
}

function sendRequestToSupport($firstName, $lastName, $email, $phone, $message){
    $subject = 'Recieved new Query from ' . $firstName . ' ' . $lastName;
    $body = 'Message : ' . $message . '<br/><br/>' . 
        'Contact No. ' . $phone . '<br/>' . 
        'Email ' . $email ; 

    $toEmail = 'support@atlasquest.com';
    $fromEmail = $email;

    sendEmail($toEmail, $fromEmail, $subject, $body);
}

$firstName=($_POST['firstname']);
$lastName=($_POST['lastname']);
$email=($_POST['email']);
$phone=($_POST['phone']);
$message=($_POST['message']);

respondToUser($firstName, $email);
sendRequestToSupport($firstName, $lastName, $email, $phone, $message);

$slackMessage =  'Recieved query from : ' . $firstName . ' ' . $lastName . ' ' . $email . ' ' . $phone . ' *' . $message . '*'; 
slack($slackMessage);
header("Location: index.html");
exit();
?>